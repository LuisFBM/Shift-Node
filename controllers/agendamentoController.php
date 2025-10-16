<?php
include_once '../banco/database.php';
include_once '../objetos/agendar.php';
include_once '../objetos/usuarios.php';
include_once '../objetos/veiculo.php';


class agendamentoController {

    private $bd;
    private $agendamentos;

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->agendamentos = new agendar($this->bd);
    }

    public function index() {
        return $this->agendamentos->lerTodos();
    }

    public function cadastrarAgenda($dados) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Garante que o usuário esteja logado
        if (!isset($_SESSION['usuarios'])) {
            header("Location: ../paginas/login.php");
            exit();
        }

        // Atribui os dados do agendamento
        $this->agendamentos->id_cliente= $_SESSION['usuarios']['id'];
        $this->agendamentos->id_veiculo= $dados['id_veiculo'];
        $this->agendamentos->data_agendamento= $dados['data_agendamento'];
        $this->agendamentos->hora= $dados['hora'];
        $this->agendamentos->tipo_servico= $dados['tipo_servico'];
        $this->agendamentos->observacoes= $dados['observacoes'];

        if ($this->agendamentos->cadastrarAgendamento()) {
            header("Location: ../paginas/agendamento.php?sucesso=1");
            exit();
        } else {
            header("Location: ../paginas/agendamento.php?erro=1");
            exit();
        }
    }

    public function atualizar($dados) {

        $this->agendamentos->id_veiculo = $dados['id_veiculo'];
        $this->agendamentos->data_agendamento = $dados['data_agendamento'];
        $this->agendamentos->hora = $dados['hora'];
        $this->agendamentos->tipo_servico = $dados['tipo_servico'];
        $this->agendamentos->observacoes = $dados['observacoes'];


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