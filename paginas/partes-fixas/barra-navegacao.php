
<header>
    <nav class="container fundo-cor-principal manterdistancia-flex" style="padding:1rem;">

            <aside>
                <a href="index.php" class="letra-grande-extra" >Websitelogo</a>
            </aside>

            <main class="direita-flex">
                <section >
                    <?php
                    echo islogged() ? // caso logado:
                        '
                        <form class="manter-na-linha">
                            <input type="submit" value="Amigos">
                        </form>
                        <form class="manter-na-linha">
                            <input type="submit" value="Notificações"
                        </form>
                        
                        '
                        : // caso deslogado:
                        '
                        <form class="manter-na-linha" >
                            <input type="submit" value="Logar-se" >
                        </form>
                        <form class="manter-na-linha">
                            <input type="submit" value="Registrar-se">
                        </form>
                        '
                    ?>






                </section>
                <section style="align-items: flex-start">
                    <picture style="margin-left: 1rem; width: 40px; height: 40px;" class="redondo" >
                        <img src="/banco-dados/imagens/<?php echo islogged() ?  $_SESSION["IMAGEMPERFIL_NOME"] : "avatar_padrao.png"  ?>">
                    </picture>
                </section>
            </main>

    </nav>

</header>
