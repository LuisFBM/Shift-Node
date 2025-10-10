<?php
include_once '../banco/database.php';
include_once '../objetos/veiculos.php';
session_start();

class veiculoController {
    private $bd;
    private $veiculo;

    public function __construct(){
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->veiculo = new veiculos($this->bd);
    }

    public function indexVeiculo() {
        $id_cliente = $_SESSION['usuario_id'];
        return $this->veiculo->lerTodosPorCliente($id_cliente);
    }

    public function cadastrarVeiculo() {
        $this->veiculo->nome = $_POST['nome'];
        $this->veiculo->ano = $_POST['ano'];
    }
    public function pesquisarVeiculo($nome) {
        $id_cliente = $_SESSION['usuario_id'];
        $this->veiculo->nome = $nome;
        return $this->veiculo->pesquisarPorNome($termo, $id_cliente);
    }

    public function alterarVeiculo($id_veiculo){
      $this->veiculo->nome = $_POST['nome'];
      $this->veiculo->ano = $_POST['ano'];
    }

    public function excluirVeiculo($idVeiculo) {
        $this->veiculo->id_veiculo = $idVeiculo;
        return $this->veiculo->excluir();
    }
}
?>
