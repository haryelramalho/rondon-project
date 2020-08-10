<?php

/*
 * Aqui devem ficar todas as constantes
 * utilizadas no projeto
 */

date_default_timezone_set("America/Bahia");

// Caminhos absolutos do site
$subpasta = "./";
define("SERVER_NAME", "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER["SERVER_NAME"]}/$subpasta");
define("DIR_ROOT", "{$_SERVER["DOCUMENT_ROOT"]}/$subpasta");
unset($subpasta);

// Credenciais do Banco de Dados (local)
define("DB_SERVER", "mysql");
define("DB_NAME", "rondon");
define("DB_HOST", "mysql");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");

// Credenciais do Banco de Dados (Servidor)
// define("DB_SERVER", "mysql");
// define("DB_NAME", "redero35_rondon");
// define("DB_HOST", "localhost");
// define("DB_USERNAME", "redero35_root");
// define("DB_PASSWORD", "-XXjv(pR@Y{5");

//new token plataforma real
//812047cc-174e-4440-b16e-c436e8b914aa4ddcde764cb6a3bd130f4d92a2088fa354d7-d641-47d4-8d8d-cbb0a1e9e2da

//token sandbox
//1A80EFAD03144B49836F576132EA467F

// Credenciais do administrador
define("ADMIN_EMAIL", "admin");
define("ADMIN_SENHA", "admin");

// Credenciais do pagseguro
// define("PAGSEGURO_EMAIL", "");
// define("PAGSEGURO_TOKEN", "");
// define("PAGSEGURO_CHECKOUT", "");
// define("PAGSEGURO_PAYMENT", "");
// define("PAGSEGURO_NOTIFICATION", "");
// define("PAGSEGURO_SSL", true);

// Informações sobre inscrição de grupos
define("GRUPO_MIN", 10);
define("GRUPO_MAX", 100);
define("GRUPO_DESCONTO", 0.1); // 0 a 1

// Constantes utilizadas para validação
// e afins
define("CELULAR", 1);
define("TELEFONE", 2);
define("QTD_FOTOS", 3);
define("MAX_MENSAGEM", 550);
define("MAX_IMAGESIZE", 5); // em MB
define("MAX_DOCUMENTSIZE", 100); // em MB
define("IMAGE_TYPES", ["image/jpeg", "image/png"]);

// Tabela de precos

define("PRECO_DIA", 1);
define("PRECO_MES", 9);

define("PRECO_PROFESSOR1", "150.00");
define("PRECO_GRADUADO1", "30.00");
define("PRECO_POSGRADUADO1", "100.00");
define("PRECO_OUTROS1", "150.00");

/*define("PRECO_PROFESSOR2", "200.00");
define("PRECO_GRADUADO2", "50.00");
define("PRECO_POSGRADUADO2", "150.00");
define("PRECO_OUTROS2", "200.00");*/

define("PRECO_PROFESSOR2", "150.00");
define("PRECO_GRADUADO2", "30.00");
define("PRECO_POSGRADUADO2", "100.00");
define("PRECO_OUTROS2", "150.00");

define("PRECO_ENCERRAMENTO", "20.00");
define("PRECO_JANTAR", "20.00");