<?php

require_once '../controllers/QuestaoController.php';

$controller = new QuestaoController($pdo);

// Pega o ID da URL ex: /questoes/1
$partes = explode('/', $uri);
$id = isset($partes[2]) ? $partes[2] : null;

// Pega os dados enviados em JSON
$body = json_decode(file_get_contents('php://input'), true);

// admin lista todas as questões
if ($method === 'GET' && $id === null) {
    $controller->listar();

// admin cria nova questão
} elseif ($method === 'POST' && $id === null) {
    $controller->criar($body);

// admin edita uma questão
} elseif ($method === 'PUT' && $id !== null) {
    $controller->atualizar($id, $body);

// admin deleta uma questão
} elseif ($method === 'DELETE' && $id !== null) {
    $controller->deletar($id);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}