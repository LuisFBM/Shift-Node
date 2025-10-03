<?php

include_once "../controllers/usuariosController.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioController = new usuariosController();

    if ($usuarioController->cadastrarUsuarios($_POST)) {

        echo "Usuário cadastrado com sucesso!";

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
</head>
<body>

    <h1>cadastro-se</h1>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastre-se</h1>
    <form action="cadastro.php" method="POST">

         <label for="nome">Nome:</label><br><br>
        <input type="text" name="nome" placeholder="Nome Completo" required><br><br>

         <label for="email">Email:</label><br><br>
        <input type="email" name="email" placeholder="Email" required>

        <br><br> <label for="senha">Senha:</label><br><br>
        <input type="password" name="senha" placeholder="Senha" required>

        <br><br> <label for="telefone">Telefone:</label><br><br>
        <input type="text" name="telefone" placeholder="Telefone" required>

        <br><br><label for="cpf">CPF:</label><br><br>
        <input type="text" name="cpf" placeholder="CPF" required>

        <br><br><label for="tipo">Tipos de usuários:</label>
        <select name="tipo" required>
            <option value="CLIENTE">Cliente</option>
            <option value="ATENDENTE">Atendente</option>
            <option value="MECANICO">Mecânico</option>
            <option value="ADMIN">Admin</option>
        </select>

        <br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>