CREATE DATABASE desafio_kabum;

USE desafio_kabum;

CREATE TABLE loginADM(
    idADM INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(15) NOT NULL
);

CREATE TABLE cliente(
    idCliente INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(50) NOT NULL,
    dataNascimento DATE,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    rg VARCHAR(9) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    endereco VARCHAR(100) NOT NULL
);

INSERT INTO cliente (
    nome, email, senha, dataNascimento, cpf, rg, telefone, endereco
) VALUES (
    'Enzo Zamineli',
    '1995-06-20',
    '12345678901',
    '123456789',
    '11987654321',
    'Rua das Palmeiras, 123 - São Paulo, SP'
);

INSERT INTO loginADM (nome, email, senha)
VALUES (
    'Admin Principal',
    'admin@empresa.com',
    'admin123'
);


select * from cliente;
select * from loginADM;
