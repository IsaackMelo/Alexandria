<?php

require_once '../config/database.php';
require_once '../models/Conteudo.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../middlewares/AdminMiddleware.php';

class ConteudoController {

    private $conteudo;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo      = $pdo;
        $this->conteudo = new Conteudo($pdo);
    }

    // Lista todos os conteúdos
    public function listar() {
        AuthMiddleware::verificar($this->pdo);

        $conteudos = $this->conteudo->listar();

        echo json_encode($conteudos);
    }

    // Busca um conteúdo pelo ID
    public function buscar($id) {
        AuthMiddleware::verificar($this->pdo);

        $conteudo = $this->conteudo->buscarPorId($id);

        if (!$conteudo) {
            http_response_code(404);
            echo json_encode(["erro" => "Conteúdo não encontrado"]);
            return;
        }

        echo json_encode($conteudo);
    }

    // Pesquisa conteúdos pelo título
    public function pesquisar($titulo) {
        AuthMiddleware::verificar($this->pdo);

        $conteudos = $this->conteudo->pesquisar($titulo);

        if (empty($conteudos)) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhum conteúdo encontrado"]);
            return;
        }

        echo json_encode($conteudos);
    }

    // Busca conteúdos por matéria
    public function buscarPorMateria($id_materia) {
        AuthMiddleware::verificar($this->pdo);

        $conteudos = $this->conteudo->buscarPorMateria($id_materia);

        if (empty($conteudos)) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhum conteúdo encontrado para essa matéria"]);
            return;
        }

        echo json_encode($conteudos);
    }

    // Admin cria um novo conteúdo
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

    // Admin atualiza um conteúdo
    public function atualizar($id, $body) {
        AdminMiddleware::verificar($this->pdo);

        $conteudo = $this->conteudo->buscarPorId($id);

        if (!$conteudo) {
            http_response_code(404);
            echo json_encode(["erro" => "Conteúdo não encontrado"]);
            return;
        }

        $this->conteudo->atualizar(
            $id,
            $body['titulo'] ?? $conteudo['titulo'],
            $body['texto']  ?? $conteudo['texto'],
            $body['fontes'] ?? $conteudo['fontes']
        );

        echo json_encode(["mensagem" => "Conteúdo atualizado com sucesso!"]);
    }

    // Admin deleta um conteúdo
    public function deletar($id) {
        AdminMiddleware::verificar($this->pdo);

        $conteudo = $this->conteudo->buscarPorId($id);

        if (!$conteudo) {
            http_response_code(404);
            echo json_encode(["erro" => "Conteúdo não encontrado"]);
            return;
        }

        $this->conteudo->deletar($id);

        echo json_encode(["mensagem" => "Conteúdo deletado com sucesso!"]);
    }
}