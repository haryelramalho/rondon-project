<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

if (!isset($_SESSION['usr_admin'])) {

    header("location: " . SERVER_NAME . "login.php");
    die();
}

$email = filter_input(INPUT_GET, 'email');
$erro = "";

if (count($_GET)) {

    $usuarioDAO = new UsuarioDAO();
    $avaliadorDAO = new AvaliadorDAO();

    $usuarios = $usuarioDAO->selecionar();
    $avaliadores = $avaliadorDAO->selecionar();

    foreach ($usuarios as $val) {

        if ($val->get_email() == $email) {

            foreach ($avaliadores as $aval) {
                if ($aval->get_usr_id() == $val->get_usr_id()) {
                    $erro = "Avaliador já cadastrado!";
                    break;
                }
            }

            if (!$erro) {

                $avaliador = new Avaliador();
                $avaliador->set_usr_id($val->get_usr_id());

                if ($avaliadorDAO->inserir($avaliador)) {

                    $_SESSION['aval_sucesso'] = true;
                    header("location: " . SERVER_NAME . "admin/add_avaliador.php");
                    die();
                }

                $erro = "Não foi possível cadastrar o avaliador devido a um erro"
                        . " no Banco de Dados!";
            }

            break;
        }
    }

    if (!$erro) {
        $erro = "Email não encontrado no sistema!";
    }
}

require_once DIR_ROOT . 'views/admin/add_avaliador.php';

unset($_SESSION['aval_sucesso']);
