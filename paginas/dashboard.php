<?php
session_start();
include_once "../banco/database.php";
include_once "../objetos/usuarios.php";
include_once "../controllers/usuariosController.php";

// Redireciona se não estiver logado ou não for admin


// Você pode carregar dados resumidos aqui para o painel inicial
// Exemplo: total de agendamentos, horários livres, agendamentos pendentes
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Shift Node</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/dashboard.css"> <!-- CSS específico do dashboard -->
</head>
<body>

<!-- Navbar Dashboard -->
<div class="hero">
    <nav>
        <a href="dashboard.php" class="logo">
            <img src="../img/shiftnode.png" alt="logo">
        </a>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="lista_agendamentos.php">Agendamentos</a></li>
            <li><a href="cadastrar_horario.php">Horários</a></li>
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

<!-- Conteúdo principal -->
<div class="container-fluid mt-4">
    <!-- Painel Resumo -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <i class="fas fa-calendar-check fa-2x mb-2" style="color:#6155f5;"></i>
                <h5>Total de Agendamentos</h5>
                <p class="fs-4">0</p> <!-- Substituir pelo total real -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <i class="fas fa-clock fa-2x mb-2" style="color:#6155f5;"></i>
                <h5>Horários Livres</h5>
                <p class="fs-4">0</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <i class="fas fa-check-circle fa-2x mb-2" style="color:#6155f5;"></i>
                <h5>Agendamentos Confirmados</h5>
                <p class="fs-4">0</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <i class="fas fa-times-circle fa-2x mb-2" style="color:#6155f5;"></i>
                <h5>Agendamentos Cancelados</h5>
                <p class="fs-4">0</p>
            </div>
        </div>
    </div>

    <!-- Área de conteúdo dinâmico -->
    <div id="dashboard-content">
        <p>Selecione uma opção no menu para gerenciar agendamentos ou horários.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
