CREATE DATABASE IF NOT EXISTS rondon;

USE rondon;

CREATE TABLE IF NOT EXISTS usuario (
    usr_id int(4) PRIMARY KEY AUTO_INCREMENT,
    usr_nome varchar(255),
    usr_email varchar(255),
    usr_cpf char(14),
    usr_celular char(15),
    usr_telefone char(14),
    usr_senha varchar(255),
    usr_token varchar(255),
    usr_status char(1)
);

CREATE TABLE IF NOT EXISTS propriedade (
    prop_id int(4) PRIMARY KEY AUTO_INCREMENT,
    usr_id int(4),
    FOREIGN KEY (usr_id)
    REFERENCES usuario (usr_id),
    prop_cep char(9),
    prop_uf char(2),
    prop_cidade varchar(255),
    prop_bairro varchar(255),
    prop_logradouro varchar(255),
    prop_numero varchar(255),
    prop_complemento varchar(255),
    prop_descricao text,
    prop_preco decimal(6,2),
    prop_status char(1)
);

CREATE TABLE IF NOT EXISTS evento (
    eve_id int(4) PRIMARY KEY AUTO_INCREMENT,
    usr_id int(4),
    FOREIGN KEY (usr_id)
    REFERENCES usuario (usr_id),
    eve_nome_social varchar(255),
    eve_data_nascimento date,
    eve_instituicao varchar(255),
    eve_categoria char(1),
    eve_sexo char(1),
    eve_rondonista char(1),
    eve_cep char(9),
    eve_uf char(2),
    eve_cidade varchar(255),
    eve_bairro varchar(255),
    eve_logradouro varchar(255),
    eve_numero varchar(255),
    eve_complemento varchar(255),
    eve_alojamento char(1),
    eve_preco decimal(6,2),
    eve_status char(2),
    eve_data_solicitacao datetime,
    eve_refererencia_pagseguro varchar(255)
);

CREATE TABLE IF NOT EXISTS avaliador (
    aval_id int(4) PRIMARY KEY AUTO_INCREMENT,
    usr_id int(4),
    FOREIGN KEY (usr_id)
    REFERENCES usuario (usr_id)
);

CREATE TABLE IF NOT EXISTS submissao (
    subm_id int(4) PRIMARY KEY AUTO_INCREMENT,
    eve_id int(4),
    FOREIGN KEY (eve_id)
    REFERENCES evento (eve_id),
    aval_id int(4),
    FOREIGN KEY (aval_id)
    REFERENCES avaliador (aval_id),
    subm_area char(1),
    subm_titulo varchar(255),
    subm_autores text,
    subm_nota float(4,2),
    subm_comentario text,
    subm_status char(1)
);

INSERT INTO `usuario`(`usr_id`, `usr_nome`, `usr_email`, `usr_cpf`, `usr_celular`, `usr_telefone`, `usr_senha`, `usr_token`, `usr_status`) VALUES (1, 'User', 'user@mail.com', NULL, NULL, NULL, '1a1dc91c907325c69271ddf0c944bc72', '94a08da1fecbb6e8b46990538c7b50b2', 1);

INSERT INTO `evento`(`eve_id`, `usr_id`, `eve_nome_social`, `eve_data_nascimento`, `eve_instituicao`, `eve_categoria`, `eve_sexo`, `eve_rondonista`, `eve_cep`, `eve_uf`, `eve_cidade`, `eve_bairro`, `eve_logradouro`, `eve_numero`, `eve_complemento`, `eve_alojamento`, `eve_preco`, `eve_status`, `eve_data_solicitacao`, `eve_refererencia_pagseguro`) VALUES (1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'M');