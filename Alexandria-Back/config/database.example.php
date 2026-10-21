<?php
// AVISO !! Este arquivo é um exemplo da estrutura do database.php sem a senha "para proteção", ao utilizar mude o nome para database.php e coloque a senha do banco.
$host = 'localhost';
$dbname = 'alexandria_db';
$user = 'root';
$password = 'SENHA-DO-BANCO';

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "erro" => "Falha na conexão com o banco de dados"
    ]);

    exit;
}