<?php

require_once '../config/database.php';
require_once '../models/Assinatura.php';
require_once '../middlewares/AuthMiddleware.php';

class AssinaturaController {

    private $assinatura;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo        = $pdo;
        $this->assinatura = new Assinatura($pdo);
    }

    public function buscarAtiva() {
        header('Content-Type: application/json; charset=utf-8');

        $usuario = AuthMiddleware::verificar($this->pdo);

        $assinatura = $this->assinatura->buscarAtiva($usuario['id']);

        if (!$assinatura) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhuma assinatura ativa encontrada"]);
            return;
        }

        echo json_encode($assinatura);
    }

    public function cancelar() {
        header('Content-Type: application/json; charset=utf-8');

        $usuario = AuthMiddleware::verificar($this->pdo);

        $assinatura = $this->assinatura->buscarAtiva($usuario['id']);

        if (!$assinatura) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhuma assinatura ativa encontrada"]);
            return;
        }

        // Verifique se a chave correta é 'id_assinatura' ou apenas 'id'
        $idAssinatura = $assinatura['id_assinatura'] ?? $assinatura['id'];

        $this->assinatura->cancelar($idAssinatura);

        echo json_encode(["mensagem" => "Assinatura cancelada com sucesso!"]);
    }
}

//verificação