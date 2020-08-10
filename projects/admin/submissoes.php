<?php 

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

if(!isset($_SESSION["usr_admin"])){
    header('location: ' . SERVER_NAME . "login.php");
    die();
}

$SubmissaoDAO = new SubmissaoDAO();
$submissoes = $SubmissaoDAO->selecionar();

$avaliadorDAO = new AvaliadorDAO();
$avaliadores = $avaliadorDAO->selecionar();

$avals = array();

foreach ($submissoes as $subm) {
    
    if ($subm->get_aval_id()) {
        
        foreach ($avaliadores as $aval) {
            
            if ($aval->get_aval_id() == $subm->get_aval_id()) {
                
                array_push($avals, $aval->get_nome());
                break;
            }
        }
    }
    
    else {
        array_push($avals, "Sem avaliador");
    }
}

require_once DIR_ROOT . 'views/admin/submissoes.php';
