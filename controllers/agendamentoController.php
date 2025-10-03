<?php
include '../banco/database.php';


function agendar(){


    function cadastrarAgendamentos($dados) {

        $this->agendamentos->numero_agendamento = $dados['numero_agendamento'];
        $this->agendamentos->id_cliente = $dados['id_cliente'];
        $this->agendamentos->id_veiculo = $dados['id_veiculo'];
        $this->agendamentos->id_orcamento = $dados['id_orcamento'];
        $this->agendamentos->id_atendente = $dados['id_atendente'];
        $this->agendamentos->id_mecanico = $dados['id_mecanico'];


        if($this->usuarios->cadastrarAgendamentos($dados)){
            header("Location: ../paginas/agendar.php");
            exit();
        }
        return false;

    }

    function listarAgendamentos() {
        return $this->agendamentos->listarAgendamentos();
    }

    function excluirAgendamentos() {
        $this->usuarios->id_agendamento = $id_agendamento;

        if($this->usuarios->excluir()){
            header("Location: ../paginas/agendamento.php");
            exit();
        }
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