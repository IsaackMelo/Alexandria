<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

$isAdm  = $_SESSION['conta']['tipo'] === 'ADM';
$isUser = !$isAdm;

if ($isUser && empty($_SESSION['conta']['plano'])) {
    header('Location: ../web/plano.php');
    exit;
}
?>
<?php
require_once __DIR__ . '/../includes/dados.php';

$contexto = contexto_questoes($_GET);
$pergunta = $contexto['pergunta'];
$indice   = $contexto['indice'];
$total    = $contexto['total'];

if ($pergunta === null) {
    header('Location: ' . url_questao($contexto, 0));
    exit;
}

$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

$eh_dissertativa = ($pergunta['tipo'] ?? 'alternativa') === 'dissertativo';
$alternativas    = array_values($pergunta['alternativas'] ?? []);
$indice_correta  = isset($pergunta['correta']) ? (int) $pergunta['correta'] : null;
$letra_correta   = $indice_correta !== null ? chr(65 + $indice_correta) : '';
$letra_marcada   = strtoupper(substr((string) ($_GET['letra'] ?? ''), 0, 1));
$modo_gabarito   = isset($_GET['gabarito']);

if (!$modo_gabarito && !$eh_dissertativa && $letra_marcada !== '' && $letra_marcada !== $letra_correta) {
    header('Location: ' . url_questao($contexto, $indice, 'questao-errado.php', ['letra' => $letra_marcada]));
    exit;
}
if (!$eh_dissertativa && $letra_marcada === '') {
    $modo_gabarito = true;
}

$numero_exibido = str_pad((string) ($indice + 1), 2, '0', STR_PAD_LEFT);
$url_anterior   = $indice > 0 ? url_questao($contexto, $indice - 1) : '';
$url_proxima    = $indice < $total - 1 ? url_questao($contexto, $indice + 1) : '';

$imagem_apoio = $pergunta['imagem'] ?? '';
$imagem_existe = $imagem_apoio !== '' && file_exists(__DIR__ . '/' . $imagem_apoio);

$urls_perguntas = [];
for ($i = 0; $i < $total; $i++) {
    $urls_perguntas[] = url_questao($contexto, $i);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Questão <?= $e($numero_exibido) ?> (<?= $modo_gabarito ? 'Gabarito' : 'Resposta Correta' ?>)</title>

    <link rel="icon" type="image/png" href="../imagens/alex.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/telaacerto.css">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-questao-certo.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    <?php include __DIR__ . '/../includes/topbar.php'; ?>

    <main class="conteudo">

        <a href="<?= $e($contexto['link_voltar']) ?>" class="voltar">&lsaquo; <?= $e($contexto['rotulo_voltar']) ?></a>

        <p class="titulo-sequencia"><?= $e($contexto['titulo']) ?></p>

        <div class="painel-duplo">

            <div class="card-custom">
                <div>
                    <span class="num-questao"><?= $e($numero_exibido) ?>.</span>
                    <span class="fonte-questao"><?= $e($pergunta['fonte'] ?? trim(($pergunta['banca'] ?? '') . ' ' . ($pergunta['ano'] ?? ''))) ?></span>
                    <p class="enunciado"><?= nl2br($e($pergunta['enunciado'] ?? '')) ?></p>
                </div>

                <hr class="divisor">

                <?php if ($eh_dissertativa): ?>
                <p class="titulo-alternativas">Questão dissertativa</p>
                <p class="enunciado mb-0">Compare a sua resposta com os pontos esperados descritos abaixo.</p>
                <?php else: ?>
                <p class="titulo-alternativas">Alternativas:</p>

                <div class="lista-alternativas">
                    <?php foreach ($alternativas as $indice_alternativa => $texto_alternativa):
                        $letra = chr(65 + $indice_alternativa);
                        $classes = 'alternativa';
                        if ($indice_alternativa === $indice_correta) $classes .= ' correta';
                        if (!$modo_gabarito && $letra === $letra_marcada && $letra !== $letra_correta) $classes .= ' errada';
                    ?>
                    <div class="<?= $classes ?>" data-letra="<?= $letra ?>">
                        <div class="letra"><?= $letra ?></div>
                        <div><?= $e($texto_alternativa) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-custom">
                <div class="progresso-header">
                    <h5>Progressão da questão</h5>
                    <span class="contador-progresso"><?= $indice + 1 ?> de <?= $total ?></span>
                </div>

                <div class="lista-status">
                    <div class="badge-progresso badge-acerto"><span>Acertos</span> <strong id="totalAcertos">0</strong></div>
                    <div class="badge-progresso badge-erro"><span>Erros</span> <strong id="totalErros">0</strong></div>
                    <div class="badge-progresso badge-branco"><span>Em Branco</span> <strong id="totalBranco"><?= $total ?></strong></div>
                </div>

                <hr class="divisor">

                <div class="linha-tempo">
                    <span>Tempo gasto</span>
                    <strong id="tempoGasto">--:--:--</strong>
                </div>

                <div class="lista-progresso-questoes">
                    <?php foreach ($urls_perguntas as $posicao => $url_pergunta): ?>
                    <a href="<?= $e($url_pergunta) ?>" class="pill-questao pill-neutro<?= $posicao === $indice ? ' atual' : '' ?>" data-indice="<?= $posicao ?>"><?= $posicao + 1 ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="card-feedback">
            <div class="feedback-conteudo">
                <div class="feedback-titulo">
                    <?php if ($modo_gabarito): ?>
                    <i class="fa-solid fa-key"></i>
                    Gabarito da questão
                    <?php elseif ($eh_dissertativa): ?>
                    <i class="fa-solid fa-paper-plane"></i>
                    Resposta enviada
                    <?php else: ?>
                    <i class="fa-solid fa-circle-check"></i>
                    Resposta certa
                    <?php endif; ?>
                </div>

                <?php if ($eh_dissertativa && !empty($pergunta['resposta_esperada'])): ?>
                <div class="bloco-dissertativa">
                    <strong>Resposta esperada</strong>
                    <?= $e($pergunta['resposta_esperada']) ?>
                </div>
                <?php endif; ?>

                <p class="feedback-texto">
                    <?= $e($pergunta['explicacao'] ?? '') ?>
                </p>

                <?php if (!$eh_dissertativa): ?>
                <div class="feedback-gabarito">Gabarito: <?= $e($letra_correta) ?></div>
                <?php endif; ?>

                <?php if (!empty($pergunta['referencia'])): ?>
                <div class="feedback-referencia">
                    <strong>Referência:</strong><br>
                    <?= $e($pergunta['referencia']) ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($imagem_existe): ?>
            <div>
                <img src="<?= $e($imagem_apoio) ?>" alt="<?= $e($pergunta['assunto'] ?? 'Imagem de apoio') ?>" class="feedback-imagem">
            </div>
            <?php endif; ?>
        </div>

        <div class="botoes-navegacao">
            <a href="<?= $e($url_anterior ?: '#') ?>" class="btn-nav-outline<?= $url_anterior === '' ? ' desabilitado' : '' ?>">
                <i class="fa-solid fa-chevron-left"></i> Questão anterior
            </a>

            <?php if ($url_proxima !== ''): ?>
            <a href="<?= $e($url_proxima) ?>" class="btn-nav-vinho">
                Próxima questão <i class="fa-solid fa-chevron-right"></i>
            </a>
            <?php else: ?>
            <a href="<?= $e($contexto['link_voltar']) ?>" class="btn-nav-vinho">
                Concluir <i class="fa-solid fa-flag-checkered"></i>
            </a>
            <?php endif; ?>
        </div>

    </main>

    <script>
        (() => {
            const CHAVE  = <?= json_encode('alexandria_resolucao_' . $contexto['chave']) ?>;
            const INDICE = <?= (int) $indice ?>;
            const TOTAL  = <?= (int) $total ?>;

            let progresso = {};
            try { progresso = JSON.parse(sessionStorage.getItem(CHAVE) || '{}'); } catch (e) {}
            const respostas = progresso.respostas || {};

            let acertos = 0, erros = 0, respondidas = 0;
            document.querySelectorAll('.pill-questao').forEach((pill) => {
                const resposta = respostas[pill.dataset.indice];
                if (!resposta) return;
                respondidas++;
                pill.classList.remove('pill-neutro');
                if (resposta.status === 'acerto') { acertos++; pill.classList.add('pill-acerto'); }
                else if (resposta.status === 'erro') { erros++; pill.classList.add('pill-erro'); }
                else { pill.classList.add('pill-neutro'); }
            });

            document.getElementById('totalAcertos').textContent = acertos;
            document.getElementById('totalErros').textContent = erros;
            document.getElementById('totalBranco').textContent = Math.max(0, TOTAL - respondidas);

            const atual = respostas[INDICE];
            if (atual && atual.tempo) {
                const s = atual.tempo;
                const hh = String(Math.floor(s / 3600)).padStart(2, '0');
                const mm = String(Math.floor((s % 3600) / 60)).padStart(2, '0');
                const ss = String(s % 60).padStart(2, '0');
                document.getElementById('tempoGasto').textContent = `${hh}:${mm}:${ss}`;
            }
        })();
    </script>

</body>

</html>
