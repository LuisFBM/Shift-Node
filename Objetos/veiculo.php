<?php

class Veiculo {

    public $id;

    public $nome;

    public $marca;

    public $modelo;

    public $placa;

    public $ano;

    public $bd


       public function __construct($bd){
        $this->bd = $bd; 
    }


    public function cadastrar(){
        
        $sql = "INSERT INTO veiculo (nome, marca, modelo, placa, ano) VALUES (:nome, :marca, :modelo, :placa, :ano)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':marca', $this->marca, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $this->modelo, PDO::PARAM_STR);
        $stmt->bindParam(':placa', $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar(){
    
        $sql = "UPDATE veiculo SET nome = :nome, marca = :marca, modelo = :modelo, placa = :plca, ano = :ano WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':marca', $this->marca, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $this->modelo, PDO::PARAM_STR);
        $stmt->bindParam(':placa', $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }

           public function excluir(){
        $sql = "DELETE FROM veiculo WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    }

}

?>