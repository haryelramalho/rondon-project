<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Lista de avaliadores</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 class="titulos text-center form-group">Avaliadores</h1>
            <div class="row justify-content-center">
                <div class="card card-body form-group col-11">
                    <div class="row">
                        <div class="col-auto">
                            <a class="btn btn-success form-group" href="admin/add_avaliador.php">
                                <i class="fas fa-plus"></i>
                                Cadastrar
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-responsive-md dataTable text-center ">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-warning align-middle">Nome</th>
                                        <th class="text-warning align-middle">Email</th>
                                        <th class="text-warning align-middle">Celular</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($avaliadores as $val) { ?>
                                        <tr>
                                            <td class="align-middle"><?php echo $val->get_nome(); ?></td>
                                            <td class="align-middle"><?php echo $val->get_email(); ?></td>
                                            <td class="align-middle"><?php echo $val->get_celular(); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
    </body>
</html>
