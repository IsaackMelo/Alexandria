<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

$conta_logada = $_SESSION['conta'] ?? null;
if (!$conta_logada) {
    header('Location: ../auth/login.php');
    exit;
}

$slug_plano = $_GET['plano'] ?? '';
$metodo     = $_GET['metodo'] ?? '';
$nivel_atual = nivel_do_plano($conta_logada['plano'] ?? null);

$pedido_valido = isset($planos_alexandria[$slug_plano])
    && isset($metodos_pagamento[$metodo])
    && $planos_alexandria[$slug_plano]['nivel'] > $nivel_atual;

$troca = $pedido_valido
    ? calculo_troca_de_plano($conta_logada['plano'] ?? null, $slug_plano, $conta_logada['plano_desde'] ?? null)
    : null;

if ($pedido_valido && $troca['imediato']) {
    $_SESSION['conta']['plano'] = $slug_plano;
    $_SESSION['conta']['plano_desde'] = date('Y-m-d');
    unset($_SESSION['conta']['plano_agendado'], $_SESSION['conta']['plano_agendado_em']);
} elseif ($pedido_valido) {
    $_SESSION['conta']['plano_agendado'] = $slug_plano;
    $_SESSION['conta']['plano_agendado_em'] = $troca['inicio_acesso'];
}

$plano = $pedido_valido ? $planos_alexandria[$slug_plano] : null;
$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Pagamento Confirmado</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/checkout-checagem.css">
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
                Quer ter acesso aos nossos conteúdos?
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

    <main class="conteudo-principal">

        <div class="status-pagamento" id="statusPagamento" data-valido="<?= $pedido_valido ? '1' : '0' ?>">

            <div class="simbolo-status carregando" id="simboloStatus" role="status" aria-live="polite">
                <span class="anel"></span>
                <i class="fa-solid fa-check icone-status" aria-hidden="true"></i>
                <i class="fa-solid fa-xmark icone-status" aria-hidden="true"></i>
            </div>

            <h2 id="tituloStatus">Confirmando pagamento...</h2>

            <p id="textoStatus">
                <?= $pedido_valido
                    ? 'Estamos processando a compra do ' . $e($plano['nome']) . ' via ' . $e($metodos_pagamento[$metodo]['nome']) . '.'
                    : 'Estamos verificando os dados da sua compra.' ?>
            </p>

            <?php if ($pedido_valido && !$troca['imediato']): ?>
            <p class="aviso-agendado" id="avisoAgendado" hidden>
                <i class="fa-regular fa-calendar-check"></i>
                O <?= $e($plano['nome']) ?> começa em <?= $e(data_br($troca['inicio_acesso'])) ?>. Até lá, seu acesso segue no plano atual.
            </p>
            <?php endif; ?>

            <div class="acoes-status" id="acoesStatus" hidden>
                <a href="../comuns/visualizar-curso.php" class="btn-plataforma" id="botaoPlataforma" hidden>
                    Ir para a plataforma
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="descricao.php" class="btn-tentar-novamente" id="botaoTentar" hidden>
                    Tentar novamente
                </a>
            </div>

        </div>

    </main>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

    <script src="../js/paginas/checkout-checagem.js"></script>

</body>

</html>