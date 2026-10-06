const valor = id => document.getElementById(id);

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
            sincronizarSeletores();
    }
    function corParaHex(cor){
        if(!cor) return null;
        cor = String(cor).trim();
        if(cor[0] === '#'){
            if(cor.length === 4) return '#' + cor[1]+cor[1]+cor[2]+cor[2]+cor[3]+cor[3];
            return cor.toLowerCase();
        }
        const m = cor.match(/rgba?\((\d+)[,\s]+(\d+)[,\s]+(\d+)/i);
        if(!m) return null;
        return '#' + [m[1],m[2],m[3]].map(n => Number(n).toString(16).padStart(2,'0')).join('');
    }

    function sincronizarSeletores(){
        const seletorFonte = caixa.querySelector('.rte-fonte');
        const seletorTamanho = caixa.querySelector('.rte-tamanho');
        const corTexto = caixa.querySelector('.rte-cor-texto');
        const corDestaque = caixa.querySelector('.rte-cor-destaque');

        try{
            const fonte = (document.queryCommandValue('fontName') || '').replace(/["']/g,'').split(',')[0].trim().toLowerCase();
            if(fonte && seletorFonte){
                const opcao = [...seletorFonte.options].find(o => o.value.replace(/["']/g,'').split(',')[0].trim().toLowerCase() === fonte);
                if(opcao) seletorFonte.value = opcao.value;
            }
        }catch(e){}

        try{
            const tamanho = document.queryCommandValue('fontSize');
            if(tamanho && seletorTamanho && [...seletorTamanho.options].some(o => o.value === String(tamanho))){
                seletorTamanho.value = String(tamanho);
            }
        }catch(e){}

        try{
            const hex = corParaHex(document.queryCommandValue('foreColor'));
            if(hex && corTexto) corTexto.value = hex;
        }catch(e){}

        try{
            const fundo = corParaHex(document.queryCommandValue('hiliteColor') || document.queryCommandValue('backColor'));
            if(fundo && fundo !== '#000000' && corDestaque) corDestaque.value = fundo;
        }catch(e){}

        const botaoCitacao = caixa.querySelector('[data-acao="citacao"]');
        if(botaoCitacao){
            let no = window.getSelection() && window.getSelection().anchorNode;
            let dentro = false;
            while(no && no !== conteudo){
                if(no.nodeName === 'BLOCKQUOTE'){ dentro = true; break; }
                no = no.parentNode;
            }
            botaoCitacao.classList.toggle('ativo', dentro);
        }
    }

    document.addEventListener('selectionchange', ()=>{
        if(conteudo.contains(document.getSelection().anchorNode)){
            atualizarEstadoBotoes();
        }
    });

    function executar(cmd, valorCmd=null){
        conteudo.focus();
        restaurarSelecao();
        document.execCommand(cmd, false, valorCmd);
        empilharHistorico();
        atualizarEstadoBotoes();
        sincronizar();
    }
    function sincronizar(){
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

    caixa.querySelector('[data-acao="citacao"]').addEventListener('click', ()=>{
        conteudo.focus();
        restaurarSelecao();
        let no = window.getSelection() && window.getSelection().anchorNode;
        let dentro = false;
        while(no && no !== conteudo){
            if(no.nodeName === 'BLOCKQUOTE'){ dentro = true; break; }
            no = no.parentNode;
        }
        executar('formatBlock', dentro ? 'p' : 'blockquote');
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

    window.sincronizarConteudoArtigo = sincronizar;
})();

function atualizarPreview() {
    valor('preview-titulo').textContent = valor('titulo-artigo').value || 'Título do artigo';
    valor('preview-categoria').textContent = valor('categoria-artigo').value || 'Selecione uma categoria';
    valor('preview-autor').textContent = valor('autor-artigo').value || 'Autor';
    valor('preview-data').textContent = valor('data-artigo').value || 'Data';
    valor('preview-tempo').textContent = valor('tempo-leitura-artigo').value || 'Tempo de leitura';

    const conteudoHtml = valor('conteudo-artigo').innerHTML;
    const conteudoTexto = valor('conteudo-artigo').innerText.trim();
    valor('preview-texto').innerHTML = conteudoTexto ? conteudoHtml
        : ('<p>' + (valor('descricao-artigo').value || 'O texto do artigo aparecerá aqui.') + '</p>');

    const tags = valor('tags-artigo').value.split(',').map(t => t.trim()).filter(Boolean);
    valor('preview-tags').innerHTML = tags.map(tag => `<span>#${tag.replace(/[&<>"']/g, '')}</span>`).join('');
}
['titulo-artigo','descricao-artigo','categoria-artigo','tags-artigo','autor-artigo','data-artigo','tempo-leitura-artigo']
    .forEach(id => { const campo = valor(id); if (campo) campo.addEventListener('input', atualizarPreview); });
valor('capa-artigo').addEventListener('change', function () {
    const arquivo = this.files[0];
    if (!arquivo) return;
    const imagem = document.createElement('img');
    imagem.src = URL.createObjectURL(arquivo);
    valor('preview-capa').replaceChildren(imagem);
});
function salvarArtigo(event, status = 'publicado') {
    if (event) event.preventDefault();
    if (window.sincronizarConteudoArtigo) window.sincronizarConteudoArtigo();

    if (!valor('titulo-artigo').value.trim() || !valor('conteudo-artigo').innerText.trim()) {
        alert('Preencha o título e o texto do artigo.');
        return false;
    }
    alert(status === 'rascunho' ? 'Rascunho salvo com sucesso.' : 'Artigo publicado com sucesso.');
    window.location.href = '../comuns/visualizar-artigos.php';
    return false;
}
atualizarPreview();
if (window.sincronizarConteudoArtigo) window.sincronizarConteudoArtigo();
