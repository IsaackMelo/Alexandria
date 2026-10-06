        function filtrarProvas() {

            const dif = document.getElementById('filtroDificuldade').value;
            const assunto = document.getElementById('filtroAssunto').value;
            const vestibular = document.getElementById('filtroVestibular').value;
            const anoMin = document.getElementById('filtroAnoMin').value;
            const anoMax = document.getElementById('filtroAnoMax').value;
            const tipo = document.getElementById('filtroTipo').value;
            const busca = document.getElementById('inputBusca').value.toLowerCase();

            const itens = document.querySelectorAll('.item-prova');

            itens.forEach(function(item) {
                let mostrar = true;

                if (dif !== 'todos' && item.dataset.dificuldade !== dif) mostrar = false;

                if (assunto !== 'todos' && item.dataset.assunto !== assunto) mostrar = false;

                if (vestibular !== 'todos' && item.dataset.vestibular !== vestibular) mostrar = false;

                if (anoMin !== 'todos' && parseInt(item.dataset.ano) < parseInt(anoMin)) mostrar = false;
                if (anoMax !== 'todos' && parseInt(item.dataset.ano) > parseInt(anoMax)) mostrar = false;

                if (tipo !== 'todos' && item.dataset.tipo !== tipo) mostrar = false;

                if (busca !== '') {
                    const textoCompleto = item.textContent.toLowerCase();
                    if (!textoCompleto.includes(busca)) {
                        mostrar = false;
                    }
                }

                item.style.display = mostrar ? 'flex' : 'none';
            });
            const algumVisivel = Array.from(itens).some(function(item) { return item.style.display !== 'none'; });
            document.getElementById('semResultados').style.display = algumVisivel ? 'none' : 'block';
        }

        function ordenarProvas() {
            const ordem = document.getElementById('selectOrdem').value;
            const lista = document.getElementById('listaProvas');
            const itens = Array.from(document.querySelectorAll('.item-prova'));

            itens.sort(function(a, b) {
                const anoA = parseInt(a.dataset.ano);
                const anoB = parseInt(b.dataset.ano);

                return ordem === 'recentes' ? (anoB - anoA) : (anoA - anoB);
            });

            itens.forEach(function(item) {
                lista.appendChild(item);
            });
            lista.appendChild(document.getElementById('semResultados'));
        }
        ordenarProvas();
    
