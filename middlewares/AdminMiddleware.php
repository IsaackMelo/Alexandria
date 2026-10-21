<?php

class AdminMiddleware {

    public static function verificar($pdo) {

        $token = JWT::pegarToken();

        if (!$token) {
            http_response_code(401);
            echo json_encode(["erro" => "Acesso não autorizado"]);
            exit;
        }

        $dados = JWT::validar($token);

        if (!$dados) {
            http_response_code(401);
            echo json_encode(["erro" => "Token inválido ou expirado"]);
            exit;
        }

        $usuarioModel = new Usuario($pdo);
        $usuario = $usuarioModel->buscarPorId($dados['id']);

        if (!$usuario) {
            http_response_code(401);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            exit;
        }

        if ($usuario['tipo'] !== 'admin') {
            http_response_code(403);
            echo json_encode(["erro" => "Acesso negado"]);
            exit;
        }

        return $dados;
    }
}