<?php if(isset($_SESSION['usuario'])) : ?>
    <span>Usuário: <?= $_SESSION['usuario']->nome ?></span>
    <a href="logout.php">Sair</a>
    <br>
    <?php endif; ?>

       <span>
    Olá, <?= $_SESSION['cliente']->nomeCli ?>
    <a href="logout.php">Sair</a>
           