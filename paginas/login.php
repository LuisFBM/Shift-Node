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
    <link rel="stylesheet" href="../style/login.css">
    <title></title>
</head>

<body>

    <form class="form">
       <p class="form-title">Sign in to your account</p>
        <div class="input-container">
          <input type="email" placeholder="Enter email">
          <span>
          </span>
      </div>
      <div class="input-container">
          <input type="password" placeholder="Enter password">
        </div>
         <button type="submit" class="submit">
        Sign in
      </button>

      <p class="signup-link">
        No account?
        <a href="">Sign up</a>
      </p>
   </form>
   
</body>

</html>