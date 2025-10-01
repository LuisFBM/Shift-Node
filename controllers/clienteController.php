<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];

    $sql = "INSERT INTO clientes (nome, email, telefone, cpf, endereco) 
            VALUES (:nome, :email, :telefone, :cpf, :endereco)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone,
        ':cpf' => $cpf,
        ':endereco' => $endereco
    ]);

    echo "Cliente cadastrado com sucesso!";
}
