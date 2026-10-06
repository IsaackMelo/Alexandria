        (() => {
            const RESPOSTA_PADRAO = [
                'Esta é uma demonstração do Chat AI da Alexandria, ainda sem inteligência artificial conectada.',
                'Assim que a integração estiver pronta, eu vou responder à sua pergunta com explicações, resumos e questões de treino sobre o tema. Enquanto isso, aproveite os cursos, os artigos e o banco de questões da plataforma.'
            ];

            const conteudo = document.getElementById('conteudoChat');
            const lista = document.getElementById('listaMensagens');
            const entrada = document.getElementById('entradaChat');
            const botao = document.getElementById('botaoEnviar');
            const cartoes = document.querySelectorAll('.cartao-tema');
            const botaoAdicionar = document.getElementById('botaoAdicionar');
            const campoArquivo = document.getElementById('arquivoChat');
            const caixaArquivo = document.getElementById('arquivoSelecionado');
            const nomeArquivo = document.getElementById('nomeArquivo');
            const removerArquivo = document.getElementById('removerArquivo');
            let respondendo = false;
            let anexo = null;

            function limparAnexo() {
                anexo = null;
                campoArquivo.value = '';
                caixaArquivo.classList.remove('visivel');
                atualizarBotao();
            }

            function atualizarBotao() {
                botao.disabled = respondendo || (entrada.value.trim() === '' && !anexo);
            }

            botaoAdicionar.addEventListener('click', () => campoArquivo.click());

            campoArquivo.addEventListener('change', () => {
                const arquivo = campoArquivo.files[0];
                if (!arquivo) return;

                const ehImagem = arquivo.type.startsWith('image/');
                const ehPdf = arquivo.type === 'application/pdf';
                if (!ehImagem && !ehPdf) {
                    alert('Envie uma imagem ou um arquivo PDF.');
                    limparAnexo();
                    return;
                }

                anexo = { nome: arquivo.name, imagem: ehImagem, url: ehImagem ? URL.createObjectURL(arquivo) : null };
                nomeArquivo.textContent = anexo.nome;
                caixaArquivo.classList.add('visivel');
                atualizarBotao();
                entrada.focus();
            });

            removerArquivo.addEventListener('click', limparAnexo);

            function criarMensagem(texto, autor) {
                const item = document.createElement('div');
                item.className = 'mensagem' + (autor === 'usuario' ? ' do-usuario' : '');

                const avatar = document.createElement('div');
                avatar.className = 'avatar-mensagem';
                avatar.innerHTML = autor === 'usuario'
                    ? '<i class="fas fa-user"></i>'
                    : '<i class="fas fa-robot"></i>';

                const balao = document.createElement('div');
                balao.className = 'balao-mensagem';
                if (Array.isArray(texto)) {
                    texto.forEach(paragrafo => {
                        const p = document.createElement('p');
                        p.textContent = paragrafo;
                        balao.appendChild(p);
                    });
                } else {
                    const p = document.createElement('p');
                    p.textContent = texto;
                    balao.appendChild(p);
                }

                item.append(avatar, balao);
                lista.appendChild(item);
                lista.scrollTop = lista.scrollHeight;
                return item;
            }

            function mostrarDigitando() {
                const item = criarMensagem('', 'ia');
                const balao = item.querySelector('.balao-mensagem');
                balao.innerHTML = '<span class="digitando"><span></span><span></span><span></span></span>';
                return item;
            }

            function enviar(texto) {
                const mensagem = (texto ?? entrada.value).trim();
                if ((!mensagem && !anexo) || respondendo) return;

                conteudo.classList.add('conversando');
                lista.hidden = false;

                const item = criarMensagem(mensagem || 'Segue o arquivo em anexo.', 'usuario');
                if (anexo) {
                    const balao = item.querySelector('.balao-mensagem');
                    const bloco = document.createElement('div');
                    bloco.className = 'anexo-mensagem';
                    if (anexo.imagem) {
                        const imagem = document.createElement('img');
                        imagem.src = anexo.url;
                        imagem.alt = anexo.nome;
                        bloco.appendChild(imagem);
                    } else {
                        bloco.innerHTML = '<i class="fas fa-file-pdf"></i>';
                        const nome = document.createElement('span');
                        nome.textContent = anexo.nome;
                        bloco.appendChild(nome);
                    }
                    balao.prepend(bloco);
                    limparAnexo();
                    lista.scrollTop = lista.scrollHeight;
                }

                entrada.value = '';
                botao.disabled = true;
                respondendo = true;

                const digitando = mostrarDigitando();
                setTimeout(() => {
                    digitando.remove();
                    criarMensagem(RESPOSTA_PADRAO, 'ia');
                    respondendo = false;
                    atualizarBotao();
                    entrada.focus();
                }, 900);
            }

            entrada.addEventListener('input', atualizarBotao);

            entrada.addEventListener('keydown', (evento) => {
                if (evento.key === 'Enter') {
                    evento.preventDefault();
                    enviar();
                }
            });

            botao.addEventListener('click', () => enviar());

            cartoes.forEach(cartao => {
                cartao.addEventListener('click', () => {
                    const tema = cartao.querySelector('.titulo-tema').textContent.trim();
                    enviar('Me explique sobre ' + tema + '.');
                });
            });
        })();
    
