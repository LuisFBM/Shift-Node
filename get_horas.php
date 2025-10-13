<?php
include 'banco/databse.php';

$data = $_GET['data'];

$horarios_disponiveis = array();
for ($i = 9; $i <= 17; $i++) {
    $hora = str_pad($i, 2, '0', STR_PAD_LEFT);
    $horarios_disponiveis[] = $hora . ":00:00";
}

$stmt = $conexao->prepare("SELECT hora FROM agendamento WHERE data = ?");
$stmt->bind_param("s", $data);
$stmt->execute();
$resultado = $stmt->get_result();

while ($linha = $resultado->fetch_assoc()) {
    $horario_agendado = $linha['hora'];
    if (($key = array_search($horario_agendado, $horarios_disponiveis)) !== false) {
        unset($horarios_disponiveis[$key]);
    }
}
$stmt->close();
$conexao->close();

foreach ($horarios_disponiveis as $horario) {
    $hora_formatada = substr($horario, 0, 5); //Remove os segundos
    echo "<option value='" . $horario . "'>" . $hora_formatada . "</option>";
}
?>