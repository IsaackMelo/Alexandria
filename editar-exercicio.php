<?php
/**
 * editar-exercicio.php
 * Formulário de edição de uma lista de exercícios já existente. Assim como
 * em editar-aula.php, dados.php ainda não guarda o conteúdo das perguntas de
 * cada exercício — apenas o nome que aparece na barra lateral do módulo
 * (array $conteudos_aula_revolucao_1930). O identificador na URL é a posição
 * do item dentro desse array (ex.: editar-exercicio.php?id=5), e só o título
 * é preenchido automaticamente; as perguntas continuam sendo criadas
 * manualmente até o backend fornecer esses dados.
 */

require_once __DIR__ . '/dados.php';

$curso = $_GET['curso'] ?? '';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$exercicio_atual = null;
if ($id !== null && $id !== false && isset($conteudos_aula_revolucao_1930[$id]) && $conteudos_aula_revolucao_1930[$id]['tipo'] === 'exercicio') {
    $exercicio_atual = $conteudos_aula_revolucao_1930[$id];
}

$valor_titulo_exercicio = $exercicio_atual['nome'] ?? '';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Editar Exercício | Alexandria</title>
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
        /* especificidade maior que ".campo input" para não deixar o campo
           tomar 100% da linha e empurrar a letra/botão de remover pra fora */
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
            .linha { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
<?php
include("../alexandria-frontend/includes/sidebaradm.html");
include("../alexandria-frontend/includes/barraadm.html");
?>
<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="editar-curso.php?curso=<?= htmlspecialchars($curso) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para curso</a>
            <h1>Editar Exercício</h1>
            <p>Crie as perguntas, alternativas e explicações deste exercício.</p>
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

/* ===================== Salvar exercício ===================== */
function salvarExercicio(event, status = 'publicado'){
    if (event) event.preventDefault();

    if (!valor('titulo-exercicio').value.trim()) {
        alert('Preencha o título do exercício.');
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

    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Exercício publicado com sucesso.');
    window.location.href = 'editar-curso.php?curso=<?= htmlspecialchars($curso) ?>';
    return false;
}

/* ===================== Inicialização ===================== */
renderizarListaPerguntas();
atualizarPreview();
</script>
</body>
</html>