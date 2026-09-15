<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Novo artigo | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/adicionar-artigos.css">

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
            <h1>Novo artigo</h1>
            <p>Escreva, revise e publique um novo artigo na Alexandria.</p>
        </div>
    </header>

    <form id="form-artigo" class="layout-editor" onsubmit="return salvarArtigo(event)">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-pen-to-square"></i> Conteúdo do artigo</div>
            <div class="formulario">
                <div class="campo">
                    <label for="titulo-artigo">Título do artigo</label>
                    <input id="titulo-artigo" name="titulo" type="text" placeholder="Digite o título do artigo..." required>
                </div>
                <div class="campo">
                    <label for="descricao-artigo">Descrição ou resumo</label>
                    <textarea id="descricao-artigo" name="descricao" placeholder="Escreva uma breve descrição do artigo..." required></textarea>
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

                        <div class="rte-conteudo" id="conteudo-artigo" contenteditable="true" data-placeholder="Comece a escrever o conteúdo do artigo..."></div>

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
                            <option>História Antiga</option>
                            <option>Idade Moderna</option>
                            <option>História do Brasil</option>
                            <option>Filosofia</option>
                            <option>Atualidades</option>
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
                        <span><i class="fa-solid fa-cloud-arrow-up"></i>Clique para adicionar uma capa</span>
                        <input id="capa-artigo" name="capa" type="file" accept="image/png,image/jpeg,image/webp">
                    </label>
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
                <div id="preview-capa" class="preview-capa"><i class="fa-regular fa-image"></i></div>
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
</script>
</body>
</html>