<?php
session_start();
include_once "../banco/database.php";
include_once "../objetos/usuarios.php";
include_once "../controllers/usuariosController.php";

// Redireciona se já estiver logado
if (isset($_SESSION['usuarios'])) {
    $tipo = strtoupper($_SESSION['usuarios']->tipo);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Inicial</title>
<link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>

<!-- Navbar -->
<div class="hero">
    <nav>
        <a href="index.php" class="logo">
            <img src="../img/shiftnode.png" alt="logo">
        </a>
        <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="#servicos">Serviços</a></li>
            <li><a href="#quem-somos">Quem Somos</a></li>
            <li><a href="contatos.php">Contatos</a></li>
        </ul>

        <!-- Área de login -->
        <div class="user-area">
            <?php if (isset($_SESSION['usuarios'])): ?>
                <span style="color: #fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']->nome); ?>!</span>
                <a style="color: red;" href="../logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php" class="login">Login</a>
                <a href="cadastro.php" class="cadastro">Cadastrar</a>
            <?php endif; ?>
        </div>
    </nav>
</div>


<!-- Fundo com imagem -->
 <section class="fundo">
  <div class="fundo-content">
    <h2>Benefícios do Dashboard</h2><br><br>
    <ul>
      <li>Informações Centralizadas</li>
      <li>Monitoramento em Tempo Real</li>
      <li>Gestão Simplificada de Serviços</li>
      <li>Acesso Fácil a Agendamentos</li>
      <li>Decisões Mais Rápidas e Precisas</li>
    </ul>
  </div>
</section>

<!-- Conteúdo -->
<main class="main-content">
  <h1>Bem-vindo ao Dashboard</h1>



</main>

</body>
</html>