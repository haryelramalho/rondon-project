<?php

require_once DIR_ROOT . 'database/Avaliador.php';

/**
 * Classe que representa a tabela Avaliação
 * do banco de dados
 * @author tecnojr
 */
class Avaliacao extends Avaliador {

    /**
     * @var int
     */
    private $avaliacao_id;

    /**
     * @var float
     */
    private $nota;

    /**
     * @var string
     */
    private $comentario;
    
    /**
     * @var int
     */
    private $subm_id;
            
    function get_avaliacao_id() {
        return $this->avaliacao_id;
    }

    function get_nota() {
        return $this->nota;
    }

    function get_comentario() {
        return $this->comentario;
    }

    function get_subm_id() {
        return $this->subm_id;
    }

    function set_avaliacao_id($avaliacao_id) {
        $this->avaliacao_id = $avaliacao_id;
    }

    function set_nota($nota) {
        $this->nota = $nota;
    }

    function set_comentario($comentario) {
        $this->comentario = $comentario;
    }

    function set_subm_id($subm_id) {
        $this->subm_id = $subm_id;
    }
}
