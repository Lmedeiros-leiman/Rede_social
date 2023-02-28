<?php
include "../../../essenciais/iniciar.php";
$logado = islogged();

?>

<body class=" container cetralizado-flex lateral-mobile-cima" style="background: linear-gradient( to right bottom ,var(--cor-principal) ,var(--cor-segundaria) ); flex-direction: column">

    <section class="container container-mobile-longo-curto-cima" style=" justify-content: center ">

        <main class="container formulario fundo-branco-transparente cetralizado-flex bordas-arredondadas " style="width: available; max-width: 600px; padding: 1rem;border: 1px solid whitesmoke;">
            <h2 style="padding: 1rem">Bem vindo de volta!</h2>
            <form method="post" target="_self" action="checarlogin.php" >
                    <div>
                        <label for="nome_usuario">Nome ou Email da conta:</label>
                        <input name="nome_usuario"/>
                    </div>
                    <div>
                        <label for="senha_usuario">Senha:</label>
                        <input name="senha_usuario" type="password"/>
                    </div>
                    <div class="botao-formulario" style="margin: 1rem 0rem 1rem 0rem; ">
                        <input class="manter-na-linha " style="margin: 0rem 5px 0 0;" type="submit" value="Logar-se">
                        <input class="manter-na-linha" type="reset" value="Limpar">
                    </div>
                </form>
            <a href="senha_esquecida.php">Esqueci minha senha</a>
            <a href="../registro/registro.php">Não possuo um login</a>
        </main>


        <aside class="menu-lateral linha-por-linha centralizado-flex fundo-branco-transparente bordas-arredondadas" style="border: 1px solid whitesmoke ;align-items: center;">
            <picture style=" width: 40px; height: 40px;" class="redondo" >
                <img src="/banco-dados/imagens/<?php echo $logado ?  $_SESSION["IMAGEMPERFIL_NOME"] : "avatar_padrao.png"  ?>">
            </picture>
            <div>
                <?php
                echo $logado ? // Logado
                    '
                <div class="centralizado-flex" style="flex-direction: column">
                    Logado como:
                    <div>
                       '. $_SESSION["NOME_USUARIO"]. '
                    </div>
                    <div>
                        <a href="../deslogar.php"> Deslogar </a>
                    </div>
                </div>
                '
                    : // Deslogado
                    '
                <div class="centralizado-flex" style="flex-direction: column">
                    Atualmente deslogado
                    
                </div>
                '
                ;?>
            </div>


        </aside>
    </section>

    <section style=" position: relative; display: block; margin-top: 1rem ; font-weight: bolder; text-align: center;" class="container-mobile fundo-vermelho bordas-arredondadas letra-branco">
        <?php
        foreach ($_GET as $elemento => $valor) {
            if (!(isset($valor) and strlen($valor))) {

            } else {
                if ($elemento === "login") {
                    echo "<div style='padding: 1rem'>Login Incorreto. verifique sua senha e nome de usuário!</div>";
                }
                if ($elemento === "loginvalido") {
                    echo "<div style='padding: 1rem;'>
                        Nenhum login encontrado. verifique sua senha e nome de usuário!</div>";
                }

            }
        }
        ?>
    </section>

</body>
