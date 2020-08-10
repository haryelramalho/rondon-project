<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/EventoDAO.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

$propriedadeDAO = new PropriedadeDAO();
$eventoDAO = new EventoDAO();
$avaliadorDAO = new AvaliadorDAO();
$submissaoDAO = new SubmissaoDAO();

if (!isset($_SESSION["usuario"])) {

    header("location:" . SERVER_NAME . "login.php");
    die();
}

$alojar = false;

$eventos = $eventoDAO->selecionar();
foreach ($eventos as $evento) {
    if ($evento->get_usr_id() == $_SESSION['usuario']['id']) {
        $_SESSION["usuario"]["tipo"] = "Inscrito no Evento";
        $_SESSION["usuario"]["evento"]["id"] = $evento->get_eve_id();
        $_SESSION["usuario"]["evento"]["status"] = $evento->get_eve_status(true);
        $_SESSION["usuario"]["evento"]["cod_status"] = $evento->get_eve_status();
        $_SESSION["usuario"]["evento"]["referencia"] = $evento->get_referencia_pagseguro();
        
        if ($evento->get_alojamento() == '0' || $evento->get_alojamento() == NULL) {
            $alojar = true;
        }
        
        $categoria = $evento->get_categoria(true);
        $preco = $evento->get_preco(true);
        $submissoes = $submissaoDAO->selecionar($_SESSION["usuario"]["evento"]["id"]);
        
        break;
    }
}

$avaliadores = $avaliadorDAO->selecionar();
foreach ($avaliadores as $aval) {
    if ($aval->get_usr_id() == $_SESSION['usuario']['id']) {
        $_SESSION["usuario"]["avaliador"] = $aval->get_aval_id();
        $submissoes_aval = $submissaoDAO->selecionar();
        $subms_aval = array();
        $i = 0;
        foreach ($submissoes_aval as $subm_aval) {
            if ($subm_aval->get_aval_id() == $_SESSION["usuario"]["avaliador"]) {
                $subms_aval[$i] = $subm_aval;
                $i++;
            }
        }
        break;
    }
}

if (filter_input(INPUT_GET, 'logout') === "on") {

    unset($_SESSION["usuario"]);
    header("location:" . SERVER_NAME . "login.php");
    die();
}

$propriedades = $propriedadeDAO->selecionar($_SESSION['usuario']['id']);
$dir_avatar = "uploads/{$_SESSION['usuario']['id']}";

$itens = array_diff(scandir(DIR_ROOT . $dir_avatar), ['.', '..']);

foreach ($itens as $item) {
    if (!is_dir(DIR_ROOT . "$dir_avatar/$item")) {
        break;
    }
}
$avatar = "$dir_avatar/$item";

$is_evento = true;

if (isset($_SESSION["usuario"]["evento"])) {
    $status = $_SESSION["usuario"]["evento"]["cod_status"];
    if ($status == '1' || $status == '7') {
        $_SESSION["usuario"]["tipo"] .= " (PENDENTE)";
    } else {
        $is_evento = false;
    }
}

$is_grupo = false;

if (isset($_SESSION["usuario"]["evento"])) {
    $is_grupo = $_SESSION["usuario"]["evento"]["referencia"] == 'M' ||
            $status == '7' || $status == '1';
}

if (array_key_exists("confirmaAloj", $_POST)) {
    
    $evento = $eventoDAO->selecionar($_SESSION["usuario"]["evento"]["id"])[0];
    $evento->set_alojamento('1');
    $eventoDAO->atualizar($evento);
}

else if (array_key_exists("cancelaAloj", $_POST)) {
    
    $evento = $eventoDAO->selecionar($_SESSION["usuario"]["evento"]["id"])[0];
    $evento->set_alojamento('2');
    $eventoDAO->atualizar($evento);
}

require_once DIR_ROOT . 'views/usuario/index.php';
