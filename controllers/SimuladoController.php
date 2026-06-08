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

        // Busca as questões sem o gabarito
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

        // Busca o gabarito
        $gabarito = $this->simulado->buscarQuestoesComGabarito($id);

        // Verifica se o simulado tem questões
        if (empty($gabarito)) {
            http_response_code(400);
            echo json_encode(["erro" => "Este simulado não possui questões"]);
            return;
        }

        // Verifica se o usuário já entregou esse simulado
        $jaEntregou = $this->resultado->buscarPorUsuarioESimulado($usuario['id'], $id);
        if ($jaEntregou) {
            http_response_code(400);
            echo json_encode(["erro" => "Você já entregou esse simulado"]);
            return;
        }

        // Calcula o número de acertos
        $acertos = 0;
        foreach ($body['respostas'] as $resposta) {
            foreach ($gabarito as $questao) {
                if (
                    $questao['id_quest'] == $resposta['id_quest'] &&
                    strtoupper($questao['alt_correta']) === strtoupper($resposta['alt_escolhida'])
                ) {
                    $acertos++;
                }
            }
        }

        // Salva o resultado no banco
        $this->resultado->salvar($acertos, $usuario['id'], $id);

        echo json_encode([
            "mensagem" => "Simulado entregue com sucesso!",
            "acertos"  => $acertos,
            "total"    => count($gabarito)
        ]);
    }
}