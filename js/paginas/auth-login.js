        (() => {
            const botao = document.getElementById('alternarSenha');
            const campo = document.getElementById('campoSenha');
            if (!botao || !campo) return;
            const alternar = () => {
                const mostrar = campo.type === 'password';
                campo.type = mostrar ? 'text' : 'password';
                botao.setAttribute('aria-pressed', String(mostrar));
                botao.setAttribute('aria-label', mostrar ? 'Ocultar senha' : 'Mostrar senha');
                botao.querySelector('i').className = (mostrar ? 'bi bi-eye-slash' : 'bi bi-eye') + ' fs-4';
            };
            botao.addEventListener('click', alternar);
            botao.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); alternar(); }
            });
        })();
    
