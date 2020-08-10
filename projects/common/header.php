<nav style="margin-bottom: 3vh;" class="navbar sticky-top navbar-expand-lg bg_menu shadow-lg">
    <a class="navbar navbar-brand" href="index.php"><img src="assets/images/logo_navbar.svg" alt="logo menu"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span><i class="fas fa-align-justify" style="color: rgb(255,199,0);"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto" style="font-family: helvetica-lt, serif;">

            <?php if (isset($home)) { ?>

                <li class="navbar nav-item">
                    <a class="navbar nav-link scroll menu-mob" href="#home"><i class="fas fa-home"></i><p>Home</p></a>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="assets/arquivos/RondonProgramacao.pdf" target="_blank">
                        <i class="fas fa-list-ul"></i>
                        <p>Programação</p>
                    </a>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link scroll menu-mob" href="#inscricoes"><i class="fas fa-user-edit"></i><p>Inscrições</p></a>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link scroll menu-mob" href="#hospedagem"><i class="fas fa-bed"></i><p>Hospedagem</p></a>
                </li>
                <!--<li class="navbar nav-item">
                    <div class="dropdown">
                        <a class="navbar nav-link scroll menu-mob dropdown-toggle" href="#" role="button" id="normas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file"> Normas</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="normas">
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/normas_artigos_resumos.pdf">Artigos/Resumos</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/normas_causos.pdf">Causos</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/normas_minicursos_oficinas.pdf">Minicursos/Oficinas</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/edital_concurso_fotografia.pdf">Concurso Fotografia</a>
                        </div>
                    </div>
                </li>
                <li class="navbar nav-item">
                    <div class="dropdown">
                        <a class="navbar nav-link scroll menu-mob dropdown-toggle" href="#" role="button" id="normas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file"> Trabalhos</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="trabalhos">
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/IV-CONGRESSO-RONDON-AVALIADORES.pdf">Avaliadores</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/IV-CONGRESSO-RONDON-APRESENTACAO-DE-TRABALHOS.pdf">Apresentações de Trabalhos</a>
                        </div>
                    </div>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="https://drive.google.com/open?id=1hEZKLCeVrCh4A_ro5U3F2V-KRsEBwtwq" target="_blank"><i class="fas fa-clipboard-check"> Certificados</i></a>
                </i>-->
                <li class="navbar nav-item">
                    <a class="navbar nav-link scroll menu-mob" href="#contato"><i class="fas fa-comments"></i><p>Contato</p></a>
                </li>

            <?php } else { ?>

                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="#home"><i class="fas fa-home">
                        
                    </i><p>Home</p></a>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="assets/arquivos/RondonProgramacao.pdf" target="_blank">
                        <i class="fas fa-list-ul"> 
                        </i><p>Programação</p>
                    </a>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="#inscricoes"><i class="fas fa-user-edit"></i><p>Inscrições</p></a>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="#hospedagem"><i class="fas fa-bed"></i><p>Hospedagem</p></a>
                </li>
                <!--<li class="navbar nav-item">
                    <div class="dropdown">
                        <a class="navbar nav-link scroll menu-mob dropdown-toggle" href="#" role="button" id="normas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file"> Normas (Submissão)</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="normas">
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/normas_artigos_resumos.pdf">Artigos/Resumos</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/normas_causos.pdf">Causos</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/normas_minicursos_oficinas.pdf">Minicursos/Oficinas</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/edital_concurso_fotografia.pdf">Concurso Fotografia</a>
                        </div>
                    </div>
                </li>
                <li class="navbar nav-item">
                    <div class="dropdown">
                        <a class="navbar nav-link scroll menu-mob dropdown-toggle" href="#" role="button" id="normas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file"> Trabalhos</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="trabalhos">
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/IV-CONGRESSO-RONDON-AVALIADORES.pdf">Avaliadores</a>
                            <a class="dropdown-item" target="_blank" href="assets/arquivos/IV-CONGRESSO-RONDON-APRESENTACAO-DE-TRABALHOS.pdf">Apresentações de Trabalhos</a>
                        </div>
                    </div>
                </li>
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="https://drive.google.com/open?id=1hEZKLCeVrCh4A_ro5U3F2V-KRsEBwtwq" target="_blank"><i class="fas fa-clipboard-check"> Certificados</i></a>
                </li>-->
                <li class="navbar nav-item">
                    <a class="navbar nav-link menu-mob" href="#contato"><i class="fas fa-comments"></i><p>Contato</p></a>
                </li>

            <?php } ?>
        </ul>
        <ul class="nav justify-content-lg-end login">
            <li class="nav-item">
                <a class="navbar nav-link menu-mob" href="login.php">
                    <i class="fas fa-user">
                    </i> 
                    <p>
                        <?php
                            if (isset($_SESSION['usr_admin'])) {
                                echo "Admin";
                            } else if (isset($_SESSION['usuario'])) {
                                echo explode(" ", $_SESSION['usuario']['nome'])[0];
                            } else {
                                echo "Login";
                            }
                        ?>
                    </p>
                </a>
            </li>
        </ul>
    </div>
</nav>
