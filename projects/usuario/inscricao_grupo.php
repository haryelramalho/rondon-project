<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/EventoDAO.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';

if (!isset($_SESSION['usuario'])) {

    header("location: " . SERVER_NAME . "login.php");
    die();
}

if (
    (!isset($_SESSION['usuario']['evento'])) ||
    $_SESSION['usuario']['evento']['referencia'] != 'M' &&
    $_SESSION['usuario']['evento']['cod_status'] != '1' &&
    $_SESSION['usuario']['evento']['cod_status'] != '7') {
    header("location: " . SERVER_NAME . "usuario/");
    die();
}

$eventoDAO = new EventoDAO();
$eventos = $eventoDAO->selecionar();
$qtd_eventos = count($eventos);

if (isset($_SESSION['membros'])) {
    $qtd_emails = count($_SESSION['membros']) - 1;
    for ($i = 1; $i <= $qtd_emails; $i++) {
        $emails[] = $_SESSION['membros'][$i]['email'];
    }
    unset($_SESSION['membros']);
} else {

    $emails = filter_input_array(INPUT_POST)['email'];
    $qtd_emails = GRUPO_MIN - 1;
}

$erros = NULL;

if (isset($_POST['email']) &&
        count($_POST['email']) >= GRUPO_MIN - 1 &&
        count($_POST['email']) <= GRUPO_MAX) {

    $qtd_emails = count($emails);
    $erros = array();

    foreach (array_keys($emails, $_SESSION['usuario']['email']) as $value) {
        $erros[$value] = "Não repita emails!";
    }

    foreach ($emails as $email) {
        $duplicatas = array_keys($emails, $email);
        if (count($duplicatas) > 1) {
            $erros[$duplicatas[1]] = "Não repita emails!";
            break;
        }
    }

    if (!count($erros)) {

        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->selecionar();
        $qtd_usuarios = count($usuarios);
        
        $primeiro = $eventoDAO->selecionar($_SESSION['usuario']['evento']['id'])[0];

        $membros[0]['nome'] = $_SESSION['usuario']['nome'];
        $membros[0]['email'] = $_SESSION['usuario']['email'];
        $membros[0]['eve_id'] = $_SESSION['usuario']['evento']['id'];
        $membros[0]['categoria'] = $primeiro->get_categoria(true);
        $membros[0]['cep'] = $primeiro->get_cep();
        $membros[0]['numero'] = $primeiro->get_numero();
        $membros[0]['data_nascimento'] = $primeiro->get_data_nascimento(true);
        $membros[0]['preco'] = $primeiro->get_preco();

        for ($i = 0; $i < $qtd_emails; $i++) {

            for ($j = 0; $j < $qtd_usuarios; $j++) {

                if ($emails[$i] == $usuarios[$j]->get_email()) {

                    for ($k = 0; $k < $qtd_eventos; $k++) {

                        if ($eventos[$k]->get_usr_id() == $usuarios[$j]->get_usr_id()) {

                            if ($eventos[$k]->get_referencia_pagseguro() != 'M') {
                                $erros[$i] = "Esse usuário não pode fazer parte desse grupo "
                                        . "pois fez seu pagamento individual ou faz parte "
                                        . "de outro grupo!";
                            } else {

                                $membros[$i + 1]['nome'] = $usuarios[$j]->get_nome();
                                $membros[$i + 1]['email'] = $usuarios[$j]->get_email();
                                $membros[$i + 1]['eve_id'] = $eventos[$k]->get_eve_id();
                                $membros[$i + 1]['categoria'] = $eventos[$k]->get_categoria(true);
                                $membros[$i + 1]['preco'] = $eventos[$k]->get_preco();
                            }

                            break;
                        }
                    }

                    if ($k == $qtd_eventos) {
                        $erros[$i] = "O usuário precisa concluir 2ª etapa de inscrição!";
                    }

                    break;
                }
            }

            if ($j == $qtd_usuarios) {
                $erros[$i] = "Email não encontrado! O membro"
                        . " precisa concluir as 2 etapas de inscrição.";
            }
        }
    }

    if (!count($erros)) {

        $_SESSION['membros'] = $membros;
        header("location: " . SERVER_NAME . "usuario/pagamento_grupo.php");
        die();
    }
}

require_once DIR_ROOT . 'views/usuario/inscricao_grupo.php';
