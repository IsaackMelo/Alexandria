<?php

require_once '../config/database.php';
require_once '../models/Usuario.php';
require_once '../utils/JWT.php';
require_once '../middlewares/AuthMiddleware.php';

class AuthController {

    private $usuario;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo     = $pdo;
        $this->usuario = new Usuario($pdo);
    }

    // Login
    public function login($body) {

        if (empty($body['email']) || empty($body['senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Email e senha são obrigatórios"]);
            return;
        }

        // Busca o usuário pelo email
        $usuario = $this->usuario->buscarPorEmail($body['email']);

        if (!$usuario) {
            http_response_code(401);
            echo json_encode(["erro" => "Email ou senha incorretos"]);
            return;
        }

        // Verifica se a senha está correta
        if (!password_verify($body['senha'], $usuario['senha'])) {
            http_response_code(401);
            echo json_encode(["erro" => "Email ou senha incorretos"]);
            return;
        }

        // Gera o token JWT
        $token = JWT::gerar([
            'id'    => $usuario['id'],
            'email' => $usuario['email']
        ]);

        echo json_encode([
            "mensagem" => "Login realizado com sucesso!",
            "token"    => $token
        ]);
    }

    // Cadastro
    public function cadastro($body) {

        if (empty($body['nome_usu']) || empty($body['email']) || empty($body['senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Nome, email e senha são obrigatórios"]);
            return;
        }

        // Verifica se o email já está cadastrado
        $existe = $this->usuario->buscarPorEmail($body['email']);

        if ($existe) {
            http_response_code(409);
            echo json_encode(["erro" => "Email já cadastrado"]);
            return;
        }

        $this->usuario->cadastrar(
            $body['nome_usu'],
            $body['email'],
            $body['dt_nasc'] ?? null,
            $body['senha']
        );

        http_response_code(201);
        echo json_encode(["mensagem" => "Conta criada com sucesso!"]);
    }

    // Logout
    public function logout() {
        AuthMiddleware::verificar($this->pdo);

        echo json_encode(["mensagem" => "Logout realizado com sucesso!"]);
    }

    // Solicitar redefinição de senha
    public function forgotPassword($body) {

        if (empty($body['email'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Email é obrigatório"]);
            return;
        }

        $usuario = $this->usuario->buscarPorEmail($body['email']);

        // Não revela se o email existe ou não por segurança
        if (!$usuario) {
            echo json_encode(["mensagem" => "Se o email existir, você receberá um link de redefinição"]);
            return;
        }

        // Gera um token aleatório
        $token = bin2hex(random_bytes(32));

        // Token expira em 1 hora
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Salva o token no banco
        $this->usuario->salvarResetToken($usuario['id'], $token, $expira);

        echo json_encode(["mensagem" => "Se o email existir, você receberá um link de redefinição"]);
    }

    // Redefinir senha com token
    public function resetPassword($body) {

        if (empty($body['token']) || empty($body['nova_senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Token e nova senha são obrigatórios"]);
            return;
        }

        // Busca o usuário pelo token
        $usuario = $this->usuario->buscarPorResetToken($body['token']);

        if (!$usuario) {
            http_response_code(400);
            echo json_encode(["erro" => "Token inválido"]);
            return;
        }

        // Verifica se o token expirou
        if (strtotime($usuario['reset_expira']) < time()) {
            http_response_code(400);
            echo json_encode(["erro" => "Token expirado"]);
            return;
        }

        // Troca a senha e limpa o token
        $this->usuario->trocarSenha($usuario['id'], $body['nova_senha']);
        $this->usuario->salvarResetToken($usuario['id'], null, null);

        echo json_encode(["mensagem" => "Senha redefinida com sucesso!"]);
    }
}