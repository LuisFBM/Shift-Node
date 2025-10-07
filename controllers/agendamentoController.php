<?php

include_once '../banco/database.php';
include_once '../objetos/agendamentos.php';

Class AgendamentoController {

    private $bd;
    private $agendamentos;
    private $usuarios;

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->agendamentos = new agendamento($this->bd);
    }

    function cadastrarAgendamentos($dados) {
        $this->agendamentos->numero_agendamento = $dados['numero_agendamento'];
        $this->agendamentos->id_cliente = $dados['id_cliente'];
        $this->agendamentos->id_veiculo = $dados['id_veiculo'];
        $this->agendamentos->id_orcamento = $dados['id_orcamento'];


        if($this->usuarios->cadastrar()){
            header("Location: ../paginas/agendamento.php");
            exit();
        }

        return false;

    }

    function listarAgendamentos() {
        return $this->agendamentos->lerTodos();
    }

    function excluirAgendamentos($id_agendamento) {
        $this->agendamentos->id_agendamento = $id_agendamento;

        if($this->usuarios->excluir()){
            header("Location: ../paginas/agendamento.php");
            exit();
        }
    }


}

?>