<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Redirecionamento - Admin • Submissão</title>
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
                
                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-book-reader" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <h4>Avaliador</h4>
                        <select class="form-group custom-select" name="avaliador" id="avaliador">
                            <option value="0">Sem avaliador</option>
                            <?php foreach($avaliadores as $aval) { ?>
                                <option value="<?php echo $aval->get_aval_id(); ?>"
                                <?php if (isset($avaliador) && $avaliador == $aval) echo "selected"; ?>>
                                    <?php echo $aval->get_nome(); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div id="aval_alert" style="display: none;" class="form-group text-center alert alert-success" role="alert">
                            <strong>Avaliador alterado com sucesso!</strong>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-md-around">
                    <div class="col-md-5 form-group">
                        <div class="row justify-content-center">
                            <div class="col-2 rounded-left bg-dark text-center">
                                <i class="fas fa-file-pdf" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                            </div>
                            <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                                <h4>PDF</h4>
                                <a href="<?php echo $pdf; ?>" target="_blank" class="btn btn-outline-dark" style="margin-bottom: 3vh;">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                    Download
                                </a>
                            </div>
                        </div>                         
                    </div>
                    <div class="col-md-5 form-group">
                        <div class="row justify-content-center">
                            <div class="col-2 rounded-left bg-dark text-center">
                                <i class="fas fa-file-word" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                            </div>
                            <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                                <h4>WORD</h4>
                                <a href="<?php echo $docx; ?>" class="btn btn-outline-dark" style="margin-bottom: 3vh;">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row justify-content-md-around form-group">
                    <div class="col-md-5 form-group">
                        <div class="row justify-content-center">
                            <div class="col-2 rounded-left bg-dark text-center">
                                <i class="fas fa-plus-square" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 3em;"></i>
                            </div>
                            <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                                <div class="row">
                                    <div class="col-auto">
                                        <h4>Nota</h4>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-group" name="nota" id="nota" maxlength="5"
                                            value="<?php if($submissao->get_nota()) echo $submissao->get_nota(true);?>">
                                    </div>
                                </div>
                                <button type="button" id="submit_nota" class="btn btn-outline-dark form-group">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                                <div id="nota_alert" style="display: none;" class="form-group text-center alert alert-success form-group" role="alert">
                                    <strong>Nota alterada com sucesso!</strong>
                                </div>
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
                                <select class="form-control form-group" name="status" id="status">
                                    <option value="E" >Em Andamento</option>
                                    <option value="C" <?php if($submissao->get_subm_status() == "C") echo "selected";?>>Em Correção</option>
                                    <option value="R" <?php if($submissao->get_subm_status() == "R") echo "selected";?>>Reprovado</option>
                                    <option value="A" <?php if($submissao->get_subm_status() == "A") echo "selected";?>>Aprovado</option>
                                </select>
                                <div id="status_alert" style="display: none;" class="form-group text-center alert alert-success" role="alert">
                                    <strong>Status alterado com sucesso!</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center form-group">
                    <div class="col-2 rounded-left bg-dark text-center">
                        <i class="fas fa-comment-alt" style="margin-top: 4vh; color: rgb(255,199,0); font-size: 2.5em;"></i>
                    </div>
                    <div class="col-8 border border-dark rounded-right bg-white" style="padding-top: 6px;">
                        <div id="comentario_alert" style="display: none;" class="form-group text-center alert alert-success" role="alert">
                        <strong>Comentário alterado com sucesso!</strong>
                    </div>
                        <h4>Comentário</h4>
                        <textarea class="form-control form-group col-12" name="comentario" id="comentario" rows="10" placeholder="Comente sobre o trabalho."><?php if($submissao->get_comentario()) echo $submissao->get_comentario(); ?></textarea>
                        <button type="button" id="submit_comentario" class="btn btn-outline-dark form-group">
                            <i class="fas fa-save"></i>
                            Salvar
                        </button>
                    </div>
                </div> 
                
            </div>
        </div>

        <?php require_once DIR_ROOT . 'common/script.php'; ?>
        <script type="text/javascript" src="assets/js/form-validacao.js"></script>
        <script>
            $(document).ready(function () {
                $("#avaliador").change(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo  "admin/submissao.php?id=" . $id; ?>",
                        data: $(this),
                        success: function(){
                            $("#aval_alert").fadeIn("slow");
                            $("#aval_alert").delay(1500).fadeOut("slow");
                        }
                    });
                });
                $("#status").change(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo  "admin/submissao.php?id=" . $id; ?>",
                        data: $(this),
                        success: function(){
                            $("#status_alert").fadeIn("slow");
                            $("#status_alert").delay(1500).fadeOut("slow");
                        }
                    });
                });
                $("#submit_comentario").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo  "admin/submissao.php?id=" . $id; ?>",
                        data: $("#comentario"),
                        success: function(){
                            $("#comentario_alert").fadeIn("slow");
                            $("#comentario_alert").delay(1500).fadeOut("slow");
                        }
                    });
                });
                $("#submit_nota").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo "admin/submissao.php?id=" . $id; ?>",
                        data: $("#nota"),
                        success: function () {
                            $("#nota_alert").fadeIn("slow");
                            $("#nota_alert").delay(1500).fadeOut("slow");
                        }
                    });
                });
            });
        </script>
    </body>
</html>