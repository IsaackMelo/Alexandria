<?php

require_once '../config/database.php';
require_once '../models/Resultado.php';
require_once '../models/Simulado.php';
require_once '../middlewares/PlanoMiddleware.php';

class IAController {

    private $resultado;
    private $simulado;
    private $pdo;

    private $iaApiUrl = 'http://localhost:5000/feedback';

    public function __construct($pdo) {
        $this->pdo       = $pdo;
        $this->resultado = new Resultado($pdo);
        $this->simulado  = new Simulado($pdo);
    }

    public function feedback($body) {
        $usuario = PlanoMiddleware::verificar($this->pdo, ['premium']);

        if (empty($body['id_resultado'])) {
            http_response_code(400);
            echo json_encode(["erro" => "ID do resultado é obrigatório"]);
            return;
        }

        $resultado = $this->resultado->buscarPorId($body['id_resultado']);

        if (!$resultado) {
            http_response_code(404);
            echo json_encode(["erro" => "Resultado não encontrado"]);
            return;
        }

        if ((int)$resultado['id_usuario'] !== (int)$usuario['id']) {
            http_response_code(403);
            echo json_encode(["erro" => "Acesso negado"]);
            return;
        }

        $respostas = $this->resultado->buscarRespostas($body['id_resultado']);

        if (empty($respostas)) {
            http_response_code(404);
            echo json_encode(["erro" => "Nenhuma resposta encontrada para esse resultado"]);
            return;
        }

        $questoes = $this->simulado->buscarQuestoesComGabarito($resultado['id_simulado']);

        if (!function_exists('curl_init')) {
            http_response_code(500);
            echo json_encode(["erro" => "curl não está habilitado no servidor"]);
            return;
        }

        $dados = [
            "id_resultado" => (int)$resultado['id_resultado'],
            "id_simulado"  => (int)$resultado['id_simulado'],
            "nota_final"   => $resultado['nota_final'],
            "respostas"    => $respostas,
            "questoes"     => $questoes
        ];

        $resposta = $this->chamarIa($dados);

        if (!$resposta) {
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao conectar com a IA"]);
            return;
        }

        echo json_encode([
            "mensagem" => "Feedback gerado com sucesso!",
            "feedback" => $resposta
        ]);
    }

    private function chamarIa($dados) {
        $ch = curl_init($this->iaApiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $resposta = curl_exec($ch);
        $erro     = curl_error($ch);

        curl_close($ch);

        if ($erro) {
            return null;
        }

        return json_decode($resposta, true);
    }
}