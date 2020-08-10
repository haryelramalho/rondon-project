<?php

require_once 'helpers/constantes.php';

$dir = DIR_ROOT . "uploads/";
$usuarios = array_diff(scandir($dir), ['.', '..']);

foreach ($usuarios as $usuario) {

    if (is_dir("$dir$usuario/submissoes")) {

        $f = "$dir$usuario/submissoes/";
        $submissoes = array_diff(scandir($f), ['.', '..']);

        foreach ($submissoes as $submissao) {

            $fr = $f . "$submissao/";

            $file = fopen("{$fr}index.php", "w");
            fclose($file);

            echo "<br>oldname={$fr}arquivo1.docx";
            $newname = $fr . md5(random_int(-1000, 1000)) . ".docx";
            rename("{$fr}arquivo1.docx", $newname);
            echo "<br>newname=$newname";
        }
    }
}
