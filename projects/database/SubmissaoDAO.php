<?php

require_once DIR_ROOT . 'database/Submissao.php';

/**
 * Classe que estabelece conexão com banco de dados
 * e efetua as 4 operações básicas
 *
 * @author tecnojr
 */
class SubmissaoDAO{

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
    function inserir(Submissao $submissao) {

        $query = "INSERT INTO submissao(eve_id, subm_area, subm_titulo, subm_autores,"
                . "subm_nota, subm_comentario, subm_status) VALUES(:eve_id, "
                . ":area, :titulo, :autores, :nota, :comentario, :status)";

        return $this->conexao->prepare($query)->execute(array(
                    ':eve_id' => $submissao->get_eve_id(),
                    ':area' => $submissao->get_area(),
                    ':titulo' => $submissao->get_titulo(),
                    ':autores' => $submissao->get_autores(),
                    ':nota' => $submissao->get_nota(),
                    ':comentario' => $submissao->get_comentario(),
                    ':status' => $submissao->get_subm_status()
        ));
    }

    /**
     * Deleta uma submissao
     * @param (int) $id O id da submissao a ser deletada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function deletar($id) {

        $query = "DELETE FROM submissao WHERE subm_id = :id";

        return $this->conexao->prepare($query)->execute([':id' => $id]);
    }

    /**
     * Lista submissões do banco de dados.
     * Quando $eve_id > 0, é listado as submissões
     * de um usuario do evento com id igual
     * a $eve_id. Caso contrário a seleção das submissões é livre.
     * @param int $eve_id O ID do usuario de evento. 
     * @return \Submissao Retorna um vetor de submissões
     */
    function selecionar($eve_id = 0) {

        $query = "SELECT submissao.subm_id, submissao.eve_id, submissao.subm_area,
            submissao.subm_titulo, submissao.subm_autores, submissao.aval_id, 
            submissao.subm_nota, submissao.subm_comentario, submissao.subm_status,
            evento.eve_instituicao FROM submissao INNER JOIN evento ON 
            submissao.eve_id = evento.eve_id";

        if ($eve_id > 0) {
            
            $query .= " AND evento.eve_id = :id";
            $resultado = $this->conexao->prepare($query);
            $resultado->execute([':id' => $eve_id]);
            
        } else {

            $query .= " ORDER BY submissao.subm_id DESC";
            $resultado = $this->conexao->query($query);
        }

        $submissoes = array();

        for ($i = 0; $registro = $resultado->fetch(PDO::FETCH_NUM); $i++) {

            $submissoes[$i] = new Submissao();

            $submissoes[$i]->set_subm_id($registro[0]);
            $submissoes[$i]->set_eve_id($registro[1]);
            $submissoes[$i]->set_area($registro[2]);
            $submissoes[$i]->set_titulo($registro[3]);
            $submissoes[$i]->set_autores($registro[4]);
            $submissoes[$i]->set_aval_id($registro[5]);
            $submissoes[$i]->set_nota($registro[6]);
            $submissoes[$i]->set_comentario($registro[7]);
            $submissoes[$i]->set_subm_status($registro[8]);
            $submissoes[$i]->set_instituicao($registro[9]);
        }

        return $submissoes;
    }

    /**
     * Atualiza uma determinada submissão
     * @param Submissao $submissao A submissão a ser atualizada
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function atualizar(Submissao $submissao) {

        $query = "UPDATE submissao SET aval_id = :aval_id, subm_area = :area,
                subm_titulo = :titulo, subm_autores = :autores, subm_nota = :nota, 
                subm_comentario = :comentario, subm_status = :status WHERE subm_id = :id";

        return $this->conexao->prepare($query)->execute(array(

            ':id' => $submissao->get_subm_id(),
            ':aval_id' => $submissao->get_aval_id(),
            ':area' => $submissao->get_area(),
            ':titulo' => $submissao->get_titulo(),
            ':autores' => $submissao->get_autores(),
            ':nota' => $submissao->get_nota(),
            ':comentario' => $submissao->get_comentario(),
            ':status' => $submissao->get_subm_status()
        ));
    }
}