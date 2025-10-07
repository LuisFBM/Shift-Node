<?php

Class agendamento {

    public $id_agendamento;
    public $data_agedamento;
    public $id_orcamento;
    public $hora;
    public $tipo_manutencao;
    public $observacoes;

    private $bd;

     public function __construct($bd) {
        $this->bd = $bd;
    }

    public function lerTodos(){

        $sql = "SELECT * FROM agendamentos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }


    public function lerAgendamentos($id_agendamento){
        $nome = "%" . $id_agendamento . "%";
        $sql = "SELECT * FROM agendamentos WHERE id_agendamento LIKE :id_agendamento";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':id_agendamento', $id_agendamento);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function agendamento(){
        $sql = 'INSERT INTO agendamentos (id_cliente, id_veiculo, data_agedamento, tipo_manutencao, observacoes) 
                VALUES (:id_cliente, :id_veiculo, :data_agedamento, :tipo_manutencao,  :observacoes)';

        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':data_agedamento', $this->data_agedamento, PDO::PARAM_STR);
        $stmt->bindParam(':id_orcamento', $this->id_orcamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_manutencao', $this->tipo_manutencao, PDO::PARAM_STR);
        $stmt->bindParam(':observações', $this->observacoes, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function atualizar(){
    
        $sql = "UPDATE agendametno SET data_agedamento = :data_agedamento, id_orcamento = :id_orcamento, id_orcamento, hora = :hora, 
            tipo_manutencao = :tipo_manutencao, observacoes = :observacoes WHERE id_agendamento = :id_agendamento";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':data_agedamento', $this->data_agedamento, PDO::PARAM_STR);
        $stmt->bindParam(':id_orcamento', $this->id_orcamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_manutencao', $this->tipo_manutencao, PDO::PARAM_STR);
        $stmt->bindParam(':observacoes', $this->observações, PDO::PARAM_STR);

        $stmt->bindParam(':id_agendamento', $this->id_agendamento, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM agendamento WHERE id_agendamento = :id_agendamento";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_agendamento', $this->id_agendamento, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function verificarHorario() {
        $sql = "SELECT * FROM agendamentos 
                WHERE data_agendada = ? AND hora_agendada = ? AND status != 'CANCELADO'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->data_agendada, $this->hora_agendada]);
        return $stmt->rowCount() > 0;
    }

    }

?>