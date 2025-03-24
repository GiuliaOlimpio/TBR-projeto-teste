<?php
  header("Access-Control-Allow-Origin: *", "Content-Type: application/json; charset=utf-8"); //evitar erro do CORS, setar charset para utf-8

  include '../connect.php'; //importação do arquivo de conexão ao banco

  // JOIN para trazer o nome do cargo
  $sql = "SELECT funcionario.*, cargo.nome_cargo FROM funcionarios funcionario INNER JOIN cargos cargo ON funcionario.cargo_funcionario = cargo.id_cargo";

  $result = $conn->query($sql); //o resultado é armazenado em uma variável $result, utilizando a função de seta para a função query

  $funcionarios = []; //a variável funcionarios é inicializada como um array

  while ($row = $result->fetch_assoc()) { //enquanto houver funcionarios, buscará no banco
    $funcionarios[] = $row; //pega cada linha do banco que representará um funcionario
  }

  echo json_encode($funcionarios, JSON_UNESCAPED_UNICODE); //transforma em um json para integrar com o Vue, exibe em utf-8
?>
