<?php

require_once '../config/database.php';
require_once '../models/Plano.php';
require_once '../models/Assinatura.php';
require_once '../middlewares/AuthMiddleware.php';

class PagamentoController {

    private $plano;
    private $assinatura;
    private $pdo;

    private $metodos_aceitos = ['cartao', 'pix', 'boleto'];

    public function __construct($pdo) {
        $this->pdo        = $pdo;
        $this->plano      = new Plano($pdo);
        $this->assinatura = new Assinatura($pdo);
    }

    // Processa o pagamento e ativa a assinatura
    public function processar($body) {
   
        header('Content-Type: application/json; charset=utf-8');

        $usuario = AuthMiddleware::verificar($this->pdo);

        if (empty($body['id_plano']) || empty($body['metodo'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Plano e método de pagamento são obrigatórios"]);
            return;
        }

     
        if (!in_array($body['metodo'], $this->metodos_aceitos)) {
            http_response_code(400);
            echo json_encode(["erro" => "Método de pagamento inválido"]);
            return;
        }

      
        $plano = $this->plano->buscarPorId($body['id_plano']);

        if (!$plano) {
            http_response_code(404);
            echo json_encode(["erro" => "Plano não encontrado"]);
            return;
        }

   
        $assinaturaAtiva = $this->assinatura->buscarAtiva($usuario['id']);

        if ($assinaturaAtiva) {
            http_response_code(400);
            echo json_encode(["erro" => "Você já possui uma assinatura ativa"]);
            return;
        }


        $pagamento = $this->simularPagamento($body['metodo'], $plano['preco']);

        if (!$pagamento['aprovado']) {
            http_response_code(402); 
            echo json_encode(["erro" => "Pagamento recusado"]);
            return;
        }

        
        try {
            $this->pdo->beginTransaction();

            
            $id_assinatura = $this->assinatura->criar($usuario['id'], $body['id_plano']);

            
            $this->pdo->commit();

            echo json_encode([
                "mensagem"      => "Pagamento aprovado e assinatura ativada com sucesso!",
                "id_assinatura" => $id_assinatura,
                "plano"         => $plano['nome'],
                "preco"         => $plano['preco'],
                "metodo"        => $body['metodo'],
                "transacao_id"  => $pagamento['transacao_id']
            ]);

        } catch (Exception $e) {
           
            $this->pdo->rollBack();
            
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao processar ativação interna. Entre em contato com o suporte."]);
        }
    }


    private function simularPagamento($metodo, $preco) {
       
        return [
            "aprovado"     => true,
            "transacao_id" => "SIM-" . strtoupper($metodo) . "-" . uniqid()
        ];
    }
}

//verificar