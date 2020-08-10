<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/EventoDAO.php';

if (!isset($_SESSION['usuario'])) {
    
    header("location: " . SERVER_NAME . "login.php");
    die();
}

if (!$_SESSION['usuario']['evento']) {
    
    header("location: " . SERVER_NAME . "usuario/");
    die();
}

$status = $_SESSION['usuario']['evento']['cod_status'];

if ($status != '1' && $status != '7') {
    
    header("location: " . SERVER_NAME . "usuario/");
    die();
}

$eventoDAO = new EventoDAO();
$eventos = $eventoDAO->selecionar();

foreach ($eventos as $evento) {
    
    if ($evento->get_eve_id() == $_SESSION["usuario"]["evento"]["id"]) {
        
        $evento->set_referencia_pagseguro("I.{$_SESSION["usuario"]["id"]}." . date("mdHis") . md5((string) random_int(-10000 ,10000)));
        $eventoDAO->atualizar($evento);
        
        $dados["email"] = PAGSEGURO_EMAIL;
        $dados["token"] = PAGSEGURO_TOKEN;
        $dados["notificationURL"] = SERVER_NAME . "notificacao_pagseguro.php";
        $dados["currency"] = "BRL";
        $dados["reference"] = $evento->get_referencia_pagseguro();
        $dados["senderCPF"] = str_replace('.', '', str_replace('-', '', $_SESSION['usuario']['cpf'])); // somente digitos
        $dados["senderAreaCode"] = $_SESSION['usuario']['celular'][1] . $_SESSION['usuario']['celular'][2]; //(tipo int) 2 digitos (DDD válido)
        $dados["senderPhone"] = str_replace('-', '', substr($_SESSION['usuario']['celular'], 5)); // "988248529"; //(tipo int) 7 a 9 digitos
        $dados["senderBornDate"] = $evento->get_data_nascimento(true); //(dd/MM/aaaa)
        $dados["shippingType"] = "3";
        $dados["shippingAddressPostalCode"] = str_replace('-', '', $evento->get_cep()); //somente digitos
        $dados["shippingAddressNumber"] = $evento->get_numero(); // Livre, com limite de 20 caracteres

        $nome = explode(" ", $_SESSION['usuario']['nome']);
        if (count($nome) > 1 && strlen($nome[0] . $nome[1]) < 50) {
            $dados["senderName"] = "$nome[0] $nome[1]";
            //pelo menos duas palavras e 50 caracteres no maximo
        }
        
        $dados["senderEmail"] = $_SESSION['usuario']['email'];
        if (strlen($_SESSION['usuario']['email']) <= 60) {
            $dados["senderEmail"] = $_SESSION['usuario']['email'];
            //(string) <= 60 caracteres - formato de email válido
        }

        $dados["itemId1"] = "1";
        $dados["itemDescription1"] = "Evento Rondon 2019";
        $dados["itemQuantity1"] = 1;
        $dados["itemAmount1"] = number_format($evento->get_preco(), 2, '.', '');

        $curl = curl_init(PAGSEGURO_CHECKOUT);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, PAGSEGURO_SSL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dados));

        unset($_SESSION["usuario"]);
        header("location: " . PAGSEGURO_PAYMENT . "?code=" . simplexml_load_string(curl_exec($curl))->code);
        curl_close($curl);
    }
}
