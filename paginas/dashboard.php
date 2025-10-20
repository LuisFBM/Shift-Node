
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Inicial</title>
<link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>

<!-- Navbar -->
<div class="hero">
  <nav>
    <a href="dashboard.php" class="logo"><img src="../img/shiftnode.png" alt="logo"></a>
    <ul>
  
      <li><a href="listAgenda.php">Agendamentos</a></li>
      <li><a href="cadServicos.php">Serviços</a></li>
      <li><a href="cadHorarios.php">Horários</a></li>
    </ul>
    <div class="user">
      <a href="perfil.php"><i class="fa fa-user-circle fa-2x"></i></a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i></a>
      <a class="login" href="login.php" class="btn btn-primary">Login</a>
      <a class="cadastro" href="cadastro.php">Cadastre-se</a>
    </div>
  </nav>
</div>


<!-- Fundo com imagem -->
 <section class="fundo">
  <div class="fundo-content">
    <h2>Benefícios do Dashboard</h2><br><br>
    <ul>
      <li>Informações Centralizadas</li>
      <li>Monitoramento em Tempo Real</li>
      <li>Gestão Simplificada de Serviços</li>
      <li>Acesso Fácil a Agendamentos</li>
      <li>Decisões Mais Rápidas e Precisas</li>
    </ul>
  </div>
</section>

<!-- Conteúdo -->
<main class="main-content">
  <h1>Bem-vindo ao Dashboard</h1>

  <!-- Cards Resumo -->
  <div class="cards-dashboard">
    <a href="listar_agendamentos.php" class="card card-blue">
      <i class="fa fa-calendar-check fa-2x"></i>
      <h3>Lista de Agendamentos</h3>
      <p><?php// echo $total_agendamentos; ?></p>
    </a>

    <a href="cadastrar_servicos.php" class="card card-purple">
      <i class="fa fa-cogs fa-2x"></i>
      <h3>Cadastrar Serviços</h3>
      <p><?php// echo $total_servicos; ?></p>
    </a>

    <a href="cadastrar_horario.php" class="card card-orange">
      <i class="fa fa-clock fa-2x"></i>
      <h3>Cadastrar Horários</h3>
      <p><?php// echo $total_horarios; ?></p>
    </a>

    <div class="card card-green">
      <i class="fa fa-users fa-2x"></i>
      <h3>Clientes</h3>
      <p><?php// echo $total_clientes; ?></p>
    </div>
  </div>

  <!-- Últimos Agendamentos -->
  <section class="section-card">
    <h2>Últimos Agendamentos</h2>
    <table>
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Veículo</th>
          <th>Data</th>
          <th>Hora</th>
          <th>Serviço</th>
        </tr>
      </thead>
      <tbody>
        <?php // foreach ($ultimos_agendamentos as $a): ?>
        <tr>
          <td><?php// echo $a['cliente']; ?></td>
          <td><?php// echo $a['veiculo']; ?></td>
          <td><?php// echo $a['data']; ?></td>
          <td><?php// echo $a['hora']; ?></td>
          <td><?php// echo $a['servico']; ?></td>
        </tr>
        <?php // endforeach; ?>
      </tbody>
    </table>
  </section>
</main>

</body>
</html>