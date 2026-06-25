<?php

require_once '../config/database.php';
require_once '../models/Contato.php';

class ContatoController {

    private $contato;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo     = $pdo;
        $this->contato = new Contato($pdo);
    }

    public function enviar($body) {

        if (empty($body['nome']) || empty($body['email']) || empty($body['assunto']) || empty($body['mensagem'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
            return;
        }

        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["erro" => "Email inválido"]);
            return;
        }

        $this->contato->salvar(
            $body['nome'],
            $body['email'],
            $body['assunto'],
            $body['mensagem']
        );

        echo json_encode(["mensagem" => "Mensagem enviada com sucesso!"]);
    }
}