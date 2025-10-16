<?php

include_once '../banco/database.php';
include_once '../objetos/usuarios.php';

class usuariosController {

    private $bd;
    private $usuarios;
 

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->usuarios = new Usuarios($this->bd);
    }


    public function cadastrarUsuarios($dados){
        $this->usuarios->nome = $dados['nome']; 
        $this->usuarios->email = $dados['email'];
        $this->usuarios->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $this->usuarios->telefone = $dados['telefone'];
        $this->usuarios->cpf = $dados['cpf'];

        if($this->usuarios->cadastrar($dados)){
            header("Location: ../paginas/index.php");
            exit();
        }
        return false;
    }

    public function atualizarUsuarios($dados){
        $this->usuarios->nome = $dados['nome']; 
        $this->usuarios->email = $dados['email'];
        $this-> usuarios->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $this->usuarios->telefone = $dados['telefone'];
        $this->usuarios->cpf = $dados['cpf'];

        if($this->usuarios->atualizar()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function excluirUsuario($id){
        $this->usuarios->id = $id;

        if($this->usuarios->excluir()){
            header("Location: login.php");
            exit();
        }
    }

    public function login($email, $senha) {
        // Busca o usuário no banco
        $usuario = $this->usuarios->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario->senha)) {
            session_start();

            // Armazena os dados essenciais do usuário
            $_SESSION['usuarios'] = [
                'id' => $usuario->id_usuario,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'tipo' => strtoupper($usuario->tipo) // garante maiúsculas
            ];

            // Redireciona conforme o tipo
            if ($_SESSION['usuarios']['tipo'] === 'ADMIN') {
                header("Location: ../paginas/dashboard.php");
            } else {
                header("Location: ../paginas/index.php");
            }
            exit;
        } else {
            header("Location: ../paginas/login.php?erro=1");
            exit;
        }
    }


    

}


?>