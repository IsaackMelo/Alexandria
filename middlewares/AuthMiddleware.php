<?php

class AuthMiddleware {

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

        $usuario = new Usuario($pdo);
        $existe = $usuario->buscarPorId($dados['id']);

        if (!$existe) {
            http_response_code(401);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            exit;
        }
o
        return $dados;
    }
}