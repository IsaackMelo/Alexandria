<?php

class Conteudo {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM conteudo");
        return $stmt->fetchAll();
    }//verificado

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM conteudo WHERE id_conteudo = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }//verificado

    public function pesquisar($titulo) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM conteudo WHERE titulo LIKE ?
        ");
        $stmt->execute(["%$titulo%"]);
        return $stmt->fetchAll();
    }//verificado

    public function buscarPorMateria($id_materia) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM conteudo WHERE id_materia = ?
        ");
        $stmt->execute([$id_materia]);
        return $stmt->fetchAll();
    }//verificado

    public function criar($titulo, $texto, $fontes) {
        $stmt = $this->pdo->prepare("
            INSERT INTO conteudo (titulo, texto, fontes)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$titulo, $texto, $fontes]);
        return $this->pdo->lastInsertId();
    }//verificado

    public function atualizar($id, $titulo, $texto, $fontes) {
        $stmt = $this->pdo->prepare("
            UPDATE conteudo SET titulo = ?, texto = ?, fontes = ?
            WHERE id_conteudo = ?
        ");
        return $stmt->execute([$titulo, $texto, $fontes, $id]);
    }//verificado

    public function deletar($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM conteudo WHERE id_conteudo = ?
        ");
        return $stmt->execute([$id]);
    }//verificado
}

//tudo certo