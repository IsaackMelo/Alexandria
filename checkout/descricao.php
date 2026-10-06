<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

$conta_logada = $_SESSION['conta'] ?? null;
$plano_atual  = $conta_logada['plano'] ?? null;
$nivel_atual  = nivel_do_plano($plano_atual);

if ($conta_logada && ($conta_logada['tipo'] ?? '') === 'ADM') {
    header('Location: ../comuns/visualizar-curso.php');
    exit;
}

if ($conta_logada && $nivel_atual >= 3) {
    header('Location: ../comuns/visualizar-curso.php');
    exit;
}

$planos_disponiveis = array_filter($planos_alexandria, fn($plano) => $plano['nivel'] > $nivel_atual);
$plano_selecionado  = $_GET['plano'] ?? array_key_last($planos_disponiveis);
if (!isset($planos_disponiveis[$plano_selecionado])) {
    $plano_selecionado = array_key_last($planos_disponiveis);
}
$metodo_selecionado = isset($metodos_pagamento[$_GET['metodo'] ?? '']) ? $_GET['metodo'] : 'cartao';
$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

// Regra de troca: até 7 dias paga só a diferença; depois, valor cheio com acesso adiado
$troca = calculo_troca_de_plano($plano_atual, $plano_selecionado, $conta_logada['plano_desde'] ?? null);

// Volta para esta tela (com o plano e o método escolhidos) depois de entrar ou criar conta
$voltar_para = '../checkout/descricao.php?' . http_build_query(['plano' => $plano_selecionado, 'metodo' => $metodo_selecionado]);
$qs_voltar   = '?redirecionar=' . urlencode($voltar_para);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Finalizar Compra</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/checkout-descricao.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>

<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <header class="banner-verificacao">

        <div class="banner-conteudo">

            <h1>Planos</h1>

            <p>
                Quer ter acesso aos nossos contúdos?
                Acompanhe nossas tabelas de planos!
            </p>

            <div class="banner-botoes">

                <a href="../web/plano.php" class="btn-garantir-vaga">
                    Garantir Minha Vaga
                </a>

                <a href="../web/missao.php" class="btn-conhecer-plataforma">
                    Conhecer a Missão
                </a>

            </div>

        </div>

    </header>

    <section class="secao-checkout">

        <div class="checkout-grid">

            <div class="checkout-conteudo">

                <h2 class="checkout-etapa-titulo primeira-etapa">
                    1. Escolher o plano
                </h2>

                <div class="planos-mini-grid">

                    <?php foreach ($planos_alexandria as $slug_plano => $plano):
                        $bloqueado = $plano['nivel'] <= $nivel_atual;
                        $classes = 'plano-mini-card' . ($bloqueado ? ' bloqueado' : '') . ($slug_plano === $plano_selecionado ? ' selecionado' : '');
                    ?>
                    <div class="<?= $classes ?>"
                        data-slug="<?= $e($slug_plano) ?>"
                        data-nome="<?= $e($plano['nome']) ?>"
                        data-preco="<?= $e(preco_formatado($plano['preco'])) ?>"
                        data-bloqueado="<?= $bloqueado ? '1' : '0' ?>"
                        data-itens="<?= $e(implode(';', $plano['itens'])) ?>">

                        <h3 class="plano-mini-titulo"><?= $e($plano['curto']) ?></h3>

                        <p class="plano-mini-preco"><?= $e(preco_formatado($plano['preco'])) ?></p>

                        <p class="plano-mini-periodo">/Mês</p>

                        <?php if ($bloqueado): ?>
                        <p class="plano-mini-aviso">
                            <?= $plano['slug'] === $plano_atual ? 'Este já é o seu plano' : 'Inferior ao seu plano atual' ?>
                        </p>
                        <?php endif; ?>

                        <hr class="plano-mini-divisor">

                        <ul class="plano-mini-lista">
                            <?php foreach ($plano['itens'] as $numero => $item): ?>
                            <li>
                                <span class="plano-mini-numero <?= $plano['nivel'] === 2 ? 'numero-dourado' : 'numero-vinho' ?>">
                                    <?= str_pad((string) ($numero + 1), 2, '0', STR_PAD_LEFT) ?>
                                </span>
                                <?= $e($item) ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <?php endforeach; ?>

                </div>

                <h2 class="checkout-etapa-titulo">
                    2. Acessar ou Criar Conta
                </h2>

                <div class="conta-opcoes">

                    <?php if ($conta_logada): ?>

                    <div class="conta-logada">
                        <span class="conta-avatar"><i class="fa-solid fa-user"></i></span>
                        <div class="conta-dados">
                            <strong><?= $e($conta_logada['nome']) ?></strong>
                            <span><?= $e($conta_logada['email']) ?></span>
                            <span class="conta-plano">
                                <?= $plano_atual ? 'Plano atual: ' . $e($planos_alexandria[$plano_atual]['curto'] ?? $plano_atual) : 'Nenhum plano ativo' ?>
                            </span>
                        </div>
                        <a href="../auth/logout.php" class="btn-trocar-conta">Sair</a>
                    </div>

                    <?php else: ?>

                    <div class="conta-linha">
                        <p>Já tem conta?</p>
                        <a href="../auth/login.php<?= $qs_voltar ?>" class="btn-entrar">Entrar</a>
                    </div>

                    <div class="conta-linha">
                        <p>Novo por aqui?</p>
                        <a href="../auth/cadastro.php<?= $qs_voltar ?>" class="btn-criar-conta">Criar Conta</a>
                    </div>

                    <p class="aviso-conta" id="avisoConta" hidden>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Entre ou crie uma conta para continuar a compra.
                    </p>

                    <?php endif; ?>

                </div>

                <h2 class="checkout-etapa-titulo">
                    3. Escolher Método de Pagamento
                </h2>

                <div class="pagamento-grid">
                    <?php foreach ($metodos_pagamento as $slug_metodo => $metodo): ?>
                    <div class="pagamento-card<?= $slug_metodo === $metodo_selecionado ? ' selecionado' : '' ?>" data-metodo="<?= $e($slug_metodo) ?>">
                        <i class="<?= $e($metodo['icone']) ?>"></i>
                        <span><?= $e($metodo['nome']) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <aside class="resumo-wrapper">

                <div class="resumo-compra">

                    <h2>
                        Descrição da compra
                    </h2>

                    <div class="resumo-plano">
                        <span id="resumo-nome-plano"><?= $e($planos_alexandria[$plano_selecionado]['nome']) ?></span>
                        <span id="resumo-preco-plano"><?= $e(preco_formatado($planos_alexandria[$plano_selecionado]['preco'])) ?></span>
                    </div>

                    <ul class="resumo-itens" id="resumo-lista-itens">
                        <?php foreach ($planos_alexandria[$plano_selecionado]['itens'] as $item): ?>
                        <li><?= $e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if ($troca['tipo'] !== 'novo'): ?>
                    <div class="resumo-regra">
                        <?php if ($troca['tipo'] === 'diferenca'): ?>
                        <p>
                            <i class="fa-solid fa-circle-info"></i>
                            Você contratou o plano atual há <?= (int) $troca['dias_de_plano'] ?> dia(s).
                            Como ainda está dentro dos 7 dias, paga apenas a diferença de valor
                            (<?= $e(preco_formatado($troca['valor_cheio'])) ?> &minus; <?= $e(preco_formatado($planos_alexandria[$plano_atual]['preco'])) ?>)
                            e o novo plano vale na hora.
                        </p>
                        <?php else: ?>
                        <p>
                            <i class="fa-solid fa-circle-info"></i>
                            Já se passaram <?= (int) $troca['dias_de_plano'] ?> dias desde a contratação do plano atual,
                            então a troca sai pelo valor cheio e o novo plano começa em
                            <?= $e(data_br($troca['inicio_acesso'])) ?>, quando termina o período atual.
                        </p>
                        <?php endif; ?>
                    </div>

                    <div class="resumo-linha-desconto">
                        <span>Valor do plano</span>
                        <span><?= $e(preco_formatado($troca['valor_cheio'])) ?></span>
                    </div>

                    <?php if ($troca['tipo'] === 'diferenca'): ?>
                    <div class="resumo-linha-desconto">
                        <span>Crédito do plano atual</span>
                        <span>&minus; <?= $e(preco_formatado($planos_alexandria[$plano_atual]['preco'])) ?></span>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

                    <div class="resumo-total">
                        <span>Total:</span>
                        <span id="resumo-total-valor"><?= $e(preco_formatado($troca['valor'])) ?></span>
                    </div>

                </div>

                <form action="pagamento.php" method="get" id="formCheckout" class="btn-descri">
                    <input type="hidden" name="plano" id="campoPlano" value="<?= $e($plano_selecionado) ?>">
                    <input type="hidden" name="metodo" id="campoMetodo" value="<?= $e($metodo_selecionado) ?>">

                    <button type="submit" class="btn-confirmar" data-logado="<?= $conta_logada ? '1' : '0' ?>">
                        Continuar &nbsp;
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

            </aside>

        </div>

    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

    <script src="../js/paginas/checkout-descricao.js"></script>

</body>

</html>