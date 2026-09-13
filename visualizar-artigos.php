<?php
// Dados dos artigos: centralizados em dados.php
require_once __DIR__ . '/dados.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artigos</title>

<!-- Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

<style>
  :root{
    --bg-page:#faf8f5;
    --bg-card:#ffffff;
    --bordo:#8b1e2d;
    --bordo-escuro:#6f1724;
    --texto-titulo:#1f2733;
    --texto-corpo:#5b5f66;
    --borda-suave:#e3dbd3;
    --placeholder:#9a9490;
  }

  body{
    background-color: var(--bg-page);
    font-family:"Inter", sans-serif;
    color: var(--texto-corpo);
  }

  .page-wrap{
    max-width: 1220px;
    margin: 0 auto;
    padding: 32px 20px 64px;
  }

  /* Voltar */
  .voltar-link{
    color: var(--bordo);
    text-decoration:none;
    font-weight:600;
    font-size:0.95rem;
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-bottom: 18px;
  }
  .voltar-link:hover{ color: var(--bordo-escuro); }

  /* Cabeçalho */
  .cabecalho-topo{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom: 30px;
  }
  .titulo-pagina{
    font-family:"Playfair Display", serif;
    font-weight:800;
    color: var(--bordo);
    font-size: 2.6rem;
    margin-bottom: 4px;
  }
  .subtitulo-pagina{
    color:#8a8f96;
    font-size:1rem;
    margin:0;
  }

  /* Botão adicionar artigo (mesmo estilo do botão "Adicionar Aula ou Exercício") */
  .btn-adicionar-artigo{
    width:100%;
    background-color: #d8d4cd;
    border: none;
    border-radius: 10px;
    color:#7b7f85;
    font-weight:500;
    font-size:1rem;
    padding: 20px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    transition: background-color .15s ease;
    text-decoration:none;
    margin-bottom: 34px;
  }
  .btn-adicionar-artigo:hover{
    background-color:#cfcbc3;
    color:#5f636a;
  }
  .icone-mais{
    width:26px;
    height:26px;
    border-radius:50%;
    background-color:#a9adb3;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:0.95rem;
    flex-shrink:0;
  }
  .btn-adicionar-artigo:hover .icone-mais{
    background-color:#8d9199;
  }

  /* Barra de busca */
  .barra-busca{
    display:flex;
    align-items:center;
    gap:10px;
    background:#fff;
    border:1px solid var(--borda-suave);
    border-radius:10px;
    padding:11px 16px;
    margin-bottom: 22px;
  }
  .barra-busca i{ color: var(--placeholder); }
  .barra-busca input{
    border:none;
    outline:none;
    flex:1;
    font-size:0.92rem;
    color: var(--texto-titulo);
    background:transparent;
  }
  .barra-busca input::placeholder{ color: var(--placeholder); }

  /* ===== Cards de artigo ===== */
  .lista-artigos{ display:flex; flex-direction:column; gap:18px; }

  .artigo-card{
    display:flex;
    gap:20px;
    background-color: var(--bg-card);
    border: 1px solid var(--borda-suave);
    border-radius: 14px;
    padding: 20px;
    align-items:flex-start;
    transition: box-shadow .15s ease, border-color .15s ease;
  }
  .artigo-card:hover{
    border-color:#d8cfc7;
    box-shadow:0 4px 16px rgba(75,44,20,0.06);
  }

  .artigo-imagem{
    width:190px;
    height:126px;
    border-radius:10px;
    overflow:hidden;
    flex-shrink:0;
    background:#f0ebe6;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#b9b0a4;
    font-size:1.6rem;
  }
  .artigo-imagem img{
    width:100%;
    height:100%;
    object-fit:cover;
  }

  .artigo-corpo{ flex:1; min-width:0; }

  .artigo-categoria{
    display:flex;
    align-items:center;
    gap:6px;
    color: var(--bordo);
    font-weight:700;
    font-size:0.72rem;
    text-transform:uppercase;
    letter-spacing:.04em;
    margin-bottom: 8px;
  }
  .artigo-categoria i{ font-size:0.6rem; }

  .artigo-titulo{
    font-family:"Playfair Display", serif;
    font-weight:700;
    font-size:1.28rem;
    color: var(--texto-titulo);
    margin:0 0 8px;
    line-height:1.3;
  }

  .artigo-resumo{
    color: var(--texto-corpo);
    font-size:0.9rem;
    line-height:1.6;
    margin:0 0 14px;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }

  .artigo-meta{
    display:flex;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
    color: var(--placeholder);
    font-size:0.8rem;
  }
  .artigo-meta span{ display:flex; align-items:center; gap:6px; }

  .artigo-acoes{
    flex-shrink:0;
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  .btn-editar-item{
    background: transparent;
    border: 1px solid var(--bordo);
    color: var(--bordo);
    font-weight:600;
    font-size:0.82rem;
    border-radius: 7px;
    padding: 7px 14px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    white-space:nowrap;
  }
  .btn-editar-item:hover{
    background-color: rgba(139,30,45,0.08);
    color: var(--bordo-escuro);
  }
  .btn-remover-item{
    background: transparent;
    border: 1px solid var(--borda-suave);
    color:#a3383f;
    border-radius: 7px;
    padding: 7px 10px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
  }
  .btn-remover-item:hover{
    background-color: rgba(163,56,63,0.08);
    border-color:#a3383f;
  }

  .aviso-vazio{
    border:1px dashed var(--borda-suave);
    border-radius:12px;
    padding:40px;
    text-align:center;
    color: var(--placeholder);
    font-size:0.92rem;
  }

  @media (max-width: 767px){
    .titulo-pagina{ font-size: 2.1rem; }
    .artigo-card{ flex-direction:column; }
    .artigo-imagem{ width:100%; height:170px; }
    .artigo-acoes{ flex-direction:row; width:100%; }
    .artigo-acoes .btn-editar-item{ flex:1; }
  }
</style>
</head>
<body>

    <?php
    include("../alexandria-frontend/includes/barraadm.html");
    include("../alexandria-frontend/includes/sidebaradm.html");
    ?>

<div class="page-wrap">

  <a href="#" class="voltar-link" onclick="window.history.back(); return false;">
    <i class="bi bi-arrow-left"></i> Voltar
  </a>

  <div class="cabecalho-topo">
    <div>
      <h1 class="titulo-pagina">Artigos</h1>
      <p class="subtitulo-pagina">Veja os artigos já publicados ou adicione um novo.</p>
    </div>
  </div>

  <a href="adicionar-artigos.php" class="btn-adicionar-artigo">
    <span class="icone-mais"><i class="bi bi-plus"></i></span>
    Adicionar Artigo
  </a>

  <div class="barra-busca">
    <i class="bi bi-search"></i>
    <input type="text" id="campoBusca" placeholder="Buscar por título ou categoria...">
  </div>

  <div class="lista-artigos" id="listaArtigos">
    <?php foreach ($artigos as $indice => $artigo): ?>
    <div class="artigo-card" data-titulo="<?= htmlspecialchars(mb_strtolower($artigo['titulo'])) ?>" data-categoria="<?= htmlspecialchars(mb_strtolower($artigo['categoria'])) ?>">
      <div class="artigo-imagem">
        <?php if (!empty($artigo['imagem']) && file_exists($artigo['imagem'])): ?>
          <img src="<?= htmlspecialchars($artigo['imagem']) ?>" alt="<?= htmlspecialchars($artigo['titulo']) ?>">
        <?php else: ?>
          <i class="bi bi-image"></i>
        <?php endif; ?>
      </div>

      <div class="artigo-corpo">
        <div class="artigo-categoria"><i class="bi bi-square-fill"></i> <?= htmlspecialchars(mb_strtoupper($artigo['categoria'])) ?></div>
        <h3 class="artigo-titulo"><?= htmlspecialchars($artigo['titulo']) ?></h3>
        <p class="artigo-resumo"><?= htmlspecialchars($artigo['resumo']) ?></p>
        <div class="artigo-meta">
          <span><i class="bi bi-clock"></i> <?= htmlspecialchars($artigo['tempo_leitura']) ?></span>
          <span><i class="bi bi-calendar3"></i> <?= htmlspecialchars($artigo['data']) ?></span>
          <span><i class="bi bi-person"></i> <?= htmlspecialchars($artigo['autor']) ?></span>
        </div>
      </div>

      <div class="artigo-acoes">
        <a class="btn-editar-item" href="editar-artigo.php?id=<?= $indice ?>">
          <i class="bi bi-pencil"></i> Editar
        </a>
        <button type="button" class="btn-remover-item" title="Remover" onclick="removerArtigo(this)">
          <i class="bi bi-trash"></i>
        </button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="aviso-vazio" id="avisoSemResultados" style="display:none;">
    Nenhum artigo encontrado para essa busca.
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
  // Busca simples por título ou categoria (filtra os cards já renderizados)
  const campoBusca = document.getElementById('campoBusca');
  const listaArtigos = document.getElementById('listaArtigos');
  const avisoSemResultados = document.getElementById('avisoSemResultados');
  const cards = Array.from(listaArtigos.querySelectorAll('.artigo-card'));

  campoBusca.addEventListener('input', () => {
    const termo = campoBusca.value.trim().toLowerCase();
    let algumVisivel = false;

    cards.forEach(card => {
      const corresponde = card.dataset.titulo.includes(termo) || card.dataset.categoria.includes(termo);
      card.style.display = corresponde ? '' : 'none';
      if (corresponde) algumVisivel = true;
    });

    avisoSemResultados.style.display = algumVisivel ? 'none' : 'block';
  });

  // Remover artigo (front-end apenas — conecte ao backend para excluir de verdade)
  function removerArtigo(botao) {
    const card = botao.closest('.artigo-card');
    if (confirm('Tem certeza que deseja remover este artigo?')) {
      card.remove();
    }
  }
</script>

</body>
</html>