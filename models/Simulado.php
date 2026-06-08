<?php

class Simulado {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Listar todos os simulados
    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM simulado ORDER BY dt_cria DESC");
        return $stmt->fetchAll();
    }

    // Buscar um simulado pelo ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM simulado WHERE id_simulado = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Buscar questões do simulado sem o gabarito (para exibir ao usuário)
    public function buscarQuestoes($id_simulado) {
        $stmt = $this->pdo->prepare("
            SELECT q.id_quest, q.enunciado, q.origem_quest, q.nivel_dificuldade
            FROM questao q
            INNER JOIN sim_quest sq ON sq.id_quest = q.id_quest
            WHERE sq.id_simulado = ?
        ");
        $stmt->execute([$id_simulado]);
        return $stmt->fetchAll();
    }

    // Buscar questões com gabarito (para corrigir o simulado)
    public function buscarQuestoesComGabarito($id_simulado) {
        $stmt = $this->pdo->prepare("
            SELECT q.id_quest, q.alt_correta
            FROM questao q
            INNER JOIN sim_quest sq ON sq.id_quest = q.id_quest
            WHERE sq.id_simulado = ?
        ");
        $stmt->execute([$id_simulado]);
        return $stmt->fetchAll();
    }

    // Criar um novo simulado
    public function criar($titulo, $tempo_limite) {
        $stmt = $this->pdo->prepare("
            INSERT INTO simulado (titulo_sim, tempo_limite)
            VALUES (?, ?)
        ");
        $stmt->execute([$titulo, $tempo_limite]);
        return $this->pdo->lastInsertId();
    }

    // Atualizar um simulado
    public function atualizar($id, $titulo, $tempo_limite) {
        $stmt = $this->pdo->prepare("
            UPDATE simulado SET titulo_sim = ?, tempo_limite = ?
            WHERE id_simulado = ?
        ");
        return $stmt->execute([$titulo, $tempo_limite, $id]);
    }

    // Deletar um simulado
    public function deletar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM simulado WHERE id_simulado = ?");
        return $stmt->execute([$id]);
    }
}