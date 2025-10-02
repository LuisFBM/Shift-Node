<?php
include '../banco/database.php';


function agendar(){


    function cadastrarAgendamentos() {

        $sql = ""
    }

    function listarAgendamentos() {

    }

    function excluirAgendamentos() {

    }


    function verificarHorario(){


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $servico = $_POST['servico'];
    $obs = $_POST['obs'];

    // Verificar se já existe agendamento nesse horário
    $check = $pdo->prepare("SELECT * FROM agendamentos WHERE data_agendada = ? AND hora_agendada = ? AND status != 'CANCELADO'");
    $check->execute([$data, $hora]);

    if ($check->rowCount() > 0) {
        echo "Horário já ocupado!";
    } else {
        $sql = "INSERT INTO agendamentos (id_cliente, data_agendada, hora_agendada, servico, observacao)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_cliente, $data, $hora, $servico, $obs]);

        echo "Agendamento realizado com sucesso!";
    }

    }   

    }

  
  
}
 
?>