<?php
session_start();
include_once "../banco/database.php";
include_once "../objetos/usuarios.php";
include_once "../controllers/agendamentoController.php";

$controller = new agendamentoController();

// Redireciona se não for admin
if (!isset($_SESSION['usuarios']) || strtoupper($_SESSION['usuarios']->tipo) !== 'ADMIN') {
    header('Location: ../paginas/index.php');
    exit();
}

// === ATUALIZA STATUS ===
// Verifica se há ação de confirmar ou cancelar
if (isset($_GET['confirmar'])) {
    $id = intval($_GET['confirmar']);
    $controller->atualizarStatusAgendamento($id, 'Confirmado');
    header("Location: lista_agendamentos.php");
    exit();
}

if (isset($_GET['cancelar'])) {
    $id = intval($_GET['cancelar']);
    $controller->atualizarStatusAgendamento($id, 'Cancelado');
    header("Location: lista_agendamentos.php");
    exit();
}

// === LISTA AGENDAMENTOS ===
$agendamentos = $controller->index();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Admin | Shift Node</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/lista_agendamento.css">
</head>
<body>

<!-- Navbar -->
<div class="hero">
    <nav>
        <a href="dashboard.php" class="logo">
            <img src="../img/shiftnode.png" alt="Shift Node Logo">
        </a>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="lista_agendamentos.php" class="active">Agendamentos</a></li>
            <li><a href="cadastrar_horario.php">Horários</a></li>
        </ul>

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

<!-- CONTEÚDO PRINCIPAL -->
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
        <button><i class="fas fa-filter"></i> Filtrar</button>
    </div>

   <div class="tabela-box">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Serviço</th>
            <th>Observações</th>
            <th>Data Criação</th>
        </tr>
        </thead>
        <tbody>
            <?php if (!empty($agendamentos)): ?>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <tr>
                        <td><?= $agendamento->id_agendamento ?></td>
                        <td><?= $agendamento->nome_usuario ?></td>
                        <td><?= $agendamento->nome_veiculo ?></td>
                        <td><?= $agendamento->data_agendamento ?></td>
                        <td><?= $agendamento->hora ?></td>
                        <td><?= $agendamento->tipo_servico ?></td>
                        <td><?= $agendamento->observacoes ?></td>
                        <td><?= $agendamento->data_criacao ?></td>

                    <td>
                    <?php if ($agendamento->status === 'Pendente'): ?>

                    <a href="lista_agendamentos.php?confirmar=<?= $agendamento->id_agendamento ?>" class="btn btn-confirmar">
                    <i class="fas fa-check"></i>
                    </a>


                    <a href="lista_agendamentos.php?cancelar=<?= $agendamento->id_agendamento ?>" class="btn btn-cancelar">
                    <i class="fas fa-times"></i>
                    </a>

                    <?php else: ?>

                    <span class="status-<?= strtolower($agendamento->status) ?>">
                    <?= $agendamento->status ?>
                    
                    </span>

                    <?php endif; ?>

                    </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center;">Nenhum agendamento encontrado</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div>

</body>
</html>
