<?php
/**
 * visualizar-questoes.php
 * Lista as questões do banco de questões, com painel de filtros,
 * ordenação e ações de Fazer / Editar / Excluir em cada questão,
 * além do botão para adicionar uma nova questão.
 */

// Dados das questões: centralizados em dados.php
require_once __DIR__ . '/dados.php';

// Listas usadas para popular os filtros (derivadas dos dados, calculadas aqui)
$assuntos_disponiveis   = array_values(array_unique(array_column($questoes, 'assunto')));
$vestibulares_disponiveis = array_values(array_unique(array_column($questoes, 'banca')));

// Páginas de destino (ajuste os nomes/rotas conforme seu projeto real)
$link_adicionar_questao = 'adicionar-questao.php';
$link_fazer_questao     = 'fazer-questao.php';   // recebe ?id=
$link_editar_questao    = 'editar-questao.php';  // recebe ?id=
$link_excluir_questao   = 'excluir-questao.php'; // recebe ?id=
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>ADM | Banco de Questões</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria: #8b1e2d;
            --vinho-escuro: #6f1724;
            --dourado-alexandria: #d4af37;
            --dourado-claro: #f0d060;
            --branco: #fff;
            --fundo: #faf8f5;
            --cinza-medio: #e8dfd7;
            --cinza-escuro: #777;
            --texto-escuro: #333;
            --verde: #2e7d4f;
            --verde-bg: #eaf6ee;
            --laranja: #b6791f;
            --laranja-bg: #fbf1e2;
            --vermelho: #a3383f;
            --vermelho-bg: #fbecec;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--fundo);
            color: var(--texto-escuro);
            font-family: 'Inter', sans-serif;
        }

        .conteudo-adm {
            margin-left: 156px;
            min-height: 100vh;
            padding: 30px 40px 40px;
        }

        .cabecalho {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 22px;
            border-bottom: 1px solid var(--cinza-medio);
            padding-bottom: 18px;
        }

        .cabecalho h1 {
            margin: 0 0 5px;
            font-family: 'Playfair Display', serif;
            font-size: 25px;
        }

        .cabecalho p {
            margin: 0;
            color: var(--cinza-escuro);
            font-size: 13px;
        }

        .botao-novo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 0;
            border-radius: 5px;
            padding: 10px 15px;
            color: #fff;
            background: var(--vinho-alexandria);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: .2s;
        }

        .botao-novo:hover {
            color: #fff;
            background: var(--vinho-escuro);
        }

        /* ===== Painel de filtro ===== */
        .cartao-filtro {
            background: #fff;
            border: 1px solid var(--cinza-medio);
            border-radius: 10px;
            padding: 18px 22px;
            margin-bottom: 20px;
        }

        .cabecalho-filtro {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .cabecalho-filtro i { color: var(--vinho-alexandria); font-size: 12px; }

        .grade-filtro {
            display: grid;
            grid-template-columns: repeat(3, 1fr) 1.2fr;
            gap: 16px;
            margin-bottom: 14px;
        }

        .grade-filtro.linha-2 {
            grid-template-columns: 1fr 1fr 1fr;
            align-items: end;
            margin-bottom: 0;
        }

        .campo-filtro label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--cinza-escuro);
            margin-bottom: 7px;
        }

        .campo-filtro select,
        .campo-filtro input {
            width: 100%;
            height: 38px;
            border: 1px solid #dcd3ca;
            border-radius: 6px;
            padding: 0 12px;
            font: inherit;
            font-size: 12.5px;
            color: var(--texto-escuro);
            background: #fff;
            outline: none;
        }

        .campo-filtro select:focus,
        .campo-filtro input:focus {
            border-color: var(--dourado-alexandria);
            box-shadow: 0 0 0 3px rgba(212,175,55,.15);
        }

        .dupla-selects {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .busca-com-icone {
            position: relative;
        }

        .busca-com-icone i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            font-size: 12px;
            color: var(--cinza-escuro);
        }

        .busca-com-icone input {
            padding-left: 34px;
        }

        .campo-botao-filtrar {
            display: flex;
        }

        .botao-filtrar {
            width: 100%;
            height: 38px;
            border: none;
            border-radius: 6px;
            background: var(--vinho-alexandria);
            color: #fff;
            font-size: 12.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: .2s;
        }

        .botao-filtrar:hover { background: var(--vinho-escuro); }

        /* ===== Barra de contagem/ordenação ===== */
        .barra-ordenacao {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .contador {
            color: var(--cinza-escuro);
            font-size: 12px;
        }

        .ordenar {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ordenar label {
            font-size: 12px;
            color: var(--cinza-escuro);
        }

        .ordenar select {
            height: 34px;
            border: 1px solid #dcd3ca;
            border-radius: 6px;
            padding: 0 10px;
            font-size: 12.5px;
            color: var(--texto-escuro);
            background: #fff;
            outline: none;
        }

        /* ===== Lista de questões ===== */
        .lista-questoes {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .linha-questao {
            display: grid;
            grid-template-columns: 110px 1.6fr 1fr 90px 1fr auto;
            align-items: center;
            gap: 14px;
            background: #fff;
            border: 1px solid var(--cinza-medio);
            border-radius: 8px;
            padding: 14px 18px;
            transition: box-shadow .2s, transform .2s;
        }

        .linha-questao:hover {
            box-shadow: 0 4px 14px rgba(75,44,20,.08);
            transform: translateY(-1px);
        }

        .badge-dificuldade {
            display: inline-flex;
            justify-content: center;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            width: fit-content;
        }
        .badge-dificuldade.facil   { color: var(--verde);    background: var(--verde-bg); }
        .badge-dificuldade.medio   { color: var(--laranja);  background: var(--laranja-bg); }
        .badge-dificuldade.dificil { color: var(--vermelho); background: var(--vermelho-bg); }

        .assunto-questao {
            font-size: 13px;
            font-weight: 600;
            color: var(--texto-escuro);
        }

        .banca-questao,
        .ano-questao,
        .tipo-questao {
            font-size: 12.5px;
            color: var(--cinza-escuro);
        }

        /* ===== Ações da questão (mesmo padrão de cursos_adm.php) ===== */
        .acoes-questao {
            display: flex;
            gap: 7px;
            justify-self: end;
        }

        .acao {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 32px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: .2s;
        }

        .acao-fazer {
            padding: 0 14px;
            color: #fff;
            background: var(--vinho-alexandria);
            border-color: var(--vinho-alexandria);
        }

        .acao-fazer:hover {
            background: var(--vinho-escuro);
            border-color: var(--vinho-escuro);
        }

        .acao-editar,
        .acao-excluir {
            width: 32px;
            border-color: #ddd5ce;
            color: #777;
            background: #fff;
        }

        .acao-editar:hover {
            color: var(--vinho-alexandria);
            border-color: var(--vinho-alexandria);
            background: #fbf5f2;
        }

        .acao-excluir:hover {
            color: #b52929;
            border-color: #efc9c9;
            background: #fff0f0;
        }

        .sem-resultados {
            display: none;
            padding: 45px;
            color: var(--cinza-escuro);
            text-align: center;
            background: #fff;
            border: 1px dashed var(--cinza-medio);
            border-radius: 8px;
        }

        @media (max-width: 991px) {
            .conteudo-adm { margin-left: 0; }
            .grade-filtro,
            .grade-filtro.linha-2 { grid-template-columns: 1fr; }
            .linha-questao {
                grid-template-columns: 1fr;
                justify-items: start;
            }
            .acoes-questao { justify-self: start; }
        }
    </style>
</head>
<body>
<?php
    include("../alexandria-frontend/includes/barraadm.html");
    include("../alexandria-frontend/includes/sidebaradm.html");
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

<!-- Modal de confirmação de exclusão -->
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

    /* ===== Ordenação ===== */
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

    /* ===== Confirmação de exclusão ===== */
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