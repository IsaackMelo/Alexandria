<?php

$host = 'localhost';
$dbname = 'alexandria_db';
$user = 'root';
$password = 'SENHA-DO-BANCO';

try {

    // Cria a conexão usando PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    // Se der erro, mostra como exceção em vez de tela branca
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retorna os dados do banco como array associativo
    // ex: $usuario['nome'] em vez de $usuario[0]
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Se a conexão falhar
} catch (PDOException $e) {

    // Retorna o código de erro 500 (erro interno do servidor)
    http_response_code(500);

    // Retorna uma mensagem de erro em JSON
    echo json_encode([
        "erro" => "Falha na conexão com o banco de dados"
    ]);

    exit;
}