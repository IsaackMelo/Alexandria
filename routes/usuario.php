<?php

$controller = new UsuarioController($pdo);

$body = json_decode(file_get_contents('php://input'), true);

if ($uri === '/me' && $method === 'GET') {
    $controller->perfil();//verificado

} elseif ($uri === '/me' && $method === 'PUT') {
    $controller->atualizar($body);//verificado

} elseif ($uri === '/me' && $method === 'DELETE') {
    $controller->deletarConta();//verificado

} elseif ($uri === '/me/password' && $method === 'PUT') {
    $controller->trocarSenha($body);//verificado

} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}

//verificado