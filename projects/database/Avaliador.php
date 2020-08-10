<?php

 require_once DIR_ROOT . 'database/Usuario.php';
 
/**
 * Classe que representa a tabela Avaliador
 * do banco de dados
 * @author tecnojr
 */
class Avaliador extends Usuario {

    /**
     * @var int
     */
    protected $aval_id;

    function get_aval_id() {
        return $this->aval_id;
    }

    function set_aval_id($aval_id) {
        $this->aval_id = (int) $aval_id;
    }
}
