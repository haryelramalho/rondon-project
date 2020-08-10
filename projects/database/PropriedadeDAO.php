<?php

require_once DIR_ROOT . 'database/Propriedade.php';

/**
 * Classe que estabelece conexão com banco de dados
 * e efetua as 4 operações básicas
 *
 * @author tecnojr
 */
class PropriedadeDAO {

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
     * Função que cadastra novas propriedades
     * @param Propriedade $propriedade A propriedade a ser cadastrada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function inserir(Propriedade $propriedade) {

        $query = "INSERT INTO propriedade(usr_id, prop_cep, prop_uf,"
                . "prop_cidade, prop_bairro, prop_logradouro, prop_numero,"
                . "prop_complemento, prop_descricao, prop_preco, prop_status) VALUES"
                . "(:id, :cep, :uf, :cidade, :bairro, :logradouro, :numero,"
                . ":complemento, :descricao, :preco, :status)";

        return $this->conexao->prepare($query)->execute(array(
                    ':id' => $propriedade->get_usr_id(),
                    ':cep' => $propriedade->get_cep(),
                    ':uf' => $propriedade->get_uf(),
                    ':cidade' => $propriedade->get_cidade(),
                    ':bairro' => $propriedade->get_bairro(),
                    ':logradouro' => $propriedade->get_logradouro(),
                    ':numero' => $propriedade->get_numero(),
                    ':complemento' => $propriedade->get_complemento(),
                    ':descricao' => $propriedade->get_descricao(),
                    ':preco' => $propriedade->get_preco(),
                    ':status' => $propriedade->get_prop_status()
        ));
    }

    /**
     * Deleta uma propriedade
     * @param (int) $id O id da propriedade a ser deletada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function deletar($id) {

        $query = "DELETE FROM propriedade WHERE prop_id = :id";

        return $this->conexao->prepare($query)->execute([':id' => $id]);
    }

    /**
     * Lista propriedades do banco de dados.
     * Quando $usr_id > 0, é listado as propriedade
     * de um usuário com id igual a $usr_id. Caso
     * contrário a seleção das propriedades é livre
     * @param int $usr_id O ID do usuário. 
     * @return \Propriedade Retorna um vetor de propriedades
     */
    function selecionar($usr_id = 0) {

        $query = "SELECT prop_id, usr_id, prop_cep, prop_uf, prop_cidade,"
                . "prop_bairro, prop_logradouro, prop_numero, prop_complemento,"
                . "prop_descricao, prop_preco, prop_status FROM propriedade";
        
        if ($usr_id > 0) {
            
            $query .= " WHERE usr_id = :id ORDER BY prop_id ASC";
            $resultado = $this->conexao->prepare($query);
            $resultado->execute([':id' => $usr_id]);
            
        } else {
            $resultado = $this->conexao->query($query . " ORDER BY prop_id ASC");
        }

        $propriedades = array();

        for ($i = 0; $registro = $resultado->fetch(PDO::FETCH_NUM); $i++) {

            $propriedades[$i] = new Propriedade();

            $propriedades[$i]->set_prop_id($registro[0]);
            $propriedades[$i]->set_usr_id($registro[1]);
            $propriedades[$i]->set_cep($registro[2]);
            $propriedades[$i]->set_uf($registro[3]);
            $propriedades[$i]->set_cidade($registro[4]);
            $propriedades[$i]->set_bairro($registro[5]);
            $propriedades[$i]->set_logradouro($registro[6]);
            $propriedades[$i]->set_numero($registro[7]);
            $propriedades[$i]->set_complemento($registro[8]);
            $propriedades[$i]->set_descricao($registro[9]);
            $propriedades[$i]->set_preco($registro[10]);
            $propriedades[$i]->set_prop_status($registro[11]);
        }

        return $propriedades;
    }

    /**
     * Atualiza uma determinada propriedade
     * @param Propriedade $propriedade A propriedade a ser atualizada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function atualizar(Propriedade $propriedade) {

        $query = "UPDATE propriedade SET prop_cep = :cep, prop_uf = :uf, prop_cidade = :cidade, prop_bairro = :bairro, "
                . "prop_logradouro = :logradouro, prop_numero = :numero, prop_complemento = :complemento,"
                . "prop_descricao = :descricao, prop_preco = :preco, prop_status = :status WHERE prop_id = :id";

        return $this->conexao->prepare($query)->execute(array(
            ':id' => $propriedade->get_prop_id(),
            ':cep' => $propriedade->get_cep(),
            ':uf' => $propriedade->get_uf(),
            ':cidade' => $propriedade->get_cidade(),
            ':bairro' => $propriedade->get_bairro(),
            ':logradouro' => $propriedade->get_logradouro(),
            ':numero' => $propriedade->get_numero(),
            ':complemento' => $propriedade->get_complemento(),
            ':descricao' => $propriedade->get_descricao(),
            ':preco' => $propriedade->get_preco(),
            ':status' => $propriedade->get_prop_status()
        ));
    }
}
