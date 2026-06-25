<?php

require_once '../config/database.php';
require_once '../models/Conteudo.php';
require_once '../middlewares/AdminMiddleware.php';
require_once '../middlewares/PlanoMiddleware.php';

class ConteudoController {

    private $conteudo;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo      = $pdo;
        $this->conteudo = new Conteudo($pdo);
    }

    public function listar() {
        PlanoMiddleware::verificar($this->pdo, ['basico', 'avancado', 'premium']);

        $conteudos = $this->conteudo->listar();

        echo json_encode($conteudos);
    }

    public function buscar($id) {
        PlanoMiddleware::verificar($this->pdo, ['basico', 'avancado', 'premium']);

        $conteudo = $this->conteudo->buscarPorId($id);

        if (!$conteudo) {
            http_response_code(404);
            echo json_encode(["erro" => "Conteúdo não encontrado"]);
            return;
        }

        echo json_encode($conteudo);
    }

    public function pesquisar($titulo) {
        PlanoMiddleware::verificar($this->pdo, ['basico', 'avancado', 'premium']);

        $conteudos = $this->conteudo->pesquisar($titulo);

        if (empty($conteudos)) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhum conteúdo encontrado"]);
            return;
        }

        echo json_encode($conteudos);
    }

    public function buscarPorMateria($id_materia) {
        PlanoMiddleware::verificar($this->pdo, ['basico', 'avancado', 'premium']);

        $conteudos = $this->conteudo->buscarPorMateria($id_materia);

        if (empty($conteudos)) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhum conteúdo encontrado para essa matéria"]);
            return;
        }

        echo json_encode($conteudos);
    }

    public function criar($body) {
        AdminMiddleware::verificar($this->pdo);

        if (empty($body['titulo']) || empty($body['texto'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Título e texto são obrigatórios"]);
            return;
        }

        $id = $this->conteudo->criar(
            $body['titulo'],
            $body['texto'],
            $body['fontes'] ?? null
        );

        http_response_code(201);
        echo json_encode([
            "mensagem"    => "Conteúdo criado com sucesso!",
            "id_conteudo" => $id
        ]);
    }

    public function atualizar($id, $body) {
        AdminMiddleware::verificar($this->pdo);

        $conteudo = $this->conteudo->buscarPorId($id);

        if (!$conteudo) {
            http_response_code(404);
            echo json_encode(["erro" => "Conteúdo não encontrado"]);
            return;
        }
    }
}
