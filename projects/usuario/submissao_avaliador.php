<?php 

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/EventoDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

if(!isset($_SESSION["usuario"]["avaliador"])) {
    header("location:" . SERVER_NAME . "usuario/");
    die();
}

$id = filter_input(INPUT_GET, 'id');
$submissaoDAO = new SubmissaoDAO();
$submissoes = $submissaoDAO->selecionar();

foreach ($submissoes as $subm) {
    if ($subm->get_subm_id() == $id) {
        if($subm->get_aval_id() != $_SESSION["usuario"]["avaliador"]) {
            header("location:" . SERVER_NAME . "usuario/");
            die();
        }
        $submissao = $subm;
        break;
    }
}

if (!isset($submissao)) {
    header("location:" . SERVER_NAME . "usuario/");
    die();
}

$eventoDAO = new EventoDAO();
$usr_id = $eventoDAO->selecionar($submissao->get_eve_id())[0]->get_usr_id();

$pdf = "uploads/$usr_id/submissoes/$id/arquivo2.pdf";

if (isset($_POST['status'])) {

    $status = filter_input(INPUT_POST, 'status');

    if ($status == 'E' || $status == 'R' || $status == 'A' || $status == 'C') {

        $submissao->set_subm_status($status);
        $submissaoDAO->atualizar($submissao);
    }
}

else if (isset($_POST['comentario'])) {

    $comentario = filter_input(INPUT_POST, 'comentario');

    $submissao->set_comentario($comentario);
    $submissaoDAO->atualizar($submissao);
}

else if (isset($_POST['nota'])) {

    $nota = filter_input(INPUT_POST, 'nota');

    $submissao->set_nota($nota, true);
    $submissaoDAO->atualizar($submissao);
}

require_once DIR_ROOT . 'views/usuario/submissao_avaliador.php';
 
 
