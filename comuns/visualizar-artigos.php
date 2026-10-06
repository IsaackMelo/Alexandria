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

$id_artigo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$artigo_atual = null;
if ($id_artigo !== null && $id_artigo !== false && isset($artigos[$id_artigo])) {
    $artigo_atual = $artigos[$id_artigo];
}

$total_artigos = count($artigos);

$categorias_artigos = array_values(array_unique(array_map(
    fn($artigo) => $artigo['categoria'],
    $artigos
)));
sort($categorias_artigos);

$pasta_imagens_artigos = '../imagens/';

function icone_ui(string $nome): string {
    $tracados = [
        'arrow-left' => '<path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>',
        'plus'       => '<path d="M5 12h14"/><path d="M12 5v14"/>',
        'search'     => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'image'      => '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>',
        'clock'      => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
        'calendar'   => '<rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/>',
        'user'       => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'pencil'     => '<path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>',
        'trash'      => '<path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>',
    ];

    $tracado = $tracados[$nome] ?? '';

    return '<svg class="icone-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
        . 'stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
        . $tracado . '</svg>';
}
?>
<?php if ($isAdm): ?>
<?php ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artigos</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-artigos-adm.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php
    include __DIR__ . '/../includes/topbar.php';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

<div class="page-wrap">

  <a href="#" class="voltar-link" onclick="window.history.back(); return false;">
    <?= icone_ui('arrow-left') ?> Voltar
  </a>

  <header class="cabecalho-pagina">

    <div class="cabecalho-topo">
      <div>
        <h1 class="titulo-pagina">Artigos</h1>
        <p class="subtitulo-pagina">Os artigos abaixo são os mesmos disponíveis para os usuários.</p>
      </div>

      <a href="../adm/adicionar-artigo.php" class="btn-novo-artigo">
        <?= icone_ui('plus') ?> Novo Artigo
      </a>
    </div>

    <hr class="linha-cabecalho">

    <div class="barra-filtros">

      <span class="contador-artigos">
        <?= $total_artigos ?> artigo<?= $total_artigos === 1 ? '' : 's' ?> cadastrado<?= $total_artigos === 1 ? '' : 's' ?>
      </span>

      <div class="filtros-direita">

        <div class="campo-busca">
          <?= icone_ui('search') ?>
          <input type="text" id="campoBusca" placeholder="Buscar por título ou categoria...">
        </div>

        <select id="filtroCategoria" class="filtro-categoria">
          <option value="">Todas as categorias</option>
          <?php foreach ($categorias_artigos as $categoria): ?>
            <option value="<?= htmlspecialchars(mb_strtolower($categoria)) ?>"><?= htmlspecialchars($categoria) ?></option>
          <?php endforeach; ?>
        </select>

      </div>

    </div>

  </header>

  <div class="lista-artigos" id="listaArtigos">
    <?php foreach ($artigos as $indice => $artigo):
        $nome_arquivo_imagem = $artigo['imagem'] ?? '';
        $imagem_web          = $nome_arquivo_imagem !== '' ? $pasta_imagens_artigos . $nome_arquivo_imagem : '';
        $imagem_existe       = $imagem_web !== '' && file_exists(__DIR__ . '/' . $imagem_web);
    ?>
    <div class="artigo-card" data-titulo="<?= htmlspecialchars(mb_strtolower($artigo['titulo'])) ?>" data-categoria="<?= htmlspecialchars(mb_strtolower($artigo['categoria'])) ?>">
      <div class="artigo-imagem">
        <?php if ($imagem_existe): ?>
          <img src="<?= htmlspecialchars($imagem_web) ?>" alt="<?= htmlspecialchars($artigo['titulo']) ?>">
        <?php else: ?>
          <?= icone_ui('image') ?>
        <?php endif; ?>
      </div>

      <div class="artigo-corpo">
        <div class="artigo-categoria"><span class="ponto-categoria"></span> <?= htmlspecialchars(mb_strtoupper($artigo['categoria'])) ?></div>
        <h3 class="artigo-titulo">
          <a class="link-titulo-artigo" href="visualizar-artigo.php?id=<?= $indice ?>">
            <?= htmlspecialchars($artigo['titulo']) ?>
          </a>
        </h3>
        <p class="artigo-resumo"><?= htmlspecialchars($artigo['resumo']) ?></p>
        <div class="artigo-meta">
          <span><?= icone_ui('clock') ?> <?= htmlspecialchars($artigo['tempo_leitura']) ?></span>
          <span><?= icone_ui('calendar') ?> <?= htmlspecialchars($artigo['data']) ?></span>
          <span><?= icone_ui('user') ?> <?= htmlspecialchars($artigo['autor']) ?></span>
        </div>
      </div>

      <div class="artigo-acoes">
        <a class="btn-editar-item" href="../adm/editar-artigo.php?id=<?= $indice ?>">
          <?= icone_ui('pencil') ?> Editar
        </a>
        <button type="button" class="btn-remover-item" title="Remover" onclick="removerArtigo(this)">
          <?= icone_ui('trash') ?>
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
<script src="../js/paginas/comuns-visualizar-artigos.js"></script>

</body>
</html>
<?php else: ?>
<?php ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Artigos - Alexandria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-artigos-user.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php
        include __DIR__ . '/../includes/sidebar.php';
    ?>
    <?php include __DIR__ . '/../includes/topbar.php';?>

    <section class="banner-artigos-topo">
        
        <div class="banner-conteudo">
            <h1>Artigos</h1>
            <p>Quer ter acesso a artigos exclusivos? Se inscreva na nossa plataforma.</p>
            <div class="hero-btns">
                <a href="../web/plano.php" class="btn-hero-primary">Garantir minha vaga</a>
                <a href="../web/missao.php" class="btn-hero-secondary">Conhecer a Missão</a>
            </div>
        </div>
    </section>

    <main class="container-blog-index">
        
        <div class="lista-artigos" id="listaArtigos">
    <?php foreach ($artigos as $indice => $artigo):
        $nome_arquivo_imagem = $artigo['imagem'] ?? '';
        $imagem_web          = $nome_arquivo_imagem !== '' ? $pasta_imagens_artigos . $nome_arquivo_imagem : '';
        $imagem_existe       = $imagem_web !== '' && file_exists(__DIR__ . '/' . $imagem_web);
    ?>
    <div class="artigo-card" data-titulo="<?= htmlspecialchars(mb_strtolower($artigo['titulo'])) ?>" data-categoria="<?= htmlspecialchars(mb_strtolower($artigo['categoria'])) ?>">
      <div class="artigo-imagem">
        <?php if ($imagem_existe): ?>
          <img src="<?= htmlspecialchars($imagem_web) ?>" alt="<?= htmlspecialchars($artigo['titulo']) ?>">
        <?php else: ?>
          <?= icone_ui('image') ?>
        <?php endif; ?>
      </div>

      <div class="artigo-corpo">
        <div class="artigo-categoria"><span class="ponto-categoria"></span> <?= htmlspecialchars(mb_strtoupper($artigo['categoria'])) ?></div>
        <h3 class="artigo-titulo">
          <a class="link-titulo-artigo" href="visualizar-artigo.php?id=<?= $indice ?>">
            <?= htmlspecialchars($artigo['titulo']) ?>
          </a>
        </h3>
        <p class="artigo-resumo"><?= htmlspecialchars($artigo['resumo']) ?></p>
        <div class="artigo-meta">
          <span><?= icone_ui('clock') ?> <?= htmlspecialchars($artigo['tempo_leitura']) ?></span>
          <span><?= icone_ui('calendar') ?> <?= htmlspecialchars($artigo['data']) ?></span>
          <span><?= icone_ui('user') ?> <?= htmlspecialchars($artigo['autor']) ?></span>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <aside class="sidebar">
            <input type="text" class="input-busca" placeholder="Buscar artigos...">

            <div class="widget">
                <h3 class="widget-titulo">Mais Lidos</h3>
                <ul class="lista-mais-lidos">
                    <?php foreach ($artigos as $indice_lista => $item_lista): ?>
                        <li class="item-mais-lido">
                            <span class="badge-numero<?= $indice_lista === $id_artigo ? '2' : '' ?>"><?= str_pad((string) ($indice_lista + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            <?php if ($indice_lista === $id_artigo): ?>
                                <?= htmlspecialchars($item_lista['titulo']) ?>
                            <?php else: ?>
                                <a href="visualizar-artigo.php?id=<?= $indice_lista ?>"><?= htmlspecialchars($item_lista['titulo']) ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>
<?php endif; ?>
