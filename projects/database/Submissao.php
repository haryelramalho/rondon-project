<?php

require_once DIR_ROOT . 'database/Evento.php';

/**
 * Classe que representa a tabela Submissão
 * do banco de dados
 * @author tecnojr
 */
class Submissao extends Evento {

    /**
     * @var int
     */
    private $subm_id;

    private $aval_id;

    /**
     * @var string
     */
    private $area;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $autores;

    /**
     * @var float
     */
    private $nota;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var string
     */
    private $subm_status;

    function get_subm_id() {
        return $this->subm_id;
    }

    function get_aval_id() {
        return $this->aval_id;
    }

    /**
     * 1 - Cultura,
     * 2 - Direitos Humanos e Justiça,
     * 3 - Educação,
     * 4 - Saúde,
     * 5 - Comunicação,
     * 6 - Tecnologia e Produção,
     * 7 - Meio Ambiente,
     * 8 - Trabalho
     * @param (bool) $extenso 
     * Retorna a area por extenso
     * @return (string)
     */
    function get_area($extenso = false) {
        if ($extenso) {
            switch ($this->area) {
                case '1':
                    return "Cultura";
                case '2':
                    return "Direitos Humanos e Justiça";
                case '3':
                    return "Educação";
                case '4':
                    return "Saúde";
                case '5':
                    return "Comunicação";
                case '6':
                    return "Tecnologia e Produção";
                case '7':
                    return "Meio Ambiente";
                case '8':
                    return "Trabalho";
            }
        }
        return $this->area;
    }

    function get_titulo() {
        return $this->titulo;
    }

    function get_autores($to_array = false) {

        if ($to_array) {
            return explode("; ", $this->autores);
        }

        return $this->autores;
    }

    function get_nota($to_BR = false) {
        
        if ($to_BR) {
            return number_format($this->nota, 2, ",", ".");
        }
        
        return $this->nota;
    }

    function get_comentario() {
        return $this->comentario;
    }

    /**
     * E - Em Andamento,
     * C - Em Correção,
     * R - Reprovado,
     * A - Aprovado
     * @param (bool) $extenso 
     * Retorna o status por extenso
     * @return (string)
     */
    function get_subm_status($extenso = false) {

        if ($extenso) {

            switch ($this->subm_status) {

                case 'E' :
                    return "Em Andamento";
                case 'C' :
                    return "Em Correção";
                case 'A' :
                    return "Aprovado";
                default :
                    return "Reprovado";
            }
        }

        return $this->subm_status;
    }

    function set_subm_id($id) {
        $this->subm_id = (int) $id;
    }

    function set_aval_id($aval_id) {
        $this->aval_id = $aval_id;
    }

    function set_area($area) {
        $this->area = $area;
    }

    function set_titulo($titulo) {
        $this->titulo = $titulo;
    }

    function set_autores($autores, $is_array = false) {

        if ($is_array) {
            $this->autores = implode("; ", $autores);
        } else {
            $this->autores = $autores;
        }
    }

    /**
     * Muda o atributo preço
     * @param string $preco O novo preço
     * @param bool $to_EN Converte o preço no formato em inglês
     * ($ 0.00)
     */
    function set_nota($preco, $to_EN = false) {

        if ($to_EN) {
            $this->nota = (float) str_replace(',', '.', $preco);
        } else {
            $this->nota = $preco;
        }
    }

    function set_comentario($comentario) {
        $this->comentario = $comentario;
    }

    function set_subm_status($status) {
        $this->subm_status = $status;
    }

}
