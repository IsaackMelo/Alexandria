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

$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

$eh_dissertativa = ($pergunta['tipo'] ?? 'alternativa') === 'dissertativo';
$alternativas    = array_values($pergunta['alternativas'] ?? []);
$letra_correta   = isset($pergunta['correta']) ? chr(65 + (int) $pergunta['correta']) : '';
$numero_exibido  = str_pad((string) ($indice + 1), 2, '0', STR_PAD_LEFT);

$url_certo    = url_questao($contexto, $indice, 'questao-certo.php');
$url_errado   = url_questao($contexto, $indice, 'questao-errado.php');
$url_anterior = $indice > 0 ? url_questao($contexto, $indice - 1) : '';
$url_proxima  = $indice < $total - 1 ? url_questao($contexto, $indice + 1) : '';

$rotulo_dificuldade = $textos_dificuldade[strtolower($pergunta['dificuldade'] ?? '')] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Questão <?= $e($numero_exibido) ?> · <?= $e($contexto['titulo']) ?></title>

    <link rel="icon" type="image/png" href="../imagens/alex.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/quest.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-questao.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <?php
        include __DIR__ . '/../includes/sidebar.php';
        include __DIR__ . '/../includes/topbar.php';
    ?>

    <main class="conteudo">

        <a href="<?= $e($contexto['link_voltar']) ?>" class="voltar">&lsaquo; <?= $e($contexto['rotulo_voltar']) ?></a>

        <?php if ($pergunta === null): ?>

        <div class="card-questao questao-vazia">
            <p class="mb-2"><strong>Nenhuma questão disponível.</strong></p>
            <p class="mb-0">Esta <?= $contexto['origem'] === 'lista' ? 'lista de exercícios' : 'prova' ?> ainda não possui perguntas cadastradas.</p>
        </div>

        <?php else: ?>

        <div class="cabecalho-resolucao">
            <h1 class="titulo-resolucao"><?= $e($contexto['titulo']) ?></h1>
            <div class="selos-questao">
                <span class="selo-questao destaque">Questão <?= $indice + 1 ?> de <?= $total ?></span>
                <?php if (!empty($pergunta['assunto'])): ?>
                <span class="selo-questao"><?= $e($pergunta['assunto']) ?></span>
                <?php endif; ?>
                <?php if ($rotulo_dificuldade !== ''): ?>
                <span class="selo-questao"><?= $e($rotulo_dificuldade) ?></span>
                <?php endif; ?>
                <span class="selo-questao"><?= $eh_dissertativa ? 'Dissertativa' : 'Alternativa' ?></span>
            </div>
        </div>

        <div class="card-questao">

            <div class="d-flex gap-3 mb-3">

                <div class="num-questao"><?= $e($numero_exibido) ?></div>

                <div>
                    <div class="fonte-questao"><?= $e($pergunta['fonte'] ?? trim(($pergunta['banca'] ?? '') . ' ' . ($pergunta['ano'] ?? ''))) ?></div>

                    <div class="enunciado">
                        <?= nl2br($e($pergunta['enunciado'] ?? '')) ?>
                    </div>
                </div>

            </div>

            <hr>

            <?php if ($eh_dissertativa): ?>

            <label class="fw-bold mb-3" for="respostaDissertativa">Sua resposta:</label>
            <textarea id="respostaDissertativa" class="resposta-dissertativa" placeholder="Escreva sua resposta aqui. Depois de enviar, você poderá compará-la com a resposta esperada."></textarea>
            <div class="contador-dissertativa"><span id="contadorCaracteres">0</span> caracteres</div>

            <?php else: ?>

            <p class="fw-bold mb-3">Alternativas:</p>

            <div id="lista-alternativas">
                <?php foreach ($alternativas as $indice_alternativa => $texto_alternativa): ?>
                <div class="alternativa" data-letra="<?= chr(65 + $indice_alternativa) ?>" tabindex="0" role="button">
                    <div class="letra"><?= chr(65 + $indice_alternativa) ?></div>
                    <div><?= $e($texto_alternativa) ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php endif; ?>

        </div>

        <div class="navegacao-questao">
            <a href="<?= $e($url_anterior ?: '#') ?>" class="link-navegacao<?= $url_anterior === '' ? ' desabilitado' : '' ?>">
                <i class="fa-solid fa-chevron-left"></i> Anterior
            </a>

            <div class="d-flex gap-3 align-items-center">
                <a href="<?= $e($url_proxima ?: '#') ?>" class="link-navegacao<?= $url_proxima === '' ? ' desabilitado' : '' ?>" id="linkPular">
                    Pular <i class="fa-solid fa-chevron-right"></i>
                </a>
                <button class="btn btn-enviar" id="btnEnviar" disabled>Enviar resposta</button>
            </div>
        </div>

        <?php endif; ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($pergunta !== null): ?>
    <script>
        (() => {
            const CHAVE       = <?= json_encode('alexandria_resolucao_' . $contexto['chave']) ?>;
            const INDICE      = <?= (int) $indice ?>;
            const DISSERTATIVA = <?= $eh_dissertativa ? 'true' : 'false' ?>;
            const CORRETA     = <?= json_encode($letra_correta) ?>;
            const URL_CERTO   = <?= json_encode($url_certo) ?>;
            const URL_ERRADO  = <?= json_encode($url_errado) ?>;

            const botao = document.getElementById('btnEnviar');
            let resposta = '';

            function lerProgresso() {
                try { return JSON.parse(sessionStorage.getItem(CHAVE) || '{}'); } catch (e) { return {}; }
            }
            function salvarProgresso(progresso) {
                try { sessionStorage.setItem(CHAVE, JSON.stringify(progresso)); } catch (e) {}
            }

            const progresso = lerProgresso();
            progresso.inicio = progresso.inicio || {};
            if (!progresso.inicio[INDICE]) {
                progresso.inicio[INDICE] = Date.now();
                salvarProgresso(progresso);
            }

            if (DISSERTATIVA) {
                const campo = document.getElementById('respostaDissertativa');
                const contador = document.getElementById('contadorCaracteres');
                campo.addEventListener('input', () => {
                    contador.textContent = campo.value.length;
                    botao.disabled = campo.value.trim() === '';
                });
            } else {
                const alternativas = document.querySelectorAll('.alternativa');
                alternativas.forEach((alternativa) => {
                    const selecionar = () => {
                        alternativas.forEach((item) => item.classList.remove('selecionada'));
                        alternativa.classList.add('selecionada');
                        resposta = alternativa.dataset.letra;
                        botao.disabled = false;
                    };
                    alternativa.addEventListener('click', selecionar);
                    alternativa.addEventListener('keydown', (evento) => {
                        if (evento.key === 'Enter' || evento.key === ' ') {
                            evento.preventDefault();
                            selecionar();
                        }
                    });
                });
            }

            botao.addEventListener('click', () => {
                if (botao.disabled) return;

                const atual = lerProgresso();
                atual.inicio = atual.inicio || {};
                atual.respostas = atual.respostas || {};
                const inicio = atual.inicio[INDICE] || Date.now();
                const tempo = Math.max(1, Math.round((Date.now() - inicio) / 1000));
                delete atual.inicio[INDICE];

                if (DISSERTATIVA) {
                    atual.respostas[INDICE] = { status: 'enviada', tempo };
                    salvarProgresso(atual);
                    window.location.href = URL_CERTO;
                    return;
                }

                const acertou = resposta === CORRETA;
                atual.respostas[INDICE] = { status: acertou ? 'acerto' : 'erro', letra: resposta, tempo };
                salvarProgresso(atual);

                const destino = acertou ? URL_CERTO : URL_ERRADO;
                window.location.href = destino + (destino.includes('?') ? '&' : '?') + 'letra=' + encodeURIComponent(resposta);
            });
        })();
    </script>
    <?php endif; ?>

</body>

</html>
