        (() => {
            const sidebar = document.getElementById('listaSidebar');
            const botao = document.getElementById('botaoConteudos');
            if (!sidebar || !botao) return;

            const ativo = sidebar.querySelector('.lesson-item.active .lesson-name');
            const rotulo = botao.querySelector('.aula-atual');
            if (ativo && rotulo) rotulo.textContent = ativo.textContent.trim();

            botao.addEventListener('click', () => {
                const aberta = sidebar.classList.toggle('aberta');
                botao.setAttribute('aria-expanded', String(aberta));
            });

            sidebar.querySelectorAll('.lesson-item-link').forEach(link => {
                link.addEventListener('click', () => {
                    sidebar.classList.remove('aberta');
                    botao.setAttribute('aria-expanded', 'false');
                });
            });
        })();
    
