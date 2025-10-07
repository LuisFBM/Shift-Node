<?php

include_once '../banco/database.php';
include_once '../objetos/veiculo.php';
include_once "../objetos/usuarios.php";


public function validarCadastro($cliente) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tipo = $_POST['tipo']) {

    $sql = 'INSERT INTO clientes (id_usuario, observacoes) VALUES (:id_usuario, :observacoes)';
    $stmt = $this->bd->prepare($sql);
    $stmt->bindParam(':id_usuario', $cliente, PDO::PARAM_INT);
    $stmt->bindParam(':observacoes', $tipo, PDO::PARAM_INT);

    }

    }


?>
