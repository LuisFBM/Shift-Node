<?php

include_once '../banco/database.php';
include_once '../objetos/usuarios.php';

class usuariosController {

    private $bd;
    private $usuarios;
 

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->usuario = new Usuario($this->bd);
    }


    public function cadastrarUsuario($usuarios){
        $this->usuario->nome = $usuarios['nome']; 
        $this->usuario->email = $usuarios['email'];
        $this-> usuario->senha = password_hash($usuarios['senha'], PASSWORD_DEFAULT);
        $this->usuario->telefone = $usuarios['telefone'];

        if($this->usuario->cadastrar()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function atualizarUsuario($dados){
        $this->usuarios->id = $dados['id'];
        $this->usuarios->nome = $dados['nome'];
        $this->usuarios->email = $dados['email'];
        $this->usuarios->senha = $dados['senha'];
        $this->usuarios->telefone = $dados['telefone'];

        if($this->usuarios->atualizar()){
            header("Location: listaUsuario.php");
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

    public function login($email, $senha){
        $this->usuarios->email = $email;
        $this->usuarios->senha = $senha;

        $this->usuarios->login();
}
} 

?>