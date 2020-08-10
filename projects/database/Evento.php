<?php

require_once DIR_ROOT . 'database/Usuario.php';

class Evento extends Usuario {

    /**
     * @var (int) 
     */
    protected $eve_id;

    /**
     * @var (string) 
     */
    protected $nome_social;

    /**
     * @var (string) 
     */
    protected $data_nascimento;

    /**
     * @var (string) 
     */
    protected $instituicao;

    /**
     * @var (string) 
     */
    protected $categoria;

    /**
     * @var (string) 
     */
    protected $sexo;

    /**
     * @var (string) 
     */
    protected $rondonista;

    /**
     * @var (string) 
     */
    protected $cep;

    /**
     * @var (string) 
     */
    protected $uf;

    /**
     * @var (string) 
     */
    protected $cidade;

    /**
     * @var (string) 
     */
    protected $bairro;

    /**
     * @var (string) 
     */
    protected $logradouro;

    /**
     * @var (string) 
     */
    protected $numero;

    /**
     * @var (string) 
     */
    protected $complemento;
    
    
    /**
     * @var (string) 
     */
    protected $alojamento;

    /**
     * @var (float) 
     */
    protected $preco;

    /**
     * @var (string) 
     */
    protected $eve_status;

    /**
     * 'AAAA-MM-DD hh:mm:ss'
     * @var (string)
     */
    protected $data_solicitacao;

    /**
     * @var (string)
     */
    protected $referencia_pagseguro;

    function get_eve_id() {
        return $this->eve_id;
    }

    function get_nome_social() {
        return $this->nome_social;
    }

    /**
     * Retorna a data de nascimento
     * @param (bool) $to_BR Converte a data
     * para o formato usado no Brasil (dd/mm/aaaa)
     * @return (string)
     */
    function get_data_nascimento($to_BR = false) {

        if ($to_BR) {
            return substr($this->data_nascimento, -2) . "/" .
                    substr($this->data_nascimento, -5, 2) . "/" .
                    substr($this->data_nascimento, 0, 4);
        }

        return $this->data_nascimento;
    }

    function get_instituicao() {
        return $this->instituicao;
    }

    /**
     * Retorna a categoria
     * 1 - Professor
     * 2 - Aluno da graduação
     * 3 - Aluno da pós-graduação
     * 4 - Outros
     * @param (bool) $extenso Retorna a categoria por extenso
     * com base na tabela acima
     * @return (string)
     */
    function get_categoria($extenso = false) {

        if ($extenso) {

            switch ($this->categoria) {

                case '1':
                    return "Professor";
                case '2':
                    return "Aluno da graduação";
                case '3':
                    return "Aluno da pós-graduação";
                default:
                    return "Outros";
            }
        }

        return $this->categoria;
    }

    /**
     * Retorna o sexo
     * [F - Feminino, M - Masculino]
     * @param (bool) $extenso Retorna o sexo por extenso
     * com base na tabela acima
     * @return (string)
     */
    function get_sexo($extenso = false) {

        if ($extenso) {
            return ($this->sexo == 'F') ? "Feminino" : "Masculino";
        }

        return $this->sexo;
    }

    /**
     * Retorna o atributo rondonista
     * [S - Sim, N - Não]
     * @param (bool) $extenso Retorna por extenso
     * com base na tabela acima
     * @return (string)
     */
    function get_rondonista($extenso = false) {

        if ($extenso) {
            return ($this->rondonista == 'S') ? "Sim" : "Não";
        }

        return $this->rondonista;
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
    
    function get_alojamento($extenso = false) {
        
        if ($extenso) {
            
            switch ($this->alojamento) {
                
                case '1': return "Interesse";
                case '2': return "Não tem Interesse";
                default : return "Não opinou";
            }
        }
        
        return $this->alojamento;
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
     * Consulte a documentacao do pagseguro a respeito dos estados de pagamento 
     * @link https://dev.pagseguro.uol.com.br/docs/checkout-web-notificacoes#section--a-name-status-da-transacao-a-status-da-transa-o description
     * @param (bool) $extenso Retorna o status por extenso
     * @return (string)
     */
    function get_eve_status($extenso = false) {

        if ($extenso) {

            switch ($this->eve_status) {

                case '1' :
                    return "Aguardando pagamento";
                case '2' :
                    return "Em análise";
                case '3' :
                case '4' :
                    return "Pagamento confirmado";
                case '5' :
                    return "Em disputa";
                case '6' :
                    return "Dinheiro devolvido";
                case '7' :
                    return "Cancelado";
                case '8' :
                    return "Debitado";
                case '9' :
                    return "Retenção temporária";
            }
        }

        return $this->eve_status;
    }

    /**
     * 'AAAA-MM-DD hh:mm:ss'
     * @return (string)
     */
    function get_data_solicitacao() {
        return $this->data_solicitacao;
    }

    function get_referencia_pagseguro() {
        return $this->referencia_pagseguro;
    }

    function set_eve_id($eve_id) {
        $this->eve_id = (int) $eve_id;
    }

    function set_nome_social($nome_social) {
        $this->nome_social = $nome_social;
    }

    /**
     * Muda a data de nascimento
     * @param (string) $data_nascimento A nova data de nascimento
     * @param (bool) $to_MySql Converte a data no
     * formato adequado para ser armazenado no
     * banco de dados (aaaa-mm-dd)
     */
    function set_data_nascimento($data_nascimento, $to_MySql = false) {

        if ($to_MySql) {
            $this->data_nascimento = substr($data_nascimento, -4) . "-" .
                    substr($data_nascimento, 3, 2) . "-" .
                    substr($data_nascimento, 0, 2);
        } else {
            $this->data_nascimento = $data_nascimento;
        }
    }

    function set_instituicao($instituicao) {
        $this->instituicao = $instituicao;
    }

    function set_categoria($categoria) {
        $this->categoria = $categoria;
    }

    function set_sexo($sexo) {
        $this->sexo = $sexo;
    }

    function set_rondonista($rondonista) {
        $this->rondonista = $rondonista;
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
    
    function set_alojamento($alojamento) {
        $this->alojamento = $alojamento;
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

    function set_eve_status($eve_status) {
        $this->eve_status = $eve_status;
    }

    /**
     * @param (string) $data_solicitacao
     * 'AAAA-MM-DD hh:mm:ss'
     */
    function set_data_solicitacao($data_solicitacao) {
        $this->data_solicitacao = $data_solicitacao;
    }

    function set_referencia_pagseguro($referencia_pagseguro) {
        $this->referencia_pagseguro = $referencia_pagseguro;
    }

}
