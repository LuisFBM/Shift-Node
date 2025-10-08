<?php

include_once 'configs/database.php';
include_once 'servico.php';

class servicoController{

    private $bd;
    private $servico;

    public function __construct(){
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->servico = new servico($this->bd);
    }

    public function index(){
        return $this->servicos->lerTodos();
    }

    public function listarServicos(){
        return $this->servicos->lerServicos();
    }

    public function cadastrarServico($dados){
        $this->servicos->nome = $dados['nome'];
        $this->servicos->descricao = $dados['descricao'];

        if($this->servicos->cadastrarSer()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function atualizarServico($dados){
        $this->servicos->nome = $dados['nome'];
        $this->servicos->descricao = $dados['descricao'];


        if($this->servico->atualizar()){
            header("Location: index.php");
            exit();
        }

        return false;
    }

    public function excluirServico($id_servico){
        $this->servicos->id_servico = $id_servico;

        if($this->servicos->excluir()){
            header("Location: index.php");
            exit();
        }
    }
}


?>