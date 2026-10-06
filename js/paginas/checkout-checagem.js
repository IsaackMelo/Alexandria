(() => {
    const bloco = document.getElementById('statusPagamento');
    const simbolo = document.getElementById('simboloStatus');
    const titulo = document.getElementById('tituloStatus');
    const texto = document.getElementById('textoStatus');
    const acoes = document.getElementById('acoesStatus');
    const botaoPlataforma = document.getElementById('botaoPlataforma');
    const botaoTentar = document.getElementById('botaoTentar');
    if (!bloco) return;

    const confirmado = bloco.dataset.valido === '1';

    setTimeout(() => {
        simbolo.classList.remove('carregando');
        acoes.hidden = false;

        if (confirmado) {
            simbolo.classList.add('sucesso');
            titulo.textContent = 'Pagamento confirmado';
            texto.textContent = 'Tudo certo! Seu plano já está ativo e o acesso foi liberado.';
            botaoPlataforma.hidden = false;
            const agendado = document.getElementById('avisoAgendado');
            if (agendado) agendado.hidden = false;
        } else {
            simbolo.classList.add('erro');
            titulo.textContent = 'Não foi possível confirmar';
            texto.textContent = 'Não conseguimos confirmar o pagamento. Revise os dados da compra e tente de novo.';
            botaoTentar.hidden = false;
        }
    }, 2600);
})();
