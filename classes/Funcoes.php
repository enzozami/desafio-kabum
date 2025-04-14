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
            foreach ($cliente->getEndereco() as $endereco) {
                // Verificar se o endereço já existe para o cliente
                $sqlVerificaEndereco = "SELECT * FROM endereco WHERE rua = :rua AND bairro = :bairro AND cidade = :cidade AND cep = :cep AND clienteId = :clienteId";
                $paramsVerificaEndereco = [
                    "rua" => $endereco['rua'],
                    "bairro" => $endereco['bairro'],
                    "cidade" => $endereco['cidade'],
                    "cep" => $endereco['cep'],
                    "clienteId" => $this->clienteInserido
                ];
                $stmtVerificaEndereco = $this->database->prepare($sqlVerificaEndereco);
                $stmtVerificaEndereco->execute($paramsVerificaEndereco);
            }

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

            // Atualizar ou inserir os endereços
            foreach ($cliente->getEndereco() as $endereco) {
                // Verificar se o endereço já existe para o cliente
                $sqlVerificaEndereco = "SELECT idEndereco FROM endereco WHERE clienteId = :clienteId";
                $paramsVerificaEndereco = [
                    "clienteId" => $cliente->getID()
                ];
                $stmtVerificaEndereco = $this->database->prepare($sqlVerificaEndereco);
                $stmtVerificaEndereco->execute($paramsVerificaEndereco);
                $enderecosAtuais = $stmtVerificaEndereco->fetchAll(PDO::FETCH_COLUMN);

                $idsEnderecosForm = [];
                foreach ($cliente->getEndereco() as $endereco) {
                    if (!empty($endereco['idEndereco'])) {
                        $idsEnderecosForm[] = $endereco['idEndereco'];
                    }
                }

                $enderecosParaRemover = array_diff($enderecosAtuais, $idsEnderecosForm);
                if (!empty($enderecosParaRemover)) {
                    $sqlDelete = "DELETE FROM endereco WHERE idEndereco = :idEndereco";
                    $stmtDelete = $this->database->prepare($sqlDelete);
                    foreach ($enderecosParaRemover as $idRemover) {
                        $stmtDelete->execute(["idEndereco" => $idRemover]);
                    }
                }

            
                foreach ($cliente->getEndereco() as $endereco) {
                    if (!empty($endereco['idEndereco'])) {
                        // Atualizar
                        $sqlUpdateEndereco = "UPDATE endereco 
                                              SET rua = :rua, bairro = :bairro, cidade = :cidade, cep = :cep, estadoId = :estadoId
                                              WHERE idEndereco = :idEndereco";
                        $paramsUpdate = [
                            "rua" => $endereco['rua'],
                            "bairro" => $endereco['bairro'],
                            "cidade" => $endereco['cidade'],
                            "cep" => $endereco['cep'],
                            "estadoId" => $endereco['estadoId'],
                            "idEndereco" => $endereco['idEndereco']
                        ];
                        $stmtUpdate = $this->database->prepare($sqlUpdateEndereco);
                        $stmtUpdate->execute($paramsUpdate);
                    } else {
                        // Inserir novo
                        $sqlInsertEndereco = "INSERT INTO endereco (rua, bairro, cidade, cep, clienteId, estadoId)
                                              VALUES (:rua, :bairro, :cidade, :cep, :clienteId, :estadoId)";
                        $paramsInsert = [
                            "rua" => $endereco['rua'],
                            "bairro" => $endereco['bairro'],
                            "cidade" => $endereco['cidade'],
                            "cep" => $endereco['cep'],
                            "clienteId" => $cliente->getID(),
                            "estadoId" => $endereco['estadoId'],
                        ];
                        $stmtInsert = $this->database->prepare($sqlInsertEndereco);
                        $stmtInsert->execute($paramsInsert);
                    }
                }
            }
            
            return true;
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

            $clientes = [];
    
            foreach ($result as $row) {
                $clienteId = $row['idCliente'];

                // Se o cliente ainda não foi adicionado no array, adiciona
                if (!isset($clientes[$clienteId])) {
                    $clientes[$clienteId] = [
                        'idCliente' => $row['idCliente'],
                        'nome' => $row['nome'],
                        'dataNascimento' => $row['dataNascimento'],
                        'cpf' => $row['cpf'],
                        'rg' => $row['rg'],
                        'telefone' => $row['telefone'],
                        'enderecos' => [] // Inicializa a lista de endereços
                    ];
                }

                // Adiciona o endereço do cliente no array
                $clientes[$clienteId]['enderecos'][] = [
                    'rua' => $row['rua'],
                    'bairro' => $row['bairro'],
                    'cidade' => $row['cidade'],
                    'estado' => $row['Estado'],
                    'cep' => $row['cep']
                ];
            }
            return array_values($clientes);
        }
    }
?>
