<?php
    class Endereco{
        private string $rua;
        private string $bairro;
        private string $cidade;
        private int $estadoId;
        private string $cep;

        public function __construct($rua, $bairro, $cidade, $estadoId, $cep) {
            $this->rua = $rua;
            $this->bairro = $bairro;
            $this->cidade = $cidade;
            $this->estadoId = $estadoId;
            $this->cep = $cep;
        }

        public function getRua() {return $this->rua;}
        public function getBairro() {return $this->bairro;}
        public function getCidade() {return $this->cidade;}
        public function getEstadoId() {return $this->estadoId;}
        public function getCEP() {return $this->cep;}
    }
?>