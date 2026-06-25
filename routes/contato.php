<?php

require_once '../controllers/ContatoController.php';

$controller = new ContatoController($pdo);

// Pega os dados enviados em JSON
$body = json_decode(file_get_contents('php://input'), true);

// POST /contato → salva mensagem de contato
if ($uri === '/contato' && $method === 'POST') {
    $controller->enviar($body);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}