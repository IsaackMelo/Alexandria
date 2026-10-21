<?php

$controller = new ConteudoController($pdo);

$partes = explode('/', $uri);
$id = isset($partes[2]) ? $partes[2] : null;

$body = json_decode(file_get_contents('php://input'), true);

$busca = $_GET['busca'] ?? null;

if ($method === 'GET' && $busca !== null) {
    $controller->pesquisar($busca);

} elseif ($method === 'GET' && isset($partes[2]) && $partes[2] === 'materia' && isset($partes[3])) {
    $controller->buscarPorMateria($partes[3]);

} elseif ($method === 'GET' && $id === null) {
    $controller->listar();

} elseif ($method === 'GET' && $id !== null) {
    $controller->buscar($id);

} elseif ($method === 'POST' && $id === null) {
    $controller->criar($body);

} elseif ($method === 'PUT' && $id !== null) {
    $controller->atualizar($id, $body);

} elseif ($method === 'DELETE' && $id !== null) {
    $controller->deletar($id);

} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}

//tudo verificado