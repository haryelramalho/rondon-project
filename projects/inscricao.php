<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'helpers/constantes.php';
require_once DIR_ROOT . 'helpers/arquivos.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/Exception.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/PHPMailer.php';
require_once DIR_ROOT . 'vendor/PHPMailer/src/SMTP.php';

/*if (!isset($_SESSION['usr_admin'])) {
    header("location: " . SERVER_NAME . "login.php");
    die();
}*/

$nome = ucwords(strtolower(trim(filter_input(INPUT_POST, 'nome'))));
$email = strtolower(trim(filter_input(INPUT_POST, 'email')));
$cpf = filter_input(INPUT_POST, 'cpf');
$celular = filter_input(INPUT_POST, 'celular');
$telefone = filter_input(INPUT_POST, 'telefone');
$senha1 = filter_input(INPUT_POST, 'senha1');
$senha2 = filter_input(INPUT_POST, 'senha2');

$erros = array();

if (count($_POST)) {

    if (validar_nome($nome) && validar_email($email) && validar_cpf($cpf) &&
            validar_telcel($celular, CELULAR) && validar_telcel($telefone, TELEFONE) &&
            validar_senhas($senha1, $senha2)) {

        if (consultar_cpf($cpf)) {
            $erros['cpf'] = "CPF informado já existe!";
        }

        if (consultar_email($email)) {
            $erros['email'] = "Email informado já existe!";
        }

        if (!count($erros)) {

            $usuario = new Usuario();

            $usuario->set_nome($nome);
            $usuario->set_email($email);
            $usuario->set_cpf($cpf);
            $usuario->set_celular($celular);
            $usuario->set_telefone($telefone);
            $usuario->set_senha(md5($senha1));
            $usuario->set_token(md5((string) rand() . (string) time()));
            $usuario->set_usr_status(1); //Setando o usuário como verificado

            $usuarioDAO = new UsuarioDAO();
 
            if ($usuarioDAO->inserir($usuario)) {

                $_SESSION["inscricao1_realizada"] = true;

                $usuarios = $usuarioDAO->selecionar();
                $id = end($usuarios)->get_usr_id();

                $link_token = SERVER_NAME . "usuario/ativacao_conta.php?"
                        . "id=$id&token={$usuario->get_token()}";
                $dir = DIR_ROOT . "uploads/$id";

                try {

                    mkdir($dir, 0777, true);
                    copy(DIR_ROOT . "assets/images/avatar_padrao.jpg", "$dir/avatar1.jpg");

                    /*
                        Excluindo a necessidade de o usuário receber um e-mail para se cadastrar
                    */
                    /*$mail = new PHPMailer(true);

                    $mail->setFrom('contato@rederondonbahia.com.br', 'Rondon 2019');
                    $mail->Subject = "Ativação de conta";
                    $mail->addAddress($email);
                    $mail->IsHTML(true);

                    $mail->Body = "<p style=\"color: green\"><b>Olá, {$usuario->get_nome()}</b></p>"
                            . "<p>Obrigado por se inscrever no Congresso Rondon 2019.</p>"
                            . "<p>Clique no link abaixo para ativar a sua conta.</p>"
                            . "<p>$link_token</p>"
                            . "<p><b>Att,<br>Equipe Congresso Rondon 2019</b></p>";

                    $mail->send();*/
                } catch (Exception $e) {

                    deletar_arvore($dir);
                    $usuarioDAO->deletar($id);

                    $_SESSION["inscricao1_realizada"] = false;
                    $_SESSION['descricao_erro'] = "Não foi possível enviar email."
                            . "{$mail->ErrorInfo}. Por conta disso o usuário não"
                            . "foi cadastrado.";
                }
            } else {

                $_SESSION["descricao_erro"] = "Não foi possível cadastrar o"
                        . "usuário no banco de dados.";

                $_SESSION["inscricao1_realizada"] = false;
            }

            header("location: " . SERVER_NAME . "inscricao.php");
            die();
        }
    }
}

require_once DIR_ROOT . 'views/inscricao.php';