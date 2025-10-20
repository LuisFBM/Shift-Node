<?php
class Veiculo {
    public $id_veiculo;
    public $id_usuario;
    public $nome;
    public $ano;
    private $bd;

    public function __construct($bd) {
        $this->bd = $bd; 
    }

    public function cadastrar() {
        $sql = "INSERT INTO veiculos (id_usuario, nome, ano) VALUES (:id_usuario, :nome, :ano)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id_veiculo = $this->bd->lastInsertId();
            return $this->id_veiculo; // retorna o ID do veículo cadastrado
        }
        return false;
    }

    public function lerPorId($id_veiculo) {
        $sql = "SELECT * FROM veiculos WHERE id_veiculo = :id_veiculo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_veiculo', $id_veiculo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); // Retorna um objeto com os dados do veículo
    }

    public function atualizar() {
        $sql = "UPDATE veiculos SET nome = :nome, ano = :ano WHERE id_veiculo = :id_veiculo";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_STR);
        $stmt->bindParam(':id_veiculo', $this->id_veiculo, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function lerTodosPorUsuario($id_usuario) {
        $sql = "SELECT * FROM veiculos WHERE id_usuario = :id_usuario ORDER BY id_veiculo DESC";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Retorna objetos como o amigo
    }
}
?>