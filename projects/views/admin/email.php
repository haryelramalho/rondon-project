<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Comunicação - Admin • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php' ?>
        <div class="container">
            <h1 style="margin: -7px 0 14px" class="text-center titulos">Comunicados</h1>
            <form method="post" class="col-12 form">
                <div class="row justify-content-center">
                    <div class="col-10 form-group">
                        <input name="assunto" type="text" class="form-control<?php echo ($erros['assunto']) ? ' is-invalid' : '' ?>" placeholder="Assunto" value="<?php echo $assunto; ?>">
                        <div class="invalid-feedback">
                            <?php echo $erros['assunto']; ?>
                        </div>
                    </div>
                    <div class="row col-10 form-group">
                        <textarea class="form-control <?php echo ($erros['mensagem']) ? ' is-invalid' : '' ?>" id="msg_email" name="mensagem" placeholder="Mensagem" rows="5"></textarea>
                        <div class="invalid-feedback">
                            <?php echo $erros['mensagem']; ?>
                        </div>
                    </div>
                    <div class="row justify-content-md-end col-10">
                        <button name="submit" type="submit" id="submit" value="0" class="btn btn-outline-dark">
                            <i class="fas fa-location-arrow"></i>
                                Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>

            <?php if (isset($_SESSION["email_enviado"])) { ?>
                <div class="modal fade" id="modal-email-contato" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-<?php echo ($_SESSION["email_enviado"]) ? 'success' : 'danger'; ?>"
                                    role="alert">
                                    <h4 class="alert-heading">
                                        <?php
                                        echo ($_SESSION["email_enviado"]) ?
                                                'Mensagem enviada com suceso!' :
                                                'Mensagem não enviada!';
                                        ?>
                                    </h4>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-<?php echo ($_SESSION["email_enviado"]) ? 'success' : 'danger'; ?>"
                                                data-dismiss="modal">
                                            <i class="fas fa-times"> Ok</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php } 
            
            require_once DIR_ROOT . 'common/script.php';
            
            if (isset($_SESSION["email_enviado"])) { ?>
                <script>
                    $(document).ready(function () {
                        $("#modal-email-contato").modal();
                    });
                </script>
                <?php
                unset($_SESSION["email_enviado"]);
                }
            ?>

    </body>
</html>

