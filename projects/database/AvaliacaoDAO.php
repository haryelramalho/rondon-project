<?php

require_once DIR_ROOT . 'database/Avaliacao.php';
require_once DIR_ROOT . 'database/SubmissaoDAO.php';
require_once DIR_ROOT . 'database/AvaliadorDAO.php';

/**
 * Classe que estabelece conexão com banco de dados
 * e efetua as 4 operações básicas
 *
 * @author tecnojr
 */
class AvaliacaoDAO {

    /**
     * Objeto de conexão com o banco de dados
     * @var OBJ 
     */
    private $conexao;

    public function __construct() {
        
        $this->conexao = DB_SERVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $this->conexao = new PDO($this->conexao, DB_USERNAME, DB_PASSWORD);
    }

    /**
     * Função que cadastra novas submissões
     * @param Submissao $submissao A submissao a ser cadastrada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function inserir(Avaliacao $avaliacao) {

        $query = "INSERT INTO avaliacao(aval_id, subm_id, avaliacao_nota,"
                . "avaliacao_comentario) VALUES(:aval_id, :subm_id, :nota, :comentario)";

        return $this->conexao->prepare($query)->execute(array(
                    ':aval_id' => $avaliacao->get_aval_id(),
                    ':subm_id' => $avaliacao->get_subm_id(),
                    ':nota' => $avaliacao->get_avaliacao_nota(),
                    ':comentario' => $avaliacao->get_avaliacao_comentario()
        ));
    }

    /**
     * Deleta uma avaliação
     * @param (int) $id O id da avaliação a ser deletada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function deletar($id) {

        $query = "DELETE FROM avaliacao WHERE avaliacao_id = :id";

        return $this->conexao->prepare($query)->execute([':id' => $id]);
    }

    /**
     * Lista avaliações do banco de dados.
     * Quando $aval_id > 0, é listado as avaliações
     * de um avaliador com id igual
     * ao $aval_id. Caso contrário a seleção das avaliações é livre.
     * @param int $aval_id O ID do avaliador. 
     * @return \Avaliacao Retorna um vetor de avaliações
     */
    function selecionar($aval_id = 0) {

        $query = "SELECT avaliacao_id, aval_id, subm_id, avaliacao_nota, avaliacao_comentario FROM avaliacao";
        
        if ($aval_id > 0) {
            
            $query .= " WHERE aval_id = :id ORDER BY avaliacao_id ASC";
            $resultado = $this->conexao->prepare($query);
            $resultado->execute([':id' => $aval_id]);
            
        } else {
            $resultado = $this->conexao->query($query . " ORDER BY avaliacao_id ASC");
        }

        $avaliacoes = array();

        for ($i = 0; $registro = $resultado->fetch(PDO::FETCH_NUM); $i++) {

            $avaliacoes[$i] = new Avaliacao();

            $avaliacoes[$i]->set_avaliacao_id($registro[0]);
            $avaliacoes[$i]->set_aval_id($registro[1]);
            $avaliacoes[$i]->set_subm_id($registro[2]);
            $avaliacoes[$i]->set_avaliacao_nota($registro[3]);
            $avaliacoes[$i]->set_avaliacao_comentario($registro[4]);
        }

        return $avaliacoes;
    }

    /**
     * Atualiza uma determinada avaliacao
     * @param Avaliacao $avaliacao A avaliação a ser atualizada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function atualizar(Avaliacao $avaliacao) {

        $query = "UPDATE avaliacao SET aval_id = :aval_id, subm_id = :subm_id, avaliacao_nota = :nota,"
                . "avaliacao_comentario = :comentario WHERE avaliacao_id = :id";

        return $this->conexao->prepare($query)->execute(array(
            ':id' => $avaliacao->get_avaliacao_id(),
            ':aval_id' => $avaliacao->get_aval_id(),
            ':subm_id' => $avaliacao->get_subm_id(),
            ':nota' => $avaliacao->get_avaliacao_nota(),
            ':comentario' => $avaliacao->get_avaliacao_comentario()
        ));
    }
}
