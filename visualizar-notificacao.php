<?php
/**
 * visualizar-notificacao.php
 * Listagem de notificações com ações de Visualizar, Editar e Excluir por card.
 */

// Dados e configuração visual das notificações: centralizados em dados.php
require_once __DIR__ . '/dados.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notificações</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@500;600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #F7F4EF;
    --paper: #FFFFFF;
    --ink: #2A2420;
    --ink-soft: #6E655C;
    --line: #E7DFD4;
    --wine: #8A2E3E;
    --wine-dark: #6E2432;
    --wine-tint: #F3E4E6;
    --danger: #B3273E;
    --danger-tint: #FBE9EA;
    --ok: #2F7A45;
    --ok-tint: #E5F3E8;
    --radius: 14px;
    --shadow: 0 1px 2px rgba(42,36,32,.04), 0 8px 20px -12px rgba(42,36,32,.15);
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    background:var(--bg);
    color:var(--ink);
    font-family:'Manrope', -apple-system, sans-serif;
    -webkit-font-smoothing:antialiased;
  }
  .page{
    max-width:760px;
    margin:0 auto;
    padding:40px 20px 80px;
  }
  .page-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:20px;
    margin-bottom:18px;
  }
  .page-head h1{
    font-family:'Source Serif 4', serif;
    font-weight:600;
    font-size:28px;
    margin:0;
    letter-spacing:-.01em;
  }
  .page-head p{
    margin:4px 0 0;
    color:var(--ink-soft);
    font-size:14px;
  }
  .btn-primary{
    flex:0 0 auto;
    display:flex;
    align-items:center;
    gap:7px;
    background:var(--wine);
    color:#fff;
    border:none;
    border-radius:9px;
    padding:11px 18px;
    font-family:inherit;
    font-size:13.5px;
    font-weight:700;
    cursor:pointer;
    white-space:nowrap;
    text-decoration:none;
    transition:background .15s ease;
  }
  .btn-primary:hover{ background:var(--wine-dark); }
  .btn-primary svg{ width:15px; height:15px; }

  .divider{
    border:none;
    border-top:1px solid var(--line);
    margin:0 0 18px;
  }

  .toolbar{
    display:flex;
    gap:14px;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    margin-bottom:22px;
  }
  .toolbar-count{
    font-size:13.5px;
    color:var(--ink-soft);
  }
  .toolbar-controls{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
  }
  .search-input{
    font-family:inherit;
    border:1px solid var(--line);
    background:var(--paper);
    border-radius:9px;
    padding:9px 12px;
    font-size:13.5px;
    color:var(--ink);
    min-width:220px;
  }
  .search-input:focus, .filter-select:focus{
    outline:none;
    border-color:#C9B9A8;
  }
  .filter-select{
    font-family:inherit;
    border:1px solid var(--line);
    background:var(--paper);
    border-radius:9px;
    padding:9px 12px;
    font-size:13.5px;
    color:var(--ink);
    cursor:pointer;
  }

  .list{
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  .card{
    background:var(--paper);
    border:1px solid var(--line);
    border-radius:var(--radius);
    padding:16px;
    display:flex;
    gap:14px;
    box-shadow:var(--shadow);
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .card[data-removing="true"]{
    opacity:0;
    transform:scale(.97);
    transition:opacity .2s ease, transform .2s ease;
  }
  .icon-chip{
    flex:0 0 auto;
    width:42px;
    height:42px;
    border-radius:11px;
    display:flex;
    align-items:center;
    justify-content:center;
  }
  .icon-chip svg{ width:20px; height:20px; }
  .card-body{
    flex:1 1 auto;
    min-width:0;
  }
  .card-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:10px;
  }
  .card-title{
    font-size:15px;
    font-weight:700;
    margin:0 0 4px;
    line-height:1.3;
  }
  .status-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    margin-top:6px;
    flex:0 0 auto;
  }
  .card-desc{
    margin:0 0 10px;
    font-size:13.5px;
    line-height:1.5;
    color:var(--ink-soft);
  }
  .card-foot{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    flex-wrap:wrap;
  }
  .card-time{
    font-size:12.5px;
    color:#9B9187;
  }
  .actions{
    display:flex;
    gap:6px;
  }
  .btn-icon{
    width:32px;
    height:32px;
    border-radius:9px;
    border:1px solid var(--line);
    background:var(--paper);
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    color:var(--ink-soft);
    transition:background .15s ease, color .15s ease, border-color .15s ease;
  }
  .btn-icon svg{ width:15px; height:15px; }
  .btn-icon.view:hover{ border-color:var(--wine); color:var(--wine-dark); background:var(--wine-tint); }
  .btn-icon.edit:hover{ border-color:#B08A3C; color:#8A6D1B; background:#FBF3DD; }
  .btn-icon.delete:hover{ border-color:var(--danger); color:var(--danger); background:var(--danger-tint); }

  .edit-form{ display:none; }
  .card.is-editing .card-view{ display:none; }
  .card.is-editing .edit-form{ display:block; }
  .edit-form input, .edit-form textarea,
  .modal input[type="text"], .modal textarea{
    width:100%;
    font-family:inherit;
    border:1px solid var(--line);
    border-radius:8px;
    padding:8px 10px;
    font-size:13.5px;
    color:var(--ink);
    margin-bottom:8px;
    resize:vertical;
  }
  .edit-form textarea{ min-height:64px; }
  .edit-actions{ display:flex; gap:8px; justify-content:flex-end; }
  .btn-text{
    border:none;
    border-radius:8px;
    padding:7px 14px;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
  }
  .btn-save{ background:var(--wine); color:#fff; }
  .btn-save:hover{ background:var(--wine-dark); }
  .btn-cancel{ background:transparent; color:var(--ink-soft); }
  .btn-cancel:hover{ color:var(--ink); }

  /* Modal de visualização */
  .overlay{
    position:fixed; inset:0;
    background:rgba(38,32,28,.4);
    display:none;
    align-items:center;
    justify-content:center;
    padding:20px;
    z-index:50;
  }
  .overlay.open{ display:flex; }
  .modal{
    background:var(--paper);
    border-radius:16px;
    max-width:420px;
    width:100%;
    padding:22px;
    box-shadow:0 20px 50px -20px rgba(0,0,0,.35);
  }
  .modal-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:10px;
    margin-bottom:12px;
  }
  .modal-head h2{
    font-family:'Source Serif 4', serif;
    font-size:19px;
    margin:0;
    line-height:1.3;
  }
  .modal-close{
    background:none; border:none; cursor:pointer;
    color:var(--ink-soft);
    width:28px; height:28px;
    display:flex; align-items:center; justify-content:center;
    border-radius:8px;
  }
  .modal-close:hover{ background:var(--bg); }
  .modal-desc{ font-size:14px; color:var(--ink-soft); line-height:1.6; margin:0 0 14px; }
  .modal-meta{ font-size:12.5px; color:#9B9187; border-top:1px solid var(--line); padding-top:12px; }

  /* Confirmação de exclusão */
  .modal.confirm p{ font-size:14px; color:var(--ink-soft); margin:0 0 18px; }
  .confirm-actions{ display:flex; gap:8px; justify-content:flex-end; }
  .btn-danger{ background:var(--danger); color:#fff; }
  .btn-danger:hover{ background:#8f1f32; }

  .empty-state{
    text-align:center;
    padding:60px 20px;
    color:var(--ink-soft);
    display:none;
  }
  .empty-state.show{ display:block; }
  .empty-state h3{ font-family:'Source Serif 4', serif; color:var(--ink); margin:0 0 6px; }

  @media (max-width:520px){
    .page{ padding:28px 14px 60px; }
    .toolbar{ flex-direction:column; align-items:stretch; }
  }
</style>
</head>
<body>

    <?php
        include("../alexandria-frontend/includes/barraadm.html");
        include("../alexandria-frontend/includes/sidebaradm.html");
    ?>

<div class="page">

  <div class="page-head">
    <div>
      <h1>Gerenciamento de notificações</h1>
      <p>As notificações abaixo são as mesmas exibidas para os alunos.</p>
    </div>
    <a href="adicionar-notificacao.php" class="btn-primary">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
      Nova notificação
    </a>
  </div>

  <hr class="divider">

  <div class="toolbar">
    <span class="toolbar-count" id="contagem"><?= count($notificacoes) ?> notificações cadastradas</span>
    <div class="toolbar-controls">
      <input type="text" id="busca" class="search-input" placeholder="Buscar notificações...">
      <select id="filtroTipo" class="filter-select">
        <option value="todos">Todos os tipos</option>
        <option value="modulo">Módulo</option>
        <option value="simulado">Simulado</option>
        <option value="atualizacao">Atualização</option>
        <option value="conquista">Conquista</option>
        <option value="chat">Chat AI</option>
      </select>
    </div>
  </div>

  <div class="list" id="lista">
    <?php foreach ($notificacoes as $n):
        $cfg = $tiposConfig[$n['tipo']];
        $corStatus = $statusConfig[$n['status']];
    ?>
    <article class="card" data-id="<?= $n['id'] ?>" data-status="<?= $n['status'] ?>" data-tipo="<?= $n['tipo'] ?>">

      <div class="icon-chip" style="background:<?= $cfg['bg'] ?>; color:<?= $cfg['fg'] ?>;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg($cfg['icon']) ?></svg>
      </div>

      <div class="card-body">

        <div class="card-view">
          <div class="card-top">
            <p class="card-title"><?= htmlspecialchars($n['titulo']) ?></p>
            <span class="status-dot" style="background:<?= $corStatus ?>;"></span>
          </div>
          <p class="card-desc"><?= htmlspecialchars($n['descricao']) ?></p>
          <div class="card-foot">
            <span class="card-time"><?= htmlspecialchars($n['tempo']) ?></span>
            <div class="actions">
              <button class="btn-icon view" title="Visualizar" onclick="abrirVisualizacao(<?= $n['id'] ?>)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('eye') ?></svg>
              </button>
              <button class="btn-icon edit" title="Editar" onclick="entrarEdicao(<?= $n['id'] ?>)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('pencil') ?></svg>
              </button>
              <button class="btn-icon delete" title="Excluir" onclick="abrirConfirmacao(<?= $n['id'] ?>)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('trash') ?></svg>
              </button>
            </div>
          </div>
        </div>

        <div class="edit-form">
          <input type="text" value="<?= htmlspecialchars($n['titulo']) ?>" data-field="titulo">
          <textarea data-field="descricao"><?= htmlspecialchars($n['descricao']) ?></textarea>
          <div class="edit-actions">
            <button class="btn-text btn-cancel" onclick="cancelarEdicao(<?= $n['id'] ?>)">Cancelar</button>
            <button class="btn-text btn-save" onclick="salvarEdicao(<?= $n['id'] ?>)">Salvar alterações</button>
          </div>
        </div>

      </div>
    </article>
    <?php endforeach; ?>
  </div>

  <div class="empty-state" id="empty">
    <h3>Nenhuma notificação por aqui</h3>
    <p>Quando algo novo acontecer na sua trilha, você verá primeiro nesta lista.</p>
  </div>

</div>

<!-- Modal: Visualizar -->
<div class="overlay" id="overlayView">
  <div class="modal">
    <div class="modal-head">
      <h2 id="viewTitulo">Título</h2>
      <button class="modal-close" onclick="fecharModal('overlayView')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('x') ?></svg>
      </button>
    </div>
    <p class="modal-desc" id="viewDescricao">Descrição</p>
    <p class="modal-meta" id="viewTempo">Há alguns instantes</p>
  </div>
</div>

<!-- Modal: Confirmar exclusão -->
<div class="overlay" id="overlayDelete">
  <div class="modal confirm">
    <div class="modal-head">
      <h2>Excluir notificação?</h2>
      <button class="modal-close" onclick="fecharModal('overlayDelete')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('x') ?></svg>
      </button>
    </div>
    <p>Essa ação não pode ser desfeita. A notificação será removida da sua lista.</p>
    <div class="confirm-actions">
      <button class="btn-text btn-cancel" onclick="fecharModal('overlayDelete')">Cancelar</button>
      <button class="btn-text btn-danger" id="confirmarExclusao">Excluir</button>
    </div>
  </div>
</div>

<script>
  const notificacoes = <?= json_encode($notificacoes, JSON_UNESCAPED_UNICODE) ?>;
  let idParaExcluir = null;

  function buscarNotificacao(id){
    return notificacoes.find(n => n.id === id);
  }

  function abrirVisualizacao(id){
    const n = buscarNotificacao(id);
    const card = document.querySelector(`.card[data-id="${id}"]`);
    const tituloAtual = card.querySelector('[data-field="titulo"]')?.value ?? n.titulo;
    const descAtual = card.querySelector('[data-field="descricao"]')?.value ?? n.descricao;
    document.getElementById('viewTitulo').textContent = tituloAtual;
    document.getElementById('viewDescricao').textContent = descAtual;
    document.getElementById('viewTempo').textContent = n.tempo;
    document.getElementById('overlayView').classList.add('open');
  }

  function fecharModal(id){
    document.getElementById(id).classList.remove('open');
  }

  function entrarEdicao(id){
    document.querySelector(`.card[data-id="${id}"]`).classList.add('is-editing');
  }

  function cancelarEdicao(id){
    const card = document.querySelector(`.card[data-id="${id}"]`);
    const n = buscarNotificacao(id);
    card.querySelector('[data-field="titulo"]').value = n.titulo;
    card.querySelector('[data-field="descricao"]').value = n.descricao;
    card.classList.remove('is-editing');
  }

  function salvarEdicao(id){
    const card = document.querySelector(`.card[data-id="${id}"]`);
    const novoTitulo = card.querySelector('[data-field="titulo"]').value.trim();
    const novaDesc = card.querySelector('[data-field="descricao"]').value.trim();

    card.querySelector('.card-title').textContent = novoTitulo;
    card.querySelector('.card-desc').textContent = novaDesc;

    const n = buscarNotificacao(id);
    n.titulo = novoTitulo;
    n.descricao = novaDesc;

    card.classList.remove('is-editing');

    // Ponto de integração: envie novoTitulo / novaDesc ao servidor via fetch().
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

    // Ponto de integração: envie a exclusão ao servidor via fetch().
  });

  function atualizarContagem(){
    const total = document.querySelectorAll('#lista .card').length;
    document.getElementById('empty').classList.toggle('show', total === 0);
    document.getElementById('contagem').textContent =
      total === 1 ? '1 notificação cadastrada' : `${total} notificações cadastradas`;
  }
  function verificarListaVazia(){ atualizarContagem(); }

  // Busca + filtro por tipo
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

  // Fecha modal clicando fora
  document.querySelectorAll('.overlay').forEach(ov => {
    ov.addEventListener('click', e => { if (e.target === ov) ov.classList.remove('open'); });
  });
</script>

</body>
</html>