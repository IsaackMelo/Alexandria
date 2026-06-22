<?php

class Usuario {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Cadastrar novo usuário
    public function cadastrar($nome, $email, $dt_nasc, $senha) {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuario (nome_usu, email, dt_nasc, senha)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$nome, $email, $dt_nasc, password_hash($senha, PASSWORD_BCRYPT)]);
    }

    // Buscar usuário por email para login
    public function buscarPorEmail($email) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM usuario WHERE email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Buscar usuário por ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM usuario WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Atualizar perfil
    public function atualizar($id, $nome, $email, $dt_nasc) {
        $stmt = $this->pdo->prepare("
            UPDATE usuario SET nome_usu = ?, email = ?, dt_nasc = ?
            WHERE id = ?
        ");
        return $stmt->execute([$nome, $email, $dt_nasc, $id]);
    }

    // Trocar senha
    public function trocarSenha($id, $nova_senha) {
        $stmt = $this->pdo->prepare("
            UPDATE usuario SET senha = ? WHERE id = ?
        ");
        return $stmt->execute([password_hash($nova_senha, PASSWORD_BCRYPT), $id]);
    }

    // Salvar token de reset de senha
    public function salvarResetToken($id, $token, $expira) {
        $stmt = $this->pdo->prepare("
            UPDATE usuario SET reset_token = ?, reset_expira = ?
            WHERE id = ?
        ");
        return $stmt->execute([$token, $expira, $id]);
    }

    // Buscar usuário pelo token de reset
    public function buscarPorResetToken($token) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM usuario WHERE reset_token = ?
        ");
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    // Deletar conta
    public function deletar($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM usuario WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
}