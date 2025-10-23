<?php
session_start();
include_once "../banco/database.php";
include_once "../controllers/usuariosController.php";
include_once "../controllers/agendamentoController.php";

// Redireciona se não estiver logado ou não for admin
if (!isset($_SESSION['usuarios']) || strtoupper($_SESSION['usuarios']->tipo) !== 'ADMIN') {
    header('Location: ../paginas/index.php');
    exit();
}

// Instancia os controllers
$agendamentoCtrl = new AgendamentoController();

// Obtém os dados dos métodos
$totalAgendamentos = $agendamentoCtrl->contarAgendamentos();
$confirmados = $agendamentoCtrl->contarConfirmados();
$cancelados = $agendamentoCtrl->contarCancelados();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>

<div class="hero">
    <nav>
        <a href="dashboard.php" class="logo">
            <img src="../img/shiftnode.png" alt="Shift Node Logo">
        </a>
        <ul>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="lista_agendamentos.php">Agendamentos</a></li>
            <li><a href="cadastrar_horario.php">Horários</a></li>
        </ul>
        <div class="user-area">
            <?php if (isset($_SESSION['usuarios'])): ?>
                <span style="color: #fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']->nome); ?>!</span>
                <a style="color: red;" href="../logout.php">Sair</a>
            <?php endif; ?>
        </div>
    </nav>
</div>

<main class="container mt-4">
    <h2 class="text-center mb-4">Painel de Controle Administrativo</h2>

<div class="cards-container text-center">
    <div class="card painel-card">
        <i class="fas fa-calendar-check icon"></i>
        <h5>Total de Agendamentos</h5>
        <p class="valor"><?= $totalAgendamentos; ?></p>
    </div>

    <div class="card painel-card">
        <i class="fas fa-check-circle icon"></i>
        <h5>Confirmados</h5>
        <p class="valor"><?= $confirmados; ?></p>
    </div>

    <div class="card painel-card">
        <i class="fas fa-times-circle icon"></i>
        <h5>Cancelados</h5>
        <p class="valor"><?= $cancelados; ?></p>
    </div>
</div>

</div>

    <div class="text-center mt-5">
        <p>Bem-vindo ao painel de administração do <strong>Shift Node</strong>.<br>
        Acesse as opções acima para gerenciar os agendamentos e horários disponíveis.</p>
    </div>
</main>

</body>
</html>
