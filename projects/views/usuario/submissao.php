<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Redirecionamento • Submissão</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <div class="container">
            <h1  class="text-center titulos form-group">Submissão</h1>
            <div>                
                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-book-open" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 2.5em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <h4>Título do Trabalho</h4>
                        <p class="lead"><?php echo $submissao->get_titulo(); ?></p>
                    </div>
                </div>

                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-users" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 2.5em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <h4>Autores</h4>
                        <p class="lead"><?php echo $submissao->get_autores(); ?></p>
                    </div>
                </div>

                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-university" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <h4>Instituição</h4>
                        <p class="lead"><?php echo $submissao->get_instituicao(); ?></p>
                    </div>
                </div>

                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-stream" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 2.5em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <h4>Área</h4>
                        <p class="lead"><?php echo $submissao->get_area(true); ?></p>
                    </div>
                </div>

                <?php if ($submissao->get_subm_status() == "C") { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-11">
                            <div class="alert alert-warning text-center">
                                <h4 class="alert-heading">
                                    Atenção!
                                </h4>
                                Para computadores, após o reenvio dos arquivos, caso o PDF não
                                seja atualizado por favor aperte
                                <strong>Ctrl + F5</strong> na guia de exibição
                                desse arquivo.
                            </div>
                        </div>
                    </div>
                    <form class="form" method="post" id="form" novalidate>
                    <?php } ?>
                    <div class="row justify-content-md-around form-group">
                        <div class="col-md-5 form-group">
                            <div class="row justify-content-center">
                                <div class="col-2 rounded-left bg-dark text-center">
                                    <i class="fas fa-file-pdf" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                                </div>
                                <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px; padding-bottom: 4vh;">
                                    <h4>WORD</h4>
                                    <a href="<?php echo $docx; ?>" class="btn btn-outline-dark" style="margin-bottom: 3vh;">
                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                        Download
                                    </a>
                                    <?php if ($submissao->get_subm_status() == "C") { ?>
                                        <div class="custom-file form-group">
                                            <input lang="pt-br" type="file" class="custom-file-input" id="arquivo_docx" name="arquivos[]" required>
                                            <label for="arquivo" class="custom-file-label" id="arquivo_docx-label">
                                                Selecione um novo arquivo
                                            </label>
                                            <div class="invalid-feedback" id="arquivo_docx-feedback">
                                                Um arquivo deve ser selecionado!
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>                         
                        </div>
                        <div class="col-md-5">
                            <div class="row justify-content-center">
                                <div class="col-2 rounded-left bg-dark text-center">
                                    <i class="fas fa-file-word" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                                </div>
                                <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px; padding-bottom: 4vh;">
                                    <h4>PDF</h4>
                                    <a href="<?php echo $pdf; ?>" target="_blank" class="btn btn-outline-dark" style="margin-bottom: 3vh;">
                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                        Download
                                    </a>
                                    <?php if ($submissao->get_subm_status() == "C") { ?>
                                        <input type="hidden" id="max-filesize" value="<?php echo MAX_DOCUMENTSIZE; ?>">
                                        <div class="custom-file">
                                            <input lang="pt-br" type="file" class="custom-file-input" id="arquivo_pdf" name="arquivos[]" required>
                                            <label for="arquivo" class="custom-file-label" id="arquivo_pdf-label">
                                                Selecione um novo arquivo
                                            </label>
                                            <div class="invalid-feedback" id="arquivo_pdf-feedback">
                                                Um arquivo deve ser selecionado!
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($submissao->get_subm_status() == "C") { ?>
                        <div class="row justify-content-center form-group">
                            <div class="col-auto">
                                <div class="row justify-content-center">
                                    <button type="submit" id="submit" class="btn btn-outline-dark">
                                        <i class="fas fa-arrow-alt-circle-up"></i>
                                        Upload dos arquivos novos
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>

                <div class="row justify-content-md-around form-group">
                    <div class="col-md-5 form-group">
                        <div class="row justify-content-center">
                            <div class="col-2 rounded-left bg-dark text-center">
                                <i class="fas fa-plus-square" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                            </div>
                            <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                                <h4>Nota</h4>
                                <p class="lead"><?php if ($submissao->get_nota()) echo $submissao->get_nota(true); ?></p>
                            </div>
                        </div>                         
                    </div>
                    <div class="col-md-5">
                        <div class="row justify-content-center">
                            <div class="col-2 rounded-left bg-dark text-center">
                                <i class="fas fa-award" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                            </div>
                            <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                                <h4>Status</h4>
                                <p class="lead"><?php echo $submissao->get_subm_status(true); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-comment-alt" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 2.5em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <h4>Comentário</h4>
                        <textarea placeholder="Comentário sobre o trabalho." class="form-group col-12" name="comentario" id="comentario" rows="10" readonly><?php if ($submissao->get_comentario()) echo $submissao->get_comentario(); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-confirmacao" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-confirmacao">
                            Confirmação de proposta
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            O trabalho será submetido para ser avaliado.
                            Certifique-se que os dados foram inseridos corretamente,
                            pois não será possível fazer edições após o envio
                            da proposta. Se, após o envio, houver alguma informação
                            equivocada a proposta atual poderá ser cancelada
                            e assim submeter uma nova. Confirmar o envio?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </button>
                        <button type="button" id="btn-confirmar-envio" class="btn btn-outline-success">
                            <i class="fas fa-check"></i>
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Enviando trabalho...
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="progress" id="progress-bar">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted" style="margin-bottom: 3vh;">
                        </div>
                        <p class="lead" id="texto-sucesso">
                            O trabalho foi enviado para avaliação.
                            Você pode acompanhar o status atual
                            da avaliação no <a href="usuario/">seu painel</a>,
                            bem como enviar novos trabalhos ou
                            cancelá-los.
                        </p>
                        <p class="lead" id="texto-erro">
                            Ops. O arquivo enviado não esta conforme os requisitos!
                            Verifique as informações e tente novamente!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-success" href="usuario/">
                            OK
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once DIR_ROOT . 'common/modal-erro-validacao.php';
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <script type="text/javascript" src="assets/js/form-validacao.js"></script>
        <script>

            $(document).ready(function () {

                // File uploader
                $('#btn-confirmar-envio').click(function () {

                    $("#modal-upload .progress-bar").prop("style", "width: 0;");
                    $("#modal-upload .progress-bar").html();
                    $("#modal-upload .progress-bar").addClass("progress-bar-striped progress-bar-animated");
                    $("#modal-upload .progress-bar").removeClass("bg-danger").removeClass("bg-success");
                    $("#texto-erro").addClass("collapse");
                    $("#texto-sucesso").addClass("collapse");
                    $("#modal-upload .close").addClass("collapse");
                    $("#modal-upload .modal-footer .btn").addClass("collapse");
                    $("#modal-confirmacao").modal('hide');
                    $("#submit").attr('disabled', 'true');
                    $("#modal-upload").modal({
                        backdrop: 'static'
                    });

                    //Guarda os campos do formulario em formdata
                    var formdata = new FormData(document.getElementById("form"));

                    //inicia requisição AJAX
                    var request = new XMLHttpRequest();

                    request.upload.addEventListener('progress', function (e) {
                        var percent = Math.round(e.loaded / e.total * 100);
                        $("#modal-upload .progress-bar").prop("style", "width: " + Math.round(percent) + "%;");
                        $("#modal-upload .progress-bar").html(percent + " %");
                        $("#modal-upload .text-muted").html(Math.round(e.loaded / 1024) + " KB enviados de " + Math.round(e.total / 1024) + " KB totais");
                    });

                    request.onreadystatechange = function () {
                        // Define o que acontece quando o upload termina
                        if (this.readyState === 4 && this.status === 200) {
                            if (request.responseText === 'S') {
                                $("#modal-upload .progress-bar").removeClass("progress-bar-striped progress-bar-animated").addClass("bg-success");
                                $("#modal-upload .modal-title").html("Formulário enviado!");
                                $("#texto-sucesso").removeClass("collapse");
                                $("#modal-upload .modal-footer .btn").removeClass("collapse");
                            } else {
                                $("#modal-upload .progress-bar").removeClass("progress-bar-striped progress-bar-animated").addClass("bg-danger");
                                $("#modal-upload .modal-title").html("Formulário não enviado");
                                $("#texto-erro").removeClass("collapse")
                                $("#modal-upload .close").removeClass("collapse");
                                $("#submit").removeAttr("disabled");
                            }
                            //setTimeout("window.open(self.location, '_self');", 2000);
                        }
                    };

                    // Define o destino dos dados de formulário
                    request.open("POST", "<?php echo SERVER_NAME . "usuario/submissao.php?id=$id"; ?>");
                    request.send(formdata);
                });
            });

            $("#arquivo_docx").change(function () {
                validar_arquivo($(this), "docx");
            });

            $("#arquivo_pdf").change(function () {
                validar_arquivo($(this), "pdf");
            });

            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                    var forms = document.getElementsByClassName('form');
                    // Faz um loop neles e evita o envio
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            event.preventDefault();
                            event.stopPropagation();
                            if (form.checkValidity() === false) {
                                $("#modal-erro").modal({
                                    backdrop: 'static'
                                });
                            } else {
                                $("#modal-confirmacao").modal({
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
