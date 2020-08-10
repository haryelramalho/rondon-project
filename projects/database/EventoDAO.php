<?php

require_once DIR_ROOT . 'database/Evento.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/AvaliacaoDAO.php';

class EventoDAO {

    private $conexao;

    /**
     * Inicializa a conexão com o banco
     */
    public function __construct() {

        $this->conexao = DB_SERVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $this->conexao = new PDO($this->conexao, DB_USERNAME, DB_PASSWORD);
    }

    /**
     * Insere um 'evento' no Banco de dados
     * @param Evento $evento O 'evento' a ser cadastrado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function inserir(Evento $evento) {

        $query = "INSERT INTO evento (usr_id, eve_nome_social, eve_data_nascimento, "
                . "eve_instituicao, eve_categoria, eve_sexo, eve_rondonista, eve_cep, "
                . "eve_uf, eve_cidade, eve_bairro, eve_logradouro, eve_numero, eve_complemento, "
                . "eve_preco, eve_status, eve_data_solicitacao, eve_refererencia_pagseguro) "
                . "VALUES (:id, :nome_social, :data_nascimento, :instituicao, :categoria, "
                . ":sexo, :rondonista, :cep, :uf, :cidade, :bairro, :logradouro, :numero, "
                . ":complemento, :preco, :status, :data_solicitacao, :refererencia_pagseguro)";

        return $this->conexao->prepare($query)->execute(array(
                    ':id' => $evento->get_usr_id(),
                    ':nome_social' => $evento->get_nome_social(),
                    ':data_nascimento' => $evento->get_data_nascimento(),
                    ':instituicao' => $evento->get_instituicao(),
                    ':categoria' => $evento->get_categoria(),
                    ':sexo' => $evento->get_sexo(),
                    ':rondonista' => $evento->get_rondonista(),
                    ':cep' => $evento->get_cep(),
                    ':uf' => $evento->get_uf(),
                    ':cidade' => $evento->get_cidade(),
                    ':bairro' => $evento->get_bairro(),
                    ':logradouro' => $evento->get_logradouro(),
                    ':numero' => $evento->get_numero(),
                    ':complemento' => $evento->get_complemento(),
                    ':preco' => $evento->get_preco(),
                    ':status' => $evento->get_eve_status(),
                    ':data_solicitacao' => $evento->get_data_solicitacao(),
                    ':refererencia_pagseguro' => $evento->get_referencia_pagseguro()
        ));
    }

    /**
     * Lista os 'eventos' do banco de dados
     * @return \Evento Retorna um vetor de 'eventos'
     */
    function selecionar($eve_id = 0) {

        $query = "SELECT eve_id, usr_id, eve_nome_social, eve_data_nascimento, "
                . "eve_instituicao, eve_categoria, eve_sexo, eve_rondonista, "
                . "eve_cep, eve_uf, eve_cidade, eve_bairro, eve_logradouro, eve_numero, "
                . "eve_complemento, eve_alojamento, eve_preco, eve_status, eve_data_solicitacao, "
                . "eve_refererencia_pagseguro FROM evento ";
        
        if ($eve_id > 0) {

            $query .= "WHERE eve_id = :eve_id";
            $resultado = $this->conexao->prepare($query);
            $resultado->execute([':eve_id' => $eve_id]);
        }

        else {

            $query .= "ORDER BY eve_id";
            $resultado = $this->conexao->query($query);
        }

        $eventos = array();

        for ($i = 0; $registro = $resultado->fetch(PDO::FETCH_NUM); $i++) {

            $eventos[$i] = new Evento();

            $eventos[$i]->set_eve_id((int) $registro[0]);
            $eventos[$i]->set_usr_id((int) $registro[1]);
            $eventos[$i]->set_nome_social($registro[2]);
            $eventos[$i]->set_data_nascimento($registro[3]);
            $eventos[$i]->set_instituicao($registro[4]);
            $eventos[$i]->set_categoria($registro[5]);
            $eventos[$i]->set_sexo($registro[6]);
            $eventos[$i]->set_rondonista($registro[7]);
            $eventos[$i]->set_cep($registro[8]);
            $eventos[$i]->set_uf($registro[9]);
            $eventos[$i]->set_cidade($registro[10]);
            $eventos[$i]->set_bairro($registro[11]);
            $eventos[$i]->set_logradouro($registro[12]);
            $eventos[$i]->set_numero($registro[13]);
            $eventos[$i]->set_complemento($registro[14]);
            $eventos[$i]->set_alojamento($registro[15]);
            $eventos[$i]->set_preco((float) $registro[16]);
            $eventos[$i]->set_eve_status($registro[17]);
            $eventos[$i]->set_data_solicitacao($registro[18]);
            $eventos[$i]->set_referencia_pagseguro($registro[19]);
        }

        return $eventos;
    }

    /**
     * Atualiza um determinado 'evento'
     * @param Evento $evento Objeto 'evento' a ser atualizado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function atualizar(Evento $evento) {

        $query = "UPDATE evento SET usr_id = :usr_id, eve_data_nascimento = :data_nascimento, "
                . "eve_nome_social = :nome_social, eve_instituicao = :instituicao, "
                . "eve_categoria = :categoria, eve_sexo = :sexo, eve_rondonista = :rondonista, "
                . "eve_cep = :cep, eve_uf = :uf, eve_cidade = :cidade, eve_bairro = :bairro, "
                . "eve_logradouro = :logradouro, eve_numero = :numero, eve_complemento = :complemento, "
                . "eve_alojamento = :alojamento, eve_status = :status, eve_preco = :preco, eve_data_solicitacao = :data_solicitacao, "
                . "eve_refererencia_pagseguro = :refererencia_pagseguro WHERE eve_id = :eve_id";

        return $this->conexao->prepare($query)->execute(array(
                    ':nome_social' => $evento->get_nome_social(),
                    ':usr_id' => $evento->get_usr_id(),
                    ':data_nascimento' => $evento->get_data_nascimento(),
                    ':instituicao' => $evento->get_instituicao(),
                    ':categoria' => $evento->get_categoria(),
                    ':sexo' => $evento->get_sexo(),
                    ':rondonista' => $evento->get_rondonista(),
                    ':cep' => $evento->get_cep(),
                    ':uf' => $evento->get_uf(),
                    ':cidade' => $evento->get_cidade(),
                    ':bairro' => $evento->get_bairro(),
                    ':logradouro' => $evento->get_logradouro(),
                    ':numero' => $evento->get_numero(),
                    ':complemento' => $evento->get_complemento(),
                    ':alojamento' => $evento->get_alojamento(),
                    ':status' => $evento->get_eve_status(),
                    ':preco' => $evento->get_preco(),
                    ':data_solicitacao' => $evento->get_data_solicitacao(),
                    ':refererencia_pagseguro' => $evento->get_referencia_pagseguro(),
                    ':eve_id' => $evento->get_eve_id()
        ));
    }

    /**
     * Deleta um 'evento' do Bando de Dados
     * @param (int) $id O id do 'evento' a ser deletado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE caso contrário
     */
    function deletar($id) {

        $query = "DELETE FROM avaliacao WHERE subm_id IN (SELECT subm_id FROM submissao WHERE eve_id = :id); "
                . "DELETE FROM submissao WHERE eve_id = :id; "
                . "DELETE FROM evento WHERE eve_id = :id";

        return $this->conexao->query($query)->execute([':id' => $id]);
    }

}
