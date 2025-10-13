<?php
class Veiculo {
    public $id_veiculo;
    public $id_cliente;
    public $nome;
    public $ano;
    private $bd;

    public function __construct($bd) {
        $this->bd = $bd; 
    }

    public function cadastrar() {
        $sql = "INSERT INTO veiculos (id_cliente, nome, ano) VALUES (:id_cliente, :nome, :ano)";
        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function lerTodosPorCliente($id_cliente) {
        $sql = "SELECT * FROM veiculos WHERE id_cliente = :id_cliente";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar() {
        $sql = "UPDATE veiculos SET nome = :nome, ano = :ano WHERE id_veiculo = :id_veiculo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ano', $this->ano);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir() {
        $sql = "DELETE FROM veiculos WHERE id_veiculo = :id_veiculo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
