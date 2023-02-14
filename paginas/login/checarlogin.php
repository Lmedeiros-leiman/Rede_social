<?php
include "../../essenciais/iniciar.php";
$tabelas = $valores = null;

$comando = "SELECT * FROM";
$tabelas = array("usuarios");
$nomes = array();
$valores = array();

foreach ($_POST as $elemento => $valor) {

    if (!(isset($valor) and strlen($valor))) {
        header("location: login.php?login=invalido");
        exit();
    } else {

        array_push($nomes,$elemento);
        array_push($valores,$valor);



    }
}
print_r($nomes);
echo "<p></p>";
print_r($valores);
echo "<p></p>";


try {
    $banco->checar_query($nomes,$valores);

    //Throw new Exception("aeiou");
} catch (Exception $error) {
    header("location: login.php?login=invalido");
    exit();
}
//$comando = "SELECT * FROM $tabelas WHERE ($selecao) = ($valores)";
// resultado = mysqli_query($conn, $sql);

