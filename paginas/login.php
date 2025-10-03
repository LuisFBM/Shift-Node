<?php

include_once "../controllers/usuariosController.php";
session_start();

if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_POST['email']) && isset($_POST['senha'])) {
        $controller = new usuariosController();
        $controller->login($_POST['email'], $_POST['senha']);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

    <h1>Login</h1>

    <!DOCTYPE html>
    <html lang="pr-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tela de login</title>
    </head>
    <body>

    <form method="POST" action="login.php">
        <label for="Nome">E-mail de login</label>
        <input type="text" name="email" id="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>

        <button>Entrar</button>
    </form>

    <?php
    if(isset($_SESSION['erro'])) {
        echo $_SESSION['erro'];
    } elseif(isset($_SESSION['erros'])) {
        echo $_SESSION['erros'];
    }
    ?>

    <p>Clique aqui para cadastrar <a href="cadastroUsuario.php">Cadastrar</a></p>

    </body>
    </html>
    
</body>
</html>