<?php

require_once '../config/database.php';
require_once '../models/Plano.php';

class PlanoController {

    private $plano;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo   = $pdo;
        $this->plano = new Plano($pdo);
    }


    public function listar() {
 
        header('Content-Type: application/json; charset=utf-8');
        
        $planos = $this->plano->listar();
        echo json_encode($planos);
    }

    public function buscar($id) {
        header('Content-Type: application/json; charset=utf-8');

        // Validação básica para garantir que o ID é um número
        if (!$id || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["erro" => "ID inválido informado"]);
            return;
        }

        $plano = $this->plano->buscarPorId($id);

        if (!$plano) {
            http_response_code(404);
            echo json_encode(["erro" => "Plano não encontrado"]);
            return;
        }

        echo json_encode($plano);
    }
}

//Verificação