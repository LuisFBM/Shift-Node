<?php
include_once "configs/database.php";
include_once "objetos/usuarios.php";
include "controllers/usuariosController.php";

include_once "objetos/clientes.php";


include_once "session.php";

$controller = new usuariosController();
$usuarios = $controller->index();
global $alunos;
$u = null;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Shift Node</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/index.css">

</head>
<body>

        <?php
            include 'topo.php';
        ?>

        <div class="hero">
          <nav>
              <a href="index.php" class="logo"><img src="../img/shiftnode.png" alt="logo"></a>
          <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="Serviços.php">Serviços</a></li>
            <li><a href="QuemSomos.php">Quem Somos</a></li>
            <li><a href="Contatos.php">Contatos</a></li>
          </ul>

          <div class="cadastro">

            <a href="cadastroFunc.php">Cadastre-se</a>
            <a href="login.php">Login</a>

          </div>
          
          </nav>
          
        </div>

<main>

  <!-- Fundo com imagem -->
  <section class="fundo">
    <div class="fundo-content">
      <h2>Por que escolher nosso serviço?</h2>
      <ul>
        <li>Alto Padrão</li>
        <li>Equipe Qualificada</li>
        <li>Diagnóstico Preciso</li>
        <li>Ferramental Específico</li>
        <li>Performance e Segurança</li>
      </ul>
    </div>
  </section>

  <!-- Quem Somos -->
  <section class="quem-somos">
    <h3>Especialistas em manutenções gerais, e cuidados com seu Automóvel</h3>

    <br>

    <h1 class="titulo">Quem Somos</h1>

    <br>

    <p class="info">
      A 4 Nitros – É uma oficina especializada em manutenção preventiva e corretiva básica, com foco na segurança e desempenho dos veículos.
      A empresa se destaca pelo atendimento ágil, transparente e confiável, fornecendo orçamentos claros e orientações técnicas que permitem ao cliente entender a real condição do seu carro.
    </p>

    <div class="topo">

        <img src="../img/atendimento.jpg" alt="atendimento">
        <img src="../img/confiavel.jpeg" alt="confiança">

    </div>

    <div class="topo" id="baixo">

        <img src="../img/ferramentas.png" alt="ferramentas">
        <img src="../img/manutencao.jpg" alt="manutencao">

    </div>

  </section>


</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

