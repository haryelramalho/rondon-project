<!DOCTYPE html>
<html>

    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Inscrição de propriedade • Rondon</title>
    </head>

    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <form method="post" class="form" id="form-hospedagem" novalidate enctype="multipart/form-data">
                <?php require_once DIR_ROOT . 'common/endereco.php'; ?>
                <div class="card form-group">
                    <h2 class="card-header">
                        <i class="fas fa-images"></i>
                        Imagens do imóvel
                    </h2>
                    <div class="card-body">
                        <input type="hidden" id="max-filesize" value="<?php echo MAX_IMAGESIZE; ?>">
                        <p class="text-muted text-center">
                            Formatos de foto permitidos: jpeg e png.
                            Tamanho máximo de cada foto: <?php echo MAX_IMAGESIZE; ?> MB
                        </p>
                        <?php for ($i = 1; $i <= QTD_FOTOS; $i++) { ?>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input lang="pt-br" type="file" class="custom-file-input" id="foto<?php echo $i ?>" name="fotos[]" required accept="image/jpeg,image/png">
                                    <label for="foto<?php echo $i ?>" class="custom-file-label" id="foto<?php echo $i ?>-label">
                                        Selecione uma foto
                                    </label>
                                    <div class="invalid-feedback" id="foto<?php echo $i ?>-feedback">
                                        Uma imagem deve ser selecionada!
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="lead" for="descricao">Descrição</label>
                    <textarea class="form-control" rows="3" name="descricao" id="descricao" required minlength="5" maxlength="500" placeholder="Descreva os cômodos do imóvel, lotação e demais características que julgar necessário"></textarea>
                    <p class="text-muted text-center">
                            Não esquecer de informar a capacidade máxima de pessoas que o local comporta.
                        </p>
                    <div class="invalid-feedback">
                        Informe uma descrição do imóvel!
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="preco" class="lead">Preço da diária</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" class="form-control form-control-lg" name="preco" id="preco" required pattern="[0-9][.]{0,1}[0-9]{0,3}[,][0-9]{2}">
                            <div class="invalid-feedback">
                                Informe o preço da diária no formato indicado!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="termos_textarea"><b>Termos e Condições de Uso do Módulo de Reservas de Hospedagem Social do IV Congresso Nacional do Projeto Rondon.</b></label>
                    <textarea class="form-control" id="termos_textarea" rows="5" disabled>
                        <?php
                        $arquivo = file(DIR_ROOT . 'assets/arquivos/termos.txt', FILE_TEXT);
                        foreach ($arquivo as $imprime) {
                            echo $imprime;
                        }
                        ?>
                    </textarea>
                </div>
                <div class="col-md-6 form-group custom-control custom-checkbox">
                    <div class="">
                        <input type="checkbox" class="custom-control-input" id="checkBoxTermos" required>
                        <label class=" custom-control-label" for="checkBoxTermos">
                            Li e concordo com os
                            <a href="assets/arquivos/termos_hospedagem.docx" download="termos_hospedagem.pdf">
                                termos
                            </a>
                            de uso e políticas de privacidade.
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-auto form-group">
                        <a href="usuario/" class="btn btn-warning form-group">
                            <i class="far fa-arrow-alt-circle-left">Voltar</i>
                        </a>
                    </div>
                    <div class="col-auto form-group">
                        <button type="submit" id="submit" class="btn btn-outline-dark">
                            <i class="fas fa-location-arrow"></i>
                            Enviar
                        </button>
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
                            A proposta será enviada por email para ser avaliada.
                            Certifique-se que os dados foram inseridos corretamente,
                            pois não será possível fazer edições após o envio
                            da proposta. Se, após o envio, houver alguma informação
                            equivocada a solução será cancelar a proposta atual
                            e submeter uma nova. Confirma o envio?
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
                            Eviando formulário ...
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
                            A proposta foi enviada para avaliação.
                            Você pode acompanhar o status atual
                            da proposta no <a href="usuario/">seu painel</a>,
                            bem como enviar novas propostas ou
                            cancelà-las.
                        </p>
                        <p class="lead" id="texto-erro">
                            Ops. As fotos enviadas não estão conforme os requisitos!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-success" href="usuario/">
                            Ok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once DIR_ROOT . 'common/modal-erro-validacao.php';
        require_once DIR_ROOT . 'common/footer.php';
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <script type="text/javascript" src="assets/js/form-validacao.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $("#btn-confirmar-envio").click(function () {

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
                    var formdata = new FormData(document.getElementById("form-hospedagem"));

                    //inicia requisição AJAX
                    var request = new XMLHttpRequest();

                    //Adiciona função a ser executada durante o progresso
                    //do upload
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
                    request.open("POST", "<?php echo SERVER_NAME . "usuario/inscricao_imovel.php"; ?>");
                    request.send(formdata);
                });
            });
<?php for ($i = 1; $i <= QTD_FOTOS; $i++) { ?>
                $("#foto<?php echo $i; ?>").change(function () {
                    file_validate($(this), <?php echo $i ?>);
                });
<?php }
?>
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