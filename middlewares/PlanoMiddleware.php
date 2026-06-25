<?php

require_once '../middlewares/AuthMiddleware.php';
require_once '../models/Assinatura.php';

class PlanoMiddleware {

    public static function verificar($pdo, $planos_permitidos) {

        $usuario = AuthMiddleware::verificar($pdo);

        $assinaturaModel = new Assinatura($pdo);
        $assinatura = $assinaturaModel->buscarAtiva($usuario['id']);

        if (!$assinatura) {
            http_response_code(403);
            echo json_encode(["erro" => "Você precisa de uma assinatura para acessar esse conteúdo"]);
            exit;
        }

        if (!in_array($assinatura['nome_plano'], $planos_permitidos)) {
            http_response_code(403);
            echo json_encode(["erro" => "Seu plano não permite acesso a esse conteúdo"]);
            exit;
        }

        return $usuario;
    }
}