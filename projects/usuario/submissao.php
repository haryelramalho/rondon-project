<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'helpers/arquivos.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

if (!isset($_SESSION["usuario"]["evento"])) {
    header("location:" . SERVER_NAME . "usuario/");
    die();
}

$id = filter_input(INPUT_GET, 'id');
$submissaoDAO = new SubmissaoDAO();
$submissoes = $submissaoDAO->selecionar();

foreach ($submissoes as $subm) {
    if ($subm->get_subm_id() == $id) {
        if ($subm->get_eve_id() != $_SESSION["usuario"]["evento"]["id"]) {
            header('location: ' . SERVER_NAME . 'usuario/');
            die();
        }
        $submissao = $subm;
        break;
    }
}

if (!isset($submissao)) {
    header('location: ' . SERVER_NAME . 'usuario/');
    die();
}

unset($submissoes);


$dir = "uploads/{$_SESSION["usuario"]["id"]}/submissoes/$id/";

$array = array_diff(scandir(DIR_ROOT . $dir), ['.', '..', 'arquivo2.pdf', 'index.php']);

$pdf = "{$dir}arquivo2.pdf";
$docx = $dir . end($array);

if (isset($_FILES["arquivos"]) && $submissao->get_subm_status() == 'C') {

    if (validar_arquivos($_FILES["arquivos"])) {

        $dir = DIR_ROOT . "uploads/{$_SESSION["usuario"]["id"]}/submissoes/$id";
        
        $array = array_diff(scandir($dir), ['.', '..', 'index.php', 'arquivo2.pdf']);

        if (enviar_arquivos($_FILES["arquivos"], $dir, "arquivo")) {

            echo 'S';
            
            rename("$dir/arquivo1.docx", "$dir/" . end($array));

            $mail = new PHPMailer(true);
            $mail->setFrom('contato@rederondonbahia.com.br', 'Reenvio de Submissão');
            $mail->Subject = $submissao->get_titulo();
            $mail->addAddress('admin@rederondonbahia.com.br');

            $mail->IsHTML(true);

            $link = SERVER_NAME . "login.php";
            $link = "<a href='$link'>aqui</a>";

            if ($submissao->get_aval_id()) {

                $avaliadorDAO = new AvaliadorDAO();
                $avaliadores = $avaliadorDAO->selecionar();

                foreach ($avaliadores as $aval) {

                    if ($aval->get_aval_id() == $submissao->get_aval_id()) {

                        $body = "A submissão cujo título é '{$submissao->get_titulo()}' foi "
                                . "renviada para avaliação. O avaliador responsável era '{$aval->get_nome()}'."
                                . " Por favor, confira os novos arquivos enviados e decida o destino da "
                                . "submissão - Redirecionar para um avaliador ou avaliar diretamente. "
                                . " Acesso o site $link";

                        break;
                    }
                }
            }
            
            else {

                $body = "A submissão cujo título é '{$submissao->get_titulo()}' foi "
                        . "renviada para avaliação. Não havia avaliador para essa submissão."
                        . " Por favor, confira os novos arquivos enviados e decida o destino da "
                        . "submissão - Redirecionar para um avaliador ou avaliar diretamente. "
                        . " Acesso o site $link";
            }
            
            $mail->Body = $body;
            
            $submissao->set_aval_id(NULL);
            $submissaoDAO->atualizar($submissao);
            
            $mail->send();

            die();
        }
    }
}

require_once DIR_ROOT . 'views/usuario/submissao.php';
