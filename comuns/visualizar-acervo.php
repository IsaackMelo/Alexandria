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

$link_adicionar_acervo = '../adm/adicionar-acervo.php';
$link_editar_acervo    = '../adm/editar-acervo.php';
$link_excluir_acervo   = 'visualizar-acervo.php';

function linkVisualizarProvaAdm(string $linkOriginal): string
{
    return preg_replace('/^acervo\.php/', 'visualizar-prova.php', $linkOriginal);
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>ADM - Acervos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-acervo.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php
    include __DIR__ . '/../includes/topbar.php'; 
    include __DIR__ . '/../includes/sidebar.php'; 
    ?>

    <div class="container-principal">

        <div class="conteudo-acervos">

            <header class="cabecalho-acervos">

                <div class="cabecalho-acervos-topo">
                    <div>
                        <?php if ($isAdm): ?>
                        <h1 class="titulo-acervos">Gerenciamento de acervos</h1>
                        <p class="subtitulo-acervos">Explore e gerencie os acervos disponíveis para estudo e simulados.</p>
                        <?php else: ?>
                        <h1 class="titulo-acervos">Acervos disponíveis</h1>
                        <p class="subtitulo-acervos">Explore os acervos disponíveis para estudo e simulados.</p>
                        <?php endif; ?>
                    </div>

                    <?php if ($isAdm): ?>
                    <a href="<?= htmlspecialchars($link_adicionar_acervo) ?>" class="btn-novo-acervo">
                        <i class="fas fa-plus"></i> Novo acervo
                    </a>
                    <?php endif; ?>
                </div>

                <hr class="linha-cabecalho-acervos">

                <div class="barra-info-acervos">
                    <span class="contador-acervos"><?= count($acervos) ?> acervo<?= count($acervos) === 1 ? '' : 's' ?> disponíve<?= count($acervos) === 1 ? 'l' : 'is' ?></span>

                    <div class="busca-acervos">
                        <i class="bi bi-search"></i>
                        <input type="text" id="buscaAcervoInput" placeholder="Buscar por banca, faculdade ou palavra-chave...">
                    </div>
                </div>

            </header>

            <div class="row g-4" id="gridAcervos">

                <?php foreach ($acervos as $acervo): ?>
                    <?php $link_visualizar_prova = linkVisualizarProvaAdm($acervo['link']); ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 item-acervo" data-nome="<?= htmlspecialchars(mb_strtolower($acervo['nome'] . ' ' . ($acervo['nome_completo'] ?? '') . ' ' . ($acervo['descricao'] ?? ''))) ?>">
                        <div class="card-acervo" onclick="window.location.href='<?= htmlspecialchars($link_visualizar_prova) ?>'">

                            <div class="logo-acervo">
                                <img src="<?= htmlspecialchars($acervo['logo']) ?>" alt="Logo <?= htmlspecialchars($acervo['nome']) ?>">
                            </div>
                            <div class="corpo-acervo">
                                <h5><?= htmlspecialchars($acervo['nome']) ?></h5>
                                <p><?= htmlspecialchars($acervo['descricao']) ?></p>
                                <div class="meta-acervo" style="display:flex; flex-wrap:wrap; gap:6px; margin:4px 0 8px; font-size:11px;">
                                    <span style="padding:2px 8px; border-radius:999px; background:#f5efe6; border:1px solid #eadfce;"><?= htmlspecialchars($tipos_acervo[$acervo['tipo'] ?? ''] ?? 'Acervo') ?></span>
                                    <span style="padding:2px 8px; border-radius:999px; background:#f5efe6; border:1px solid #eadfce;"><?= (int) ($acervo['total_provas'] ?? 0) ?> prova(s) · <?= (int) ($acervo['total_perguntas'] ?? 0) ?> questões</span>
                                </div>

                                <?php if ($isAdm): ?>
                                <div class="acoes-acervo">
                                    <a class="acao acao-editar"
                                       href="<?= htmlspecialchars($link_editar_acervo) ?>?id=<?= (int) $acervo['id'] ?>"
                                       onclick="event.stopPropagation();">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a class="acao acao-visualizar"
                                       href="<?= htmlspecialchars($link_visualizar_prova) ?>"
                                       title="Visualizar"
                                       onclick="event.stopPropagation();">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="acao acao-excluir"
                                            type="button"
                                            title="Excluir"
                                            onclick="event.stopPropagation(); confirmarExclusao(<?= (int) $acervo['id'] ?>, '<?= htmlspecialchars(addslashes($acervo['nome'])) ?>');">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>

    </div>

    <div class="modal fade" id="modalExcluirAcervo" tabindex="-1" aria-labelledby="modalExcluirAcervoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirAcervoLabel">Excluir acervo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir o acervo <strong id="nomeAcervoExcluir"></strong>? Essa ação não poderá ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="linkConfirmarExclusao" class="btn" style="background: var(--vinho-alexandria); color: var(--branco);">Sim, excluir</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-atA0O1qEqiJDsBxdI0AGZgLcAujG6SC0zj/BZgY9M9NRhvpAf6yZmaAJk8bK9EIF" crossorigin="anonymous"></script>
    <script>
        document.getElementById('buscaAcervoInput').addEventListener('input', function (e) {
            const termo = e.target.value.trim().toLowerCase();
            document.querySelectorAll('.item-acervo').forEach(function (item) {
                const nome = item.getAttribute('data-nome');
                item.style.display = nome.includes(termo) ? '' : 'none';
            });
        });

        const linkExcluirBase = <?= json_encode($link_excluir_acervo) ?>;
        const modalExcluirAcervo = new bootstrap.Modal(document.getElementById('modalExcluirAcervo'));

        function confirmarExclusao(id, nome) {
            document.getElementById('nomeAcervoExcluir').textContent = nome;
            document.getElementById('linkConfirmarExclusao').setAttribute('href', linkExcluirBase + '?id=' + encodeURIComponent(id));
            modalExcluirAcervo.show();
        }
    </script>

</body>
</html>