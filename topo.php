<?php if(isset($_SESSION['usuarios'])) : ?>
    <span>Usuário: <?= $_SESSION['usuario']->nome ?></span>
    <a href="logout.php">Sair</a>
    <br>
    <?php endif; ?>
