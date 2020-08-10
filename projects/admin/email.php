<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'database/EventoDAO.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';

if(!isset($_SESSION['usr_admin'])){
    header("location: " . SERVER_NAME . "login.php");
    die();
}

$erros['assunto'] = '';
$erros['mensagem'] = '';

$assunto = filter_input(INPUT_POST, 'assunto');
$mensagem = filter_input(INPUT_POST, 'mensagem');

if(count($_POST)){

    if(!$assunto){
        $erros['assunto'] = "Digite um assunto";
    } else if(!$mensagem){
        $erros['mensagem'] = "Digite uma mensagem.";
    } else{
        
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->selecionar();
        $qtd_users = count($usuarios);

        $eventoDAO = new EventoDAO();
        $evento = $eventoDAO->selecionar();

        if(!empty($evento)){

            $emails = array();

            $id = array_map("busca_id", $evento);
            $qtd_users_eve = count($id);
            


            for($i = 0; $i < $qtd_users; $i++){
                for($j = 0; $j < $qtd_users_eve; $j++){
                    if($usuarios[$i]->get_usr_id() == $id[$j]){
                        array_push($emails, $usuarios[$i]->get_email());
                        break;
                    }
                }
            }

            try {

                $mail = new PHPMailer(true);

                $mail->setFrom('contato@rederondonbahia.com.br', 'Rondon 2019');
                $mail->Subject = $assunto;
                foreach($emails as $email){
                    $mail->addAddress($email);
                }
                $mail->IsHTML(true);

                $mail->Body = "<p><b>" . $mensagem . "</b></p>"
                              . "<p style='color: green;'><b>Att, Equipe IV Congresso Rondon 2019</b></p>";
                $mail->AltBody = $mensagem;

                $mail->send();

                $_SESSION['email_enviado'] = true;
            
            } catch (Exception $e) {

                $_SESSION['email_enviado'] = false;
                $_SESSION["descricao_erro"] = $mail->ErrorInfo;
            }
            header("location: " . SERVER_NAME . "admin/email.php");
            die();
        }
    }
}

require_once DIR_ROOT . 'views/admin/email.php';

function busca_id($evento){
    return $evento->get_usr_id();
}

?>