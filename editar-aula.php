<?php
/**
 * editar-aula.php
 * Formulário de edição de uma aula já existente. Hoje dados.php só guarda,
 * por aula, o nome exibido na barra lateral do módulo (array
 * $conteudos_aula_revolucao_1930); os demais campos deste formulário (texto,
 * vídeo, categoria, tags, PDF) ainda não têm uma fonte de dados e ficam em
 * branco até o backend fornecê-los.
 *
 * O identificador na URL é a posição da aula dentro desse array
 * (ex.: editar-aula.php?id=0).
 */

require_once __DIR__ . '/dados.php';

$id_aula = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$aula_atual = null;
if ($id_aula !== null && $id_aula !== false && isset($conteudos_aula_revolucao_1930[$id_aula])) {
    $aula_atual = $conteudos_aula_revolucao_1930[$id_aula];
}

$valor_titulo_aula = $aula_atual['nome'] ?? '';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Editar Aula | Alexandria</title>
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
        }

        * { 
            box-sizing:border-box; 
        }

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

        .cabecalho-pagina h1 { 
            margin:0 0 7px; 
            font-size:27px; 
        }

        .cabecalho-pagina p { 
            margin:0; 
            color:var(--muted); 
            font-size:13px; 
        }

        .voltar { 
            color:var(--vinho); 
            text-decoration:none; 
            font-size:13px; 
            font-weight:600; 
        }

        .layout-editor { 
            display:grid; 
            grid-template-columns:
            minmax(0,1.35fr) 
            minmax(300px,.65fr); 
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

        .formulario { 
            padding:22px; 
        }

        .campo { 
            margin-bottom:18px; 
        }

        .campo label { 
            display:block; 
            margin-bottom:8px; 
            font-size:12px; 
            font-weight:700; 
        }

        .campo input, .campo select, .campo textarea { 
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

        .campo input:focus, .campo select:focus, .campo textarea:focus { 
            border-color:var(--dourado); 
            box-shadow:0 0 0 3px #d4af3726; 
        }

        .campo textarea { 
            resize:vertical; 
        }

        #descricao-video { 
            min-height:110px; 
        }

        .linha { 
            display:grid; 
            grid-template-columns:1fr 1fr; 
            gap:16px; 
        }

        .ajuda { 
            display:block; 
            margin-top:6px; 
            color:var(--muted); 
            font-size:11px; 
        }

        /* ===== Áreas de upload (vídeo / pdf) ===== */
        .zona-upload { 
            display:flex; 
            flex-direction:column;
            align-items:center; 
            justify-content:center; 
            gap:6px;
            min-height:130px; 
            border:1px dashed #cfc4ba; 
            border-radius:8px; 
            color:var(--muted); 
            cursor:pointer; 
            text-align:center; 
            padding:14px;
            transition:border-color .15s ease, color .15s ease, background .15s ease;
        }

        .zona-upload:hover, .zona-upload.arrastando { 
            border-color:var(--vinho); 
            color:var(--vinho); 
            background:#fbf5f2;
        }

        .zona-upload input { 
            display:none; 
        }

        .zona-upload i { 
            display:block; 
            margin-bottom:2px; 
            font-size:24px; 
        }

        .zona-upload .nome-arquivo {
            color:var(--vinho);
            font-weight:600;
            font-size:12px;
            word-break:break-all;
        }

        .separador-ou {
            display:flex;
            align-items:center;
            gap:10px;
            margin:12px 0;
            color:var(--muted);
            font-size:11px;
            text-transform:uppercase;
            font-weight:700;
        }
        .separador-ou::before, .separador-ou::after {
            content:"";
            flex:1;
            height:1px;
            background:var(--borda);
        }

        .acoes { 
            display:flex; 
            justify-content:flex-end; 
            gap:10px; 
            padding-top:18px; 
            border-top:1px solid #eee; 
        }

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

        .botao-secundario { 
            border-color:#d8cfc7; 
            color:#555; 
            background:#fff; 
        }

        .botao-rascunho { 
            border-color:var(--vinho); 
            color:var(--vinho); 
            background:#fff; 
        }

        .botao-publicar { 
            color:#fff; 
            background:var(--vinho); 
        }

        .botao-publicar:hover { 
            background:var(--vinho-escuro); 
        }

        .preview { 
            position:sticky; 
            top:24px; 
            overflow:hidden; 
        }

        .preview-conteudo { 
            padding:22px; 
        }

        .preview-tipo {
            display:inline-block;
            margin-bottom:10px;
            padding:4px 10px;
            border-radius:20px;
            background:#f6eee7;
            color:var(--vinho);
            font-size:10px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.03em;
        }

        .preview-categoria { 
            margin-bottom:10px; 
            color:var(--vinho); 
            font-size:11px; 
            font-weight:700; 
            text-transform:uppercase; 
        }

        .preview h2 { 
            margin:0 0 10px; 
            font-size:22px; 
            line-height:1.25; 
        }

        .preview-descricao { 
            margin:0 0 20px; 
            color:var(--muted); 
            font-size:12px; 
            line-height:1.6; 
        }

        .preview-video-marcador {
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            min-height:120px;
            border-radius:8px;
            background:#f0ebe6;
            color:#aaa;
            font-size:13px;
            margin-bottom:14px;
        }

        .preview-pdf-marcador {
            display:flex;
            align-items:center;
            gap:8px;
            border:1px solid var(--borda);
            border-radius:6px;
            padding:8px 10px;
            font-size:12px;
            color:var(--muted);
            margin-top:14px;
        }
        .preview-pdf-marcador i { color:var(--vinho); }

        .preview-texto { 
            border-top:1px solid var(--borda); 
            padding-top:16px; 
            color:#555; 
            font-family:Georgia,serif; 
            font-size:13px; 
            line-height:1.7; 
        }
        .preview-texto p { margin:0 0 .8em; }
        .preview-texto:empty::before,
        .preview-texto.vazio { color:#999; }

        .lista-tags { 
            display:flex; 
            flex-wrap:wrap; 
            gap:6px; 
            margin-top:8px; 
        }

        .tag { 
            padding:5px 8px; 
            border-radius:4px; 
            color:var(--vinho); 
            background:#f6eee7; 
            font-size:11px; 
        }

        /* ===================== CAMPO DE TEXTO RICO ===================== */
        .rte-box{
            border:1px solid #d8cfc7;
            border-radius:8px;
            background:#fff;
            overflow:visible;
            position:relative;
            transition:border-color .15s ease, box-shadow .15s ease;
        }
        .rte-box.focado{
            border-color:var(--dourado);
            box-shadow:0 0 0 3px #d4af3726;
        }
        .rte-toolbar{
            display:flex;
            align-items:center;
            gap:.15rem;
            padding:.55rem .7rem;
            background:var(--fundo);
            border-bottom:1px solid #eee2d6;
            border-radius:8px 8px 0 0;
            flex-wrap:wrap;
        }
        .rte-divisor{
            width:1px;
            height:18px;
            background:#e6dccd;
            margin:0 .4rem;
            flex-shrink:0;
        }
        .rte-btn{
            border:none;
            background:transparent;
            color:#5b5450;
            width:28px;
            height:28px;
            border-radius:6px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:.82rem;
            cursor:pointer;
            transition:background .12s ease, color .12s ease;
        }
        .rte-btn:hover{ background:#f6eee7; color:var(--vinho); }
        .rte-btn.ativo{ background:#f6eee7; color:var(--vinho); }
        .rte-conteudo{
            min-height:300px;
            max-height:600px;
            overflow-y:auto;
            padding:14px 15px;
            font-size:13px;
            line-height:1.7;
            outline:none;
            color:var(--texto);
        }
        .rte-conteudo:empty::before{
            content: attr(data-placeholder);
            color:#9a9490;
            pointer-events:none;
        }
        .rte-conteudo ul, .rte-conteudo ol{ padding-left:1.3rem; margin:.4rem 0; }
        .rte-conteudo a{ color:var(--vinho); }
        .rte-conteudo img{ max-width:100%; border-radius:6px; margin:.4rem 0; }
        .rte-mais-wrap{ position:relative; margin-left:auto; }
        .rte-mais-painel{
            display:none;
            position:absolute;
            top:calc(100% + 6px);
            right:0;
            background:#fff;
            border:1px solid var(--borda);
            border-radius:10px;
            box-shadow:0 8px 24px rgba(0,0,0,.1);
            padding:.55rem;
            width:280px;
            z-index:20;
        }
        .rte-mais-painel.mostrar{ display:block; }
        .rte-mais-linha{
            display:flex;
            align-items:center;
            gap:.3rem;
            flex-wrap:wrap;
            margin-bottom:.45rem;
        }
        .rte-mais-linha:last-child{ margin-bottom:0; }
        .rte-select{
            height:28px;
            border-radius:6px;
            border:1px solid #d8cfc7;
            background:#fff;
            font-size:.75rem;
            padding:0 .3rem;
            color:var(--texto);
        }
        .rte-cor{
            width:28px; height:28px;
            padding:2px;
            border-radius:6px;
            border:1px solid #d8cfc7;
            background:#fff;
            cursor:pointer;
        }
        .rte-rodape{
            display:flex;
            justify-content:flex-end;
            padding:.3rem .8rem .5rem;
            font-size:.7rem;
            color:var(--muted);
        }
        /* ===================== FIM CAMPO DE TEXTO RICO ===================== */
        
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
            <a class="voltar" href="visualizar-aulas.php"><i class="fa-solid fa-arrow-left"></i> Voltar para curso</a>
            <h1>Editar Aula</h1>
            <p>Escreva, e publique Aula na Alexandria.</p>
        </div>
    </header>

    <form id="form-aula" class="layout-editor" onsubmit="return salvarAula(event)">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_aula) ?>">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-pen-to-square"></i> Conteúdo da aula</div>
            <div class="formulario">
                <div class="campo">
                    <label for="titulo-aula">Título da Aula</label>
                    <input id="titulo-aula" name="titulo" type="text" placeholder="Digite o título da aula..." value="<?= htmlspecialchars($valor_titulo_aula) ?>" required>
                </div>

                <div class="campo">
                    <label for="tipo-aula">Tipo de Aula</label>
                    <select id="tipo-aula" name="tipo">
                        <option value="texto">Texto</option>
                        <option value="video">Vídeo</option>
                    </select>
                    <small class="ajuda">Escolha se esta aula será em formato de texto ou de vídeo.</small>
                </div>

                <!-- ===== Seção: Aula em Texto ===== -->
                <div class="campo" id="secao-texto">
                    <label for="texto-aula">Texto da Aula</label>

                    <!-- ===== Campo de texto rico ===== -->
                    <div class="rte-box" id="caixa-texto">
                        <div class="rte-toolbar">
                            <button type="button" class="rte-btn" data-cmd="bold" title="Negrito"><i class="fa-solid fa-bold"></i></button>
                            <button type="button" class="rte-btn" data-cmd="italic" title="Itálico"><i class="fa-solid fa-italic"></i></button>
                            <button type="button" class="rte-btn" data-cmd="underline" title="Sublinhado"><i class="fa-solid fa-underline"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-acao="link" title="Inserir link"><i class="fa-solid fa-link"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-cmd="insertUnorderedList" title="Lista com marcadores"><i class="fa-solid fa-list-ul"></i></button>
                            <button type="button" class="rte-btn" data-cmd="insertOrderedList" title="Lista numerada"><i class="fa-solid fa-list-ol"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-acao="limpar" title="Limpar formatação"><i class="fa-solid fa-eraser"></i></button>

                            <div class="rte-mais-wrap">
                                <button type="button" class="rte-btn" data-acao="mais" title="Mais opções"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="rte-mais-painel">
                                    <div class="rte-mais-linha">
                                        <select class="rte-select rte-fonte" title="Fonte">
                                            <option value="Inter, sans-serif" selected>Sans</option>
                                            <option value="Georgia, serif">Serif</option>
                                            <option value="'Courier New', monospace">Monoespaçada</option>
                                        </select>
                                        <select class="rte-select rte-tamanho" title="Tamanho">
                                            <option value="2">Pequeno</option>
                                            <option value="3" selected>Normal</option>
                                            <option value="5">Grande</option>
                                            <option value="6">Enorme</option>
                                        </select>
                                    </div>
                                    <div class="rte-mais-linha">
                                        <button type="button" class="rte-btn" data-cmd="justifyLeft" title="Alinhar à esquerda"><i class="fa-solid fa-align-left"></i></button>
                                        <button type="button" class="rte-btn" data-cmd="justifyCenter" title="Centralizar"><i class="fa-solid fa-align-center"></i></button>
                                        <button type="button" class="rte-btn" data-cmd="justifyRight" title="Alinhar à direita"><i class="fa-solid fa-align-right"></i></button>
                                        <div class="rte-divisor"></div>
                                        <button type="button" class="rte-btn" data-cmd="strikeThrough" title="Tachado"><i class="fa-solid fa-strikethrough"></i></button>
                                        <button type="button" class="rte-btn" data-acao="imagem" title="Inserir imagem"><i class="fa-regular fa-image"></i></button>
                                    </div>
                                    <div class="rte-mais-linha">
                                        <input type="color" class="rte-cor rte-cor-texto" value="#2c2927" title="Cor do texto">
                                        <input type="color" class="rte-cor rte-cor-destaque" value="#fff3b0" title="Cor de destaque">
                                        <div class="rte-divisor"></div>
                                        <button type="button" class="rte-btn" data-acao="desfazer" title="Desfazer"><i class="fa-solid fa-rotate-left"></i></button>
                                        <button type="button" class="rte-btn" data-acao="refazer" title="Refazer"><i class="fa-solid fa-rotate-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rte-conteudo" id="texto-aula" contenteditable="true" data-placeholder="Comece a escrever o conteúdo da aula..."></div>

                        <div class="rte-rodape">
                            <span id="contador-palavras">0 palavras</span>
                        </div>
                    </div>
                    <!-- campo oculto que vai de fato no POST do formulário -->
                    <input type="hidden" name="texto" id="texto-aula-valor">
                    <!-- ===== fim campo de texto rico ===== -->

                    <small class="ajuda">Use este espaço para desenvolver o texto completo da Aula.</small>
                </div>
                <!-- ===== Fim Seção: Aula em Texto ===== -->

                <!-- ===== Seção: Aula em Vídeo ===== -->
                <div class="campo" id="secao-video" style="display:none;">
                    <label>Vídeo da Aula</label>
                    <label class="zona-upload" for="arquivo-video" id="zona-video">
                        <span id="video-placeholder"><i class="fa-solid fa-file-video"></i>Arraste um arquivo de vídeo aqui ou clique para selecionar</span>
                        <span class="nome-arquivo" id="video-nome-arquivo" style="display:none;"></span>
                        <input type="file" id="arquivo-video" accept="video/*" hidden>
                    </label>

                    <div class="separador-ou">ou</div>

                    <input id="link-video" name="link_video" type="url" placeholder="Cole o link do vídeo (YouTube, Vimeo, etc.)">
                    <small class="ajuda">Envie um arquivo de vídeo ou informe um link. Escolha apenas uma das opções.</small>
                </div>

                <div class="campo" id="secao-descricao-video" style="display:none;">
                    <label for="descricao-video">Descrição da Aula</label>
                    <textarea id="descricao-video" name="descricao_video" placeholder="Descreva brevemente o conteúdo desta aula em vídeo..."></textarea>
                </div>
                <!-- ===== Fim Seção: Aula em Vídeo ===== -->

                <!-- ===== Material em PDF (comum aos dois tipos) ===== -->
                <div class="campo">
                    <label>Material da Aula (PDF)</label>
                    <label class="zona-upload" for="material-pdf" id="zona-pdf">
                        <span id="pdf-placeholder"><i class="fa-solid fa-file-pdf"></i>Clique ou arraste o PDF aqui</span>
                        <span class="nome-arquivo" id="pdf-nome-arquivo" style="display:none;"></span>
                        <input type="file" id="material-pdf" accept="application/pdf" hidden>
                    </label>
                    <small class="ajuda">Material de apoio em PDF para os alunos baixarem (opcional).</small>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="categoria-aula">Categoria</label>
                        <select id="categoria-aula" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <option>História Antiga</option>
                            <option>Idade Moderna</option>
                            <option>História do Brasil</option>
                            <option>Filosofia</option>
                            <option>Atualidades</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="tags-aula">Tags</label>
                        <input id="tags-aula" name="tags" type="text" placeholder="Ex.: Roma, Império, História">
                        <small class="ajuda">Separe as tags por vírgula.</small>
                    </div>
                </div>

                <div class="acoes">
                    <a class="botao botao-secundario" href="visualizar-aulas.php">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarAula(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> Publicar Aula</button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização da aula">
            <div class="cartao-cabecalho">Pré-visualização</div>
            <div class="preview-conteudo">
                <div class="preview-tipo" id="preview-tipo">Texto</div>
                <div id="preview-categoria" class="preview-categoria">Selecione uma categoria</div>
                <h2 id="preview-titulo">Título da aula</h2>
                <div id="preview-tags" class="lista-tags"></div>

                <div id="preview-bloco-video" class="preview-video-marcador" style="display:none;">
                    <i class="fa-solid fa-circle-play"></i> Vídeo da aula
                </div>
                <p id="preview-descricao-video" class="preview-descricao" style="display:none;">A descrição da aula aparecerá aqui.</p>

                <div id="preview-texto" class="preview-texto">O texto da Aula aparecerá aqui.</div>

                <div id="preview-pdf" class="preview-pdf-marcador" style="display:none;">
                    <i class="fa-solid fa-file-pdf"></i> <span id="preview-pdf-nome"></span>
                </div>
            </div>
        </aside>
    </form>
</main>
<script>
const valor = id => document.getElementById(id);

/* ===================== TIPO DE AULA (texto / vídeo) ===================== */
const tipoAula = valor('tipo-aula');
const secaoTexto = valor('secao-texto');
const secaoVideo = valor('secao-video');
const secaoDescricaoVideo = valor('secao-descricao-video');

function aplicarTipoAula() {
    const ehVideo = tipoAula.value === 'video';
    secaoTexto.style.display = ehVideo ? 'none' : '';
    secaoVideo.style.display = ehVideo ? '' : 'none';
    secaoDescricaoVideo.style.display = ehVideo ? '' : 'none';
    atualizarPreview();
}
tipoAula.addEventListener('change', aplicarTipoAula);

/* ===================== Zonas de arrastar/soltar (vídeo e pdf) ===================== */
function configurarZonaUpload(zonaEl, inputEl, aoSelecionar) {
    zonaEl.addEventListener('dragover', (e) => { e.preventDefault(); zonaEl.classList.add('arrastando'); });
    zonaEl.addEventListener('dragleave', () => zonaEl.classList.remove('arrastando'));
    zonaEl.addEventListener('drop', (e) => {
        e.preventDefault();
        zonaEl.classList.remove('arrastando');
        if (e.dataTransfer.files && e.dataTransfer.files.length) {
            inputEl.files = e.dataTransfer.files;
            aoSelecionar(inputEl.files[0]);
        }
    });
    inputEl.addEventListener('change', () => {
        if (inputEl.files.length) aoSelecionar(inputEl.files[0]);
    });
}

configurarZonaUpload(valor('zona-video'), valor('arquivo-video'), (arquivo) => {
    valor('video-placeholder').style.display = 'none';
    const nomeEl = valor('video-nome-arquivo');
    nomeEl.textContent = arquivo.name;
    nomeEl.style.display = 'block';
    valor('link-video').value = '';
    atualizarPreview();
});

valor('link-video').addEventListener('input', () => {
    if (valor('link-video').value.trim()) {
        valor('arquivo-video').value = '';
        valor('video-placeholder').style.display = 'block';
        valor('video-nome-arquivo').style.display = 'none';
    }
    atualizarPreview();
});

configurarZonaUpload(valor('zona-pdf'), valor('material-pdf'), (arquivo) => {
    valor('pdf-placeholder').style.display = 'none';
    const nomeEl = valor('pdf-nome-arquivo');
    nomeEl.textContent = arquivo.name;
    nomeEl.style.display = 'block';
    atualizarPreview();
});

/* ===================== CAMPO DE TEXTO RICO (lógica) ===================== */
(function(){
    const caixa = valor('caixa-texto');
    const conteudo = valor('texto-aula');
    const campoOculto = valor('texto-aula-valor');
    const painelMais = caixa.querySelector('.rte-mais-painel');
    const botaoMais = caixa.querySelector('[data-acao="mais"]');
    const contadorEl = valor('contador-palavras');

    let intervaloSelecao = null;
    let historico = [conteudo.innerHTML];
    let indiceHistorico = 0;
    let temporizador = null;

    function salvarSelecao(){
        const sel = window.getSelection();
        if(sel.rangeCount > 0 && conteudo.contains(sel.anchorNode)) intervaloSelecao = sel.getRangeAt(0);
    }
    function restaurarSelecao(){
        const sel = window.getSelection();
        sel.removeAllRanges();
        if(intervaloSelecao) sel.addRange(intervaloSelecao);
    }
    function empilharHistorico(){
        if(conteudo.innerHTML === historico[indiceHistorico]) return;
        historico = historico.slice(0, indiceHistorico + 1);
        historico.push(conteudo.innerHTML);
        indiceHistorico = historico.length - 1;
    }
    function desfazer(){
        if(indiceHistorico > 0){ indiceHistorico--; conteudo.innerHTML = historico[indiceHistorico]; sincronizar(); }
    }
    function refazer(){
        if(indiceHistorico < historico.length - 1){ indiceHistorico++; conteudo.innerHTML = historico[indiceHistorico]; sincronizar(); }
    }
    function atualizarEstadoBotoes(){
        caixa.querySelectorAll('[data-cmd]').forEach(btn=>{
            try{ btn.classList.toggle('ativo', document.queryCommandState(btn.dataset.cmd)); }catch(e){}
        });
    }
    function executar(cmd, valorCmd=null){
        conteudo.focus();
        restaurarSelecao();
        document.execCommand(cmd, false, valorCmd);
        empilharHistorico();
        atualizarEstadoBotoes();
        sincronizar();
    }
    function sincronizar(){
        // atualiza contador de palavras, campo oculto do formulário e a pré-visualização
        const texto = conteudo.innerText.trim();
        const palavras = texto.length ? texto.split(/\s+/).length : 0;
        contadorEl.textContent = palavras + (palavras === 1 ? ' palavra' : ' palavras');
        campoOculto.value = conteudo.innerHTML;
        atualizarPreview();
    }

    conteudo.addEventListener('focus', ()=> caixa.classList.add('focado'));
    conteudo.addEventListener('blur', ()=> caixa.classList.remove('focado'));
    conteudo.addEventListener('mouseup', salvarSelecao);
    conteudo.addEventListener('keyup', ()=>{ salvarSelecao(); atualizarEstadoBotoes(); });
    conteudo.addEventListener('input', ()=>{
        sincronizar();
        clearTimeout(temporizador);
        temporizador = setTimeout(empilharHistorico, 500);
    });

    caixa.querySelectorAll('[data-cmd]').forEach(btn=>{
        btn.addEventListener('click', ()=> executar(btn.dataset.cmd));
    });

    caixa.querySelector('[data-acao="limpar"]').addEventListener('click', ()=>{
        conteudo.focus();
        restaurarSelecao();
        document.execCommand('removeFormat');
        empilharHistorico();
        sincronizar();
    });

    caixa.querySelector('[data-acao="desfazer"]').addEventListener('click', desfazer);
    caixa.querySelector('[data-acao="refazer"]').addEventListener('click', refazer);

    caixa.querySelector('[data-acao="link"]').addEventListener('click', ()=>{
        salvarSelecao();
        const url = prompt('Cole o link:');
        if(!url) return;
        const urlSegura = /^https?:\/\//i.test(url) ? url : 'https://' + url;
        executar('createLink', urlSegura);
    });

    caixa.querySelector('[data-acao="imagem"]').addEventListener('click', ()=>{
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = e=>{
            const arquivo = e.target.files[0];
            if(!arquivo) return;
            const leitor = new FileReader();
            leitor.onload = ev => executar('insertImage', ev.target.result);
            leitor.readAsDataURL(arquivo);
        };
        input.click();
    });

    caixa.querySelector('.rte-fonte').addEventListener('change', function(){ executar('fontName', this.value); });
    caixa.querySelector('.rte-tamanho').addEventListener('change', function(){ executar('fontSize', this.value); });
    caixa.querySelector('.rte-cor-texto').addEventListener('input', function(){ executar('foreColor', this.value); });
    caixa.querySelector('.rte-cor-destaque').addEventListener('input', function(){ executar('hiliteColor', this.value); });

    botaoMais.addEventListener('click', (e)=>{
        e.stopPropagation();
        painelMais.classList.toggle('mostrar');
    });
    document.addEventListener('click', (e)=>{
        if(!caixa.contains(e.target)) painelMais.classList.remove('mostrar');
    });

    // expõe a função de sincronização para ser chamada de fora se necessário
    window.sincronizarTextoAula = sincronizar;
})();
/* ===================== FIM CAMPO DE TEXTO RICO (lógica) ===================== */

function atualizarPreview() {
    const ehVideo = valor('tipo-aula').value === 'video';

    valor('preview-tipo').textContent = ehVideo ? 'Vídeo' : 'Texto';
    valor('preview-titulo').textContent = valor('titulo-aula').value || 'Título da aula';
    valor('preview-categoria').textContent = valor('categoria-aula').value || 'Selecione uma categoria';

    // Bloco de texto x vídeo
    valor('preview-texto').style.display = ehVideo ? 'none' : '';
    valor('preview-bloco-video').style.display = ehVideo ? 'flex' : 'none';
    valor('preview-descricao-video').style.display = ehVideo ? 'block' : 'none';

    if (ehVideo) {
        const descricao = valor('descricao-video').value.trim();
        valor('preview-descricao-video').textContent = descricao || 'A descrição da aula aparecerá aqui.';
    } else {
        const conteudoHtml = valor('texto-aula').innerHTML;
        const conteudoTexto = valor('texto-aula').innerText.trim();
        valor('preview-texto').innerHTML = conteudoTexto ? conteudoHtml : 'O texto da Aula aparecerá aqui.';
    }

    // Material em PDF
    const arquivoPdf = valor('material-pdf').files[0];
    valor('preview-pdf').style.display = arquivoPdf ? 'flex' : 'none';
    if (arquivoPdf) valor('preview-pdf-nome').textContent = arquivoPdf.name;

    const tags = valor('tags-aula').value.split(',').map(t => t.trim()).filter(Boolean);
    valor('preview-tags').innerHTML = tags.map(tag => `<span class="tag">${tag.replace(/[&<>"']/g, '')}</span>`).join('');
}
['titulo-aula','categoria-aula','tags-aula','descricao-video'].forEach(id => valor(id).addEventListener('input', atualizarPreview));
valor('tipo-aula').addEventListener('change', atualizarPreview);

function salvarAula(event, status = 'publicado') {
    if (event) event.preventDefault();
    // garante que o campo oculto está atualizado com o conteúdo mais recente
    if (window.sincronizarTextoAula) window.sincronizarTextoAula();

    if (!valor('titulo-aula').value.trim()) {
        alert('Preencha o título da aula.');
        return false;
    }

    const ehVideo = valor('tipo-aula').value === 'video';
    if (ehVideo) {
        const temArquivo = valor('arquivo-video').files.length > 0;
        const temLink = valor('link-video').value.trim().length > 0;
        if (!temArquivo && !temLink) {
            alert('Envie um arquivo de vídeo ou informe um link do vídeo.');
            return false;
        }
    } else {
        if (!valor('texto-aula').innerText.trim()) {
            alert('Escreva o texto da aula.');
            return false;
        }
    }

    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Aula publicada com sucesso.');
    window.location.href = 'visualizar-aulas.php';
    return false;
}

aplicarTipoAula();
atualizarPreview();
</script>
</body>
</html>