<?php 

Class ListaAgendamentos {
    public $id_agendamento;

    public $id_cliente;
    public $id_veiculo;
    public $hora;
    public $data_agendamento;
    public $tipo_servico;
    public $observacoes;
    public $bd;


    public function __construct($bd){
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = 'SELECT * FROM agendamentos';
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);

    }

    public function lerAgendamento($id_agendamento){
        $idAgendamento = "%" . $id_agendamento . "%";
        $sql = 'SELECT * FROM agendamentos WHERE id_agendamento LIKE :id_agendamento';
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':id_agendamento', $idAgendamento);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);

    }

    public function lerAgendamentosPorCliente($id_cliente){
        $sql = 'SELECT * FROM agendamentos WHERE id_cliente = :id_cliente';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

}

?>