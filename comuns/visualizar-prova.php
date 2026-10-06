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

$banca_slug = isset($_GET['banca']) ? strtolower(trim($_GET['banca'])) : '';

$acervo_atual = null;
foreach ($acervos as $item_acervo) {
    if (($item_acervo['slug'] ?? strtolower($item_acervo['nome'])) === $banca_slug) {
        $acervo_atual = $item_acervo;
        break;
    }
}
if ($acervo_atual === null && !empty($acervos)) {
    $acervo_atual  = $acervos[0];
    $banca_slug    = $acervo_atual['slug'] ?? strtolower($acervo_atual['nome']);
}

$provas_tem_banca = array_filter($provas, function ($prova) {
    return isset($prova['banca']);
});

if (count($provas_tem_banca) > 0) {
    $provas_da_banca = array_values(array_filter($provas, function ($prova) use ($banca_slug) {
        return isset($prova['banca']) && strtolower($prova['banca']) === $banca_slug;
    }));
} else {
    $provas_da_banca = $provas;
}

$anos_provas    = array_values(array_unique(array_column($provas_da_banca, 'ano')));
sort($anos_provas);
$fases_provas   = array_values(array_unique(array_column($provas_da_banca, 'fase')));
$versoes_todas  = array_values(array_unique(array_column($provas_da_banca, 'versao')));
$dias_provas    = array_values(array_filter($versoes_todas, fn($v) => stripos($v, 'Dia') === 0));
$versoes_provas = array_values(array_filter($versoes_todas, fn($v) => stripos($v, 'Dia') !== 0));
$tipo_acervo_rotulo = $tipos_acervo[$acervo_atual['tipo'] ?? ''] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Acervo <?= htmlspecialchars($acervo_atual['nome'] ?? '') ?></title>

    <link rel="icon" type="image/png" href="../imagens/alex.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../estilo/telaacervoesp.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-prova.css">

<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <?php
        include __DIR__ . '/../includes/sidebar.php';
        include __DIR__ . '/../includes/topbar.php';
    ?>

    <main class="conteudo">

        <p class="subtitulo">Treine com questões de história e melhore seu desempenho.</p>

        <section class="card-acervo">
            
            <div class="info-acervo">
                <img src="<?= htmlspecialchars($acervo_atual['logo'] ?? '') ?>" alt="<?= htmlspecialchars($acervo_atual['nome'] ?? '') ?>" class="logo-fuvest">
                <div>
                    <h3>ACERVO <?= htmlspecialchars($acervo_atual['nome'] ?? '') ?></h3>
                    <p><?= htmlspecialchars($acervo_atual['descricao'] ?? '') ?></p>
                    <p class="mb-0" style="font-size: 12px; opacity: .8;">
                        <?= htmlspecialchars($acervo_atual['nome_completo'] ?? '') ?>
                        <?php if ($tipo_acervo_rotulo !== ''): ?> · <?= htmlspecialchars($tipo_acervo_rotulo) ?><?php endif; ?>
                        · <?= count($provas_da_banca) ?> prova(s)
                        <?php if (!empty($acervo_atual['site'])): ?> · <a href="<?= htmlspecialchars($acervo_atual['site']) ?>" target="_blank" rel="noopener">site oficial</a><?php endif; ?>
                    </p>
                </div>
            </div>

            <div class="filtros">
                <div class="filtro-titulo">
                    <i class="fa-solid fa-filter"></i> Filtro
                </div>

                <div class="grid-filtros">
                    <div class="campo-filtro">
                        <label for="filtroDificuldade">Nível de dificuldade</label>
                        <select id="filtroDificuldade">
                            <option value="todos">Qualquer dificuldade</option>
                            <option value="Facil">Fácil</option>
                            <option value="Medio">Médio</option>
                            <option value="Dificil">Difícil</option>
                        </select>
                    </div>

                    <div class="campo-filtro">
                        <label>Data de referência</label>
                        <div class="grupo-anos">
                            <select id="filtroAnoMin">
                                <option value="todos">Ano mínimo</option>
                                <?php foreach ($anos_provas as $ano_opcao): ?>
                                <option value="<?= (int) $ano_opcao ?>"><?= (int) $ano_opcao ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select id="filtroAnoMax">
                                <option value="todos">Ano máximo</option>
                                <?php foreach ($anos_provas as $ano_opcao): ?>
                                <option value="<?= (int) $ano_opcao ?>"><?= (int) $ano_opcao ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="campo-filtro">
                        <label for="filtroFase">Fase</label>
                        <select id="filtroFase">
                            <option value="todos">Ambas</option>
                            <?php foreach ($fases_provas as $fase_opcao): ?>
                            <option value="<?= htmlspecialchars($fase_opcao) ?>"><?= htmlspecialchars($fase_opcao) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if ($versoes_provas): ?>
                    <div class="campo-filtro">
                        <label for="filtroVersao">Versão</label>
                        <select id="filtroVersao">
                            <option value="todos">Qualquer versão</option>
                            <?php foreach ($versoes_provas as $versao_opcao): ?>
                            <option value="<?= htmlspecialchars($versao_opcao) ?>"><?= htmlspecialchars($versao_opcao) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <?php if ($dias_provas): ?>
                    <div class="campo-filtro">
                        <label for="filtroDia">Dia</label>
                        <select id="filtroDia">
                            <option value="todos">Ambos</option>
                            <?php foreach ($dias_provas as $dia_opcao): ?>
                            <option value="<?= htmlspecialchars($dia_opcao) ?>"><?= htmlspecialchars($dia_opcao) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="campo-filtro campo-botao">
                        <button class="btn-filtrar" onclick="filtrarProvas()">Filtrar</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="ordenar-area">
            <span>Ordenar por</span>
            <select id="selectOrdem" onchange="ordenarProvas()">
                <option value="recentes">Mais recentes</option>
                <option value="antigas">Mais antigas</option>
            </select>
        </div>

        <section class="lista-provas" id="listaProvas">
        </section>

    </main>

    <script>

        const provas = <?php echo json_encode($provas_da_banca, JSON_UNESCAPED_UNICODE); ?>;

        const rotuloDificuldade = {
            Facil: "Fácil",
            Medio: "Médio",
            Dificil: "Difícil"
        };

        function criarCardProva(prova) {
            const item = document.createElement("div");
            item.className = "item-prova";
            item.dataset.dificuldade = prova.dificuldade;
            item.dataset.ano = prova.ano;
            item.dataset.fase = prova.fase;
            item.dataset.versao = prova.versao;

            item.innerHTML = `
                <span class="badge-dificuldade ${prova.dificuldade.toLowerCase()}">${rotuloDificuldade[prova.dificuldade] || prova.dificuldade}</span>
                <span class="info-texto">${prova.ano}</span>
                <span class="info-texto">${prova.fase}</span>
                <span class="info-texto">${prova.versao}</span>
                <span class="info-texto">${prova.total_perguntas || 0} questões</span>
                <div class="botoes-prova">
                    <a href="${prova.link}" class="btn-prova" title="${prova.titulo || ''}">Prova</a>
                    <a href="questao-certo.php?prova=${prova.id}&q=0&gabarito=1" class="btn-gabarito">Gabarito</a>
                </div>
            `;

            return item;
        }

        function renderizarProvas(lista) {
            const container = document.getElementById("listaProvas");
            container.innerHTML = "";

            if (lista.length === 0) {
                container.innerHTML = '<p class="sem-provas">Nenhuma prova cadastrada para este acervo ainda.</p>';
                return;
            }

            lista.forEach(function (prova) {
                container.appendChild(criarCardProva(prova));
            });
        }

        renderizarProvas(provas);
        document.addEventListener('DOMContentLoaded', function () { ordenarProvas(); });

        function filtrarProvas() {
            const dif = document.getElementById('filtroDificuldade').value;
            const anoMin = document.getElementById('filtroAnoMin').value;
            const anoMax = document.getElementById('filtroAnoMax').value;
            const fase = document.getElementById('filtroFase').value;
            const campoDia = document.getElementById('filtroDia');
            const campoVersao = document.getElementById('filtroVersao');
            const dia = campoDia ? campoDia.value : 'todos';
            const versao = campoVersao ? campoVersao.value : 'todos';

            const itens = document.querySelectorAll('.item-prova');

            itens.forEach(function(item) {
                let mostrar = true;

                if (dif !== 'todos' && item.dataset.dificuldade !== dif) mostrar = false;
                if (anoMin !== 'todos' && parseInt(item.dataset.ano) < parseInt(anoMin)) mostrar = false;
                if (anoMax !== 'todos' && parseInt(item.dataset.ano) > parseInt(anoMax)) mostrar = false;
                if (fase !== 'todos' && item.dataset.fase !== fase) mostrar = false;
                if (dia !== 'todos' && item.dataset.versao !== dia) mostrar = false;
                if (versao !== 'todos' && item.dataset.versao !== versao) mostrar = false;

                item.style.display = mostrar ? 'flex' : 'none';
            });
        }

        function ordenarProvas() {
            const ordem = document.getElementById('selectOrdem').value;
            const lista = document.getElementById('listaProvas');
            const itens = Array.from(document.querySelectorAll('.item-prova'));

            itens.sort(function(a, b) {
                const anoA = parseInt(a.dataset.ano);
                const anoB = parseInt(b.dataset.ano);

                return ordem === 'recentes' ? (anoB - anoA) : (anoA - anoB);
            });

            itens.forEach(function(item) {
                lista.appendChild(item);
            });
        }
    </script>

</body>
</html>