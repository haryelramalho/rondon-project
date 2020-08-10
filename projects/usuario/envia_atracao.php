<?php

session_start();

require_once '../helpers/constantes.php';

if(!isset($_SESSION['usuario']['evento'])){
	header("location: " . SERVER_NAME . "usuario/");
    die();
}

if(count($_POST)){
	$nome = $_SESSION['usuario']['nome'];
	$email_usuario = $_SESSION['usuario']['email'];
	$tipo = filter_input(INPUT_POST, 'tipo');
	$tema = ucwords(strtolower(trim(filter_input(INPUT_POST, 'tema'))));
	$descricao = trim(filter_input(INPUT_POST, 'descricao'));

	/*
		Parte de Haryel enviar o email.
	*/

	die();
}

require_once DIR_ROOT . 'views/usuario/envia_atracao.php';