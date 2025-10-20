<?php
session_start();
include_once '../controllers/agendamentoController.php';
include_once '../controllers/veiculoController.php';

// Redireciona se não logado
if (!isset($_SESSION['usuarios'])) {
    header('Location: login.php');
    exit;
}

$msg = '';
$tipo = '';

// Mensagens da URL (excluir/atualizar)
if (isset($_GET['msg'])) {
    $mensagens = [
        'excluido' => ['Agendamento excluído!', 'sucesso'],
        'atualizado' => ['Agendamento atualizado!', 'sucesso']
    ];
    if (isset($mensagens[$_GET['msg']])) {
        [$msg, $tipo] = $mensagens[$_GET['msg']];
    }
}

if (isset($_GET['erro'])) {
    $erros = [
        'permissao' => 'Você não tem permissão.',
        'excluir' => 'Erro ao excluir.'
    ];
    if (isset($erros[$_GET['erro']])) {
        $msg = $erros[$_GET['erro']];
        $tipo = 'erro';
    }
}

// Processa cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    
    // Pega todos os campos
    extract($_POST);
    
    // Valida campos obrigatórios
    if (empty($veiculo_nome) || empty($veiculo_ano) || empty($data_agendamento) || empty($hora) || empty($tipo_servico)) {
        $msg = "Preencha todos os campos obrigatórios.";
        $tipo = 'erro';
    } else {
        
        // Cadastra veículo
        $veiculoCtrl = new veiculoController();
        $id_veiculo = $veiculoCtrl->cadastrarVeiculo([
            'nome' => $veiculo_nome,
            'ano' => $veiculo_ano,
            'id_usuario' => $_SESSION['usuarios']->id
        ]);
        
        // Cadastra agendamento
        if ($id_veiculo) {
            $agendaCtrl = new agendamentoController();
            
            if ($agendaCtrl->cadastrarAgenda([
                'id_veiculo' => $id_veiculo,
                'data_agendamento' => $data_agendamento,
                'hora' => $hora,
                'tipo_servico' => $tipo_servico,
                'observacoes' => $observacoes ?? ''
            ])) {
                $msg = "Agendamento realizado com sucesso!";
                $tipo = 'sucesso';
            } else {
                $msg = "Erro ao agendar.";
                $tipo = 'erro';
            }
        } else {
            $msg = "Erro ao cadastrar veículo.";
            $tipo = 'erro';
        }
    }
}

// Lista agendamentos do usuário
$agendaCtrl = new agendamentoController();
$agendamentos = $agendaCtrl->listarPorUsuario($_SESSION['usuarios']->id);
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendar Serviço</title>
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
        <h1>Agendar Serviço</h1><br>

        <?php if (!empty($mensagem)): ?>
            <div style="padding:15px; margin-bottom:20px; border-radius:5px; background:<?= $tipo_mensagem === 'sucesso' ? '#d4edda' : '#f8d7da' ?>; color:<?= $tipo_mensagem === 'sucesso' ? '#155724' : '#721c24' ?>;">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="cadastrar" value="1">

            <label for="servico">Tipo de Serviço:</label><br>
            <select id="servico" name="tipo_servico" required>
                <option value="">Selecione o Serviço</option>
                <option value="Verificar nível de fluídos">Verificar nível de fluídos</option>
                <option value="Trocar óleo do motor e filtro">Trocar óleo do motor e filtro</option>
                <option value="Trocar fluído de freio">Trocar fluído de freio</option>
                <option value="Trocar fluído de arrefecimento">Trocar fluído de arrefecimento</option>
                <option value="Verificar pastilhas de freio">Verificar pastilhas de freio</option>
                <option value="Revisão completa de freios">Revisão completa de freios</option>
                <option value="Trocar discos e tambores de freio">Trocar discos e tambores de freio</option>
            </select><br><br>

            <label for="data_agendamento">Data:</label><br>
            <input type="date" id="data" name="data_agendamento" required><br><br>

            <label for="hora">Horário:</label><br>
            <select id="hora" name="hora" required>
                <option value="">Selecione o Horário</option>
                <option value="08:00">08:00</option>
                <option value="09:20">09:20</option>
                <option value="10:40">10:40</option>
                <option value="13:00">13:00</option>
                <option value="14:20">14:20</option>
                <option value="15:40">15:40</option>
            </select><br><br>

            <h2>Dados do Veículo</h2><br>

            <label for="veiculo_nome">Nome/Modelo:</label>
            <input type="text" id="veiculo_nome" name="veiculo_nome" placeholder="Ex: Gol G5" required><br><br>

            <label for="veiculo_ano">Ano:</label>
            <input type="number" id="veiculo_ano" name="veiculo_ano" placeholder="Ex: 2015" min="1900" max="2025" required><br><br>
           
            <label for="obs">Observações:</label><br>
            <textarea id="obs" name="observacoes" rows="4" placeholder="Observações..."></textarea><br><br>

            <button type="submit">Confirmar Agendamento</button>
        </form>
    </div>


<!-- SEÇÃO: MEUS AGENDAMENTOS -->
<div class="agendamentos">
    <h2>Meus Agendamentos</h2><br>

    <?php if (!empty($agendamentos)): ?>
        <!-- Contêiner que agrupa todos os agendamentos do usuário -->
        <div class="agendamentos-container">

            <?php foreach($agendamentos as $agendamento): ?>
                <!-- Card individual de cada agendamento -->
                <div class="agendamento-card">

                    <!-- Informações principais do agendamento -->
                    <div class="agendamento-info">
                        <h3><?= htmlspecialchars($agendamento->tipo_servico) ?></h3>
                        <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($agendamento->data_agendamento)) ?></p>
                        <p><strong>Horário:</strong> <?= htmlspecialchars($agendamento->hora) ?></p>
                        <p><strong>Veículo:</strong> <?= htmlspecialchars($agendamento->veiculo_nome) ?> (<?= htmlspecialchars($agendamento->veiculo_ano) ?>)</p>

                        <!-- Exibe observações somente se existirem -->
                        <?php if (!empty($agendamento->observacoes)): ?>
                            <p><strong>Obs:</strong> <?= htmlspecialchars($agendamento->observacoes) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Área dos botões de ação (Excluir, Editar, etc) -->
                    <div class="agendamento-acoes">
                        <!-- Botão ALTERAR leva a uma página de atualização -->
                        <a href="editar_agendamento.php?id=<?= $agendamento->id_agendamento ?>" class="btn-alterar">Alterar</a>

                        <a href="excluir_agendamento.php?id=<?= $agendamento->id_agendamento ?>" class="btn-excluir" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else: ?>
        <!-- Caso o usuário ainda não tenha nenhum agendamento -->
        <p>Você ainda não tem agendamentos.</p>
    <?php endif; ?>
</div>
<!-- FIM DA SEÇÃO MEUS AGENDAMENTOS -->

</div>

</body>
</html>