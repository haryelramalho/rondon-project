<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Cadastrar avaliador</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 class="titulos text-center form-group">Cadastrar Avaliador</h1>
            <div class="card card-body">
                <?php if (isset($_SESSION['aval_sucesso'])) { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-11 text-center alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Avaliador cadastrado com sucesso!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <form method="get">
                    <div class="row justify-content-md-around justify-content-center form-group">
                        <div class="col-md-8 form-group">
                            <input type="text" name="email" autofocus placeholder="Digite o email do usuário"
                                   value="<?php echo $email; ?>"
                                   class="form-control <?php if ($erro) echo 'is-invalid'; ?>">
                            <div class="invalid-feedback">
                                <?php echo $erro; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus"></i>
                                Cadastrar avalidador
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <a class="btn btn-warning" href="admin/avaliadores.php">
                            <i class="fas fa-arrow-left"></i>
                            Voltar à tabela de avaliadores
                        </a>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
    </body>
</html>
