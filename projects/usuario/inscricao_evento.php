<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'database/EventoDAO.php';

if (!isset($_SESSION['usuario'])) {

    header("location: " . SERVER_NAME . "login.php");
    die();
}

$eventoDAO = new EventoDAO();
$eventos = $eventoDAO->selecionar();
$atualizar = false;

if (isset($_SESSION['usuario']['evento'])) {

    if ($_SESSION["usuario"]["evento"]["cod_status"] != '1' &&
            $_SESSION["usuario"]["evento"]["cod_status"] != '7') {
        header("location: " . SERVER_NAME . "usuario/");
        die();
    }

    $atualizar = true;
    $eve_id = $_SESSION["usuario"]["evento"]["id"];
}

$nome_social = ucwords(strtolower(trim(filter_input(INPUT_POST, 'nome_social'))));
$data_nascimento = filter_input(INPUT_POST, 'nascimento');
$instituicao = ucwords(strtolower(filter_input(INPUT_POST, 'instituicao')));
$categoria = filter_input(INPUT_POST, 'categoria');
$sexo = filter_input(INPUT_POST, 'sexo');
$rondonista = filter_input(INPUT_POST, 'rondonista');
$cep = filter_input(INPUT_POST, 'cep');
$uf = filter_input(INPUT_POST, 'uf');
$cidade = filter_input(INPUT_POST, 'cidade');
$bairro = ucwords(strtolower(filter_input(INPUT_POST, 'bairro')));
$logradouro = ucwords(strtolower(filter_input(INPUT_POST, 'logradouro')));
$numero = filter_input(INPUT_POST, 'numero');
$complemento = filter_input(INPUT_POST, 'complemento');

if (count($_POST)) {

    if (
        validar_nome($nome_social) && validar_data($data_nascimento) &&
        validar_nome($instituicao) && validar_categoria($categoria) &&
        validar_cep($cep) && validar_uf($uf) && validar_endereco($cidade) &&
        validar_endereco($bairro) && validar_endereco($logradouro) &&
        validar_num_casa($numero) && (!$complemento || validar_endereco($complemento))
    ) {

        $evento = new Evento();

        $evento->set_usr_id($_SESSION['usuario']['id']);
        $evento->set_nome_social($nome_social);
        $evento->set_data_nascimento($data_nascimento, true);
        $evento->set_instituicao($instituicao);
        $evento->set_categoria($categoria);
        $evento->set_sexo(($sexo == 'F') ? 'F' : 'M');
        $evento->set_rondonista(($rondonista == 'S') ? 'S' : 'N');
        $evento->set_cep($cep);
        $evento->set_uf($uf);
        $evento->set_cidade($cidade);
        $evento->set_bairro($bairro);
        $evento->set_logradouro($logradouro);
        $evento->set_numero($numero);
        $evento->set_complemento($complemento);
        $evento->set_data_solicitacao(date("Y-m-d H:i:s")); // Conferir fuso horário
        $evento->set_eve_status('1');
        $evento->set_referencia_pagseguro("M");
        $evento->set_preco(preco_evento($categoria, (int) date("m"), (int) date("d")));

        if ($atualizar) {
            $evento->set_eve_id($eve_id);
            $retorno = $eventoDAO->atualizar($evento);
        } else {
            $retorno = $eventoDAO->inserir($evento);
        }
        
        header("location: " . SERVER_NAME . "usuario/");
        die();
    }
}

require_once DIR_ROOT . 'views/usuario/inscricao_evento.php';

/**
 * Determina o preço a pagar com base na categoria e data de solicitação
 * @param (string) $categoria A categoria do usuário
 * @param (int) $mes O mês no qual foi feita a solicitação
 * @param (int) $dia O dia no qual foi feita a solicitação
 * @return (string) Retorna o preço determinado
 */
function preco_evento($categoria, $mes, $dia) {

    if ($mes < PRECO_MES || ($mes == PRECO_MES && $dia < PRECO_DIA)) {

        switch ($categoria) {
            case '1' :
                return PRECO_PROFESSOR1;
            case '2' :
                return PRECO_GRADUADO1;
            case '3' :
                return PRECO_POSGRADUADO1;
            default :
                return PRECO_OUTROS1;
        }
    }

    switch ($categoria) {
        case '1' :
            return PRECO_PROFESSOR2;
        case '2' :
            return PRECO_GRADUADO2;
        case '3' :
            return PRECO_POSGRADUADO2;
        default :
            return PRECO_OUTROS2;
    }
}
