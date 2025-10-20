<?php
session_start();
include_once '../controllers/agendamentoController.php';

// Verifica se está logado
if (!isset($_SESSION['usuarios'])) {
    header('Location: login.php');
    exit;
}

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id_agendamento = $_GET['id'];
    
    $controller = new agendamentoController();
    
    // Busca o agendamento para verificar se pertence ao usuário
    $agendamento = $controller->buscarAgendamento($id_agendamento);
    
    if ($agendamento && $agendamento->id_usuario == $_SESSION['usuarios']->id) {
        // Exclui o agendamento
        if ($controller->excluirAgendamento($id_agendamento)) {
            header('Location: agendamento.php?msg=excluido');
        } else {
            header('Location: agendamento.php?erro=excluir');
        }
    } else {
        header('Location: agendamento.php?erro=permissao');
    }
} else {
    header('Location: agendamento.php');
}
exit;
?>