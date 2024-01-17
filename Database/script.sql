CREATE SCHEMA `internit`;
USE internit;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(25) NOT NULL,
    email VARCHAR(105) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    endereco VARCHAR(90) NOT NULL,
    cidade VARCHAR(25) NOT NULL,
    uf VARCHAR(5) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    adm BOOLEAN NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE noticias (
    id INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    data_criacao DATE NOT NULL,
    resumo VARCHAR(100) NOT NULL,
    imagem VARCHAR(255),
    conteudo TEXT NOT NULL,
    destaque BOOLEAN NOT NULL,
    usuario_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE categorias (
    categoria_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    codigo VARCHAR(4) UNIQUE NOT NULL,
    usuario_id INT NOT NULL,
    PRIMARY KEY (categoria_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(25) NOT NULL,
    codigo VARCHAR(100) UNIQUE NOT NULL,
    situacao BOOLEAN NOT NULL,
    valor FLOAT NOT NULL,
    quantidade INT NOT NULL,
    descricao VARCHAR(75),
    imagem VARCHAR(255),
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id) ON DELETE CASCADE
);

INSERT INTO usuarios ( nome, email, cpf, endereco, cidade, uf, senha, adm ) VALUES 
                     ( 'Admin', 'admin@internit.com.br', '11111111111' , 'R. Santa Rosa', 'Niteroi', 'RJ', 'adm123', true )
