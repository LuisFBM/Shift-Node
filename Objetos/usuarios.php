<?php
class Usuario {
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $cpf;
    private $tipo;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function cadastrar($conn) {
        $sql = "CALL cadastrar_usuario(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", 
            $this->nome, 
            $this->email, 
            $this->senha, 
            $this->telefone, 
            $this->cpf, 
            $this->tipo
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizar(){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, cpf = :cpf, tipo = :tipo WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

          if($stmt->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function excluir(){
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function login(){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if($resultado){
        if(password_verify($this->senha, $resultado->senha)){
            session_start();
            $_SESSION['usuarios'] = $resultado;
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php");
            exit();
            }
        } 
    }
    
}
?>
