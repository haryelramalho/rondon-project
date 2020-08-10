<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';

if (!isset($_SESSION['usr_admin'])) {
    header("location: login.php");
    die();
}

$id = filter_input(INPUT_GET, 'id');
$status = filter_input(INPUT_GET, 'status');

$propriedadeDAO = new PropriedadeDAO();

$propriedades = $propriedadeDAO->selecionar();

if (count($_GET)) {
    
    foreach ($propriedades as $propriedade) {
        
        if ($propriedade->get_prop_id() == $id) {
            
            if ($status == 'E' || $status == 'R' || $status == 'A') {
                
                $propriedade->set_prop_status($status);
                
                echo $propriedadeDAO->atualizar($propriedade);
                die();
            }
        }
    }
}

require_once DIR_ROOT . 'views/admin/propriedades.php';

