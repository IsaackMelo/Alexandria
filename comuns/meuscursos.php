<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

if (empty($_SESSION['conta']['id'])) {
    header('Location: ../auth/login.php');
    exit;
}

if (($_SESSION['conta']['tipo'] ?? '') === 'ADM') {
    header('Location: ../comuns/visualizar-curso.php');
    exit;
}

$id_conta      = (int) $_SESSION['conta']['id'];
$nome_completo = $_SESSION['conta']['nome'] ?? 'Estudante';
$primeiro_nome = explode(' ', trim($nome_completo))[0];

$meus_cursos = cursos_iniciados_da_conta($id_conta);

$cursos_por_pagina = 6;
$total_cursos      = count($meus_cursos);
$total_paginas     = max(1, (int) ceil($total_cursos / $cursos_por_pagina));
$pagina_atual      = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT) ?: 1;
$pagina_atual      = max(1, min($pagina_atual, $total_paginas));
$cursos_da_pagina  = array_slice($meus_cursos, ($pagina_atual - 1) * $cursos_por_pagina, $cursos_por_pagina);

function link_curso(array $curso): string {
    return '../comuns/visualizar-aulas.php?slug=' . urlencode($curso['slug']);
}

function link_pagina(int $pagina): string {
    return 'meuscursos.php?pagina=' . $pagina;
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Alexandria – Meus Cursos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-meuscursos.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php include __DIR__ . '/../includes/sidebar.php'; ?>

    <div class="container-principal">

        <?php include __DIR__ . '/../includes/topbar.php'; ?>

        <div class="corpo-conteudo">
            <div>
                <div class="secao-boas-vindas">
                    <h1>Olá, <?= htmlspecialchars($primeiro_nome) ?></h1>
                    <p>Continue aprendendo e conquistando seus objetivos.</p>
                </div>

                <div class="grade-cursos">
                    <?php if (empty($cursos_da_pagina)): ?>
                        <div class="sem-cursos">
                            Você ainda não iniciou nenhum curso.
                            <a href="../comuns/visualizar-curso.php">Ver cursos disponíveis</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($cursos_da_pagina as $curso): ?>
                            <div class="cartao-curso"
                                 data-link="<?= htmlspecialchars(link_curso($curso)) ?>"
                                 data-progresso="<?= (int) $curso['progresso'] ?>">
                                <div class="container-imagem-curso">
                                    <img src="<?= htmlspecialchars($curso['imagem']) ?>" alt="<?= htmlspecialchars($curso['titulo']) ?>">
                                </div>
                                <div class="informacoes-curso">
                                    <div class="titulo-curso"><?= htmlspecialchars($curso['titulo']) ?></div>
                                    <div class="progresso-curso">
                                        <?= (int) $curso['progresso'] ?>% concluído
                                        <div class="barra-progresso" aria-hidden="true">
                                            <span style="width: <?= (int) $curso['progresso'] ?>%;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <nav class="container-paginacao" aria-label="Paginação">
                <a href="<?= link_pagina($pagina_atual - 1) ?>" class="botao-pagina<?= $pagina_atual <= 1 ? ' desabilitado' : '' ?>" aria-label="Página anterior"><i class="fas fa-chevron-left"></i></a>
                <?php for ($p = 1; $p <= $total_paginas; $p++): ?>
                    <a href="<?= link_pagina($p) ?>" class="botao-pagina<?= $p === $pagina_atual ? ' active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
                <a href="<?= link_pagina($pagina_atual + 1) ?>" class="botao-pagina<?= $pagina_atual >= $total_paginas ? ' desabilitado' : '' ?>" aria-label="Próxima página"><i class="fas fa-chevron-right"></i></a>
            </nav>
        </div>
    </div>

    <div class="modal-validacao" id="modalValidacao" role="dialog" aria-modal="true" aria-labelledby="tituloValidacao" aria-hidden="true">
        <div class="cartao-validacao" role="document">
            <div class="icone-validacao" aria-hidden="true">
            <i class="fa-solid fa-book-open"></i>
            </div>
            <h2 id="tituloValidacao">Quer continuar esse curso?</h2>
            <p id="textoValidacao">Você está prestes a continuar o curso</p>
            <p class="curso-selecionado" id="cursoSelecionado"></p>
            <div class="acoes-validacao">
                <button type="button" class="botao-validacao botao-cancelar" id="botaoCancelar">Cancelar</button>
                <button type="button" class="botao-validacao botao-iniciar" id="botaoIniciar">Continuar curso</button>
            </div>
        </div>
    </div>

    <script src="../js/paginas/comuns-meuscursos.js"></script>
</body>
</html>