<?php
session_start();
include_once "../banco/database.php";
include_once "../objetos/usuarios.php";
include_once "../controllers/usuariosController.php";

// Redireciona se já estiver logado
if (isset($_SESSION['usuarios'])) {
    $tipo = strtoupper($_SESSION['usuarios']->tipo); 
    
    if ($tipo === 'CLIENTE') {
        header('Location: index.php');
        exit();
    } elseif ($tipo === 'ADMIN') {
        // Admin pode redirecionar para dashboard se quiser
        header('Location: dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Shift Node</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>

<div class="hero">
    <nav>
        <a href="index.php" class="logo">
            <img src="../img/shiftnode.png" alt="logo">
        </a>
        <ul>
            <li><a href="agendamento.php">Agendamentos</a></li>
            <li><a href="#servicos">Serviços</a></li>
            <li><a href="#quem-somos">Quem Somos</a></li>
            <li><a href="contatos.php">Contatos</a></li>
        </ul>

        <!-- Área de login -->
        <div class="user-area">
            <?php if (isset($_SESSION['usuarios'])): ?>
                <span style="color: #fff;">Olá, <?= htmlspecialchars($_SESSION['usuarios']->nome); ?>!</span>
                <a style="color: red;" href="../logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php" class="login">Login</a>
                <a href="cadastro.php" class="cadastro">Cadastrar</a>
            <?php endif; ?>
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
    <section id="quem-somos">
    <div class="info">
        <h1 class="titulo">Quem Somos</h1>
        <h3>Especialistas em manutenções gerais, e cuidados com seu Automóvel</h3>
        <p>
            A 4 Nitros – É uma oficina especializada em manutenção preventiva e corretiva básica, com foco na
            segurança e desempenho dos veículos.
            A empresa se destaca pelo atendimento ágil, transparente e confiável, fornecendo orçamentos claros e
            orientações técnicas que permitem ao cliente entender a real condição do seu carro.
            Com uma equipe de profissionais experientes e dedicados, a 4 Nitros oferece serviços de alta
            qualidade, utilizando ferramentas modernas e peças de reposição confiáveis para garantir a
            satisfação e segurança dos seus clientes.
            Nossa missão é proporcionar tranquilidade e confiança aos motoristas, cuidando do seu veículo como
            se fosse nosso.
        </p>
    </div>

    <div class="img">
        <div class="topo">
            <img src="../img/atendimento.jpg" alt="atendimento">
            <img src="../img/confiavel.jpeg" alt="confiança">
        </div>

        <div class="topo" id="baixo">
            <img src="../img/ferramentas.png" alt="ferramentas">
            <img src="../img/manutencao.jpg" alt="manutencao">
        </div>
    </div>
    </section>


    <!-- Serviços -->
    <section id="servicos" style="background: #f8f9fa;">
        <div class="container">
            <h2 class="text-center mb-5" style="color:#061f40; font-size: 2.5rem; font-weight: bold;">Nossos Serviços</h2>
            <img src="../img/engrenagem.png" alt="imagem dos serviços"><br><br>

            <div class="row justify-content-center g-4">
                <!-- Serviço 1 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../img/fluido_veiculo.png" class="card-img-top" alt="Verificar nível de fluídos">
                        <div class="card-body">
                            <h5 class="card-title">Verificar nível de fluídos</h5>
                            <p class="card-text">Checagem completa de todos os fluidos do veículo para garantir funcionamento seguro.</p>
                        </div>
                    </div>
                </div>

                <!-- Serviço 2 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../img/óleo.jpg" class="card-img-top" alt="Trocar óleo do motor e filtro">
                        <div class="card-body">
                            <h5 class="card-title">Trocar óleo do motor e filtro</h5>
                            <p class="card-text">Manutenção rápida para manter o motor protegido e lubrificado.</p>
                        </div>
                    </div>
                </div>

                <!-- Serviço 3 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../img/fluido_freio.png" class="card-img-top" alt="Trocar fluído de freio">
                        <div class="card-body">
                            <h5 class="card-title">Trocar fluído de freio</h5>
                            <p class="card-text">Substituição do fluído de freio para garantir segurança e eficiência na frenagem.</p>
                        </div>
                    </div>
                </div>

                <!-- Serviço 4 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../img/arrefecimento.png" class="card-img-top" alt="Trocar fluído de arrefecimento">
                        <div class="card-body">
                            <h5 class="card-title">Trocar fluído de arrefecimento</h5>
                            <p class="card-text">Manutenção do sistema de refrigeração para evitar superaquecimento do motor.</p>
                        </div>
                    </div>
                </div>

                <!-- Serviço 5 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../img/completa.png" class="card-img-top" alt="Revisão completa de freios">
                        <div class="card-body">
                            <h5 class="card-title">Revisão completa de freios</h5>
                            <p class="card-text">Verificação detalhada de pastilhas, discos, tambores e sistema hidráulico de freios.</p>
                        </div>
                    </div>
                </div>

                <!-- Serviço 6 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../img/pastilha.jpg" class="card-img-top" alt="Verificar pastilhas de freio">
                        <div class="card-body">
                            <h5 class="card-title">Verificar pastilhas de freio</h5>
                            <p class="card-text">Checagem do desgaste das pastilhas para manter a frenagem eficiente e segura.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="py-4" style="background:#061f40; color:#fff; text-align:center;">
        <p>&copy; 2025 4 Nitros. Todos os direitos reservados.</p>
        <p>
            <a href="#" style="color:#caf0f8; margin:0 10px;">Facebook</a> |
            <a href="#" style="color:#caf0f8; margin:0 10px;">Instagram</a> |
            <a href="#" style="color:#caf0f8; margin:0 10px;">LinkedIn</a>
        </p>
    </footer>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>