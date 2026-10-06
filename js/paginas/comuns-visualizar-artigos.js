  const campoBusca = document.getElementById('campoBusca');
  const filtroCategoria = document.getElementById('filtroCategoria');
  const listaArtigos = document.getElementById('listaArtigos');
  const avisoSemResultados = document.getElementById('avisoSemResultados');
  const cards = Array.from(listaArtigos.querySelectorAll('.artigo-card'));

  function aplicarFiltros() {
    const termo = campoBusca.value.trim().toLowerCase();
    const categoria = filtroCategoria.value;
    let algumVisivel = false;

    cards.forEach(card => {
      const correspondeTexto = card.dataset.titulo.includes(termo) || card.dataset.categoria.includes(termo);
      const correspondeCategoria = categoria === '' || card.dataset.categoria === categoria;
      const visivel = correspondeTexto && correspondeCategoria;

      card.style.display = visivel ? '' : 'none';
      if (visivel) algumVisivel = true;
    });

    avisoSemResultados.style.display = algumVisivel ? 'none' : 'block';
  }

  campoBusca.addEventListener('input', aplicarFiltros);
  filtroCategoria.addEventListener('change', aplicarFiltros);

  function removerArtigo(botao) {
    const card = botao.closest('.artigo-card');
    if (confirm('Tem certeza que deseja remover este artigo?')) {
      card.remove();
    }
  }
