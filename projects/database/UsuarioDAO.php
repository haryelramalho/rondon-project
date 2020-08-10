<?php

require_once DIR_ROOT . 'database/Usuario.php';

/**
 * Classe que estabelece conexão com banco de dados
 * e efetua as 4 operações básicas
 *
 * @author tecnojr
 */
class UsuarioDAO {

    /**
     * Objeto de conexão com o banco de dados
     * @var OBJ 
     */
    private $conexao;

    /**
     * Inicializa a conexão com o banco
     */
    public function __construct() {
        
        $this->conexao = DB_SERVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $this->conexao = new PDO($this->conexao, DB_USERNAME, DB_PASSWORD);
    }

    /**
     * Cadastra novos usuários
     * @param Usuario $usuario
     * Objeto Usuario a ser cadastrado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function inserir(Usuario $usuario) {

        $query = "INSERT INTO usuario (usr_nome, usr_email, usr_cpf, "
                . "usr_celular, usr_telefone, usr_senha, usr_token, "
                . "usr_status) VALUES (:nome, :email, :cpf, :celular,"
                . ":telefone, :senha, :token, :status)";

        return $this->conexao->prepare($query)->execute(array(
            ':nome' => $usuario->get_nome(),
            ':email' => $usuario->get_email(),
            ':cpf' => $usuario->get_cpf(),
            ':celular' => $usuario->get_celular(),
            ':telefone' => $usuario->get_telefone(),
            ':senha' => $usuario->get_senha(),
            ':token' => $usuario->get_token(),
            ':status' => $usuario->get_usr_status()
        ));
    }
    
    /**
     * Lista os usuário do banco de dados
     * @return \Usuario Retorna um vetor de usuários
     */
    function selecionar() {
        
        $query = "SELECT usr_id, usr_nome, usr_email, usr_cpf, "
                . "usr_celular, usr_telefone, usr_senha, usr_token, "
                . "usr_status FROM usuario ORDER BY usr_id ASC";
        
        $resultado = $this->conexao->query($query);
        
        $usuarios = array();
        
        for ($i = 0; $registro = $resultado->fetch(PDO::FETCH_NUM); $i++) {
            
            $usuarios[$i] = new Usuario();
            
            $usuarios[$i]->set_usr_id((int) $registro[0]);
            $usuarios[$i]->set_nome($registro[1]);
            $usuarios[$i]->set_email($registro[2]);
            $usuarios[$i]->set_cpf($registro[3]);
            $usuarios[$i]->set_celular($registro[4]);
            $usuarios[$i]->set_telefone($registro[5]);
            $usuarios[$i]->set_senha($registro[6]);
            $usuarios[$i]->set_token($registro[7]);
            $usuarios[$i]->set_usr_status($registro[8]);
        }
        
        return $usuarios;
    }

    /**
     * Atualiza um determinado usuário
     * @param Usuario $usuario Objeto usuário a ser atualizado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso de falha
     */
    function atualizar(Usuario $usuario) {

        $query = "UPDATE usuario set usr_nome = :nome, usr_celular = :celular, "
                . "usr_telefone = :telefone, usr_senha = :senha, "
                . "usr_token = :token, usr_status = :status WHERE usr_id = :id";

        return $this->conexao->prepare($query)->execute(array(
            ':id' => $usuario->get_usr_id(),
            ':nome' => $usuario->get_nome(),
            ':celular' => $usuario->get_celular(),
            ':telefone' => $usuario->get_telefone(),
            ':senha' => $usuario->get_senha(),
            ':token' => $usuario->get_token(),
            ':status' => $usuario->get_usr_status()
        ));
    }

    /**
     * Deleta um usuário do banco de dados
     * @param (int) $id O id do usuário a ser deletado
     * @return (bool) Retorna TRUE em caso de sucesso ou FALSE em caso contrário
     */
    function deletar($id){
        
        $query = "DELETE FROM submissao WHERE eve_id IN (SELECT eve_id FROM evento WHERE usr_id = :id); "
                . "DELETE FROM evento WHERE usr_id = :id; "
                . "DELETE FROM avaliador WHERE usr_id = :id; "
                . "DELETE FROM propriedade WHERE usr_id = :id; "
                . "DELETE FROM usuario WHERE usr_id = :id";

        return $this->conexao->prepare($query)->execute([':id' => $id]);
    }
}
