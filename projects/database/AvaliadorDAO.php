<?php

require_once DIR_ROOT . 'database/Avaliador.php';

/**
 * Classe que estabelece conexão com banco de dados
 * e efetua as 4 operações básicas
 *
 * @author tecnojr
 */
class AvaliadorDAO {

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
     * @param Avaliador $avaliador O avaliador a ser cadastrado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function inserir(Avaliador $avaliador) {

        $query = "INSERT INTO avaliador(usr_id) VALUES(:usr_id)";

        return $this->conexao->prepare($query)->execute(array(
                    ':usr_id' => $avaliador->get_usr_id()
        ));
    }

    /**
     * Deleta um avaliador
     * @param (int) $id O id do avaliador a ser deletado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function deletar($id) {

        $query = "DELETE FROM avaliacao WHERE aval_id = :id; "
                . "DELETE FROM avaliador WHERE aval_id = :id";

        return $this->conexao->prepare($query)->execute([':id' => $id]);
    }

    /**
     * Lista avaliadores do banco de dados. 
     * @return \Avaliador Retorna um vetor de avaliadores
     */
    function selecionar() {

        $query = "SELECT avaliador.aval_id, avaliador.usr_id, usuario.usr_nome, "
                . "usuario.usr_email, usuario.usr_celular FROM avaliador INNER JOIN usuario on "
                . "avaliador.usr_id = usuario.usr_id ORDER BY avaliador.aval_id ASC";

        $resultado = $this->conexao->query($query);

        $avaliadores = array();

        for ($i = 0; $registro = $resultado->fetch(PDO::FETCH_NUM); $i++) {

            $avaliadores[$i] = new Avaliador();

            $avaliadores[$i]->set_aval_id($registro[0]);
            $avaliadores[$i]->set_usr_id($registro[1]);
            $avaliadores[$i]->set_nome($registro[2]);
            $avaliadores[$i]->set_email($registro[3]);
            $avaliadores[$i]->set_celular($registro[4]);
        }

        return $avaliadores;
    }

}
