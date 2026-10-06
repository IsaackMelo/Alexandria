<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

$redirecionar = destino_redirecionamento();
$qs_redirecionar = $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '';

// Projeto sem envio de e-mail: o código de verificação é fixo.
const CODIGO_VERIFICACAO = '12345';

$email_recuperacao = $_GET['email'] ?? ($_SESSION['recuperacao']['email'] ?? '');
if ($email_recuperacao === '') {
    header('Location: verificacao-email.php' . $qs_redirecionar);
    exit;
}

$erro_codigo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = preg_replace('/\\D/', '', implode('', (array) ($_POST['codigo'] ?? [])));

    if ($codigo === CODIGO_VERIFICACAO) {
        $_SESSION['recuperacao'] = ['email' => $email_recuperacao, 'etapa' => 'senha'];
        $parametros = ['email' => $email_recuperacao];
        if ($redirecionar !== '') {
            $parametros['redirecionar'] = $redirecionar;
        }
        header('Location: confirmacao-senha.php?' . http_build_query($parametros));
        exit;
    }

    $erro_codigo = 'Código incorreto. Confira os números e tente de novo.';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Confirmação de código</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/auth-verificacao-mensagem.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>

<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <header class="banner-verificacao">

        <div class="banner-conteudo">

            <h1>Confirmação de Email</h1>

            <p>
                Para prosseguir com o seu acesso à conta, por favor, coloque o código de seu email.
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

    <section class="secao-confirmacao">

        <h2>Confirmação de Email</h2>

        <h3>Informe codigo de confirmação</h3>

        <p class="dica-codigo">
            Enviamos um código para <strong><?= htmlspecialchars($email_recuperacao, ENT_QUOTES, 'UTF-8') ?></strong>.
            Nesta demonstração, use o código <strong><?= CODIGO_VERIFICACAO ?></strong>.
        </p>

        <form method="post" action="verificacao-mensagem.php?<?= htmlspecialchars(http_build_query(array_filter(['email' => $email_recuperacao, 'redirecionar' => $redirecionar])), ENT_QUOTES, 'UTF-8') ?>">

            <div class="codigo-caixinhas">
                <input type="text" name="codigo[]" class="input-codigo" maxlength="1" inputmode="numeric" required>
                <input type="text" name="codigo[]" class="input-codigo" maxlength="1" inputmode="numeric" required>
                <input type="text" name="codigo[]" class="input-codigo" maxlength="1" inputmode="numeric" required>
                <input type="text" name="codigo[]" class="input-codigo" maxlength="1" inputmode="numeric" required>
                <input type="text" name="codigo[]" class="input-codigo" maxlength="1" inputmode="numeric" required>
            </div>

            <?php if ($erro_codigo !== ''): ?>
            <p class="aviso-erro"><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($erro_codigo, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <button type="submit" class="btn-verificar">
                Verificar
            </button>

        </form>

    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

    <script src="../js/paginas/auth-verificacao-mensagem.js"></script>

</body>
</html>