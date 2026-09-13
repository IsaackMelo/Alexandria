<?php
/**
 * visualizar-acervo.php
 * Exibe os acervos já cadastrados e permite adicionar um novo acervo.
 *
 * Observação: a "barraadm.html" enviada como referência já vem com toda a
 * estrutura de <html><head><body>...</body></html>, então nesta página o
 * <head>/topo foram reconstruídos aqui dentro (mesmas variáveis de cor,
 * fontes e classes) para permitir inserir o conteúdo de acervos entre a
 * barra superior e o rodapé. A sidebar continua sendo incluída via PHP
 * a partir do arquivo original.
 */

// Dados dos acervos: centralizados em dados.php
require_once __DIR__ . '/dados.php';

// Páginas de destino (ajuste os nomes/rotas conforme seu projeto real)
$link_adicionar_acervo = 'adicionar-acervo.php';
$link_editar_acervo    = 'editar-acervo.php';   // recebe ?id=
$link_excluir_acervo   = 'excluir-acervo.php';  // recebe ?id=
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>ADM - Acervos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria:   #8b1e2d;
            --vinho-escuro:       #6f1723;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --branco:             #ffffff;
            --cinza-medio:        #e8dfd7;
            --cinza-claro:        #f7f3ee;
            --texto-escuro:       #333333;
            --texto-suave:        #6b6b6b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cinza-claro);
        }

        /* ===== Barra superior (mesmo padrão de barraadm.html) ===== */
        .barra-superior {
            background: var(--branco);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--cinza-medio);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .titulo-barra-superior {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--texto-escuro);
        }

        .direita-barra-superior {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .distintivo-funcao {
            background: var(--vinho-alexandria);
            color: var(--branco);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .distintivo-funcao i { font-size: 10px; }

        .nome-usuario {
            font-size: 14px;
            font-weight: 500;
            color: var(--texto-escuro);
        }

        .avatar-usuario {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--dourado-alexandria);
        }

        .container-principal {
            margin-left: 156px;
            width: calc(100% - 156px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Conteúdo da página de acervos ===== */
        .conteudo-acervos {
            padding: 30px 30px 50px 30px;
        }

        .cabecalho-acervos {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .cabecalho-acervos p {
            color: var(--texto-suave);
            font-size: 14px;
        }

        .contador-acervos {
            background: var(--branco);
            border: 1px solid var(--cinza-medio);
            color: var(--texto-suave);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .busca-acervos {
            position: relative;
            max-width: 480px;
            margin-bottom: 25px;
        }

        .busca-acervos input {
            width: 100%;
            padding: 10px 16px 10px 38px;
            border-radius: 8px;
            border: 1px solid var(--cinza-medio);
            background: var(--branco);
            font-size: 14px;
        }

        .busca-acervos input:focus {
            outline: none;
            border-color: var(--vinho-alexandria);
            box-shadow: 0 0 0 3px rgba(139, 30, 45, 0.1);
        }

        .busca-acervos i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: var(--texto-suave);
            font-size: 14px;
        }

        /* ===== Card de acervo ===== */
        .card-acervo {
            background: var(--branco);
            border: 1px solid var(--cinza-medio);
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .card-acervo:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .card-acervo .logo-acervo {
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cinza-claro);
            border-bottom: 1px solid var(--cinza-medio);
            padding: 20px;
        }

        .card-acervo .logo-acervo img {
            max-height: 70px;
            max-width: 80%;
            object-fit: contain;
        }

        .card-acervo .corpo-acervo {
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-acervo .corpo-acervo h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--texto-escuro);
            text-align: center;
            margin-bottom: 8px;
        }

        .card-acervo .corpo-acervo p {
            font-size: 12.5px;
            color: var(--texto-suave);
            text-align: center;
            line-height: 1.5;
            flex: 1;
            margin-bottom: 16px;
        }

        /* ===== Ações do card (Editar / Visualizar / Excluir) — padrão de cursos_adm.php ===== */
        .acoes-acervo {
            display: flex;
            gap: 7px;
            margin-top: 4px;
        }

        .acao {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 34px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .acao-editar {
            flex: 1;
            border: 1px solid var(--vinho-alexandria);
            color: var(--vinho-alexandria);
            background: #fff;
        }

        .acao-editar:hover {
            color: #fff;
            background: var(--vinho-alexandria);
        }

        .acao-visualizar,
        .acao-excluir {
            width: 36px;
            border: 1px solid var(--cinza-medio);
            color: #777;
            background: #fff;
        }

        .acao-visualizar:hover {
            color: #2878a8;
            border-color: #b8d7e8;
            background: #eef8fd;
        }

        .acao-excluir:hover {
            color: #b52929;
            border-color: #efc9c9;
            background: #fff0f0;
        }

        /* ===== Card "adicionar novo acervo" ===== */
        .card-adicionar-acervo {
            background: var(--branco);
            border: 2px dashed var(--dourado-alexandria);
            border-radius: 10px;
            height: 100%;
            min-height: 260px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s ease, border-color 0.15s ease;
        }

        .card-adicionar-acervo:hover {
            background: rgba(212, 175, 55, 0.08);
            border-color: var(--vinho-alexandria);
        }

        .card-adicionar-acervo .icone-adicionar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            color: var(--branco);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 14px;
        }

        .card-adicionar-acervo span.titulo-adicionar {
            font-size: 14px;
            font-weight: 700;
            color: var(--texto-escuro);
            margin-bottom: 4px;
        }

        .card-adicionar-acervo span.subtitulo-adicionar {
            font-size: 12px;
            color: var(--texto-suave);
        }
    </style>
</head>
<body>

    <?php
    include("../alexandria-frontend/includes/barraadm.html"); 
    include("../alexandria-frontend/includes/sidebaradm.html"); 
    ?>

    <div class="container-principal">

        <div class="conteudo-acervos">

            <div class="cabecalho-acervos">
                <p>Explore e gerencie os acervos disponíveis para estudo e simulados.</p>
                <span class="contador-acervos"><?= count($acervos) ?> acervo<?= count($acervos) === 1 ? '' : 's' ?> disponíve<?= count($acervos) === 1 ? 'l' : 'is' ?></span>
            </div>

            <div class="busca-acervos">
                <i class="bi bi-search"></i>
                <input type="text" id="buscaAcervoInput" placeholder="Buscar por banca, faculdade ou palavra-chave...">
            </div>

            <div class="row g-4" id="gridAcervos">

                <?php foreach ($acervos as $acervo): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 item-acervo" data-nome="<?= strtolower(htmlspecialchars($acervo['nome'])) ?>">
                        <div class="card-acervo" onclick="window.location.href='<?= htmlspecialchars($acervo['link']) ?>'">

                            <div class="logo-acervo">
                                <img src="<?= htmlspecialchars($acervo['logo']) ?>" alt="Logo <?= htmlspecialchars($acervo['nome']) ?>">
                            </div>
                            <div class="corpo-acervo">
                                <h5><?= htmlspecialchars($acervo['nome']) ?></h5>
                                <p><?= htmlspecialchars($acervo['descricao']) ?></p>

                                <div class="acoes-acervo">
                                    <a class="acao acao-editar"
                                       href="<?= htmlspecialchars($link_editar_acervo) ?>?id=<?= (int) $acervo['id'] ?>"
                                       onclick="event.stopPropagation();">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a class="acao acao-visualizar"
                                       href="<?= htmlspecialchars($acervo['link']) ?>"
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
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Card para adicionar um novo acervo -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="<?= htmlspecialchars($link_adicionar_acervo) ?>" class="card-adicionar-acervo">
                        <div class="icone-adicionar">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="titulo-adicionar">Adicionar novo acervo</span>
                        <span class="subtitulo-adicionar">Cadastre uma nova banca ou instituição</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal de confirmação de exclusão -->
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
        // Filtro simples de busca por nome do acervo
        document.getElementById('buscaAcervoInput').addEventListener('input', function (e) {
            const termo = e.target.value.trim().toLowerCase();
            document.querySelectorAll('.item-acervo').forEach(function (item) {
                const nome = item.getAttribute('data-nome');
                item.style.display = nome.includes(termo) ? '' : 'none';
            });
        });

        // Confirmação antes de excluir um acervo
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