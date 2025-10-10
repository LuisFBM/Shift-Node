<?php

include_once '../banco/database.php';
include_once '../objetos/cliente.php';

class clienteController {

    private $bd;
    private clientes;
 

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->clientes = new Clientes($this->bd);
    }


    public function cadastrarCliente($dados){
        $this->clientes->nome = $dados['nome'];
        $this->clientes->email = $dados['email'];
        $this->clientes->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $this->clientes->telefone = $dados['telefone'];
        $this->clientes->cpf = $dados['cpf'];


        if($this->clientes->cadastrar($dados)){
            header("Location: ../paginas/index.php");
            exit();
        }
        return false;
    }

    public function atualizarCliente($dados){
        $this->clientes->nome = $dados['nome'];
        $this->clientes->email = $dados['email'];
        $this-> clientes->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $this->clientes->telefone = $dados['telefone'];
        $this->clientes->cpf = $dados['cpf'];


        if($this->clientes->atualizar()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function excluirCliente($id){
        $this->usuarios->id = $id;

        if($this->clientes->excluir()){
            header("Location: login.php");
            exit();
        }
    }

    public function login($email, $senha){
        $this->clientes->email = $email;
        $this->clientes->senha = $senha;

        $this->clientes->login();
}



} 

?>