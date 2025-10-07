
<?php

Class servico{
    public $idServico;
    public $nomeServico;
    public $descricao;
    public $preco;
    public $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function lerTodos(){
        $sql = "SELECT * FROM servico";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);
    }

    public function lerServicos(){
        $sql = "SELECT idServico, nomeServico FROM servico";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_ASSOC);
    }

    public function lerServico($nomeServico){
        $nomeServico = "%" . $nomeServico . "%";
        $sql = "SELECT * FROM servico WHERE nomeServico LIKE :nomeServico";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':nomeServico' , $nomeServico);
        $resultado->execute();

        return $resultado->fetchALL(PDO::FETCH_OBJ);
    }

    public function cadastrarSer(){
        $sql = "INSERT INTO servico(nomeServico, descricao, preco) VALUES (:nomeServico, :descricao, :preco)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nomeServico', $this->nomeServico, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $this->preco);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizar(){
        $sql = "UPDATE servico SET nomeServico = :nomeServico, preco = :preco WHERE idServico = :idServico";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nomeServico', $this->nomeServico, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $this->preco);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM servico WHERE idServico = :idServico";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':idServico', $this->idServico, PDO::PARAM_INT);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>
