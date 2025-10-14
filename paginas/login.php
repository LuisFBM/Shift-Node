<?php
session_start();
include_once '../controllers/usuariosController.php';
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['usuarios']['email'] ?? '');
    $senha = trim($_POST['usuarios']['senha'] ?? '');

    if (!empty($email) && !empty($senha)) {
        $controller = new usuariosController();
        $controller->login($email, $senha); 
    } else {
        $erro = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <title></title>
</head>

<body>

     <form class="form" method="POST" action="">
        <p class="form-title">Entrar na sua conta</p>

        <?php if (isset($erro)) : ?>
            <div class="erro-msg"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <div class="input-container">
            <input type="email" name="usuarios[email]" placeholder="Digite seu e-mail" required>
        </div>

        <div class="input-container">
            <input type="password" name="usuarios[senha]" placeholder="Digite sua senha" required>
        </div>

        <button type="submit" class="submit">Entrar</button>

        <p class="signup-link">
            Não tem conta?
            <a href="cadastro.php">Cadastre-se</a>
        </p>
    </form>
   
</body>

</html>