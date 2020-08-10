<?php

/**
 * Classe que representa a tabela Usuário
 * do banco de dados
 * @author tecnojr
 */
class Usuario {
    
    /**
     * @var int
     */
    protected $usr_id;
    
    /**
     * @var string
     */
    protected $nome;
    
    /**
     * @var string
     */
    protected $email;
    
    /**
     * @var string
     */
    protected $cpf;
    
    /**
     * @var string
     */
    protected $celular;
    
    /**
     * @var string
     */
    protected $telefone;
    
    /**
     * @var string
     */
    protected $senha;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $usr_status;
    
    function get_usr_id() {
        return $this->usr_id;
    }

    function get_nome() {
        return $this->nome;
    }

    function get_email() {
        return $this->email;
    }

    function get_cpf() {
        return $this->cpf;
    }

    function get_celular() {
        return $this->celular;
    }

    function get_telefone() {
        return $this->telefone;
    }

    function get_senha() {
        return $this->senha;
    }

    function get_token(){
        return $this->token;
    }

    function get_usr_status($extenso = false){
        if($extenso){
            if($this->usr_status >= 1){
                return "Ativo";
            } else{
                return "Inativo";
            }
        }

        return $this->usr_status;
    }

    function set_usr_id($usr_id) {
        $this->usr_id = (int) $usr_id;
    }

    function set_nome($nome) {
        $this->nome = $nome;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    function set_celular($celular) {
        $this->celular = $celular;
    }

    function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    function set_senha($senha) {
        $this->senha = $senha;
    }

    function set_token($token){
        $this->token = $token;
    }

    function set_usr_status($usr_status){
        $this->usr_status = $usr_status;
    }
}
