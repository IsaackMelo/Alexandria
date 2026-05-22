<?php

header('Content-Type: application/json');


header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$method = $_SERVER['REQUEST_METHOD'];


$uri = rtrim($uri, '/');

require_once 'database.php';
require_once 'Usuario.php';
require_once 'Conteudo.php';
require_once 'Questao.php';


if ($uri === '/auth/register' && $method === 'POST') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Usuario::cadastrar($dados);
    echo json_encode($resultado);

} elseif ($uri === '/auth/login' && $method === 'POST') {
   
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Usuario::login($dados);
    echo json_encode($resultado);

} elseif ($uri === '/auth/logout' && $method === 'POST') {
  
    $resultado = Usuario::logout();
    echo json_encode($resultado);

} elseif ($uri === '/auth/forgot-password' && $method === 'POST') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Usuario::esqueceuSenha($dados);
    echo json_encode($resultado);

} elseif ($uri === '/auth/reset-password' && $method === 'POST') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Usuario::redefinirSenha($dados);
    echo json_encode($resultado);


} elseif ($uri === '/me' && $method === 'GET') {
    
    $resultado = Usuario::buscarPerfil();
    echo json_encode($resultado);

} elseif ($uri === '/me' && $method === 'PUT') {
   
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Usuario::atualizarPerfil($dados);
    echo json_encode($resultado);

} elseif ($uri === '/me' && $method === 'DELETE') {
    
    $resultado = Usuario::apagarConta();
    echo json_encode($resultado);

} elseif ($uri === '/me/password' && $method === 'PUT') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Usuario::trocarSenha($dados);
    echo json_encode($resultado);



} elseif ($uri === '/conteudos' && $method === 'GET') {
   
    $resultado = Conteudo::listar();
    echo json_encode($resultado);

} elseif (preg_match('/^\/conteudos\/(\d+)$/', $uri, $matches) && $method === 'GET') {
  
    $id = (int) $matches[1];
    $resultado = Conteudo::buscarPorId($id);
    echo json_encode($resultado);

} elseif ($uri === '/conteudos' && $method === 'POST') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Conteudo::criar($dados);
    echo json_encode($resultado);

} elseif (preg_match('/^\/conteudos\/(\d+)$/', $uri, $matches) && $method === 'PUT') {
    
    $id = (int) $matches[1];
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Conteudo::atualizar($id, $dados);
    echo json_encode($resultado);



} elseif ($uri === '/simulados' && $method === 'GET') {

    $resultado = Questao::listarSimulados();
    echo json_encode($resultado);

} elseif (preg_match('/^\/simulados\/(\d+)$/', $uri, $matches) && $method === 'GET') {

    $id = (int) $matches[1];
    $resultado = Questao::buscarSimulado($id);
    echo json_encode($resultado);

} elseif (preg_match('/^\/simulados\/(\d+)\/entregar$/', $uri, $matches) && $method === 'POST') {
    
    $id = (int) $matches[1];
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Questao::entregarSimulado($id, $dados);
    echo json_encode($resultado);



} elseif ($uri === '/questoes' && $method === 'POST') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Questao::criar($dados);
    echo json_encode($resultado);

} elseif (preg_match('/^\/questoes\/(\d+)$/', $uri, $matches) && $method === 'PUT') {
    
    $id = (int) $matches[1];
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Questao::atualizar($id, $dados);
    echo json_encode($resultado);

} elseif (preg_match('/^\/questoes\/(\d+)$/', $uri, $matches) && $method === 'DELETE') {
   
    $id = (int) $matches[1];
    $resultado = Questao::apagar($id);
    echo json_encode($resultado);



} elseif ($uri === '/ia/feedback' && $method === 'POST') {
    
    $dados = json_decode(file_get_contents('php://input'), true);
    $resultado = Questao::feedbackIA($dados);
    echo json_encode($resultado);



} else {
    http_response_code(404); 
    echo json_encode(["erro" => "Rota não encontrada"]);
}
