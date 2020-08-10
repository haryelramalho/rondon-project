<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Painel do Usuário • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 style="margin: -7px 0 14px" class="text-center titulos">
                Painel do Usuário
            </h1>
            <div class="row form-group justify-content-center">
                <div class="col-md-auto">
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="row justify-content-center">
                                <div class="col-md-auto text-center form-group">
                                    <img class="img-thumbnail bg-dark rounded-circle shadow"
                                         alt="avatar" src="<?php echo $avatar ?>"
                                         style="height: 200px; width: 200px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-auto btn-group-vertical form-group">
                                    <button type="button" class="btn btn-dark"
                                            onclick="window.open('<?php echo SERVER_NAME ?>usuario/atualizar_avatar.php', '_self')">
                                        Alterar Imagem de Perfil
                                    </button>
                                    <button type="button" class="btn btn-dark"
                                            onclick="window.open('<?php echo SERVER_NAME ?>usuario/atualizar.php', '_self')">
                                        Atualizar Cadastro
                                    </button>
                                    <?php if ($is_evento) { ?>
                                        <button type="button" class="btn btn-dark"
                                                onclick="window.open('usuario/inscricao_evento.php', '_self')">
                                            Inscrever-se no Evento
                                        </button>
                                    <?php } ?>
                                    <?php if (isset($_SESSION["usuario"]["evento"]["id"])) { ?>
                                                <button type="button" class="btn btn-dark"
                                                        onclick="window.open('<?php echo SERVER_NAME ?>usuario/envia_submissao.php', '_self')">
                                                    Submeter Trabalho
                                                </button>
                                    <?php } ?>
                                    <?php if ($is_grupo) { ?>
                                        <button type="button" class="btn btn-dark"
                                                onclick="window.open('<?php echo SERVER_NAME ?>usuario/inscricao_grupo.php', '_self');">
                                            Cadastrar Grupo
                                        </button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-dark"
                                            onclick="window.open('<?php echo SERVER_NAME ?>usuario/inscricao_imovel.php', '_self');">
                                        Cadastrar Imóvel
                                    </button>
                                    <button type="button" class="btn btn-dark"
                                            onclick="window.open('<?php echo SERVER_NAME ?>hospedagem.php', '_self');">
                                        Catálogo de Hospedagem
                                    </button>
                                    <button type="button" class="btn btn-danger"
                                            data-toggle="modal" data-target="#modal-deletar"
                                            data-content=
                                            "A ação não pode ser desfeita.
                                            Tem certeza que deseja excluir sua conta?"
                                            data-link="<?php echo "usuario/deletar.php?id={$_SESSION['usuario']['id']}"; ?>">
                                        Excluir Conta
                                    </button>
                                    <button type="button" class="btn btn-danger"
                                            onclick="window.open('<?php echo SERVER_NAME ?>usuario/?logout=on', '_self');">
                                        Sair
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-11 col-md">
                    <div class="row">
                        <div class="col card card-body shadow form-group bg-dark text-white">
                            <h5>
                                Nome:
                                <?php echo $_SESSION['usuario']['nome']; ?>
                            </h5>
                            <h5>
                                Tipo:
                                <?php echo $_SESSION['usuario']['tipo']; ?>
                            </h5>
                            <h5>
                                Email:
                                <?php echo $_SESSION['usuario']['email']; ?>
                            </h5>
                            <h5>
                                Celular:
                                <?php echo $_SESSION['usuario']['celular']; ?>
                            </h5>
                            <?php if (isset($_SESSION['usuario']['evento'])) { ?>
                                <h5>
                                    Categoria: 
                                    <?php echo $categoria; ?>
                                </h5>
                                <h5>
                                    Status de Pagamento: 
                                    <?php echo $_SESSION['usuario']['evento']['status']; ?>
                                </h5>
                                <?php if ($status == '1' || $status == '7') { ?>
                                    <div class="row justify-content-between">
                                        <h5 class="col-auto">
                                            Preço a pagar:
                                            <?php echo $preco ?>
                                        </h5>
                                        <a class="col-auto btn btn-success"
                                           id="pagamento"
                                           href="usuario/pagamento_evento.php">
                                            Efetuar pagamento
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col card card-body shadow border-dark">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php if (isset($_SESSION["usuario"]["avaliador"])) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab"
                                           href="#avaliacoes" role="tab" aria-selected="true">
                                            Avaliações
                                        </a>
                                    </li>
                                    <?php if (isset($_SESSION["usuario"]["evento"])) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"
                                               href="#submissoes" role="tab" aria-selected="true">
                                                Submissões
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"
                                           href="#imoveis" role="tab" aria-selected="false">
                                            Imóveis
                                        </a>
                                    </li>
                                <?php } else if (isset($_SESSION["usuario"]["evento"])) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab"
                                           href="#submissoes" role="tab" aria-selected="true">
                                            Submissões
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"
                                           href="#imoveis" role="tab" aria-selected="false">
                                            Imóveis
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab"
                                           href="#imoveis" role="tab" aria-selected="false">
                                            Imóveis
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" style="padding-top: 2vh;">
                                <?php if (isset($_SESSION["usuario"]["avaliador"])) { ?>
                                    <div class="tab-pane fade show active" id="avaliacoes" role="tabpanel">
                                        <table class="text-center table table-responsive-md table-bordered dataTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="align-middle">Título</th>
                                                    <th class="align-middle">Área</th>
                                                    <th class="align-middle">Status</th>
                                                    <th class="align-middle">Opções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($subms_aval)) {
                                                    foreach ($subms_aval as $sub) {
                                                        if ($sub->get_subm_status() == 'E') {
                                                            $status = 'info text-white';
                                                        } else if ($sub->get_subm_status() == 'A') {
                                                            $status = "success text-white";
                                                        } else if ($sub->get_subm_status() == "C") {
                                                            $status = "warning";
                                                        } else {
                                                            $status = "danger text-white";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <?php echo $sub->get_titulo() ?>
                                                            </td>
                                                            <td class="align-middle">
                                                                <?php echo $sub->get_area(true) ?>
                                                            </td>
                                                            <td class="bg-<?php echo $status ?> align-middle"><?php echo $sub->get_subm_status(true); ?></td>
                                                            <td>
                                                                <a class="btn btn-info form-group"
                                                                   href="<?php echo "usuario/submissao_avaliador.php?id={$sub->get_subm_id()}" ?>">
                                                                    <i class="fas fa-location-arrow"></i>
                                                                    Exibir
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade show" id="submissoes" role="tabpanel">
                                        <table class="text-center table table-responsive-md table-bordered dataTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="align-middle">Título</th>
                                                    <th class="align-middle">Autores</th>
                                                    <th class="align-middle">Área</th>
                                                    <th class="align-middle">Status</th>
                                                    <th class="align-middle">Opções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($submissoes as $submissao) {
                                                    if ($submissao->get_subm_status() == 'E') {
                                                        $status = 'info text-white';
                                                    } else if ($submissao->get_subm_status() == 'A') {
                                                        $status = "success text-white";
                                                    } else if ($submissao->get_subm_status() == "C") {
                                                        $status = "warning";
                                                    } else {
                                                        $status = "danger text-white";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="align-middle">
        <?php echo $submissao->get_titulo() ?>
                                                        </td>
                                                        <td class="align-middle">
        <?php echo $submissao->get_autores() ?>
                                                        </td>
                                                        <td class="align-middle">
        <?php echo $submissao->get_area(true) ?>
                                                        </td>
                                                        <td class="bg-<?php echo $status ?> align-middle"><?php echo $submissao->get_subm_status(true); ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger form-group" data-toggle="modal"
                                                                    data-target="#modal-deletar"
                                                                    data-content=
                                                                    "A ação não pode ser desfeita. Tem certeza que deseja
                                                                    excluir a submissão?"
                                                                    data-link="<?php echo "usuario/deletar_submissao.php?id={$submissao->get_subm_id()}" ?>">
                                                                <i class="fas fa-trash-alt"></i>
                                                                Excluir
                                                            </button>
                                                            <a href="usuario/submissao.php?id=<?php echo $submissao->get_subm_id(); ?>"
                                                               class="btn btn-primary form-group">
                                                                <i class="fas fa-location-arrow"></i>
                                                                Exibir
                                                            </a>
                                                        </td>
                                                    </tr>
    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
<?php } else if (isset($_SESSION["usuario"]["evento"])) { ?>
                                    <div class="tab-pane fade show active" id="submissoes" role="tabpanel">
                                        <table class="text-center table table-responsive-md table-bordered dataTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="align-middle">Título</th>
                                                    <th class="align-middle">Autores</th>
                                                    <th class="align-middle">Área</th>
                                                    <th class="align-middle">Status</th>
                                                    <th class="align-middle">Opções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($submissoes as $submissao) {
                                                    if ($submissao->get_subm_status() == 'E') {
                                                        $status = 'info text-white';
                                                    } else if ($submissao->get_subm_status() == 'A') {
                                                        $status = "success text-white";
                                                    } else if ($submissao->get_subm_status() == "C") {
                                                        $status = "warning";
                                                    } else {
                                                        $status = "danger text-white";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="align-middle">
        <?php echo $submissao->get_titulo() ?>
                                                        </td>
                                                        <td class="align-middle">
        <?php echo $submissao->get_autores() ?>
                                                        </td>
                                                        <td class="align-middle">
        <?php echo $submissao->get_area(true) ?>
                                                        </td>
                                                        <td class="bg-<?php echo $status ?> align-middle"><?php echo $submissao->get_subm_status(true); ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger form-group" data-toggle="modal"
                                                                    data-target="#modal-deletar"
                                                                    data-content=
                                                                    "A ação não pode ser desfeita. Tem certeza que deseja
                                                                    excluir a submissão?"
                                                                    data-link="<?php echo "usuario/deletar_submissao.php?id={$submissao->get_subm_id()}" ?>">
                                                                <i class="fas fa-trash-alt"></i>
                                                                Excluir
                                                            </button>
                                                            <a href="usuario/submissao.php?id=<?php echo $submissao->get_subm_id(); ?>"
                                                               class="btn btn-primary form-group">
                                                                <i class="fas fa-location-arrow"></i>
                                                                Exibir
                                                            </a>
                                                        </td>
                                                    </tr>
    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
<?php } ?>
                                <div class="tab-pane fade" id="avaliacoes" role="tabpanel">
                                </div>
                                <div class="tab-pane fade show <?php if (!isset($_SESSION['usuario']['evento'])) echo 'active' ?>" id="imoveis" role="tabpanel">
                                    <a href="usuario/inscricao_imovel.php" class="btn btn-warning form-group">
                                        <i class="fas fa-plus"></i>
                                        Cadastrar
                                    </a>
                                    <table class="table table-responsive-md table-bordered dataTable text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="align-middle">Cidade</th>
                                                <th class="align-middle">Bairro</th>
                                                <th class="align-middle">Diária (R$)</th>
                                                <th class="align-middle">Status</th>
                                                <th class="align-middle">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($propriedades as $propriedade) {
                                                if ($propriedade->get_prop_status() == 'E') {
                                                    $status = "warning";
                                                } else if ($propriedade->get_prop_status() == 'A') {
                                                    $status = "success text-white";
                                                } else {
                                                    $status = "danger text-white";
                                                }
                                                ?>
                                                <tr>
                                                    <td class="align-middle">
    <?php echo $propriedade->get_cidade(); ?>
                                                    </td>
                                                    <td class="align-middle">
    <?php echo $propriedade->get_bairro(); ?>
                                                    </td>
                                                    <td class="align-middle">
    <?php echo $propriedade->get_preco(true); ?>
                                                    </td>
                                                    <td class="bg-<?php echo $status ?> align-middle">
    <?php echo $propriedade->get_prop_status(true); ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a role="button" class="btn btn-primary form-group" target="_blank"
                                                           href="<?php echo "propriedade.php?id={$propriedade->get_prop_id()}"; ?>">
                                                            <i class="fas fa-eye"></i>
                                                            Detalhes
                                                        </a>
                                                        <button type="button" class="btn btn-danger form-group" data-toggle="modal"
                                                                data-target="#modal-deletar"
                                                                data-content=
                                                                "A ação não pode ser desfeita. Tem certeza que deseja
                                                                excluir a proposta de locação?"
                                                                data-link="<?php echo "usuario/deletar_propriedade.php?id={$propriedade->get_prop_id()}"; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Excluir
                                                        </button>
                                                    </td>
                                                </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Modal -->
        <div class="modal fade" id="alojamento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Deseja confirmar solicitação de alojamento na UESC?
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-around">
                            <button id="cancelaAloj" type="button"
                                    class="btn-alojamento btn btn-danger" data-dismiss="modal">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </button>
                            <button id="confirmaAloj" type="button"
                                    class="btn-alojamento btn btn-success" data-dismiss="modal">
                                <i class="fas fa-check"></i>
                                Confirmar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lembrete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ainda não se increveu no IV CONGRESSO RONDON?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead text-center">
                            Para fazer a inscrição no evento, precisamos de mais algumas
                            informações. Clique <a href="usuario/inscricao_evento.php">aqui</a> e inscreva-se agora!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="primeiro-acesso" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Primeiro Acesso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead text-center">
                            Perfeito!! Sua conta acabou de ser ativada.
                            Agora você pode entrar no seu perfil através
                            do <a href="login.php">login</a>.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-deletar" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação de exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Não</button>
                        <a href="deletar_propriedade" class="btn btn-outline-danger">Sim</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-inscricao-andamento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inscrição em andamento</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            Estamos redirecionando você ao sistema do
                            pagseguro para concluir o pagamento. Aguarde
                            alguns segundos ...
                        </p>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
<?php if (isset($_SESSION["usuario"]["primeiro_acesso"])) { ?>
            <script>
                $("#primeiro-acesso").modal({
                    backdrop: 'static'
                });
            </script>
            <?php
            unset($_SESSION["usuario"]["primeiro_acesso"]);
        }
        ?>
        <script>
            $(document).ready(function () {
                $("#pagamento").click(function () {
                    $('#modal-inscricao-andamento').modal({
                        backdrop: 'static'
                    });
                });
                $('#modal-deletar').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    $(this).find('.modal-body').html(button.data('content'));
                    $(this).find('.btn-outline-danger').prop('href', button.data('link'));
                });
                
                $(".btn-alojamento").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "usuario/",
                        data: $(this).attr('id')
                    });
                });
            });
        </script>
<?php if (!isset($_SESSION['usuario']['evento'])) { ?>
            <script>
                $("#lembrete").modal({
                    backdrop: 'static'
                });
            </script>
<?php } ?> <!--else if ($alojar) { ?>
            <script>
                $("#alojamento").modal({
                    backdrop: 'static'
                });
            </script>
<?php ?> -->
    </body>
</html>