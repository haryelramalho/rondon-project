<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Painel • Admin</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 style="margin-top: -7px" class="text-center titulos">Painel do Administrador</h1>
            <br/>
            <div class="row">
                <div class="col-md-4">
                    <div class="row justify-content-center">
                        <div class="col-11 bg-dark text-center" style="border-radius: 15px;">
                            <br/>
                            <img class="img-thumbnail rounded-circle" alt="avatar" src="assets/images/avatar_padrao.jpg" style="height: 200px;">
                            <br/>
                            <br/>
                            <h3 style="color: rgb(255,199,0);">Administrador</h3>
                            <br/>
                        </div>
                    </div>
                    <br/>
                    <div class="row justify-content-center">
                        <div class="col-12 btn-group-vertical">
                            <button type="button" class="btn btn-dark"
                                    onclick="window.open('<?php echo SERVER_NAME ?>admin/inscritos.php', '_self');">
                                Inscritos
                            </button>
                            <button type="button" class="btn btn-dark"
                                    onclick="window.open('<?php echo SERVER_NAME ?>admin/email.php', '_self');">
                                Comunicados
                            </button>
                            <button type="button" class="btn btn-dark"
                                    onclick="window.open('<?php echo SERVER_NAME ?>admin/submissoes.php', '_self');">
                                Submissões
                            </button>
                            <button type="button" class="btn btn-dark"
                                    onclick="window.open('<?php echo SERVER_NAME ?>admin/propriedades.php', '_self');">
                                Propriedades
                            </button>
                            <button type="button" class="btn btn-dark"
                                    onclick="window.open('<?php echo SERVER_NAME ?>admin/avaliadores.php', '_self');">
                                Avaliadores
                            </button>
                            <button type="button" class="btn btn-dark">
                                Atrações
                            </button>
                            <button type="button" class="btn btn-danger"
                                    onclick="window.open('<?php echo SERVER_NAME ?>admin/?logout=on', '_self');">
                                Sair
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-2 rounded-left bg-dark text-center"><i class="fas fa-user-tag" style="margin-top: 4vh; color: rgb(255,199,0);"></i></div>
                                <div style="padding-top: 6px" class="col-8 border border-dark rounded-right bg-white">
                                    <h4>Avaliadores</h4>
                                    <p class="lead">
                                        <?php echo $qtd_avaliadores; ?>
                                    </p>
                                </div>
                            </div>
                            <br/>
                            <div class="row justify-content-center">
                                <div class="col-2 rounded-left bg-dark text-center"><i class="fas fa-newspaper" style="margin-top: 4vh; color: rgb(255,199,0);"></i></div>
                                <div style="padding-top: 6px" class="col-8 border border-dark rounded-right bg-white">
                                    <h4>Submissões</h4>
                                    <p class="lead">
                                        <?php echo $qtd_submissoes; ?>
                                    </p>
                                </div>
                            </div>
                            <br/>
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-2 rounded-left bg-dark text-center"><i class="fas fa-house-damage" style="margin-top: 4vh; color: rgb(255,199,0);"></i></div>
                                <div style="padding-top: 6px" class="col-8 border border-dark rounded-right bg-white">
                                    <h4>Propriedades</h4>
                                    <p class="lead">
                                        <?php echo $qtd_propriedades; ?>
                                    </p>
                                </div>
                            </div>
                            <br/>
                            <!--<div class="row justify-content-center">
                                <div class="col-2 rounded-left bg-dark text-center"><i class="far fa-list-alt" style="margin-top: 4vh; color: rgb(255,199,0);"></i></div>
                                <div style="padding-top: 6px" class="col-8 border border-dark rounded-right bg-white">
                                    <h4>Quantidade Atrações Cadastradas</h4>
                                    <p class="lead">0</p>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <?php
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <br/>
    </body>
</html>
