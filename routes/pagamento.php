<?php

$controller = new PagamentoController($pdo);

$partes = explode('/', $uri);
$body   = json_decode(file_get_contents('php://input'), true);

if ($method === 'POST' && isset($partes[2]) && $partes[2] === 'processar') {
    $controller->processar($body);

} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}

//tudo verificado