<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/EventoDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

if (!isset($_SESSION['usr_admin'])) {
    header('location:' . SERVER_NAME . 'login.php');
    die();
}

$id = filter_input(INPUT_GET, 'id');
$submissaoDAO = new SubmissaoDAO();
$submissoes = $submissaoDAO->selecionar();

foreach ($submissoes as $subm) {
    if ($subm->get_subm_id() == $id) {
        $submissao = $subm;
        break;
    }
}

unset($submissoes);

if (!isset($submissao)) {
    header('location: ' . SERVER_NAME . 'admin/submissoes.php');
    die();
}

$eventoDAO = new EventoDAO();
$usr_id = $eventoDAO->selecionar($submissao->get_eve_id())[0]->get_usr_id();

$dir = "uploads/$usr_id/submissoes/$id/";

$array = array_diff(scandir(DIR_ROOT . $dir), ['.', '..', 'arquivo2.pdf', 'index.php']);

$pdf = "{$dir}arquivo2.pdf";
$docx = $dir . end($array);

$avaliadorDAO = new AvaliadorDAO();
$avaliadores = $avaliadorDAO->selecionar();

if ($submissao->get_aval_id()) {

    foreach ($avaliadores as $aval) {
        if ($aval->get_aval_id() == $submissao->get_aval_id()) {
            $avaliador = $aval;
        }
    }
}

if (isset($_POST['avaliador'])) {

    $aval_id = filter_input(INPUT_POST, 'avaliador');

    if (!$aval_id) {
        $submissao->set_aval_id(NULL);
        $submissaoDAO->atualizar($submissao);
    } else {
        foreach ($avaliadores as $aval) {
            if ($aval_id == $aval->get_aval_id()) {
                $submissao->set_aval_id((int) $aval_id);
                $submissaoDAO->atualizar($submissao);
                break;
            }
        }
    }
}

if (isset($_POST['status'])) {

    $status = filter_input(INPUT_POST, 'status');

    if ($status == 'E' || $status == 'R' || $status == 'A' || $status == 'C') {

        $submissao->set_subm_status($status);
        $submissaoDAO->atualizar($submissao);
    }

    $usuarioDAO = new UsuarioDAO();
    $usuarios = $usuarioDAO->selecionar();
    $usr_id = end($eventoDAO->selecionar($submissao->get_eve_id()))->get_usr_id();

    foreach ($usuarios as $usrs) {

        if ($usrs->get_usr_id() == $usr_id) {
            $address = $usrs->get_email();
            break;
        }
    }

    if (isset($address)) {

        $mail = new PHPMailer(true);
        $mail->setFrom('contato@rederondonbahia.com.br', 'RONDON 2019');
        $mail->Subject = "O trabalho acadêmico foi avaliado";
        $mail->addAddress($address);
        $mail->IsHTML(true);
        
        $link = SERVER_NAME . "login.php";
        $link = "<a href='$link'>aqui</a>";
        
        $mail->Body = "O status de sua submissão foi alterado. Titulo do trabalho: "
                . "{$submissao->get_titulo()}. Confira $link";
                
        $mail->send();
    }
    
}

else if (isset($_POST['comentario'])) {

    $comentario = filter_input(INPUT_POST, 'comentario');

    $submissao->set_comentario($comentario);
    $submissaoDAO->atualizar($submissao);
}

else if (isset($_POST['nota'])) {

    $nota = filter_input(INPUT_POST, 'nota');

    $submissao->set_nota($nota, true);

    $submissaoDAO->atualizar($submissao);
}

require_once DIR_ROOT . 'views/admin/submissao.php';
