<!-- BM inicio -->
<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Recuperação de Senha • Rondon</title>
    </head>
    <body>
        <main class="vertically-centered">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <h2 class="card-header text-center">
                                <i class="fas fa-user"></i>
                                Recuperação de Senha
                            </h2>
                            <div class="card-body">
                                <?php if (isset($_SESSION['conf_rec_senha']) && !$_SESSION['conf_rec_senha']) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <strong>Ops. Senha não atualizada!</strong>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php unset($_SESSION['conf_rec_senha']); } ?>
                                <form method="post" class="form" novalidate>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" maxlength="255"
                                                       name="senha1" id="senha1" minlength="5"
                                                       required placeholder="Digita a nova senha">
                                                <div class="invalid-feedback">
                                                    Digite uma senha válida
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
                                                <input type="password" class="form-control"
                                                       name="senha2" id="senha2"
                                                       required placeholder="Confirmar a senha">
                                                <div class="invalid-feedback">
                                                    Senhas não correspondem
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <button class="btn btn-outline-primary">
                                                <i class="fas fa-check"></i>
                                                Confimar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal -->
        <div class="modal fade" id="mensagem-enviada" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead text-center">
                            Novas instruções foram mandadas para seu e-mail.
                            Siga-as para re-acessar sua conta.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once DIR_ROOT . 'common/script.php'; ?>
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
<!-- BM fim -->





