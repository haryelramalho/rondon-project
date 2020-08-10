<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/EventoDAO.php';

if (!isset($_SESSION['membros'])) {

    header("location: " . SERVER_NAME . "usuario/inscricao_grupo.php");
    die();
}

$membros = $_SESSION['membros'];
$qtd_membros = count($membros);

$preco_subtotal = 0;
foreach ($membros as $membro) {
    $preco_subtotal += $membro['preco'];
}

$preco_total = $preco_subtotal * (1 - GRUPO_DESCONTO);

if (count($_POST)) {

    unset($_SESSION['membros']);
    $eventoDAO = new EventoDAO();
    $eventos = $eventoDAO->selecionar();

    $referencia = "G.{$_SESSION["usuario"]["id"]}." . date("mdHis") . md5((string) random_int(-10000, 10000));

    foreach ($membros as $membro) {
        foreach ($eventos as $evento) {
            if ($evento->get_eve_id() == $membro['eve_id']) {
                $evento->set_referencia_pagseguro($referencia);
                $eventoDAO->atualizar($evento);
                break;
            }
        }
    }

    $dados["email"] = PAGSEGURO_EMAIL;
    $dados["token"] = PAGSEGURO_TOKEN;
    $dados["notificationURL"] = SERVER_NAME . "notificacao_pagseguro.php";
    $dados["currency"] = "BRL";
    $dados["reference"] = $referencia;
    $dados["senderCPF"] = str_replace('.', '', str_replace('-', '', $_SESSION['usuario']['cpf'])); // somente digitos
    $dados["senderAreaCode"] = $_SESSION['usuario']['celular'][1] . $_SESSION['usuario']['celular'][2]; //(tipo int) 2 digitos (DDD válido)
    $dados["senderPhone"] = str_replace('-', '', substr($_SESSION['usuario']['celular'], 5)); //(tipo int) 7 a 9 digitos
    $dados["senderBornDate"] = $membros[0]['data_nascimento']; //(dd/MM/aaaa)
    $dados["shippingType"] = '3';
    $dados["shippingAddressPostalCode"] = str_replace('-', '', $membros[0]['cep']); // somente digitos
    $dados["shippingAddressNumber"] = $membros[0]['numero']; // até 20 caracteres

    $nome = explode(" ", $_SESSION['usuario']['nome']);
    if (count($nome) > 1 && strlen($nome[0] . $nome[1]) < 50) {
        $dados["senderName"] = "$nome[0] $nome[1]";
        //pelo menos duas palavras e 50 caracteres no maximo
    }

    if (strlen($_SESSION['usuario']['email']) <= 60) {
        $dados["senderEmail"] = $_SESSION['usuario']['email'];
        //(string) <= 60 caracteres - formato de email válido
    }

    $dados["itemId1"] = "1";
    $dados["itemDescription1"] = "Evento Rondon 2019";
    $dados["itemQuantity1"] = 1;
    $dados["itemAmount1"] = number_format($preco_subtotal, 2, '.', '');
    $dados["extraAmount"] = number_format(-$preco_subtotal * GRUPO_DESCONTO, 2, '.', '');

    $curl = curl_init(PAGSEGURO_CHECKOUT);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1"]);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, PAGSEGURO_SSL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dados));

    unset($_SESSION['usuario']);
    header("location: " . PAGSEGURO_PAYMENT . "?code=" . simplexml_load_string(curl_exec($curl))->code);
    curl_close($curl);
    die();
}

require_once DIR_ROOT . 'views/usuario/pagamento_grupo.php';
