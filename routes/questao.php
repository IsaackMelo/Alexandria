<?php


class Questao {

    public static function listarSimulados(): array {

       
        $pdo = conectar();

        $stmt = $pdo->prepare("
            SELECT
                s.id,
                s.titulo,
                s.descricao,
                s.criado_em,
                COUNT(sq.questao_id) AS total_questoes
            FROM simulados s
            LEFT JOIN simulado_questoes sq ON sq.simulado_id = s.id
            GROUP BY s.id
            ORDER BY s.criado_em DESC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }


    public static function buscarSimulado(int $id): array {

        $pdo = conectar();

       
        $stmt = $pdo->prepare("SELECT * FROM simulados WHERE id = ?");
        $stmt->execute([$id]);
        $simulado = $stmt->fetch();

        if (!$simulado) {
            http_response_code(404);
            return ["erro" => "Simulado não encontrado."];
        }

       
        $stmt = $pdo->prepare("
            SELECT q.id, q.enunciado, q.nivel, q.ano, q.banca, sq.ordem
            FROM questoes q
            JOIN simulado_questoes sq ON sq.questao_id = q.id
            WHERE sq.simulado_id = ?
            ORDER BY sq.ordem
        ");
        $stmt->execute([$id]);
        $questoes = $stmt->fetchAll();


        foreach ($questoes as &$questao) {
            $stmt = $pdo->prepare("
                SELECT id, letra, texto
                FROM alternativas
                WHERE questao_id = ?
                ORDER BY letra
            ");
            $stmt->execute([$questao['id']]);
            $questao['alternativas'] = $stmt->fetchAll();
        }


        $simulado['questoes'] = $questoes;

        return $simulado;
    }


    public static function entregarSimulado(int $simuladoId, array $dados): array {

        $usuario = Usuario::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Você precisa estar logado para entregar um simulado."];
        }

  
        if (empty($dados['respostas']) || !is_array($dados['respostas'])) {
            http_response_code(400);
            return ["erro" => "Informe as respostas no formato correto."];
        }

        $pdo = conectar();

        
        $stmt = $pdo->prepare("SELECT id FROM simulados WHERE id = ?");
        $stmt->execute([$simuladoId]);
        if (!$stmt->fetch()) {
            http_response_code(404);
            return ["erro" => "Simulado não encontrado."];
        }

        $acertos   = 0;
        $erros     = 0;
        $detalhes  = [];

       
        foreach ($dados['respostas'] as $resposta) {

            $questaoId     = (int)($resposta['questao_id']    ?? 0);
            $alternativaId = (int)($resposta['alternativa_id'] ?? 0);

            if (!$questaoId || !$alternativaId) continue;

           
            $stmt = $pdo->prepare("
                SELECT correta, texto
                FROM alternativas
                WHERE id = ? AND questao_id = ?
            ");
            $stmt->execute([$alternativaId, $questaoId]);
            $alternativa = $stmt->fetch();

            if (!$alternativa) continue;

            $eCorreta = (bool)$alternativa['correta'];
            $eCorreta ? $acertos++ : $erros++;

            
            $stmt = $pdo->prepare("
                SELECT id, letra, texto
                FROM alternativas
                WHERE questao_id = ? AND correta = 1
            ");
            $stmt->execute([$questaoId]);
            $alternativaCorreta = $stmt->fetch();

            
            $stmt = $pdo->prepare("
                INSERT INTO respostas_usuario
                    (usuario_id, simulado_id, questao_id, alternativa_id, correta, respondido_em)
                VALUES (?, ?, ?, ?, ?, NOW())
                ON DUPLICATE KEY UPDATE
                    alternativa_id = VALUES(alternativa_id),
                    correta        = VALUES(correta),
                    respondido_em  = NOW()
            ");
            
            $stmt->execute([
                $usuario['id'],
                $simuladoId,
                $questaoId,
                $alternativaId,
                $eCorreta ? 1 : 0
            ]);

       
            $detalhes[] = [
                "questao_id"          => $questaoId,
                "alternativa_escolhida" => $alternativaId,
                "correta"             => $eCorreta,
                "alternativa_correta" => $alternativaCorreta
            ];
        }

        $total      = $acertos + $erros;
        $porcentagem = $total > 0 ? round(($acertos / $total) * 100, 1) : 0;

        return [
            "mensagem"    => "Simulado entregue com sucesso!",
            "acertos"     => $acertos,
            "erros"       => $erros,
            "total"       => $total,
            "porcentagem" => $porcentagem,
            "gabarito"    => $detalhes
        ];
    }


    public static function criar(array $dados): array {

        $usuario = Usuario::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        if (empty($usuario['admin']) || !$usuario['admin']) {
            http_response_code(403);
            return ["erro" => "Apenas administradores podem criar questões."];
        }

        
        if (empty($dados['enunciado']) || empty($dados['alternativas'])) {
            http_response_code(400);
            return ["erro" => "Enunciado e alternativas são obrigatórios."];
        }

        
        $corretas = array_filter($dados['alternativas'], fn($a) => !empty($a['correta']));

        if (count($corretas) !== 1) {
            http_response_code(400);
            return ["erro" => "Marque exatamente uma alternativa como correta."];
        }

        $pdo = conectar();

        
        $stmt = $pdo->prepare("
            INSERT INTO questoes (conteudo_id, enunciado, nivel, ano, banca, criado_em)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $dados['conteudo_id'] ?? null,
            $dados['enunciado'],
            $dados['nivel']       ?? 'medio',
            $dados['ano']         ?? null,
            $dados['banca']       ?? null
        ]);

        $questaoId = (int)$pdo->lastInsertId();

        $letras = ['A', 'B', 'C', 'D', 'E'];
        foreach ($dados['alternativas'] as $i => $alt) {
            if (empty($alt['texto'])) continue;

            $stmt = $pdo->prepare("
                INSERT INTO alternativas (questao_id, letra, texto, correta)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([
                $questaoId,
                $letras[$i] ?? chr(65 + $i), // A=65 na tabela ASCII
                $alt['texto'],
                !empty($alt['correta']) ? 1 : 0
            ]);
        }

        http_response_code(201);
        return [
            "mensagem" => "Questão criada com sucesso.",
            "id"       => $questaoId
        ];
    }


    public static function atualizar(int $id, array $dados): array {

        $usuario = Usuario::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        if (empty($usuario['admin']) || !$usuario['admin']) {
            http_response_code(403);
            return ["erro" => "Apenas administradores podem editar questões."];
        }

        $pdo = conectar();

        $stmt = $pdo->prepare("SELECT id FROM questoes WHERE id = ?");
        $stmt->execute([$id]);
        if (!$stmt->fetch()) {
            http_response_code(404);
            return ["erro" => "Questão não encontrada."];
        }

        
        $campos = [];
        $params = [];

        foreach (['enunciado', 'nivel', 'ano', 'banca', 'conteudo_id'] as $campo) {
            if (isset($dados[$campo])) {
                $campos[] = "$campo = ?";
                $params[] = $dados[$campo];
            }
        }

        if (!empty($campos)) {
            $sql = "UPDATE questoes SET " . implode(", ", $campos) . " WHERE id = ?";
            $params[] = $id;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }

        
        if (!empty($dados['alternativas'])) {

            $corretas = array_filter($dados['alternativas'], fn($a) => !empty($a['correta']));
            if (count($corretas) !== 1) {
                http_response_code(400);
                return ["erro" => "Marque exatamente uma alternativa como correta."];
            }

        
            $stmt = $pdo->prepare("DELETE FROM alternativas WHERE questao_id = ?");
            $stmt->execute([$id]);

            // Insere as novas
            $letras = ['A', 'B', 'C', 'D', 'E'];
            foreach ($dados['alternativas'] as $i => $alt) {
                if (empty($alt['texto'])) continue;

                $stmt = $pdo->prepare("
                    INSERT INTO alternativas (questao_id, letra, texto, correta)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([
                    $id,
                    $letras[$i] ?? chr(65 + $i),
                    $alt['texto'],
                    !empty($alt['correta']) ? 1 : 0
                ]);
            }
        }

        return ["mensagem" => "Questão atualizada com sucesso."];
    }


    public static function apagar(int $id): array {

        $usuario = Usuario::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        if (empty($usuario['admin']) || !$usuario['admin']) {
            http_response_code(403);
            return ["erro" => "Apenas administradores podem apagar questões."];
        }

        $pdo = conectar();

        
        $stmt = $pdo->prepare("SELECT id FROM questoes WHERE id = ?");
        $stmt->execute([$id]);
        if (!$stmt->fetch()) {
            http_response_code(404);
            return ["erro" => "Questão não encontrada."];
        }

    
        $stmt = $pdo->prepare("DELETE FROM alternativas WHERE questao_id = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM simulado_questoes WHERE questao_id = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM respostas_usuario WHERE questao_id = ?");
        $stmt->execute([$id]);

        // Apaga a questão
        $stmt = $pdo->prepare("DELETE FROM questoes WHERE id = ?");
        $stmt->execute([$id]);

        return ["mensagem" => "Questão apagada com sucesso."];
    }


    public static function feedbackIA(array $dados): array {

        $usuario = Usuario::autenticar();
        if (!$usuario) {
            http_response_code(401);
            return ["erro" => "Não autorizado."];
        }

        if (empty($dados['simulado_id'])) {
            http_response_code(400);
            return ["erro" => "Informe o simulado_id."];
        }

        $pdo = conectar();
        $simuladoId = (int)$dados['simulado_id'];

       
        $stmt = $pdo->prepare("
            SELECT
                ru.questao_id,
                ru.correta,
                q.enunciado,
                q.nivel,
                c.titulo AS tema,
                c.periodo
            FROM respostas_usuario ru
            JOIN questoes q ON q.id = ru.questao_id
            LEFT JOIN conteudos c ON c.id = q.conteudo_id
            WHERE ru.usuario_id = ? AND ru.simulado_id = ?
        ");
        $stmt->execute([$usuario['id'], $simuladoId]);
        $respostas = $stmt->fetchAll();

        if (empty($respostas)) {
            http_response_code(404);
            return ["erro" => "Nenhuma resposta encontrada para este simulado."];
        }

        $errosPorTema = [];
        $acertosPorTema = [];

        foreach ($respostas as $r) {
            $tema = $r['tema'] ?? 'Sem tema';
            if ($r['correta']) {
                $acertosPorTema[$tema] = ($acertosPorTema[$tema] ?? 0) + 1;
            } else {
                $errosPorTema[$tema] = ($errosPorTema[$tema] ?? 0) + 1;
            }
        }

        arsort($errosPorTema); 

        $sugestoes = [];
        foreach (array_keys($errosPorTema) as $tema) {
            $sugestoes[] = "Revise o tema: $tema";
        }

        $total   = count($respostas);
        $acertos = array_sum(array_column($respostas, 'correta'));
       

        return [
            "resumo" => [
                "total"       => $total,
                "acertos"     => $acertos,
                "erros"       => $total - $acertos,
                "porcentagem" => round(($acertos / $total) * 100, 1)
            ],
            "pontos_fracos" => array_keys($errosPorTema),
            "pontos_fortes" => array_keys($acertosPorTema),
            "sugestoes"     => $sugestoes,
            "mensagem_ia"   => self::gerarMensagemIA($acertos, $total, array_keys($errosPorTema))
        ];
    }


    private static function gerarMensagemIA(int $acertos, int $total, array $erros): string {

        $porcentagem = $total > 0 ? ($acertos / $total) * 100 : 0;

       
        if ($porcentagem >= 80) {
            $base = "Excelente desempenho! Você demonstra bom domínio do conteúdo.";
        } elseif ($porcentagem >= 60) {
            $base = "Bom resultado! Com mais prática você chegará lá.";
        } else {
            $base = "Continue estudando! Cada erro é uma oportunidade de aprender.";
        }

       
        if (!empty($erros)) {
            $temaDestaque = $erros[0]; 
            $base .= " Dedique atenção especial a: $temaDestaque.";
        }

        return $base;
    }
}
