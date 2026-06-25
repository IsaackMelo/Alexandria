<?php

class Assinatura {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarAtiva($id_usuario) {
        $stmt = $this->pdo->prepare("
            SELECT a.*, p.nome as nome_plano, p.preco
            FROM assinatura a
            INNER JOIN plano p ON p.id_plano = a.id_plano
            WHERE a.id_usuario = ?
            AND a.status = 'ativa'
            AND a.dt_expiracao > NOW()
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch();
    }

    public function criar($id_usuario, $id_plano) {
        $stmt = $this->pdo->prepare("
            INSERT INTO assinatura (id_usuario, id_plano, dt_inicio, dt_expiracao, status)
            VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH), 'ativa')
        ");
        $stmt->execute([$id_usuario, $id_plano]);
        return $this->pdo->lastInsertId();
    }

    public function cancelar($id_assinatura) {
        $stmt = $this->pdo->prepare("
            UPDATE assinatura SET status = 'cancelada'
            WHERE id_assinatura = ?
        ");
        return $stmt->execute([$id_assinatura]);
    }

    public function buscarPorId($id_assinatura) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM assinatura WHERE id_assinatura = ?
        ");
        $stmt->execute([$id_assinatura]);
        return $stmt->fetch();
    }
}