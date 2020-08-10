<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'helpers/arquivos.php';
require_once DIR_ROOT . 'database/PropriedadeDAO.php';

if (!isset($_SESSION["usuario"])) {
    header('location: login.php');
    die();
}

$propriedadeDAO = new PropriedadeDAO();

if (count($_POST)) {

    $cep = filter_input(INPUT_POST, 'cep');
    $uf = filter_input(INPUT_POST, 'uf');
    $cidade = ucwords(strtolower(trim(filter_input(INPUT_POST, 'cidade'))));
    $bairro = ucwords(strtolower(trim(filter_input(INPUT_POST, 'bairro'))));
    $logradouro = ucwords(strtolower(trim(filter_input(INPUT_POST, 'logradouro'))));
    $numero = filter_input(INPUT_POST, 'numero');
    $complemento = ucwords(strtolower(trim(filter_input(INPUT_POST, 'complemento'))));
    $descricao = filter_input(INPUT_POST, 'descricao');
    $preco = str_replace('.', '', filter_input(INPUT_POST, 'preco'));

    if (validar_cep($cep) && validar_uf($uf) && validar_endereco($cidade) &&
            validar_endereco($bairro) && validar_endereco($logradouro) &&
            validar_num_casa($numero) && validar_mensagem($descricao) &&
            validar_preco($preco) && validar_fotos($_FILES['fotos']) &&
            (!$complemento || validar_endereco($complemento))) {

        $propriedade = new Propriedade();

        $propriedade->set_usr_id($_SESSION["usuario"]["id"]);
        $propriedade->set_cep($cep);
        $propriedade->set_uf($uf);
        $propriedade->set_cidade($cidade);
        $propriedade->set_bairro($bairro);
        $propriedade->set_logradouro($logradouro);
        $propriedade->set_numero($numero);
        $propriedade->set_complemento($complemento);
        $propriedade->set_descricao($descricao);
        $propriedade->set_preco($preco, true);
        $propriedade->set_prop_status('E');

        if ($propriedadeDAO->inserir($propriedade)) {

            $propriedades = $propriedadeDAO->selecionar($_SESSION["usuario"]["id"]);
            $id = end($propriedades)->get_prop_id();

            if (enviar_arquivos($_FILES['fotos'], DIR_ROOT . "uploads/{$_SESSION['usuario']['id']}/propriedades/$id", "foto")) {

                echo 'S';
                die();
            }
            
            deletar_arvore(DIR_ROOT . "uploads/{$_SESSION['usuario']['id']}/propriedades/$id");
            $propriedadeDAO->deletar($id);
        }
    }

    echo 'N';
    die();
}

require_once DIR_ROOT . 'views/usuario/inscricao_imovel.php';
