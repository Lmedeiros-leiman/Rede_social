 <header class="p-3 text-bg-dark">
     <style>
         input{type="search"}::placeholder { color:lightgrey !important;}

     </style>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">



                <ul class="nav col-12 col-lg-auto me-lg-auto mb-5 justify-content-center mb-md-0">
                    <li>
                        <a href="<?php echo pegar_caminho("principal/index.php");?>" class="navbar-brand  " style="font-size: x-large; text-transform: capitalize; ">
                          <?php echo $_SESSION["NOMEWEBSITE"]?>
                        </a>

                    </li>
                </ul>


                <form style="position: relative;" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark "  placeholder="Buscar..." aria-label="Buscar...">
                    <div style="position: absolute; top: 50%; right: 0.5rem ; transform: translateY(-50%); background: linear-gradient(to right, transparent 14px, transparent <?php //rgb(33,37,41)  ?> ) ; backdrop-filter: blur(2px) ;">
                        <i class="bi bi-search" ></i>
                    </div>
                </form>

                <div class="text-end mb-3 mb-lg-0 me-lg-3">
                    <button type="button" class="btn btn-outline-light me-1">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>

                <div class="dropdown text-end col-2 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <a href="#" class="d-block link-ligth text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="" onerror="this.onerror=null; this.src ='<?php echo pegar_caminho("banco-dados/imagens/avatar_padrao.png");?>'" class="rounded-circle border" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>



            </div>
        </div>
    </header>






    <nav class="container fundo-cor-principal manterdistancia-flex" id="nav-container" style="padding:1rem;">

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
                <section class="centralizado-flex" style="align-items: flex-start">
                    <picture style="margin-left: 1rem; width: 40px; height: 40px;" class="redondo" >
                        <img src="/banco-dados/imagens/<?php echo islogged() ?  $_SESSION["IMAGEMPERFIL_NOME"] : "avatar_padrao.png"  ?>">
                    </picture>
                </section>
            </main>

    </nav>

</header>
