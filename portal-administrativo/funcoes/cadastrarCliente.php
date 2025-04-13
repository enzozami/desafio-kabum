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

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $dataNascimento = filter_input(INPUT_POST, 'dataNascimento', FILTER_DEFAULT);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
            $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

            // Criar um array com os endereços
            $enderecos = [
                [
                    'rua' => $_POST['enderecoRua'],
                    'bairro' => $_POST['enderecoBairro'],
                    'cidade' => $_POST['enderecoCidade'],
                    'estadoId' => $_POST['estadoId'],
                    'cep' => $_POST['enderecoCep']
                ]
            ];

            // Criar o objeto Cliente
            $clientes = new Cliente(null, $nome, $dataNascimento, $cpf, $rg, $telefone, $enderecos);

            // Realizar o cadastro
            $cadastro = $funcoes->cadastrar($clientes);

            if ($cadastro) {
                echo "<script>alert('Cliente cadastrado com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar cliente.');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente || DESAFIO KABUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2 class="text-center mx-auto py-3">Cadastro de Clientes</h2>
        
            <div class="row">
                <div class="col">
                    <label for="">Nome</label>
                    <input type="text" name="nome" class="form-control" minlength="3" maxlength="200" placeholder="Nome do Cliente" required>
                </div>
                <div class="col">
                    <label for="">Data de Nascimento</label>
                    <input type="date" name="dataNascimento" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">CPF</label>
                    <input type="text" name="cpf" class="form-control" maxlength="11" placeholder="CPF do Cliente" required>
                </div>
                <div class="col">    
                    <label for="">RG</label>
                    <input type="text" name="rg" class="form-control" maxlength="9" placeholder="RG do Cliente" required>
                </div>
            </div>
            <div class="row">
                <div class="col">    
                    <label for="">Telefone</label>
                    <input type="text" name="telefone" class="form-control" maxlength="11" placeholder="Número do Cliente" required>
                </div>
                <div class="col">
                    <label for="">Rua</label>
                    <input type="text" name="enderecoRua" class="form-control" placeholder="Rua do Cliente" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Bairro</label>
                    <input type="text" name="enderecoBairro" class="form-control" placeholder="Bairro" required>
                </div>
                <div class="col">
                    <label for="">Cidade</label>
                    <input type="text" name="enderecoCidade" class="form-control" placeholder="Cidade" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Estado</label>
                    <select name="estadoId" class="form-control rounded-pill" required>
                        <option value="" disabled selected>Selecione Seu Estado</option>
                        <option value="1">Acre (AC)</option>
                        <option value="2">Alagoas (AL)</option>
                        <option value="3">Amapá (AP)</option>
                        <option value="4">Amazonas (AM)</option>
                        <option value="5">Bahia (BA)</option>
                        <option value="6">Ceará (CE)</option>
                        <option value="7">Distrito Federal (DF)</option>
                        <option value="8">Espírito Santo (ES)</option>
                        <option value="9">Goiás (GO)</option>
                        <option value="10">Maranhão (MA)</option>
                        <option value="11">Mato Grosso (MT)</option>
                        <option value="12">Mato Grosso do Sul (MS)</option>
                        <option value="13">Minas Gerais (MG)</option>
                        <option value="14">Pará (PA)</option>
                        <option value="15">Paraíba (PB)</option>
                        <option value="16">Paraná (PR)</option>
                        <option value="17">Pernambuco (PE)</option>
                        <option value="18">Piauí (PI)</option>
                        <option value="19">Rio de Janeiro (RJ)</option>
                        <option value="20">Rio Grande do Norte (RN)</option>
                        <option value="21">Rio Grande do Sul (RS)</option>
                        <option value="22">Rondônia (RO)</option>
                        <option value="23">Roraima (RR)</option>
                        <option value="24">Santa Catarina (SC)</option>
                        <option value="25">São Paulo (SP)</option>
                        <option value="26">Sergipe (SE)</option>
                        <option value="27">Tocantins (TO)</option>
                    </select>
                </div>
                <div class="col">
                    <label for="">CEP</label>
                    <input type="text" name="enderecoCep" class="form-control" placeholder="CEP" required>
                </div>
            </div>
            <button class="btn btn-success my-2 d-block mx-auto w-25">Cadastrar</button>
        </form>
    </div>
    <?php
        include_once "../../templates/footer.php"
    ?>
</body>
</html>
