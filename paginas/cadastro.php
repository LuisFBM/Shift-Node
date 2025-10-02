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
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="text" name="cpf" placeholder="CPF" required>
        <select name="tipo" required>
            <option value="CLIENTE">Cliente</option>
            <option value="ATENDENTE">Atendente</option>
            <option value="MECANICO">Mecânico</option>
            <option value="ADMIN">Admin</option>
        </select>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>