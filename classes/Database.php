<?php 
    class Database{
        private string $serverName = "localhost"; 
        private string $user = "root"; 
        private string $password = "";
        private string $dbName = "desafio_kabum";

        public function conectar(): ? PDO {
            try {
                return new PDO("mysql:host={$this->serverName};dbname={$this->dbName};charset=utf8", $this->user, $this->password);
            } catch (PDOException $ex) {
                $errorMsg = "Erro ao tentar realizar conexao. ERRO: " . $ex->getMessage();
                return null;
            }
        }
    }
?> 