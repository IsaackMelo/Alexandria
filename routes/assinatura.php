<?php

$controller = new AssinaturaController($pdo);

$method = $_SERVER['REQUEST_METHOD'];

$pathInfo = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
$partes = explode('/', ltrim($uri, '/'));
$acao = isset($partes[1]) ? $partes[1] : null;

if ($method === 'GET' && $acao === 'me') {
    $controller->buscarAtiva();//verificado

} elseif ($method === 'DELETE' && $acao === 'me') {
    $controller->cancelar();//verificado

} else {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido ou rota inválida"]);
}

//tudo verificado