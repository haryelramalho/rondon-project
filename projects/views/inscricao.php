<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Inscrição • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <div class="container">
            <form method="post" class="form" novalidate>
                <div class="card form-group">
                    <h2 class="card-header text-center">
                        <i class="fas fa-user-cog"></i>
                        Formulário de inscrição
                    </h2>
                    <div class="card-body">
                        <?php if (isset($erros['email'])) { ?>
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <h6 class="text-center"><strong>Email informado já existe!</strong></h6>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($erros['cpf'])) { ?>
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <h6 class="text-center"><strong>CPF informado é inválido!</strong></h6>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION["inscricao1_realizada"]) && $_SESSION["inscricao1_realizada"]) { ?>
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <h4 class="">Inscrição realizada com sucesso!</h4>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <hr/>
                                        <p class="lead">
                                            Acesse o seu e-mail e siga as instruções para efetuar o primeiro acesso. 
                                        </p>
                                        <p>
                                            Caso o e-mail não esteja na Caixa de Entrada verifique o "Lixo Eletrônico" e o "Spam".
                                        </p>
                                    </div>    
                                </div>
                            </div>
                            <?php
                            unset($_SESSION["inscricao1_realizada"]);
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
                                <input type="tel" value="<?php echo $cpf; ?>"
                                       class="form-control" required
                                       id="cpf" name="cpf" placeholder="000.000.000-00">
                                <div class="invalid-feedback">
                                    Informe um CPF válido!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $email; ?>"
                                       class="form-control"
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
                <div class="row justify-content-md-end justify-content-center">
                    <div class="form-group col-auto">
                        <button type="submit" id="submit" class="btn btn-outline-dark">
                            <i class="fas fa-user-plus"></i>
                            Inscrever
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="modal-andamento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inscrição em andamento</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            Estamos enviando instruções ao seu email para
                            fins de confirmação de conta. Esse processo pode
                            levar alguns segundos. Aguarde...
                        </p>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                $("#modal-andamento").modal({
                                    backdrop: 'static'
                                });
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>
