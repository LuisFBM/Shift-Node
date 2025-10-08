<?php
include_once '../controllers/agendamentoController.php';
include_once '../controllers/usuariosController.php';
include_once '../banco/database.php';

$agendamentoController = new agendamentoController();
$usuariosController = new usuariosController();

$agendamentos = $agendamentoController->index(); 


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $controller = new agendamentoController();

    if (isset($_POST['cadastrar'])) {
        $controller->cadastrarAgenda($_POST); 
    }
}
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

<h1>Agendar</h1>

<div class="corpo">

    <!-- Formulário de Agendamento -->
    <div class="agendar-serv">
        <h2>Agendar Serviço</h2><br>

        <form action="" method="post">
            <input type="hidden" name="cadastrar" value="1">

            <div class="servicos">
                <label for="servico">Tipo de Serviço:</label><br>
                <select id="servico" name="servico" required>
                    <option value="">Selecione o Serviço</option>
                    <option value="nivel_fluido">Verificar nível de fluídos</option>
                    <option value="troca_oleo">Trocar óleo do motor e filtro</option>
                    <option value="fluido_freio">Trocar fluído de freio</option>
                    <option value="fluido_arrefecimento">Trocar fluído de arrefecimento</option>
                    <option value="revisao_freios">Revisão completa de freios</option>
                    <option value="pastilhas_freio">Verificar pastilhas de freio</option>
                    <option value="discos_tambores">Trocar discos e tambores de freio</option>
                </select><br><br>
            </div>

            <div class="data">
                <label for="data">Data:</label><br>
                <input type="date" id="data" name="data" required><br><br>
            </div>

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

            <label for="veiculo">Veículo:</label><br>
            <input type="text" id="veiculo" name="id_veiculo" placeholder="Nome do Veículo" required><br><br>

            <label for="obs">Observações:</label><br>
            <textarea id="obs" name="obs" rows="4" cols="100" placeholder="Observações..."></textarea><br><br>

            <button type="submit">Confirmar Agendamento</button>
        </form>
    </div>

    <!-- Meus Agendamentos -->
    <div class="agendamentos">
        <h2>Meus Agendamentos</h2><br>

        <div class="fundo-agend">
            <?php if (!empty($agendamentos)) : ?>
                <ul>
                    <?php foreach ($agendamentos as $item): ?>
                        <li>
                            <strong>Nº:</strong> <?= htmlspecialchars($item['numero_agendamento']) ?><br>
                            <strong>Data:</strong> <?= htmlspecialchars($item['data'] ?? '') ?><br>
                            <strong>Hora:</strong> <?= htmlspecialchars($item['hora'] ?? '') ?><br>
                            <strong>Serviço:</strong> <?= htmlspecialchars($item['servico'] ?? '') ?><br>
                            <strong>Veículo:</strong> <?= htmlspecialchars($item['id_veiculo'] ?? '') ?><br>
                            <a href="../controllers/agendamentoController.php?excluir=<?= $item['id_agendamento'] ?>">Excluir</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum agendamento encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>
