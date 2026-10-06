        (() => {
            const lista       = document.getElementById('listaNotificacoes');
            const itens       = [...lista.querySelectorAll('.item-notificacao')];
            const vazio       = document.getElementById('estadoVazio');
            const resumo      = document.getElementById('resumoFiltro');
            const botoesStatus = [...document.querySelectorAll('.botao-filtro[data-status]')];
            const botaoTodas  = document.getElementById('botaoTodas');
            const rotuloTodas = document.getElementById('rotuloTodas');
            const menuTipos   = document.getElementById('menuTipos');
            const botaoOrdenar = document.getElementById('botaoOrdenar');
            const rotuloOrdenar = document.getElementById('rotuloOrdenar');
            const menuOrdenar = document.getElementById('menuOrdenar');
            const botaoMarcar = document.getElementById('botaoMarcarTodas');
            const CHAVE_LIDAS = 'alexandria_notificacoes_lidas';

            const estado = { status: 'todas', tipo: 'todos', ordem: 'recentes' };

            function idsLidos() {
                try { return new Set(JSON.parse(sessionStorage.getItem(CHAVE_LIDAS) || '[]')); }
                catch (e) { return new Set(); }
            }
            function guardarLidos(ids) {
                try { sessionStorage.setItem(CHAVE_LIDAS, JSON.stringify([...ids])); } catch (e) {}
            }
            function marcarComoLida(item) {
                item.dataset.status = 'lida';
                item.classList.add('lida');
                const ponto = item.querySelector('.ponto-status');
                ponto.classList.remove('amarelo', 'verde', 'cinza');
                ponto.classList.add(item.dataset.tipo === 'conquista' ? 'verde' : 'cinza');
            }
            const lidosSalvos = idsLidos();
            itens.forEach(item => { if (lidosSalvos.has(item.dataset.id)) marcarComoLida(item); });

            const pesoNaoLida = item => item.dataset.status === 'lida' ? 1 : 0;

            function aplicar() {
                const ordenados = [...itens].sort((a, b) => {
                    const oa = Number(a.dataset.ordem), ob = Number(b.dataset.ordem);
                    if (estado.ordem === 'antigas') return ob - oa;
                    if (estado.ordem === 'nao_lidas_primeiro') return (pesoNaoLida(a) - pesoNaoLida(b)) || (oa - ob);
                    return oa - ob;
                });
                ordenados.forEach(item => lista.appendChild(item));

                let visiveis = [];
                ordenados.forEach(item => {
                    const s = item.dataset.status;
                    const passaStatus =
                        estado.status === 'todas' ||
                        (estado.status === 'nao_lidas'   && s !== 'lida') ||
                        (estado.status === 'importantes' && s === 'urgente');
                    const passaTipo = estado.tipo === 'todos' || item.dataset.tipo === estado.tipo;
                    const mostrar = passaStatus && passaTipo;
                    item.hidden = !mostrar;
                    item.classList.remove('primeiro-visivel', 'ultimo-visivel');
                    if (mostrar) visiveis.push(item);
                });
                if (visiveis.length) {
                    visiveis[0].classList.add('primeiro-visivel');
                    visiveis[visiveis.length - 1].classList.add('ultimo-visivel');
                }

                vazio.hidden = visiveis.length > 0;
                const naoLidas = itens.filter(i => i.dataset.status !== 'lida').length;
                resumo.textContent = `${visiveis.length} de ${itens.length} notificações · ${naoLidas} não lida${naoLidas === 1 ? '' : 's'}`;
                botaoMarcar.disabled = naoLidas === 0;

                botoesStatus.forEach(b => b.classList.toggle('ativo', b.dataset.status === estado.status));
            }

            function fecharMenus() {
                [[menuTipos, botaoTodas], [menuOrdenar, botaoOrdenar]].forEach(([menu, botao]) => {
                    menu.hidden = true;
                    botao.setAttribute('aria-expanded', 'false');
                });
            }
            function alternarMenu(menu, botao) {
                const abrir = menu.hidden;
                fecharMenus();
                menu.hidden = !abrir;
                botao.setAttribute('aria-expanded', String(abrir));
            }

            botoesStatus.forEach(botao => {
                botao.addEventListener('click', (event) => {
                    event.stopPropagation();
                    estado.status = botao.dataset.status;
                    if (botao === botaoTodas) {
                        alternarMenu(menuTipos, botaoTodas);
                    } else {
                        fecharMenus();
                    }
                    aplicar();
                });
            });

            menuTipos.querySelectorAll('button[data-tipo]').forEach(opcao => {
                opcao.addEventListener('click', (event) => {
                    event.stopPropagation();
                    estado.tipo = opcao.dataset.tipo;
                    menuTipos.querySelectorAll('button').forEach(b => b.classList.toggle('selecionado', b === opcao));
                    rotuloTodas.textContent = estado.tipo === 'todos' ? 'Todas' : opcao.textContent;
                    fecharMenus();
                    aplicar();
                });
            });

            botaoOrdenar.addEventListener('click', (event) => {
                event.stopPropagation();
                alternarMenu(menuOrdenar, botaoOrdenar);
            });

            menuOrdenar.querySelectorAll('button[data-ordem]').forEach(opcao => {
                opcao.addEventListener('click', (event) => {
                    event.stopPropagation();
                    estado.ordem = opcao.dataset.ordem;
                    menuOrdenar.querySelectorAll('button').forEach(b => b.classList.toggle('selecionado', b === opcao));
                    rotuloOrdenar.textContent = opcao.textContent;
                    fecharMenus();
                    aplicar();
                });
            });

            document.addEventListener('click', fecharMenus);
            document.addEventListener('keydown', (event) => { if (event.key === 'Escape') fecharMenus(); });

            botaoMarcar.addEventListener('click', (event) => {
                event.stopPropagation();
                const ids = idsLidos();
                itens.forEach(item => { marcarComoLida(item); ids.add(item.dataset.id); });
                guardarLidos(ids);
                aplicar();
            });

            itens.forEach(item => {
                item.querySelector('.acao-notificacao').addEventListener('click', () => {
                    const ids = idsLidos();
                    ids.add(item.dataset.id);
                    guardarLidos(ids);
                });
            });

            aplicar();
        })();
    
