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

require_once __DIR__ . '/../includes/dados.php';

$curso    = $_GET['curso'] ?? '';
$id_item  = $_GET['id'] ?? '';

$exercicio_atual = null;
$numero_lista    = 0;
if ($curso !== '' && preg_match('/^modulo-(\d+)$/', $id_item, $correspondencia)) {
    $indice_item = (int) $correspondencia[1];
    foreach ($modulos_aulas[$curso]['itens'] ?? [] as $indice => $item) {
        if (($item['tipo'] ?? '') === 'exercicio') {
            $numero_lista++;
            if ($indice === $indice_item) {
                $exercicio_atual = $item;
                break;
            }
        }
    }
}

$titulo_curso = '';
foreach ($cursos as $item_curso) {
    if ($item_curso['slug'] === $curso) {
        $titulo_curso = $item_curso['titulo'];
        break;
    }
}

$valor_titulo_exercicio    = $exercicio_atual['titulo'] ?? '';
$valor_descricao_exercicio = $exercicio_atual['descricao'] ?? '';

$perguntas_da_lista = [];
foreach ($exercicio_atual['questoes'] ?? [] as $id_questao_lista) {
    $questao_lista = questao_por_id((int) $id_questao_lista);
    if ($questao_lista !== null) {
        $perguntas_da_lista[] = $questao_lista;
    }
}
$editor_inicial = perguntas_para_editor($perguntas_da_lista);

$link_resolver_lista = $exercicio_atual ? '../comuns/questao.php?' . http_build_query(['curso' => $curso, 'lista' => $numero_lista]) : '';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Editar Exercício | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/adm-editar-exercicio.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>
<?php
include __DIR__ . '/../includes/sidebar.php';
include __DIR__ . '/../includes/topbar.php';
?>
<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="editar-curso.php?curso=<?= htmlspecialchars($curso) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para curso</a>
            <h1>Editar Exercício</h1>
            <p>
                <?= $titulo_curso !== '' ? htmlspecialchars($titulo_curso) . ' · ' : '' ?>Crie as perguntas, alternativas e explicações deste exercício.
                <?php if ($link_resolver_lista !== ''): ?>
                <a href="<?= htmlspecialchars($link_resolver_lista) ?>" target="_blank" rel="noopener">Ver como aluno <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                <?php endif; ?>
            </p>
            <?php if ($curso !== '' && $exercicio_atual === null): ?>
            <p style="color:#b3261e; font-weight:600;">Lista de exercícios não encontrada. Verifique os parâmetros "curso" e "id" da URL.</p>
            <?php endif; ?>
        </div>
    </header>

    <form id="form-exercicio" class="layout-editor" onsubmit="return salvarExercicio(event)">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-list-check"></i> Conteúdo do exercício</div>
            <div class="formulario">

                <div class="campo">
                    <label for="titulo-exercicio">Título do Exercício</label>
                    <input id="titulo-exercicio" type="text" placeholder="Ex.: Exercícios sobre Era Vargas" value="<?= htmlspecialchars($valor_titulo_exercicio) ?>" required>
                </div>

                <div class="campo">
                    <label for="descricao-exercicio">Descrição da lista</label>
                    <input id="descricao-exercicio" name="descricao" type="text" placeholder="Ex.: Revolução de 1930 e Governo Constitucional." value="<?= htmlspecialchars($valor_descricao_exercicio) ?>">
                </div>

                <?php if (!empty($editor_inicial['dissertativas'])): ?>
                <div class="campo">
                    <label>Questões dissertativas desta lista</label>
                    <ul style="margin:0; padding-left:18px; font-size:13px;">
                        <?php foreach ($editor_inicial['dissertativas'] as $dissertativa): ?>
                        <li>
                            <?= htmlspecialchars($dissertativa['fonte'] ?? '') ?> — <?= htmlspecialchars(mb_strimwidth($dissertativa['enunciado'] ?? '', 0, 90, '…')) ?>
                            <a href="editar-questao.php?id=<?= (int) $dissertativa['id'] ?>">editar no banco</a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

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
                    <a class="botao botao-secundario" href="editar-curso.php?curso=<?= htmlspecialchars($curso) ?>">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarExercicio(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> Publicar Exercício</button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização do exercício">
            <div class="cartao-cabecalho">Pré-visualização (visão do aluno)</div>
            <div class="preview-conteudo" id="preview-conteudo">

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

let perguntas = <?= json_encode($editor_inicial['perguntas'], JSON_UNESCAPED_UNICODE) ?>;
let contadorPerguntas = <?= (int) $editor_inicial['contador_perguntas'] ?>;
let contadorAlternativas = <?= (int) $editor_inicial['contador_alternativas'] ?>;
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

function salvarExercicio(event, status = 'publicado'){
    if (event) event.preventDefault();

    if (!valor('titulo-exercicio').value.trim()) {
        alert('Preencha o título do exercício.');
        return false;
    }
    if (!perguntas.length && <?= empty($editor_inicial['dissertativas']) ? 'true' : 'false' ?>) {
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

    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Exercício publicado com sucesso.');
    window.location.href = 'editar-curso.php?curso=<?= htmlspecialchars($curso) ?>';
    return false;
}

renderizarListaPerguntas();
atualizarPreview();
</script>
</body>
</html>