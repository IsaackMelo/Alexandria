<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SESSION['conta']['tipo'] !== 'ADM') {
    header('Location: ../comuns/visualizar-curso.php');
    exit;
}
?>
<?php
$modo_formulario = 'editar';

require_once __DIR__ . '/../includes/dados.php';

$id_prova    = null;
$prova_atual = null;
if ($modo_formulario === 'editar') {
    $id_prova = filter_input(INPUT_GET, 'prova', FILTER_VALIDATE_INT);
    if ($id_prova === null || $id_prova === false) {
        $id_prova = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }
    if ($id_prova !== null && $id_prova !== false && isset($provas[$id_prova])) {
        $prova_atual = $provas[$id_prova];
    }
}

$id_acervo    = filter_input(INPUT_GET, 'acervo_id', FILTER_VALIDATE_INT);
$slug_acervo  = strtolower((string) ($prova_atual['banca'] ?? ($_GET['acervo'] ?? '')));
$acervo_atual = null;
foreach ($acervos as $item) {
    if (($id_acervo && $item['id'] === $id_acervo) || ($slug_acervo !== '' && ($item['slug'] === $slug_acervo || strtolower($item['nome']) === $slug_acervo))) {
        $acervo_atual = $item;
        break;
    }
}
$acervo           = $acervo_atual['nome'] ?? '';
$valor_acervo_slug = $acervo_atual['slug'] ?? '';

$link_voltar_prova = $acervo_atual
    ? 'editar-acervo.php?id=' . $acervo_atual['id']
    : '../comuns/visualizar-acervo.php';

$valor_dificuldade_prova = $prova_atual ? strtolower($prova_atual['dificuldade']) : '';
$valor_ano_prova         = $prova_atual['ano'] ?? '';
$valor_fase_prova        = $prova_atual['fase'] ?? '';
$valor_versao_prova      = $prova_atual['versao'] ?? '';
$valor_titulo_prova      = $prova_atual['titulo'] ?? '';

$sugestoes_fase   = array_values(array_unique(array_merge(['Fase 1', 'Fase 2', 'Única'], array_column($provas, 'fase'))));
$sugestoes_versao = array_values(array_unique(array_merge(['Dia 1', 'Dia 2', 'V1', 'V2'], array_column($provas, 'versao'))));

$editor_inicial = perguntas_para_editor($prova_atual['perguntas'] ?? []);
$perguntas_prova_iniciais     = $editor_inicial['perguntas'];
$contador_pergunta_inicial    = $editor_inicial['contador_perguntas'];
$contador_alternativa_inicial = $editor_inicial['contador_alternativas'];
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title><?= $modo_formulario === 'editar' ? 'Editar Prova' : 'Adicionar Prova' ?> | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/adm-prova.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>
<?php 
include __DIR__ . '/../includes/topbar.php'; 
include __DIR__ . '/../includes/sidebar.php';
?>
<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="<?= htmlspecialchars($link_voltar_prova) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para acervo</a>
            <h1><?= $modo_formulario === 'editar' ? 'Editar Prova' : 'Adicionar Prova' ?></h1>
            <p><?= $modo_formulario === 'editar' ? 'Atualize os dados da prova e as perguntas, alternativas e explicações.' : 'Cadastre uma nova prova no acervo, com perguntas, alternativas e explicações.' ?></p>
            <?php if ($modo_formulario === 'editar' && $prova_atual === null): ?>
            <p style="color:#b3261e; font-weight:600;">Prova não encontrada. Verifique o parâmetro "prova" da URL.</p>
            <?php endif; ?>
        </div>
    </header>

    <form id="form-prova" class="layout-editor" onsubmit="return salvarProva(event)">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_prova) ?>">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-file-lines"></i> Dados da prova</div>
            <div class="formulario">

                <div class="linha">
                    <div class="campo">
                        <label for="acervo-prova">Acervo (banca)</label>
                        <select id="acervo-prova" name="banca" required>
                            <option value="" <?= $valor_acervo_slug === '' ? 'selected' : '' ?> disabled>Selecione o acervo</option>
                            <?php foreach ($acervos as $acervo_opcao): ?>
                            <option value="<?= htmlspecialchars($acervo_opcao['slug']) ?>" <?= $acervo_opcao['slug'] === $valor_acervo_slug ? 'selected' : '' ?>><?= htmlspecialchars($acervo_opcao['nome'] . ' — ' . $acervo_opcao['nome_completo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="titulo-prova">Título da Prova</label>
                        <input id="titulo-prova" name="titulo" type="text" placeholder="Ex.: FUVEST 2025 - Fase 1 (V1)" value="<?= htmlspecialchars($valor_titulo_prova) ?>" required>
                    </div>
                </div>

                <div class="linha-3">
                    <div class="campo">
                        <label for="dificuldade-prova">Dificuldade</label>
                        <select id="dificuldade-prova" name="dificuldade" required>
                            <option value="" <?= $valor_dificuldade_prova === '' ? 'selected' : '' ?> disabled>Selecione a dificuldade</option>
                            <?php foreach ($textos_dificuldade as $chave_dificuldade => $rotulo_dificuldade): ?>
                            <option value="<?= $chave_dificuldade ?>" <?= $valor_dificuldade_prova === $chave_dificuldade ? 'selected' : '' ?>><?= htmlspecialchars($rotulo_dificuldade) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="ano-prova">Ano da Prova</label>
                        <input id="ano-prova" name="ano" type="number" placeholder="Ex.: 2024" min="1950" max="2100" value="<?= htmlspecialchars((string) $valor_ano_prova) ?>" required>
                    </div>
                    <div class="campo">
                        <label for="fase-prova">Fase</label>
                        <input id="fase-prova" name="fase" type="text" list="sugestoes-fase" placeholder="Ex.: Fase 1, Única" value="<?= htmlspecialchars($valor_fase_prova) ?>">
                        <datalist id="sugestoes-fase">
                            <?php foreach ($sugestoes_fase as $sugestao): ?>
                            <option value="<?= htmlspecialchars($sugestao) ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>

                <div class="campo">
                    <label for="versao-prova">Versão / Dia</label>
                    <input id="versao-prova" name="versao" type="text" list="sugestoes-versao" placeholder="Ex.: V1, Dia 1, Caderno A..." value="<?= htmlspecialchars($valor_versao_prova) ?>">
                    <datalist id="sugestoes-versao">
                        <?php foreach ($sugestoes_versao as $sugestao): ?>
                        <option value="<?= htmlspecialchars($sugestao) ?>">
                        <?php endforeach; ?>
                    </datalist>
                    <span class="ajuda">Deixe em branco se a prova não tiver variações.</span>
                </div>

                <div class="campo">
                    <div class="cabecalho-secao">
                        <label>Perguntas</label>
                        <button type="button" class="botao botao-rascunho botao-pequeno" id="btn-adicionar-pergunta">
                            <i class="fa-solid fa-plus"></i> Adicionar Pergunta
                        </button>
                    </div>

                    <div id="lista-perguntas"></div>
                    <div class="aviso-vazio" id="aviso-sem-perguntas">
                        Nenhuma pergunta adicionada ainda. Clique em "Adicionar Pergunta" para começar.
                    </div>
                </div>

                <div class="acoes">
                    <a class="botao botao-secundario" href="<?= htmlspecialchars($link_voltar_prova) ?>">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarProva(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> Publicar Prova</button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização da prova">
            <div class="cartao-cabecalho">Pré-visualização (visão do aluno)</div>
            <div class="preview-conteudo" id="preview-conteudo">

                <div class="ficha-prova">
                    <h3 id="preview-titulo-prova">Título da prova</h3>
                    <div class="linha-info">
                        <span class="item-info"><i class="fa-regular fa-calendar"></i> <span id="preview-ano-prova">Ano</span></span>
                        <span class="item-info"><i class="fa-solid fa-layer-group"></i> <span id="preview-versao-prova">Versão</span></span>
                        <span class="badge-dificuldade indefinido" id="preview-dificuldade-prova">Dificuldade</span>
                    </div>
                </div>

                <div id="preview-sem-perguntas" class="aviso-vazio">
                    Adicione uma pergunta para ver a pré-visualização aqui.
                </div>

                <div id="preview-questao" style="display:none;">
                    <div class="preview-cabecalho-questao">
                        <span class="badge-questao" id="preview-badge">Q1</span>
                        <span class="preview-fonte" id="preview-fonte">Fonte da questão</span>
                    </div>
                    <p class="preview-enunciado" id="preview-enunciado">O enunciado da pergunta aparecerá aqui.</p>

                    <div class="preview-alternativas-titulo">Alternativas:</div>
                    <div class="preview-alternativas" id="preview-alternativas"></div>

                    <div class="preview-rodape-questao">
                        <button type="button" class="botao botao-secundario botao-pequeno" id="btn-ver-explicacao">Ver explicação</button>
                    </div>

                    <div class="preview-explicacao" id="preview-explicacao" style="display:none;">
                        <div class="preview-explicacao-texto-wrap">
                            <div class="preview-explicacao-titulo"><i class="fa-solid fa-circle-info"></i> Explicação</div>
                            <p class="preview-explicacao-texto" id="preview-explicacao-texto">A explicação aparecerá aqui.</p>
                            <div class="preview-gabarito" id="preview-gabarito"></div>
                            <div class="preview-referencia" id="preview-referencia"></div>
                        </div>
                        <img id="preview-imagem-explicacao" class="preview-imagem-explicacao" style="display:none;">
                    </div>

                    <div class="preview-navegacao">
                        <button type="button" class="botao botao-secundario botao-pequeno" id="btn-preview-anterior">‹ Anterior</button>
                        <span class="preview-posicao" id="preview-posicao">Questão 1 de 1</span>
                        <button type="button" class="botao botao-secundario botao-pequeno" id="btn-preview-proxima">Próxima ›</button>
                    </div>
                </div>
            </div>
        </aside>
    </form>
</main>

<script>
const valor = id => document.getElementById(id);
const listaPerguntasEl = valor('lista-perguntas');
const avisoSemPerguntasEl = valor('aviso-sem-perguntas');

let perguntas = <?= json_encode($perguntas_prova_iniciais, JSON_UNESCAPED_UNICODE) ?>;
let contadorPerguntas = <?= (int) $contador_pergunta_inicial ?>;
let contadorAlternativas = <?= (int) $contador_alternativa_inicial ?>;
let indicePreview = 0;

function letraDaAlternativa(indice){
    return String.fromCharCode(65 + indice);
}

function criarAlternativaVazia(){
    contadorAlternativas++;
    return { id: 'alt-' + contadorAlternativas, texto: '' };
}

function criarPerguntaVazia(){
    contadorPerguntas++;
    return {
        id: 'pergunta-' + contadorPerguntas,
        fonte: '',
        enunciado: '',
        alternativas: [criarAlternativaVazia(), criarAlternativaVazia()],
        corretaId: null,
        explicacao: '',
        referencia: '',
        imagem: null
    };
}

const textoDificuldade = { facil: 'Fácil', medio: 'Médio', dificil: 'Difícil' };
const classeDificuldade = { facil: 'facil', medio: 'medio', dificil: 'dificil' };

function atualizarFichaProva(){
    const titulo = valor('titulo-prova').value.trim();
    const ano = valor('ano-prova').value.trim();
    const versao = [valor('fase-prova').value.trim(), valor('versao-prova').value.trim()].filter(Boolean).join(' - ');
    const dificuldade = valor('dificuldade-prova').value;

    valor('preview-titulo-prova').textContent = titulo || 'Título da prova';
    valor('preview-ano-prova').textContent = ano || 'Ano não definido';
    valor('preview-versao-prova').textContent = versao || 'Sem versão';

    const badgeDificuldade = valor('preview-dificuldade-prova');
    if (dificuldade) {
        badgeDificuldade.textContent = textoDificuldade[dificuldade];
        badgeDificuldade.className = 'badge-dificuldade ' + classeDificuldade[dificuldade];
    } else {
        badgeDificuldade.textContent = 'Dificuldade';
        badgeDificuldade.className = 'badge-dificuldade indefinido';
    }
}

['titulo-prova', 'ano-prova', 'fase-prova', 'versao-prova', 'dificuldade-prova', 'acervo-prova'].forEach(id => {
    valor(id).addEventListener('input', atualizarFichaProva);
    valor(id).addEventListener('change', atualizarFichaProva);
});

function renderizarListaPerguntas(){
    avisoSemPerguntasEl.style.display = perguntas.length ? 'none' : 'block';
    listaPerguntasEl.innerHTML = '';

    perguntas.forEach((pergunta, indice) => {
        const card = document.createElement('div');
        card.className = 'cartao-pergunta';
        card.dataset.id = pergunta.id;

        card.innerHTML = `
            <div class="cartao-pergunta-cabecalho">
                <span class="badge-numero-pergunta">Q${indice + 1}</span>
                <input type="text" class="input-fonte" placeholder="Fonte da questão (ex.: Fuvest 2023)">
                <div class="acoes-pergunta">
                    <button type="button" class="btn-icone btn-remover-pergunta" title="Remover pergunta">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="cartao-pergunta-corpo">
                <div class="campo">
                    <label>Enunciado da pergunta</label>
                    <textarea class="input-enunciado" placeholder="Digite o enunciado da pergunta..."></textarea>
                </div>
                <div class="campo">
                    <label>Alternativas</label>
                    <div class="lista-alternativas"></div>
                    <button type="button" class="botao botao-secundario botao-pequeno btn-add-alternativa" style="margin-top:10px;">
                        <i class="fa-solid fa-plus"></i> Adicionar alternativa
                    </button>
                    <small class="dica-correta">Marque o círculo à esquerda da alternativa correta.</small>
                </div>
                <div class="campo">
                    <label>Explicação (exibida ao aluno depois de responder)</label>
                    <textarea class="input-explicacao" placeholder="Explique por que essa é a resposta correta..."></textarea>
                </div>
                <div class="linha">
                    <div class="campo">
                        <label>Referência (opcional)</label>
                        <input type="text" class="input-referencia" placeholder="Ex.: FAUSTO, Boris. História do Brasil...">
                    </div>
                    <div class="campo">
                        <label>Imagem de apoio (opcional)</label>
                        <label class="zona-upload-pequena zona-upload-imagem">
                            <span class="texto-zona-imagem"><i class="fa-regular fa-image"></i> Clique ou arraste uma imagem</span>
                            <input type="file" class="input-imagem-explicacao" accept="image/*" hidden>
                        </label>
                    </div>
                </div>
            </div>
        `;

        listaPerguntasEl.appendChild(card);

        card.querySelector('.input-fonte').value = pergunta.fonte;
        card.querySelector('.input-enunciado').value = pergunta.enunciado;
        card.querySelector('.input-explicacao').value = pergunta.explicacao;
        card.querySelector('.input-referencia').value = pergunta.referencia;
        if (pergunta.imagem) {
            card.querySelector('.texto-zona-imagem').outerHTML = `<span class="nome-arquivo">${escaparHtml(pergunta.imagem.nome)}</span>`;
        }

        renderizarAlternativas(card, pergunta);

        card.querySelector('.input-fonte').addEventListener('input', (e) => {
            pergunta.fonte = e.target.value;
            atualizarPreview();
        });
        card.querySelector('.input-enunciado').addEventListener('input', (e) => {
            pergunta.enunciado = e.target.value;
            atualizarPreview();
        });
        card.querySelector('.input-explicacao').addEventListener('input', (e) => {
            pergunta.explicacao = e.target.value;
            atualizarPreview();
        });
        card.querySelector('.input-referencia').addEventListener('input', (e) => {
            pergunta.referencia = e.target.value;
            atualizarPreview();
        });

        card.querySelector('.btn-remover-pergunta').addEventListener('click', () => {
            perguntas = perguntas.filter(p => p.id !== pergunta.id);
            if (indicePreview >= perguntas.length) indicePreview = Math.max(0, perguntas.length - 1);
            renderizarListaPerguntas();
            atualizarPreview();
        });

        card.querySelector('.btn-add-alternativa').addEventListener('click', () => {
            if (pergunta.alternativas.length >= 8) return;
            pergunta.alternativas.push(criarAlternativaVazia());
            renderizarAlternativas(card, pergunta);
            atualizarPreview();
        });

        const zonaImagem = card.querySelector('.zona-upload-imagem');
        const inputImagem = card.querySelector('.input-imagem-explicacao');
        zonaImagem.addEventListener('click', (e) => { e.preventDefault(); inputImagem.click(); });
        zonaImagem.addEventListener('dragover', (e) => { e.preventDefault(); zonaImagem.classList.add('arrastando'); });
        zonaImagem.addEventListener('dragleave', () => zonaImagem.classList.remove('arrastando'));
        zonaImagem.addEventListener('drop', (e) => {
            e.preventDefault();
            zonaImagem.classList.remove('arrastando');
            if (e.dataTransfer.files && e.dataTransfer.files.length) {
                definirImagemExplicacao(pergunta, zonaImagem, e.dataTransfer.files[0]);
            }
        });
        inputImagem.addEventListener('change', () => {
            if (inputImagem.files.length) definirImagemExplicacao(pergunta, zonaImagem, inputImagem.files[0]);
        });

        card.addEventListener('focusin', () => {
            indicePreview = perguntas.findIndex(p => p.id === pergunta.id);
            atualizarPreview();
        });
    });
}

function definirImagemExplicacao(pergunta, zonaImagem, arquivo){
    const url = URL.createObjectURL(arquivo);
    pergunta.imagem = { nome: arquivo.name, url };
    const antigo = zonaImagem.querySelector('.texto-zona-imagem, .nome-arquivo');
    if (antigo) antigo.outerHTML = `<span class="nome-arquivo">${escaparHtml(arquivo.name)}</span>`;
    atualizarPreview();
}

function renderizarAlternativas(card, pergunta){
    const container = card.querySelector('.lista-alternativas');
    container.innerHTML = '';

    pergunta.alternativas.forEach((alternativa, indice) => {
        const linha = document.createElement('div');
        linha.className = 'linha-alternativa' + (pergunta.corretaId === alternativa.id ? ' correta' : '');
        linha.innerHTML = `
            <input type="radio" class="radio-correta" name="correta-${pergunta.id}">
            <span class="letra-alternativa">${letraDaAlternativa(indice)}</span>
            <input type="text" class="input-alternativa" placeholder="Digite a alternativa...">
            <button type="button" class="btn-remover-alternativa" title="Remover alternativa">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;
        container.appendChild(linha);

        const radio = linha.querySelector('.radio-correta');
        const inputTexto = linha.querySelector('.input-alternativa');
        radio.checked = pergunta.corretaId === alternativa.id;
        inputTexto.value = alternativa.texto;

        radio.addEventListener('change', () => {
            pergunta.corretaId = alternativa.id;
            renderizarAlternativas(card, pergunta);
            atualizarPreview();
        });
        inputTexto.addEventListener('input', (e) => {
            alternativa.texto = e.target.value;
            atualizarPreview();
        });
        linha.querySelector('.btn-remover-alternativa').addEventListener('click', () => {
            if (pergunta.alternativas.length <= 2) {
                alert('A pergunta precisa ter pelo menos 2 alternativas.');
                return;
            }
            pergunta.alternativas = pergunta.alternativas.filter(a => a.id !== alternativa.id);
            if (pergunta.corretaId === alternativa.id) pergunta.corretaId = null;
            renderizarAlternativas(card, pergunta);
            atualizarPreview();
        });
    });
}

function escaparHtml(texto){
    return String(texto).replace(/[&<>"']/g, (c) => ({
        '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#39;'
    }[c]));
}

const previewSemPerguntasEl = valor('preview-sem-perguntas');
const previewQuestaoEl = valor('preview-questao');
const previewExplicacaoEl = valor('preview-explicacao');
let explicacaoVisivel = false;

function atualizarPreview(){
    if (!perguntas.length) {
        previewSemPerguntasEl.style.display = 'block';
        previewQuestaoEl.style.display = 'none';
        return;
    }
    previewSemPerguntasEl.style.display = 'none';
    previewQuestaoEl.style.display = 'block';

    if (indicePreview >= perguntas.length) indicePreview = perguntas.length - 1;
    if (indicePreview < 0) indicePreview = 0;
    const pergunta = perguntas[indicePreview];

    valor('preview-badge').textContent = 'Q' + (indicePreview + 1);
    valor('preview-fonte').textContent = pergunta.fonte.trim() || 'Fonte da questão';
    valor('preview-enunciado').textContent = pergunta.enunciado.trim() || 'O enunciado da pergunta aparecerá aqui.';
    valor('preview-posicao').textContent = `Questão ${indicePreview + 1} de ${perguntas.length}`;

    const containerAlternativas = valor('preview-alternativas');
    containerAlternativas.innerHTML = '';
    pergunta.alternativas.forEach((alternativa, indice) => {
        const div = document.createElement('div');
        const marcada = explicacaoVisivel && pergunta.corretaId === alternativa.id;
        div.className = 'preview-alternativa' + (marcada ? ' correta-marcada' : '');
        div.innerHTML = `
            <span class="letra-alternativa">${letraDaAlternativa(indice)}</span>
            <span>${escaparHtml(alternativa.texto.trim() || ('Alternativa ' + letraDaAlternativa(indice)))}</span>
        `;
        containerAlternativas.appendChild(div);
    });

    previewExplicacaoEl.style.display = explicacaoVisivel ? 'flex' : 'none';
    if (explicacaoVisivel) {
        valor('preview-explicacao-texto').textContent = pergunta.explicacao.trim() || 'A explicação aparecerá aqui.';
        const indiceCorreta = pergunta.alternativas.findIndex(a => a.id === pergunta.corretaId);
        valor('preview-gabarito').textContent = indiceCorreta >= 0
            ? 'Gabarito correto: ' + letraDaAlternativa(indiceCorreta)
            : 'Marque a alternativa correta nesta pergunta.';
        valor('preview-referencia').textContent = pergunta.referencia.trim() ? 'Referência: ' + pergunta.referencia.trim() : '';
        const imgEl = valor('preview-imagem-explicacao');
        if (pergunta.imagem) {
            imgEl.src = pergunta.imagem.url;
            imgEl.style.display = 'block';
        } else {
            imgEl.style.display = 'none';
        }
    }

    valor('btn-preview-anterior').disabled = indicePreview === 0;
    valor('btn-preview-proxima').disabled = indicePreview === perguntas.length - 1;
}

valor('btn-ver-explicacao').addEventListener('click', () => {
    explicacaoVisivel = !explicacaoVisivel;
    valor('btn-ver-explicacao').textContent = explicacaoVisivel ? 'Ocultar explicação' : 'Ver explicação';
    atualizarPreview();
});
valor('btn-preview-anterior').addEventListener('click', () => {
    if (indicePreview > 0) { indicePreview--; explicacaoVisivel = false; valor('btn-ver-explicacao').textContent = 'Ver explicação'; atualizarPreview(); }
});
valor('btn-preview-proxima').addEventListener('click', () => {
    if (indicePreview < perguntas.length - 1) { indicePreview++; explicacaoVisivel = false; valor('btn-ver-explicacao').textContent = 'Ver explicação'; atualizarPreview(); }
});

valor('btn-adicionar-pergunta').addEventListener('click', () => {
    const novaPergunta = criarPerguntaVazia();
    perguntas.push(novaPergunta);
    indicePreview = perguntas.length - 1;
    explicacaoVisivel = false;
    renderizarListaPerguntas();
    atualizarPreview();
});

function salvarProva(event, status = 'publicado'){
    if (event) event.preventDefault();

    if (!valor('acervo-prova').value) {
        alert('Selecione o acervo da prova.');
        return false;
    }
    if (!valor('titulo-prova').value.trim()) {
        alert('Preencha o título da prova.');
        return false;
    }
    if (!valor('dificuldade-prova').value) {
        alert('Selecione a dificuldade da prova.');
        return false;
    }
    if (!valor('ano-prova').value.trim()) {
        alert('Preencha o ano da prova.');
        return false;
    }
    if (!perguntas.length) {
        alert('Adicione pelo menos uma pergunta.');
        return false;
    }
    for (let i = 0; i < perguntas.length; i++) {
        const p = perguntas[i];
        if (!p.enunciado.trim()) {
            alert(`Preencha o enunciado da pergunta Q${i + 1}.`);
            return false;
        }
        if (p.alternativas.some(a => !a.texto.trim())) {
            alert(`Preencha todas as alternativas da pergunta Q${i + 1}.`);
            return false;
        }
        if (!p.corretaId) {
            alert(`Marque a alternativa correta da pergunta Q${i + 1}.`);
            return false;
        }
    }

    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Prova publicada com sucesso.');
    window.location.href = '<?= htmlspecialchars($link_voltar_prova) ?>';
    return false;
}

atualizarFichaProva();
renderizarListaPerguntas();
atualizarPreview();
</script>
</body>
</html>