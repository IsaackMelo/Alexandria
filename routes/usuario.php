<?php

require_once '../controllers/UsuarioController.php';

$controller = new UsuarioController($pdo);

// Pega os dados enviados em JSON
$body = json_decode(file_get_contents('php://input'), true);

// retorna dados do usuário logado
if ($uri === '/me' && $method === 'GET') {
    $controller->perfil();

// atualiza perfil do usuário logado
} elseif ($uri === '/me' && $method === 'PUT') {
    $controller->atualizar($body);

// deleta conta do usuário logado
} elseif ($uri === '/me' && $method === 'DELETE') {
    $controller->deletarConta();

// troca a senha estando logado
} elseif ($uri === '/me/password' && $method === 'PUT') {
    $controller->trocarSenha($body);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}