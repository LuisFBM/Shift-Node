<?php
session_start();
include_once "../banco/database.php";
include_once "../objetos/usuarios.php";

// Redireciona se não for admin
if (!isset($_SESSION['usuarios']) || strtoupper($_SESSION['usuarios']->tipo) !== 'ADMIN') {
    header('Location: ../paginas/index.php');
    exit();
}

// Cadastro de horários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $hora = $_POST['hora'];

}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horários - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/cadastrar_horario.css">
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

<div class="main-content">

<div class="container mt-4">
    <h2>Horários</h2>

    <div class="card ">
        <form action="" method="post">
            <div class="func">
                <div class="data">
                    <label>Data</label>
                    <input type="date" name="data" class="form-control" required>
                </div>
                <div class="hora">
                    <label>Hora</label>
                    <input type="time" name="hora" class="form-control" required>
                </div>
                <div class="adicionar">
                    <button type="submit" class="btn btn-add"><i class="fas fa-plus"></i> Adicionar</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($hora) === 0): ?>
                <tr>
                    <td colspan="4">Nenhum horário cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach($hora as $h): ?>
                    <tr>
                        <td><?= $h->id ?></td>
                        <td><?= $h->data ?></td>
                        <td><?= $h->hora ?></td>
                        <td>
                            <button class="btn btn-cancel"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
