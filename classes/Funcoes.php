<?php
    class Funcoes {
        private PDO $database;
        private $clienteInserido;

        public function __construct(PDO $database){
            $this->database = $database;
        }

        public function cadastrar(Cliente $cliente){
            $sql = "INSERT INTO cliente (nome, dataNascimento, cpf, rg, telefone, endereco) 
                    VALUES (:nome, :dataNascimento, :cpf, :rg, :telefone, :endereco)";
            $params = [
                "nome" => $cliente->getNome(),
                "dataNascimento" => $cliente->getDataNascimento(),
                "cpf" => $cliente->getCPF(),
                "rg" => $cliente->getRG(),
                "telefone" => $cliente->getTelefone(),
                "endereco" => $cliente->getEndereco()
            ];
            $stmt = $this->database->prepare($sql);
            $stmt->execute($params);

            $this->clienteInserido = $this->database->lastInsertId();
            return $stmt->rowCount() > 0;
        }

        public function editar(Cliente $cliente){
            $sql = "UPDATE cliente 
                    SET nome = :nome, dataNascimento = :dataNascimento, cpf = :cpf, rg = :rg, telefone = :telefone, endereco = :endereco 
                    WHERE idCliente = :idCliente";
            $params = [
                "idCliente" => $cliente->getID(), 
                "nome" => $cliente->getNome(),
                "dataNascimento" => $cliente->getDataNascimento(),
                "cpf" => $cliente->getCPF(),
                "rg" => $cliente->getRG(),
                "telefone" => $cliente->getTelefone(),
                "endereco" => $cliente->getEndereco()
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