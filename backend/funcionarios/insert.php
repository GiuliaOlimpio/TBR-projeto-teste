<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // métodos HTTP
header('Access-Control-Allow-Headers: Content-Type');

include '../connect.php';

/*$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'tbr_teste';


$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8');

if ($conn->connect_error) {
    echo json_encode(['erro' => 'Erro na conexão com o banco']);
    exit;
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //verificação do método POST
    $data = json_decode(file_get_contents('php://input'), true); //receber em JSON

    if (!isset($data['nome_funcionario']) || !isset($data['email_funcionario']) || !isset($data['cargo_funcionario'])) { //caso algum dos campos esteja vazio, será exibida uma mensagem de que são obrigatórios
        echo json_encode(['erro' => 'Todos os campos são obrigatórios']);
        exit;
    }

    $nome_funcionario = $data['nome_funcionario']; //recebe o nome do funcionario
    $email_funcionario = $data['email_funcionario']; //recebe o email do funcionario
    $cargo_funcionario = $data['cargo_funcionario']; //recebe o cargo do funcionario

    $sql = "INSERT INTO funcionarios (nome_funcionario, email_funcionario, cargo_funcionario) VALUES (?, ?, ?)";  //código sql para inserção de dados no banco via SQL
    $stmt = $conn->prepare($sql); //preparo de conexão para verificação de possíveis erros e evitar SQL injection

    if ($stmt === false) { //caso a variável retorne como false, quer dizer que o prepare não foi executado corretamente (algo está errado na hora da inserção)
        echo json_encode(['erro' => 'Erro ao preparar consulta']);
        exit;
    }

    $stmt->bind_param('ssi', $nome_funcionario, $email_funcionario, $cargo_funcionario); //vincula os parâmetros para a execução da query (cargo é inteiro)
    
    if ($stmt->execute()) { //executa o script SQL
        echo json_encode(['sucesso' => 'Funcionário inserido com sucesso']);
    } else {
        echo json_encode(['erro' => 'Erro ao inserir funcionário']);
    }

    $stmt->close(); //término do statement
}

$conn->close(); //fechamento da conexão com o banco
?>
