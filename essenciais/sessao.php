<?php
    session_start();
function islogged(){
    if ($_SESSION["IDUSUARIO"]) {
        return true;
    } else {
        return false;
    }
}
function impedirnaologado() {
    if (!isset($_SESSION["IDUSUARIO"])) {
        header("location: index.php");
    }
    return true;
}

function impedirusuario() {
    if ($_SESSION["nivelconta"] === "usuario") {
        return true;
    }
    header("location: index.php");
    return false;
}

function checaradministrador() {
    if ($_SESSION["nivelconta"] != "usuario") {
        return true;
    }
    header("location: index.php");
    return false;
}
