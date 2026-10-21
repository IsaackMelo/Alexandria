<?php

class Contato {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvar($nome, $email, $assunto, $mensagem) {
        $stmt = $this->pdo->prepare("
            INSERT INTO contato (nome, email, assunto, mensagem)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$nome, $email, $assunto, $mensagem]);
    }
}