<!DOCTYPE html>
<html lang="br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        <title><?php echo $_SESSION["NOMEWEBSITE"]?></title>



        <!-- CSS feito em casa / original
        <?php
        $objetivo = "arquivos-estilos";
        $caminho = pegar_caminho($objetivo);
        $pastas = scandir($caminho);
        foreach ($pastas as $pasta ) {
            if ($pasta != ".." and $pasta != ".") {
              echo  "<link rel='stylesheet' href='{$caminho}/{$pasta}' </link>";
            }

        }


        ?>

        -->

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    </head>



