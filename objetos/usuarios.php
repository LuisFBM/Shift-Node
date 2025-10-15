<?php
class Usuarios
{

    public $id_usuario;

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

        $stmt->bindParam(':id_usuarios', $this->id_usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function excluir()
    {
        $sql = "DELETE FROM usuarios WHERE id_usuarios = :id_usuarios";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id_usuarios', $this->id_usuarios, PDO::PARAM_INT);

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

    public function login(){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if ($resultado) {
            if (password_verify($this->senha, $resultado->senha)) {
                session_start();

                // Armazena dados essenciais do usuário
                $_SESSION['usuarios'] = [
                    'id' => $resultado->id_usuario,
                    'nome' => $resultado->nome,
                    'email' => $resultado->email,
                    'tipo' => $resultado->tipo // <-- adiciona o tipo (admin ou usuario)
                ];

                // Redirecionamento conforme o tipo
                if ($resultado->tipo === 'admin') {
                    header("Location: paginas/dashboard.php");
                } else {
                    header("Location: paginas/index.php");
                }

                exit();
            } else {
                header("Location: login.php?erro=senha");
                exit();
            }
        } else {
            header("Location: login.php?erro=email");
            exit();
        }
    }

}


?>
