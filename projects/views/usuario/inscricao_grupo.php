<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Inscrição de Grupo • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 class="titulos text-center form-group">Cadastro de grupo</h1>
            <form method="post" class="form" novalidate>
                <div class="row justify-content-center">
                    <div class="card card-body col-10 form-group">
                        <label class="text-center">Email do 1º membro (representante): <?php echo $_SESSION['usuario']['email'] ?></label>
                        <div class="email-group">
                            <?php for ($i = 0; $i < $qtd_emails; $i++) { ?>
                                <div class="row justify-content-center input-<?php echo $i + 2 ?>">
                                    <div class="form-group col-md-8">
                                        <input type="email" name="email[]" required
                                               class="form-control
                                               <?php if ($erros[$i]) echo ' is-invalid'; ?>"
                                               placeholder="Email do <?php echo $i + 2; ?>º membro"
                                               value="<?php echo $emails[$i]; ?>">
                                        <div class="invalid-feedback">
                                            <?php
                                            if (isset($erros[$i])) {
                                                echo $erros[$i];
                                            } else {
                                                echo "Um email válido deve ser informado!";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row justify-content-around">
                            <button class="btn btn-primary col-auto form-group" id="add-input" type="button">
                                <i class="fas fa-plus"></i>
                                Adicionar campo
                            </button>
                            <button class="btn btn-danger col-auto form-group" id="rm-input" type="button">
                                <i class="fas fa-times"></i>
                                Remover ultimo campo
                            </button>
                        </div>
                        <hr/>
                        <div class="row justify-content-center">
                            <button class="btn btn-success col-auto form-group" id="rm-input" type="submit">
                                <i class="fas fa-check"></i>
                                Cadastrar membros
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <div class="modal fade" id="modal-limites" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Limites para a inscrição de membros</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body lead">
                        Os grupos devem ser formados por, no mínimo, <?php echo GRUPO_MIN; ?>
                        integrantes e, no máximo, <?php echo GRUPO_MAX; ?> integrantes!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once DIR_ROOT . 'common/modal-erro-validacao.php'; ?>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
        <script>
            $(document).ready(function () {
                var index = <?php echo $qtd_emails + 1; ?>;
                $("#add-input").click(function (e) {
                    e.preventDefault();
                    if (index < <?php echo GRUPO_MAX; ?>) {
                        $(".email-group").append(
                                '<div class="row justify-content-center input-' + ++index + '">' +
                                '<div class="form-group col-md-8 ">' +
                                '<input type="email" name="email[]" class="form-control"' +
                                'placeholder="Email do ' + index + 'º membro" required></div></div>'
                                );
                    } else {
                        $("#modal-limites").modal();
                    }
                });
                $("#rm-input").click(function (e) {
                    e.preventDefault();
                    if (index > <?php echo GRUPO_MIN; ?>) {
                        $(".input-" + index--).remove();
                    } else {
                        $("#modal-limites").modal();
                    }
                });
                $(".form").on('submit', function (e) {
                    if (!$(this)[0].checkValidity()) {
                        e.preventDefault();
                        $(this).addClass('was-validated');
                        $("#modal-erro").modal({
                            backdrop: 'static'
                        });
                    }
                });
            });
        </script>
    </body>
</html>
