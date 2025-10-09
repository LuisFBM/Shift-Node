<?php

Class agendamento {
    public $id_agendamento;

    public $hora;
    public $id_cliente;
    public $id_veiculo;
    public $nome_cliente;
    public $tipo_servico;
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
        $sql = "INSERT INTO agendamentos (data_agendamento, hora, nome_cliente, id_veiculo, hora, tipo_servico, observacoes) 
                VALUES (:data_agendamento, :hora, :nome_cliente, :id_veiculo, :hora, :tipo_servico, :observacoes)";

        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':data_agendamento', $this->data_agendamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':nome_cliente', $this->nome_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_servico', $this->tipo_servico, PDO::PARAM_STR);
        $stmt->bindParam(':observacoes', $this->observacoes, PDO::PARAM_STR);

        return $stmt->execute();

    }

    public function atualizar(){
        $sql = "UPDATE agendamentos 
                SET data_agendamento = :data_agendamento, hora = :hora, nome_cliente :nome_cliente, id_veiculo = :id_veiculo, observacoes = :observacoes 
                WHERE id_agendamento = :id_agendamento";

        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':data_agendamento', $this->data_agendamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':nome_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam('hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam('tipo_servico', $this->tipo_servico. PDO::PARAM_STR);
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
