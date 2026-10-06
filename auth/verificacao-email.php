<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

$redirecionar = destino_redirecionamento();
$qs_redirecionar = $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '';

$erro_email = '';
$email_digitado = trim($_POST['email'] ?? ($_GET['email'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conta_encontrada = null;
    foreach ($contas as $conta) {
        if (strcasecmp($conta['email'], $email_digitado) === 0) {
            $conta_encontrada = $conta;
            break;
        }
    }

    if ($conta_encontrada) {
        $_SESSION['recuperacao'] = ['email' => $conta_encontrada['email'], 'etapa' => 'codigo'];
        $parametros = ['email' => $conta_encontrada['email']];
        if ($redirecionar !== '') {
            $parametros['redirecionar'] = $redirecionar;
        }
        header('Location: verificacao-mensagem.php?' . http_build_query($parametros));
        exit;
    }

    $erro_email = 'Não encontramos nenhuma conta com esse e-mail.';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Alexandria - Confirmação</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/auth-verificacao-email.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>

<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <header class="banner-verificacao">

        <div class="banner-conteudo">

            <h1>Confirmar Email</h1>

            <p>Digite seu Email de confirmação, clique em confirmar (qualquer dúvida, acesse o portal do aluno).</p>

            <div class="banner-botoes">

                <a href="../web/plano.php" class="btn-garantir-vaga">Garantir Minha Vaga</a>

                <a href="../web/missao.php" class="btn-conhecer-plataforma">Conhecer a Missão</a>

            </div>

        </div>

    </header>

    <section class="secao-confirmacao">

        <h2>Confirmação de Email</h2>

        <h3>Informe seu Email</h3>

        <form method="post" action="verificacao-email.php<?= $qs_redirecionar ?>">

            <input type="email" name="email" class="input-email" placeholder="exemplo@gmail.com"
                   value="<?= htmlspecialchars($email_digitado, ENT_QUOTES, 'UTF-8') ?>" required>

            <?php if ($erro_email !== ''): ?>
            <p class="aviso-erro"><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($erro_email, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <br>

            <div class="button">
                <button type="submit" class="btn-confirmar">
                    Confirmar &nbsp;
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>

        </form>

    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

</body>
</html>