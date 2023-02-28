<?php
include "../../../essenciais/iniciar.php";

$nomes = array(); $valores = array();
foreach ($_POST as $elemento => $valor ) {
    if (!(isset($valor) and strlen($valor))) {
        if ($elemento === "telefone_usuario"){
            array_push($nomes,$elemento);
            array_push($valores,0);
        }

    } else {
        if ($elemento != "confirmar_senha_usuario") {
            array_push($nomes,$elemento);
            array_push($valores,$valor);
        }

    }
}



try {

    array_push($nomes,"data_criacao_usuario");
    array_push($valores, date("Y-m-d H:i:s"));

    $banco->abrir();
    $resultados = $banco->verificar_registro($nomes,$valores,false);
    $banco->fechar();

    if ($resultados) {throw new Exception("duplicados");}


    $banco->abrir();
    $criado_login = $banco->criar_registro($nomes,$valores);
    $banco->fechar();

    $_SESSION["NOME_USUARIO"] = $_POST["nome_usuario"];
    echo "enviando para configurar_dados!";
    header("location: ../configurar_dados.php");
    exit();
} catch (Exception $error) {
    header("location: registro.php?login=duplicado");
    exit();
}
