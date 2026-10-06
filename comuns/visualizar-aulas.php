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

$slug_curso = $_GET['slug'] ?? ($_GET['curso'] ?? '');

$curso_atual = null;
foreach ($cursos as $item_curso) {
    if ($item_curso['slug'] === $slug_curso) {
        $curso_atual = $item_curso;
        break;
    }
}
$titulo_curso    = $curso_atual['titulo']    ?? ($_GET['titulo'] ?? 'Curso');
$categoria_curso = $curso_atual['categoria'] ?? ($_GET['categoria'] ?? '');

$modulo          = $modulos_aulas[$slug_curso] ?? null;
$descricao_modulo = $modulo['descricao'] ?? 'Confira o conteúdo deste módulo e continue seus estudos.';
$itens_modulo     = $modulo['itens'] ?? [];

$rotulo_curso = $categoria_curso !== '' ? 'Curso de ' . $categoria_curso : 'Curso Preparatório para vestibular';

$detalhes_curso = array_filter([
    isset($curso_atual['nivel']) ? ($niveis_curso[$curso_atual['nivel']] ?? $curso_atual['nivel']) : '',
    $curso_atual['carga_horaria'] ?? '',
    !empty($curso_atual['professor']) ? 'Prof. ' . $curso_atual['professor'] : '',
    isset($curso_atual['total_aulas']) ? $curso_atual['total_aulas'] . ' aulas' : '',
    isset($curso_atual['total_listas']) ? $curso_atual['total_listas'] . ' listas de exercícios' : '',
    isset($curso_atual['alunos']) ? $curso_atual['alunos'] . ' alunos' : '',
]);
?>

<html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($titulo_curso) ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-aulas.css">

<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <?php
        include __DIR__ . '/../includes/header.php';
    ?>

    <header class="hero">

        <div class="curso">

            <div class="curso-indicador"></div>

            <span>
                <?= htmlspecialchars($rotulo_curso) ?>
            </span>

        </div>

        <h1>
            <?= htmlspecialchars($titulo_curso) ?>
        </h1>

    </header>

    <main class="conteudo">

        <section class="detalhes">

            <div class="detalhes-titulo">
                Detalhes
            </div>

            <h2>
                O que você aprenderá nesse módulo:
            </h2>

            <p>
                <?= htmlspecialchars($descricao_modulo) ?>
            </p>

            <?php if ($detalhes_curso): ?>
            <p style="font-size: 14px; opacity: .85;">
                <?= htmlspecialchars(implode(' · ', $detalhes_curso)) ?>
            </p>
            <?php endif; ?>

            <?php if (!empty($curso_atual['tags'])): ?>
            <div style="display:flex; flex-wrap:wrap; gap:6px;">
                <?php foreach ($curso_atual['tags'] as $tag_curso): ?>
                <span style="padding:3px 10px; border-radius:999px; background:#f5efe6; border:1px solid #eadfce; font-size:12px;">#<?= htmlspecialchars($tag_curso) ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </section>

        <section class="modulo">

            <div class="modulo-cabecalho">

                <div class="modulo-indicador"></div>

                <h2 class="modulo-titulo">
                    Módulo
                </h2>

            </div>

            <div class="timeline">

                <?php if (empty($itens_modulo)): ?>

                    <p class="sem-aulas">Ainda não há aulas cadastradas para este curso.</p>

                <?php else: ?>

                    <?php
                    $numero_conteudo  = 0;
                    $numero_exercicio = 0;

                    foreach ($itens_modulo as $item):
                        $tipo     = $item['tipo'] ?? 'texto';
                        $titulo   = $item['titulo'] ?? '';
                        $subtitulo = $item['subtitulo'] ?? '';
                    ?>

                        <?php if ($tipo === 'principal'):

                            $parametros_principal = array_filter([
                                'curso'     => $slug_curso,
                                'titulo'    => $titulo,
                                'subtitulo' => $subtitulo,
                            ]);
                        ?>

                            <div class="linha-opcao">
                                <a class="aula principal" href="visualizar-aula.php?<?= htmlspecialchars(http_build_query($parametros_principal)) ?>">
                                    <h3>
                                        <?= htmlspecialchars($titulo) ?>
                                        <?php if ($subtitulo !== ''): ?>
                                            <span><?= htmlspecialchars($subtitulo) ?></span>
                                        <?php endif; ?>
                                    </h3>
                                </a>
                            </div>

                        <?php elseif ($tipo === 'exercicio'):
                            $numero_exercicio++;

                            $parametros_exercicio = array_filter([
                                'curso'  => $slug_curso,
                                'titulo' => $titulo,
                                'lista'  => $numero_exercicio,
                            ]);
                            $link_exercicio = 'questao.php?' . http_build_query($parametros_exercicio);
                        ?>

                            <div class="linha-opcao">
                                <a class="aula exercicios" href="<?= htmlspecialchars($link_exercicio) ?>">

                                    <span>
                                        <?= htmlspecialchars($titulo !== '' ? $titulo : ('Lista de exercícios ' . $numero_exercicio)) ?>
                                        <?php if (!empty($item['descricao']) || !empty($item['questoes'])): ?>
                                        <small class="aula-descricao">
                                            <?= htmlspecialchars(trim(($item['descricao'] ?? '') . ' ' . count($item['questoes'] ?? []) . ' questão(ões).')) ?>
                                        </small>
                                        <?php endif; ?>
                                    </span>

                                    <i class="bi bi-clipboard icone-exercicio" aria-hidden="true"></i>

                                </a>
                            </div>

                        <?php elseif ($tipo === 'video'):
                            $numero_conteudo++;

                            $parametros_video = array_filter([
                                'curso'     => $slug_curso,
                                'titulo'    => $titulo,
                                'subtitulo' => $subtitulo,
                                'numero'    => $numero_conteudo,
                            ]);
                            $link_video = 'visualizar-video.php?' . http_build_query($parametros_video);
                        ?>

                            <div class="linha-opcao">
                                <a class="aula aula-video-item" href="<?= htmlspecialchars($link_video) ?>">

                                    <span>
                                        <?= htmlspecialchars($titulo !== '' ? $titulo : ('Aula ' . $numero_conteudo)) ?>
                                        <?php if ($subtitulo !== ''): ?>
                                            <?= htmlspecialchars($subtitulo) ?>
                                        <?php endif; ?>
                                    </span>

                                    <span class="btn-play" aria-hidden="true">
                                        <i class="bi bi-play-fill"></i>
                                    </span>

                                </a>
                            </div>

                        <?php else:
                            $numero_conteudo++;

                            $parametros_texto = array_filter([
                                'curso'     => $slug_curso,
                                'titulo'    => $titulo,
                                'subtitulo' => $subtitulo,
                                'numero'    => $numero_conteudo,
                            ]);
                            $link_texto = 'visualizar-aula.php?' . http_build_query($parametros_texto);
                        ?>

                            <div class="linha-opcao">
                                <a class="aula aula-texto-item" href="<?= htmlspecialchars($link_texto) ?>">

                                    <span>
                                        <?= htmlspecialchars($titulo !== '' ? $titulo : ('Aula ' . $numero_conteudo)) ?>
                                        <?php if ($subtitulo !== ''): ?>
                                            <?= htmlspecialchars($subtitulo) ?>
                                        <?php endif; ?>
                                    </span>

                                </a>
                            </div>

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </section>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>