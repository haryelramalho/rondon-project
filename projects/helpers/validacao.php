<?php

function validar_nome($nome) {
    return strlen($nome) >= 3 && strlen($nome) <= 255;
}

function validar_mensagem($mensagem) {
    return strlen($mensagem) >= 5 && strlen($mensagem) <= MAX_MENSAGEM;
}

function validar_uf($uf) {
    return ctype_upper($uf) && strlen($uf) == 2;
}

function validar_num_casa($numero) {

    $numero = filter_var($numero, FILTER_VALIDATE_INT);

    if ($numero !== false) {
        return $numero > 0 && $numero < 10000;
    }

    return false;
}

function validar_endereco($endereco) {
    return strlen($endereco) >= 3 && strlen($endereco) <= 255;
}

function validar_preco($preco) {

    if (strpos($preco, ',') + 3 === strlen($preco)) {

        $preco = filter_var(str_replace(',', '.', $preco), FILTER_VALIDATE_FLOAT);

        if ($preco !== false) {
            return $preco >= 0 && $preco < 10000;
        }
    }

    return false;
}

function validar_assunto($assunto) {

    return $assunto == 'Problemas Técnicos' || $assunto == 'Reclamações' ||
            $assunto == 'Dúvidas';
}

function validar_categoria($categoria) {

    switch ($categoria) {
        case '1' :
        case '2' :
        case '3' :
        case '4' :
            return true;
        default:
            return false;
    }
}

function consultar_email($email) {

    require_once 'database/UsuarioDAO.php';

    $usuarioDAO = new UsuarioDAO();
    $usuarios = $usuarioDAO->selecionar();
    $qtd_usuarios = count($usuarios);

    for ($i = 0; $i < $qtd_usuarios; $i++) {

        if ($usuarios[$i]->get_email() == $email) {
            return true;
        }
    }

    return false;
}

function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validar_fotos($fotos) {

    $qtd = count($fotos['name']);
    for ($i = 0; $i < $qtd; $i++) {

        if ($fotos['error'][$i] != UPLOAD_ERR_OK) {
            return false;
        }

        $check = getimagesize($fotos['tmp_name'][$i]);

        if ($check === false) {
            return false;
        }

        if ($fotos['size'][$i] > MAX_IMAGESIZE * 1024 * 1024) {
            return false;
        }

        if ($check['mime'] != 'image/png' && $check['mime'] != 'image/jpeg') {
            return false;
        }
    }

    return true;
}

function validar_area($area) {
    
    switch ($area) {
        case '1' :
        case '2' :
        case '3' :
        case '4' :
        case '5' :
        case '6' :
        case '7' :
        case '8' :
            return true;
        default:
            return false;
    }
}

function validar_arquivos($arquivos) {

    if ($arquivos['error'][0] !==  UPLOAD_ERR_OK ||
            $arquivos['error'][1] !==  UPLOAD_ERR_OK) {
        return false;
    }
    
    if (strtolower(pathinfo($arquivos['name'][0], PATHINFO_EXTENSION)) != "docx" ||
            strtolower(pathinfo($arquivos['name'][1], PATHINFO_EXTENSION)) != "pdf") {
        return false;
    }
    
    if ($arquivos['size'][0] > MAX_DOCUMENTSIZE * 1024 * 1024 ||
            $arquivos['size'][1] > MAX_DOCUMENTSIZE * 1024 * 1024) {
        return false;
    }
    
    return true;
}

function validar_senhas($senha_1, $senha_2) {

    if (strlen($senha_1) < 5 || strlen($senha_1) > 255) {
        return false;
    }

    if (!ctype_alnum($senha_1)) {
        return false;
    }

    if ($senha_1 !== $senha_2) {
        return false;
    }

    return true;
}

function validar_cep($cep) {
    return preg_match('/^[0-9]{5}-[0-9]{3}\z/', $cep);
}

function validar_telcel($telcel, $tipo) {

    if ($tipo == CELULAR) {
        return preg_match("/^[(][0-9]{2}[)][ ][0-9]{5}[-][0-9]{4}\z/", $telcel);
    }

    if ($telcel) {
        return preg_match("/^[(][0-9]{2}[)][ ][0-9]{4}[-][0-9]{4}\z/", $telcel);
    }

    return true;
}

function validar_data($data) {

    if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}\z/', $data)) {

        if ((int) substr($data, 6) >= 1900 && (int) substr($data, 6) <= 2010) {
            return checkdate(
                    (int) ($data[3] . $data[4]), (int) ($data[0] . $data[1]), (int) substr($data, 6)
            );
        }
    }

    return false;
}

function consultar_cpf($cpf) {

    require_once 'database/UsuarioDAO.php';

    $usuarioDAO = new UsuarioDAO();
    $usuarios = $usuarioDAO->selecionar();
    $qtd_usuarios = count($usuarios);

    for ($i = 0; $i < $qtd_usuarios; $i++) {

        if ($usuarios[$i]->get_cpf() == $cpf) {
            return true;
        }
    }

    return false;
}

function validar_cpf($cpf) {

    if (preg_match('/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}\z/', $cpf)) {

        $digitos = array();

        for ($i = 0; $i < 3; $i++) {
            array_push($digitos, (int) substr($cpf, $i, 1));
        }
        for ($i++; $i < 7; $i++) {
            array_push($digitos, (int) substr($cpf, $i, 1));
        }
        for ($i++; $i < 11; $i++) {
            array_push($digitos, (int) substr($cpf, $i, 1));
        }
        for ($soma = 0, $i = 0; $i < 9; $i++) {
            $soma += $digitos[$i] * (10 - $i);
        }

        $dv1 = 11 - $soma % 11;

        if ($dv1 > 9) {
            $dv1 = 0;
        }

        if ($dv1 == (int) $cpf[12]) {

            for ($soma = 0, $i = 0; $i < 9; $i++) {
                $soma += $digitos[$i] * (11 - $i);
            }

            $soma += $dv1 * 2;
            $dv2 = 11 - $soma % 11;

            if ($dv2 > 9) {
                $dv2 = 0;
            }

            if ($dv2 == (int) $cpf[13]) {
                return true;
            }
        }
    }

    return false;
}
