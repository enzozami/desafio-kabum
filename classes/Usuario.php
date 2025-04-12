<?php 
    class Usuario{
        private PDO $db;

        public function __construct(PDO $Database){
            $this->db = $Database;
        }

        public function autenticar(string $email, string $senha): ?array {
            $sql = "SELECT * FROM loginADM WHERE email = :email AND senha = :senha";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'senha' => $senha
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        }
    }
?>