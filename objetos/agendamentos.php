<?php

Class agendamento {
    public $id_agendamento;
    public $hora;
    public $id_cliente;
    public $id_veiculo;
    public $tipo_manutencao;
    public $observacoes;
    public $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = "SELECT * FROM agendamentos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);
    }

    public function lerAgendamento($id_agendamento){
        $idAgendamento = "%" . $idAgendamento . "%";
        $sql = "SELECT * FROM agendamentos WHERE id_agendamento LIKE :id_agendamento";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':id_agendamento', $idAgendamento);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);
    }

    public function cadastrarAgendamento(){
        $sql = "INSERT INTO agendamentos (data_agendamento, hora, id_cliente, id_veiculo, tipo_manutencao, observacoes) 
                VALUES (:data_agendamento, :hora, :id_cliente, :id_veiculo, :tipo_manutencao, :observacoes)";

        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':data_agendamento', $this->data_agendamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_manutencao', $this->tipo_manutencao, PDO::PARAM_STR);
        $stmt->bindParam(':observacoes', $this->observacoes, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar(){
        $sql = "UPDATE agendamentos 
                SET data_agendamento = :data_agendamento, hora = :hora, idVeiculo = :idVeiculo, tipo_manutencao = :tipo_manutencao, observacoes = :observacoes 
                WHERE idAgendamento = :idAgendamento";

        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':data_agendamento', $this->data_agendamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_manutencao', $this->tipo_manutencao, PDO::PARAM_STR);
        $stmt->bindParam(':observacoes', $this->observacoes, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM agendamentos WHERE id_agendamento = :id_agendamento";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_agendamento', $this->id_agendamento, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    }

?>
