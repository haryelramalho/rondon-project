<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/arquivos.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';

$id = filter_input(INPUT_GET, 'id');

if (isset($_SESSION['usuario'])) {

    $propriedadeDAO = new PropriedadeDAO();
    $propriedades = $propriedadeDAO->selecionar();

    foreach ($propriedades as $propriedade) {

        if ($propriedade->get_prop_id() == $id) {

            if ($_SESSION['usuario']['id'] == $propriedade->get_usr_id()) {

                $dir = DIR_ROOT . "uploads/{$_SESSION['usuario']['id']}/propriedades/$id";
                
                if (is_dir($dir)) {
                    deletar_arvore($dir);
                }

                $propriedadeDAO->deletar((int) $id);
            }

            break;
        }
    }
}

header("location: " . SERVER_NAME . "usuario/");
