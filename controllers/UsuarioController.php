<?php

require_once '../config/database.php';
require_once '../models/Usuario.php';
require_once '../middlewares/AuthMiddleware.php';

class UsuarioController {

    private $usuario;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo     = $pdo;
        $this->usuario = new Usuario($pdo);
    }

    // Retorna os dados do usuário logado
    public function perfil() {
        $usuario = AuthMiddleware::verificar($this->pdo);

        $dados = $this->usuario->buscarPorId($usuario['id']);

        if (!$dados) {
            http_response_code(404);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            return;
        }

        // Remove a senha antes de retornar
        unset($dados['senha']);

        echo json_encode($dados);
    }

    // Atualiza o perfil do usuário logado
    public function atualizar($body) {
        $usuario = AuthMiddleware::verificar($this->pdo);

        if (empty($body['nome_usu']) || empty($body['email'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Nome e email são obrigatórios"]);
            return;
        }

        // Verifica se o usuário existe
        $dados = $this->usuario->buscarPorId($usuario['id']);

        if (!$dados) {
            http_response_code(404);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            return;
        }

        $this->usuario->atualizar(
            $usuario['id'],
            $body['nome_usu'],
            $body['email'],
            $body['dt_nasc'] ?? null
        );

        echo json_encode(["mensagem" => "Perfil atualizado com sucesso!"]);
    }

    // Troca a senha do usuário logado
    public function trocarSenha($body) {
        $usuario = AuthMiddleware::verificar($this->pdo);

        if (empty($body['senha_atual']) || empty($body['nova_senha'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Senha atual e nova senha são obrigatórias"]);
            return;
        }

        $dados = $this->usuario->buscarPorId($usuario['id']);

        if (!$dados) {
            http_response_code(404);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            return;
        }

        if (!password_verify($body['senha_atual'], $dados['senha'])) {
            http_response_code(401);
            echo json_encode(["erro" => "Senha atual incorreta"]);
            return;
        }

        $this->usuario->trocarSenha($usuario['id'], $body['nova_senha']);

        echo json_encode(["mensagem" => "Senha alterada com sucesso!"]);
    }

    // Deleta a conta do usuário logado
    public function deletarConta() {
        $usuario = AuthMiddleware::verificar($this->pdo);

        $dados = $this->usuario->buscarPorId($usuario['id']);

        if (!$dados) {
            http_response_code(404);
            echo json_encode(["erro" => "Usuário não encontrado"]);
            return;
        }

        $this->usuario->deletar($usuario['id']);

        echo json_encode(["mensagem" => "Conta deletada com sucesso!"]);
    }
}