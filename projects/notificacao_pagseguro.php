<?php

require_once 'helpers/constantes.php';
require_once DIR_ROOT . 'database/EventoDAO.php';

$curl = curl_init(PAGSEGURO_NOTIFICATION .
        filter_input(INPUT_POST, 'notificationCode') .
        "?email=" . PAGSEGURO_EMAIL . "&token=" . PAGSEGURO_TOKEN);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, PAGSEGURO_SSL);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$retorno = simplexml_load_string(curl_exec($curl));
curl_close($curl);

if ($retorno !== false) {
    
    $eventoDAO = new EventoDAO();
    $eventos = $eventoDAO->selecionar();
    
    foreach ($eventos as $evento) {
        
        if ($evento->get_referencia_pagseguro() == $retorno->reference) {
            
            $evento->set_eve_status($retorno->status);
            $eventoDAO->atualizar($evento);
        }
    }
}
