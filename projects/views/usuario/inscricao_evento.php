<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Inscrição no evento • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <div class="container">
            <form method="post" id="form" novalidate>
                <input type="hidden" name="pagseguro" id="pagseguro">
                <div class="card form-group">
                    <h2 class="card-header">
                        <i class="fas fa-user-cog"></i>
                        Dados pessoais
                    </h2>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="nome_social">Nome Social</label>
                                <input type="text" class="form-control" id="nome_social"
                                       name="nome_social" required pattern=".{5,255}">
                                <div class="invalid-feedback">
                                    Informe um nome social válido!
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label for="instituicao">Instituição acadêmica</label>
                                <input type="text" class="form-control" id="instituicao"
                                       name="instituicao" required pattern=".{3,255}">
                                <div class="invalid-feedback">
                                    Informe uma Instituição acadêmica!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="categoria">Categoria</label>
                                <select class="custom-select" name="categoria"
                                        id="categoria" required>
                                    <option></option>
                                    <option value="1">Professor</option>
                                    <option value="2">Aluno da graduação</option>
                                    <option value="3">Aluno da pós-graduação</option>
                                    <option value="4">Outros</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecione uma categoria!
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label for="nascimento">Data de nascimento</label>
                                <input type="text" class="form-control" id="nascimento"
                                       name="nascimento" placeholder="dd/mm/aaaa"
                                       required pattern="[0-3][0-9][/][0-1][0-9][/][1-2][0|9][0-9]{2}">
                                <div class="invalid-feedback">
                                    Informe uma data válida!
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label for="sexo">Sexo</label>
                                <select class="custom-select" name="sexo"
                                        required id="sexo">
                                    <option></option>
                                    <option value="F">Feminino</option>
                                    <option value="M">Masculino</option>
                                </select>
                                <div class="invalid-feedback">
                                    Informe seu sexo!
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input"
                                   type="checkbox" name="rondonista"
                                   id="rondonista" value="S">
                            <label class="custom-control-label" for="rondonista">
                                Já participei de alguma Operação Projeto Rondon do
                                Ministério da Defesa.
                            </label>
                        </div>
                    </div>
                </div>
                <?php require_once DIR_ROOT . 'common/endereco.php'; ?>
                <div class="row justify-content-center justify-content-md-end">
                    <div class="form-group col-auto">
                        <button type="button" id="inscrever" class="btn btn-outline-dark">
                            <i class="fas fa-user-plus"></i>
                            Inscrever
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="modal-pagseguro" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Próximo Passo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead" id="preco"></p>
                        <p class="lead">
                            Após concluir a inscrição aparecerá um botão
                            no painel de usuário para efetuar o pagamento.
                            Também aparecerá um item no menu esquerdo do
                            painel de usuário para cadastrar o grupo.
                            Se você for um representante de grupo basta
                            selecionar essa opção. Aos restantes dos membros
                            é necessário aguardar.
                        </p>
                        <p class="lead">
                            Lembre-se que a confirmação de participação no evento
                            se dá mediante aprovação de pagamento.
                        </p>
                        <div class="row justify-content-around">
                            <button type="button" id="submit" class="btn btn-success col-auto form-group">
                                Concluir inscrição
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once DIR_ROOT . 'common/modal-erro-validacao.php';
        require_once DIR_ROOT . 'common/script.php';
        ?>
        <script type="text/javascript" src="assets/js/form-validacao.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#inscrever').click(function () {
                    var form = document.getElementById('form');
                    if (form.checkValidity() == false) {
                        $("#modal-erro").modal({
                            backdrop: 'static'
                        });
                        form.classList.add('was-validated');
                    } else {
                        $("#preco").html("Preço total a pagar: R$ " + getPrecoTotal());
                        $("#modal-pagseguro").modal();
                    }
                });
                $("#submit").click(function () {
                    $("#form").submit();
                });
            });
            function getPrecoTotal() {
                var preco = 0, data = new Date();
                if (data.getMonth() < <?php echo PRECO_MES - 1 ?> ||
                        (data.getMonth() == <?php echo PRECO_MES - 1 ?> &&
                                data.getDate() < <?php echo PRECO_DIA ?>)) {
                    switch ($("#categoria").val()) {
                        case '1' :
                            return <?php echo PRECO_PROFESSOR1 ?>;
                        case '2' :
                            return <?php echo PRECO_GRADUADO1 ?>;
                        case '3' :
                            return <?php echo PRECO_POSGRADUADO1 ?>;
                        case '4' :
                            return <?php echo PRECO_OUTROS1 ?>;
                    }
                }
                switch ($("#categoria").val()) {
                    case '1' :
                        return <?php echo PRECO_PROFESSOR2 ?>;
                    case '2' :
                        return <?php echo PRECO_GRADUADO2 ?>;
                    case '3' :
                        return <?php echo PRECO_POSGRADUADO2 ?>;
                    case '4' :
                        return <?php echo PRECO_OUTROS2 ?>;
                }
            }
        </script>
    </body>
</html>
