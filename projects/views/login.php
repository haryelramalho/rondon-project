<!-- Ariel inicio -->
<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Login • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="vertically-centered">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <h2 class="card-header text-center">
                                <i class="fas fa-user"></i>
                                Login
                            </h2>
                            <div class="card-body">
                                <?php if (isset($erros['conta'])) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <h4 class="text-center">Conta inativa!</h4>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <hr/>
                                        Verifique seu email para ativá-la
                                    </div>
                                <?php } ?>
                                <?php if (isset($_SESSION['conf_rec_senha']) && $_SESSION['conf_rec_senha']) { ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <strong>Senha atualizada com sucesso!</strong>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php
                                    unset($_SESSION['conf_rec_senha']);
                                }
                                ?>
                                <form method="post">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                </div>
                                                <input type="text" name="email" autofocus
                                                       class="form-control<?php echo ($erros['email'] && !isset($_POST["recuperar-senha"])) ? ' is-invalid' : '' ?>"
                                                       placeholder="E-mail" value="<?php if (!isset($_POST["recuperar-senha"])) echo $email; ?>">
                                                <div class="invalid-feedback">
                                                    <?php if (!isset($_POST["recuperar-senha"])) echo $erros['email']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" name="senha"
                                                       class="form-control<?php echo ($erros['senha']) ? ' is-invalid' : '' ?>"
                                                       placeholder="Senha" value="<?php echo $senha ?>">
                                                <div class="invalid-feedback">
                                                    <?php echo $erros['senha']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <button class="btn btn-outline-dark">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Entrar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <?php if (isset($_SESSION['email_enviado'])) { ?>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-10">
                                            <?php if ($_SESSION['email_enviado']) { ?>
                                                <div class="alert alert-success alert-dismissible fade show">
                                                    <h5 class="text-center">Email de Recuperação Enviado!</h5>
                                                    <p class="text-center">Acesse seu email para recuperar a senha!</p>
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div> 
                                            <?php } else { ?> 
                                                <div class="alert alert-danger alert-dismissible fade show">
                                                    <h5 class="text-center">Email não Enviado!</h5>
                                                    <?php echo $_SESSION["descricao_erro"]; ?>
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div> 
                                                <?php
                                            } unset($_SESSION['email_enviado']);
                                        }
                                        ?>   

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-link"
                                                        data-toggle="collapse"
                                                        data-target="#recuperar-senha"
                                                        aria-expanded="false"
                                                        aria-controls="recuperar-senha">
                                                    Esqueci minha senha
                                                </button>
                                            </div>
                                        </div>
                                        <div class="collapse <?php if (isset($_POST["recuperar-senha"])) echo 'show'; ?>" id="recuperar-senha">
                                            <form method="post" class="form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                        </div>
                                                        <input type="text" name="email" value="<?php echo $email ?>"
                                                               class="form-control form-control-sm <?php echo ($erros['email']) ? ' is-invalid' : '' ?>"
                                                               placeholder="Digite seu e-mail">
                                                        <div class="invalid-feedback">
                                                            <?php echo $erros['email']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="recuperar-senha" value="on">
                                                <div class="row justify-content-end">
                                                    <div class="col-auto">
                                                        <button type="submit" id="submit" class="btn btn-outline-dark btn-sm">
                                                            Recuperar senha
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr />
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <a class="btn btn-link" href="inscricao.php">Inscrever-se</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once DIR_ROOT . 'common/script.php'; ?>

        <script type="text/javascript">
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                    var forms = document.getElementsByClassName('form');
                    // Faz um loop neles e evita o envio
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            $("#submit").attr('disabled', 'true');
                            $("#submit").html("Enviando email ...");
                        }, false);
                    });
                }, false);
            })();
        </script>

    </body>
</html>
<!-- Ariel fim -->
