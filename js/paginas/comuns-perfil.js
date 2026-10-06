        (() => {
            const cartao = document.querySelector('.secao-direita .cartao-informacao');
            const exibicoes = cartao.querySelectorAll('[data-exibicao]');
            const entradas = cartao.querySelectorAll('[data-edicao]');
            const botoesExibicao = document.getElementById('botoesExibicao');
            const botoesEdicao = document.getElementById('botoesEdicao');

            function entrarEmEdicao() {
                exibicoes.forEach(el => el.hidden = true);
                entradas.forEach(el => el.hidden = false);
                botoesExibicao.hidden = true;
                botoesEdicao.hidden = false;
                entradas[0]?.focus();
            }

            function voltarParaExibicao() {
                entradas.forEach(el => { el.value = el.defaultValue; el.hidden = true; });
                exibicoes.forEach(el => el.hidden = false);
                botoesEdicao.hidden = true;
                botoesExibicao.hidden = false;
            }

            document.getElementById('botaoFazerAlteracao').addEventListener('click', entrarEmEdicao);
            document.getElementById('botaoCancelar').addEventListener('click', voltarParaExibicao);
            document.getElementById('botaoSalvar').addEventListener('click', voltarParaExibicao);

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !botoesEdicao.hidden) voltarParaExibicao();
            });
        })();
    
