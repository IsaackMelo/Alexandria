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

$nivel_atual = nivel_do_plano($conta_logada['plano'] ?? null);

$slug_plano = $_GET['plano'] ?? '';
if (!isset($planos_alexandria[$slug_plano]) || $planos_alexandria[$slug_plano]['nivel'] <= $nivel_atual) {
    header('Location: descricao.php');
    exit;
}

$plano  = $planos_alexandria[$slug_plano];
$metodo = isset($metodos_pagamento[$_GET['metodo'] ?? '']) ? $_GET['metodo'] : 'cartao';
$dados_metodo = $metodos_pagamento[$metodo];
$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

$troca = calculo_troca_de_plano($conta_logada['plano'] ?? null, $slug_plano, $conta_logada['plano_desde'] ?? null);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Confirmação do Pagamento</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/checkout-pagamento.css">
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

                <h2 class="titulo-secao-simples">
                    Confirmação do pagamento
                </h2>

                <div class="metodo-escolhido">
                    <i class="<?= $e($dados_metodo['icone']) ?>"></i>
                    <div>
                        <strong><?= $e($dados_metodo['nome']) ?></strong>
                        <span>Método escolhido na etapa anterior</span>
                    </div>
                    <a href="descricao.php?plano=<?= $e($slug_plano) ?>&amp;metodo=<?= $e($metodo) ?>" class="link-voltar-metodo">Alterar</a>
                </div>

                <?php if ($metodo === 'cartao'): ?>
                <form class="cartao-form">
                    <div class="form-grupo">
                        <label for="nome-titular">Nome do titular</label>
                        <input type="text" id="nome-titular" class="input-cartao" placeholder="Digite como está no cartão">
                    </div>

                    <div class="form-grupo">
                        <label for="numero-cartao">Número do cartão</label>
                        <input type="text" id="numero-cartao" class="input-cartao" placeholder="0000 0000 0000 0000" inputmode="numeric">
                    </div>

                    <div class="form-grupo-dupla">
                        <div class="form-grupo">
                            <label for="validade-cartao">Validade</label>
                            <input type="text" id="validade-cartao" class="input-cartao" placeholder="MM / AA">
                        </div>

                        <div class="form-grupo">
                            <label for="cvv-cartao">Código de segurança</label>
                            <input type="text" id="cvv-cartao" class="input-cartao" placeholder="CVV" inputmode="numeric" maxlength="4">
                        </div>
                    </div>
                </form>

                <?php elseif ($metodo === 'pix'): ?>
                <div class="instrucao-pagamento">
                    <p>Abra o app do seu banco, escolha pagar com PIX e use o código abaixo. O acesso é liberado assim que o pagamento é identificado.</p>
                    <div class="codigo-pix" id="codigoPix">00020126alexandria<?= $e($slug_plano) ?>5204000053039865802BR6009SAO PAULO62070503***6304ABCD</div>
                    <button type="button" class="btn-copiar" data-copiar="codigoPix">
                        <i class="fa-regular fa-copy"></i> Copiar código
                    </button>
                </div>

                <?php else: ?>
                <div class="instrucao-pagamento">
                    <p>O boleto vence em 3 dias úteis. Após o pagamento, a compensação pode levar até 2 dias úteis.</p>
                    <div class="codigo-pix" id="linhaBoleto">34191.79001 01043.510047 91020.150008 1 96610000<?= $e(number_format($plano['preco'] * 100, 0, '', '')) ?></div>
                    <button type="button" class="btn-copiar" data-copiar="linhaBoleto">
                        <i class="fa-regular fa-copy"></i> Copiar linha digitável
                    </button>
                </div>
                <?php endif; ?>

                <div class="privacidade-box">

                    <i class="fa-solid fa-lock"></i>

                    <div>

                        <h3>Privacidade</h3>

                        <p>
                            Seus dados estão protegidos.
                        </p>

                    </div>

                </div>

            </div>

            <aside class="resumo-wrapper">

                <div class="resumo-compra">

                    <h2>
                        Descrição da compra
                    </h2>

                    <div class="resumo-plano">
                        <span><?= $e($plano['nome']) ?></span>
                        <span><?= $e(preco_formatado($plano['preco'])) ?></span>
                    </div>

                    <ul class="resumo-itens">
                        <?php foreach ($plano['itens'] as $item): ?>
                        <li><?= $e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="resumo-pagamento-metodo">
                        <span>Pagamento:</span>
                        <span><?= $e($dados_metodo['nome']) ?></span>
                    </div>

                    <?php if ($troca['tipo'] === 'diferenca'): ?>
                    <div class="resumo-regra">
                        <p><i class="fa-solid fa-circle-info"></i> Troca dentro de 7 dias: você paga apenas a diferença e o novo plano vale na hora.</p>
                    </div>
                    <?php elseif ($troca['tipo'] === 'agendado'): ?>
                    <div class="resumo-regra">
                        <p><i class="fa-solid fa-circle-info"></i> Valor cheio: o novo plano começa em <?= $e(data_br($troca['inicio_acesso'])) ?>, ao fim do período atual.</p>
                    </div>
                    <?php endif; ?>

                    <div class="resumo-total">
                        <span>Total:</span>
                        <span><?= $e(preco_formatado($troca['valor'])) ?></span>
                    </div>

                </div>

                <a href="checagem.php?plano=<?= $e($slug_plano) ?>&amp;metodo=<?= $e($metodo) ?>" class="btn-descri">
                    <button type="button" class="btn-confirmar">
                        Finalizar pagamento &nbsp;
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </a>

            </aside>

        </div>

    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

    <script src="../js/paginas/checkout-pagamento.js"></script>

</body>

</html>