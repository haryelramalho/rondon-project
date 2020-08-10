<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Atualizar Avatar • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <form method="post" class="form" enctype="multipart/form-data"
                  novalidate>
                <input type="hidden" value="<?php echo MAX_IMAGESIZE ?>" id="max-filesize">
                <div class="card card-body form-group">
                    <p class="text-muted text-center">
                        Formatos de foto permitidos: jpeg e png.
                        Tamanho máximo de cada foto: <?php echo MAX_IMAGESIZE; ?> MB
                    </p>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <div class="custom-file">
                                <input type="file" lang="pt-br"
                                       class="custom-file-input"
                                       id="foto" name="fotos[]"
                                       accept="image/jpeg,image/png"
                                       required>
                                <label for="foto" id="foto-label"
                                       class="custom-file-label">
                                    Selecione uma foto
                                </label>
                                <div class="invalid-feedback" id="foto-feedback">
                                    Uma imagem deve ser selecionada!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-success"
                                    id="submit">
                                <i class="fas fa-check"></i>
                                Alterar foto de perfil
                            </button>
                        </div>
                    </div>
                </div>
                <a class="btn btn-outline-primary" href="usuario/">
                    <i class="fas fa-arrow-left"></i>
                    Voltar ao painel de usuário
                </a>
            </form>
        </main>
        <?php
        require_once DIR_ROOT . 'common/modal-erro-validacao.php';
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <script src="assets/js/form-validacao.js"></script>
        <script>
            $("#foto").change(function () {
                file_validate($(this), '');
            });
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
                                $("#submit").html("Alterando foto de perfil. Aguarde ...");
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>
