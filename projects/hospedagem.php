<?php

session_start();

require_once 'helpers/constantes.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';

if (!isset($_SESSION["usuario"]) && !isset($_SESSION['usr_admin'])) {
    header("location:" . SERVER_NAME . " login.php");
    die();
}

$propriedadeDAO = new PropriedadeDAO();
$resultado = $propriedadeDAO->selecionar();

$propriedades = array();

foreach ($resultado as $linha) {
    if ($linha->get_prop_status() === 'A') {
        array_push($propriedades, $linha);
    }
}

require_once DIR_ROOT . 'views/hospedagem.php';
