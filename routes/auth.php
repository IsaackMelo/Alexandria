<?php

$controller = new AuthController($pdo);

$body = json_decode(file_get_contents('php://input'), true);

if ($uri === '/auth/login' && $method === 'POST') {
    $controller->login($body); //testado

} elseif ($uri === '/auth/register' && $method === 'POST') {
    $controller->cadastro($body); //testado

} elseif ($uri === '/auth/logout' && $method === 'POST') {
    $controller->logout();//testado

} elseif ($uri === '/auth/forgot-password' && $method === 'POST') {
    $controller->forgotPassword($body);//testado

} elseif ($uri === '/auth/reset-password' && $method === 'POST') {
    $controller->resetPassword($body);//testado

} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);//testado
}

//tudo certo