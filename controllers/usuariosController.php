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

       public function login($email, $senha){
        $this->usuarios->email = $email;
        $this->usuarios->senha = $senha;
        
        // Busca usuário e pega o id_cliente junto
        $resultado = $this->usuarios->login();
        
        if($resultado){
            session_start();
            
            $_SESSION['usuario_id'] = $resultado['id'];
            $_SESSION['usuario_nome'] = $resultado['nome'];
            $_SESSION['usuario_tipo'] = $resultado['tipo'];
            
            // Salva id_cliente se for cliente
            if($resultado['tipo'] == 'CLIENTE' && isset($resultado['id_cliente'])){
                $_SESSION['cliente_id'] = $resultado['id_cliente'];
            }
            
            // Permissões simples
            if($resultado['tipo'] == 'ADMIN'){
                $_SESSION['pode_tudo'] = true;
            } else {
                $_SESSION['pode_tudo'] = false;
            }
            
            // Redireciona
            if($resultado['tipo'] == 'ADMIN'){
                header("Location: ../paginas/index.php");
            } else {
                header("Location: ../paginas/index.php");
            }
            exit();
        }
        return false;
    }



} 

?>