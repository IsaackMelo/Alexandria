<?php

require_once '../utils/JWT.php';
require_once '../config/database.php';
require_once '../models/Usuario.php';

class AdminMiddleware {

    public static function verificar($pdo) {

        // Pega o token do header
        $token = JWT::pegarToken();

        // Se não tiver token, bloqueia o acesso
        if (!$token) {
            http_response_code(401);
            echo json_encode(["erro" => "Acesso não autorizado"]);
            exit;
        }

        // Valida o token
        $dados = JWT::validar($token);

        // Se o token for inválido ou expirado, bloqueia
        if (!$dados) {
            http_response_code(401);
            echo json_encode(["erro" => "Token inválido ou expirado"]);
            exit;
        }

        // Verifica se o usuário existe no banco
        $usuarioModel = new Usuario($pdo);
        $usuario = $usuarioModel->buscarPorId($dados['id']);

        if (!$usuario) {
            http_response_code(401);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            exit;
        }

        // Verifica se o usuário é admin
        if ($usuario['tipo'] !== 'admin') {
            http_response_code(403);
            echo json_encode(["erro" => "Acesso negado"]);
            exit;
        }

        return $dados;
    }
}