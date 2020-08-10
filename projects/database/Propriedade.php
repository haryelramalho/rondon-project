<?php

require_once DIR_ROOT . 'database/Usuario.php';

/**
 * Classe que representa a tabela Propriedade
 * do banco de dados
 * @author tecnojr
 */
class Propriedade extends Usuario {

    /**
     * @var int
     */
    private $prop_id;

    /**
     * @var string
     */
    private $cep;

    /**
     * @var string
     */
    private $uf;

    /**
     * @var string
     */
    private $cidade;

    /**
     * @var string
     */
    private $bairro;

    /**
     * @var string
     */
    private $logradouro;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var string
     */
    private $complemento;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var float
     */
    private $preco;

    /**
     * @var string
     */
    private $prop_status;

    function get_prop_id() {
        return $this->prop_id;
    }

    function get_cep() {
        return $this->cep;
    }

    function get_uf() {
        return $this->uf;
    }

    function get_cidade() {
        return $this->cidade;
    }

    function get_bairro() {
        return $this->bairro;
    }

    function get_logradouro() {
        return $this->logradouro;
    }

    function get_numero() {
        return $this->numero;
    }

    function get_complemento($extenso = false) {
        
        if ($extenso) {
            return ($this->complemento) ? $this->complemento : "Não contém";
        }
        
        return $this->complemento;
    }

    function get_descricao() {
        return $this->descricao;
    }

    /**
     * Retorna o preço
     * @param bool $to_BR O preço retornado fica em formato brasileiro
     * (R$ 0,00)
     * @return string|float 
     */
    function get_preco($to_BR = false) {

        if ($to_BR) {
            return number_format($this->preco, 2, ',', '.');
        }

        return $this->preco;
    }

    /**
     * E - Em Andamento,
     * R - Reprovado,
     * A - Aprovado
     * @param (bool) $extenso 
     * Retorna o status por extenso
     * @return (string)
     */
    function get_prop_status($extenso = false) {

        if ($extenso) {

            if ($this->prop_status == 'E') {
                return "Em Andamento";
            } else if ($this->prop_status == 'A') {
                return "Aprovado";
            } else {
                return "Reprovado";
            }
        }

        return $this->prop_status;
    }

    function set_prop_id($prop_id) {
        $this->prop_id = (int) $prop_id;
    }

    function set_cep($cep) {
        $this->cep = $cep;
    }

    function set_uf($uf) {
        $this->uf = $uf;
    }

    function set_cidade($cidade) {
        $this->cidade = $cidade;
    }

    function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    function set_logradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function set_numero($numero) {
        $this->numero = $numero;
    }

    function set_complemento($complemento) {
        $this->complemento = $complemento;
    }

    function set_descricao($descricao) {
        $this->descricao = $descricao;
    }

    /**
     * Muda o atributo preço
     * @param string $preco O novo preço
     * @param bool $to_EN Converte o preço no formato em inglês
     * ($ 0.00)
     */
    function set_preco($preco, $to_EN = false) {

        if ($to_EN) {
            $this->preco = (float) str_replace(',', '.', $preco);
        } else {
            $this->preco = $preco;
        }
    }

    function set_prop_status($prop_status) {
        $this->prop_status = $prop_status;
    }
}
