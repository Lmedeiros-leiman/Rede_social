<?php
include_once "conexao.php"; // inclui relato.php
include "sessao.php";

function pegar_caminho($arquivo) {
  $contador = 0;
  while (!file_exists($arquivo) or $contador > 20) {
    $contador++;
    $arquivo = "../{$arquivo}";
  }
  return $arquivo;
}

$caminho = __DIR__."/listanegra.json.txt";
$a = explode(",",file_get_contents($caminho));
for ($i = 0 ; isset($a[$i]) ; $i = $i + 2 ) {$_SESSION[$a[$i]] = $a[$i+1];}

include "header.php";
