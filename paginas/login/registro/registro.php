<?php
include "../../../essenciais/iniciar.php";
$logado = islogged();

?>

<body class="container-total cetralizado-flex lateral-mobile-cima" style="background: linear-gradient( to right bottom ,var(--cor-principal) ,var(--cor-segundaria) ); flex-direction: column">

<section class="container-mobile-longo-curto-cima" style="  ">

    <main class="container-mobile formulario fundo-branco-transparente cetralizado-flex bordas-arredondadas " style="width: available ;max-width: 600px;padding: 1rem;border: 1px solid whitesmoke;">
        <h2>Seja bem vindo!</h2>
        <form method="post" target="_self" action="checarregistro.php" style=" width: 90%;" >

            <section style="width: 100%; margin-top: 1rem; display: flex; flex-direction: row; justify-content: space-between">
                <div style="display: flex; flex-direction: column; width: 45%">
                    <label for="nome_usuario">Nome de usuario:</label>
                    <input name="nome_usuario"/>
                </div>
                <div style="display: flex; flex-direction: column; width: 45%">
                    <label for="apelidado_usuario">Apelido de usuario:</label>
                    <input name="apelidado_usuario"/>
                </div>
            </section>
            <section style="width: 100%; margin-top: 1rem; display: flex; flex-direction: row; justify-content: space-between">
                <div style="display: flex; flex-direction: column; width: 45%">
                    <label for="email_usuario">Email da conta:</label>
                    <input name="email_usuario"/>
                </div>
                <div style="display: flex; flex-direction: column; width: 45%">
                    <label for="telefone_usuario">Telefone (opcional):</label>
                    <input name="telefone_usuario"/>
                </div>
            </section>
            <section style="width: 100%; margin-top: 1rem; display: flex; flex-direction: row; justify-content: space-between">
                <div style="display: flex; flex-direction: column; width: 45%">
                    <label for="senha_usuario">Senha:</label>
                    <input name="senha_usuario"/>
                </div>
                <div style="display: flex; flex-direction: column; width: 45%">
                    <label for="confirmar_senha_usuario">Confirmar Senha:</label>
                    <input name="confirmar_senha_usuario" />
                </div>
            </section>

            <section class="botao-formulario" style="margin: 2rem 0rem 1rem 0rem; ">
                <input class="manter-na-linha " style="margin: 0rem 5px 1rem 0;" type="submit" value="Registrar-se">
                <input class="manter-na-linha"  style="margin: 0rem 5px 1rem 0;" type="reset" value="Limpar">
            </section>
            <div >

            </div>
        </form>
        <a href="../entrar/login.php">Ja possuo um login!</a>
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
                        <a href="p"> Deslogar </a>
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
            if ($valor === "duplicado") {
                echo "<div style='padding: 1rem;'>Nome ou Email ja utilizado. verifique sua senha e nome de usuário!</div>";
            }


        }
    }
    ?>
</section>

</body>

