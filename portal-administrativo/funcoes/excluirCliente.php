<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../../index.php");
        exit();
    }
    require_once('../../classes/Database.php');
    require_once "../../classes/Cliente.php";
    require_once "../../classes/Funcoes.php";
    include_once "../../templates/navBar.php";

    $db = new Database();
    $pdo = $db->conectar();

    if ($pdo) {
        $funcoes = new Funcoes($pdo);

        if (isset($_GET['idCliente'])) {
            $idCliente = filter_input(INPUT_GET, 'idCliente', FILTER_SANITIZE_NUMBER_INT);
        } else {
            die("ID do cliente não especificado!");
        }
        
        $excluir = $funcoes->excluir($idCliente);
               
        if ($excluir) {
            header("Location: listarCliente.php?msg=excluido"); // ou outro redirect
        } else {
            echo "Erro ao excluir cliente.";
        }
    }
?>