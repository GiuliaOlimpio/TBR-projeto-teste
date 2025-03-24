<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

/*$host = "localhost";
$user = "root";
$pass = "";
$db = "tbr_teste";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erro de conexão: " . $conn->connect_error]));
}*/

include '../connect.php';

// recebe o JSON
$data = json_decode(file_get_contents("php://input"), true);

$id_funcionario = isset($data['id_funcionario']) ? intval($data['id_funcionario']) : 0;

if ($id_funcionario > 0) {
    $sql = "DELETE FROM funcionarios WHERE id_funcionario = $id_funcionario";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID inválido']);
}

$conn->close();
?>
