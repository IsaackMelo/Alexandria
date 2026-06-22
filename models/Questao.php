<?php

class Questao {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Listar todas as questões
    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM questao");
        return $stmt->fetchAll();
    }

    // Buscar questão por ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM questao WHERE id_quest = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Criar nova questão
    public function criar($enunciado, $origem_quest, $nivel_dificuldade, $alt_correta, $id_materia) {
        $stmt = $this->pdo->prepare("
            INSERT INTO questao (enunciado, origem_quest, nivel_dificuldade, alt_correta, id_materia)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$enunciado, $origem_quest, $nivel_dificuldade, $alt_correta, $id_materia]);
        return $this->pdo->lastInsertId();
    }

    // Atualizar questão
    public function atualizar($id, $enunciado, $origem_quest, $nivel_dificuldade, $alt_correta, $id_materia) {
        $stmt = $this->pdo->prepare("
            UPDATE questao SET enunciado = ?, origem_quest = ?, nivel_dificuldade = ?, alt_correta = ?, id_materia = ?
            WHERE id_quest = ?
        ");
        return $stmt->execute([$enunciado, $origem_quest, $nivel_dificuldade, $alt_correta, $id_materia, $id]);
    }

    // Deletar questão
    public function deletar($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM questao WHERE id_quest = ?
        ");
        return $stmt->execute([$id]);
    }
}