<?php
session_start(); 

include_once '../controllers/agendamentoController.php';
include_once '../controllers/usuariosController.php';
include_once '../controllers/veiculoController.php';
include_once '../banco/database.php';

$id = $_SESSION['id'] ?? null;
$id_veiculo = $_SESSION['id_veiculo'] ?? null;

$agendamentoController = new agendamentoController();
$usuariosController = new usuariosController();
$veiculoController = new veiculoController();

$agendamentos = $agendamentoController->index();


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['cadastrar'])) {
    // Garante que o usuário esteja logado
    if (!isset($_SESSION['usuarios'])) {
        header('Location: login.php');
        exit;
    }

    $id = $_SESSION['usuarios']['id'];

    $data_agendamento = $_POST['data_agendamento'];
    $hora = $_POST['hora'];
    $data_agendamento = $_POST['data_agendamento'];
    $hora = $_POST['hora'];

    $agendamentoController->cadastrarAgenda($id, $data_agendamento, $id_veiculo, $hora);

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

    <!-- Área de login -->
    <div class="user-area">
      <?php if (isset($_SESSION['usuarios'])): ?>
        <span style="color: #fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']['nome']); ?>!</span>
        <a style="color: red; href="href="../logout.php">Sair</a>
      <?php else: ?>
        <a href="login.php" class="login">Login</a>
        <a href="cadastro.php" class="cadastro">Cadastrar</a>
      <?php endif; ?>
    </div>
  </nav>
</div>

<div class="corpo">

    <!-- Formulário de Agendamento -->
    <div class="agendar-servi">
        <h1>Agendar Serviço</h1><br>

        <form action="" method="post">
            <input type="hidden" name="cadastrar" value="1">

            <div class="servicos">
                <label for="servico">Tipo de Serviço:</label><br>
                <select id="servico" name="tipo_servico" required>
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
                <label for="data_agendamento">Data:</label><br>
                <input type="date" id="data" name="data_agendamento" required>
            </div><br>

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


            <div class="veiculo">

            <h2>Área do Veiculo</h2><br>

            <label for="veiculo_nome">Nome:</label>
            <input type="text" id="veiculo_nome" name="veiculo_nome" required><br><br>

            <label for="veiculo_ano">Ano:</label>
            <input type="number" id="veiculo_ano" name="veiculo_ano" required><br><br>

            </div>
           
                
            <label for="obs">Observações:</label><br>
            <textarea id="obs" name="observacoes" rows="4" cols="100" placeholder="Observações..."></textarea><br><br>

            <!-- pega o id do usuario com esse input invisivel -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">

            <button type="submit">Confirmar Agendamento</button><br><br>


        </form>
    </div>

    <!-- Meus Agendamentos -->
    <div class="agendamentos">
        <h2>Meus Agendamentos</h2><br>

            <table>
        <tr>
            <td>Tipo do Serviço: </td>
            <td>Data:</td>
            <td>Horario:</td>
            <td>Veiculo:</td>
            <td>Ano:</td>
            <td>Observações:</td>
        </tr>

        <?php
        if (!empty($agendamentos)) : ?>
                <?php foreach($agendamentos as $logados) : ?>

                <tr>
                    <td><?= $logados->tipo_servico ?></td>
                    <td><?= $logados->data_agendamento ?></td>
                    <td><?= $logados->hora ?></td>
                    <td><?= $logados->veiculo ?></td>
                    <td><?= $logados->ano ?></td>
                    <td><?= $logados->observacoes ?></td>

                    <?php if($_SESSION['usuario']->id == $logados->id) : ?>

                        <td><a href="atualizarUsuario.php?alterar=<?= $logados->id_agendamento ?>">Editar</a></td>
                        <td><a href="listaUsuario.php?excluir=<?= $logados->id_agendamento ?>">Excluir</a></td>

                <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

        </div>
    </div>

</div>

</body>
</html>
