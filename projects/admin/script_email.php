<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';

if(!isset($_SESSION["usr_admin"])){
    header('location: ' . SERVER_NAME . "login.php");
    die();
}

$assunto = "Inscrições";
$mensagem = 'Você que já se cadastrou no site do IV Congresso, está na hora de se inscrever!<br>'
          . '<br>Corre lá no site e acesse seu perfil.<br>'
          . '<br>Clique no botão "Inscrever-se no Evento".<br>' 
          . '<br>Lembrando que a inscrição só será válida para o evento mediante a confirmação do pagamento.<br><br>';


$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->selecionar();

try {

    $mail = new PHPMailer(true);

    $mail->setFrom('contato@rederondonbahia.com.br', 'Rondon 2019');
    $mail->Subject = $assunto;
    foreach($usuarios as $usuario){
        $mail->addAddress($usuario->get_email());
    }
    $mail->IsHTML(true);

    $mail->Body = "<p><b>" . $mensagem . "</b></p>"
                  . "<p style='color: green;'><b>Att, Equipe IV Congresso Rondon 2019</b></p>";
    $mail->AltBody = $mensagem;

    $mail->send();

} catch (Exception $e) {

    header('location: ' . DIR_ROOT . 'index.php');
    die();

}