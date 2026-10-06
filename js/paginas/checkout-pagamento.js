(() => {
    document.querySelectorAll('.btn-copiar').forEach((botao) => {
        botao.addEventListener('click', async () => {
            const alvo = document.getElementById(botao.dataset.copiar);
            if (!alvo) return;
            try {
                await navigator.clipboard.writeText(alvo.textContent.trim());
                const original = botao.innerHTML;
                botao.innerHTML = '<i class="fa-solid fa-check"></i> Copiado';
                setTimeout(() => { botao.innerHTML = original; }, 2000);
            } catch (erro) {
                alert('Não foi possível copiar automaticamente. Selecione o código e copie manualmente.');
            }
        });
    });
})();
