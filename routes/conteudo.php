<?php

require_once '../controllers/ConteudoController.php';

$controller = new ConteudoController($pdo);

// Pega o ID da URL ex: /conteudos/1
$partes = explode('/', $uri);
$id = isset($partes[2]) ? $partes[2] : null;

// Pega os dados enviados em JSON
$body = json_decode(file_get_contents('php://input'), true);

// Pega o parâmetro de pesquisa da URL ex: /conteudos?busca=historia
$busca = $_GET['busca'] ?? null;

// pesquisa conteúdos pelo título
if ($method === 'GET' && $busca !== null) {
    $controller->pesquisar($busca);

// busca conteúdos por matéria
} elseif ($method === 'GET' && isset($partes[2]) && $partes[2] === 'materia' && isset($partes[3])) {
    $controller->buscarPorMateria($partes[3]);

// lista todos os conteúdos
} elseif ($method === 'GET' && $id === null) {
    $controller->listar();

// busca um conteúdo pelo ID
} elseif ($method === 'GET' && $id !== null) {
    $controller->buscar($id);

// admin cria novo conteúdo
} elseif ($method === 'POST' && $id === null) {
    $controller->criar($body);

// admin atualiza um conteúdo
} elseif ($method === 'PUT' && $id !== null) {
    $controller->atualizar($id, $body);

// admin deleta um conteúdo
} elseif ($method === 'DELETE' && $id !== null) {
    $controller->deletar($id);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}