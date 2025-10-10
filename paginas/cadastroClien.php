<?php

include_once "../controllers/clienteController.php.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteController = new clienteController();

    if ($clienteController->cadastrarCliente($_POST)) {

        echo "Cliente cadastrado com sucesso!";

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
    <h1>Cadastre-se Aqui !!</h1>
    <form action="cadastroFunc.php" method="POST">

         <label for="nome">Nome:</label>
        <input type="text" name="nome" placeholder="Nome Completo" required><br><br>

         <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email" required>

        <br><br> <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Senha" required>

        <br><br> <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" placeholder="Telefone" required>

        <br><br><label for="cpf">CPF:</label>
        <input type="text" name="cpf" placeholder="CPF" required>


        <button type="submit">Registrar</button>
    </form>
</body>
</html>