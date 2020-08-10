<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Redirecionamento • Submissões</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <div class="container">
            <h1  class="text-center titulos form-group">Submissões</h1>
            <table class="table table-striped table-responsive-md dataTable border-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Título</th>
                        <th>Área</th>
                        <th>Instituição</th>
                        <th>Avaliador</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($submissoes); $i++){ ?>
                        <tr>
                            <td>
                                <?php echo $submissoes[$i]->get_titulo(); ?>
                            </td>
                            <td>
                                <?php echo $submissoes[$i]->get_area(true); ?>
                            </td>
                            <td>
                                <?php echo $submissoes[$i]->get_instituicao(); ?>
                            </td>
                            <td>
                                <?php echo $avals[$i]; ?>
                            </td>
                            <td>
                                <?php echo $submissoes[$i]->get_subm_status(true); ?>
                            </td>
                            <td>
                                <a href="admin/submissao.php?id=<?php echo $submissoes[$i]->get_subm_id(); ?>"
                                    class="btn btn-outline-primary" target="_blank">
                                    <i class="fas fa-location-arrow"></i>
                                    Exibir
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div style="padding-top: 20px;" class="row justify-content-center">
                <div class="col-auto">
                    <a href="admin/" class="btn btn-warning">
                        <i class="far fa-arrow-alt-circle-left">Voltar</i>
                    </a>
                </div>
            </div>
        </div>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
    </body>
</html>