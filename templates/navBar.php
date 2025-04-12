<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand ps-3" href="#">DESAFIO KABUM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Área Administrativa</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cliente
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="http://localhost:8080/dev-kabum/desafio-kabum/portal-administrativo/funcoes/cadastrarCliente.php#">Cadastrar</a></li>
            <li><a class="dropdown-item" href="http://localhost:8080/dev-kabum/desafio-kabum/portal-administrativo/funcoes/editarCliente.php#">Editar</a></li>
            <li><a class="dropdown-item" href="http://localhost:8080/dev-kabum/desafio-kabum/portal-administrativo/funcoes/excluirCliente.php#">Excluir</a></li>
            <li><a class="dropdown-item" href="http://localhost:8080/dev-kabum/desafio-kabum/portal-administrativo/funcoes/listarCliente.php#">Listar</a></li>
          </ul>
        </li>
      </ul>
      <!-- Exibir o nome do usuário logado na lateral direita -->
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_name'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Bem-vindo, <?php echo $_SESSION['user_name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../classes/Logout.php">Sair</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
