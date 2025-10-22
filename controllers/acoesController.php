<?php
include_once "agendamentoController.php";

if (isset($_POST['acao'], $_POST['id'])) {
    $controller = new agendamentoController();
    $id = intval($_POST['id']);

    if ($_POST['acao'] === 'confirmar') {
        $controller->confirmar($id);
    } elseif ($_POST['acao'] === 'cancelar') {
        $controller->cancelar($id);
    }

    header('Location: ../paginas/lista_agendamentos.php');
    exit();
}
?>
