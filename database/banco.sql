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

                 