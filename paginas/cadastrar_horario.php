    <?php
    session_start();
    include_once "../banco/database.php";
    include_once "../objetos/agendar.php";
    include_once "../controllers/agendamentoController.php";

    // Verifica se o usuário é admin
    if (!isset($_SESSION['usuarios']) || strtoupper($_SESSION['usuarios']->tipo) !== 'ADMIN') {
        header('Location: ../paginas/index.php');
        exit();
    }

    $controller = new agendamentoController();
    $agendamentos = $controller->listarHorariosDisponiveis();

    // --- Cadastrar horário ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
        $data = $_POST['data'] ?? null;
        $hora = $_POST['hora'] ?? null;

        if ($data && $hora) {
            $controller->cadastrarHorario([
                'data' => $data,
                'hora' => $hora
            ]);

            header("Location: cadastrar_horario.php?sucesso=1");
            exit();
        }
    }

    // --- Excluir horário ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
        $id_horario = $_POST['id_horario'] ?? null;
        if ($id_horario) {
            $controller->excluirHorario($id_horario);
            header("Location: cadastrar_horario.php");
            exit();
        }
    }
?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Horários | Shift Node</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/cadastrar_horario.css">

    </head>
    <body>

    <div class="hero">
    <nav>
        <a href="dashboard.php" class="logo"><img src="../img/shiftnode.png" alt="logo"></a>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="lista_agendamentos.php">Agendamentos</a></li>
            <li><a href="cadastrar_horario.php" class="active">Horários</a></li>
        </ul>
        <div class="user-area">
            <?php if (isset($_SESSION['usuarios'])): ?>
                <span style="color: #fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']->nome); ?>!</span>
                <a style="color: red;" href="../logout.php">Sair</a>
            <?php endif; ?>
        </div>
    </nav>
    </div>

    <div class="main-content">
    <div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-clock"></i> Gerenciar Horários</h2>

    <!-- Formulário de cadastro -->
    <div class="form-card">
    <form method="POST" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" required>
        </div>
        <div class="col-md-5">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" required>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" name="confirmar" class="btn btn-confirm">
                <i class="fas fa-check"></i> Confirmar
            </button>
        </div>
    </form>
    </div>

    <?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">Horário cadastrado com sucesso!</div>
    <?php endif; ?>

    <!-- Lista de horários -->
    <div class="table-container">
    <table class="table table-hover align-middle" id="tabelaHorarios">
    <thead>
    <tr>
        <th>ID</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Status</th>

    </tr>
    </thead>
    <tbody>
    <?php if (empty($agendamentos)): ?>
        <tr>
        <td colspan="5" class="text-center text-muted">Nenhum horário cadastrado.</td>
        </tr>
        <?php else: ?>
                <?php foreach ($agendamentos as $h): ?>
                            <tr>
                                <td><?= htmlspecialchars($h->id) ?></td>
                                <td><?= htmlspecialchars(substr($h->hora,0,5)) ?></td>
                                <td><?= htmlspecialchars($h->status ?? 'Disponível') ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id_horario" value="<?= $h->id ?>">
                                    <button type="submit" name="excluir" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Excluir
                                    </button>
                                </form>
                                </td>
                            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
