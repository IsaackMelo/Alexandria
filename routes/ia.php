<?php

require_once '../controllers/IAController.php';

$controller = new IAController($pdo);

// Pega os dados enviados em JSON
$body = json_decode(file_get_contents('php://input'), true);

// gera feedback personalizado do simulado
if ($uri === '/ia/feedback' && $method === 'POST') {
    $controller->feedback($body);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}