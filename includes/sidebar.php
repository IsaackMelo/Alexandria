<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAdm = isset($_SESSION['conta']['tipo']) && $_SESSION['conta']['tipo'] === 'ADM';

$linkCursos       = '../comuns/visualizar-curso.php';
$linkArtigos      = '../comuns/visualizar-artigos.php';
$linkChatAI       = '../comuns/chatai.php';
$linkAcervo       = '../comuns/visualizar-acervo.php';
$linkQuestoes     = '../comuns/visualizar-questoes.php';
$linkNotificacao  = '../comuns/visualizar-notificacoes.php';
$linkLogout       = '../auth/logout.php';

$paginaAtual = basename($_SERVER['PHP_SELF']);
function svAtivo(string $arquivo, string $paginaAtual): string {
    return basename($arquivo) === $paginaAtual ? ' class="ativo"' : '';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

.sidebar-alexandria {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 156px;
    z-index: 1000;

    background: var(--vinho-alexandria);

    overflow: hidden;

    display: flex;
    flex-direction: column;

    padding: 5px 0;

    box-shadow: 2px 0 10px rgba(0,0,0,0.3);
}

.sidebar-alexandria .sidebar-header {
    padding: 15px 10px 20px 10px;
    text-align: center;
}

.sidebar-alexandria .sidebar-header img {
    width: 90%;
    max-width: 130px;
    height: auto;
}

.sidebar-alexandria .conteudo-sidebar {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.sidebar-alexandria .side-cima {
    flex: 1;
}

.sidebar-alexandria .sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-alexandria .sidebar-menu li {
    width: 100%;
    margin-bottom: 2px;
}

.sidebar-alexandria .sidebar-menu li a {
    display: flex;
    align-items: center;

    padding: 8px 12px;

    text-decoration: none;

    color: var(--dourado-alexandria);

    transition: all 0.2s ease;
}

.sidebar-alexandria .sidebar-menu li a:hover {
    background: rgba(255,255,255,0.05);
    color: var(--dourado-claro);
}

.sidebar-alexandria .sidebar-menu li a.ativo {
    color: var(--dourado-claro);
}

.sidebar-alexandria .sidebar-menu li a.ativo .text {
    border-bottom: 2px solid var(--dourado-alexandria);
    padding-bottom: 2px;
}

.sidebar-alexandria .icon-img {
    width: 18px;
    height: 18px;

    margin-right: 10px;

    object-fit: contain;
}

.sidebar-alexandria .icon-fa {
    width: 18px;

    font-size: 14px;

    margin-right: 10px;

    text-align: center;

    color: var(--dourado-alexandria);
}

.sidebar-alexandria .text {
    font-size: 11px;
    font-weight: 500;
}

.sidebar-alexandria .sidebar-footer {
    padding-bottom: 5px;
}

@media (max-width: 900px) {
    .sidebar-alexandria {
        width: 240px;
        transform: translateX(-100%);
        transition: transform .25s ease;
        overflow-y: auto;
    }

    .sidebar-alexandria.aberta {
        transform: translateX(0);
    }

    .sidebar-alexandria .text {
        font-size: 13px;
    }

    .sidebar-alexandria .sidebar-menu li a {
        padding: 11px 16px;
    }

    .sidebar-toggle {
        position: fixed;
        top: 18px;
        left: 14px;
        z-index: 1100;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 0;
        border-radius: 8px;
        background: var(--vinho-alexandria);
        color: var(--dourado-alexandria);
        font-size: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,.25);
        cursor: pointer;
    }

    .sidebar-overlay {
        position: fixed;
        inset: 0;
        z-index: 999;
        background: rgba(0,0,0,.45);
        opacity: 0;
        pointer-events: none;
        transition: opacity .25s ease;
    }

    .sidebar-overlay.visivel {
        opacity: 1;
        pointer-events: auto;
    }
}

@media (min-width: 901px) {
    .sidebar-toggle,
    .sidebar-overlay {
        display: none;
    }
}
</style>

<button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Abrir menu" aria-controls="sidebarAlexandria" aria-expanded="false">
    <i class="fa-solid fa-bars"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar-alexandria" id="sidebarAlexandria">

    <div class="sidebar-header">
        <a href="<?= htmlspecialchars($linkCursos) ?>">
            <img src="../imagens/logo.png" alt="Alexandria Logo">
        </a>
    </div>

    <div class="conteudo-sidebar">

        <div class="side-cima">

            <ul class="sidebar-menu">

                <li>
                    <a href="<?= htmlspecialchars($linkCursos) ?>"<?= svAtivo($linkCursos, $paginaAtual) ?>>
                        <img src="../imagens/cursos.png" class="icon-img" alt="">
                        <span class="text">Cursos disponíveis</span>
                    </a>
                </li>

                <?php if (!$isAdm): ?>
                <li>
                    <a href="../comuns/meuscursos.php"<?= svAtivo('../comuns/meuscursos.php', $paginaAtual) ?>>
                        <img src="../imagens/meus-cursos.png" class="icon-img" alt="">
                        <span class="text">Meus cursos</span>
                    </a>
                </li>
                <?php endif; ?>

                <li>
                    <a href="<?= htmlspecialchars($linkArtigos) ?>"<?= svAtivo($linkArtigos, $paginaAtual) ?>>
                        <img src="../imagens/prancheta.png" class="icon-img" alt="">
                        <span class="text">Artigos</span>
                    </a>
                </li>

                <li>
                    <a href="<?= htmlspecialchars($linkChatAI) ?>"<?= svAtivo($linkChatAI, $paginaAtual) ?>>
                        <img src="../imagens/ia.png" class="icon-img" alt="">
                        <span class="text">Chat AI</span>
                    </a>
                </li>

                <li>
                    <a href="<?= htmlspecialchars($linkAcervo) ?>"<?= svAtivo($linkAcervo, $paginaAtual) ?>>
                        <i class="bi bi-archive icon-fa"></i>
                        <span class="text">Acervo</span>
                    </a>
                </li>

                <li>
                    <a href="<?= htmlspecialchars($linkQuestoes) ?>"<?= svAtivo($linkQuestoes, $paginaAtual) ?>>
                        <img src="../imagens/banco_questao.png" class="icon-img" alt="">
                        <span class="text">Banco de questões</span>
                    </a>
                </li>

                <li>
                    <a href="<?= htmlspecialchars($linkNotificacao) ?>"<?= svAtivo($linkNotificacao, $paginaAtual) ?>>
                        <img src="../imagens/notificacao.png" class="icon-img" alt="">
                        <span class="text">Notificação</span>
                    </a>
                </li>

            </ul>

        </div>

        <div class="side-baixo">

            <ul class="sidebar-menu sidebar-footer">

                <li>
                    <a href="<?= htmlspecialchars($linkLogout) ?>">
                        <span class="icon-fa">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>

                        <span class="text">Logout</span>
                    </a>
                </li>

            </ul>

        </div>

    </div>

</div>

<script>
(function () {
    var sidebar = document.getElementById('sidebarAlexandria');
    var botao = document.getElementById('sidebarToggle');
    var overlay = document.getElementById('sidebarOverlay');
    if (!sidebar || !botao || !overlay) return;

    function alternar(abrir) {
        sidebar.classList.toggle('aberta', abrir);
        overlay.classList.toggle('visivel', abrir);
        botao.setAttribute('aria-expanded', String(abrir));
        botao.innerHTML = abrir ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
    }

    botao.addEventListener('click', function () {
        alternar(!sidebar.classList.contains('aberta'));
    });
    overlay.addEventListener('click', function () { alternar(false); });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') alternar(false);
    });

    var mq = window.matchMedia('(max-width: 900px)');
    function ajustarDeslocamentos() {
        if (!mq.matches) {
            alternar(false);
            document.querySelectorAll('[data-offset-sidebar]').forEach(function (el) {
                el.style.marginLeft = '';
                el.style.paddingLeft = '';
                el.removeAttribute('data-offset-sidebar');
            });
            return;
        }
        document.querySelectorAll('body > *, body > * > *').forEach(function (el) {
            if (el === sidebar || sidebar.contains(el)) return;
            var estilo = window.getComputedStyle(el);
            var ml = parseFloat(estilo.marginLeft);
            var pl = parseFloat(estilo.paddingLeft);
            if (ml >= 140 && ml <= 180) {
                el.style.marginLeft = '0px';
                el.setAttribute('data-offset-sidebar', '1');
            }
            if (pl >= 140 && pl <= 180) {
                el.style.paddingLeft = '16px';
                el.setAttribute('data-offset-sidebar', '1');
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', ajustarDeslocamentos);
    } else {
        ajustarDeslocamentos();
    }
    window.addEventListener('load', ajustarDeslocamentos);
    mq.addEventListener('change', ajustarDeslocamentos);
})();
</script>