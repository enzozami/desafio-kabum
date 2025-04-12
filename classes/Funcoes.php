<?php
    class Funcoes {
        private PDO $database;
        private $clienteInserido, $clienteAtualizado, $clienteRemovido, $listaCliente;

        public function __construct(PDO $database){
            $this->database = $database;
        }

        public function cadastrar(Cliente $cliente, int $clienteInserido){
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
            return $stmt->rowCount() > 0;
        }

        public function editar(Cliente $cliente){
            $sql = "UPDATE cliente 
                    SET nome = :nome, dataNascimento =:dataNascimento, cpf = :cpf, rg = :rg, telefone = :telefone, endereco = :endereco 
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

    }
?>