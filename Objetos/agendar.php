<?php

Class agendamento {

    public $id_agendamento;
    public $id_cliente;
    public $id_veiculo;
    public $data_agedamento;
    public $id_orcamento;
    public $id_atendente;
    public $id_mecanico;
    public $hora_inicio;
    public $hora_fim;
    public $tipo_manutencao;
    public $id_status;
    public $observacoes;
    

  
    public function lerTodos(){

        $sql = "SELECT * FROM agendamentos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }


    public function lerUsuario($nome){
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM agendamentos WHERE id_agendamento LIKE :id_agendamento";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':id_agendamento', $id_agendamento);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function status(){
        if($id_status >= 1){
            return "Agendamento Feito";
        } else if ($id_status != 0) {
            return "Agendamento Não Concluido";
        }
    }

    public function atualizar(){
    
        $sql = "UPDATE agendametno SET data_agedamento = :data_agedamento, id_orcamento = :id_orcamento, id_orcamento = :hora_inicio, hora_fim = :hora_fim, 
            tipo_manutencao = :tipo_manutencao, id_status = :id_status, observacoes = :observacoes WHERE id_agendamento = :id_agendamento";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':data_agedamento', $this->data_agedamento, PDO::PARAM_STR);
        $stmt->bindParam(':id_orcamento', $this->id_orcamento, PDO::PARAM_STR);
        $stmt->bindParam(':hora_inicio', $this->hora_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':hora_fim', $this->hora_fim, PDO::PARAM_STR);
        $stmt->bindParam(':', $this->, PDO::PARAM_STR);
        $stmt->bindParam(':', $this->, PDO::PARAM_STR);
        $stmt->bindParam(':', $this->, PDO::PARAM_STR);
        $stmt->bindParam(':', $this->, PDO::PARAM_STR);
        $stmt->bindParam(':id_agendamento', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM agendamento WHERE id_agendamento = :id_agendamento";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_agendamento', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }


}

?>