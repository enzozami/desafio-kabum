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
        
        // Verifique se existe um ID na URL (GET) ou se é um POST para edição
        if (isset($_GET['idCliente'])) {
            $clienteId = filter_input(INPUT_GET, 'idCliente', FILTER_SANITIZE_NUMBER_INT);
            // Buscar cliente específico pelo ID
            $clientes = $funcoes->listar($clienteId);
        } else {
            // Caso não tenha um ID, você pode listar todos os clientes
            $clientes = $funcoes->listar();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cliente || DESAFIO KABUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mx-auto py-3">Lista de Clientes</h2>

        <table class="table table-striped table-hover table-borderr mt-3">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Data de Nascimento</th>
                    <th class="text-center">CPF</th>
                    <th class="text-center">RG</th>
                    <th class="text-center">Telefone</th>
                    <th class="text-center">Rua</th>
                    <th class="text-center">Bairro</th>
                    <th class="text-center">Cidade</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">CEP</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($clientes as $cliente){ ?>
                        <tr>
                            <td class="text-center"><?=$cliente['idCliente']?></td>
                            <td class="text-center"><?=$cliente['nome']?></td>
                            <td class="text-center"><?=date_format(new DateTime($cliente['dataNascimento']), "d/m/Y")?></td>
                            <td class="text-center"><?=substr($cliente['cpf'], 0, 3) . '.' . substr($cliente['cpf'], 3, 3) . '.' . substr($cliente['cpf'], 6, 3) . '-' . substr($cliente['cpf'], 9, 2)?></td>
                            <td class="text-center"><?=substr($cliente['rg'], 0, 2) . '.' . substr($cliente['rg'], 2, 3) . '.' . substr($cliente['rg'], 5, 3) . '-' . substr($cliente['rg'], 8, 1)?></td>
                            <td class="text-center"><?='(' . substr($cliente['telefone'], 0, 2) . ') ' . substr($cliente['telefone'], 2, 5) . '-' . substr($cliente['telefone'], 7, 4)?></td>
                            <td class="text-center"><?=$cliente['rua']?></td>
                            <td class="text-center"><?=$cliente['bairro']?></td>
                            <td class="text-center"><?=$cliente['cidade']?></td>
                            <td class="text-center"><?=$cliente['Estado']?></td>
                            <td class="text-center"><?=substr($cliente['cep'], 0, 2) . '.' . substr($cliente['cep'], 2, 3) . '-' . substr($cliente['cep'], 5, 3)?></td>
                            <td class="text-center">
                                <a href="editarCliente.php?id=<?=$cliente['idCliente']?>" class="btn btn-success">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a class="btn btn-danger" onclick="confirmarDelete('excluirCliente.php?idCliente=<?= $cliente['idCliente'] ?>', '<?= $cliente['nome'] ?>')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        include_once "../../templates/footer.php";
    ?>
    <script>
        function confirmarDelete(url, nome){
            let remover = confirm("Realmente deseja excluir o produto '" + nome + "'?");
            
            if(remover){
                window.location.href= url;
            } 
        }
    </script>
</body>
</html>