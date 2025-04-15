<?php
session_start();  // Inicia a sessão
session_destroy();  // Destroi a sessão, desconectando o usuário
header("Location: index.php");  // Redireciona para a página de login
exit();
?>