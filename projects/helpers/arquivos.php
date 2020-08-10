<?php

/**
 * Deleta uma árvore de diretórios
 * @param (string) $dir O diretório a ser deletado
 * @return (bool) Retorna TRUE de foi deletado ou FALSE caso contrário
 */
function deletar_arvore($dir) {

    $arquivos = array_diff(scandir($dir), ['.', '..']);

    foreach ($arquivos as $arquivo) {

        if (is_dir("$dir/$arquivo")) {
            deletar_arvore("$dir/$arquivo");
        } else {
            unlink("$dir/$arquivo");
        }
    }

    return rmdir($dir);
}

/**
 * Envia os arquivos pro servidor
 * @param (array) $arquivos Uma matriz de arquivos
 * @param (string) $pathname O diretório onde serão guardadas as fotos
 * @param (string) $names O prefixo dos arquivos a serem enviados
 * @return (bool) Retorna TRUE se foi feito o upload ou FALSE caso contrário
 */
function enviar_arquivos($arquivos, $pathname, $names) {
    
    $qtd = count($arquivos['name']);

    if (!is_dir($pathname)) {
        mkdir($pathname, 0777, true);
    }

    for ($i = 1; $i <= $qtd; $i++) {

        $filename = "$pathname/{$names}$i." .
                strtolower(pathinfo($arquivos['name'][$i - 1], PATHINFO_EXTENSION));

        if (!move_uploaded_file($arquivos['tmp_name'][$i - 1], $filename)) {
            break;
        }
    }

    return $i > $qtd;
}
