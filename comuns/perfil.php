<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

if (empty($_SESSION['conta']['id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$conta = null;
foreach ($contas as $item) {
    if ((int) $item['id'] === (int) $_SESSION['conta']['id']) {
        $conta = $item;
        break;
    }
}

if ($conta === null) {
    session_destroy();
    header('Location: ../auth/login.php');
    exit;
}

$isAdm = $conta['tipo'] === 'ADM';

$nomes_planos = ['basico' => 'Básico', 'avancado' => 'Avançado', 'premium' => 'Premium'];
$rotulo_funcao = $isAdm ? 'Administrador' : 'Estudante';
$rotulo_tipo_conta = $rotulo_funcao;
if (!$isAdm && !empty($conta['plano'])) {
    $rotulo_tipo_conta .= ' · Plano ' . ($nomes_planos[$conta['plano']] ?? ucfirst($conta['plano']));
}

function formatar_data_curta(?string $data): string {
    $dt = $data ? DateTime::createFromFormat('Y-m-d', $data) : false;
    return $dt ? $dt->format('d/m/Y') : '—';
}

function formatar_data_extenso(?string $data): string {
    $dt = $data ? DateTime::createFromFormat('Y-m-d', $data) : false;
    if (!$dt) {
        return '—';
    }
    $meses = [1 => 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
              'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
    return $dt->format('j') . ' de ' . $meses[(int) $dt->format('n')] . ' de ' . $dt->format('Y');
}

$cursos_em_andamento  = 0;
$questoes_respondidas = 0;
$simulados_realizados = 0;
if (!$isAdm) {
    $cursos_em_andamento = count(array_filter(
        cursos_iniciados_da_conta((int) $conta['id']),
        fn($curso) => $curso['progresso'] < 100
    ));
    $questoes_respondidas = (int) ($conta['questoes_respondidas'] ?? 0);
    $simulados_realizados = (int) ($conta['simulados_realizados'] ?? 0);
}

// ---------------------------------------------------------------
// Direito de arrependimento (art. 49 do CDC): 7 dias após a compra
// ---------------------------------------------------------------
$plano_desde       = $_SESSION['conta']['plano_desde'] ?? ($conta['plano_desde'] ?? null);
$plano_ativo       = $_SESSION['conta']['plano'] ?? ($conta['plano'] ?? null);
$dias_desde_compra = null;
$prazo_devolucao   = null;
if ($plano_desde) {
    $inicio = DateTime::createFromFormat('Y-m-d', $plano_desde);
    if ($inicio) {
        $dias_desde_compra = (int) $inicio->diff(new DateTime('today'))->days;
        $prazo_devolucao   = (clone $inicio)->modify('+7 days')->format('Y-m-d');
    }
}
$pode_pedir_devolucao = !$isAdm && $plano_ativo && $dias_desde_compra !== null && $dias_desde_compra <= 7;
$devolucao_pedida     = $_SESSION['devolucao'] ?? null;

if (!$isAdm && ($_POST['acao'] ?? '') === 'pedir-devolucao' && $pode_pedir_devolucao) {
    $_SESSION['devolucao'] = [
        'plano'  => $plano_ativo,
        'valor'  => $planos_alexandria[$plano_ativo]['preco'] ?? 0,
        'data'   => date('Y-m-d'),
        'motivo' => trim((string) ($_POST['motivo'] ?? '')),
    ];
    unset($_SESSION['conta']['plano'], $_SESSION['conta']['plano_desde']);
    header('Location: perfil.php?devolucao=ok');
    exit;
}

// ---------------------------------------------------------------
// Dados dos painéis
// ---------------------------------------------------------------
$meus_cursos = $isAdm ? [] : cursos_iniciados_da_conta((int) $conta['id']);
$progresso_medio = $meus_cursos
    ? (int) round(array_sum(array_column($meus_cursos, 'progresso')) / count($meus_cursos))
    : 0;
$cursos_concluidos = count(array_filter($meus_cursos, fn($curso) => $curso['progresso'] >= 100));

$painel_adm = [];
if ($isAdm) {
    $alunos = array_filter($contas, fn($c) => ($c['tipo'] ?? '') === 'USER');
    $por_plano = [];
    foreach ($planos_alexandria as $slug => $plano) {
        $assinantes = array_filter($alunos, fn($c) => ($c['plano'] ?? '') === $slug);
        $por_plano[$slug] = [
            'nome'        => $plano['curto'],
            'assinantes'  => count($assinantes),
            'receita'     => count($assinantes) * $plano['preco'],
        ];
    }
    $sem_plano = count(array_filter($alunos, fn($c) => empty($c['plano'])));

    // Assinaturas por mês, a partir de 'plano_desde'
    $por_mes = [];
    foreach ($alunos as $aluno) {
        if (empty($aluno['plano_desde'])) {
            continue;
        }
        $dt = DateTime::createFromFormat('Y-m-d', $aluno['plano_desde']);
        if (!$dt) {
            continue;
        }
        $chave = $dt->format('Y-m');
        $por_mes[$chave] = ($por_mes[$chave] ?? 0) + 1;
    }
    ksort($por_mes);

    // Cursos com mais alunos
    $ranking_cursos = $cursos;
    usort($ranking_cursos, fn($a, $b) => ($b['alunos'] ?? 0) <=> ($a['alunos'] ?? 0));

    $painel_adm = [
        'total_alunos'  => count($alunos),
        'por_plano'     => $por_plano,
        'sem_plano'     => $sem_plano,
        'receita_total' => array_sum(array_column($por_plano, 'receita')),
        'por_mes'       => $por_mes,
        'ranking'       => array_slice($ranking_cursos, 0, 5),
        'assinantes'    => count($alunos) - $sem_plano,
    ];
}

$meses_curtos = [1 => 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];

$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Alexandria – Meu Perfil</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-perfil.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php include __DIR__ . '/../includes/sidebar.php'; ?>

    <div class="container-principal">

        <?php include __DIR__ . '/../includes/topbar.php'; ?>

        <div class="conteudo">
            <div class="secao-esquerda">
                <div class="cartao-perfil">
                    <div class="avatar-perfil">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="nome-perfil"><?= $e($conta['nome']) ?></div>
                    <div class="funcao-perfil"><?= $e($rotulo_funcao) ?></div>
                    <a href="../auth/confirmacao-senha.php">
                        <button class="botao-editar-perfil">Editar senha</button>
                    </a>

                    <div class="estatisticas-perfil">
                        <div class="item-estatistica">
                            <img src="../imagens/datas (1) 3.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Membro desde</div>
                                <div class="valor-estatistica"><?= $e(formatar_data_extenso($conta['membro_desde'] ?? null)) ?></div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="../imagens/escudo 2.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Tipo de conta</div>
                                <div class="valor-estatistica"><?= $e($rotulo_tipo_conta) ?></div>
                            </div>
                        </div>
                        <?php if (!$isAdm): ?>
                        <div class="item-estatistica">
                            <img src="../imagens/livro 3.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Cursos em andamento</div>
                                <div class="valor-estatistica"><?= $cursos_em_andamento ?></div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="../imagens/alvo-com-flecha 2.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Questões respondidas</div>
                                <div class="valor-estatistica"><?= number_format($questoes_respondidas, 0, ',', '.') ?></div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="../imagens/medalha 2.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Simulados realizados</div>
                                <div class="valor-estatistica"><?= number_format($simulados_realizados, 0, ',', '.') ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="secao-direita">
                <div class="cartao-informacao">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-user"></i>
                        Informações Pessoais
                    </div>
                    <div class="subtitulo-cartao-informacao">Atualize seus dados pessoais</div>

                    <div class="grade-informacoes">
                        <div class="campo-informacao">
                            <label class="rotulo-campo-informacao" for="campoNome">Nome completo</label>
                            <div class="valor-campo-informacao" data-exibicao><?= $e($conta['nome']) ?></div>
                            <input class="entrada-campo-informacao" data-edicao hidden
                                   id="campoNome" type="text" name="nome" value="<?= $e($conta['nome']) ?>" autocomplete="name">
                        </div>
                        <div class="campo-informacao">
                            <label class="rotulo-campo-informacao" for="campoTelefone">Telefone</label>
                            <div class="valor-campo-informacao" data-exibicao><?= $e($conta['telefone'] ?? '—') ?></div>
                            <input class="entrada-campo-informacao" data-edicao hidden
                                   id="campoTelefone" type="tel" name="telefone" value="<?= $e($conta['telefone'] ?? '') ?>" autocomplete="tel">
                        </div>
                    </div>

                    <div class="campo-informacao" style="margin-bottom: 20px;">
                        <label class="rotulo-campo-informacao" for="campoEmail">E-mail</label>
                        <div class="valor-campo-informacao" data-exibicao><?= $e($conta['email']) ?></div>
                        <input class="entrada-campo-informacao" data-edicao hidden
                               id="campoEmail" type="email" name="email" value="<?= $e($conta['email']) ?>" autocomplete="email">
                    </div>

                    <div class="campo-informacao" style="margin-bottom: 20px;">
                        <label class="rotulo-campo-informacao" for="campoNascimento">Data de nascimento</label>
                        <div class="valor-campo-informacao" data-exibicao><?= $e(formatar_data_curta($conta['data_nascimento'] ?? null)) ?></div>
                        <input class="entrada-campo-informacao" data-edicao hidden
                               id="campoNascimento" type="date" name="data_nascimento" value="<?= $e($conta['data_nascimento'] ?? '') ?>">
                    </div>
                </div>


                <?php if (!$isAdm): ?>
                <div class="cartao-informacao painel">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-chart-line"></i>
                        Minha evolução
                    </div>
                    <div class="subtitulo-cartao-informacao">Acompanhe seu progresso na plataforma</div>

                    <div class="painel-numeros">
                        <div class="painel-numero">
                            <strong><?= count($meus_cursos) ?></strong>
                            <span>Cursos iniciados</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= $cursos_concluidos ?></strong>
                            <span>Cursos concluídos</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= $progresso_medio ?>%</strong>
                            <span>Progresso médio</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= number_format($questoes_respondidas, 0, ',', '.') ?></strong>
                            <span>Questões respondidas</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= number_format($simulados_realizados, 0, ',', '.') ?></strong>
                            <span>Simulados realizados</span>
                        </div>
                    </div>

                    <?php if ($meus_cursos): ?>
                    <h4 class="painel-subtitulo">Progresso por curso</h4>
                    <ul class="painel-barras">
                        <?php foreach ($meus_cursos as $curso): ?>
                        <li>
                            <div class="barra-topo">
                                <span><?= $e($curso['titulo']) ?></span>
                                <strong><?= (int) $curso['progresso'] ?>%</strong>
                            </div>
                            <div class="barra-trilho">
                                <span style="width: <?= (int) $curso['progresso'] ?>%;"></span>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?>
                    <p class="painel-vazio">Você ainda não iniciou nenhum curso. <a href="visualizar-curso.php">Ver cursos disponíveis</a>.</p>
                    <?php endif; ?>
                </div>

                <div class="cartao-informacao painel">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-rotate-left"></i>
                        Assinatura e devolução
                    </div>
                    <div class="subtitulo-cartao-informacao">Direito de arrependimento (art. 49 do Código de Defesa do Consumidor)</div>

                    <?php if (isset($_GET['devolucao'])): ?>
                    <p class="aviso-sucesso"><i class="fas fa-circle-check"></i> Pedido de devolução registrado. O estorno aparece na fatura em até 7 dias úteis.</p>
                    <?php endif; ?>

                    <?php if ($devolucao_pedida): ?>
                    <div class="bloco-devolucao">
                        <p><strong>Devolução solicitada</strong> em <?= $e(formatar_data_curta($devolucao_pedida['data'])) ?>.</p>
                        <p>Plano <?= $e($planos_alexandria[$devolucao_pedida['plano']]['curto'] ?? $devolucao_pedida['plano']) ?> · valor a estornar: <?= $e(preco_formatado((float) $devolucao_pedida['valor'])) ?>.</p>
                        <p>O acesso ao conteúdo pago foi encerrado.</p>
                    </div>

                    <?php elseif (!$plano_ativo): ?>
                    <p class="painel-vazio">Você não tem um plano ativo no momento. <a href="../web/plano.php">Ver planos</a>.</p>

                    <?php elseif ($pode_pedir_devolucao): ?>
                    <div class="bloco-devolucao">
                        <p>
                            Você contratou o Plano <?= $e($planos_alexandria[$plano_ativo]['curto'] ?? $plano_ativo) ?>
                            em <?= $e(formatar_data_curta($plano_desde)) ?>, há <?= (int) $dias_desde_compra ?> dia(s).
                            Dentro dos 7 dias, você pode desistir da compra e receber o valor de volta,
                            sem precisar justificar. O prazo vai até <?= $e(formatar_data_curta($prazo_devolucao)) ?>.
                        </p>
                    </div>

                    <form method="post" action="perfil.php" class="form-devolucao">
                        <input type="hidden" name="acao" value="pedir-devolucao">
                        <label for="motivoDevolucao">Motivo (opcional)</label>
                        <textarea id="motivoDevolucao" name="motivo" rows="3" placeholder="Conte o que não atendeu (opcional)"></textarea>
                        <button type="submit" class="botao-devolucao">
                            <i class="fas fa-rotate-left"></i> Pedir devolução
                        </button>
                    </form>

                    <?php else: ?>
                    <div class="bloco-devolucao">
                        <p>
                            O prazo de arrependimento terminou em <?= $e(formatar_data_curta($prazo_devolucao)) ?>
                            (compra feita em <?= $e(formatar_data_curta($plano_desde)) ?>, há <?= (int) $dias_desde_compra ?> dias).
                            Para cancelar a renovação, fale com o suporte pela <a href="../web/contato.php">página de contato</a>.
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ($isAdm): ?>
                <div class="cartao-informacao painel">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-chart-pie"></i>
                        Planos assinados
                    </div>
                    <div class="subtitulo-cartao-informacao">Visão geral das assinaturas da plataforma</div>

                    <div class="painel-numeros">
                        <div class="painel-numero">
                            <strong><?= $painel_adm['total_alunos'] ?></strong>
                            <span>Alunos cadastrados</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= $painel_adm['assinantes'] ?></strong>
                            <span>Com plano ativo</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= $painel_adm['sem_plano'] ?></strong>
                            <span>Sem plano</span>
                        </div>
                        <div class="painel-numero">
                            <strong><?= $e(preco_formatado((float) $painel_adm['receita_total'])) ?></strong>
                            <span>Receita mensal</span>
                        </div>
                    </div>

                    <h4 class="painel-subtitulo">Assinantes por plano</h4>
                    <ul class="painel-barras">
                        <?php $maior = max(1, max(array_column($painel_adm['por_plano'], 'assinantes'))); ?>
                        <?php foreach ($painel_adm['por_plano'] as $linha): ?>
                        <li>
                            <div class="barra-topo">
                                <span>Plano <?= $e($linha['nome']) ?></span>
                                <strong><?= (int) $linha['assinantes'] ?> · <?= $e(preco_formatado((float) $linha['receita'])) ?>/mês</strong>
                            </div>
                            <div class="barra-trilho">
                                <span style="width: <?= (int) round($linha['assinantes'] / $maior * 100) ?>%;"></span>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <h4 class="painel-subtitulo">Novas assinaturas por mês</h4>
                    <?php if ($painel_adm['por_mes']): ?>
                    <div class="grafico-colunas">
                        <?php $topo = max(1, max($painel_adm['por_mes'])); ?>
                        <?php foreach ($painel_adm['por_mes'] as $mes => $quantidade):
                            [$ano, $numero_mes] = explode('-', $mes); ?>
                        <div class="coluna" title="<?= (int) $quantidade ?> assinatura(s)">
                            <span class="valor-coluna"><?= (int) $quantidade ?></span>
                            <span class="barra-coluna" style="height: <?= max(8, (int) round($quantidade / $topo * 100)) ?>%;"></span>
                            <span class="rotulo-coluna"><?= $e($meses_curtos[(int) $numero_mes] . '/' . substr($ano, 2)) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p class="painel-vazio">Ainda não há assinaturas registradas.</p>
                    <?php endif; ?>

                    <h4 class="painel-subtitulo">Cursos com mais alunos</h4>
                    <ul class="painel-barras">
                        <?php $topo_curso = max(1, (int) ($painel_adm['ranking'][0]['alunos'] ?? 1)); ?>
                        <?php foreach ($painel_adm['ranking'] as $curso): ?>
                        <li>
                            <div class="barra-topo">
                                <span><?= $e($curso['titulo']) ?></span>
                                <strong><?= (int) $curso['alunos'] ?> aluno(s)</strong>
                            </div>
                            <div class="barra-trilho">
                                <span style="width: <?= (int) round(($curso['alunos'] ?? 0) / $topo_curso * 100) ?>%;"></span>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="cartao-informacao">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-lock"></i>
                        Privacidade
                    </div>

                    <div class="secao-privacidade">
                        <div class="titulo-privacidade">
                            <i class="fas fa-shield-alt"></i>
                            Sua privacidade é importante.
                        </div>
                        <div class="texto-privacidade">
                            Seus dados estão protegidos.
                        </div>
                    </div>

                    <div class="grupo-botoes" id="botoesExibicao">
                        <button type="button" class="botao-salvar" id="botaoFazerAlteracao">
                            <i class="fas fa-pen"></i> Fazer alteração
                        </button>
                    </div>

                    <div class="grupo-botoes" id="botoesEdicao" hidden>
                        <button type="button" class="botao-cancelar" id="botaoCancelar">Cancelar</button>
                        <button type="button" class="botao-salvar" id="botaoSalvar">Salvar alterações</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/paginas/comuns-perfil.js"></script>
</body>
</html>