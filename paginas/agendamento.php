<?php
session_start(); 

include_once '../controllers/agendamentoController.php';
include_once '../controllers/usuariosController.php';
include_once '../controllers/veiculoController.php';
include_once '../banco/database.php';

$id_cliente = $_SESSION['id_cliente'] ?? null;

$agendamentoController = new agendamentoController();
$usuarioController = new usuariosController();
$veiculoController = new veiculoController();

$agendamentos = $agendamentoController->index(); 


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['cadastrar'])) {
    // Verifica se o usuário é cliente
    
    if ($id_cliente) {

        // Dados do veículo vindos do formulário
        $veiculo_nome = $_POST['veiculo_nome'];
        $veiculo_ano = $_POST['veiculo_ano'];

        // Cadastra o veículo e obtém o ID
        $id_veiculo = $veiculoController->cadastrarVeiculo([
            'nome' => $veiculo_nome,
            'ano' => $veiculo_ano,
            'id_cliente' => $id_cliente
        ]);

        // Dados do agendamento vindos do formulário
        $data_agendamento = $_POST['data_agendamento'];
        $hora = $_POST['hora'];
        $tipo_servico = $_POST['tipo_servico'];

        // Cadastra o agendamento
        $agendamentoController->cadastrarAgenda([
            'id_cliente' => $id_cliente,
            'id_veiculo' => $id_veiculo,
            'data_agendamento' => $data_agendamento,
            'hora' => $hora,
            'tipo_servico' => $tipo_servico
        ]);
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

            <div class="hero">
          <nav>
              <a href="index.php" class="logo"><img src="../img/shiftnode.png" alt="logo"></a>
          <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="index.php#servicos">Serviços</a></li>
            <li><a href="index.php#quem-somos">Quem Somos</a></li>
            <li><a href="contatos.php">Contatos</a></li>
          </ul><br>

          <div class="user">
            <?php if (isset($_SESSION['usuarios'])): ?>
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION['usuarios']->nome); ?> <i class="fa fa-caret-down"></i></a>
                        <ul>
                            <?php if ($_SESSION['usuarios']->tipo === 'ADMIN'): ?>
                                <li><a href="dashboard.php">Dashboard</a></li>
                            <?php endif; ?>
                            <li><a href="perfil.php">Perfil</a></li>
                            <li><a href="logout.php">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            <?php else: ?>
                <a class="login" href="login.php" class="btn btn-primary">Login</a>
                <a class="cadastro" href="cadastro.php">Cadastre-se</a>
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

            <button type="submit">Confirmar Agendamento</button><br><br>

        </form>
    </div>

    <!-- Meus Agendamentos -->
    <div class="agendamentos">
        <h2>Meus Agendamentos</h2><br>

        <div class="fundo-agend">


           
        </div>
    </div>

</div>

</body>
</html>
