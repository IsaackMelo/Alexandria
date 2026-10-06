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

$slug_curso    = $_GET['curso']     ?? '';
$titulo_url    = $_GET['titulo']    ?? '';
$subtitulo_url = $_GET['subtitulo'] ?? '';
$numero_url    = (isset($_GET['numero']) && $_GET['numero'] !== '') ? (int) $_GET['numero'] : null;

$modulo = $modulos_aulas[$slug_curso] ?? null;

$dados_timeline  = $modulo ? montar_timeline_modulo($modulo, $slug_curso) : ['timeline' => [], 'itens_numerados' => []];
$timeline        = $dados_timeline['timeline'];
$itens_numerados = $dados_timeline['itens_numerados'];

$item_atual = $numero_url !== null ? ($itens_numerados[$numero_url] ?? null) : null;

$resumo_aula = '';
$secoes_aula = [];

if ($item_atual !== null) {
    $resumo_aula = $item_atual['resumo'] ?? '';
    $secoes_aula = $item_atual['secoes'] ?? [];
} elseif ($numero_url === null && $modulo !== null) {
    $resumo_aula = $modulo['descricao'] ?? '';
}

$titulo_aula    = $item_atual['titulo']    ?? $titulo_url;
$subtitulo_aula = $item_atual['subtitulo'] ?? $subtitulo_url;
$materiais_aula = $modulo['materiais']     ?? [];

$rotulo_aula = trim(
    ($numero_url !== null ? $numero_url . '. ' : '') . $titulo_aula
    . ($subtitulo_aula !== '' ? ' ' . $subtitulo_aula : '')
);

$curso_info = null;
foreach ($cursos as $curso_disponivel) {
    if (($curso_disponivel['slug'] ?? '') === $slug_curso) {
        $curso_info = $curso_disponivel;
        break;
    }
}
$titulo_curso    = $curso_info['titulo']    ?? ($timeline[0]['rotulo'] ?? 'Curso');
$categoria_curso = $curso_info['categoria'] ?? '';

$indice_atual = null;
foreach ($timeline as $indice => $entrada) {
    $eh_item_atual = $numero_url !== null
        ? (($entrada['tipo'] ?? '') === 'texto' && ($entrada['numero'] ?? null) === $numero_url)
        : (($entrada['tipo'] ?? '') === 'principal' && ($entrada['rotulo'] ?? '') === trim($titulo_url . ' ' . $subtitulo_url));

    if ($eh_item_atual) {
        $indice_atual = $indice;
        break;
    }
}
$proxima_entrada = ($indice_atual !== null && isset($timeline[$indice_atual + 1]))
    ? $timeline[$indice_atual + 1]
    : null;

$link_voltar = 'visualizar-aulas.php?' . http_build_query(array_filter([
    'slug'      => $slug_curso,
    'titulo'    => $titulo_curso,
    'categoria' => $categoria_curso,
]));
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($titulo_aula !== '' ? $titulo_aula : 'Aula') ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-aula.css">

<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <?php
        include __DIR__ . '/../includes/header.php';
    ?>

    <main class="page">

        <aside class="sidebar" id="listaSidebar">

            <a class="back-button-link" href="<?= htmlspecialchars($link_voltar) ?>">
                <div class="back-button">

                    <i class="bi bi-arrow-left"></i>

                    <span>
                        Voltar para as videoaulas
                    </span>

                </div>
            </a>

                        <button type="button" class="botao-conteudos" id="botaoConteudos" aria-expanded="false" aria-controls="listaSidebar">
                <i class="bi bi-list-ul"></i>
                <span>Conteúdos</span>
                <span class="aula-atual">Lista de conteúdos</span>
                <i class="bi bi-chevron-down"></i>
            </button>

            <div class="sidebar-title">

                <span>
                    Lista de Conteúdos
                </span>

            </div>

            <input
                type="text"
                class="sidebar-search"
                placeholder="Buscar conteúdo">

            <ul class="lesson-list">

                <?php if (empty($timeline)): ?>

                    <li style="padding: 10px 7px; font-size: 12px; color: #777;">
                        Ainda não há aulas cadastradas para este curso.
                    </li>

                <?php else: ?>

                    <?php foreach ($timeline as $indice => $entrada): ?>
                        <li class="lesson-item<?= $indice === $indice_atual ? ' active' : '' ?>">
                            <a class="lesson-item-link" href="<?= htmlspecialchars($entrada['href']) ?>">

                                <?php if ($entrada['tipo'] === 'exercicio'): ?>
                                    <span style="width:24px; display:flex; align-items:center; justify-content:center; margin-right:9px;">
                                        <i class="bi bi-clipboard"></i>
                                    </span>
                                <?php elseif ($entrada['tipo'] === 'video'): ?>
                                    <span class="lesson-number">
                                        <i class="bi bi-play-fill" style="font-size:11px;"></i>
                                    </span>
                                <?php elseif ($entrada['tipo'] === 'principal'): ?>
                                    <span style="width:24px; display:flex; align-items:center; justify-content:center; margin-right:9px;">
                                        <i class="bi bi-mortarboard-fill"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="lesson-number"><?= $entrada['numero'] ?? ($indice + 1) ?></span>
                                <?php endif; ?>

                                <span class="lesson-name"><?= htmlspecialchars($entrada['rotulo']) ?></span>

                                <span class="lesson-check"></span>

                            </a>
                        </li>
                    <?php endforeach; ?>

                <?php endif; ?>

            </ul>

        </aside>

        <section class="content">

            <div class="breadcrumb-area">

                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">

                        <?php if ($categoria_curso !== ''): ?>
                            <li class="breadcrumb-item">
                                <?= htmlspecialchars($categoria_curso) ?>
                            </li>
                        <?php endif; ?>

                        <li class="breadcrumb-item">
                            <?= htmlspecialchars($titulo_curso) ?>
                        </li>

                        <li class="breadcrumb-item active">
                            <?= htmlspecialchars($rotulo_aula !== '' ? $rotulo_aula : 'Aula') ?>
                        </li>

                    </ol>

                </nav>

                <?php if ($proxima_entrada): ?>
                    <a class="next-button" href="<?= htmlspecialchars($proxima_entrada['href']) ?>">

                        Próximo

                        <i class="bi bi-chevron-right"></i>

                    </a>
                <?php endif; ?>

            </div>

            <h1>
                <?= htmlspecialchars($rotulo_aula !== '' ? $rotulo_aula : 'Aula') ?>
            </h1>

            <?php if ($resumo_aula !== ''): ?>
                <p>
                    <?= htmlspecialchars($resumo_aula) ?>
                </p>
            <?php elseif (empty($secoes_aula)): ?>
                <p>
                    Não foi possível encontrar o conteúdo desta aula.
                    Volte para a <a href="<?= htmlspecialchars($link_voltar) ?>">lista de aulas</a> e tente novamente.
                </p>
            <?php endif; ?>

            <?php foreach ($secoes_aula as $secao): ?>

                <hr class="section-divider">

                <h2>
                    <?= htmlspecialchars($secao['titulo'] ?? '') ?>
                </h2>

                <p>
                    <?= implode('<br><br>', array_map('htmlspecialchars', $secao['paragrafos'] ?? [])) ?>
                </p>

            <?php endforeach; ?>

            <?php if (!empty($materiais_aula)): ?>
                <div class="materiais">

                    <div class="materiais-titulo">
                        <span>Materiais para download</span>
                    </div>

                    <?php foreach ($materiais_aula as $material):
                        $tipo_material = $material['tipo'] ?? '';

                        $icone_material = 'bi-file-earmark';
                        if (stripos($tipo_material, 'pdf') !== false) {
                            $icone_material = 'bi-file-earmark-pdf';
                        } elseif (stripos($tipo_material, 'word') !== false) {
                            $icone_material = 'bi-file-earmark-word';
                        } elseif (stripos($tipo_material, 'excel') !== false || stripos($tipo_material, 'planilha') !== false) {
                            $icone_material = 'bi-file-earmark-excel';
                        }
                    ?>
                        <div class="material-item">

                            <div class="material-icon">
                                <i class="bi <?= $icone_material ?>"></i>
                            </div>

                            <div class="material-info">
                                <div class="material-name"><?= htmlspecialchars($material['nome'] ?? '') ?></div>
                                <div class="material-size"><?= htmlspecialchars($tipo_material) ?></div>
                            </div>

                            <a
                                href="<?= htmlspecialchars($material['arquivo'] ?? '#') ?>"
                                class="material-download-button"
                                title="Baixar material"
                                aria-label="Baixar material">
                                <i class="bi bi-download"></i>
                            </a>

                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

        </section>

    </main>


    <script src="../js/paginas/comuns-visualizar-aula.js"></script>
</body>

</html>