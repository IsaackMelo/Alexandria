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

$assuntos_disponiveis   = array_values(array_unique(array_column($questoes, 'assunto')));
$vestibulares_disponiveis = array_values(array_unique(array_column($questoes, 'banca')));
$anos_disponiveis         = array_values(array_unique(array_column($questoes, 'ano')));
sort($anos_disponiveis);

$link_adicionar_questao = '../adm/adicionar-questao.php';
$link_fazer_questao     = 'questao.php';
$link_editar_questao    = '../adm/editar-questao.php';
$link_excluir_questao   = 'visualizar-questoes.php';
?>
<?php if ($isAdm): ?>
<?php ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>ADM | Banco de Questões</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-questoes-adm.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>
<?php
    include __DIR__ . '/../includes/topbar.php';
    include __DIR__ . '/../includes/sidebar.php';
?>

<main class="conteudo-adm">

    <header class="cabecalho">
        <div>
            <h1>Banco de Questões</h1>
            <p>Treine com questões de história e melhore seu desempenho.</p>
        </div>
        <a href="<?= htmlspecialchars($link_adicionar_questao) ?>" class="botao-novo"><i class="fa-solid fa-plus"></i> Adicionar questão</a>
    </header>

    <section class="cartao-filtro">
        <div class="cabecalho-filtro"><i class="fa-solid fa-filter"></i> Filtro</div>

        <div class="grade-filtro">
            <div class="campo-filtro">
                <label for="filtroDificuldade">Nível de dificuldade</label>
                <select id="filtroDificuldade">
                    <option value="todos">Qualquer dificuldade</option>
                    <option value="facil">Fácil</option>
                    <option value="medio">Médio</option>
                    <option value="dificil">Difícil</option>
                </select>
            </div>
            <div class="campo-filtro">
                <label for="filtroAssunto">Assuntos</label>
                <select id="filtroAssunto">
                    <option value="todos">Todos os assuntos</option>
                    <?php foreach ($assuntos_disponiveis as $assunto): ?>
                        <option value="<?= htmlspecialchars(strtolower($assunto)) ?>"><?= htmlspecialchars($assunto) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="campo-filtro">
                <label for="filtroVestibular">Vestibular</label>
                <select id="filtroVestibular">
                    <option value="todos">Todos os vestibulares</option>
                    <?php foreach ($vestibulares_disponiveis as $banca): ?>
                        <option value="<?= htmlspecialchars(strtolower($banca)) ?>"><?= htmlspecialchars($banca) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="campo-filtro">
                <label for="buscaQuestao">Pesquise por questões:</label>
                <div class="busca-com-icone">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" id="buscaQuestao" placeholder="Buscar questões...">
                </div>
            </div>
        </div>

        <div class="grade-filtro linha-2">
            <div class="campo-filtro">
                <label>Data de referência</label>
                <div class="dupla-selects">
                    <select id="anoMinimo">
                        <option value="">Ano mínimo</option>
                        <?php for ($ano = 2025; $ano >= 2010; $ano--): ?>
                            <option value="<?= $ano ?>"><?= $ano ?></option>
                        <?php endfor; ?>
                    </select>
                    <select id="anoMaximo">
                        <option value="">Ano máximo</option>
                        <?php for ($ano = 2025; $ano >= 2010; $ano--): ?>
                            <option value="<?= $ano ?>"><?= $ano ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="campo-filtro">
                <label for="filtroTipo">Tipo de questão</label>
                <select id="filtroTipo">
                    <option value="todos">Ambos</option>
                    <option value="alternativa">Alternativa</option>
                    <option value="dissertativo">Dissertativo</option>
                </select>
            </div>
            <div class="campo-filtro campo-botao-filtrar">
                <button type="button" class="botao-filtrar" id="btnFiltrar"><i class="fa-solid fa-filter"></i> Filtrar</button>
            </div>
        </div>
    </section>

    <div class="barra-ordenacao">
        <span class="contador" id="contadorQuestoes"><?= count($questoes) ?> questões encontradas</span>
        <div class="ordenar">
            <label for="ordenarPor">Ordenar por</label>
            <select id="ordenarPor">
                <option value="recentes">Mais recentes</option>
                <option value="antigas">Mais antigas</option>
                <option value="dificuldade">Dificuldade</option>
            </select>
        </div>
    </div>

    <div class="lista-questoes" id="listaQuestoes">

        <?php foreach ($questoes as $questao): ?>
            <div class="linha-questao"
                 data-dificuldade="<?= htmlspecialchars($questao['dificuldade']) ?>"
                 data-assunto="<?= htmlspecialchars(strtolower($questao['assunto'])) ?>"
                 data-banca="<?= htmlspecialchars(strtolower($questao['banca'])) ?>"
                 data-ano="<?= (int) $questao['ano'] ?>"
                 data-tipo="<?= htmlspecialchars($questao['tipo']) ?>">

                <span class="badge-dificuldade <?= htmlspecialchars($questao['dificuldade']) ?>">
                    <?= htmlspecialchars($textos_dificuldade[$questao['dificuldade']]) ?>
                </span>

                <span class="assunto-questao"><?= htmlspecialchars($questao['assunto']) ?></span>
                <span class="banca-questao"><?= htmlspecialchars($questao['banca']) ?></span>
                <span class="ano-questao"><?= (int) $questao['ano'] ?></span>
                <span class="tipo-questao"><?= htmlspecialchars($textos_tipo[$questao['tipo']]) ?></span>

                <div class="acoes-questao">
                    <a class="acao acao-fazer" href="<?= htmlspecialchars($link_fazer_questao) ?>?id=<?= (int) $questao['id'] ?>">
                        <i class="fa-solid fa-play"></i> Fazer
                    </a>
                    <a class="acao acao-editar" href="<?= htmlspecialchars($link_editar_questao) ?>?id=<?= (int) $questao['id'] ?>" title="Editar">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <button class="acao acao-excluir" type="button" title="Excluir"
                            onclick="confirmarExclusao(<?= (int) $questao['id'] ?>, '<?= htmlspecialchars(addslashes($questao['assunto'])) ?>')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="sem-resultados" id="semResultados">Nenhuma questão encontrada.</div>
    </div>

</main>

<div class="modal fade" id="modalExcluirQuestao" tabindex="-1" aria-labelledby="modalExcluirQuestaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExcluirQuestaoLabel">Excluir questão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir a questão sobre <strong id="nomeQuestaoExcluir"></strong>? Essa ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="linkConfirmarExclusaoQuestao" class="btn" style="background: var(--vinho-alexandria); color: #fff;">Sim, excluir</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const linhas = [...document.querySelectorAll('.linha-questao')];
    const contador = document.getElementById('contadorQuestoes');
    const semResultados = document.getElementById('semResultados');

    function aplicarFiltros() {
        const dificuldade = document.getElementById('filtroDificuldade').value;
        const assunto = document.getElementById('filtroAssunto').value;
        const vestibular = document.getElementById('filtroVestibular').value;
        const tipo = document.getElementById('filtroTipo').value;
        const termoBusca = document.getElementById('buscaQuestao').value.trim().toLowerCase();
        const anoMin = document.getElementById('anoMinimo').value;
        const anoMax = document.getElementById('anoMaximo').value;

        let encontrados = 0;

        linhas.forEach(linha => {
            const anoLinha = parseInt(linha.dataset.ano, 10);

            const passaDificuldade = dificuldade === 'todos' || linha.dataset.dificuldade === dificuldade;
            const passaAssunto = assunto === 'todos' || linha.dataset.assunto === assunto;
            const passaVestibular = vestibular === 'todos' || linha.dataset.banca === vestibular;
            const passaTipo = tipo === 'todos' || linha.dataset.tipo === tipo;
            const passaBusca = !termoBusca || linha.textContent.toLowerCase().includes(termoBusca);
            const passaAnoMin = !anoMin || anoLinha >= parseInt(anoMin, 10);
            const passaAnoMax = !anoMax || anoLinha <= parseInt(anoMax, 10);

            const mostrar = passaDificuldade && passaAssunto && passaVestibular && passaTipo && passaBusca && passaAnoMin && passaAnoMax;
            linha.style.display = mostrar ? '' : 'none';
            if (mostrar) encontrados++;
        });

        contador.textContent = `${encontrados} questõe${encontrados === 1 ? '' : 's'} encontrada${encontrados === 1 ? '' : 's'}`;
        semResultados.style.display = encontrados ? 'none' : 'block';
    }

    document.getElementById('btnFiltrar').addEventListener('click', aplicarFiltros);
    document.getElementById('buscaQuestao').addEventListener('input', aplicarFiltros);

    const listaQuestoes = document.getElementById('listaQuestoes');
    const pesoDificuldade = { facil: 1, medio: 2, dificil: 3 };

    document.getElementById('ordenarPor').addEventListener('change', function () {
        const criterio = this.value;
        const linhasOrdenadas = [...linhas];

        linhasOrdenadas.sort((a, b) => {
            if (criterio === 'recentes') return parseInt(b.dataset.ano) - parseInt(a.dataset.ano);
            if (criterio === 'antigas') return parseInt(a.dataset.ano) - parseInt(b.dataset.ano);
            if (criterio === 'dificuldade') return pesoDificuldade[a.dataset.dificuldade] - pesoDificuldade[b.dataset.dificuldade];
            return 0;
        });

        linhasOrdenadas.forEach(linha => listaQuestoes.insertBefore(linha, semResultados));
    });

    const linkExcluirBase = <?= json_encode($link_excluir_questao) ?>;
    const modalExcluirQuestao = new bootstrap.Modal(document.getElementById('modalExcluirQuestao'));

    function confirmarExclusao(id, assunto) {
        document.getElementById('nomeQuestaoExcluir').textContent = assunto;
        document.getElementById('linkConfirmarExclusaoQuestao').setAttribute('href', linkExcluirBase + '?id=' + encodeURIComponent(id));
        modalExcluirQuestao.show();
    }
</script>

</body>
</html>
<?php else: ?>
<?php ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Acervo Geral</title>

    <link rel="icon" type="image/png" href="../imagens/alex.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/telaacervoesp.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">

<link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-questoes-user.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <?php
        include __DIR__ . '/../includes/sidebar.php';
    ?>

    <?php include __DIR__ . '/../includes/topbar.php';?>

    <main class="conteudo">

        <p class="subtitulo">Treine com questões de história e melhore seu desempenho.</p>

        <section class="card-acervo card-filtros-completo">

            <div class="filtros-topo-titulo">
                <i class="fa-solid fa-filter"></i> Filtro
            </div>

            <div class="filtros-grid-principal">

                <div class="filtros-lado-esquerdo">

                    <div class="linha-selects-3">
                        <div class="campo-filtro">
                            <label for="filtroDificuldade">Nível de dificuldade</label>
                            <select id="filtroDificuldade">
                                <option value="todos">Qualquer dificuldade</option>
                                <?php foreach ($textos_dificuldade as $chave_dif => $rotulo_dif): ?>
                                <option value="<?= ucfirst($chave_dif) ?>"><?= htmlspecialchars($rotulo_dif) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="campo-filtro">
                            <label for="filtroAssunto">Assuntos</label>
                            <select id="filtroAssunto">
                                <option value="todos">Todos os assuntos</option>
                                <?php $assuntos_ordenados = $assuntos_disponiveis; sort($assuntos_ordenados); ?>
                                <?php foreach ($assuntos_ordenados as $assunto_opcao): ?>
                                <option value="<?= htmlspecialchars($assunto_opcao) ?>"><?= htmlspecialchars($assunto_opcao) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="campo-filtro">
                            <label for="filtroVestibular">Vestibular</label>
                            <select id="filtroVestibular">
                                <option value="todos">Todos os vestibulares</option>
                                <?php foreach ($vestibulares_disponiveis as $banca_opcao): ?>
                                <option value="<?= htmlspecialchars($banca_opcao) ?>"><?= htmlspecialchars($banca_opcao) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="linha-selects-2">
                        <div class="campo-filtro">
                            <label>Data de referência</label>
                            <div class="grupo-anos">
                                <select id="filtroAnoMin">
                                    <option value="todos">Ano mínimo</option>
                                    <?php foreach ($anos_disponiveis as $ano_opcao): ?>
                                    <option value="<?= (int) $ano_opcao ?>"><?= (int) $ano_opcao ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select id="filtroAnoMax">
                                    <option value="todos">Ano máximo</option>
                                    <?php foreach ($anos_disponiveis as $ano_opcao): ?>
                                    <option value="<?= (int) $ano_opcao ?>"><?= (int) $ano_opcao ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="campo-filtro">
                            <label for="filtroTipo">Tipo de questão</label>
                            <select id="filtroTipo">
                                <option value="todos">Ambos</option>
                                <option value="Alternativo">Alternativo</option>
                                <option value="Dissertativo">Dissertativo</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="filtros-lado-direito">

                    <div class="campo-busca">
                        <label for="inputBusca">Pesquise por questões:</label>
                        <div class="input-busca-wrapper">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="inputBusca" placeholder="Buscar questões..." oninput="filtrarProvas()">
                        </div>
                    </div>

                    <div class="area-botao-filtrar">
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

            <?php foreach ($questoes as $questao_user):
                $dif_user  = ucfirst(strtolower($questao_user['dificuldade']));
                $tipo_user = $questao_user['tipo'] === 'dissertativo' ? 'Dissertativo' : 'Alternativo';
            ?>
            <div class="item-prova" data-dificuldade="<?= htmlspecialchars($dif_user) ?>" data-assunto="<?= htmlspecialchars($questao_user['assunto']) ?>" data-vestibular="<?= htmlspecialchars($questao_user['banca']) ?>" data-ano="<?= (int) $questao_user['ano'] ?>" data-tipo="<?= $tipo_user ?>">
                <span class="badge-dificuldade <?= strtolower($questao_user['dificuldade']) ?>"><?= htmlspecialchars($textos_dificuldade[strtolower($questao_user['dificuldade'])] ?? $dif_user) ?></span>
                <span class="info-texto"><?= htmlspecialchars($questao_user['assunto']) ?></span>
                <span class="info-texto"><?= htmlspecialchars($questao_user['banca']) ?></span>
                <span class="info-texto"><?= (int) $questao_user['ano'] ?></span>
                <span class="info-texto"><?= $tipo_user ?></span>
                <div class="botoes-prova">
                    <a href="questao.php?id=<?= (int) $questao_user['id'] ?>" class="btn-prova">Questão</a>
                    <a href="questao-certo.php?id=<?= (int) $questao_user['id'] ?>&amp;gabarito=1" class="btn-gabarito">Gabarito</a>
                </div>
            </div>
            <?php endforeach; ?>
            <p class="sem-provas" id="semResultados" style="display:none;">Nenhuma questão encontrada com esses filtros.</p>
        </section>

    </main>

    <script src="../js/paginas/comuns-visualizar-questoes.js"></script>

</body>
</html>
<?php endif; ?>
