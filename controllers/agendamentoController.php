<?php
include_once '../banco/database.php';
include_once '../objetos/agendamentos.php';

session_start();

class agendamentoController {

    private $bd;
    private $agendamentos;

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->agendamentos = new agendamentos($this->bd);
    }

    public function index() {
        return $this->agendamentos->lerTodos();
    }

    public function cadastrarAgenda($dados) {

        $this->agendamentos->id_agendamento = $dados['id_agendamento'];
        $this->agendamentos->id_cliente = $dados['usuario'];
        $this->agendamentos->id_veiculo = $dados['id_veiculo'];


        if ($this->agendamentos->cadastrarAgendamento()) {
            header("Location: ../paginas/agendamento.php");
            exit();
        }
        return false;
    }

    public function atualizar($dados) {

        $this->agendamentos->id_agendamento = $dados['id_agendamento'];
        $this->agendamentos->id_cliente = $dados['id_cliente'];
        $this->agendamentos->id_veiculo = $dados['id_veiculo'];


        if ($this->agendamentos->atualizar()) {
            header("Location: ../paginas/agendamento.php");
            exit();
        }
        return false;
    }

    public function excluirAgendamento($idAgendamento) {

        $this->agendamentos->id_agendamento = $idAgendamento;

        if ($this->agendamentos->excluir()) {
            header("Location: ../paginas/agendamento.php");
        }
    }
}


?>