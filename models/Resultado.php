<?php

class Resultado {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Salva resultado do simulado
    public function salvar($nota_final, $id_usuario, $id_simulado) {
        $stmt = $this->pdo->prepare("
            INSERT INTO resultado (nota_final, dt_realizacao, id_usuario, id_simulado)
            VALUES (?, NOW(), ?, ?)
        ");
        return $stmt->execute([$nota_final, $id_usuario, $id_simulado]);
    }

    // Busca resultado por ID
    public function buscarPorId($id_resultado) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_resultado = ?
        ");
        $stmt->execute([$id_resultado]);
        return $stmt->fetch();
    }

    // Busca todos resultados de usuário
    public function buscarPorUsuario($id_usuario) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_usuario = ?
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    // Busca todos resultados de simulado
    public function buscarPorSimulado($id_simulado) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_simulado = ?
        ");
        $stmt->execute([$id_simulado]);
        return $stmt->fetchAll();
    }
}