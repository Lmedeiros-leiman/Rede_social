<?php

session_start();
function islogged(): bool
{
    if (isset($_SESSION["NOME_USUARIO"])) {
        return true;
    } else {
        return false;
    }
}
function impedirnaologado() {
    if (!isset($_SESSION["NOME_USUARIO"])) {
        header("location: index.php");
        exit();
    }
    return true;
}
