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
        $id_cliente = $_SESSION['usuarios']->id_usuario ?? null;
        if (!$id_cliente) return [];
        return $this->veiculo->lerTodosPorCliente($id_cliente);
    }

    public function cadastrarVeiculo($dados) {
    $this->veiculo->nome = $dados['nome']; 
    $this->veiculo->ano = $dados['ano'];
    $this->veiculo->id_cliente = $dados['id_cliente']; 

    if ($this->veiculo->cadastrar()) {  
        return $this->veiculo->id; 
    } else {
        echo "Erro ao cadastrar veículo!";
        return false;
    }
}



    public function excluirVeiculo($idVeiculo) {
        $this->veiculo->id_veiculo = $idVeiculo;
        return $this->veiculo->excluir();
    }

    }
?>
