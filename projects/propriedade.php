<?php

session_start();

require_once 'helpers/constantes.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';
require_once DIR_ROOT . 'database/UsuarioDAO.php';
require_once DIR_ROOT . 'helpers/arquivos.php';

if (!isset($_SESSION['usuario']) && !isset($_SESSION['usr_admin'])) {

    header('location:' . SERVER_NAME . 'login.php');
    die();
}

$id = filter_input(INPUT_GET, 'id');
$propriedadeDAO = new PropriedadeDAO();
$propriedades = $propriedadeDAO->selecionar();
$qtd_prop = count($propriedades);

for ($i = 0; $i < $qtd_prop; $i++) {
    if ($propriedades[$i]->get_prop_id() == $id) {
        break;
    }
}

if (($i == $qtd_prop) || ($propriedades[$i]->get_prop_status() !== 'A' &&
        !isset($_SESSION['usr_admin']) &&
        $propriedades[$i]->get_usr_id() != $_SESSION['usuario']['id'])) {
    header('location: ' . SERVER_NAME . 'hospedagem.php');
    die();
}
/*
 * Comentário acima: Se o status não for aprovado exibe a página somente ao
 * proprietário. Retirar esse comentário depois dos testes.
*/

$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->selecionar();
$qtd_usr = count($usuarios);

for ($j = 0; $j < $qtd_usr; $j++) {
    if ($usuarios[$j]->get_usr_id() == $propriedades[$i]->get_usr_id()) {
        break;
    }
}

$proprietario = $usuarios[$j]->get_nome();

$endereco = "{$propriedades[$i]->get_logradouro()}, Nº {$propriedades[$i]->get_numero()}. "
        . "{$propriedades[$i]->get_bairro()}. {$propriedades[$i]->get_cidade()} - "
        . "{$propriedades[$i]->get_uf()}";

$complemento = $propriedades[$i]->get_complemento(true);

$email = $usuarios[$j]->get_email();

$celular = $usuarios[$j]->get_celular();

$diaria = $propriedades[$i]->get_preco(true);
$descricao = $propriedades[$i]->get_descricao();

$dir = "uploads" . DIRECTORY_SEPARATOR . $propriedades[$i]->get_usr_id() .
        DIRECTORY_SEPARATOR . "propriedades" . DIRECTORY_SEPARATOR . $id;

$fotos = array_diff(scandir($dir), ['.', '..']);
$qtd_fotos = count($fotos) + 2;

require_once DIR_ROOT . 'views/propriedade.php';
