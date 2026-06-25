<?php

require_once '../controllers/AssinaturaController.php';

$controller = new AssinaturaController($pdo);

$partes = explode('/', $uri);
$acao = isset($partes[2]) ? $partes[2] : null;

// GET /assinaturas/me → busca assinatura ativa do usuário
if ($method === 'GET' && $acao === 'me') {
    $controller->buscarAtiva();

// DELETE /assinaturas/me → cancela assinatura do usuário
} elseif ($method === 'DELETE' && $acao === 'me') {
    $controller->cancelar();

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}
//verificar