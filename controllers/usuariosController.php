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
        $this->usuarios->formacao = $dados['formacao'];

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
        $this->usuarios->formacao = $dados['formacao'];

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
    $usuario = $this->usuarios->buscarPorEmail($email);
    if ($usuario && password_verify($senha, $usuario->senha)) {
        $_SESSION['usuarios'] = [
            'id' => $usuario->id_usuario,
            'nome' => $usuario->nome,
            'email' => $usuario->email,
            'tipo' => $usuario->tipo
        ];
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red;'>E-mail ou senha inválidos.</p>";
    }
    
    }


    

}


?>