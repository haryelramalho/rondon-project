<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Propriedades - Admin • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php' ?>
        <div class="container">

            <h1 style="margin: -7px 0 14px" class="text-center titulos">Propriedades</h1>

            <table class="table table-striped table-responsive-md dataTable border-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Logradouro</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Diária (R$)</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($propriedades as $propriedade) {
                        $status = (($propriedade->get_prop_status() == 'E') ? 'table-warning' :
                                (($propriedade->get_prop_status() == 'A') ? 'table-success' : 'table-danger'));
                        ?>
                        <tr class="<?php echo $status ?>"
                            id="<?php echo $propriedade->get_prop_id(); ?>">
                            <td><?php echo $propriedade->get_logradouro(); ?></td>
                            <td><?php echo $propriedade->get_bairro(); ?></td>
                            <td><?php echo $propriedade->get_cidade(); ?></td>
                            <td><?php echo $propriedade->get_preco(true); ?></td>
                            <td class="text-center">
                                <select id="status<?php echo $propriedade->get_prop_id(); ?>" class="custom-select">
                                    <option value="E"
                                            <?php if ($propriedade->get_prop_status() == 'E') echo "selected"; ?>>
                                        Em Andamento
                                    </option>
                                    <option value="R"
                                            <?php if ($propriedade->get_prop_status() == 'R') echo "selected"; ?>>
                                        Reprovado
                                    </option>
                                    <option value="A"
                                            <?php if ($propriedade->get_prop_status() == 'A') echo "selected"; ?>>
                                        Aprovado
                                    </option>
                                </select>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo "propriedade.php?id={$propriedade->get_prop_id()}"; ?>"
                                   class="btn btn-outline-primary" target="_blank">
                                    <i class="fas fa-eye"></i>
                                    Ver Propriedade
                                </a>
                            </td>
                        </tr>
                    <?php 
                } ?>
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
        <?php
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <script>
            <?php foreach ($propriedades as $propriedade) { ?>

                $("#status<?php echo $propriedade->get_prop_id(); ?>").change(function () {

                    var status = $(this).val();
                    var request = new XMLHttpRequest();

                    request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {

                            if (this.responseText == '1') {

                                if (status == 'E') {
                                    $("#<?php echo $propriedade->get_prop_id(); ?>").removeClass("table-danger table-success").addClass("table-warning");
                                } else if (status == 'A') {
                                    $("#<?php echo $propriedade->get_prop_id(); ?>").removeClass("table-danger table-warning").addClass("table-success");
                                } else {
                                    $("#<?php echo $propriedade->get_prop_id(); ?>").removeClass("table-success table-warning").addClass("table-danger");
                                }
                            }
                        }
                    };

                    request.open("GET",
                            "<?php echo SERVER_NAME . "admin/propriedades.php?id={$propriedade->get_prop_id()}&status=" ?>" + status);
                    request.send();
                });

            <?php 
            } ?>
        </script>
    </body>
</html>