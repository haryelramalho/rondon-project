<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'helpers/validacao.php';

$id = filter_input(INPUT_GET, 'id');
$token = filter_input(INPUT_GET, 'token');
$senha1 = filter_input(INPUT_POST, 'senha1');
$senha2 = filter_input(INPUT_POST, 'senha2');

$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->selecionar();

foreach ($usuarios as $usuario) {

    if ($usuario->get_usr_id() == $id) {

        if ($usuario->get_token() == $token && $usuario->get_usr_status() == 2) {

            if (count($_POST)) {

                if (validar_senhas($senha1, $senha2)) {

                    $usuario->set_usr_status(1);
                    $usuario->set_senha(md5($senha1));

                    if ($usuarioDAO->atualizar($usuario)) {

                        $_SESSION['conf_rec_senha'] = true;
                        
                        header("location: " . SERVER_NAME . "login.php");
                        die();
                        
                    } else {
                        $_SESSION['conf_rec_senha'] = false;
                    }
                }
            }
        }
        
        break;
    }
}

require_once DIR_ROOT . 'views/usuario/recuperacao.php';
