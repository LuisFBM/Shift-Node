<?php
session_start();
include_once '../controllers/agendamentoController.php';
include_once '../controllers/veiculoController.php';

if (!isset($_SESSION['usuarios'])) {
    header('Location: login.php');
    exit;
}

$agendaCtrl = new agendamentoController();
$veiculoCtrl = new veiculoController();

$msg = '';
$tipo = '';

$horariosDisponiveis = $agendaCtrl->listarHorariosDisponiveis();

// PROCESSA CADASTRO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {

    $dados = [
        'veiculo_nome'     => trim($_POST['veiculo_nome'] ?? ''),
        'veiculo_ano'      => trim($_POST['veiculo_ano'] ?? ''),
        'data_agendamento' => trim($_POST['data_agendamento'] ?? ''),
        'hora'             => trim($_POST['hora'] ?? ''),
        'tipo_servico'     => trim($_POST['tipo_servico'] ?? ''),
        'observacoes'      => trim($_POST['observacoes'] ?? '')
    ];

    // validação
    if (in_array('', $dados, true)) {
        $msg = "Preencha todos os campos obrigatórios.";
        $tipo = 'erro';
    } else {
        // cadastra veículo
        $id_veiculo = $veiculoCtrl->cadastrarVeiculo([
            'nome' => $dados['veiculo_nome'],
            'ano' => $dados['veiculo_ano'],
            'id_usuario' => $_SESSION['usuarios']->id
        ]);

        if ($id_veiculo) {
            if ($agendaCtrl->cadastrarAgenda([
                'id_veiculo' => $id_veiculo,
                'data_agendamento' => $dados['data_agendamento'],
                'hora' => $dados['hora'],
                'tipo_servico' => $dados['tipo_servico'],
                'observacoes' => $dados['observacoes']
            ])) {
                // marca horário como ocupado
                $agendaCtrl->marcarHorarioOcupado($dados['hora']);
                $msg = "✅ Agendamento realizado com sucesso!";
                $tipo = 'sucesso';
            } else {
                $msg = "❌ Erro ao cadastrar agendamento.";
                $tipo = 'erro';
            }
        } else {
            $msg = "❌ Erro ao cadastrar veículo.";
            $tipo = 'erro';
        }
    }
}

// lista agendamentos do usuário
$agendamentos = $agendaCtrl->listarPorUsuario($_SESSION['usuarios']->id);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Serviço</title>
    <link rel="stylesheet" href="../style/agendar.css">
</head>
<body>

<div class="hero">
    <nav>
        <a href="index.php" class="logo"><img src="../img/shiftnode.png" alt="logo"></a>
        <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="index.php#servicos">Serviços</a></li>
            <li><a href="index.php#quem-somos">Quem Somos</a></li>
            <li><a href="contatos.php">Contatos</a></li>
        </ul>
        <div class="user-area">
            <span style="color:#fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']->nome) ?>!</span>
            <a style="color:red;" href="../logout.php">Sair</a>
        </div>
    </nav>
</div>

<div class="corpo">

    <div class="agendar-servi">
        <h1>Agendar Serviço</h1><br>

        <?php if ($msg): ?>
            <div class="mensagem <?= $tipo ?>">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="cadastrar" value="1">

            <label>Tipo de Serviço:</label><br>
            <select name="tipo_servico" required>
                <option value="">Selecione o Serviço</option>
                <option>Verificar nível de fluídos</option>
                <option>Trocar óleo do motor e filtro</option>
                <option>Trocar fluído de freio</option>
                <option>Trocar fluído de arrefecimento</option>
                <option>Verificar pastilhas de freio</option>
                <option>Revisão completa de freios</option>
                <option>Trocar discos e tambores de freio</option>
            </select><br><br>

            <label>Data:</label><br>
            <input type="date" name="data_agendamento" required><br><br>

            <label>Horário:</label><br>
            <select name="hora" required>
                <option value="">Selecione um horário disponível</option>
                <?php if (!empty($horariosDisponiveis)): ?>
                    <?php foreach ($horariosDisponiveis as $h): ?>
                        <option value="<?= htmlspecialchars($h->hora) ?>">
                            <?= substr($h->hora, 0, 5) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>Nenhum horário disponível</option>
                <?php endif; ?>
            </select><br><br>

            <h2>Dados do Veículo</h2><br>

            <label>Nome/Modelo:</label>
            <input type="text" name="veiculo_nome" placeholder="Ex: Gol G5" required><br><br>

            <label>Ano:</label>
            <input type="number" name="veiculo_ano" placeholder="Ex: 2015" min="1900" max="2025" required><br><br>

            <label>Observações:</label><br>
            <textarea name="observacoes" rows="4" placeholder="Observações..."></textarea><br><br>

            <button type="submit">Confirmar Agendamento</button>
        </form>
    </div>

    <div class="agendamentos">
        <h2>Meus Agendamentos</h2><br>

        <?php if (!empty($agendamentos)): ?>
            <div class="agendamentos-container">
                <?php foreach ($agendamentos as $a): ?>
                    <div class="agendamento-card">
                        <div class="agendamento-info">
                            <h3><?= htmlspecialchars($a->tipo_servico) ?></h3>
                            <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($a->data_agendamento)) ?></p>
                            <p><strong>Horário:</strong> <?= htmlspecialchars($a->hora) ?></p>
                            <p><strong>Veículo:</strong> <?= htmlspecialchars($a->veiculo_nome) ?> (<?= htmlspecialchars($a->veiculo_ano) ?>)</p>
                            <?php if (!empty($a->observacoes)): ?>
                                <p><strong>Obs:</strong> <?= htmlspecialchars($a->observacoes) ?></p>
                            <?php endif; ?>
                            <p><strong>Status:</strong> 
                                <span class="status <?= strtolower($a->status) ?>">
                                    <?= htmlspecialchars($a->status) ?>
                                </span>
                            </p>
                        </div>
                        <div class="agendamento-acoes">
                            <a href="editar_agendamento.php?id=<?= $a->id_agendamento ?>" class="btn-alterar">
                                <img src="../img/Edit.png" alt="editar">
                            </a>
                            <a href="excluir_agendamento.php?id=<?= $a->id_agendamento ?>" class="btn-excluir" onclick="return confirm('Deseja realmente excluir?')">
                                <img src="../img/Remove.png" alt="excluir">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Você ainda não tem agendamentos.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
