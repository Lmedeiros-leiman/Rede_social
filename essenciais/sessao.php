<?php
session_start();
$_SESSION["NOMEWEBSITE"] = "Website";
function islogged(): bool
{
    if (isset($_SESSION["IDUSUARIO"])) {
        return true;
    } else {
        return false;
    }
}
function impedirnaologado() {
    if (!isset($_SESSION["IDUSUARIO"])) {
        header("location: index.php");
        exit();
    }
    return true;
}
function impedirusuario() {
    if ($_SESSION["nivelconta"] === "usuario") {
        return true;
    }
    header("location: index.php");
    exit();
    return false;
}

function checaradministrador() {
    if ($_SESSION["nivelconta"] != "usuario") {
        return true;
    }
    header("location: index.php");
    exit();
    return false;
}
