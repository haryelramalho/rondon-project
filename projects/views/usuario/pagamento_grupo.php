<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Pagamento • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 class="titulos text-center form-group">Lista de membros</h1>
            <div class="row justify-content-center">
                <table class="table table-striped col-11 col-md-10 table-responsive-md">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle text-center">Nome</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Categoria</th>
                            <th class="align-middle text-center">Preço a pagar (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($membros as $membro) { ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <?php echo $membro['nome'] ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo $membro['email'] ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo $membro['categoria'] ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo number_format($membro['preco'], 2, ',', '.') ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-md-around">
                <div class="col-auto text-primary">
                    Subtotal: R$
                    <?php echo number_format($preco_subtotal, 2, ',', '.'); ?>
                </div>
                <div class="col-auto text-success form-group">
                    Total (aplicado o desconto): R$
                    <?php echo number_format($preco_total, 2, ',', '.'); ?>
                </div>
            </div>
            <div class="row">
            </div>
            <form method="post">
                <input type="hidden" name="pagar">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-primary col-auto form-group" type="button">
                                <i class="fas fa-arrow-left"></i>
                                Voltar ao cadastro de membros
                            </button>
                            <button class="btn btn-success col-auto form-group" type="submit">
                                <i class="fas fa-check"></i>
                                Efetuar pagamento
                            </button>
                        </div>
                    </div>      
                </div>
            </form>
        </main>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
        <script>
            $(document).ready(function () {
                $(".btn-primary").click(function (e) {
                    e.preventDefault();
                    window.open('<?php echo SERVER_NAME . 'usuario/inscricao_grupo.php' ?>', '_self');
                });
            });
        </script>
    </body>
</html>
