<?php

class Resultado {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Salvar resultado após entregar o simulado
    public function salvar($nota_final, $id_usuario, $id_simulado) {
        $stmt = $this->pdo->prepare("
            INSERT INTO resultado (nota_final, dt_realizacao, id_usuario, id_simulado)
            VALUES (?, NOW(), ?, ?)
        ");
        $stmt->execute([$nota_final, $id_usuario, $id_simulado]);

        // Retorna o ID do resultado criado
        return $this->pdo->lastInsertId();
    }

    // Buscar um resultado específico pelo ID
    public function buscarPorId($id_resultado) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_resultado = ?
        ");
        $stmt->execute([$id_resultado]);
        return $stmt->fetch();
    }

    // Buscar todos os resultados de um usuário
    public function buscarPorUsuario($id_usuario) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_usuario = ?
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    // Buscar todos os resultados de um simulado
    public function buscarPorSimulado($id_simulado) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_simulado = ?
        ");
        $stmt->execute([$id_simulado]);
        return $stmt->fetchAll();
    }

    // Buscar resultado por usuário e simulado
    public function buscarPorUsuarioESimulado($id_usuario, $id_simulado) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resultado WHERE id_usuario = ? AND id_simulado = ?
        ");
        $stmt->execute([$id_usuario, $id_simulado]);
        return $stmt->fetch();
    }

    // Salvar resposta individual
    public function salvarResposta($id_resultado, $id_quest, $alt_escolhida, $acertou) {
        $stmt = $this->pdo->prepare("
            INSERT INTO resposta (id_resultado, id_quest, alt_escolhida, acertou)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$id_resultado, $id_quest, $alt_escolhida, $acertou]);
    }

    // Buscar respostas de um resultado
    public function buscarRespostas($id_resultado) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM resposta WHERE id_resultado = ?
        ");
        $stmt->execute([$id_resultado]);
        return $stmt->fetchAll();
    }
}