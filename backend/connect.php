<?php
    header("Access-Control-Allow-Origin: *"); //evitar erro do CORS
    
    $host = "localhost";
    $user = "root";
    $pass = ""; 
    $db = "tbr_teste"; //dados do banco (sem senha)

    $conn = new mysqli($host, $user, $pass, $db); //variável de conexão, passando todos os parâmetros

    $conn->set_charset("utf8"); //corrigindo o charset para utf-8 para exibir corretamente os nomes com acento

    if ($conn->connect_error) { //tratamento de erro e verificação de conexão
        die("Falha na conexão: " . $conn->connect_error);
    }
?>
