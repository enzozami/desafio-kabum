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

        if (isset($_GET['id'])) {
            $idCliente = $_GET['id'];
        } else {
            // Se não foi passado, redirecionar ou exibir erro
            die("ID do cliente não especificado!");
        }
        
        $sqlClientes = "SELECT * FROM cliente WHERE idCliente = :idCliente";
        $params = [
            "idCliente" => $idCliente
        ];
        $stmt = $pdo->prepare($sqlClientes);
        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            $clientes = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            die("Cliente não encontrado!");
        }

        $sqlEndereco = "SELECT * FROM endereco WHERE clienteId = :clienteId";
        $params = [
            "clienteId" => $idCliente
        ];
        $stmt = $pdo->prepare($sqlEndereco);
        $stmt->execute($params);
        $enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sqlEstados = "SELECT * FROM estados";
        $stmt = $pdo->prepare($sqlEstados);
        $stmt->execute();
        $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Dados do cliente
            $idCliente = $_POST['idCliente'];
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $dataNascimento = filter_input(INPUT_POST, 'dataNascimento', FILTER_DEFAULT);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
            $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        
            // Dados do endereço
            $rua = $_POST['enderecoRua'];
            $bairro = $_POST['enderecoBairro'];
            $cidade = $_POST['enderecoCidade'];
            $estadoId = $_POST['estadoId'];
            $cep = $_POST['enderecoCep'];
        
            // Criar array de endereço (se você tiver uma classe Endereco, pode instanciar)
            $enderecos = [[
                'rua' => $rua,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estadoId' => $estadoId,
                'cep' => $cep
            ]];
        
            // Criar o objeto Cliente
            $cliente = new Cliente($idCliente, $nome, $dataNascimento, $cpf, $rg, $telefone, $enderecos);
        
            // Chamar função para editar (você precisa ter esse método na classe Funcoes)
            $resultado = $funcoes->editar($cliente); // ← esse método você precisa criar se ainda não existir
        
            if ($resultado) {
                echo "<script>alert('Cliente atualizado com sucesso!'); window.location.href = 'listarCliente.php';</script>";
                exit();
            } else {
                echo "<script>alert('Erro ao atualizar cliente.');</script>";
            }
        }        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Clientes || DESAFIO KABUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2 class="text-center mx-auto py-3">Edição de Clientes</h2>

            <input type="hidden" name="idCliente" value="<?= $clientes['idCliente']?>">
        
            <div class="row">
                <div class="col">
                    <label for="">Nome</label>
                    <input type="text" name="nome" class="form-control" minlength="3" maxlength="200" placeholder="Nome do Cliente" value="<?=$clientes['nome']?>" required>
                </div>
                <div class="col">
                    <label for="">Data de Nascimento</label>
                    <input type="date" name="dataNascimento" class="form-control" value="<?=$clientes['dataNascimento']?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">CPF</label>
                    <input type="text" name="cpf" class="form-control" maxlength="11" placeholder="CPF do Cliente" value="<?=$clientes['cpf']?>" required>
                </div>
                <div class="col">    
                    <label for="">RG</label>
                    <input type="text" name="rg" class="form-control" maxlength="9" placeholder="RG do Cliente" value="<?=$clientes['rg']?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">    
                    <label for="">Telefone</label>
                    <input type="text" name="telefone" class="form-control" maxlength="11" placeholder="Número do Cliente" value="<?=$clientes['telefone']?>" required>
                </div>
                <div class="col">
                    <label for="">Rua</label>
                    <input type="text" name="enderecoRua" class="form-control" placeholder="Rua do Cliente" value="<?=$enderecos[0]['rua']?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Bairro</label>
                    <input type="text" name="enderecoBairro" class="form-control" placeholder="Bairro" value="<?=$enderecos[0]['bairro']?>" required>
                </div>
                <div class="col">
                    <label for="">Cidade</label>
                    <input type="text" name="enderecoCidade" class="form-control" placeholder="Cidade" value="<?=$enderecos[0]['cidade']?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Estado</label>
                    <select name="estadoId" class="form-control rounded-pill" required>
                        <option value="" disabled selected>Selecione Seu Estado</option>
                        <?php
                            foreach($estados as $estado) { 
                        ?>
                        <option value="<?=$estado['idEstado']?>" <?= ($estado['idEstado'] == $enderecos[0]['estadoId'] ? 'selected' : '') ?> >
                            <?=$estado['nomeEstado'] ?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="">CEP</label>
                    <input type="text" name="enderecoCep" class="form-control" placeholder="CEP" value="<?=$enderecos[0]['cep']?>" required>
                </div>
            </div>
            <button class="btn btn-success my-2 d-block mx-auto w-25">Atualizar</button>
        </form>
    </div>
    <?php
        include_once "../../templates/footer.php"
    ?>
</body>
</html>
