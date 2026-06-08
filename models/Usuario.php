<?php

require_once '../config/database.php';

class Usuario {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Cadastra novo usuário
    public function cadastrar($nome, $email, $dt_nasc, $senha) {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuario (nome_usu, email, dt_nasc, senha)
            VALUES (?, ?, ?, ?)
        ");
        // Criptografa a senha antes de salvar
        return $stmt->execute([$nome, $email, $dt_nasc, password_hash($senha, PASSWORD_BCRYPT)]);
    }

    // Busca usuário por email para login
    public function buscarPorEmail($email) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM usuario WHERE email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Busca usuário por ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM usuario WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Atualiza perfil
    public function atualizar($id, $nome, $email, $dt_nasc) {
        $stmt = $this->pdo->prepare("
            UPDATE usuario SET nome_usu = ?, email = ?, dt_nasc = ?
            WHERE id = ?
        ");
        return $stmt->execute([$nome, $email, $dt_nasc, $id]);
    }

    // Troca senha
    public function trocarSenha($id, $nova_senha) {
        $stmt = $this->pdo->prepare("
            UPDATE usuario SET senha = ? WHERE id = ?
        ");
        return $stmt->execute([password_hash($nova_senha, PASSWORD_BCRYPT), $id]);
    }

    // Deleta conta
    public function deletar($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM usuario WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
}