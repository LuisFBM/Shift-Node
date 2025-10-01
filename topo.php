<?php
$caminho_img = "uploads/img_68b5f776d3b507.05533121.png";

global $caminho_img;

?>

<?php if(isset($_SESSION['usuario'])) : ?>
    <img src="<?= $caminho_img ?>" style="height: 50px;" alt="Ícone de perfil">
    <span>Usuário: <?= $_SESSION['usuario']->nome ?></span>
    <a href="logout.php">Sair</a>
    <br>
    <?php endif; ?>

    <h1><center>Crud PHP</center></h1>
    <a href="index.php">Inicio</a>