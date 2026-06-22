<?php

require_once '../config/database.php';
require_once '../models/Simulado.php';
require_once '../models/Resultado.php';
require_once '../middlewares/AuthMiddleware.php';

class SimuladoController {

    private $simulado;
    private $resultado;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo       = $pdo;
        $this->simulado  = new Simulado($pdo);
        $this->resultado = new Resultado($pdo);
    }

    // Lista todos os simulados
    public function listar() {
        AuthMiddleware::verificar($this->pdo);

        $simulados = $this->simulado->listarTodos();

        echo json_encode($simulados);
    }

    // Abre um simulado com suas questões sem gabarito
    public function buscar($id) {
        AuthMiddleware::verificar($this->pdo);

        $simulado = $this->simulado->buscarPorId($id);

        if (!$simulado) {
            http_response_code(404);
            echo json_encode(["erro" => "Simulado não encontrado"]);
            return;
        }

        $simulado['questoes'] = $this->simulado->buscarQuestoes($id);

        echo json_encode($simulado);
    }

    // Recebe as respostas, calcula os acertos e salva o resultado
    public function entregar($id) {
        $usuario = AuthMiddleware::verificar($this->pdo);

        $body = json_decode(file_get_contents('php://input'), true);

        if (empty($body['respostas'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Respostas não enviadas"]);
            return;
        }

        $simulado = $this->simulado->buscarPorId($id);
        if (!$simulado) {
            http_response_code(404);
            echo json_encode(["erro" => "Simulado não encontrado"]);
            return;
        }

        $gabarito = $this->simulado->buscarQuestoesComGabarito($id);

        if (empty($gabarito)) {
            http_response_code(400);
            echo json_encode(["erro" => "Este simulado não possui questões"]);
            return;
        }

        $jaEntregou = $this->resultado->buscarPorUsuarioESimulado($usuario['id'], $id);
        if ($jaEntregou) {
            http_response_code(400);
            echo json_encode(["erro" => "Você já entregou esse simulado"]);
            return;
        }

        // Monta o gabarito em array indexado por id_quest para otimizar
        $gabaritoIndexado = [];
        foreach ($gabarito as $questao) {
            $gabaritoIndexado[$questao['id_quest']] = $questao['alt_correta'];
        }

        // Calcula acertos e prepara respostas
        $acertos = 0;
        foreach ($body['respostas'] as $resposta) {
            $id_quest     = $resposta['id_quest'];
            $alt_escolhida = strtoupper($resposta['alt_escolhida']);

            if (isset($gabaritoIndexado[$id_quest])) {
                if (strtoupper($gabaritoIndexado[$id_quest]) === $alt_escolhida) {
                    $acertos++;
                }
            }
        }

        // Salva o resultado no banco
        $id_resultado = (int) $this->resultado->salvar($acertos, $usuario['id'], $id);

        // Salva cada resposta individual
        foreach ($body['respostas'] as $resposta) {
            $id_quest      = $resposta['id_quest'];
            $alt_escolhida = strtoupper($resposta['alt_escolhida']);
            $acertou       = isset($gabaritoIndexado[$id_quest]) && strtoupper($gabaritoIndexado[$id_quest]) === $alt_escolhida ? 1 : 0;

            $this->resultado->salvarResposta(
                $id_resultado,
                $id_quest,
                $alt_escolhida,
                $acertou
            );
        }

        echo json_encode([
            "mensagem"     => "Simulado entregue com sucesso!",
            "id_resultado" => $id_resultado,
            "acertos"      => $acertos,
            "total"        => count($gabarito)
        ]);
    }
}