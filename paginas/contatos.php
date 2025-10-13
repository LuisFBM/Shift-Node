<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatos - 4 Nitros</title>
  <link rel="stylesheet" href="../style/contatos.css">


</head>
<body>

<div class="hero">
          <nav>
              <a href="index.php" class="logo"><img src="../img/shiftnode.png" alt="logo"></a>
          <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="#servicos">Serviços</a></li>
            <li><a href="#quem-somos">Quem Somos</a></li>
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

  <section class="contatos">
    <h1>Entre em Contato</h1>
    <p>Preencha o formulário ou use as informações abaixo para falar conosco.</p>

    <div class="contatos-container">
      <!-- Formulário -->
      <form action="#" method="post" class="contato-form">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="5" required></textarea>

        <button type="submit">Enviar</button>
      </form>

      <!-- Informações de Contato -->
      <div class="info-contato">
        <h2>Informações</h2>
        <p><i class="fa fa-phone"></i> Telefone: (19) 99879-9929</p>
        <p><i class="fa fa-envelope"></i> Email: contato@4nitros.com.br</p>
        <p><i class="fa fa-map-marker-alt"></i> Endereço: Bairo Floridiana, número 31 - Rio Claro/SP</p>
      </div>
    </div>
  </section>

</body>
</html>
