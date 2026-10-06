  let idParaExcluir = null;

  function fecharModal(id){
    document.getElementById(id).classList.remove('open');
  }

  function abrirConfirmacao(id){
    idParaExcluir = id;
    document.getElementById('overlayDelete').classList.add('open');
  }

  document.getElementById('confirmarExclusao').addEventListener('click', () => {
    if (idParaExcluir === null) return;
    const card = document.querySelector(`.card[data-id="${idParaExcluir}"]`);
    card.setAttribute('data-removing', 'true');
    setTimeout(() => {
      card.remove();
      verificarListaVazia();
    }, 200);
    fecharModal('overlayDelete');
    idParaExcluir = null;

  });

  function atualizarContagem(){
    const total = document.querySelectorAll('#lista .card').length;
    document.getElementById('empty').classList.toggle('show', total === 0);
    document.getElementById('contagem').textContent =
      total === 1 ? '1 notificação cadastrada' : `${total} notificações cadastradas`;
  }
  function verificarListaVazia(){ atualizarContagem(); }

  function aplicarFiltros(){
    const termo = busca.value.trim().toLowerCase();
    const tipo = filtroTipo.value;
    document.querySelectorAll('#lista .card').forEach(card => {
      const titulo = card.querySelector('.card-title').textContent.toLowerCase();
      const desc = card.querySelector('.card-desc').textContent.toLowerCase();
      const bateTipo = tipo === 'todos' || card.dataset.tipo === tipo;
      const bateBusca = termo === '' || titulo.includes(termo) || desc.includes(termo);
      card.style.display = (bateTipo && bateBusca) ? 'flex' : 'none';
    });
  }
  const busca = document.getElementById('busca');
  const filtroTipo = document.getElementById('filtroTipo');
  busca.addEventListener('input', aplicarFiltros);
  filtroTipo.addEventListener('change', aplicarFiltros);

  document.querySelectorAll('.overlay').forEach(ov => {
    ov.addEventListener('click', e => { if (e.target === ov) ov.classList.remove('open'); });
  });
