<?php

// IMPORTANTE: Certifique-se de que o database.php é incluído para que a variável $pdo exista!
require_once '../config/database.php'; 
require_once '../controllers/PlanoController.php';

$controller = new PlanoController($pdo);

// Filtra a URI para remover barras vazias nas pontas
$uriLimpa = trim($uri, '/');
$partes = explode('/', $uriLimpa);

// Pega o ID apenas se ele for numérico (evita pegar strings acidentalmente)
$id = (isset($partes[1]) && is_numeric($partes[1])) ? (int)$partes[1] : null;

// GET /planos → lista todos os planos
if ($method === 'GET' && $id === null) {
    $controller->listar();

// GET /planos/{id} → busca um plano específico
} elseif ($method === 'GET' && $id !== null) {
    $controller->buscar($id);

// Método não permitido
} else {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}
//verficar