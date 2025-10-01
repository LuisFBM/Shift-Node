<?php

include_once "../controllers/usuariosController.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $controller = new usuariosController();

    if(isset($_POST['cadastrar'])){
        $controller->cadastrarUsuarios($_POST['usuario']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
</head>
<body>

    <h1>cadastro</h1>

<form action="cadastro.php" method="POST">
    <div class="nome">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="email">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="senha">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>

     <div class="telefone">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="telefone" class="form-control" id="telefone" name="telefone" required>
    </div>
    
    <div class="cpf">
        <label for="cpf" class="form-label">CPF</label>
        <input type="cpf" class="form-control" id="cpf" name="cpf" required>
    </div>

    
    <button type="submit" class="btn btn-primary"><a href="index.php"></a>Registrar</button>

</form>
    
</body>
</html>


