<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

/*$host = "localhost";
$user = "root";
$pass = "";
$db = "tbr_teste";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

include '../connect.php';

// Obter o parâmetro 'nome_funcionario' da URL
$nome_funcionario = isset($_GET['nome_funcionario']) ? $_GET['nome_funcionario'] : '';

// se o nome do funcionário não for vazio, realiza a busca
if ($nome_funcionario) {
    // JOIN para obter o nome do cargo
    $sql = "SELECT f.*, c.nome_cargo 
            FROM funcionarios f
            JOIN cargos c ON f.cargo_funcionario = c.id_cargo
            WHERE f.nome_funcionario LIKE '%$nome_funcionario%'";

    $result = $conn->query($sql);

    // verificar se encontrou algum funcionário
    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc();
        echo json_encode($funcionario); // retorna o funcionário em formato JSON
    } else {
        echo json_encode([]); // se não encontrar, retorna um array vazio
    }
} else {
    echo json_encode([]); // retorna um array vazio se o nome_funcionario não for fornecido
}

$conn->close();
?>
