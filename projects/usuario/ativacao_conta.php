<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'helpers/validacao.php';

$id = filter_input(INPUT_GET, 'id');
$token = filter_input(INPUT_GET, 'token');

$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->selecionar();

foreach ($usuarios as $usuario) {

    if ($usuario->get_usr_id() == $id) {

        if ($usuario->get_token() == $token && $usuario->get_usr_status() == 0) {

            $usuario->set_usr_status(1);

            if ($usuarioDAO->atualizar($usuario)) {

                $_SESSION["usuario"]["primeiro_acesso"] = true;
                $_SESSION["usuario"]["id"] = $usuario->get_usr_id();
                $_SESSION["usuario"]["nome"] = $usuario->get_nome();
                $_SESSION["usuario"]["email"] = $usuario->get_email();
                $_SESSION["usuario"]["cpf"] = $usuario->get_cpf();
                $_SESSION["usuario"]["celular"] = $usuario->get_celular();
                $_SESSION["usuario"]["telefone"] = $usuario->get_telefone();
                $_SESSION["usuario"]["tipo"] = "Usuário básico";

                header("location:" . SERVER_NAME . "usuario/");
                die();
            }
        }

        break;
    }
}

header("Location:" . SERVER_NAME);
