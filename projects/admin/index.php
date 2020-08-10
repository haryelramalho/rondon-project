<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';

if (filter_input(INPUT_GET, 'logout') === 'on') {
    unset($_SESSION["usr_admin"]);
}
if (isset($_SESSION["usr_admin"])) {

    $AvaliadorDAO = new AvaliadorDAO();
    $avaliadores = $AvaliadorDAO->selecionar();
    $qtd_avaliadores = count($avaliadores);

    $SubmissaoDAO = new SubmissaoDAO();
    $submissoes = $SubmissaoDAO->selecionar();
    $qtd_submissoes = count($submissoes);

    $PropriedadeDAO = new PropriedadeDAO();
    $propriedades = $PropriedadeDAO->selecionar();
    $qtd_propriedades = count($propriedades);

    require_once DIR_ROOT . 'views/admin/index.php';
} else {
    header("location:" . SERVER_NAME . "login.php");
    die();
}

#$SubmissaoDAO = new SubmissaoDAO();
#$submissoes = $SubmissaoDAO->selecionar();
#$qtd_submissoes = count($submissoes);