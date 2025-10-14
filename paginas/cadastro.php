<?php

include_once "../controllers/usuariosController.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioController = new usuariosController();

    if ($usuarioController->cadastrarUsuarios($_POST)) {

        echo "Funcionario cadastrado com sucesso!";

    } else {

        echo "Erro ao cadastrar usuário.";
        
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../style/cadastro.css">
</head>
<body

    <div class="form-container">

      <form class="form" action="cadastro.php" method="POST">
      <h1 class="form-title">Cadastro de Usuário</h1>

      <div class="input-container">
          <input type="text" name="nome" placeholder="Nome Completo" required>
      </div>

      <div class="input-container">
          <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-container">
          <input type="password" name="senha" placeholder="Senha" required>
      </div>

      <div class="input-container">
          <input type="text" name="telefone" placeholder="Telefone" required>
      </div>

      <div class="input-container">
          <input type="text" name="cpf" placeholder="CPF" required>
      </div>

      <div class="input-container">
          <select name="tipo" required style="width:100%;padding:0.9rem;border:1px solid #ccc;border-radius:0.6rem;font-size:0.95rem;">
              <option value="">Selecione o tipo de usuário</option>
              <option value="cliente">Cliente</option>
              <option value="atendente">Atendente</option>
              <option value="mecanico">Mecânico</option>
              <option value="admin">Administrador</option>
          </select>
      </div><br>

      <button type="submit" class="submit">Registrar</button>

      <p class="signup-link">Já possui conta? <a href="login.php">Entrar</a></p>

    </form>


    </div>

</body>
</html>