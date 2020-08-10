<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'helpers/arquivos.php';

if (!isset($_SESSION['usuario'])) {

    header("location: " . SERVER_NAME . "login.php");
    die();
}

if (isset($_FILES['fotos'])) {

    $foto = $_FILES['fotos'];

    if (validar_fotos($foto)) {

        $dir = DIR_ROOT . "uploads/{$_SESSION['usuario']['id']}";
        
        $itens = array_diff(scandir($dir), ['.', '..']);
        
        foreach ($itens as $item) {
            
            if (!is_dir("$dir/$item")) {
                
                unlink("$dir/$item");
                break;
            }
        }

        if (!enviar_arquivos($foto, $dir, "avatar")) {
            copy(DIR_ROOT . "assets/images/avatar_padrao.jpg", "$dir/avatar1.jpg");
        }

        header("location: " . SERVER_NAME . "usuario/");
        die();
    }
}

require_once DIR_ROOT . 'views/usuario/atualizar_avatar.php';
