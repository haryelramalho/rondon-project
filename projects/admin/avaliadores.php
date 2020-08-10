<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

if (!isset($_SESSION['usr_admin'])) {
    
    header("location: " . SERVER_NAME . "login.php");
    die();
}

$avaliadorDAO = new AvaliadorDAO();
$avaliadores = $avaliadorDAO->selecionar();

require_once DIR_ROOT . 'views/admin/avaliadores.php';
