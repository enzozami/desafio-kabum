<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../style.css">
    <title>Área Administrativa</title>    
</head>
<body class="d-flex flex-column min-vh-100">
    <?php 
        include_once "../templates/navBar.php";
    ?>
    
    <div class="container text-center">
        <div class="row justify-content-center align-items-center" style="min-height: 76vh!important;">
            <div class="col">
                <a href="http://localhost:8080/dev-kabum/desafio-kabum/portal-administrativo/funcoes/cadastrarCliente.php#" class="text-decoration-none" style="font-size: 100px;">
                    <div class="icon">
                        <i class="bi bi-file-earmark-person"> <br>
                            <div class="text">Cadastrar Cliente</div>
                        </i>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="http://localhost:8080/dev-kabum/desafio-kabum/portal-administrativo/funcoes/listarCliente.php#" class="text-decoration-none" style="font-size: 100px;">
                    <div class="icon">
                        <i class="bi bi-list"> <br>
                            <div class="text">Listar Cliente</div>
                        </i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php
        include_once "../templates/footer.php"
    ?>
</body>
</html>