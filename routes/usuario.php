<?php


class Usuario {


    public static function cadastrar(array $dados): array {

        
        if (empty($dados['nome']) || empty($dados['email']) || empty($dados['senha'])) {
            http_response_code(400); 
            return ["erro" => "Nome, e-mail e senha são obrigatórios."];
        }

        $pdo = conectar(); // Abre a conexão com o banco

        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$dados['email']]);

        if ($stmt->fetch()) {
            http_response_code(409); 
            return ["erro" => "E-mail já cadastrado."];
        }


        $senhaHash = password_hash($dados['senha'], PASSWORD_BCRYPT);

        
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nome, email, senha, criado_em)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([
            $dados['nome'],
            $dados['email'],
            $senhaHash
        ]);

        http_response_code(201); 
        return ["mensagem" => "Usuário cadastrado com sucesso."];
    }

    public static function login(array $dados): array {

        if (empty($dados['email']) || empty($dados['senha'])) {
            http_response_code(400);
            return ["erro" => "E-mail e senha são obrigatórios."];
        }

        $pdo = conectar();

       
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$dados['email']]);
        $usuario = $stmt->fetch(); 
        if (!$usuario || !password_verify($dados['senha'], $usuario['senha'])) {
            http_response_code(401); // 401 = Não autorizado
            return ["erro" => "E-mail ou senha incorretos."];
        }

        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+7 days')); // Válido por 7 dias

        
        $stmt = $pdo->prepare("
            INSERT INTO tokens (usuario_id, token, expira_em)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$usuario['id'], $token, $expira]);

        return [
            "mensagem" => "Login realizado com sucesso.",
            "token"    => $token,
            "usuario"  => [
                "id"    => $usuario['id'],
                "nome"  => $usuario['nome'],
                "email" => $usuario['email']
            ]
        ];
    }

    public static function logout(): array {

        $token = self::pegarTokenDoCabecalho();

        if (!$token) {
            http_response_code(401);
            return ["erro" => "Token não fornecido."];
        }

        $pdo = conectar();

        
        $stmt = $pdo->prepare("DELETE FROM tokens WHERE token = ?");
        $stmt->execute([$token]);

        return ["mensagem" => "Logout realizado com sucesso."];
    }

    public static function buscarPerfil(): array {

        $usuario = self::autenticar(); // Verifica se está logado
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        
        return [
            "id"         => $usuario['id'],
            "nome"       => $usuario['nome'],
            "email"      => $usuario['email'],
            "criado_em"  => $usuario['criado_em']
        ];
    }

    
    public static function atualizarPerfil(array $dados): array {

        $usuario = self::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

       
        $novoNome  = $dados['nome']  ?? $usuario['nome'];
        $novoEmail = $dados['email'] ?? $usuario['email'];

        $pdo = conectar();

        
        $stmt = $pdo->prepare("
            UPDATE usuarios
            SET nome = ?, email = ?
            WHERE id = ?
        ");
        $stmt->execute([$novoNome, $novoEmail, $usuario['id']]);

        return ["mensagem" => "Perfil atualizado com sucesso."];
    }

    public static function apagarConta(): array {

        $usuario = self::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        $pdo = conectar();

        
        $stmt = $pdo->prepare("DELETE FROM tokens WHERE usuario_id = ?");
        $stmt->execute([$usuario['id']]);

     
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario['id']]);

        return ["mensagem" => "Conta apagada com sucesso."];
    }

    public static function trocarSenha(array $dados): array {

        $usuario = self::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        if (empty($dados['senha_atual']) || empty($dados['nova_senha'])) {
            http_response_code(400);
            return ["erro" => "Informe a senha atual e a nova senha."];
        }

        if (!password_verify($dados['senha_atual'], $usuario['senha'])) {
            http_response_code(403); // 403 = Proibido
            return ["erro" => "Senha atual incorreta."];
        }

        $novaHash = password_hash($dados['nova_senha'], PASSWORD_BCRYPT);

        $pdo = conectar();
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->execute([$novaHash, $usuario['id']]);

        return ["mensagem" => "Senha alterada com sucesso."];
    }


    public static function esqueceuSenha(array $dados): array {

        if (empty($dados['email'])) {
            http_response_code(400);
            return ["erro" => "Informe o e-mail."];
        }

        $pdo = conectar();

        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$dados['email']]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            return ["mensagem" => "Se o e-mail existir, você receberá o link em breve."];
        }

       
        $token   = bin2hex(random_bytes(32));
        $expira  = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $pdo->prepare("
            INSERT INTO tokens_reset (usuario_id, token, expira_em)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$usuario['id'], $token, $expira]);


        return ["mensagem" => "Se o e-mail existir, você receberá o link em breve."];
    }

    public static function redefinirSenha(array $dados): array {

        if (empty($dados['token']) || empty($dados['nova_senha'])) {
            http_response_code(400);
            return ["erro" => "Token e nova senha são obrigatórios."];
        }

        $pdo = conectar();

        $stmt = $pdo->prepare("
            SELECT usuario_id FROM tokens_reset
            WHERE token = ? AND expira_em > NOW()
        ");
        $stmt->execute([$dados['token']]);
        $registro = $stmt->fetch();

        if (!$registro) {
            http_response_code(400);
            return ["erro" => "Token inválido ou expirado."];
        }

        $novaHash = password_hash($dados['nova_senha'], PASSWORD_BCRYPT);

        
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->execute([$novaHash, $registro['usuario_id']]);

      
        $stmt = $pdo->prepare("DELETE FROM tokens_reset WHERE token = ?");
        $stmt->execute([$dados['token']]);

        return ["mensagem" => "Senha redefinida com sucesso."];
    }

 
    public static function pegarTokenDoCabecalho(): ?string {

       
        $cabecalhos = getallheaders();
        $auth = $cabecalhos['Authorization'] ?? '';

       
        if (str_starts_with($auth, 'Bearer ')) {
            return substr($auth, 7); 
        }

        return null; 


    public static function autenticar(): array|false {

        $token = self::pegarTokenDoCabecalho();

        if (!$token) {
            return false;
        }

        $pdo = conectar();


        $stmt = $pdo->prepare("
            SELECT u.*
            FROM usuarios u
            JOIN tokens t ON t.usuario_id = u.id
            WHERE t.token = ? AND t.expira_em > NOW()
        ");
        $stmt->execute([$token]);
        $usuario = $stmt->fetch();

        return $usuario ?: false; 
    }
}
