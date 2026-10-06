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
require_once("../includes/dados.php");

$slug_curso = $_GET['curso'] ?? '';
$numero_get = isset($_GET['numero']) ? (int) $_GET['numero'] : null;

$modulo       = $modulos_aulas[$slug_curso] ?? null;
$itens_modulo = $modulo['itens'] ?? [];

$curso = null;
foreach ($cursos as $c) {
    if ($c['slug'] === $slug_curso) {
        $curso = $c;
        break;
    }
}

if (!$modulo || empty($itens_modulo)) {
    header('Location: visualizar-curso.php');
    exit;
}

$numero_conteudo  = 0;
$numero_exercicio = 0;
$timeline = [];
$videos   = [];

foreach ($itens_modulo as $item) {
    $tipo      = $item['tipo'] ?? 'texto';
    $titulo    = $item['titulo'] ?? '';
    $subtitulo = $item['subtitulo'] ?? '';
    $rotulo    = trim($titulo . ' ' . $subtitulo);

    if ($tipo === 'principal') {
        $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'subtitulo' => $subtitulo]);
        $timeline[] = [
            'tipo'   => 'principal',
            'rotulo' => $rotulo,
            'href'   => 'visualizar-aula.php?' . http_build_query($parametros),
            'extra'  => '',
            'icone'  => 'fa-solid fa-graduation-cap',
            'ativo'  => false,
        ];
        continue;
    }

    if ($tipo === 'exercicio') {
        $numero_exercicio++;
        $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'lista' => $numero_exercicio]);
        $timeline[] = [
            'tipo'   => 'exercicio',
            'rotulo' => $titulo !== '' ? $titulo : ('Lista de exercícios ' . $numero_exercicio),
            'href'   => 'questao.php?' . http_build_query($parametros),
            'extra'  => 'Lista',
            'icone'  => 'fa-solid fa-clipboard-list',
            'ativo'  => false,
        ];
        continue;
    }

    if ($tipo === 'video') {
        $numero_conteudo++;
        $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'numero' => $numero_conteudo]);
        $href = 'visualizar-video.php?' . http_build_query($parametros);

        $videos[] = [
            'numero'    => $numero_conteudo,
            'rotulo'    => $rotulo,
            'href'      => $href,
            'descricao' => $item['descricao'] ?? null,
            'duracao'   => $item['duracao']   ?? null,
            'imagem'    => $item['imagem']    ?? null,
            'alt'       => $item['alt']       ?? ($titulo !== '' ? $titulo : 'Aula em vídeo'),
        ];

        $timeline[] = [
            'tipo'   => 'video',
            'rotulo' => $rotulo,
            'href'   => $href,
            'extra'  => $item['duracao'] ?? '',
            'icone'  => 'fa-solid fa-play',
            'numero' => $numero_conteudo,
            'ativo'  => false,
        ];
        continue;
    }

    $numero_conteudo++;
    $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'numero' => $numero_conteudo]);
    $timeline[] = [
        'tipo'   => 'texto',
        'rotulo' => $rotulo,
        'href'   => 'visualizar-aula.php?' . http_build_query($parametros),
        'numero' => $numero_conteudo,
        'extra'  => 'Leitura',
        'icone'  => 'fa-solid fa-book-open',
        'ativo'  => false,
    ];
}

if (empty($videos)) {
    header('Location: visualizar-aulas.php?slug=' . urlencode($slug_curso));
    exit;
}

$indiceAtual = 0;
foreach ($videos as $indice => $v) {
    if ($numero_get !== null && $v['numero'] === $numero_get) {
        $indiceAtual = $indice;
        break;
    }
}
$aulaAtual = $videos[$indiceAtual];

foreach ($timeline as &$linha) {
    if ($linha['tipo'] === 'video' && $linha['numero'] === $aulaAtual['numero']) {
        $linha['ativo'] = true;
    }
}
unset($linha);

$VIDEO_PADRAO = [
    'descricao' => 'Conteúdo em produção. Em breve, a descrição completa desta aula estará disponível.',
    'duracao'   => '—',
    'imagem'    => '../imagens/fundo.png',
];
$aulaAtual['descricao'] = $aulaAtual['descricao'] ?? $VIDEO_PADRAO['descricao'];
$aulaAtual['duracao']   = $aulaAtual['duracao']   ?? $VIDEO_PADRAO['duracao'];
$aulaAtual['imagem']    = $aulaAtual['imagem']    ?? $VIDEO_PADRAO['imagem'];

$aulaAnteriorHref = $indiceAtual > 0 ? $videos[$indiceAtual - 1]['href'] : null;
$aulaProximaHref  = $indiceAtual < count($videos) - 1 ? $videos[$indiceAtual + 1]['href'] : null;

$materiais      = $modulo['materiais'] ?? [];
$categoria      = $curso['categoria'] ?? '';
$imagemFallback = '../imagens/fundo.png';
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title><?= htmlspecialchars($aulaAtual['rotulo']) ?> · Alexandria</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-video.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="pagina-video">

        <aside class="sidebar" id="listaSidebar">

            <a class="back-button-link" href="visualizar-aulas.php?slug=<?= urlencode($slug_curso) ?>">
                <div class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    <span>Voltar para as videoaulas</span>
                </div>
            </a>

                        <button type="button" class="botao-conteudos" id="botaoConteudos" aria-expanded="false" aria-controls="listaSidebar">
                <i class="bi bi-list-ul"></i>
                <span>Conteúdos</span>
                <span class="aula-atual">Lista de conteúdos</span>
                <i class="bi bi-chevron-down"></i>
            </button>

            <div class="sidebar-title">
                <span>Lista de Conteúdos</span>
            </div>

            <input type="text" class="sidebar-search" id="buscaConteudo" placeholder="Buscar conteúdo" aria-label="Buscar conteúdo">

            <ul class="lesson-list" id="listaConteudo">
                <?php foreach ($timeline as $indice => $linha): ?>
                    <li class="lesson-item<?= $linha['ativo'] ? ' active' : '' ?>">
                        <a class="lesson-item-link" href="<?= htmlspecialchars($linha['href']) ?>"<?= $linha['ativo'] ? ' aria-current="page"' : '' ?>>
                            <?php if ($linha['tipo'] === 'exercicio'): ?>
                                <span class="lesson-icone"><i class="bi bi-clipboard"></i></span>
                            <?php elseif ($linha['tipo'] === 'video'): ?>
                                <span class="lesson-number"><i class="bi bi-play-fill"></i></span>
                            <?php elseif ($linha['tipo'] === 'principal'): ?>
                                <span class="lesson-icone"><i class="bi bi-mortarboard-fill"></i></span>
                            <?php else: ?>
                                <span class="lesson-number"><?= (int) ($linha['numero'] ?? ($indice + 1)) ?></span>
                            <?php endif; ?>
                            <span class="lesson-name"><?= htmlspecialchars($linha['rotulo']) ?></span>
                            <span class="lesson-check"></span>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li class="lesson-vazio" id="semConteudo" hidden>Nenhum conteúdo encontrado.</li>
            </ul>

        </aside>

    <div class="container-principal">

        <div class="layout-aula">

            <div>
                <section class="cartao video-card" aria-label="Vídeo da aula">
                    <div class="video-preview">
                        <img class="imagem-video" id="imagemVideo" src="<?= htmlspecialchars($aulaAtual['imagem']) ?>" alt="<?= htmlspecialchars($aulaAtual['alt']) ?>">
                        <button class="botao-play" aria-label="Reproduzir aula"><i class="fas fa-play"></i></button>
                        <div class="controles-video">
                            <i class="fas fa-play icone-ctrl"></i>
                            <i class="fas fa-volume-high icone-ctrl"></i>
                            <span class="tempo-video">00:00 / <?= htmlspecialchars($aulaAtual['duracao']) ?></span>
                            <div class="progresso-video"></div>
                            <span class="caixa-velocidade">1x</span>
                            <span class="caixa-cc">CC</span>
                            <i class="fas fa-gear icone-ctrl"></i>
                            <i class="fas fa-expand icone-ctrl"></i>
                        </div>
                    </div>
                </section>

                <section class="cartao sobre-aula">
                    <div class="sobre-aula-cabecalho">
                        <span class="icone-circulo"><i class="fa-solid fa-book-open"></i></span>
                        <h2>Sobre esta aula</h2>
                    </div>
                    <p><?= htmlspecialchars($aulaAtual['descricao']) ?></p>

                    <div class="info-aula-linha">
                        <div class="info-aula-item">
                            <i class="fa-regular fa-clock"></i>
                            <span><strong><?= htmlspecialchars($aulaAtual['duracao']) ?></strong>Duração</span>
                        </div>
                        <div class="info-aula-item">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span><strong>Intermediário</strong>Nível</span>
                        </div>
                        <?php if ($categoria !== ''): ?>
                        <div class="info-aula-item">
                            <i class="fa-regular fa-bookmark"></i>
                            <span><strong><?= htmlspecialchars($categoria) ?></strong>Categoria</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </section>

                <nav class="navegacao-aula" aria-label="Navegação entre aulas">
                    <?php if ($aulaAnteriorHref): ?>
                        <a href="<?= htmlspecialchars($aulaAnteriorHref) ?>"><i class="fa-solid fa-arrow-left"></i> Aula anterior</a>
                    <?php else: ?>
                        <span class="desabilitado"><i class="fa-solid fa-arrow-left"></i> Aula anterior</span>
                    <?php endif; ?>

                    <a class="botao-central" href="visualizar-aula.php?curso=<?= urlencode($slug_curso) ?>"><i class="fa-solid fa-book-open"></i> Ler conteúdo completo</a>

                    <?php if ($aulaProximaHref): ?>
                        <a href="<?= htmlspecialchars($aulaProximaHref) ?>">Próxima aula <i class="fa-solid fa-arrow-right"></i></a>
                    <?php else: ?>
                        <span class="desabilitado">Próxima aula <i class="fa-solid fa-arrow-right"></i></span>
                    <?php endif; ?>
                </nav>
            </div>

        </div>
    </div>

        <aside class="sidebar-direita" aria-label="Materiais para download">

            <div class="sidebar-title">
                <span>Materiais para download</span>
            </div>

            <?php if (empty($materiais)): ?>
                <p class="sem-materiais">Nenhum material disponível ainda para este curso.</p>
            <?php else: foreach ($materiais as $material): ?>
                <div class="download-item">
                    <span class="icone-pdf">PDF</span>
                    <span class="info-download">
                        <span class="nome-arquivo"><?= htmlspecialchars($material['nome']) ?></span>
                        <span class="tipo-arquivo"><?= htmlspecialchars($material['tipo']) ?></span>
                    </span>
                    <button class="botao-baixar" aria-label="Baixar"><i class="fa-solid fa-download"></i></button>
                </div>
            <?php endforeach; endif; ?>

        </aside>

    </main>

    <script>
      (() => {
        const imagemVideo = document.getElementById('imagemVideo');
        const imagemFallback = <?= json_encode($imagemFallback) ?>;
        if (imagemVideo) {
          imagemVideo.addEventListener('error', () => {
            imagemVideo.onerror = null;
            imagemVideo.src = imagemFallback;
          }, { once: true });
        }

        const busca = document.getElementById('buscaConteudo');
        const itensLista = [...document.querySelectorAll('#listaConteudo .lesson-item')];
        const semConteudo = document.getElementById('semConteudo');
        busca?.addEventListener('input', () => {
          const termo = busca.value.toLocaleLowerCase('pt-BR').trim();
          let visiveis = 0;
          itensLista.forEach(item => {
            const mostrar = item.textContent.toLocaleLowerCase('pt-BR').includes(termo);
            item.hidden = !mostrar;
            if (mostrar) visiveis++;
          });
          semConteudo.hidden = visiveis > 0;
        });
      })();
    </script>


    <script src="../js/paginas/comuns-visualizar-video.js"></script>
</body>
</html>