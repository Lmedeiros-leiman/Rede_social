<?php
include_once "conexao.php";
include "sessao.php";
include "header.php";



function atualizarpaginaatual() {
    $arquivoaberto = debug_backtrace()[0]['file'];
    $_SESSION["PAGINA-ATUAL"] = $arquivoaberto;

    return true;
}



