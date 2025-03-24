<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // métodos HTTP
header('Access-Control-Allow-Headers: Content-Type');

include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['nome_funcionario']) || !isset($data['email_funcionario']) || !isset($data['cargo_funcionario'])) {
        echo json_encode(['erro' => 'Todos os campos são obrigatórios']);
        exit;
    }

    $nome_funcionario = $data['nome_funcionario'];
    $email_funcionario = $data['email_funcionario'];
    $cargo_funcionario = $data['cargo_funcionario'];

    // Verificar se o e-mail já existe
    $checkEmailSql = "SELECT id_funcionario FROM funcionarios WHERE email_funcionario = ?";
    $checkStmt = $conn->prepare($checkEmailSql);

    if ($checkStmt === false) {
        echo json_encode(['erro' => 'Erro ao preparar verificação de e-mail']);
        exit;
    }

    $checkStmt->bind_param('s', $email_funcionario);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['erro' => 'Este e-mail já está cadastrado']);
        $checkStmt->close();
        $conn->close();
        exit;
    }
    $checkStmt->close();

    // Se o e-mail não existe, prossegue com a inserção
    $sql = "INSERT INTO funcionarios (nome_funcionario, email_funcionario, cargo_funcionario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['erro' => 'Erro ao preparar consulta']);
        exit;
    }

    $stmt->bind_param('ssi', $nome_funcionario, $email_funcionario, $cargo_funcionario);

    if ($stmt->execute()) {
        echo json_encode(['sucesso' => 'Funcionário inserido com sucesso']);
    } else {
        echo json_encode(['erro' => 'Erro ao inserir funcionário']);
    }

    $stmt->close();
}

$conn->close();
?>
