<?php

class AuthController {

    private $usuario;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo     = $pdo;
        $this->usuario = new Usuario($pdo);
    }

    public function login($body) {

        if (empty($body['email']) || empty($body['senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Email e senha são obrigatórios"]);
            return;
        }//testado

        $usuario = $this->usuario->buscarPorEmail($body['email']);

        if (!$usuario) {
            http_response_code(401);
            echo json_encode(["erro" => "Email ou senha incorretos"]);
            return;
        }//verificado

        if (!password_verify($body['senha'], $usuario['senha'])) {
            http_response_code(401);
            echo json_encode(["erro" => "Email ou senha incorretos"]);
            return;
        }//verificado

        $token = JWT::gerar([
            'id'    => $usuario['id'],
            'email' => $usuario['email']
        ]);

        echo json_encode([
            "mensagem" => "Login realizado com sucesso!",
            "token"    => $token
        ]);//verificado
    }

    public function cadastro($body) {

        if (empty($body['nome_usu']) || empty($body['email']) || empty($body['senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Nome, email e senha são obrigatórios"]);
            return;
        }//verificado

        $existe = $this->usuario->buscarPorEmail($body['email']);

        if ($existe) {
            http_response_code(409);
            echo json_encode(["erro" => "Email já cadastrado"]);
            return;
        }//verificado

        $this->usuario->cadastrar(
            $body['nome_usu'],
            $body['email'],
            $body['dt_nasc'] ?? null,
            $body['senha']
        );

        http_response_code(201);
        echo json_encode(["mensagem" => "Conta criada com sucesso!"]);//verificado
    }//verificado

    public function logout() {
        AuthMiddleware::verificar($this->pdo);

        echo json_encode(["mensagem" => "Logout realizado com sucesso!"]);
    }//verificado

    public function forgotPassword($body) {

        if (empty($body['email'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Email é obrigatório"]);
            return;
        }//verificado

        $usuario = $this->usuario->buscarPorEmail($body['email']);

        if (!$usuario) {
            echo json_encode(["mensagem" => "Se o email existir, você receberá um link de redefinição"]);
            return;
        }//verificado

        $token = bin2hex(random_bytes(32));

        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->usuario->salvarResetToken($usuario['id'], $token, $expira);

        echo json_encode(["mensagem" => "Se o email existir, você receberá um link de redefinição"]);
    }//testado

    public function resetPassword($body) {

        if (empty($body['token']) || empty($body['nova_senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Token e nova senha são obrigatórios"]);
            return;
        }//verificado

        $usuario = $this->usuario->buscarPorResetToken($body['token']);

        if (!$usuario) {
            http_response_code(400);
            echo json_encode(["erro" => "Token inválido"]);
            return;
        }//verificado

        if (strtotime($usuario['reset_expira']) < time()) {
            http_response_code(400);
            echo json_encode(["erro" => "Token expirado"]);
            return;
        }

        $this->usuario->trocarSenha($usuario['id'], $body['nova_senha']);
        $this->usuario->salvarResetToken($usuario['id'], null, null);

        echo json_encode(["mensagem" => "Senha redefinida com sucesso!"]);
    }//verificado
}

//tudo certo