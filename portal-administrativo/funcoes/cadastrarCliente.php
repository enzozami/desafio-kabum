<?php 
    //require_once "../desafio-kabum/classes";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente || DESAFIO KABUM</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
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
                    <input type="" name="cpf" class="form-control" maxlength="11" placeholder="CPF do Cliente" required>
                </div>
                <div class="col">    
                    <label for="">RG</label>
                    <input type="" name="rg" class="form-control" maxlength="9" placeholder="RG do Cliente" required>
                </div>
            </div>
            <div class="row">
                <div class="col">    
                    <label for="">Telefone</label>
                    <input type="" name="telefone" class="form-control" maxlength="9" placeholder="Número de Telefone/Celular do Cliente" required>
                </div>
                <div class="col">
                    <label for="">Endereço</label>
                    <input type="text" name="endereco" class="form-control" placeholder="Endereço do Cliente" required>
                </div>
            </div>
            <button class="btn btn-success my-2 d-block mx-auto w-25">Cadastrar</button>
        </form>
    </div>
</body>
</html>