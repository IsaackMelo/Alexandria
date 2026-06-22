<?php

require_once '../controllers/SimuladoController.php';

$controller = new SimuladoController($pdo);

// Pega o ID da URL ex: /simulados/1
$partes = explode('/', $uri);
$id = isset($partes[2]) ? $partes[2] : null;

// lista todos os simulados
if ($method === 'GET' && $id === null) {
    $controller->listar();

// abre um simulado
} elseif ($method === 'GET' && $id !== null) {
    $controller->buscar($id);

// entrega simulado
} elseif ($method === 'POST' && isset($partes[3]) && $partes[3] === 'entregar') {
    $controller->entregar($id);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}