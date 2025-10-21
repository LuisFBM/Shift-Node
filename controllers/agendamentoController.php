<?php
include_once '../banco/database.php';
include_once '../objetos/agendar.php';


class agendamentoController {
    private $bd;
    private $agendamentos;

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->agendamentos = new agendar($this->bd);
    }

    public function index() {
        return $this->agendamentos->ListarAgendamentos();
    }

    public function listarPorUsuario($id_usuario) {
        return $this->agendamentos->lerPorUsuario($id_usuario);
    }

    public function buscarAgendamento($id_agendamento) {
        return $this->agendamentos->buscarPorId($id_agendamento);
    }

    // Pega o ID da sessão automaticamente 
    public function cadastrarAgenda($dados) {
        $this->agendamentos->id_usuario = $_SESSION['usuarios']->id; //  Usa o objeto da sessão
        $this->agendamentos->id_veiculo = $dados['id_veiculo'];
        $this->agendamentos->data_agendamento = $dados['data_agendamento'];
        $this->agendamentos->hora = $dados['hora'];
        $this->agendamentos->tipo_servico = $dados['tipo_servico'];
        $this->agendamentos->observacoes = $dados['observacoes'];

        if ($this->agendamentos->cadastrarAgendamento()) {
            header("Location: ../paginas/agendamento.php?sucesso=1");
            exit();
        }
        return false;
    }

     public function atualizarAgendamento($dados) {
        $this->agendamentos->id_agendamento = $dados['id_agendamento'];
        $this->agendamentos->data_agendamento = $dados['data_agendamento'];
        $this->agendamentos->hora = $dados['hora'];
        $this->agendamentos->tipo_servico = $dados['tipo_servico'];
        $this->agendamentos->observacoes = $dados['observacoes'];

        if ($this->agendamentos->atualizar()) {
            return true;
        }
        return false;
    }

    public function excluirAgendamento($id_agendamento) {
        $this->agendamentos->id_agendamento = $id_agendamento;
        if ($this->agendamentos->excluir()) {
            header("Location: ../paginas/agendamento.php");
        }
    }
}
?>