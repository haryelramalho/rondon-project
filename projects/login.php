<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';

if (isset($_SESSION["usuario"])) {
    header("location: " . SERVER_NAME . "usuario/");
    die();
}

if (isset($_SESSION["usr_admin"])) {
    header("location: " . SERVER_NAME . "admin/");
    die();
}

$erros = array();
$erros['email'] = '';
$erros['senha'] = '';

$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');

if (count($_POST)) {

    if (!isset($_POST["recuperar-senha"])) {

        if ($email == ADMIN_EMAIL && $senha == ADMIN_SENHA) {

            $_SESSION["usr_admin"] = true;

            header("location: " . SERVER_NAME . "admin/");
            die();
        } else {

            if (!$email) {
                $erros['email'] = "Digite o email!";
            } else if (!$senha) {
                $erros['senha'] = "Digite a senha!";
            } else {

                $usuarioDAO = new UsuarioDAO();
                $usuarios = $usuarioDAO->selecionar();
                $qtd_usuarios = count($usuarios);

                for ($i = 0; $i < $qtd_usuarios; $i++) {

                    if ($usuarios[$i]->get_email() == $email) {
                        break;
                    }
                }

                if ($i == $qtd_usuarios) {
                    $erros["email"] = "Email não cadastrado!";
                } else if ($usuarios[$i]->get_senha() != md5($senha)) {
                    $erros["senha"] = "Senha não corresponde!";
                } else if ($usuarios[$i]->get_usr_status() == 0) {
                    $erros['conta'] = "Conta não ativada";
                } else {

                    if ($usuarios[$i]->get_usr_status() == 2) {

                        $usuarios[$i]->set_usr_status(1);
                        $usuarioDAO->atualizar($usuarios[$i]);
                    }

                    $_SESSION["usuario"]["id"] = $usuarios[$i]->get_usr_id();
                    $_SESSION["usuario"]["nome"] = $usuarios[$i]->get_nome();
                    $_SESSION["usuario"]["email"] = $usuarios[$i]->get_email();
                    $_SESSION["usuario"]["cpf"] = $usuarios[$i]->get_cpf();
                    $_SESSION["usuario"]["celular"] = $usuarios[$i]->get_celular();
                    $_SESSION["usuario"]["telefone"] = $usuarios[$i]->get_telefone();
                    $_SESSION["usuario"]["tipo"] = "Usuário básico";
                    
                    header("location: " . SERVER_NAME . "usuario/");
                    die();
                }
            }
        }
    } else {

        //Recuperação de senha
        //Verificando se o email informado existe no BD.

        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->selecionar();
        $qtd_usuarios = count($usuarios);

        for ($i = 0; $i < $qtd_usuarios; $i++) {

            if ($usuarios[$i]->get_email() == $email) {
                break;
            }
        }

        if ($i == $qtd_usuarios) {
            $erros["email"] = "Email não cadastrado!";
        } else if ($usuarios[$i]->get_usr_status() == 0) {
            $erros["email"] = "Conta não ativada! Verifique seu email.";
        } else if ($usuarios[$i]->get_usr_status() == 2) {
            $erros["email"] = "Já foram enviadas instruções para seu email."
                    . " Por favor, consulte-o!";
        } else {

            try {

                $usuarios[$i]->set_usr_status(2);
                $usuarios[$i]->set_token(md5((string) rand() . (string) time()));

                $link_token = SERVER_NAME . "usuario/recuperacao.php?id={$usuarios[$i]->get_usr_id()}&"
                        . "token={$usuarios[$i]->get_token()}";

                $mail = new PHPMailer(true);

                $mail->setFrom('contato@rederondonbahia.com.br', 'Rondon 2019');
                $mail->Subject = "Recuperação de senha";
                $mail->addAddress($email);
                $mail->IsHTML(true);

                $mail->Body = "<h4>No link abaixo você será redirecionado para uma "
                        . "página onde deverá inserir uma nova senha.</h4>$link_token<br>"
                        . "<br>Att,<br>Equipe Congresso Rondon 2019.";

                $mail->send();

                $usuarioDAO->atualizar($usuarios[$i]);
                $_SESSION['email_enviado'] = true;
            } catch (Exception $e) {

                $_SESSION['email_enviado'] = false;
                $_SESSION["descricao_erro"] = $mail->ErrorInfo;
            }

            header("location: " . SERVER_NAME . "login.php");
            die();
        }
    }
}

require_once DIR_ROOT . 'views/login.php';
