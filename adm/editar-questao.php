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

$id_questao    = null;
$questao_atual = null;
if ($modo_formulario === 'editar') {
    $id_questao = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    foreach ($questoes as $item) {
        if ($item['id'] === $id_questao) {
            $questao_atual = $item;
            break;
        }
    }
} else {
    $id_questao = max(array_column($questoes, 'id')) + 1;
}

$mapa_bancas = $bancas_questoes;

$assuntos_existentes = array_values(array_unique(array_column($questoes, 'assunto')));
sort($assuntos_existentes);
$valor_curso_questao = $questao_atual['curso'] ?? '';

$valor_banca_questao       = $mapa_bancas[$questao_atual['banca'] ?? ''] ?? '';
$valor_ano_questao         = $questao_atual['ano'] ?? '';
$valor_dificuldade_questao = $questao_atual['dificuldade'] ?? '';
$valor_assunto_questao     = $questao_atual['assunto'] ?? '';
$valor_tipo_questao        = ($questao_atual['tipo'] ?? '') === 'dissertativo' ? 'dissertativa' : 'alternativa';

$valor_fonte_questao      = $questao_atual['fonte'] ?? '';
$valor_enunciado_questao  = $questao_atual['enunciado'] ?? '';
$valor_explicacao_questao = $questao_atual['explicacao'] ?? '';
$valor_referencia_questao = $questao_atual['referencia'] ?? '';
$valor_imagem_questao     = $questao_atual['imagem'] ?? '';
$valor_resposta_esperada  = $questao_atual['resposta_esperada'] ?? '';

$alternativas_questao = array_values($questao_atual['alternativas'] ?? []);
$indice_correta_questao = isset($questao_atual['correta']) ? (int) $questao_atual['correta'] : null;

$vestibular_pre_selecionado = $_GET['vestibular'] ?? $valor_banca_questao;

$link_voltar = '../comuns/visualizar-questoes.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title><?= $modo_formulario === 'editar' ? 'Editar Questão' : 'Nova Questão' ?> | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/adm-questao.css">
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
            <a class="voltar" href="<?= htmlspecialchars($link_voltar) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para o banco de questões</a>
            <h1><?= $modo_formulario === 'editar' ? 'Editar Questão' : 'Nova Questão' ?></h1>
            <p><?= $modo_formulario === 'editar' ? 'Atualize os dados da questão, o enunciado, as alternativas e a explicação.' : 'Cadastre uma nova questão no banco: dados, enunciado, alternativas e explicação.' ?></p>
<?php if ($modo_formulario === 'editar' && $questao_atual === null): ?>
            <p style="color:var(--vermelho); font-weight:600;">Questão não encontrada. Verifique o parâmetro "id" da URL.</p>
<?php endif; ?>
        </div>
    </header>

    <form id="form-questao" class="layout-editor" onsubmit="return salvarQuestao(event)">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_questao) ?>">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-circle-question"></i> Dados da questão</div>
            <div class="formulario">

                <div class="linha-3">
                    <div class="campo">
                        <label for="vestibular-questao">Vestibular</label>
                        <select id="vestibular-questao" required>
                            <option value="" <?= $valor_banca_questao === '' ? 'selected' : '' ?> disabled>Selecione o vestibular</option>
                            <?php
                            $opcoes_vestibular = array_flip($bancas_questoes) + ['outro' => 'Outro'];
                            foreach ($opcoes_vestibular as $valor => $rotulo) {
                                $sel = ($valor === $valor_banca_questao) ? ' selected' : '';
                                echo '<option value="' . $valor . '"' . $sel . '>' . htmlspecialchars($rotulo) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="ano-questao">Ano da Questão</label>
                        <input id="ano-questao" type="number" placeholder="Ex.: 2024" min="1950" max="2100" value="<?= htmlspecialchars((string) $valor_ano_questao) ?>" required>
                    </div>
                    <div class="campo">
                        <label for="dificuldade-questao">Dificuldade</label>
                        <select id="dificuldade-questao" required>
                            <option value="" <?= $valor_dificuldade_questao === '' ? 'selected' : '' ?> disabled>Selecione a dificuldade</option>
                            <option value="facil" <?= $valor_dificuldade_questao === 'facil' ? 'selected' : '' ?>>Fácil</option>
                            <option value="medio" <?= $valor_dificuldade_questao === 'medio' ? 'selected' : '' ?>>Médio</option>
                            <option value="dificil" <?= $valor_dificuldade_questao === 'dificil' ? 'selected' : '' ?>>Difícil</option>
                        </select>
                    </div>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="assunto-questao">Assunto</label>
                        <input id="assunto-questao" type="text" list="lista-assuntos" placeholder="Ex.: Revolução Francesa" value="<?= htmlspecialchars($valor_assunto_questao) ?>" required>
                        <datalist id="lista-assuntos">
                            <?php foreach ($assuntos_existentes as $assunto_existente): ?>
                            <option value="<?= htmlspecialchars($assunto_existente) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="campo">
                        <label for="tipo-questao">Tipo de Questão</label>
                        <select id="tipo-questao" required>
                            <option value="alternativa" <?= $valor_tipo_questao === 'alternativa' ? 'selected' : '' ?>>Alternativa (múltipla escolha)</option>
                            <option value="dissertativa" <?= $valor_tipo_questao === 'dissertativa' ? 'selected' : '' ?>>Dissertativa</option>
                        </select>
                    </div>
                </div>

                <div class="campo">
                    <label for="curso-questao">Curso relacionado (opcional)</label>
                    <select id="curso-questao" name="curso">
                        <option value="">Nenhum curso</option>
                        <?php foreach ($cursos as $curso_opcao): ?>
                        <option value="<?= htmlspecialchars($curso_opcao['slug']) ?>" <?= $curso_opcao['slug'] === $valor_curso_questao ? 'selected' : '' ?>><?= htmlspecialchars($curso_opcao['titulo']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="ajuda">Questões vinculadas a um curso podem ser usadas nas listas de exercícios dele.</span>
                </div>

                <hr class="separador-secao">

                <div class="campo">
                    <label for="fonte-questao">Fonte da questão (opcional)</label>
                    <input id="fonte-questao" type="text" placeholder="Ex.: FGV 2024 - Analista Judiciário" value="<?= htmlspecialchars($valor_fonte_questao) ?>">
                </div>

                <div class="campo">
                    <label for="enunciado-questao">Enunciado da pergunta</label>
                    <textarea id="enunciado-questao" placeholder="Digite o enunciado da pergunta..." required><?= htmlspecialchars($valor_enunciado_questao) ?></textarea>
                </div>

                <div class="campo" id="bloco-alternativas">
                    <label>Alternativas</label>
                    <div class="lista-alternativas" id="lista-alternativas"></div>
                    <button type="button" class="botao botao-secundario botao-pequeno" id="btn-add-alternativa" style="margin-top:10px;">
                        <i class="fa-solid fa-plus"></i> Adicionar alternativa
                    </button>
                    <small class="dica-correta">Marque o círculo à esquerda da alternativa correta.</small>
                </div>

                <div class="campo" id="bloco-dissertativa" style="display:<?= $valor_tipo_questao === 'dissertativa' ? 'block' : 'none' ?>;">
                    <label for="resposta-esperada-questao">Resposta esperada / Gabarito discursivo</label>
                    <textarea id="resposta-esperada-questao" placeholder="Descreva os pontos que a resposta do aluno deveria abordar..."><?= htmlspecialchars($valor_resposta_esperada) ?></textarea>
                    <span class="ajuda">Usado como referência para correção manual da questão dissertativa.</span>
                </div>

                <div class="campo">
                    <label for="explicacao-questao">Explicação (exibida ao aluno depois de responder)</label>
                    <textarea id="explicacao-questao" placeholder="Explique por que essa é a resposta correta..."><?= htmlspecialchars($valor_explicacao_questao) ?></textarea>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="referencia-questao">Referência (opcional)</label>
                        <input id="referencia-questao" type="text" placeholder="Ex.: FAUSTO, Boris. História do Brasil..." value="<?= htmlspecialchars($valor_referencia_questao) ?>">
                    </div>
                    <div class="campo">
                        <label>Imagem de apoio (opcional)</label>
                        <label class="zona-upload-pequena" id="zona-upload-imagem">
                            <span class="texto-zona-imagem" id="texto-zona-imagem"><i class="fa-regular fa-image"></i> Clique ou arraste uma imagem</span>
                            <input type="file" id="input-imagem-explicacao" accept="image/*" hidden>
                        </label>
                    </div>
                </div>

                <div class="acoes">
                    <a class="botao botao-secundario" href="<?= htmlspecialchars($link_voltar) ?>">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarQuestao(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> <?= $modo_formulario === 'editar' ? 'Salvar alterações' : 'Publicar Questão' ?></button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização da questão">
            <div class="cartao-cabecalho">Pré-visualização (visão do aluno)</div>
            <div class="preview-conteudo" id="preview-conteudo">

                <div class="ficha-questao">
                    <div class="linha-info">
                        <span class="item-info"><i class="fa-solid fa-landmark"></i> <span id="preview-vestibular">Vestibular</span></span>
                        <span class="item-info"><i class="fa-regular fa-calendar"></i> <span id="preview-ano">Ano</span></span>
                        <span class="item-info"><i class="fa-solid fa-book"></i> <span id="preview-assunto">Assunto</span></span>
                        <span class="badge-dificuldade indefinido" id="preview-dificuldade">Dificuldade</span>
                    </div>
                </div>

                <p class="preview-enunciado" id="preview-fonte" style="color:var(--vinho); font-weight:700; margin-bottom:6px;">Fonte da questão</p>
                <p class="preview-enunciado" id="preview-enunciado">O enunciado da pergunta aparecerá aqui.</p>

                <div id="preview-bloco-alternativas">
                    <div class="preview-alternativas-titulo">Alternativas:</div>
                    <div class="preview-alternativas" id="preview-alternativas"></div>
                </div>

                <div id="preview-bloco-dissertativa" style="display:none;">
                    <div class="preview-alternativas-titulo">Espaço para resposta do aluno:</div>
                    <div class="preview-resposta-dissertativa">Campo de resposta dissertativa aparecerá aqui para o aluno preencher.</div>
                </div>

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
            </div>
        </aside>
    </form>
</main>

<script>
const valor = id => document.getElementById(id);

let alternativas = [];
let contadorAlternativas = 0;
let corretaId = null;

function letraDaAlternativa(indice){
    return String.fromCharCode(65 + indice);
}

function criarAlternativaVazia(){
    contadorAlternativas++;
    return { id: 'alt-' + contadorAlternativas, texto: '' };
}

function renderizarAlternativas(){
    const container = valor('lista-alternativas');
    container.innerHTML = '';

    alternativas.forEach((alternativa, indice) => {
        const linha = document.createElement('div');
        linha.className = 'linha-alternativa' + (corretaId === alternativa.id ? ' correta' : '');
        linha.innerHTML = `
            <input type="radio" class="radio-correta" name="correta-questao">
            <span class="letra-alternativa">${letraDaAlternativa(indice)}</span>
            <input type="text" class="input-alternativa" placeholder="Digite a alternativa...">
            <button type="button" class="btn-remover-alternativa" title="Remover alternativa">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;
        container.appendChild(linha);

        const radio = linha.querySelector('.radio-correta');
        const inputTexto = linha.querySelector('.input-alternativa');
        radio.checked = corretaId === alternativa.id;
        inputTexto.value = alternativa.texto;

        radio.addEventListener('change', () => {
            corretaId = alternativa.id;
            renderizarAlternativas();
            atualizarPreview();
        });
        inputTexto.addEventListener('input', (e) => {
            alternativa.texto = e.target.value;
            atualizarPreview();
        });
        linha.querySelector('.btn-remover-alternativa').addEventListener('click', () => {
            if (alternativas.length <= 2) {
                alert('A questão precisa ter pelo menos 2 alternativas.');
                return;
            }
            alternativas = alternativas.filter(a => a.id !== alternativa.id);
            if (corretaId === alternativa.id) corretaId = null;
            renderizarAlternativas();
            atualizarPreview();
        });
    });
}

valor('btn-add-alternativa').addEventListener('click', () => {
    if (alternativas.length >= 8) return;
    alternativas.push(criarAlternativaVazia());
    renderizarAlternativas();
    atualizarPreview();
});

function atualizarTipoQuestao(){
    const tipo = valor('tipo-questao').value;
    const ehAlternativa = tipo === 'alternativa';

    valor('bloco-alternativas').style.display = ehAlternativa ? 'block' : 'none';
    valor('bloco-dissertativa').style.display = ehAlternativa ? 'none' : 'block';
    valor('preview-bloco-alternativas').style.display = ehAlternativa ? 'block' : 'none';
    valor('preview-bloco-dissertativa').style.display = ehAlternativa ? 'none' : 'block';
}
valor('tipo-questao').addEventListener('change', () => { atualizarTipoQuestao(); atualizarPreview(); });

let imagemApoio = null;
const zonaImagem = valor('zona-upload-imagem');
const inputImagem = valor('input-imagem-explicacao');

zonaImagem.addEventListener('click', (e) => { e.preventDefault(); inputImagem.click(); });
zonaImagem.addEventListener('dragover', (e) => { e.preventDefault(); zonaImagem.classList.add('arrastando'); });
zonaImagem.addEventListener('dragleave', () => zonaImagem.classList.remove('arrastando'));
zonaImagem.addEventListener('drop', (e) => {
    e.preventDefault();
    zonaImagem.classList.remove('arrastando');
    if (e.dataTransfer.files && e.dataTransfer.files.length) definirImagemExplicacao(e.dataTransfer.files[0]);
});
inputImagem.addEventListener('change', () => {
    if (inputImagem.files.length) definirImagemExplicacao(inputImagem.files[0]);
});

function definirImagemExplicacao(arquivo){
    const url = URL.createObjectURL(arquivo);
    imagemApoio = { nome: arquivo.name, url };
    const antigo = zonaImagem.querySelector('.texto-zona-imagem, .nome-arquivo');
    if (antigo) antigo.outerHTML = `<span class="nome-arquivo">${escaparHtml(arquivo.name)}</span>`;
    atualizarPreview();
}

function escaparHtml(texto){
    return String(texto).replace(/[&<>"']/g, (c) => ({
        '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#39;'
    }[c]));
}

const textoDificuldade = { facil: 'Fácil', medio: 'Médio', dificil: 'Difícil' };
const classeDificuldade = { facil: 'facil', medio: 'medio', dificil: 'dificil' };
const textoVestibular = {
    fgv: 'FGV', cebraspe: 'CEBRASPE', fuvest: 'FUVEST', enem: 'ENEM',
    espcex: 'EsPCEx', vunesp: 'VUNESP', unicamp: 'UNICAMP', unesp: 'UNESP', outro: 'Outro'
};

function atualizarFichaQuestao(){
    const vestibular = valor('vestibular-questao').value;
    const ano = valor('ano-questao').value.trim();
    const assunto = valor('assunto-questao').value.trim();
    const dificuldade = valor('dificuldade-questao').value;

    valor('preview-vestibular').textContent = vestibular ? textoVestibular[vestibular] : 'Vestibular';
    valor('preview-ano').textContent = ano || 'Ano';
    valor('preview-assunto').textContent = assunto || 'Assunto';

    const badgeDificuldade = valor('preview-dificuldade');
    if (dificuldade) {
        badgeDificuldade.textContent = textoDificuldade[dificuldade];
        badgeDificuldade.className = 'badge-dificuldade ' + classeDificuldade[dificuldade];
    } else {
        badgeDificuldade.textContent = 'Dificuldade';
        badgeDificuldade.className = 'badge-dificuldade indefinido';
    }
}

['vestibular-questao', 'ano-questao', 'assunto-questao', 'dificuldade-questao'].forEach(id => {
    valor(id).addEventListener('input', atualizarFichaQuestao);
    valor(id).addEventListener('change', atualizarFichaQuestao);
});

let explicacaoVisivel = false;

function atualizarPreview(){
    valor('preview-fonte').textContent = valor('fonte-questao').value.trim() || 'Fonte da questão';
    valor('preview-enunciado').textContent = valor('enunciado-questao').value.trim() || 'O enunciado da pergunta aparecerá aqui.';

    const containerAlternativas = valor('preview-alternativas');
    containerAlternativas.innerHTML = '';
    alternativas.forEach((alternativa, indice) => {
        const div = document.createElement('div');
        const marcada = explicacaoVisivel && corretaId === alternativa.id;
        div.className = 'preview-alternativa' + (marcada ? ' correta-marcada' : '');
        div.innerHTML = `
            <span class="letra-alternativa">${letraDaAlternativa(indice)}</span>
            <span>${escaparHtml(alternativa.texto.trim() || ('Alternativa ' + letraDaAlternativa(indice)))}</span>
        `;
        containerAlternativas.appendChild(div);
    });

    valor('preview-explicacao').style.display = explicacaoVisivel ? 'flex' : 'none';
    if (explicacaoVisivel) {
        valor('preview-explicacao-texto').textContent = valor('explicacao-questao').value.trim() || 'A explicação aparecerá aqui.';

        const tipo = valor('tipo-questao').value;
        if (tipo === 'alternativa') {
            const indiceCorreta = alternativas.findIndex(a => a.id === corretaId);
            valor('preview-gabarito').textContent = indiceCorreta >= 0
                ? 'Gabarito correto: ' + letraDaAlternativa(indiceCorreta)
                : 'Marque a alternativa correta desta questão.';
        } else {
            const resposta = valor('resposta-esperada-questao').value.trim();
            valor('preview-gabarito').textContent = resposta
                ? 'Resposta esperada: ' + resposta
                : 'Descreva a resposta esperada para a correção.';
        }

        valor('preview-referencia').textContent = valor('referencia-questao').value.trim()
            ? 'Referência: ' + valor('referencia-questao').value.trim()
            : '';

        const imgEl = valor('preview-imagem-explicacao');
        if (imagemApoio) {
            imgEl.src = imagemApoio.url;
            imgEl.style.display = 'block';
        } else {
            imgEl.style.display = 'none';
        }
    }
}

['fonte-questao', 'enunciado-questao', 'explicacao-questao', 'referencia-questao', 'resposta-esperada-questao'].forEach(id => {
    valor(id).addEventListener('input', atualizarPreview);
});

valor('btn-ver-explicacao').addEventListener('click', () => {
    explicacaoVisivel = !explicacaoVisivel;
    valor('btn-ver-explicacao').textContent = explicacaoVisivel ? 'Ocultar explicação' : 'Ver explicação';
    atualizarPreview();
});

function salvarQuestao(event, status = 'publicado'){
    if (event) event.preventDefault();

    if (!valor('vestibular-questao').value) { alert('Selecione o vestibular da questão.'); return false; }
    if (!valor('ano-questao').value.trim()) { alert('Preencha o ano da questão.'); return false; }
    if (!valor('dificuldade-questao').value) { alert('Selecione a dificuldade da questão.'); return false; }
    if (!valor('assunto-questao').value.trim()) { alert('Preencha o assunto da questão.'); return false; }
    if (!valor('enunciado-questao').value.trim()) { alert('Preencha o enunciado da questão.'); return false; }

    const tipo = valor('tipo-questao').value;
    if (tipo === 'alternativa') {
        if (alternativas.length < 2) { alert('Adicione pelo menos 2 alternativas.'); return false; }
        if (alternativas.some(a => !a.texto.trim())) { alert('Preencha todas as alternativas.'); return false; }
        if (!corretaId) { alert('Marque a alternativa correta desta questão.'); return false; }
    }

    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Questão publicada com sucesso.');
    window.location.href = '<?= htmlspecialchars($link_voltar) ?>';
    return false;
}

<?php if ($vestibular_pre_selecionado): ?>
valor('vestibular-questao').value = <?= json_encode(strtolower($vestibular_pre_selecionado)) ?>;
<?php endif; ?>

const alternativasIniciais = <?= json_encode($alternativas_questao, JSON_UNESCAPED_UNICODE) ?>;
const indiceCorretaInicial = <?= json_encode($indice_correta_questao) ?>;

if (alternativasIniciais.length) {
    alternativasIniciais.forEach((texto, indice) => {
        const alternativa = criarAlternativaVazia();
        alternativa.texto = texto;
        alternativas.push(alternativa);
        if (indiceCorretaInicial === indice) corretaId = alternativa.id;
    });
} else {
    alternativas.push(criarAlternativaVazia());
    alternativas.push(criarAlternativaVazia());
}

const imagemInicial = <?= json_encode($valor_imagem_questao, JSON_UNESCAPED_UNICODE) ?>;
if (imagemInicial) {
    imagemApoio = { nome: imagemInicial.split('/').pop(), url: imagemInicial };
    const textoZona = zonaImagem.querySelector('.texto-zona-imagem');
    if (textoZona) textoZona.outerHTML = `<span class="nome-arquivo">${escaparHtml(imagemApoio.nome)}</span>`;
}

renderizarAlternativas();
atualizarTipoQuestao();
atualizarFichaQuestao();
atualizarPreview();
</script>
</body>
</html>