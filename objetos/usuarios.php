<?php
class Usuarios
{

    public $id;

    public $nome;
    public $email;
    public $senha;
    public $telefone;
    public $cpf;
    public $tipo;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function cadastrar()
    {

        $sql = 'INSERT INTO usuarios (nome, email, senha, telefone, cpf, tipo) VALUES (:nome, :email, :senha, :telefone, :cpf, :tipo)';

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);

        return $stmt->execute();

    }


    public function atualizar()
    {
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, cpf = :cpf, tipo = :tipo WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function excluir()
    {
        $sql = "DELETE FROM usuarios WHERE id = :id_usuarios";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);

    }

    public function login($senha, $email){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);


        if ($resultado && password_verify($senha, $resultado->senha)) {
            session_start();

            // Armazena os dados do usuário na sessão
            $_SESSION['usuario_id'] = $resultado->id;
            $_SESSION['usuario_email'] = $resultado->email;
            $_SESSION['usuario_tipo'] = $resultado->tipo;

            // Redireciona conforme o tipo de usuário (cliente/admin)
            if ($resultado->tipo === 'ADMIN') {
                header('Location: ../paginas/dashboard.php');
            } else {
                header('Location: ../paginas/index.php');
            }
            exit;
        } else {
            header('Location: ../paginas/login.php?erro=1');
            exit;
        }
    }

}


?>
