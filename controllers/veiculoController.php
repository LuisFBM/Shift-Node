<?php
include_once '../banco/database.php';
include_once '../objetos/veiculo.php';


class veiculoController {
    private $bd;
    private $veiculo;

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->veiculo = new Veiculo($this->bd);
    }

    public function indexVeiculo() {
        $id_usuario = $_SESSION['usuarios']->id_usuario ?? null;
        if (!$id_usuario) return [];
        return $this->veiculo->lerTodosPorUsuario($id_usuario);
    }

  public function cadastrarVeiculo($dados) {
        $this->veiculo->nome = $dados['nome']; 
        $this->veiculo->ano = $dados['ano'];
        $this->veiculo->id_usuario = $dados['id_usuario']; 

        // O método cadastrar() já retorna o ID ou false
        $id_veiculo = $this->veiculo->cadastrar();
        
        if ($id_veiculo) {
            return $id_veiculo; // Retorna o ID recebido
        }
        
        return false;
    }


    public function atualizarVeiculo($dados) {
        $this->veiculo->id_veiculo = $dados['id_veiculo'];
        $this->veiculo->nome = $dados['nome'];
        $this->veiculo->ano = $dados['ano'];

        return $this->veiculo->atualizar();
    }


    public function excluirVeiculo($id_veiculo) {
        $this->veiculo->id_veiculo = $id_veiculo;
        return $this->veiculo->excluir();
    }

    }
?>
