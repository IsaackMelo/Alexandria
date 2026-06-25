<?php

class Plano {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM plano");
        return $stmt->fetchAll();
    }

    public function buscarPorId($id_plano) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM plano WHERE id_plano = ?
        ");
        $stmt->execute([$id_plano]);
        return $stmt->fetch();
    }
}