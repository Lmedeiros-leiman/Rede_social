<?php
class Bancodados
{
    private $usuario = null;
    private $senha = null;
    private $dadosunidos = null;
    private $opcoes  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    protected $conn = null;


    private $caminho_configuracoes = __DIR__."/bancodados.json";

    public function __construct()
    {
        try {
            $informacoes_json = file_get_contents($this->caminho_configuracoes);
            if ($informacoes_json === false) {
                throw new Exception("<p style='color: red; display: inline'>Erro ao pegar dados do arquivo, o caminho ate o arquivo esta correto?</p>");
            }
            $objeto_json = json_decode($informacoes_json);
            if ($objeto_json === true) {
                throw new Exception("<p style='color: red; display: inline'>Erro ao transformar dados do arquivo em objeto JSON, o arquivo esta com a sintaxe correta? <a href='https://jsonlint.com/' target='_blank'>verifique aqui</a></p>");
            }

            $this->usuario = $objeto_json->usuario;
            $this->senha = $objeto_json->senha;

            $this->dadosunidos = "mysql:host={$objeto_json->host};dbname={$objeto_json->banco};charset=UTF8";

        } catch ( Exception $e) {
            echo "Erro ao coletar as informacoes de login para o banco de dados.<br> ".$e;
        }

    }

    public function abrir() {
        try {
            $this->conn = new PDO($this->host, $this->usuario, $this->senha, $this->banco);
            return $this->conn;

        } catch ( PDOException $erro) {

            echo "<div style='position: absolute; padding: 1rem; top: 10%; left: 50% ;transform: translate(-50%, -50%); border: 1px solid black; background-color: whitesmoke; color: grey; font-weight: bolder ; font-size: larger; text-align: left; box-shadow: 12px 12px 2px 1px rgba(0,0,0,0.2);'>
                    Problemas ao conectar com o banco de dados!<br>
                    Arquivo de relatório criado..
                    </div> ";


            $data = date("d-m-Y");
            $horario = date("H:i:s");
            $numero = 1;

            $nome_arquivo = "/relatorios_erro/Relatório_Erro_BancoDados_{$data}_{$numero}.txt";
            while (file_exists($nome_arquivo)) {
                $numero++;
                $nome_arquivo = "/relatorios_erro/Relatório_Erro_BancoDados_{$data}_{$numero}.txt";
            }

            $mensagem_erro = " {$data} - {$horario} -> um problema connectando com o banco de dados: \n{$erro->getMessage()}\n\n";
            $caminhoerro = __DIR__.$nome_arquivo;
            file_put_contents($caminhoerro, $mensagem_erro, FILE_APPEND);
        }
        return false;
    }

    public function fechar() {

        try {
            $this->conn = null;
            return true;
        } catch ( Exception $error) {
            echo "Encontrado um erro ao fechar a conexao: ". $error->getMessage() ;

        }
        return false;
    }


    public function checar_query($nomes = array(), $valores = array() ) {
        try {
            if ($this->conn === null) {
                throw new Exception("Abra a conexao para fazer a query.");
            }
            $entradas = func_get_args();
            foreach ($entradas as $entrada) {
                if (!is_array($entrada)) {
                    throw new Exception("Um dos valores não é um array.");
                }

                if (count($entrada) < 1) {
                    throw new Exception("Um dos valores esta vazio, verifique a entrada de dados.");
                }

            }
            if (count($nomes) != count($valores)) {
                throw new Exception("As entradas possuem valores de tamanho diferente, garanta que tenham a mesma quantidade de itens em cada vetor.");
            }

            $pedido = "SELECT * FROM usuarios WHERE ";
            $pedido .= implode(" = ? AND ", $nomes) . " = ?";

            $preparacao = $conn->prepare($pedido);

            for ($i = 0; $i < count($valores); $i++) {
                $preparacao->bindValue($i + 1, $valores[$i]);
            }
            $preparacao->execute();
            return $preparacao->fetchAll();

            return true;
        } catch (Exception $e) {
            echo "Encontrado um erro ao checar a querry: <strong style='color: red'> {$e->getMessage()} </strong>";
        }
        return false;

    }

}
$banco = new Bancodados();