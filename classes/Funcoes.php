<?php
    class Funcoes {
        private PDO $database;
        private $clienteInserido;

        public function __construct(PDO $database){
            $this->database = $database;
        }

        public function cadastrar(Cliente $cliente){
            // Inserção do cliente
            $sql = "INSERT INTO cliente (nome, dataNascimento, cpf, rg, telefone) 
                    VALUES (:nome, :dataNascimento, :cpf, :rg, :telefone)";
            $params = [
                "nome" => $cliente->getNome(),
                "dataNascimento" => $cliente->getDataNascimento(),
                "cpf" => $cliente->getCPF(),
                "rg" => $cliente->getRG(),
                "telefone" => $cliente->getTelefone()
            ];
            $stmt = $this->database->prepare($sql);
            $stmt->execute($params);

            // Obtém o ID do cliente inserido
            $this->clienteInserido = $this->database->lastInsertId();

            // Inserção dos endereços
            foreach ($cliente->getEndereco() as $endereco){
                $sqlEndereco = "INSERT INTO endereco (rua, bairro, cidade, cep, clienteId, estadoId)
                                VALUES (:rua, :bairro, :cidade, :cep, :clienteId, :estadoId)";
                $paramsEndereco = [
                    "rua" => $endereco['rua'],
                    "bairro" => $endereco['bairro'],
                    "cidade" => $endereco['cidade'],
                    "cep" => $endereco['cep'],
                    "clienteId" => $this->clienteInserido,
                    "estadoId" =>$endereco['estadoId'],
                ];
                $stmtEndereco = $this->database->prepare($sqlEndereco);
                $stmtEndereco->execute($paramsEndereco);
            }
            return $stmt->rowCount() > 0;
        }

        public function editar(Cliente $cliente){
            $sql = "UPDATE cliente 
                    SET nome = :nome, dataNascimento = :dataNascimento, cpf = :cpf, rg = :rg, telefone = :telefone 
                    WHERE idCliente = :idCliente";
            $params = [
                "idCliente" => $cliente->getID(), 
                "nome" => $cliente->getNome(),
                "dataNascimento" => $cliente->getDataNascimento(),
                "cpf" => $cliente->getCPF(),
                "rg" => $cliente->getRG(),
                "telefone" => $cliente->getTelefone()
            ];
            $stmt = $this->database->prepare($sql);
            $stmt->execute($params);

            foreach ($cliente->getEndereco() as $endereco){
                $sqlEndereco = "UPDATE endereco 
                                SET rua = :rua, bairro = :bairro, cidade = :cidade, cep = :cep,  estadoId = :estadoId
                                WHERE clienteId = :clienteId";
                $paramsEndereco = [
                    "rua" => $endereco['rua'],
                    "bairro" => $endereco['bairro'],
                    "cidade" => $endereco['cidade'],
                    "cep" => $endereco['cep'],
                    "clienteId" => $cliente->getID(),
                    "estadoId" =>$endereco['estadoId'],
                ];
                $stmtEndereco = $this->database->prepare($sqlEndereco);
                $stmtEndereco->execute($paramsEndereco);
            }
            
            return $stmt->rowCount() > 0 || $stmtEndereco->rowCount() > 0;
        }

        public function excluir(int $idCliente){
            $sqlEndereco = "DELETE FROM endereco WHERE clienteId = :clienteId";
            $params = [
                "clienteId" => $idCliente
            ];
            $stmt = $this->database->prepare($sqlEndereco);
            $stmt->execute($params);

            $sqlCliente = "DELETE FROM cliente WHERE idCliente = :idCliente";
            $params = [
                "idCliente" => $idCliente
            ];
            $stmt = $this->database->prepare($sqlCliente);
            $stmt->execute($params);

            return $stmt->rowCount() > 0;
        }

        public function listar(): array{
            $sql = "SELECT idCliente, nome, dataNascimento, cpf, rg, telefone, rua, bairro, cidade, siglaEstado AS Estado, cep
                    FROM endereco
                    LEFT JOIN cliente ON clienteId = idCliente
                    LEFT JOIN estados ON estadoId = idEstado";
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            
            // Debugando para ver o retorno da consulta
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }
?>
