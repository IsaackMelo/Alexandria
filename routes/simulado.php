<?php

require_once '../config/database.php';
require_once '../models/Simulado.php';
require_once '../middlewares/AuthMiddleware.php';

$simulado = new Simulado($pdo);

// Pega o ID da URL ex: /simulados/1
$partes = explode('/', $uri);
$id = isset($partes[2]) ? $partes[2] : null;

// listar todos os simulados
if ($method === 'GET' && $id === null) {
    $simulados = $simulado->listarTodos();
    echo json_encode($simulados);

// abrir um simulado
} elseif ($method === 'GET' && $id !== null) {
    $resultado = $simulado->buscarPorId($id);

    if (!$resultado) {
        http_response_code(404);
        echo json_encode(["erro" => "Simulado não encontrado"]);
        exit;
    }

    // Busca as questões do simulado também
    $questoes = $simulado->buscarQuestoes($id);
    $resultado['questoes'] = $questoes;

    echo json_encode($resultado);

// entregar simulado
} elseif ($method === 'POST' && isset($partes[3]) && $partes[3] === 'entregar') {
    $body = json_decode(file_get_contents('php://input'), true);
    echo json_encode(["mensagem" => "Simulado entregue com sucesso!"]);

// Método não permitido
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}
