<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Enviar Atração • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <div class="container">
            <form method="post" class="form-group" novalidate>
                <div class="card">
                    <h2 class="card-header">
                        <i class="fas fa-edit"></i>
                        Descrição da Atração
                    </h2>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tema">Tema</label>
                            <input type="text" id="tema" class="form-control" name="tema" required placeholder="Tema da Atração">
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option></option>
                                <option value="Minicurso">Minicurso</option>
                                <option value="Oficina">Oficina</option>
                                <option value="Palestra">Palestra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea rows="6" name="descricao" id="descricao" class="form-control" required minlength="5" placeholder="Descreva sobre a atração a ser oferecida"></textarea>
                        </div>

                        <div class="row justify-content-center justify-content-md-end">
                            <div class="form-group col-auto">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fas fa-location-arrow"></i>
                                    Enviar
                                </button>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
        </div>

    </body>
</html>
