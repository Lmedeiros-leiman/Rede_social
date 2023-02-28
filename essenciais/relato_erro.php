<?php
class relato_erro{
  public function adicionar_relato($mensagem) {

      $data = date("d-m-Y");
      $horario = date("H:i:s");
      $numero = 1;

      $nome_arquivo = "/relatorios_erro/Relatório_Erro_BancoDados_{$data}_{$numero}.txt";
      while (file_exists($nome_arquivo)) {
        $numero++;
        $nome_arquivo = "/relatorios_erro/Relatório_Erro_BancoDados_{$data}_{$numero}.txt";
      }

      $mensagem_erro = " {$data} - {$horario}-> {$mensagem}\n\n";
      $caminhoerro = __DIR__.$nome_arquivo;
      file_put_contents($caminhoerro, $mensagem_erro, FILE_APPEND);

  }




}
$relatorio = new relato_erro();