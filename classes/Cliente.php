<?php
    class Cliente{
        private ?int $idCliente; 
        private string $nome; 
        private string $dataNascimento; 
        private string $cpf;
        private string $rg;
        private string $telefone;
        private array $endereco;
        
    
        public function __construct(?int $idCliente, string $nome, string $dataNascimento, string $cpf, string $rg, string $telefone, array $endereco){
            $this->idCliente = $idCliente;
            $this->nome = $nome;
            $this->dataNascimento = $dataNascimento;
            $this->cpf = $cpf;
            $this->rg = $rg;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
        }
    
        public function getID() {return $this->idCliente;}
        public function getNome() {return $this->nome;}
        public function getDataNascimento() {return $this->dataNascimento;}
        public function getCPF() {return $this->cpf;}
        public function getRG() {return $this->rg;}
        public function getTelefone() {return $this->telefone;}
        public function getEndereco() {return $this->endereco;}
    }
?>