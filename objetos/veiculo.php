<?php

class Veiculo {

    public $id_veiculo;
    public $nome;
    public $ano;
    public $bd;


       public function __construct($bd){
        $this->bd = $bd; 
    }


    public function cadastrar(){
        
        $sql = "INSERT INTO veiculos (nome, ano, id_cliente) VALUES (:nome, :ano, :id_cliente)";
        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar(){

        $sql = "UPDATE veiculo SET nome = :nome, ano = :ano WHERE id_veiculo = :id_veiculo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);

        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
           public function excluir(){
        $sql = "DELETE FROM veiculo WHERE id_veiculo = :id_veiculo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }



}

?>