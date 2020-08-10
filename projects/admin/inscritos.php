<?php 

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'database/EventoDAO.php';

if(!isset($_SESSION['usr_admin'])){
	header("location: " . SERVER_NAME . "login.php");
	die();
}

$email = '';
$celular = '';

$UsuarioDAO = new UsuarioDAO();
$usuarios = $UsuarioDAO->selecionar();
$qtd_usuarios = count($usuarios);

$EventoDAO = new EventoDAO();
$users_eve = $EventoDAO->selecionar();
$qtd_users_eve = count($users_eve);

require_once DIR_ROOT . 'views/admin/inscritos.php';