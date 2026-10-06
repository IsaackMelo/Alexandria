(() => {
    const planoCards = document.querySelectorAll('.plano-mini-card');
    const pagamentoCards = document.querySelectorAll('.pagamento-card');
    const resumoNome = document.getElementById('resumo-nome-plano');
    const resumoPreco = document.getElementById('resumo-preco-plano');
    const resumoTotal = document.getElementById('resumo-total-valor');
    const resumoLista = document.getElementById('resumo-lista-itens');
    const campoPlano = document.getElementById('campoPlano');
    const campoMetodo = document.getElementById('campoMetodo');
    const formulario = document.getElementById('formCheckout');
    const aviso = document.getElementById('avisoConta');

    planoCards.forEach((card) => {
        card.addEventListener('click', () => {
            if (card.dataset.bloqueado === '1') return;

            planoCards.forEach((c) => c.classList.remove('selecionado'));
            card.classList.add('selecionado');

            campoPlano.value = card.dataset.slug;
            resumoNome.textContent = card.dataset.nome;
            resumoPreco.textContent = card.dataset.preco;
            resumoTotal.textContent = card.dataset.preco;

            resumoLista.innerHTML = '';
            card.dataset.itens.split(';').filter(Boolean).forEach((item) => {
                const li = document.createElement('li');
                li.textContent = item.trim();
                resumoLista.appendChild(li);
            });
        });
    });

    pagamentoCards.forEach((card) => {
        card.addEventListener('click', () => {
            pagamentoCards.forEach((c) => c.classList.remove('selecionado'));
            card.classList.add('selecionado');
            campoMetodo.value = card.dataset.metodo;
        });
    });

    formulario.addEventListener('submit', (evento) => {
        const botao = formulario.querySelector('.btn-confirmar');
        if (botao.dataset.logado !== '1') {
            evento.preventDefault();
            if (aviso) {
                aviso.hidden = false;
                aviso.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }
        if (!campoPlano.value) {
            evento.preventDefault();
        }
    });
})();
