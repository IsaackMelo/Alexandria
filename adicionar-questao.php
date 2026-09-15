<?php
// Parâmetros opcionais vindos da tela de listagem (ex.: já veio de um acervo/banca específica)
$vestibular_pre_selecionado = $_GET['vestibular'] ?? '';

// Página para onde os links de "Cancelar" / após salvar devem apontar
$link_voltar = 'visualizar-questoes.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Adicionar Questão | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/adicionar-questao.css">
</head>

<body>
<?php
    include("../alexandria-frontend/includes/barraadm.html");
    include("../alexandria-frontend/includes/sidebaradm.html");
?>
<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="<?= htmlspecialchars($link_voltar) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para o banco de questões</a>
            <h1>Adicionar Questão</h1>
            <p>Preencha os dados da questão e crie o enunciado, alternativas e explicação.</p>
        </div>
    </header>

    <form id="form-questao" class="layout-editor" onsubmit="return salvarQuestao(event)">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-circle-question"></i> Dados da questão</div>
            <div class="formulario">

                <div class="linha-3">
                    <div class="campo">
                        <label for="vestibular-questao">Vestibular</label>
                        <select id="vestibular-questao" required>
                            <option value="" selected disabled>Selecione o vestibular</option>
                            <option value="fgv">FGV</option>
                            <option value="cebraspe">CEBRASPE</option>
                            <option value="fuvest">FUVEST</option>
                            <option value="enem">ENEM</option>
                            <option value="espcex">EsPCEx</option>
                            <option value="vunesp">VUNESP</option>
                            <option value="unicamp">UNICAMP</option>
                            <option value="unesp">UNESP</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="ano-questao">Ano da Questão</label>
                        <input id="ano-questao" type="number" placeholder="Ex.: 2024" min="1950" max="2100" required>
                    </div>
                    <div class="campo">
                        <label for="dificuldade-questao">Dificuldade</label>
                        <select id="dificuldade-questao" required>
                            <option value="" selected disabled>Selecione a dificuldade</option>
                            <option value="facil">Fácil</option>
                            <option value="medio">Médio</option>
                            <option value="dificil">Difícil</option>
                        </select>
                    </div>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="assunto-questao">Assunto</label>
                        <input id="assunto-questao" type="text" placeholder="Ex.: Revolução Francesa" required>
                    </div>
                    <div class="campo">
                        <label for="tipo-questao">Tipo de Questão</label>
                        <select id="tipo-questao" required>
                            <option value="alternativa">Alternativa (múltipla escolha)</option>
                            <option value="dissertativa">Dissertativa</option>
                        </select>
                    </div>
                </div>

                <hr class="separador-secao">

                <div class="campo">
                    <label for="fonte-questao">Fonte da questão (opcional)</label>
                    <input id="fonte-questao" type="text" placeholder="Ex.: FGV 2024 - Analista Judiciário">
                </div>

                <div class="campo">
                    <label for="enunciado-questao">Enunciado da pergunta</label>
                    <textarea id="enunciado-questao" placeholder="Digite o enunciado da pergunta..." required></textarea>
                </div>

                <!-- Bloco exibido apenas para questões do tipo Alternativa -->
                <div class="campo" id="bloco-alternativas">
                    <label>Alternativas</label>
                    <div class="lista-alternativas" id="lista-alternativas"></div>
                    <button type="button" class="botao botao-secundario botao-pequeno" id="btn-add-alternativa" style="margin-top:10px;">
                        <i class="fa-solid fa-plus"></i> Adicionar alternativa
                    </button>
                    <small class="dica-correta">Marque o círculo à esquerda da alternativa correta.</small>
                </div>

                <!-- Bloco exibido apenas para questões do tipo Dissertativa -->
                <div class="campo" id="bloco-dissertativa" style="display:none;">
                    <label for="resposta-esperada-questao">Resposta esperada / Gabarito discursivo</label>
                    <textarea id="resposta-esperada-questao" placeholder="Descreva os pontos que a resposta do aluno deveria abordar..."></textarea>
                    <span class="ajuda">Usado como referência para correção manual da questão dissertativa.</span>
                </div>

                <div class="campo">
                    <label for="explicacao-questao">Explicação (exibida ao aluno depois de responder)</label>
                    <textarea id="explicacao-questao" placeholder="Explique por que essa é a resposta correta..."></textarea>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="referencia-questao">Referência (opcional)</label>
                        <input id="referencia-questao" type="text" placeholder="Ex.: FAUSTO, Boris. História do Brasil...">
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
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> Publicar Questão</button>
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

/* ===================== Alternativas ===================== */
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

/* ===================== Alternância Alternativa x Dissertativa ===================== */
function atualizarTipoQuestao(){
    const tipo = valor('tipo-questao').value;
    const ehAlternativa = tipo === 'alternativa';

    valor('bloco-alternativas').style.display = ehAlternativa ? 'block' : 'none';
    valor('bloco-dissertativa').style.display = ehAlternativa ? 'none' : 'block';
    valor('preview-bloco-alternativas').style.display = ehAlternativa ? 'block' : 'none';
    valor('preview-bloco-dissertativa').style.display = ehAlternativa ? 'none' : 'block';
}
valor('tipo-questao').addEventListener('change', () => { atualizarTipoQuestao(); atualizarPreview(); });

/* ===================== Imagem de apoio ===================== */
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

/* ===================== Ficha da questão (dados + preview) ===================== */
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

/* ===================== Pré-visualização (visão do aluno) ===================== */
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

/* ===================== Salvar questão ===================== */
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

/* ===================== Inicialização ===================== */
<?php if ($vestibular_pre_selecionado): ?>
valor('vestibular-questao').value = <?= json_encode(strtolower($vestibular_pre_selecionado)) ?>;
<?php endif; ?>

alternativas.push(criarAlternativaVazia());
alternativas.push(criarAlternativaVazia());
renderizarAlternativas();
atualizarTipoQuestao();
atualizarFichaQuestao();
atualizarPreview();
</script>
</body>
</html>