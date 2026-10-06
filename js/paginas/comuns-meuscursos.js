        (() => {
            const modal = document.getElementById('modalValidacao');
            const titulo = document.getElementById('tituloValidacao');
            const texto = document.getElementById('textoValidacao');
            const cursoSelecionado = document.getElementById('cursoSelecionado');
            const botaoCancelar = document.getElementById('botaoCancelar');
            const botaoIniciar = document.getElementById('botaoIniciar');
            let linkAtual = '';

            function abrirModal(card) {
                const nomeCurso = card.querySelector('.titulo-curso')?.textContent.trim() || 'este curso';
                const progresso = Number(card.dataset.progresso || 0);
                const comecar = progresso === 0;

                linkAtual = card.dataset.link || '';
                titulo.textContent = comecar ? 'Quer começar esse curso?' : 'Quer continuar esse curso?';
                texto.textContent = comecar ? 'Você está prestes a começar o curso' : 'Você está prestes a continuar o curso';
                botaoIniciar.textContent = comecar ? 'Começar curso' : 'Continuar curso';
                cursoSelecionado.textContent = `${nomeCurso}.`;

                modal.classList.add('aberto');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                botaoIniciar.focus();
            }

            function fecharModal() {
                modal.classList.remove('aberto');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            document.querySelectorAll('.cartao-curso').forEach((card) => {
                card.setAttribute('tabindex', '0');
                card.setAttribute('role', 'button');
                card.addEventListener('click', () => abrirModal(card));
                card.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        abrirModal(card);
                    }
                });
            });

            botaoCancelar.addEventListener('click', fecharModal);
            modal.addEventListener('click', (event) => {
                if (event.target === modal) fecharModal();
            });
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('aberto')) fecharModal();
            });

            botaoIniciar.addEventListener('click', () => {
                if (linkAtual) window.location.href = linkAtual;
            });
        })();
    
