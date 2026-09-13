<?php
/**
 * editar-artigo.php
 * Formulário de edição de um artigo já existente. O array $artigos, em
 * dados.php, não possui um campo "id" próprio, então usamos a posição do
 * artigo dentro do array (0, 1, 2...) como identificador na URL, passado em
 * ?id=0, ?id=1, etc.
 */

require_once __DIR__ . '/dados.php';

$id_artigo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$artigo_atual = null;
if ($id_artigo !== null && $id_artigo !== false && isset($artigos[$id_artigo])) {
    $artigo_atual = $artigos[$id_artigo];
}

$valor_titulo    = $artigo_atual['titulo'] ?? '';
$valor_descricao = $artigo_atual['resumo'] ?? '';
$valor_categoria = $artigo_atual['categoria'] ?? '';
$valor_imagem    = $artigo_atual['imagem'] ?? '';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Editar artigo | Alexandria</title>
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

        #descricao-artigo { 
            min-height:90px; 
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

        .upload-capa { 
            display:flex; 
            align-items:center; 
            justify-content:center; 
            min-height:130px; 
            border:1px dashed #cfc4ba; 
            border-radius:8px; 
            color:var(--muted); 
            cursor:pointer; 
            text-align:center; 
        }

        .upload-capa:hover { 
            border-color:var(--vinho); 
            color:var(--vinho); 
        }

        .upload-capa input { 
            display:none; 
        }

        .upload-capa i { 
            display:block; 
            margin-bottom:7px; 
            font-size:24px; 
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

        .preview-capa { 
            width:100%; 
            height:145px; 
            display:flex; 
            align-items:center; 
            justify-content:center; 
            margin-bottom:18px; 
            border-radius:8px; 
            color:#aaa; 
            background:#f0ebe6; 
            overflow:hidden; 
        }

        .preview-capa img { 
            width:100%; 
            height:100%; 
            object-fit:cover; 
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
            min-height:360px;
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
            <a class="voltar" href="visualizar-artigos.php"><i class="fa-solid fa-arrow-left"></i> Voltar para artigos</a>
            <h1>Editar artigo</h1>
            <p>Atualize o conteúdo do artigo na Alexandria.</p>
        </div>
    </header>

    <form id="form-artigo" class="layout-editor" onsubmit="return salvarArtigo(event)">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_artigo) ?>">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-pen-to-square"></i> Conteúdo do artigo</div>
            <div class="formulario">
                <div class="campo">
                    <label for="titulo-artigo">Título do artigo</label>
                    <input id="titulo-artigo" name="titulo" type="text" placeholder="Digite o título do artigo..." value="<?= htmlspecialchars($valor_titulo) ?>" required>
                </div>
                <div class="campo">
                    <label for="descricao-artigo">Descrição ou resumo</label>
                    <textarea id="descricao-artigo" name="descricao" placeholder="Escreva uma breve descrição do artigo..." required><?= htmlspecialchars($valor_descricao) ?></textarea>
                </div>

                <div class="campo">
                    <label for="conteudo-artigo">Texto do artigo</label>

                    <!-- ===== Campo de texto rico ===== -->
                    <div class="rte-box" id="caixa-conteudo">
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

                        <div class="rte-conteudo" id="conteudo-artigo" contenteditable="true" data-placeholder="Comece a escrever o conteúdo do artigo..."><?= $valor_descricao !== '' ? '<p>' . htmlspecialchars($valor_descricao) . '</p>' : '' ?></div>

                        <div class="rte-rodape">
                            <span id="contador-palavras">0 palavras</span>
                        </div>
                    </div>
                    <!-- campo oculto que vai de fato no POST do formulário -->
                    <input type="hidden" name="conteudo" id="conteudo-artigo-valor">
                    <!-- ===== fim campo de texto rico ===== -->

                    <small class="ajuda">Use este espaço para desenvolver o texto completo do artigo.</small>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="categoria-artigo">Categoria</label>
                        <select id="categoria-artigo" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <?php
                            $opcoes_categoria = ['História Antiga', 'Idade Moderna', 'História do Brasil', 'Filosofia', 'Atualidades'];
                            foreach ($opcoes_categoria as $opcao) {
                                $selecionada = ($opcao === $valor_categoria) ? ' selected' : '';
                                echo '<option' . $selecionada . '>' . htmlspecialchars($opcao) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="tags-artigo">Tags</label>
                        <input id="tags-artigo" name="tags" type="text" placeholder="Ex.: Roma, Império, História">
                        <small class="ajuda">Separe as tags por vírgula.</small>
                    </div>
                </div>
                <div class="campo">
                    <label for="capa-artigo">Imagem de capa</label>
                    <label class="upload-capa" for="capa-artigo">
                        <span<?= $valor_imagem ? ' style="display:none;"' : '' ?>><i class="fa-solid fa-cloud-arrow-up"></i>Clique para adicionar uma capa</span>
                        <input id="capa-artigo" name="capa" type="file" accept="image/png,image/jpeg,image/webp">
                    </label>
                    <?php if ($valor_imagem): ?>
                        <small class="ajuda">Capa atual: <?= htmlspecialchars($valor_imagem) ?> (envie um novo arquivo para substituí-la).</small>
                    <?php endif; ?>
                </div>
                <div class="acoes">
                    <a class="botao botao-secundario" href="incluirartigos.php">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarArtigo(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> Publicar artigo</button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização do artigo">
            <div class="cartao-cabecalho">Pré-visualização</div>
            <div class="preview-conteudo">
                <div id="preview-capa" class="preview-capa"><?= $valor_imagem ? '<img src="imagens/' . htmlspecialchars($valor_imagem) . '" alt="">' : '<i class="fa-regular fa-image"></i>' ?></div>
                <div id="preview-categoria" class="preview-categoria">Selecione uma categoria</div>
                <h2 id="preview-titulo">Título do artigo</h2>
                <p id="preview-descricao" class="preview-descricao">A descrição do artigo aparecerá aqui.</p>
                <div id="preview-tags" class="lista-tags"></div>
                <div id="preview-texto" class="preview-texto">O texto do artigo aparecerá aqui.</div>
            </div>
        </aside>
    </form>
</main>
<script>
const valor = id => document.getElementById(id);

/* ===================== CAMPO DE TEXTO RICO (lógica) ===================== */
(function(){
    const caixa = valor('caixa-conteudo');
    const conteudo = valor('conteudo-artigo');
    const campoOculto = valor('conteudo-artigo-valor');
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
    window.sincronizarConteudoArtigo = sincronizar;
})();
/* ===================== FIM CAMPO DE TEXTO RICO (lógica) ===================== */

function atualizarPreview() {
    valor('preview-titulo').textContent = valor('titulo-artigo').value || 'Título do artigo';
    valor('preview-descricao').textContent = valor('descricao-artigo').value || 'A descrição do artigo aparecerá aqui.';
    valor('preview-categoria').textContent = valor('categoria-artigo').value || 'Selecione uma categoria';

    const conteudoHtml = valor('conteudo-artigo').innerHTML;
    const conteudoTexto = valor('conteudo-artigo').innerText.trim();
    valor('preview-texto').innerHTML = conteudoTexto ? conteudoHtml : 'O texto do artigo aparecerá aqui.';

    const tags = valor('tags-artigo').value.split(',').map(t => t.trim()).filter(Boolean);
    valor('preview-tags').innerHTML = tags.map(tag => `<span class="tag">${tag.replace(/[&<>"']/g, '')}</span>`).join('');
}
['titulo-artigo','descricao-artigo','categoria-artigo','tags-artigo'].forEach(id => valor(id).addEventListener('input', atualizarPreview));
valor('capa-artigo').addEventListener('change', function () {
    const arquivo = this.files[0];
    if (!arquivo) return;
    const imagem = document.createElement('img');
    imagem.src = URL.createObjectURL(arquivo);
    valor('preview-capa').replaceChildren(imagem);
});
function salvarArtigo(event, status = 'publicado') {
    if (event) event.preventDefault();
    // garante que o campo oculto está atualizado com o conteúdo mais recente
    if (window.sincronizarConteudoArtigo) window.sincronizarConteudoArtigo();

    if (!valor('titulo-artigo').value.trim() || !valor('conteudo-artigo').innerText.trim()) {
        alert('Preencha o título e o texto do artigo.');
        return false;
    }
    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Artigo publicado com sucesso.');
    window.location.href = 'incluirartigos.php';
    return false;
}
atualizarPreview();
// Se o conteúdo já veio preenchido (edição), sincroniza contador de palavras e campo oculto
if (window.sincronizarConteudoArtigo) window.sincronizarConteudoArtigo();
</script>
</body>
</html>