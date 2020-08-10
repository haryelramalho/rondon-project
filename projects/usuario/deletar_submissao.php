<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/arquivos.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';

if (!isset($_SESSION['usuario']['evento'])) {

    header("location: " . SERVER_NAME . "usuario/");
    die();
}

$submissaoDAO = new SubmissaoDAO();

$id = filter_input(INPUT_GET, 'id');

$submissoes = $submissaoDAO->selecionar($_SESSION['usuario']['evento']['id']);

foreach ($submissoes as $value) {
    if ($value->get_subm_id() == $id) {
        if ($submissaoDAO->deletar((int) $id)) {
            $dir = DIR_ROOT . "uploads/{$_SESSION['usuario']['id']}/submissoes/$id";
            if (is_dir($dir)) {
                deletar_arvore($dir);
            }
        }
    }
}

header("location: " . SERVER_NAME . "usuario/");
