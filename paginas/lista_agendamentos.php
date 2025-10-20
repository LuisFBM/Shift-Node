<?php
session_start();
include_once "../banco/database.php";
include_once "../objetos/usuarios.php";

// Redireciona se não for admin
if (!isset($_SESSION['usuarios']) || strtoupper($_SESSION['usuarios']->tipo) !== 'ADMIN') {
    header('Location: ../paginas/index.php');
    exit();
}

// Aqui você carregaria os agendamentos do banco
$agendamentos = []; // Exemplo vazio, futuramente puxar do banco
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../style/lista_agendamento.css">
    <link rel="stylesheet" href="../style/index.css">
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

<!-- CONTEÚDO -->
<div class="container">
    
    <!-- Cabeçalho -->
    <div class="header">
        <h1><i class="fas fa-calendar-check"></i> Gerenciar Agendamentos</h1>
        <p>Visualize, confirme ou cancele agendamentos de clientes</p>
    </div>

    <!-- Filtros -->
    <div class="filtros">
        <select id="filtroStatus">
            <option value="">Todos os status</option>
            <option value="pendente">Pendente</option>
            <option value="confirmado">Confirmado</option>
            <option value="cancelado">Cancelado</option>
        </select>
        <input type="date" id="filtroData" placeholder="Data">
        <button onclick="filtrar()"><i class="fas fa-filter"></i> Filtrar</button>
    </div>

    <!-- Tabela -->
    <div class="tabela-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($agendamentos)): ?>
                <!-- Mensagem quando não há agendamentos -->
                <tr>
                    <td colspan="6">
                        <div class="vazio">
                            <i class="fas fa-calendar-times"></i>
                            <p>Nenhum agendamento encontrado</p>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <!-- Loop pelos agendamentos (exemplo) -->
                <?php foreach ($agendamentos as $item): ?>
                <tr>
                    <td>#<?= $item['id'] ?></td>
                    <td><?= $item['cliente'] ?></td>
                    <td><?= $item['servico'] ?></td>
                    <td><?= $item['data'] ?></td>
                    <td>
                        <span class="badge badge-<?= $item['status'] ?>">
                            <?= ucfirst($item['status']) ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-confirmar" onclick="confirmar(<?= $item['id'] ?>)">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-cancelar" onclick="cancelar(<?= $item['id'] ?>)">
                            <i class="fas fa-times"></i>
                        </button>
                        <button class="btn btn-ver" onclick="ver(<?= $item['id'] ?>)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="../JS/list_agend.js"></script>

</body>
</html>
