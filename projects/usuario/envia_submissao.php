<?php

session_start();

require_once '../helpers/constantes.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'helpers/validacao.php';
require_once DIR_ROOT . 'helpers/arquivos.php';

/*if (isset($_SESSION['usuario'])) {

    header("location: " . SERVER_NAME . "usuario/");
    die();
}*/

$qtd_nomes = 0;

if (count($_POST)) {

    $titulo = ucwords(strtolower(trim(filter_input(INPUT_POST, 'titulo'))));
    $area = filter_input(INPUT_POST, 'area');

    if (isset($_POST['nomes'])) {

        $autores = $_POST['nomes'];

        for ($i = 0; $i < count($autores); $i++) {

            $autores[$i] = ucwords(strtolower(filter_var($autores[$i])));

            if (!validar_nome($autores[$i]) ||
                    $autores[$i] == $_SESSION['usuario']['nome']) {

                header("location: " . SERVER_NAME . "usuario/submissao.php");
                die();
            }
        }
    }
    
    if (!validar_nome($titulo) || !validar_area($area) ||
            !validar_arquivos($_FILES['arquivos'])) {
        header("location: " . SERVER_NAME . "usuario/submissao.php");
        die();
    }
    
    $submissao = new Submissao();
    $submissao->set_eve_id($_SESSION['usuario']['evento']['id']);
    $submissao->set_titulo($titulo);
    $submissao->set_area($area);
    $submissao->set_subm_status('E');
    
    if (isset($autores)) {
        $submissao->set_autores(array_merge([$_SESSION['usuario']['nome']], $autores), true);
    } else {
        $submissao->set_autores([$_SESSION['usuario']['nome']], true);
    }
    
    $submissaoDAO = new SubmissaoDAO();
    
    if ($submissaoDAO->inserir($submissao)) {
        
        $array = $submissaoDAO->selecionar($submissao->get_eve_id());
        $subm_id = end($array)->get_subm_id();
        
        $filename = DIR_ROOT . "uploads/{$_SESSION['usuario']['id']}/submissoes/$subm_id";
        
        if (enviar_arquivos($_FILES['arquivos'], $filename, "arquivo")) {
            
            echo 'S';
            
            rename("$filename/arquivo1.docx", "$filename/" . md5(date("d/i:s")) . ".docx");
            
            $file = fopen("$filename/index.php", "w");
            fclose($file);
            
            die();
        } else {
            $submissaoDAO->deletar($subm_id);
        }
    }
    
    echo 'N';
    die();
}

require_once DIR_ROOT . 'views/usuario/envia_submissao.php';
