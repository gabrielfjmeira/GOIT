CREATE DATABASE goit_db;
USE goit_db;

/*Criação da Tabela de Tipos de Usuários*/
CREATE TABLE TIPUSU(
	TIPUSU_Codigo INT(3) NOT NULL AUTO_INCREMENT,
    TIPUSU_Descricao VARCHAR(13) NOT NULL, 
    TIPUSU_Administrador BOOLEAN NOT NULL,
    
    PRIMARY KEY(TIPUSU_Codigo)
);

/*Criação da Tabela de Usuários*/
CREATE TABLE TABUSU(
	TABUSU_Codigo INT(3) NOT NULL AUTO_INCREMENT,
    TABUSU_Email VARCHAR(100) NOT NULL UNIQUE,
    TABUSU_Senha VARCHAR(255) NOT NULL,
    TABUSU_Icon VARCHAR(100) NULL,
    TIPUSU_Codigo INT(3) NOT NULL,
    TABUSU_Created DATETIME NOT NULL,
    
    PRIMARY KEY(TABUSU_Codigo),
    FOREIGN KEY(TIPUSU_Codigo) REFERENCES TIPUSU(TIPUSU_Codigo)
);

/*Criação da Tabela de Riscos de Atividades*/
CREATE TABLE TABRIS(
	TABRIS_Codigo INT(3) NOT NULL AUTO_INCREMENT,
    TABRIS_Descricao VARCHAR(30) NOT NULL,
    TABRIS_Minimo INT(2) NOT NULL,
    TABRIS_Maximo INT(2) NOT NULL,
    TABRIS_Instrutor BOOLEAN NOT NULL,
    
    PRIMARY KEY(TABRIS_Codigo)
);

/*Criação da Tabela de Categorias de Atividades ao Ar Livre*/
CREATE TABLE CATATV(
	CATATV_Codigo INT(3) NOT NULL AUTO_INCREMENT,
    CATATV_Descricao VARCHAR(30) NOT NULL,
    TABRIS_Codigo INT(3) NOT NULL,
    
    PRIMARY KEY(CATATV_Codigo),
    FOREIGN KEY(TABRIS_Codigo) REFERENCES TABRIS(TABRIS_Codigo)
);

/*Criação da Tabela de Praticantes*/
CREATE TABLE TABPRA(
	TABUSU_Codigo INT(3) NOT NULL,
    TABPRA_Nome VARCHAR(100) NOT NULL,
    TABPRA_Apelido VARCHAR(30) NOT NULL UNIQUE,
    TABPRA_DataNascimento DATE NOT NULL,
   	TABPRA_Sexo INT(1) NOT NULL,
    
    PRIMARY KEY(TABUSU_Codigo),
    FOREIGN KEY(TABUSU_Codigo) REFERENCES TABUSU(TABUSU_Codigo)
);

/*Criação da Tabela de Instrutores*/
CREATE TABLE TABINS(
	TABUSU_Codigo INT(3) NOT NULL,
    TABINS_Nome VARCHAR(100) NOT NULL,
    TABINS_Apelido VARCHAR(30) NOT NULL UNIQUE,
    TABINS_DataNascimento DATE NOT NULL,
    TABINS_Sexo INT(1) NOT NULL,
    TABINS_Cadastur VARCHAR(14) UNIQUE NOT NULL,
    CATATV_Codigo INT(3) NOT NULL,
    TABINS_Verificado BOOLEAN NOT NULL,
    TABINS_Negado BOOLEAN NOT NULL,
    
    PRIMARY KEY(TABUSU_Codigo),
    FOREIGN KEY(TABUSU_Codigo) REFERENCES TABUSU(TABUSU_Codigo),
    FOREIGN KEY(CATATV_Codigo) REFERENCES CATATV(CATATV_Codigo)
);

/*Criação da Tabela de Lojistas*/
CREATE TABLE TABLOJ(
	TABUSU_Codigo INT(3) NOT NULL,
    TABLOJ_RazaoSocial VARCHAR(100) NOT NULL,
    TABLOJ_Fantasia VARCHAR(30) UNIQUE NOT NULL,
    TABLOJ_CNPJ VARCHAR(14) UNIQUE NOT NULL,
    TABLOJ_Verificado BOOLEAN NOT NULL,
    TABLOJ_Negado BOOLEAN NOT NULL,
    
    PRIMARY KEY(TABUSU_Codigo),
    FOREIGN KEY(TABUSU_Codigo) REFERENCES TABUSU(TABUSU_Codigo)
);

/*Criação da Tabela de Atividades ao Ar Livre*/
CREATE TABLE TABATV(
	TABATV_Codigo INT(3) NOT NULL AUTO_INCREMENT,
    TABUSU_Codigo INT(3) NOT NULL,
    TABATV_Titulo VARCHAR(50) NOT NULL,
    TABATV_Descricao TEXT NOT NULL,
    TABATV_Imagem VARCHAR(100) NULL,
    CATATV_Codigo INT(3) NOT NULL,
    TABATV_Localizacao VARCHAR(100) NOT NULL,
    TABATV_Referencia VARCHAR(50) NULL,
    TABATV_Inscritos INT(3) NOT NULL,    
    TABATV_Data DATE NOT NULL,
    TABATV_Hora TIME NOT NULL,
    TABATV_Cancelada BOOLEAN NOT NULL,    
    TABATV_Created DATETIME NOT NULL,
    
    PRIMARY KEY(TABATV_Codigo),
    FOREIGN KEY(TABUSU_Codigo) REFERENCES TABUSU(TABUSU_Codigo),
    FOREIGN KEY(CATATV_Codigo) REFERENCES CATATV(CATATV_Codigo)
);

/*Criação da Tabela de Participação de Usuários com Atividades ao Ar Livre*/
CREATE TABLE PARATV(
	TABATV_Codigo INT(3) NOT NULL,
    TABUSU_Codigo INT(3) NOT NULL,
    PARATV_Created DATETIME NOT NULL,
    
    PRIMARY KEY(TABATV_Codigo, TABUSU_Codigo),
  	FOREIGN KEY(TABATV_Codigo) REFERENCES TABATV(TABATV_Codigo),
    FOREIGN KEY(TABUSU_Codigo) REFERENCES TABUSU(TABUSU_Codigo)
);

/*Criação da Tabela de Produtos de Lojistas*/
CREATE TABLE TABPRO(
    TABPRO_Codigo INT(3) NOT NULL AUTO_INCREMENT,
    TABUSU_Codigo INT(3) NOT NULL,
    TABPRO_Nome VARCHAR(50) NOT NULL,
    TABPRO_Valor FLOAT(7, 2) NOT NULL,
    TABPRO_Imagem VARCHAR(100) NOT NULL,
    TABPRO_Url TEXT NOT NULL,
    CATATV_Codigo INT(3) NOT NULL,

    PRIMARY KEY(TABPRO_Codigo, TABUSU_Codigo),
    FOREIGN KEY(TABUSU_Codigo) REFERENCES TABUSU(TABUSU_Codigo),
    FOREIGN KEY(CATATV_Codigo) REFERENCES CATATV(CATATV_Codigo)
);

/*Inserção de Tipos de Usuários*/
INSERT INTO TIPUSU (TIPUSU_Codigo, TIPUSU_Descricao, TIPUSU_Administrador) VALUES (NULL, 'Administrador', 1);
INSERT INTO TIPUSU (TIPUSU_Codigo, TIPUSU_Descricao, TIPUSU_Administrador) VALUES (NULL, 'Praticante', 0);
INSERT INTO TIPUSU (TIPUSU_Codigo, TIPUSU_Descricao, TIPUSU_Administrador) VALUES (NULL, 'Instrutor', 0);
INSERT INTO TIPUSU (TIPUSU_Codigo, TIPUSU_Descricao, TIPUSU_Administrador) VALUES (NULL, 'Lojista', 0);

/*Inserção de Riscos de Atividades*/
INSERT INTO TABRIS (TABRIS_Codigo, TABRIS_Descricao, TABRIS_Minimo, TABRIS_Maximo, TABRIS_Instrutor) VALUES (NULL, 'Sem Risco', 0, 1, 0);
INSERT INTO TABRIS (TABRIS_Codigo, TABRIS_Descricao, TABRIS_Minimo, TABRIS_Maximo, TABRIS_Instrutor) VALUES (NULL, 'Leve', 2, 3, 0);
INSERT INTO TABRIS (TABRIS_Codigo, TABRIS_Descricao, TABRIS_Minimo, TABRIS_Maximo, TABRIS_Instrutor) VALUES (NULL, 'Moderado', 4, 5, 0);
INSERT INTO TABRIS (TABRIS_Codigo, TABRIS_Descricao, TABRIS_Minimo, TABRIS_Maximo, TABRIS_Instrutor) VALUES (NULL, 'Alto', 6, 8, 1);
INSERT INTO TABRIS (TABRIS_Codigo, TABRIS_Descricao, TABRIS_Minimo, TABRIS_Maximo, TABRIS_Instrutor) VALUES (NULL, 'Muito Alto', 9, 10, 1);

/*Inserção de Categorias de Atividades ao Ar Livre*/
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Caminhada', 1);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Corrida de Rua', 2);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Trilha', 3);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Canoagem', 4);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Escalada', 5);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Yoga', 1);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Ciclismo', 2);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Raft', 5);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Skate', 3);
INSERT INTO CATATV (CATATV_Codigo, CATATV_Descricao, TABRIS_Codigo) VALUES (NULL, 'Patinação', 3);