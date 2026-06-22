<?php

require_once '../config/database.php';
require_once '../models/Questao.php';
require_once '../middlewares/AdminMiddleware.php';

class QuestaoController {

    private $questao;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo     = $pdo;
        $this->questao = new Questao($pdo);
    }

    // Admin lista todas as questões
    public function listar() {
        AdminMiddleware::verificar($this->pdo);

        $questoes = $this->questao->listarTodos();

        echo json_encode($questoes);
    }

    // Admin cria uma nova questão
    public function criar($body) {
        AdminMiddleware::verificar($this->pdo);

        if (empty($body['enunciado']) || empty($body['alt_correta'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Enunciado e alternativa correta são obrigatórios"]);
            return;
        }

        $id = $this->questao->criar(
            $body['enunciado'],
            $body['origem_quest']      ?? null,
            $body['nivel_dificuldade'] ?? null,
            $body['alt_correta'],
            $body['id_materia']        ?? null
        );

        http_response_code(201);
        echo json_encode([
            "mensagem" => "Questão criada com sucesso!",
            "id_quest" => $id
        ]);
    }

    // Admin atualiza uma questão
    public function atualizar($id, $body) {
        AdminMiddleware::verificar($this->pdo);

        $questao = $this->questao->buscarPorId($id);

        if (!$questao) {
            http_response_code(404);
            echo json_encode(["erro" => "Questão não encontrada"]);
            return;
        }

        $this->questao->atualizar(
            $id,
            $body['enunciado']         ?? $questao['enunciado'],
            $body['origem_quest']      ?? $questao['origem_quest'],
            $body['nivel_dificuldade'] ?? $questao['nivel_dificuldade'],
            $body['alt_correta']       ?? $questao['alt_correta'],
            $body['id_materia']        ?? $questao['id_materia']
        );

        echo json_encode(["mensagem" => "Questão atualizada com sucesso!"]);
    }

    // Admin deleta uma questão
    public function deletar($id) {
        AdminMiddleware::verificar($this->pdo);

        $questao = $this->questao->buscarPorId($id);

        if (!$questao) {
            http_response_code(404);
            echo json_encode(["erro" => "Questão não encontrada"]);
            return;
        }

        $this->questao->deletar($id);

        echo json_encode(["mensagem" => "Questão deletada com sucesso!"]);
    }
}