<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';

if (!isset($_SESSION['usuario'])) {

    header("location:" . SERVER_NAME ."login.php");
    die();
}

$nome = $_SESSION['usuario']['nome'];
$email = $_SESSION['usuario']['email'];
$cpf = $_SESSION['usuario']['cpf'];
$celular = $_SESSION['usuario']['celular'];
$telefone = $_SESSION['usuario']['telefone'];

$erros = array();

if (count($_POST)) {

    $nome = ucwords(strtolower(trim(filter_input(INPUT_POST, 'nome'))));
    $celular = filter_input(INPUT_POST, 'celular');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $senha1 = filter_input(INPUT_POST, 'senha1');
    $senha2 = filter_input(INPUT_POST, 'senha2');

    if (validar_nome($nome) && validar_cpf($cpf) && validar_telcel($celular, CELULAR) &&
            validar_telcel($telefone, TELEFONE) && validar_senhas($senha1, $senha2)) {

        if (!count($erros)) {

            $usuarioDAO = new UsuarioDAO();
            $usuario = new Usuario();

            $usuario->set_usr_id($_SESSION['usuario']['id']);
            $usuario->set_nome($nome);
            $usuario->set_email($email);
            $usuario->set_cpf($cpf);
            $usuario->set_celular($celular);
            $usuario->set_telefone($telefone);
            $usuario->set_senha(md5($senha1));
            $usuario->set_token('');
            $usuario->set_usr_status(1);

            $_SESSION["atualizacao1_realizada"] = $usuarioDAO->atualizar($usuario);

            if ($_SESSION["atualizacao1_realizada"]) {

                 $_SESSION['usuario']['nome'] = $nome;
                 $_SESSION['usuario']['email'] = $email;
                 $_SESSION['usuario']['cpf'] = $cpf;
                 $_SESSION['usuario']['celular'] = $celular;
                 $_SESSION['usuario']['telefone'] = $telefone;
            }

            header("location: " . SERVER_NAME . "usuario/atualizar.php");
            die();
        }
    }
}

require_once DIR_ROOT . 'views/usuario/atualizar.php';
