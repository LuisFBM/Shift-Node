<?php
session_start();
include_once '../controllers/agendamentoController.php';

// Verifica se está logado
if (!isset($_SESSION['usuarios'])) {
    header('Location: login.php');
    exit;
}

$controller = new agendamentoController();
$mensagem = '';
$tipo_mensagem = '';
$agendamento = null;

// Busca o agendamento
if (isset($_GET['id'])) {
    $id_agendamento = $_GET['id'];
    $agendamento = $controller->buscarAgendamento($id_agendamento);
    
    // Verifica se o agendamento pertence ao usuário
    if (!$agendamento || $agendamento->id_usuario != $_SESSION['usuarios']->id) {
        header('Location: agendamento.php?erro=permissao');
        exit;
    }
}

// Processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    $data_agendamento = $_POST['data_agendamento'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $tipo_servico = $_POST['tipo_servico'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    if (empty($data_agendamento) || empty($hora) || empty($tipo_servico)) {
        $mensagem = "Preencha todos os campos obrigatórios.";
        $tipo_mensagem = 'erro';
    } else {
        $resultado = $controller->atualizarAgendamento([
            'id_agendamento' => $_POST['id_agendamento'],
            'data_agendamento' => $data_agendamento,
            'hora' => $hora,
            'tipo_servico' => $tipo_servico,
            'observacoes' => $observacoes
        ]);
        
        if ($resultado) {
            header('Location: agendamento.php?msg=atualizado');
            exit;
        } else {
            $mensagem = "Erro ao atualizar o agendamento.";
            $tipo_mensagem = 'erro';
        }
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="../style/agendar.css">
</head>
<body>

<div class="hero">
    <nav>
        <a href="index.php" class="logo">
            <img src="../img/shiftnode.png" alt="logo">
        </a>
        <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="index.php#servicos">Serviços</a></li>
            <li><a href="index.php#quem-somos">Quem Somos</a></li>
            <li><a href="contatos.php">Contatos</a></li>
        </ul>

        <div class="user-area">
            <span style="color: #fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']->nome); ?>!</span>
            <a style="color: red;" href="../logout.php">Sair</a>
        </div>
    </nav>
</div>

<div class="corpo">
    <div class="agendar-servi">
        <h1>Editar Agendamento</h1><br>

        <?php if (!empty($mensagem)): ?>
            <div style="padding:15px; margin-bottom:20px; border-radius:5px; background:<?= $tipo_mensagem === 'sucesso' ? '#d4edda' : '#f8d7da' ?>; color:<?= $tipo_mensagem === 'sucesso' ? '#155724' : '#721c24' ?>;">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <?php if ($agendamento): ?>
        <form action="" method="post">
            <input type="hidden" name="atualizar" value="1">
            <input type="hidden" name="id_agendamento" value="<?= $agendamento->id_agendamento ?>">

            <label for="servico">Tipo de Serviço:</label><br>
            <select id="servico" name="tipo_servico" required>
                <option value="">Selecione o Serviço</option>
                <option value="Verificar nível de fluídos" <?= $agendamento->tipo_servico === 'Verificar nível de fluídos' ? 'selected' : '' ?>>Verificar nível de fluídos</option>
                <option value="Trocar óleo do motor e filtro" <?= $agendamento->tipo_servico === 'Trocar óleo do motor e filtro' ? 'selected' : '' ?>>Trocar óleo do motor e filtro</option>
                <option value="Trocar fluído de freio" <?= $agendamento->tipo_servico === 'Trocar fluído de freio' ? 'selected' : '' ?>>Trocar fluído de freio</option>
                <option value="Trocar fluído de arrefecimento" <?= $agendamento->tipo_servico === 'Trocar fluído de arrefecimento' ? 'selected' : '' ?>>Trocar fluído de arrefecimento</option>
                <option value="Verificar pastilhas de freio" <?= $agendamento->tipo_servico === 'Verificar pastilhas de freio' ? 'selected' : '' ?>>Verificar pastilhas de freio</option>
                <option value="Revisão completa de freios" <?= $agendamento->tipo_servico === 'Revisão completa de freios' ? 'selected' : '' ?>>Revisão completa de freios</option>
                <option value="Trocar discos e tambores de freio" <?= $agendamento->tipo_servico === 'Trocar discos e tambores de freio' ? 'selected' : '' ?>>Trocar discos e tambores de freio</option>
            </select><br><br>

            <label for="data_agendamento">Data:</label><br>
            <input type="date" id="data" name="data_agendamento" value="<?= $agendamento->data_agendamento ?>" required><br><br>

            <label for="hora">Horário:</label><br>
            <select id="hora" name="hora" required>
                <option value="">Selecione o Horário</option>
                <option value="08:00" <?= $agendamento->hora === '08:00:00' ? 'selected' : '' ?>>08:00</option>
                <option value="09:20" <?= $agendamento->hora === '09:20:00' ? 'selected' : '' ?>>09:20</option>
                <option value="10:40" <?= $agendamento->hora === '10:40:00' ? 'selected' : '' ?>>10:40</option>
                <option value="13:00" <?= $agendamento->hora === '13:00:00' ? 'selected' : '' ?>>13:00</option>
                <option value="14:20" <?= $agendamento->hora === '14:20:00' ? 'selected' : '' ?>>14:20</option>
                <option value="15:40" <?= $agendamento->hora === '15:40:00' ? 'selected' : '' ?>>15:40</option>
            </select><br><br>

            <h2>Veículo</h2>
            <p><strong><?= htmlspecialchars($agendamento->veiculo_nome) ?></strong> (<?= htmlspecialchars($agendamento->veiculo_ano) ?>)</p>
            <small>Não é possível alterar o veículo</small><br><br>

            <label for="obs">Observações:</label><br>
            <textarea id="obs" name="observacoes" rows="4" placeholder="Observações..."><?= htmlspecialchars($agendamento->observacoes) ?></textarea><br><br>

           <div class="botoes-acoes">
                <button type="submit" class="btn-salvar">Salvar Alterações</button>
               <a href="agendamento.php" class="btn-cancelar">Cancelar</a>
           </div>

        </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>