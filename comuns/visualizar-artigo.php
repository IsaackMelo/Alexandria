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

$pasta_imagens_artigos = '../imagens/';

$valor_titulo_artigo    = $artigo_atual['titulo'] ?? 'Artigo não encontrado';
$valor_categoria_artigo = $artigo_atual['categoria'] ?? '';
$valor_tempo_leitura    = $artigo_atual['tempo_leitura'] ?? '';
$valor_data_artigo      = $artigo_atual['data'] ?? '';
$valor_autor_artigo     = $artigo_atual['autor'] ?? '';
$valor_resumo_artigo    = $artigo_atual['resumo'] ?? '';
$conteudo_artigo_html   = html_artigo_seguro($artigo_atual['conteudo'] ?? '');

$nome_arquivo_imagem_artigo = $artigo_atual['imagem'] ?? '';
$imagem_artigo_web    = $nome_arquivo_imagem_artigo !== '' ? $pasta_imagens_artigos . $nome_arquivo_imagem_artigo : '';
$imagem_artigo_existe = $imagem_artigo_web !== '' && file_exists(__DIR__ . '/' . $imagem_artigo_web);

        include __DIR__ . '/../includes/topbar.php';
        include __DIR__ . '/../includes/sidebar.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title><?= htmlspecialchars($valor_titulo_artigo) ?> - Alexandria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-artigo.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <section class="banner-artigo">
        <div class="banner-conteudo">
            <h1>Artigos</h1>
            <p>Quer ter acesso a artigos exclusivos? Se inscreva na nossa plataforma.</p>
            <div class="hero-btns">
                <a href="../web/plano.php" class="btn-hero-primary">Garantir minha vaga</a>
                <a href="../web/missao.php" class="btn-hero-secondary">Conhecer a Missão</a>
            </div>
        </div>
    </section>

    <main class="container-blog">
        
        <article class="conteudo-post">
            <?php if ($artigo_atual === null): ?>
                <div class="alert alert-warning" role="alert">
                    Artigo não encontrado.
                </div>
            <?php else: ?>
                <?php if ($imagem_artigo_existe): ?>
                    <img src="<?= htmlspecialchars($imagem_artigo_web) ?>" alt="<?= htmlspecialchars($valor_titulo_artigo) ?>" class="post-imagem-principal">
                    <br>
                <?php endif; ?>
                <div class="post-categoria">
                    <i class="fa-solid fa-square"></i> <?= htmlspecialchars($valor_categoria_artigo) ?>
                </div>

                <div class="post-meta">
                    <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> <?= htmlspecialchars($valor_tempo_leitura) ?></span>
                    <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> <?= htmlspecialchars($valor_data_artigo) ?></span>
                    <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> <?= htmlspecialchars($valor_autor_artigo) ?></span>
                </div>

                <h1 class="post-titulo"><?= htmlspecialchars($valor_titulo_artigo) ?></h1>

                <div class="post-texto">
                    <?php if ($conteudo_artigo_html !== ''): ?>
                        <?= $conteudo_artigo_html ?>
                    <?php else: ?>
                        <p><?= htmlspecialchars($valor_resumo_artigo) ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($artigo_atual['tags'])): ?>
                <div class="tags-artigo" style="display:flex; flex-wrap:wrap; gap:8px; margin-top:24px;">
                    <?php foreach ($artigo_atual['tags'] as $tag_artigo): ?>
                    <span style="padding:4px 12px; border-radius:999px; background:#f5efe6; border:1px solid #eadfce; font-size:12px; color:#4a4a4a;">#<?= htmlspecialchars($tag_artigo) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </article>

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