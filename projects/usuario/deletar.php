<?php

session_start();

require '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/arquivos.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';

$id = filter_input(INPUT_GET, 'id');

if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $id) {

    if (is_dir(DIR_ROOT . "uploads/$id")) {
        deletar_arvore(DIR_ROOT . "uploads/$id");
    }
    
    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->deletar((int) $id);

    unset($_SESSION['usuario']);
}

header("location: " . SERVER_NAME . "login.php");
