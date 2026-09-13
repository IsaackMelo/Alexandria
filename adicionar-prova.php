<?php
// Acervo (banca) ao qual esta prova pertence, vindo da tela anterior
$acervo = $_GET['acervo'] ?? '';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Adicionar Prova | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --vinho:#8b1e2d;
            --vinho-escuro:#6f1724;
            --dourado:#d4af37;
            --fundo:#faf8f5;
            --borda:#e3dbd3;
            --texto:#2c2927; --muted:#777;
            --verde:#2e7d4f;
            --verde-bg:#eaf6ee;
            --vermelho:#a3383f;
            --vermelho-bg:#fbecec;
            --laranja:#b6791f;
            --laranja-bg:#fbf1e2;
        }

        * { box-sizing:border-box; }

        body {
            margin:0;
            background:var(--fundo);
            color:var(--texto);
            font-family:Inter,sans-serif;
        }

        .pagina {
            margin-left:156px;
            padding:32px 40px 48px;
            min-height:100vh;
        }

        .cabecalho-pagina {
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:20px;
            margin-bottom:24px;
        }

        .cabecalho-pagina h1 { margin:0 0 7px; font-size:27px; }
        .cabecalho-pagina p { margin:0; color:var(--muted); font-size:13px; }

        .voltar { color:var(--vinho); text-decoration:none; font-size:13px; font-weight:600; }

        .layout-editor {
            display:grid;
            grid-template-columns: minmax(0,1.35fr) minmax(320px,.75fr);
            gap:22px;
            align-items:start;
        }

        .cartao {
            border:1px solid var(--borda);
            border-radius:10px;
            background:#fff;
            box-shadow:0 2px 8px #4b2c140a;
        }

        .cartao-cabecalho {
            padding:18px 22px;
            border-bottom:1px solid var(--borda);
            font-size:15px;
            font-weight:700;
        }

        .formulario { padding:22px; }

        .campo { margin-bottom:18px; }

        .campo > label {
            display:block;
            margin-bottom:8px;
            font-size:12px;
            font-weight:700;
        }

        .campo input:not([type="radio"]):not([type="checkbox"]),
        .campo select,
        .campo textarea {
            width:100%;
            border:1px solid #d8cfc7;
            border-radius:6px;
            padding:11px 12px;
            color:var(--texto);
            background:#fff;
            font:inherit;
            font-size:13px;
            outline:none;
        }

        .campo input:not([type="radio"]):not([type="checkbox"]):focus, .campo select:focus, .campo textarea:focus {
            border-color:var(--dourado);
            box-shadow:0 0 0 3px #d4af3726;
        }

        .campo textarea { resize:vertical; min-height:70px; }

        .linha {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:16px;
        }

        .linha-3 {
            display:grid;
            grid-template-columns:1fr 1fr 1fr;
            gap:16px;
        }

        .ajuda { display:block; margin-top:6px; color:var(--muted); font-size:11px; }

        .cabecalho-secao {
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:16px;
        }
        .cabecalho-secao label { margin:0; font-size:12px; font-weight:700; }

        .botao {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            padding:11px 17px;
            border:1px solid transparent;
            border-radius:6px;
            cursor:pointer;
            font:600 12px Inter,sans-serif;
            text-decoration:none;
        }

        .botao-secundario { border-color:#d8cfc7; color:#555; background:#fff; }
        .botao-rascunho { border-color:var(--vinho); color:var(--vinho); background:#fff; }
        .botao-publicar { color:#fff; background:var(--vinho); }
        .botao-publicar:hover { background:var(--vinho-escuro); }
        .botao-pequeno { padding:7px 12px; font-size:11px; }

        .acoes {
            display:flex;
            justify-content:flex-end;
            gap:10px;
            padding-top:18px;
            border-top:1px solid #eee;
        }

        .aviso-vazio {
            border:1px dashed var(--borda);
            border-radius:8px;
            padding:26px;
            text-align:center;
            color:var(--muted);
            font-size:13px;
        }

        /* ===== Badges de dificuldade ===== */
        .badge-dificuldade {
            display:inline-flex;
            align-items:center;
            gap:5px;
            padding:3px 10px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }
        .badge-dificuldade.facil   { color:var(--verde);    background:var(--verde-bg); }
        .badge-dificuldade.medio   { color:var(--laranja);  background:var(--laranja-bg); }
        .badge-dificuldade.dificil { color:var(--vermelho); background:var(--vermelho-bg); }
        .badge-dificuldade.indefinido { color:var(--muted); background:#f1ece5; }

        /* ===== Ficha da prova (topo do preview) ===== */
        .ficha-prova {
            border:1px solid var(--borda);
            border-radius:8px;
            padding:14px 16px;
            margin-bottom:18px;
            background:var(--fundo);
        }
        .ficha-prova h3 {
            margin:0 0 10px;
            font-size:14px;
        }
        .ficha-prova .linha-info {
            display:flex;
            flex-wrap:wrap;
            gap:8px;
            align-items:center;
            font-size:12px;
            color:var(--muted);
        }
        .ficha-prova .linha-info .item-info {
            display:flex;
            align-items:center;
            gap:5px;
            border:1px solid var(--borda);
            background:#fff;
            border-radius:20px;
            padding:3px 10px;
        }
        .ficha-prova .linha-info .item-info i { color:var(--vinho); font-size:11px; }

        /* ===== Cartão de pergunta ===== */
        .cartao-pergunta {
            border:1px solid var(--borda);
            border-radius:10px;
            background:var(--fundo);
            margin-bottom:16px;
            overflow:hidden;
        }
        .cartao-pergunta-cabecalho {
            display:flex;
            align-items:center;
            gap:10px;
            padding:12px 14px;
            background:#f3ede4;
            border-bottom:1px solid var(--borda);
        }
        .badge-numero-pergunta {
            flex-shrink:0;
            width:30px;
            height:30px;
            border-radius:50%;
            background:var(--dourado);
            color:#fff;
            font-weight:700;
            font-size:12px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .cartao-pergunta-cabecalho input.input-fonte {
            flex:1;
            border:1px solid #d8cfc7;
            border-radius:6px;
            padding:8px 10px;
            font-size:12px;
            background:#fff;
        }
        .acoes-pergunta { display:flex; align-items:center; gap:6px; flex-shrink:0; }
        .btn-icone {
            width:30px;
            height:30px;
            border-radius:6px;
            border:1px solid var(--borda);
            background:#fff;
            color:#888;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
        }
        .btn-icone:hover { color:var(--vinho); border-color:var(--vinho); }
        .btn-remover-pergunta:hover { color:var(--vermelho); border-color:var(--vermelho); }

        .cartao-pergunta-corpo { padding:16px; background:#fff; }

        .lista-alternativas { display:flex; flex-direction:column; gap:8px; }
        .linha-alternativa {
            display:flex;
            align-items:center;
            gap:10px;
            border:1px solid var(--borda);
            border-radius:7px;
            padding:8px 10px;
            background:#fff;
        }
        .linha-alternativa.correta { border-color:var(--verde); background:var(--verde-bg); }
        .radio-correta {
            flex-shrink:0;
            width:16px !important;
            height:16px !important;
            padding:0 !important;
            border:none !important;
            background:transparent !important;
            accent-color:var(--verde);
            cursor:pointer;
        }
        .letra-alternativa {
            flex-shrink:0;
            width:24px;
            height:24px;
            border-radius:50%;
            background:var(--dourado);
            color:#fff;
            font-size:11px;
            font-weight:700;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .lista-alternativas .linha-alternativa .input-alternativa {
            flex:1 1 auto;
            width:auto !important;
            min-width:0;
            border:1px solid #d8cfc7 !important;
            border-radius:6px;
            padding:8px 10px !important;
            font-size:12.5px !important;
        }
        .btn-remover-alternativa {
            flex-shrink:0;
            width:26px;
            height:26px;
            border-radius:6px;
            border:1px solid var(--borda);
            background:#fff;
            color:#aaa;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
        }
        .btn-remover-alternativa:hover { color:var(--vermelho); border-color:var(--vermelho); }

        .dica-correta {
            display:block;
            margin-top:8px;
            font-size:11px;
            color:var(--muted);
        }

        /* ===== Upload pequeno (imagem de apoio) ===== */
        .zona-upload-pequena {
            display:flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            min-height:44px;
            border:1px dashed #cfc4ba;
            border-radius:6px;
            color:var(--muted);
            cursor:pointer;
            font-size:11.5px;
            padding:8px;
            text-align:center;
        }
        .zona-upload-pequena:hover, .zona-upload-pequena.arrastando { border-color:var(--vinho); color:var(--vinho); background:#fbf5f2; }
        .zona-upload-pequena .nome-arquivo { color:var(--vinho); font-weight:600; word-break:break-all; }

        /* ===================== PREVIEW (visão do aluno) ===================== */
        .preview { position:sticky; top:24px; overflow:hidden; }
        .preview-conteudo { padding:22px; }

        .preview-cabecalho-questao {
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:10px;
        }
        .badge-questao {
            flex-shrink:0;
            background:var(--dourado);
            color:#fff;
            font-weight:700;
            font-size:11px;
            border-radius:6px;
            padding:4px 8px;
        }
        .preview-fonte { color:var(--vinho); font-weight:700; font-size:13px; }

        .preview-enunciado { font-size:13px; line-height:1.6; color:var(--texto); margin:0 0 14px; }

        .preview-alternativas-titulo { font-size:11.5px; font-weight:700; margin-bottom:8px; }

        .preview-alternativas { display:flex; flex-direction:column; gap:8px; margin-bottom:16px; }
        .preview-alternativa {
            display:flex;
            align-items:center;
            gap:10px;
            border:1px solid var(--borda);
            border-radius:7px;
            padding:9px 12px;
            font-size:12.5px;
        }
        .preview-alternativa.correta-marcada { border-color:var(--verde); background:var(--verde-bg); }
        .preview-alternativa .letra-alternativa { background:var(--dourado); }

        .preview-rodape-questao { display:flex; justify-content:flex-end; margin-bottom:14px; }

        .preview-explicacao {
            border-left:3px solid var(--verde);
            background:var(--verde-bg);
            border-radius:0 8px 8px 0;
            padding:12px 14px;
            display:flex;
            gap:14px;
            align-items:flex-start;
        }
        .preview-explicacao-texto-wrap { flex:1; min-width:0; }
        .preview-explicacao-titulo {
            display:flex;
            align-items:center;
            gap:6px;
            font-weight:700;
            font-size:12.5px;
            color:var(--verde);
            margin-bottom:6px;
        }
        .preview-explicacao-texto { font-size:12px; line-height:1.6; color:#3a3a3a; margin:0 0 8px; }
        .preview-gabarito { font-size:11.5px; font-weight:700; color:var(--texto); margin-bottom:6px; }
        .preview-referencia { font-size:10.5px; color:var(--muted); line-height:1.4; }
        .preview-imagem-explicacao {
            flex-shrink:0;
            width:90px;
            height:64px;
            object-fit:cover;
            border-radius:6px;
        }

        .preview-navegacao {
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-top:18px;
            padding-top:14px;
            border-top:1px solid var(--borda);
        }
        .preview-posicao { font-size:11px; color:var(--muted); }

        @media (max-width: 991px) {
            .pagina { margin-left:0; }
            .layout-editor { grid-template-columns:1fr; }
            .linha, .linha-3 { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
<?php 
include("../alexandria-frontend/includes/barraadm.html"); 
include("../alexandria-frontend/includes/sidebaradm.html")
?>
<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="acervo.php?banca=<?= htmlspecialchars($acervo) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para acervo</a>
            <h1>Adicionar Prova</h1>
            <p>Preencha os dados da prova e crie as perguntas, alternativas e explicações.</p>
        </div>
    </header>

    <form id="form-prova" class="layout-editor" onsubmit="return salvarProva(event)">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-file-lines"></i> Dados da prova</div>
            <div class="formulario">

                <div class="campo">
                    <label for="titulo-prova">Título da Prova</label>
                    <input id="titulo-prova" type="text" placeholder="Ex.: FGV - Analista Judiciário" required>
                </div>

                <div class="linha-3">
                    <div class="campo">
                        <label for="dificuldade-prova">Dificuldade</label>
                        <select id="dificuldade-prova" required>
                            <option value="" selected disabled>Selecione a dificuldade</option>
                            <option value="facil">Fácil</option>
                            <option value="medio">Médio</option>
                            <option value="dificil">Difícil</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="ano-prova">Ano da Prova</label>
                        <input id="ano-prova" type="number" placeholder="Ex.: 2024" min="1950" max="2100" required>
                    </div>
                    <div class="campo">
                        <label for="versao-prova">Versão / Dia</label>
                        <input id="versao-prova" type="text" list="sugestoes-versao" placeholder="Ex.: Prova A, Dia 1, 2ª Fase...">
                        <datalist id="sugestoes-versao">
                            <option value="Prova A">
                            <option value="Prova B">
                            <option value="Dia 1">
                            <option value="Dia 2">
                            <option value="1ª Fase">
                            <option value="2ª Fase">
                            <option value="Manhã">
                            <option value="Tarde">
                        </datalist>
                        <span class="ajuda">Deixe em branco se a prova não tiver variações.</span>
                    </div>
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
                    <a class="botao botao-secundario" href="acervo.php?banca=<?= htmlspecialchars($acervo) ?>">Cancelar</a>
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

let perguntas = [];
let contadorPerguntas = 0;
let contadorAlternativas = 0;
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
        imagem: null // { nome, url }
    };
}

/* ===================== Dados da prova (título, dificuldade, ano, versão) ===================== */
const textoDificuldade = { facil: 'Fácil', medio: 'Médio', dificil: 'Difícil' };
const classeDificuldade = { facil: 'facil', medio: 'medio', dificil: 'dificil' };

function atualizarFichaProva(){
    const titulo = valor('titulo-prova').value.trim();
    const ano = valor('ano-prova').value.trim();
    const versao = valor('versao-prova').value.trim();
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

['titulo-prova', 'ano-prova', 'versao-prova', 'dificuldade-prova'].forEach(id => {
    valor(id).addEventListener('input', atualizarFichaProva);
    valor(id).addEventListener('change', atualizarFichaProva);
});

/* ===================== Renderização da lista de perguntas (edição) ===================== */
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

        // preencher valores atuais
        card.querySelector('.input-fonte').value = pergunta.fonte;
        card.querySelector('.input-enunciado').value = pergunta.enunciado;
        card.querySelector('.input-explicacao').value = pergunta.explicacao;
        card.querySelector('.input-referencia').value = pergunta.referencia;
        if (pergunta.imagem) {
            card.querySelector('.texto-zona-imagem').outerHTML = `<span class="nome-arquivo">${escaparHtml(pergunta.imagem.nome)}</span>`;
        }

        renderizarAlternativas(card, pergunta);

        /* ---- eventos do cartão ---- */
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

/* ===================== Pré-visualização (visão do aluno) ===================== */
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

/* ===================== Botão adicionar pergunta ===================== */
valor('btn-adicionar-pergunta').addEventListener('click', () => {
    const novaPergunta = criarPerguntaVazia();
    perguntas.push(novaPergunta);
    indicePreview = perguntas.length - 1;
    explicacaoVisivel = false;
    renderizarListaPerguntas();
    atualizarPreview();
});

/* ===================== Salvar prova ===================== */
function salvarProva(event, status = 'publicado'){
    if (event) event.preventDefault();

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
    window.location.href = 'acervo.php?banca=<?= htmlspecialchars($acervo) ?>';
    return false;
}

/* ===================== Inicialização ===================== */
atualizarFichaProva();
renderizarListaPerguntas();
atualizarPreview();
</script>
</body>
</html>