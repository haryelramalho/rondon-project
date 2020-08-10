<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Submissão de Trabalhos Acadêmicos • Rondon</title>
    </head>

    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <form class="form" id="form-trabalho" method="post" enctype="multipart/form-data" novalidate>
                <div class="card form-group">
                    <h2 class="card-header">
                        <i class="fas fa-file-upload"></i>
                        Submissão de Trabalhos Acadêmicos
                    </h2>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titulo">Título do Trabalho</label>
                            <input type="text" name="titulo" id="titulo" class="form-control needs-validation" required>
                        </div>

                        <div class="form-group" id="listas">
                            <div class="row form-group">
                                <label class="mr-2 ml-3" for="autores">Autores</label>

                            </div>

                            <input type="text" class="form-control needs-validation"
                                   id="nomes" readonly
                                   value="<?php echo $_SESSION['usuario']['nome']; ?>">
                        </div>

                        <div class="row justify-content-center">
                            <button class="btn btn-primary btn-sm col-auto form-group" id="add_field" type="button">
                                <i class="fas fa-plus"></i>
                                Adicionar membro
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="area">Área</label>
                            <select name="area" id="area" class="form-control" required>
                                <option></option>
                                <option value="1">Cultura</option>
                                <option value="2">Direitos Humanos e Justiça</option>
                                <option value="3">Educação</option>
                                <option value="4">Saúde</option>
                                <option value="5">Comunicação</option>
                                <option value="6">Tecnologia e Produção</option>
                                <option value="7">Meio Ambiente</option>
                                <option value="8">Trabalho</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecione uma área!
                            </div>
                        </div>

                        <div class="card card-body">
                            <input type="hidden" id="max-filesize" value="<?php echo MAX_DOCUMENTSIZE; ?>">

                            <p class="text-muted text-center">
                                Tamanho máximo de cada arquivo: <?php echo MAX_DOCUMENTSIZE; ?> MB
                            </p>

                            <div class="form-group">
                                <label for="arquivo_docx">Arquivo WORD</label>
                                <div class="custom-file">
                                    <input lang="pt-br" type="file" class="custom-file-input" id="arquivo_docx" name="arquivos[]" required>
                                    <label for="arquivo" class="custom-file-label" id="arquivo_docx-label">
                                        Selecione um arquivo
                                    </label>
                                    <div class="invalid-feedback" id="arquivo_docx-feedback">
                                        Um arquivo deve ser selecionado!
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="arquivo_pdf">Arquivo PDF</label>
                                <div class="custom-file">
                                    <input lang="pt-br" type="file" class="custom-file-input" id="arquivo_pdf" name="arquivos[]" required>
                                    <label for="arquivo" class="custom-file-label" id="arquivo_pdf-label">
                                        Selecione um arquivo
                                    </label>
                                    <div class="invalid-feedback" id="arquivo_pdf-feedback">
                                        Um arquivo deve ser selecionado!
                                    </div>
                                </div>
                            </div>
                            
                            <textarea class="form-control" id="termos_textarea" rows="5" disabled>
                            <?php
                                $arquivo = file(DIR_ROOT . 'assets/arquivos/submissao_lembrete.txt', FILE_TEXT);
                                foreach ($arquivo as $imprime) {
                                    echo $imprime;
                                }
                            ?>
                            </textarea>
                        </div>

                        <hr/>
                        <div class="row justify-content-center">
                            <button class="btn btn-success col-auto form-group" id="enviar" type="submit">
                                <i class="fas fa-check"></i>
                                Submeter Trabalho
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>

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
                            Eviando trabalho...
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
                var campos_min = 1; // min de 1 campos
                var campos_max = 10; // max de 10 campos   
                var x = <?php echo $qtd_nomes + 1 ?>; // campos iniciais

                $('#add_field').click(function (e) {
                    e.preventDefault(); //prevenir novos clicks
                    if (x < campos_max) {
                        $('#listas').append(
                                '<div class="input-group mb-3 mt-3">\
                                    <input type="text" class="form-control" id="nomes" name="nomes[]" placeholder="Nome do membro" aria-describedby="button-addon2" required minlength="3" maxlength="255">\
                                    <btn-remover class="input-group-append">\
                                        <button class="btn btn-outline-danger remover_campo" type="button" id="button-addon2">Remover</button>\
                                    </btn-remover>\
                                    <div class="invalid-feedback">Informe um nome válido</div>\
                                </div>');
                    } else {
                        $("#modal-limites").modal();
                    }
                });

                // Remover o div anterior
                $('#listas').on("click", ".remover_campo", function (e) {
                    e.preventDefault();
                    $(this).closest('div').remove();
                    x--;
                });

                /*
                 $(".form").on('submit', function (e) {
                 if (!$(this)[0].checkValidity()) {
                 e.preventDefault();
                 $(this).addClass('was-validated');
                 $("#modal-erro").modal({
                 backdrop: 'static'
                 });
                 }
                 }); */

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
                    var formdata = new FormData(document.getElementById("form-trabalho"));

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
                    request.open("POST", "<?php echo SERVER_NAME . "usuario/envia_submissao.php"; ?>");
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