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
        
            $enderecos = $_POST['enderecos'];
        
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

    <script>
        // Função para adicionar um novo endereço
        function adicionarEndereco() {
            const container = document.getElementById('enderecos-container');
            const index = container.children.length;
            
            const enderecoHTML = `
                <div class="endereco-item border p-3 mb-3 position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0" onclick="removerEndereco(this)"></button>
                    <input type="hidden" name="enderecos[${index}][idEndereco]" value="">
                    <div class="row">
                        <div class="col">
                            <label>Rua</label>
                            <input type="text" name="enderecos[${index}][rua]" class="form-control" placeholder="Rua do Cliente" required>
                        </div>
                        <div class="col">
                            <label>Bairro</label>
                            <input type="text" name="enderecos[${index}][bairro]" class="form-control" placeholder="Bairro" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Cidade</label>
                            <input type="text" name="enderecos[${index}][cidade]" class="form-control" placeholder="Cidade" required>
                        </div>
                        <div class="col">
                            <label>Estado</label>
                            <select name="enderecos[${index}][estadoId]" class="form-control" required>
                                <option value="" disabled selected>Selecione o Estado</option>
                                <?php foreach($estados as $estado): ?>
                                    <option value="<?= $estado['idEstado'] ?>"><?= $estado['nomeEstado'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>CEP</label>
                            <input type="text" name="enderecos[${index}][cep]" class="form-control" placeholder="CEP" required>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', enderecoHTML);
        }

        // Função para remover um endereço
        function removerEndereco(btn) {
            const enderecoItem = btn.closest('.endereco-item');
            enderecoItem.remove();
        }
    </script>

</head>
<body class="d-flex flex-column min-vh-100">
<div class="container">
        <form action="" method="post">
            <h2 class="text-center mx-auto py-3">Edição de Clientes</h2>

            <input type="hidden" name="idCliente" value="<?= $clientes['idCliente'] ?>">
        
            <h4 class="mt-4">Dados Pessoais</h4>
            <div id="dadosPessoais-container">
                <div class="dadosPessoais-group border p-3 mb-3 rounded">
                    <div class="row">
                        <div class="col">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?= $clientes['nome'] ?>" required>
                        </div>
                        <div class="col">
                            <label>Data de Nascimento</label>
                            <input type="date" name="dataNascimento" class="form-control" value="<?= $clientes['dataNascimento'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>CPF</label>
                            <input type="text" name="cpf" class="form-control" value="<?= $clientes['cpf'] ?>" required>
                        </div>
                        <div class="col">    
                            <label>RG</label>
                            <input type="text" name="rg" class="form-control" value="<?= $clientes['rg'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="<?= $clientes['telefone'] ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div id="enderecos-container">
                <?php foreach ($enderecos as $index => $endereco): ?>
                    <div class="endereco-item border p-3 mb-3 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0" onclick="removerEndereco(this)"></button>
                        <input type="hidden" name="enderecos[<?= $index ?>][idEndereco]" value="<?= $endereco['idEndereco'] ?>">

                        <div class="row">
                            <div class="col">
                                <label>Rua</label>
                                <input type="text" name="enderecos[<?= $index ?>][rua]" class="form-control" value="<?= $endereco['rua'] ?>" required>
                            </div>
                            <div class="col">
                                <label>Bairro</label>
                                <input type="text" name="enderecos[<?= $index ?>][bairro]" class="form-control" value="<?= $endereco['bairro'] ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Cidade</label>
                                <input type="text" name="enderecos[<?= $index ?>][cidade]" class="form-control" value="<?= $endereco['cidade'] ?>" required>
                            </div>
                            <div class="col">
                                <label>Estado</label>
                                <select name="enderecos[<?= $index ?>][estadoId]" class="form-control" required>
                                    <option value="" disabled selected>Selecione o Estado</option>
                                    <?php foreach($estados as $estado): ?>
                                        <option value="<?= $estado['idEstado'] ?>" <?= ($estado['idEstado'] == $endereco['estadoId'] ? 'selected' : '') ?>>
                                            <?= $estado['nomeEstado'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>CEP</label>
                                <input type="text" name="enderecos[<?= $index ?>][cep]" class="form-control" value="<?= $endereco['cep'] ?>" required>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="button" class="btn btn-primary d-block mx-auto mb-3" onclick="adicionarEndereco()">Adicionar Endereço</button>
            <button type="submit" class="btn btn-success my-2 d-block mx-auto w-25">Atualizar</button>
        </form>
    </div>

    <?php include_once "../../templates/footer.php"; ?>
</body>
</html>