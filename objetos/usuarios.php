<?php
class Usuarios {
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;
    public $cpf;
    public $tipo;
    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function cadastrar() {
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuarios (nome, email, senha, telefone, cpf, tipo) 
                VALUES (:nome, :email, :senha, :telefone, :cpf, :tipo)';
        
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function atualizar() {
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios 
                SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, cpf = :cpf, tipo = :tipo 
                WHERE id = :id";
        
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluir() {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Login usando objeto e salvando objeto na sessão
   public function login() {
        $sql = 'SELECT * FROM usuarios WHERE email = :email';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ); // OBJETO

        if ($resultado && password_verify($this->senha, $resultado->senha)) {
            session_start();
            $_SESSION['usuarios'] = $resultado; // Salva o OBJETO inteiro
            
            // Redireciona baseado no tipo
            if (strtoupper($resultado->tipo) === 'ADMIN') {
                header('Location: ../paginas/dashboard.php');
            } else {
                header('Location: ../paginas/index.php');
            }
            exit;
        } else {
            session_start();
            $_SESSION['erro'] = 'Email ou senha incorretos';
            header('Location: login.php');
            exit;
        }
    }
}
?>