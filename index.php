<?php 
    session_start();  // Inicia a sessão
    require_once "classes/Database.php";
    require_once "classes/Usuario.php";

    $mensagem = "";
    $alertColor = "";

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    if ($email && $senha){
        $conexao = (new Database())->conectar();

        if($conexao){
            $usuario = new Usuario($conexao);
            $resultado = $usuario->autenticar($email, $senha);
            
            if ($resultado) {
                $_SESSION['user_id'] = $resultado['idADM'];
                $_SESSION['user_name'] = $resultado['nome'];
                header("Location: portal-administrativo/area-administrativa.php");
                exit();
            } else {
                $mensagem = "E-mail ou Senha incorretos!";
                $alertColor = "danger";
            }
        } else {
            $mensagem = "Erro na conexão com o banco de dados.";
            $alertColor = "danger";
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos!";
        $alertColor = "warning";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAFIO KABUM</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style> 
        #login {
            max-width: 500px;
            max-height: 500px;
            padding: 10px;
            border: 3px solid white;
            border-radius: 15px;
            position: absolute; /* Permite o uso de top e left */
            top: 50%; /* Alinha ao meio verticalmente */
            left: 50%; /* Alinha ao meio horizontalmente */
            transform: translate(-50%, -50%); /* Centraliza o centro do elemento */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Adiciona uma sombra sutil */
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div id="login">       
                <div class="text-left">
                    <h2 class="text-center">LOGIN</h2>
                    <label for="email" class="form-label">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" maxlength="15" required>
                </div>
                <div class="d-flex justify-content-between align-items-center my-3">
                    <button type="submit" id="btn" class="btn btn-outline-success my-2 d-block mx-auto">Entrar</button>
                </div>

                <!-- Exibir mensagem de erro ou sucesso -->
                <?php if (!empty($mensagem)): ?>
                    <div class="alert alert-<?=$alertColor?> my-2 text-center">
                        <?=$mensagem?>
                    </div>
                <?php endif; ?>
            </div>   
        </form>
    </div>
</body>
</html>
