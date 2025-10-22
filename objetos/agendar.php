<?php
class agendar {
    public $id_agendamento;
    public $id_usuario;
    public $id_veiculo;
    public $hora;
    public $data_agendamento;
    public $tipo_servico;
    public $observacoes;
    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function listarAgendamentos() {
    $sql = "SELECT 
            a.id_agendamento,
            u.nome AS nome_usuario,
            v.nome AS nome_veiculo,
            a.data_agendamento,
            a.hora,
            a.tipo_servico,
            a.observacoes,
            a.data_criacao,
            a.status
        FROM agendamentos a
        INNER JOIN usuarios u ON a.id_usuario = u.id
        INNER JOIN veiculos v ON a.id_veiculo = v.id_veiculo
        ORDER BY a.data_agendamento DESC";

    $resultado = $this->bd->prepare($sql);
    $resultado->execute();
    return $resultado->fetchAll(PDO::FETCH_OBJ);

    }


    public function lerPorUsuario($id_usuario) {
        $sql = 'SELECT a.*, v.nome as veiculo_nome, v.ano as veiculo_ano 
                FROM agendamentos a 
                INNER JOIN veiculos v ON a.id_veiculo = v.id_veiculo 
                WHERE a.id_usuario = :id_usuario 
                ORDER BY a.data_agendamento DESC';
        
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Busca um agendamento específico
    public function buscarPorId($id_agendamento) {
        $sql = 'SELECT a.*, v.nome as veiculo_nome, v.ano as veiculo_ano 
                FROM agendamentos a 
                INNER JOIN veiculos v ON a.id_veiculo = v.id_veiculo 
                WHERE a.id_agendamento = :id_agendamento';
        
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_agendamento', $id_agendamento, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrarAgendamento() {
        $sql = "INSERT INTO agendamentos (id_usuario, id_veiculo, data_agendamento, hora, tipo_servico, observacoes)
                VALUES (:id_usuario, :id_veiculo, :data_agendamento, :hora, :tipo_servico, :observacoes)";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam(':data_agendamento', $this->data_agendamento);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':tipo_servico', $this->tipo_servico);
        $stmt->bindParam(':observacoes', $this->observacoes);

        return $stmt->execute();
    }

    
    public function atualizar() {
        $sql = "UPDATE agendamentos SET data_agendamento = :data_agendamento, hora = :hora, tipo_servico = :tipo_servico, observacoes = :observacoes 
                WHERE id_agendamento = :id_agendamento";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':data_agendamento', $this->data_agendamento);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':tipo_servico', $this->tipo_servico);
        $stmt->bindParam(':observacoes', $this->observacoes);
        $stmt->bindParam(':id_agendamento', $this->id_agendamento, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluir() {
        $sql = 'DELETE FROM agendamentos WHERE id_agendamento = :id_agendamento';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_agendamento', $this->id_agendamento, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function cadastrarHorario() {
        $sql = "INSERT INTO horarios (data, hora) VALUES (:data, :hora)";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':hora', $this->hora);

        return $stmt->execute();
    }

    public function atualizarStatus($id, $status) {
    $sql = "UPDATE agendamentos 
            SET status = :status 
            WHERE id_agendamento = :id";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();

    }

}
?>