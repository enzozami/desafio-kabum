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
            
            return $stmt->rowCount() > 0;
        }

        public function excluir(Cliente $cliente){
            $sql = "DELETE FROM cliente WHERE idCliente = :idCliente";
            $params = [
                "idCliente" => $cliente->getID()
            ];
            $stmt = $this->database->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->rowCount() > 0;
        }

        public function listar(): array{
            $sql = "SELECT nome, dataNascimento, cpf, rg, telefone FROM cliente";
            $stmt = $this->database->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
