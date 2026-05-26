<?php

require_once '../controllers/AuthController.php';

$controller = new AuthController($pdo);

// Pega os dados enviados em JSON
$body = json_decode(file_get_contents('php://input'), true);

// Rota de login
if ($uri === '/auth/login' && $method === 'POST') {
    $controller->login($body);

// Rota de cadastro
} elseif ($uri === '/auth/register' && $method === 'POST') {
    $controller->cadastro($body);

// Rota de logout
} elseif ($uri === '/auth/logout' && $method === 'POST') {
    $controller->logout();

// Rota para solicitar troca de senha
} elseif ($uri === '/auth/forgot-password' && $method === 'POST') {
    $controller->forgotPassword($body);

// Rota para redefinir senha com token
} elseif ($uri === '/auth/reset-password' && $method === 'POST') {
    $controller->resetPassword($body);

// Rota não encontrada
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}