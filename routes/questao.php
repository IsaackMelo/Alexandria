<?php

require_once '../config/database.php';
require_once '../models/Questao.php';
require_once '../middlewares/AdminMiddleware.php';

$questao = new Questao ($pdo);
// id da url
$partes = explode('/', uri);
$id = isset($partes[2]) ? $partes[2] : null;

// admin cria nova questão

if ($method === 'POST' && $id === null){
    $body = json_decode(file_get_contents('php://input'), true);

    // verificação dos campos obrigatórios
    if(empty($body['enunciado'])) {
        http_response_code(400);
        echo json_encode(["erro" => "Enunciado é obrigatório"]);
        exit;
    }

    $id_criada = $questao->criar(
        $body ['enunciado'],
        $body ['origem_quest'] ?? null,
        $body ['nivel_dificuldade'] ?? null,
        $body ['alt_correta'] ?? null,
        $body ['id_materia'] ?? null,
    );

    http_response_code(201);
    echo json_encode([
        "mensagem" => "Questão criada com sucesso!",
        "id_quest" => $id_criada
    ]);

    //admin edita uma questão
} elseif ($method === 'PUT' && $id !== null){
    $body = json_decode(file_get_contents('php://input'), true);

    $atualizado = $questao->atualizar(
        $id,
        $body['enunciado'] ?? null,
        $body['origem_quest'] ?? null,
        $body['nivel_dificuldade'] ?? null,
        $body['alt_correta'] ?? null,
        $body['id_materia'] ?? null
    );

    if(!$atualizado){
        http_response_code(404);
        echo json_encode(["erro" => "Questão não encontrada"]);
        exit;
    }

    echo json_encode(["mensagem" => "Questão atualizada com sucesso!"]);

} elseif ($method === 'DELETE' && id !== null) {
    $deletado = $questao->deletar($id);

    if (!$deletado) {
        http_response_code(404);
        echo json_encode(["erro" => "Questão não encontrada"]);
        exit;
    }

    echo json_encode(["mensagem" => "Questão deletada com sucesso"]);

} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}
