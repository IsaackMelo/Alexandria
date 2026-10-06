<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAdm = isset($_SESSION['conta']['tipo']) && $_SESSION['conta']['tipo'] === 'ADM';

if (!isset($tituloPagina)) {
    $tituloPagina = 'Revolução de 1930 e o Governo Provisório (1930 - 1934)';
}

$linkCursos       = '../comuns/visualizar-curso.php';
$linkArtigos      = '../comuns/visualizar-artigos.php';
$linkChatAI       = '../comuns/chatai.php';
$linkAcervo       = '../comuns/visualizar-acervo.php';
$linkQuestoes     = '../comuns/visualizar-questoes.php';
$linkNotificacao  = '../comuns/visualizar-notificacoes.php';
$linkLogout       = '../web/index.php';

$paginaAtual = basename($_SERVER['PHP_SELF']);
function hdAtivo(string $arquivo, string $paginaAtual): string {
    return basename($arquivo) === $paginaAtual ? ' class="ativo"' : '';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Revolução de 1930</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    >

    <style>

        :root {

            --vinho-escuro: #5e1220;

            --cinza-texto: #555;
}

        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

        }

        html,
        body {

            width: 100%;

            min-height: 100%;

            font-family: Arial, Helvetica, sans-serif;

            background: var(--branco);

        }

        .topbar {

            width: 100%;

            height: 43px;

            background: var(--vinho-alexandria);

            display: flex;

            align-items: center;

            justify-content: space-between;

            color: white;

            padding: 0 8px;

            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);

            position: fixed;

            top: 0;

            left: 0;

            z-index: 1000;

        }

        .topbar-left {

            height: 100%;

            display: flex;

            align-items: center;

        }

        .menu-button {

            width: 32px;

            height: 32px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid rgba(255,255,255,0.8);

            border-radius: 4px;

            background: transparent;

            color: white;

            margin-right: 20px;

            cursor: pointer;

        }

        .menu-button i {

            font-size: 20px;

        }

        .page-title {

            font-size: 12px;

            font-weight: 600;
            color: var(--branco);

            white-space: nowrap;

        }

        .topbar-right {

            display: flex;

            align-items: center;

            height: 100%;

            gap: 10px;

        }

        .topbar-icon {

            width: 28px;

            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: transparent;

            border: none;

            color: white;

            cursor: pointer;

        }

        .topbar-icon i {

            font-size: 16px;

        }

        .menu-overlay {

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            height: 100vh;

            background: rgba(0, 0, 0, 0.45);

            z-index: 1999;

            opacity: 0;

            visibility: hidden;

            transition:
                opacity 0.3s ease,
                visibility 0.3s ease;

        }

        .menu-overlay.open {

            opacity: 1;

            visibility: visible;

        }

        .menu-sidebar {

            position: fixed;

            top: 0;

            left: 0;

            width: 156px;

            height: 100vh;

            background: var(--vinho-alexandria);

            z-index: 2000;

            overflow: hidden;

            display: flex;

            flex-direction: column;

            padding: 5px 0;

            box-shadow: 2px 0 10px rgba(0,0,0,0.3);

            transform: translateX(-100%);

            transition:
                transform 0.3s ease;

        }

        .menu-sidebar.open {

            transform: translateX(0);

        }

        .menu-sidebar-header {

            padding: 15px 10px 20px;

            text-align: center;

        }

        .menu-sidebar-header img {

            width: 90%;

            max-width: 130px;

            height: auto;

        }

        .menu-conteudo {

            display: flex;

            flex: 1;

            flex-direction: column;

        }

        .menu-side-cima {

            flex: 1;

        }

        .menu-list {

            list-style: none;

            padding: 0;

            margin: 0;

        }

        .menu-list li {

            width: 100%;

            margin-bottom: 2px;

        }

        .menu-list li a {

            display: flex;

            align-items: center;

            padding: 8px 12px;

            text-decoration: none;

            color: var(--dourado-alexandria);

            transition: all 0.2s ease;

        }

        .menu-list li a:hover {

            background: rgba(255,255,255,0.05);

            color: var(--dourado-claro);

        }

        .menu-list li a.ativo {

            color: var(--dourado-claro);

        }

        .menu-list li a.ativo .menu-text {

            border-bottom: 2px solid var(--dourado-alexandria);

            padding-bottom: 2px;

        }

        .menu-icon-img {

            width: 18px;

            height: 18px;

            margin-right: 10px;

            object-fit: contain;

            flex-shrink: 0;

        }

        .menu-icon-fa {

            width: 18px;

            font-size: 14px;

            margin-right: 10px;

            text-align: center;

            color: var(--dourado-alexandria);

            flex-shrink: 0;

        }

        .menu-list .menu-text {

            font-size: 11px;

            font-weight: 500;

        }

        .menu-list i {
            margin-right:10px;
        }

        .menu-side-baixo {

            margin-top: auto;

        }

        .menu-side-baixo li a {

            padding: 10px 12px;

        }

        .menu-close {

            position: absolute;

            top: 5px;

            right: 5px;

            width: 25px;

            height: 25px;

            border: none;

            background: transparent;

            color: var(--dourado-alexandria);

            cursor: pointer;

            z-index: 10;

        }

        .menu-close i {

            font-size: 14px;

        }

    </style>

</head>

<body>

    <header class="topbar">

        <div class="topbar-left">

            <button
                class="menu-button"
                type="button"
                id="menuButton"
            >

                <i class="bi bi-list"></i>

            </button>

            <span class="page-title">

                <?= htmlspecialchars($tituloPagina) ?>

            </span>

        </div>

        <div class="topbar-right">

            <a
                class="topbar-icon"
                type="button"
                href="../comuns/visualizar-notificacoes.php"
            >

                <i class="bi bi-bell-fill"></i>

            </a>

            <a
                class="topbar-icon"
                type="button"
                href="../comuns/perfil.php"
            >

                <i class="bi bi-person-fill"></i>

            </a>

        </div>

    </header>

    <div
        class="menu-overlay"
        id="menuOverlay"
    ></div>

    <aside
        class="menu-sidebar"
        id="menuSidebar"
    >

        <div class="menu-sidebar-header">

            <a href="<?= htmlspecialchars($linkCursos) ?>">

                <img
                    src="../imagens/logo.png"
                    alt="Alexandria Logo"
                >

            </a>

        </div>

        <div class="menu-conteudo">

            <div class="menu-side-cima">

                <ul class="menu-list">

                    <li>

                        <a href="<?= htmlspecialchars($linkCursos) ?>"<?= hdAtivo($linkCursos, $paginaAtual) ?>>

                            <img
                                src="../imagens/cursos.png"
                                class="menu-icon-img"
                                alt=""
                            >

                            <span class="menu-text">
                                Cursos disponíveis
                            </span>

                        </a>

                    </li>

                    <?php if (!$isAdm): ?>
                    <li>

                        <a href="../comuns/meuscursos.php"<?= hdAtivo('../comuns/meuscursos.php', $paginaAtual) ?>>

                            <img
                                src="../imagens/meus-cursos.png"
                                class="menu-icon-img"
                                alt=""
                            >

                            <span class="menu-text">
                                Meus cursos
                            </span>

                        </a>

                    </li>
                    <?php endif; ?>

                    <li>

                        <a href="<?= htmlspecialchars($linkArtigos) ?>"<?= hdAtivo($linkArtigos, $paginaAtual) ?>>

                            <img
                                src="../imagens/prancheta.png"
                                class="menu-icon-img"
                                alt=""
                            >

                            <span class="menu-text">
                                Artigos
                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="<?= htmlspecialchars($linkChatAI) ?>"<?= hdAtivo($linkChatAI, $paginaAtual) ?>>

                            <img
                                src="../imagens/ia.png"
                                class="menu-icon-img"
                                alt=""
                            >

                            <span class="menu-text">
                                Chat AI
                            </span>

                        </a>

                    </li>

                    <li>
                        <a href="<?= htmlspecialchars($linkAcervo) ?>"<?= hdAtivo($linkAcervo, $paginaAtual) ?>>
                            <i class="bi bi-archive icon-fa"></i>
                            <span class="menu-text">Acervo</span>
                        </a>
                    </li>

                    <li>

                        <a href="<?= htmlspecialchars($linkQuestoes) ?>"<?= hdAtivo($linkQuestoes, $paginaAtual) ?>>

                            <img
                                src="../imagens/banco_questao.png"
                                class="menu-icon-img"
                                alt=""
                            >

                            <span class="menu-text">
                                Banco de questões
                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="<?= htmlspecialchars($linkNotificacao) ?>"<?= hdAtivo($linkNotificacao, $paginaAtual) ?>>

                            <img
                                src="../imagens/notificacao.png"
                                class="menu-icon-img"
                                alt=""
                            >

                            <span class="menu-text">
                                Notificação
                            </span>

                        </a>

                    </li>

                </ul>

            </div>

            <div class="menu-side-baixo">

                <ul class="menu-list">

                    <li>

                        <a href="<?= htmlspecialchars($linkLogout) ?>">

                            <span class="menu-icon-fa">

                                <i class="fa-solid fa-right-from-bracket"></i>

                            </span>

                            <span class="menu-text">
                                Logout
                            </span>

                        </a>

                    </li>

                </ul>

            </div>

        </div>

        <button
            class="menu-close"
            type="button"
            id="menuClose"
        >

            <i class="fa-solid fa-xmark"></i>

        </button>

    </aside>

    <script>

        const menuButton =
            document.getElementById("menuButton");

        const menuSidebar =
            document.getElementById("menuSidebar");

        const menuOverlay =
            document.getElementById("menuOverlay");

        const menuClose =
            document.getElementById("menuClose");

        menuButton.addEventListener("click", function () {

            menuSidebar.classList.add("open");

            menuOverlay.classList.add("open");

        });

        menuClose.addEventListener("click", function () {

            menuSidebar.classList.remove("open");

            menuOverlay.classList.remove("open");

        });

        menuOverlay.addEventListener("click", function () {

            menuSidebar.classList.remove("open");

            menuOverlay.classList.remove("open");

        });

        document.addEventListener("keydown", function (event) {

            if (event.key === "Escape") {

                menuSidebar.classList.remove("open");

                menuOverlay.classList.remove("open");

            }

        });

    </script>

</body>

</html>