<?php
include "../../essenciais/iniciar.php";
$logado = islogged();

?>

<body class="cetralizado-flex lateral-mobile-cima" style="background: linear-gradient( to right bottom ,var(--cor-principal) ,var(--cor-segundaria) )">


    <div style="position: absolute; bottom: 4rem;  font-weight: bolder" class="centralizado-flex container-mobile fundo-vermelho bordas-arredondadas letra-branco">
        <?php
        foreach ($_GET as $elemento => $valor) {
            if (!(isset($valor) and strlen($valor))) {

            } else {
                if ($elemento === "login") {
                    echo "<div style='padding: 1rem'>Login Incorreto. verifique sua senha e nome de usuário!</div>";
                }
                else{
                    echo "<div style='padding: 1rem'> $valor </div>";
                }
            }
        }
        ?>
    </div>


    <section class=" container-mobile formulario fundo-branco-transparente cetralizado-flex bordas-arredondadas" style="padding: 1rem;border: 1px solid whitesmoke; ">
            <h2 class="separar-baixo">Bem vindo de volta!</h2>
            <form method="post" target="_self" action="checarlogin.php?login=logando" >
                <div>
                    <label for="login">Email da conta:</label>
                    <input name="login"/>
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <input name="senha" type="password"/>
                </div>
                <div class="botao-formulario" style="margin: 1rem 0rem 1rem 0rem; ">
                    <input class="manter-na-linha " style="margin: 0rem 5px 0 0;" type="submit" value="Logar-se">
                    <input class="manter-na-linha" type="reset" value="Limpar">
                </div>
            </form>
        <a href="#">Esqueci minha senha</a>
    </section>
    <aside class="container-mobile-longo-curto fundo-branco-transparente bordas-arredondadas" style="border: 1px solid whitesmoke ;padding: .1rem; align-items: center;">
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
                        <a> Deslogar </a>
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

</body>