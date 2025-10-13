<?php
include_once '../controllers/usuariosController.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['usuario']['email']) && isset($_POST['usuario']['senha'])){

        $controller = new usuarioController();
        $resultado = $controller->login($_POST['usuario']['email'], $_POST['usuario']['senha']);
        
        if($resultado['sucesso']){
            switch($resultado['tipo']){
                case 'ADMIN':
                    header('Location: index.php');
                    break;
                case 'CLIENTE':
                    header('Location: index.php');
                    break;
              
            }
            exit();
        } else {
            $erro = $resultado['mensagem'];
        }
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
    <p>Clique aqui para cadastrar <a href="cadastro.php">Cadastrar</a></p>

    </body>
    </html>
    
</body>
</html>