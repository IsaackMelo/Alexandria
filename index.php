<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Pega a URL e o método da requisição
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

if (str_starts_with($uri, '/auth/') && $method === 'POST') {
    require_once 'routes/auth.php';

} elseif (str_starts_with($uri, '/me') && in_array($method, ['GET', 'PUT', 'DELETE'])) {
    require_once 'routes/usuario.php';

} elseif (str_starts_with($uri, '/conteudos') && in_array($method, ['GET', 'POST', 'PUT'])) {
    require_once 'routes/conteudo.php';

} elseif (str_starts_with($uri, '/simulados') && in_array($method, ['GET', 'POST'])) {
    require_once 'routes/simulado.php';

} elseif (str_starts_with($uri, '/questoes') && in_array($method, ['POST', 'PUT', 'DELETE'])) {
    require_once 'routes/questao.php';

} elseif ($uri === '/contato' && $method === 'POST') {
    require_once 'routes/contato.php';

} elseif ($uri === '/ia/feedback' && $method === 'POST') {
    require_once 'routes/ia.php';

} elseif (str_starts_with($uri, '/planos') && in_array($method, ['GET'])) {
    require_once 'routes/plano.php';

} elseif (str_starts_with($uri, '/assinaturas') && in_array($method, ['GET', 'DELETE'])) {
    require_once 'routes/assinatura.php';

} elseif (str_starts_with($uri, '/pagamentos') && $method === 'POST') {
    require_once 'routes/pagamento.php';

} else {
    http_response_code(404);
    echo json_encode(["erro" => "Rota não encontrada"]);
}

//verificar