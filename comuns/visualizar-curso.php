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
include __DIR__ . '/../includes/sidebar.php';
include __DIR__ . '/../includes/topbar.php';

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>ADM | Cursos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-curso.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

<main class="conteudo-adm">
    <header class="cabecalho">
        <div>
            <?php if ($isAdm): ?>
            <h1>Gerenciamento de cursos</h1>
            <p>Os cursos abaixo são os mesmos disponíveis para os usuários.</p>
            <?php else: ?>
            <h1>Cursos Disponíveis</h1>
            <p>Cursos pensados para sua aprovação.</p>
            <?php endif; ?>
        </div>
        <?php if ($isAdm): ?>
        <a href="../adm/adicionar-curso.php" class="botao-novo"><i class="fa-solid fa-plus"></i> Novo curso</a>
        <?php endif; ?>
    </header>

    <div class="barra-controles">
        <span class="contador" id="contador"><?= count($cursos) ?> curso<?= count($cursos) === 1 ? '' : 's' ?> cadastrado<?= count($cursos) === 1 ? '' : 's' ?></span>
        <div class="controles">
            <input type="search" class="busca" id="buscaCurso" placeholder="Buscar cursos..." aria-label="Buscar cursos">
            <select class="filtro" id="filtroStatus" aria-label="Filtrar cursos">
                <option value="todos">Todos os cursos</option>
                <option value="publicado">Publicados</option>
                <option value="rascunho">Rascunhos</option>
            </select>
        </div>
    </div>

    <section class="grade-cursos" id="gradeCursos" aria-label="Cursos disponíveis para gerenciamento">
        <?php foreach ($cursos as $curso): ?>
            <?php if ($isUser): ?>
            <a class="link-cartao-curso" href="visualizar-aulas.php?slug=<?= urlencode($curso['slug']) ?>" title="Visualizar">
            <?php endif; ?>
            <article class="cartao-curso" data-status="<?= htmlspecialchars($curso['status']) ?>">
                <div class="container-imagem-curso">
                    <img src="<?= htmlspecialchars($curso['imagem']) ?>" alt="<?= htmlspecialchars($curso['titulo']) ?>">
                    <span class="status"><?= $curso['status'] === 'publicado' ? 'Publicado' : 'Rascunho' ?></span>
                </div>
                <div class="informacoes-curso">
                    <div class="titulo-curso"><?= htmlspecialchars($curso['titulo']) ?></div>
                    <div class="detalhes-curso">
                        <span><i class="fa-solid fa-users"></i> <?= (int) $curso['alunos'] ?> alunos</span>
                        <span><i class="fa-solid fa-book"></i> <?= htmlspecialchars($curso['categoria']) ?></span>
                    </div>
                    <?php if ($isAdm): ?>
                    <div class="acoes-curso">
                        <a class="acao acao-editar" href="../adm/editar-curso.php?curso=<?= urlencode($curso['slug']) ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a class="acao acao-visualizar" href="visualizar-aulas.php?slug=<?= urlencode($curso['slug']) ?>" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <button class="acao acao-excluir" type="button" title="Excluir" data-curso="<?= htmlspecialchars($curso['titulo']) ?>"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php if ($isUser): ?>
            </a>
            <?php endif; ?>
<?php endforeach; ?>
        <div class="sem-resultados" id="semResultados">Nenhum curso encontrado.</div>
    </section>

    <nav class="paginacao" id="paginacao" aria-label="Paginação" style="display: none;"></nav>
</main>

<script>
    const CURSOS_POR_PAGINA = 6;
    const busca = document.getElementById('buscaCurso');
    const filtro = document.getElementById('filtroStatus');
    const contador = document.getElementById('contador');
    const semResultados = document.getElementById('semResultados');
    const paginacao = document.getElementById('paginacao');
    const grade = document.getElementById('gradeCursos');
    const cards = [...document.querySelectorAll('.cartao-curso')];

    const parametroPagina = parseInt(new URLSearchParams(window.location.search).get('pagina'), 10);
    let paginaAtual = Number.isInteger(parametroPagina) && parametroPagina > 0 ? parametroPagina : 1;

    function itemDaGrade(card) {
        return card.closest('.link-cartao-curso') || card;
    }

    function atualizarUrl() {
        const url = new URL(window.location.href);
        if (paginaAtual > 1) {
            url.searchParams.set('pagina', paginaAtual);
        } else {
            url.searchParams.delete('pagina');
        }
        window.history.replaceState(null, '', url);
    }

    function criarBotao(conteudo, pagina, { ativa = false, desabilitada = false, rotulo = '' } = {}) {
        const botao = document.createElement('a');
        botao.href = pagina > 1 ? `?pagina=${pagina}` : '?';
        botao.className = 'pagina' + (ativa ? ' ativa' : '') + (desabilitada ? ' desabilitada' : '');
        botao.innerHTML = conteudo;
        if (rotulo) botao.setAttribute('aria-label', rotulo);
        if (ativa) botao.setAttribute('aria-current', 'page');
        if (desabilitada) botao.setAttribute('aria-disabled', 'true');
        botao.addEventListener('click', (evento) => {
            evento.preventDefault();
            if (desabilitada || ativa) return;
            paginaAtual = pagina;
            renderizar();
            grade.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
        return botao;
    }

    function renderizarPaginacao(totalPaginas) {
        paginacao.innerHTML = '';
        if (totalPaginas <= 1) {
            paginacao.style.display = 'none';
            return;
        }
        paginacao.style.display = '';
        paginacao.appendChild(criarBotao('<i class="fas fa-chevron-left"></i>', paginaAtual - 1, { desabilitada: paginaAtual === 1, rotulo: 'Página anterior' }));
        for (let pagina = 1; pagina <= totalPaginas; pagina++) {
            paginacao.appendChild(criarBotao(String(pagina), pagina, { ativa: pagina === paginaAtual, rotulo: `Página ${pagina}` }));
        }
        paginacao.appendChild(criarBotao('<i class="fas fa-chevron-right"></i>', paginaAtual + 1, { desabilitada: paginaAtual === totalPaginas, rotulo: 'Próxima página' }));
    }

    function renderizar() {
        const termo = busca.value.toLocaleLowerCase('pt-BR').trim();
        const status = filtro.value;

        const encontrados = cards.filter(card => {
            const correspondeTexto = card.textContent.toLocaleLowerCase('pt-BR').includes(termo);
            const correspondeStatus = status === 'todos' || card.dataset.status === status;
            return correspondeTexto && correspondeStatus;
        });

        const totalPaginas = Math.max(1, Math.ceil(encontrados.length / CURSOS_POR_PAGINA));
        paginaAtual = Math.min(Math.max(1, paginaAtual), totalPaginas);
        const inicio = (paginaAtual - 1) * CURSOS_POR_PAGINA;
        const visiveis = new Set(encontrados.slice(inicio, inicio + CURSOS_POR_PAGINA));

        cards.forEach(card => {
            itemDaGrade(card).style.display = visiveis.has(card) ? '' : 'none';
        });

        const total = encontrados.length;
        contador.textContent = `${total} curso${total === 1 ? '' : 's'} encontrado${total === 1 ? '' : 's'}`;
        semResultados.style.display = total ? 'none' : 'block';

        renderizarPaginacao(totalPaginas);
        atualizarUrl();
    }

    function filtrarCursos() {
        paginaAtual = 1;
        renderizar();
    }

    busca.addEventListener('input', filtrarCursos);
    filtro.addEventListener('change', filtrarCursos);

    renderizar();

<?php if ($isAdm): ?>
    document.querySelectorAll('.acao-excluir').forEach(botao => {
        botao.addEventListener('click', () => {
            const curso = botao.dataset.curso;
            if (confirm(`Deseja realmente excluir o curso “${curso}”?`)) {
                const card = botao.closest('.cartao-curso');
                const indice = cards.indexOf(card);
                if (indice !== -1) cards.splice(indice, 1);
                itemDaGrade(card).remove();
                renderizar();
            }
        });
    });
<?php endif; ?>
</script>
</body>
</html>