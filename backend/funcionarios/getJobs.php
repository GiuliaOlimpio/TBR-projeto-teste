<?php
//para pegar os nomes dos cargos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "tbr_teste");

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT id_cargo, nome_cargo FROM cargos";
$result = $conn->query($sql);

$cargos = [];

while ($row = $result->fetch_assoc()) {
  $cargos[] = $row;
}

echo json_encode($cargos);

$conn->close();
?>
