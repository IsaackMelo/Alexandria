<?php

require_once '../config/database.php';

class Conteudo {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lista todos os conteúdos
    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM conteudo");
        return $stmt->fetchAll();
    }

    // Busca conteúdo por ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM conteudo WHERE id_conteudo = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Pesquisa pelo título
    public function pesquisar($titulo) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM conteudo WHERE titulo LIKE ?
        ");
        $stmt->execute(["%$titulo%"]);
        return $stmt->fetchAll();
    }

    // Busca conteúdos por matéria
    public function buscarPorMateria($id_materia) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM conteudo WHERE id_materia = ?
        ");
        $stmt->execute([$id_materia]);
        return $stmt->fetchAll();
    }

    // Cria novo conteúdo
    public function criar($titulo, $texto, $fontes) {
        $stmt = $this->pdo->prepare("
            INSERT INTO conteudo (titulo, texto, fontes)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$titulo, $texto, $fontes]);
        return $this->pdo->lastInsertId();
    }

    // Atualiza conteúdo
    public function atualizar($id, $titulo, $texto, $fontes) {
        $stmt = $this->pdo->prepare("
            UPDATE conteudo SET titulo = ?, texto = ?, fontes = ?
            WHERE id_conteudo = ?
        ");
        return $stmt->execute([$titulo, $texto, $fontes, $id]);
    }

    // Deleta conteúdo
    public function deletar($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM conteudo WHERE id_conteudo = ?
        ");
        return $stmt->execute([$id]);
    }
}