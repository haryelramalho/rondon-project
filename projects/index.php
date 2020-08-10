<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'helpers/constantes.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';

$nome = ucwords(strtolower(trim(filter_input(INPUT_POST, 'nome'))));
$email = strtolower(trim(filter_input(INPUT_POST, 'email')));
$assunto = filter_input(INPUT_POST, 'assunto');
$mensagem = filter_input(INPUT_POST, 'mensagem');

if (count($_POST)) {

    if (!validar_nome($nome) || !validar_email($email) ||
            !validar_assunto($assunto) || !validar_mensagem($mensagem)) {
        header('location:' . SERVER_NAME . ' index.php');
        die();
    }

    try {

        $mail = new PHPMailer(true);

        $mail->setFrom('contato@rederondonbahia.com.br', 'Rondon 2019');

        $mail->Subject = "Contato - $assunto #" . explode(' ', $nome)[0];

        if ($assunto == 'Problemas Técnicos') {
            $mail->addAddress('admin-rondon@tecnojr.com.br');
        } else {
            $mail->addAddress('rondonuesc@gmail.com');
        }

        $mail->IsHTML(true);
        $mail->Body = "$nome<br>$email<br><br>$mensagem<br>";

        $mail->send();

        $_SESSION['email_enviado'] = true;
    } catch (Exception $e) {

        $_SESSION["descricao_erro"] = $mail->ErrorInfo;
        $_SESSION["email_enviado"] = false;
    }

    header("location:" . SERVER_NAME . "index.php");
    die();
}

require_once DIR_ROOT . 'views/index.php';
