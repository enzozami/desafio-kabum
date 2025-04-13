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
    telefone VARCHAR(11) NOT NULL
);

CREATE TABLE estados(
    idEstado INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    siglaEstado VARCHAR(2) NOT NULL,
    nomeEstado VARCHAR(50) NOT NULL
);

CREATE TABLE endereco (
    idEndereco INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rua VARCHAR(255) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    clienteId INT UNSIGNED NOT NULL,
    estadoId INT UNSIGNED NOT NULL,
    FOREIGN KEY (clienteId) REFERENCES cliente(idCliente),
    FOREIGN KEY (estadoId) REFERENCES estados(idEstado)
);

INSERT INTO loginADM (nome, email, senha)
VALUES 
('Administrador 1', 'admin1@empresa.com', 'senha123'),
('Administrador 2', 'admin2@empresa.com', 'senha456');

INSERT INTO cliente (nome, dataNascimento, cpf, rg, telefone)
VALUES 
('João Silva', '1985-04-25', '12345678901', '123456789', '11987654321'),
('Maria Oliveira', '1990-10-10', '23456789012', '234567890', '11987654322');

INSERT INTO endereco (rua, bairro, cidade, cep, clienteId, estadoId)
VALUES 
('Rua A, 123', 'Bairro X', 'São Paulo', '01010100', 1, 1),
('Rua B, 456', 'Bairro Y', 'São Paulo', '02020200', 2, 2);

INSERT INTO estados (siglaEstado, nomeEstado) VALUES
('AC', 'Acre'),
('AL', 'Alagoas'),
('AP', 'Amapá'),
('AM', 'Amazonas'),
('BA', 'Bahia'),
('CE', 'Ceará'),
('DF', 'Distrito Federal'),
('ES', 'Espírito Santo'),
('GO', 'Goiás'),
('MA', 'Maranhão'),
('MT', 'Mato Grosso'),
('MS', 'Mato Grosso do Sul'),
('MG', 'Minas Gerais'),
('PA', 'Pará'),
('PB', 'Paraíba'),
('PR', 'Paraná'),
('PE', 'Pernambuco'),
('PI', 'Piauí'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RS', 'Rio Grande do Sul'),
('RO', 'Rondônia'),
('RR', 'Roraima'),
('SC', 'Santa Catarina'),
('SP', 'São Paulo'),
('SE', 'Sergipe'),
('TO', 'Tocantins');



select * from cliente;
select * from endereco;
select * from estados;
select * from loginADM;


SELECT 
    c.idCliente,
    c.nome AS nomeCliente,
    c.dataNascimento,
    c.cpf,
    c.rg,
    c.telefone,
    e.rua,
    e.bairro,
    e.cidade,
    e.cep,
    s.siglaEstado
FROM cliente c
INNER JOIN endereco e ON c.idCliente = e.clienteId
INNER JOIN estados s ON e.estadoId = s.idEstado;


SELECT idCliente, nome, dataNascimento, cpf, rg, telefone, rua, bairro, cidade, siglaEstado AS Estado, cep
                    FROM endereco
                    LEFT JOIN cliente ON clienteId = idCliente
                    LEFT JOIN estados ON estadoId = idEstado;
                    
                                        