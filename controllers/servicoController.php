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
        return $this->servico->lerTodos();
    }

    public function listarServicos(){
        return $this->servico->lerServicos();
    }

    public function cadastrarServico($dados){
        $this->servico->nomeServico = $dados['nome'];
        $this->servico->descricao = $dados['descricao'];
        $this->servico->preco = $dados['preco'];

        if($this->servico->cadastrarSer()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function atualizarServico($dados){
        $this->servico->nomeServico = $dados['nomeServico'];
        $this->servico->descricao = $dados['descricao'];
        $this->servico->preco = $dados['preco'];

        if($this->servico->atualizar()){
            header("Location: index.php");
            exit();
        }

        return false;
    }

    public function excluirServico($idServico){
        $this->servico->idServico = $idServico;

        if($this->servico->excluir()){
            header("Location: index.php");
            exit();
        }
    }
}


?>