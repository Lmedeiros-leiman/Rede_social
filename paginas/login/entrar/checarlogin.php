<?php
include "../../../essenciais/iniciar.php";

$nomes = array(); $valores = array();
foreach ($_POST as $elemento => $valor) {

    if (!(isset($valor) and strlen($valor))) {
        header("location: login.php?login=invalido");
        exit();
    } else {
        array_push($nomes,$elemento);
        array_push($valores,$valor);
    }
}


try {
    $banco->abrir();
    $resultados = $banco->verificar_registro($nomes,$valores,true);
    $banco->fechar();

    if ($resultados) {
        $_SESSION["NOME_USUARIO"] = $_POST["nome_usuario"];
    } else{
        Throw new Exception("login nao existe");
    }

    header("location: ../configurar_dados.php");
    exit();
} catch (Exception $error) {
    header("location: login.php?login=invalido");
    exit("senha ou login errados");
}
