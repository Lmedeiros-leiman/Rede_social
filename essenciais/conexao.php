<?php
require "relato_erro.php";
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
            $this->conn = new PDO($this->dadosunidos, $this->usuario, $this->senha, $this->opcoes);
            return true;

        } catch ( PDOException $erro) {

            echo "<div style='position: absolute; padding: 1rem; top: 10%; left: 50% ;transform: translate(-50%, -50%); border: 1px solid black; background-color: whitesmoke; color: grey; font-weight: bolder ; font-size: larger; text-align: left; box-shadow: 12px 12px 2px 1px rgba(0,0,0,0.2);'>
                    Problemas ao conectar com o banco de dados!<br>
                    Arquivo de relatório criado..
                    </div> ";

          $mensagem_erro = " um problema connectando com o banco de dados: \n{$erro->getMessage()}";
          $relatorio->adicionar_erro($mensagem_erro);
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

    public function verificar_registro($nomes = array(), $valores = array(), $buscarsenha = false ) {
        $senha_usuario = null;
        $email_usuario = null;
        try{
            if ($this->conn === null) {
                throw new Exception("Abra a conexao para fazer a query.");
            }
            if (!is_array($nomes) or !is_array($valores)){
                throw new Exception("Um dos valores não é um array.");
            }
            if (count($nomes) != count($valores)) {
                throw new Exception("As entradas possuem valores de tamanho diferente, garanta que tenham a mesma quantidade de itens em cada vetor.");
            }
            if (count($nomes) < 1 or count($valores) < 1 ) {
                throw new Exception("Um dos valores esta vazio, verifique a entrada de dados.");
            }
            for ($i = 0; $i < count($nomes); $i++) {
                if ($nomes[$i] == "senha_usuario"){
                    $senha_usuario = $valores[$i];
                }
                if ($nomes[$i] == "email_usuario"){
                    $email_usuario = $valores[$i];
                }
            }

        } catch (Exception $erro) {
            return false;
            exit();
        }

        try {
          $pedido = "SELECT nome_usuario FROM usuarios WHERE nome_usuario = ? OR email_usuario = ?  ";
          $preparacao = $this->conn->prepare($pedido);
          $preparacao->bindValue(1, $valores[0]);
          $preparacao->bindValue(2, $email_usuario);

          if ($buscarsenha) {
            $pedido = "SELECT nome_usuario FROM usuarios WHERE nome_usuario = ? AND senha_usuario = ? OR email_usuario = ? AND senha_usuario = ? ";
            $preparacao = $this->conn->prepare($pedido);
            $preparacao->bindValue(1, $valores[0]);
            $preparacao->bindValue(2, $senha_usuario);
            $preparacao->bindValue(3, $email_usuario);
            $preparacao->bindValue(4, $senha_usuario);
          }


          $preparacao->execute();
          $dados = $preparacao->fetchAll();


          if ($dados){
            return $dados;
          }
          return false;
        } catch (Exception $erro) {
            return false;
            exit();
        }
    }
    public function criar_registro($nomes = array(), $valores = array() ){
        try{
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


        } catch (Exception $erro) {
            return false;
            exit($erro);
        }

        try {

            $nome = implode(",", $nomes);
            $valor = implode(', ', array_fill(0, count($valores), '?'));

            $pedido = "INSERT INTO usuarios ( $nome ) VALUES ( $valor )";
            $preparacao = $this->conn->prepare($pedido);
            $preparacao->execute($valores);

            return true;


        } catch (Exception $erro) {
            return false;
            exit();

        }
        return false;
    }
    public function pegar_dados_usuario_id($nomeusuario) {
        $pedido = "SELECT
            nome_usuario,
            apelidado_usuario,
            foto_perfil_usuario,
            email_usuario,
            telefone_usuario,
            data_criacao_usuario,
            data_ultimo_login_usuario
            
        FROM usuarios WHERE `nome_usuario` = :nome_usuario";
        $preparacao = $this->conn->prepare($pedido);
        $preparacao->bindValue(':nome_usuario', $nomeusuario);
        $preparacao->execute();
        return $preparacao->fetchAll();
    }
}
$banco = new Bancodados();
