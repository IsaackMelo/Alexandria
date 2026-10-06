(() => {
    const senha = document.getElementById('campoSenha');
    const confirmacao = document.getElementById('campoConfirmacao');
    const lista = document.getElementById('requisitosSenha');
    const formulario = document.getElementById('formSenha');
    if (!senha || !confirmacao || !lista || !formulario) return;

    const regras = {
        tamanho:   (valor) => valor.length >= 8,
        maiuscula: (valor) => /[A-ZÀ-Ý]/.test(valor),
        minuscula: (valor) => /[a-zà-ÿ]/.test(valor),
        numero:    (valor) => /\d/.test(valor),
        especial:  (valor) => /[^\p{L}\p{N}]/u.test(valor),
        iguais:    (valor) => valor !== '' && valor === confirmacao.value
    };

    function verificar() {
        let tudoCerto = true;
        lista.querySelectorAll('li').forEach((item) => {
            const ok = regras[item.dataset.regra](senha.value);
            item.classList.toggle('ok', ok);
            item.querySelector('i').className = ok ? 'fa-solid fa-circle-check' : 'fa-regular fa-circle';
            if (!ok) tudoCerto = false;
        });
        return tudoCerto;
    }

    senha.addEventListener('input', verificar);
    confirmacao.addEventListener('input', verificar);

    formulario.addEventListener('submit', (evento) => {
        if (!verificar()) {
            evento.preventDefault();
            lista.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
})();
