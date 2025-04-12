CREATE DATABASE desafio_kabum;

USE desafio_kabum;

CREATE TABLE cliente(
    idCliente INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(15) NOT NULL,
    dataNascimento DATE,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    rg VARCHAR(9) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    endereco VARCHAR(100) NOT NULL
);

INSERT INTO clientes (
    nome, email, senha, dataNascimento, cpf, rg, telefone, endereco
) VALUES (
    'Enzo Zamineli',
    'enzo@email.com',
    'senha123',
    '1995-06-20',
    '12345678901',
    '123456789',
    '11987654321',
    'Rua das Palmeiras, 123 - São Paulo, SP'
);