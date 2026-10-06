<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

$isAdm  = $_SESSION['conta']['tipo'] === 'ADM';
$isUser = !$isAdm;

if ($isUser && empty($_SESSION['conta']['plano'])) {
    header('Location: ../web/plano.php');
    exit;
}
?>
<?php

require_once __DIR__ . '/../includes/dados.php';
?>
<?php if ($isAdm): ?>
<?php ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notificações</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@500;600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-notificacoes-adm.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php
        include __DIR__ . '/../includes/topbar.php';
        include __DIR__ . '/../includes/sidebar.php';
    ?>

<div class="page">

  <div class="page-head">
    <div>
      <h1>Gerenciamento de notificações</h1>
      <p>As notificações abaixo são as mesmas exibidas para os alunos.</p>
    </div>
    <a href="../adm/adicionar-notificacao.php" class="btn-primary">
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
              <a class="btn-icon view" title="Visualizar" href="visualizar-notificacao.php?id=<?= $n['id'] ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('eye') ?></svg>
              </a>
              <a class="btn-icon edit" title="Editar" href="../adm/editar-notificacao.php?id=<?= $n['id'] ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('pencil') ?></svg>
              </a>
              <button class="btn-icon delete" title="Excluir" onclick="abrirConfirmacao(<?= $n['id'] ?>)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= icone_svg('trash') ?></svg>
              </button>
            </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="../js/paginas/comuns-visualizar-notificacoes.js"></script>

</body>
</html>
<?php else: ?>
<?php ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Notificações</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-notificacoes-user.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php include __DIR__ . '/../includes/sidebar.php'; ?>

    <div class="container-principal">
        <?php include __DIR__ . '/../includes/topbar.php'; ?>

<?php
    $visual_tipos_user = [
        'modulo'      => ['icone' => 'fa-solid fa-book-open',        'botao' => 'Ver módulo',        'rotulo' => 'Módulo'],
        'simulado'    => ['icone' => 'fa-regular fa-clipboard',       'botao' => 'Fazer simulado',    'rotulo' => 'Simulado'],
        'atualizacao' => ['icone' => 'fa-solid fa-building-columns', 'botao' => 'Explorar conteúdo', 'rotulo' => 'Atualização'],
        'conquista'   => ['icone' => 'fa-regular fa-circle-check',    'botao' => 'Conquista',         'rotulo' => 'Conquista'],
        'chat'        => ['icone' => 'fa-solid fa-comments',          'botao' => 'Ver mensagem',      'rotulo' => 'Chat AI'],
    ];
    $classe_ponto_user = ['urgente' => '', 'nao_lida' => 'amarelo', 'lida' => 'cinza'];
?>

        <main class="conteudo-principal">
            <section class="area-notificacoes">
                <div class="filtros-notificacoes">
                    <div class="grupo-menu">
                        <button type="button" class="botao-filtro ativo" data-status="todas" id="botaoTodas" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-regular fa-bell"></i> <span id="rotuloTodas">Todas</span> <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <ul class="menu-suspenso" id="menuTipos" hidden>
                            <li><button type="button" data-tipo="todos" class="selecionado">Todos os tipos</button></li>
                            <?php foreach ($visual_tipos_user as $chave => $v): ?>
                            <li><button type="button" data-tipo="<?= $chave ?>"><?= htmlspecialchars($v['rotulo']) ?></button></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button type="button" class="botao-filtro" data-status="nao_lidas"><i class="fa-regular fa-envelope"></i> Não lidas</button>
                    <button type="button" class="botao-filtro" data-status="importantes"><i class="fa-regular fa-bookmark"></i> Importantes</button>
                    <button type="button" class="botao-filtro botao-marcar" id="botaoMarcarTodas"><i class="fa-regular fa-circle-check"></i> Marcar todas como lidas</button>
                    <div class="grupo-menu ordenar">
                        <button type="button" class="botao-ordenar" id="botaoOrdenar" aria-haspopup="true" aria-expanded="false">
                            <span id="rotuloOrdenar">Ordenar por</span> <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <ul class="menu-suspenso" id="menuOrdenar" hidden>
                            <li><button type="button" data-ordem="recentes" class="selecionado">Mais recentes</button></li>
                            <li><button type="button" data-ordem="antigas">Mais antigas</button></li>
                            <li><button type="button" data-ordem="nao_lidas_primeiro">Não lidas primeiro</button></li>
                        </ul>
                    </div>
                </div>

                <p class="resumo-filtro" id="resumoFiltro"></p>

                <div class="lista-notificacoes" id="listaNotificacoes">
                    <?php foreach ($notificacoes as $posicao => $n):
                        $v = $visual_tipos_user[$n['tipo']] ?? ['icone' => 'fa-regular fa-bell', 'botao' => 'Ver notificação', 'rotulo' => ''];
                        $ponto = $classe_ponto_user[$n['status']] ?? '';
                        if ($n['status'] === 'lida' && $n['tipo'] === 'conquista') $ponto = 'verde';
                        $link = 'visualizar-notificacao.php?id=' . (int) $n['id'];
                    ?>
                    <article class="item-notificacao<?= $n['status'] === 'lida' ? ' lida' : '' ?>"
                             data-id="<?= (int) $n['id'] ?>"
                             data-tipo="<?= htmlspecialchars($n['tipo']) ?>"
                             data-status="<?= htmlspecialchars($n['status']) ?>"
                             data-ordem="<?= (int) $posicao ?>">
                        <span class="ponto-status <?= $ponto ?>"></span>
                        <div class="icone-notificacao tipo-<?= htmlspecialchars($n['tipo']) ?>"><i class="<?= $v['icone'] ?>"></i></div>
                        <div class="texto-notificacao">
                            <h2><?= htmlspecialchars($n['titulo']) ?></h2>
                            <p><?= htmlspecialchars($n['descricao']) ?></p>
                            <time><?= htmlspecialchars($n['tempo']) ?></time>
                        </div>
                        <a class="acao-notificacao<?= $n['tipo'] === 'conquista' ? ' sucesso' : '' ?> d-inline-flex align-items-center justify-content-center text-decoration-none"
                           href="<?= htmlspecialchars($link) ?>"><?= htmlspecialchars($v['botao']) ?></a>
                    </article>
                    <?php endforeach; ?>
                </div>

                <div class="estado-vazio" id="estadoVazio" hidden>Nenhuma notificação encontrada para este filtro.</div>
            </section>
        </main>
    </div>

    <script src="../js/paginas/comuns-visualizar-notificacoes-2.js"></script>
</body>
</html>
<?php endif; ?>