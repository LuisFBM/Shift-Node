
<?php

Class servico{
    public $id_servico;
    public $nome;
    public $descricao;
    public $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = "SELECT * FROM servicos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);
    }

    public function lerServicos(){
        $sql = "SELECT id_servico, nome FROM servicos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_ASSOC);
    }

    public function lerServico($nome){
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM servicos WHERE nome LIKE :nome";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':nome' , $nome);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);
    }

    public function cadastrarSer(){
        $sql = "INSERT INTO servicos(nome, descricao) VALUES (:nomeServico, :descricao)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nomeS', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizar(){
        $sql = "UPDATE servicos SET nome = :nome WHERE id_servico = :id_servico";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM servicos WHERE id_servico = :id_servico";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_servico', $this->id_servico, PDO::PARAM_INT);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>
