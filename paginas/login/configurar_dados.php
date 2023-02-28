<?php
require "../../essenciais/iniciar.php";
try{
    $banco->abrir();
    $dados = $banco->pegar_dados_usuario_id($_SESSION["NOME_USUARIO"]);
    $banco->fechar();

} catch ( Exception $erro) {
    echo "Houve um erro com o banco de dados, este é um erro do servidor. <p> $erro </p>";
    exit();
}

try {

    foreach ($dados[0] as $nomes => $valores){
        $nomes = strtoupper($nomes);
        //echo "<div style='margin-left: 1rem'> $nomes => $valores </div>"; // remover para visualizar os resultados;
        $_SESSION[$nomes] = $valores;
    }
    header("location: ../usuario/index.php");
    exit();

} catch ( Exception $erro) {
    echo "houve um erro interno, isso é um problema do servidor. <p> $erro </p> ";
    exit();
}
