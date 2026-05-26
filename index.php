<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Pega a URL e o método da requisição
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

// Rotas de autenticação
if (str_starts_with($uri, '/auth/') && $method === 'POST') {
    require_once 'routes/auth.php';

// Rotas do usuário
} elseif (str_starts_with($uri, '/me') && in_array($method, ['GET', 'PUT', 'DELETE'])) {
    require_once 'routes/usuario.php';

// Rotas de conteúdo
} elseif (str_starts_with($uri, '/conteudos') && in_array($method, ['GET', 'POST', 'PUT'])) {
    require_once 'routes/conteudo.php';

// Rotas de simulado
} elseif (str_starts_with($uri, '/simulados') && in_array($method, ['GET', 'POST'])) {
    require_once 'routes/simulado.php';

// Rotas de questão
} elseif (str_starts_with($uri, '/questoes') && in_array($method, ['POST', 'PUT', 'DELETE'])) {
    require_once 'routes/questao.php';

// Rota de contato
} elseif ($uri === '/contato' && $method === 'POST') {
    require_once 'routes/contato.php';

// Rota da IA
} elseif ($uri === '/ia/feedback' && $method === 'POST') {
    require_once 'routes/ia.php';

// Rota não encontrada
} else {
    http_response_code(404);
    echo json_encode(["erro" => "Rota não encontrada"]);
}