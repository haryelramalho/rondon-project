<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Atualizar cadastro</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <form method="post" class="form" novalidate>
                <div class="card form-group">
                    <h2 class="card-header text-center">
                        <i class="fas fa-user-cog"></i>
                        Atualização de cadastro
                    </h2>
                    <div class="card-body">
                        <?php if (isset($_SESSION["atualizacao1_realizada"]) && $_SESSION["atualizacao1_realizada"]) { ?>
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <h4 class="">Atualização realizada com sucesso!</h4>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>    
                                </div>
                            </div>
                            <?php
                            unset($_SESSION["atualizacao1_realizada"]);
                        }
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome"
                                       id="nome" required value="<?php echo $nome ?>"
                                       pattern="([a-zA-Z]|[ ]|ã|â|á|é|ê|ó|ô|í|Á|Ô|É|Ó|Í|ç){5,255}">
                                <div class="invalid-feedback">
                                    Informe um nome válido!
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label for="cpf">CPF</label>
                                <input type="text" value="<?php echo $cpf; ?>"
                                       class="form-control" readonly
                                       id="cpf" name="cpf" placeholder="000.000.000-00"
                                       required pattern="[0-9]{3}[.][0-9]{3}[.][0-9]{3}[-][0-9]{2}">
                                <div class="invalid-feedback">
                                    Informe um CPF válido!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $email; ?>"
                                       class="form-control" readonly
                                       id="email" name="email" required
                                       placeholder="exemplo@email.com"
                                       pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
                                <div class="invalid-feedback">
                                    Informe um e-mail válido!
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label for="celular">Celular</label>
                                <input type="tel" class="form-control" id="celular"
                                       name="celular" placeholder="(00) 00000-0000"
                                       required value="<?php echo $celular; ?>"
                                       pattern="[(][0-9]{2}[)][ ][0-9]{5}-[0-9]{4}">
                                <div class="invalid-feedback">
                                    Informe um número de celular válido!
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label for="telefone">
                                    Telefone
                                    <small class="text-muted"> <i>(opcional)</i></small>
                                </label>
                                <input type="tel" class="form-control" id="telefone"
                                       name="telefone" placeholder="(00) 0000-0000"
                                       pattern="[(][0-9]{2}[)][ ][0-9]{4}-[0-9]{4}"
                                       value="<?php echo $telefone; ?>">
                                <div class="invalid-feedback">
                                    Informe um número de telefone válido! Ou deixe em branco.
                                </div>
                            </div>
                        </div>
                        <div class="card card-body form-group">
                            <p class="text-center text-muted">
                                A senha deve ser composta por, pelo menos,
                                5 letras e/ou números.
                            </p>
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="senha1">Senha</label>
                                    <input type="password" class="form-control" id="senha1"
                                           name="senha1" required
                                           pattern="([a-zA-Z]|[0-9]){5,255}">
                                    <div class="invalid-feedback">
                                        Informe uma senha válida!
                                    </div>
                                </div>
                                <div class="form-group col-md">
                                    <label for="senha2">Confirmar senha</label>
                                    <input type="password" class="form-control" id="senha2"
                                           name="senha2" required>
                                    <div class="invalid-feedback" id="senha2-feedback">
                                        Informe uma senha válida!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-between justify-content-center">
                    <div class="form-group col-auto order-md-first order-last">
                        <a href="usuario/" class="btn btn-outline-danger">
                            <i class="fas fa-times"></i>
                            Cancelar edição
                        </a>
                    </div>
                    <div class="form-group col-auto order-md-last order-first">
                        <button type="submit" id="submit" class="btn btn-outline-primary">
                            <i class="fas fa-check"></i>
                            Atualizar informações
                        </button>
                    </div>
                </div>
            </form>
        </main>
        <?php
        require_once DIR_ROOT . 'common/modal-erro-validacao.php';
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <script type="text/javascript" src="assets/js/form-validacao.js"></script>

        <script type="text/javascript">
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                    var forms = document.getElementsByClassName('form');
                    // Faz um loop neles e evita o envio
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                                $("#modal-erro").modal({
                                    backdrop: 'static'
                                });
                            } else {
                                $("#submit").attr('disabled', 'true');
                                $("#submit").html("Aguarde ...");
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>
