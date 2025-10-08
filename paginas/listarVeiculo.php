<?php
include_once '../controllers/veiculoController.php';
$controller = new veiculoController();
$veiculos = $controller->indexVeiculo();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesquisa'])) {
    $veiculos = $controller->pesquisarVeiculo($_POST['pesquisa']);
} elseif (isset($_GET['excluir'])) {
    $controller->excluirVeiculo($_GET['excluir']);
    header("Location: listaVeiculos.php");
}
?>

<h2>Meus Veículos</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ano</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($veiculos as $v): ?>
        <tr>
            <td><?= $v['id_veiculo'] ?></td>
            <td><?= htmlspecialchars($v['nome']) ?></td>
            <td><?= $v['ano'] ?></td>
            <td>
                <a href="editarVeiculo.php?id=<?= $v['id_veiculo'] ?>">Editar</a>
                <a href="listaVeiculos.php?excluir=<?= $v['id_veiculo'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="" method="post">
    <input type="text" name="pesquisa" placeholder="Pesquisar veículo">
    <button>Pesquisar</button>
</form>
