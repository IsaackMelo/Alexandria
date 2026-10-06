<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/dados.php';

$redirecionar = destino_redirecionamento();
$qs_redirecionar = $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '';

$email_recuperacao = $_GET['email'] ?? ($_SESSION['recuperacao']['email'] ?? '');
if ($email_recuperacao === '') {
    header('Location: verificacao-email.php' . $qs_redirecionar);
    exit;
}

$erros_senha = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha      = (string) ($_POST['senha'] ?? '');
    $confirmada = (string) ($_POST['confirmacao'] ?? '');

    if (mb_strlen($senha) < 8) {
        $erros_senha[] = 'A senha precisa ter pelo menos 8 caracteres.';
    }
    if (!preg_match('/[A-ZÀ-Ý]/u', $senha)) {
        $erros_senha[] = 'A senha precisa ter pelo menos uma letra maiúscula.';
    }
    if (!preg_match('/[a-zà-ÿ]/u', $senha)) {
        $erros_senha[] = 'A senha precisa ter pelo menos uma letra minúscula.';
    }
    if (!preg_match('/\d/', $senha)) {
        $erros_senha[] = 'A senha precisa ter pelo menos um número.';
    }
    if (!preg_match('/[^\p{L}\p{N}]/u', $senha)) {
        $erros_senha[] = 'A senha precisa ter pelo menos um caractere especial.';
    }
    if ($senha !== $confirmada) {
        $erros_senha[] = 'A confirmação precisa ser igual à senha.';
    }

    if (!$erros_senha) {
        // Projeto sem banco de dados: a nova senha vale só para esta sessão.
        foreach ($contas as $conta) {
            if (strcasecmp($conta['email'], $email_recuperacao) === 0) {
                unset($conta['senha']);
                $_SESSION['conta'] = $conta;
                break;
            }
        }
        unset($_SESSION['recuperacao']);

        $destino = $redirecionar !== '' ? $redirecionar : '../comuns/visualizar-curso.php';
        if ($redirecionar === '' && empty($_SESSION['conta']['plano'])) {
            $destino = '../web/plano.php';
        }
        if (($_SESSION['conta']['tipo'] ?? '') === 'ADM') {
            $destino = '../comuns/visualizar-curso.php';
        }

        header('Location: ' . $destino);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Troca de Senha</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/auth-confirmacao-senha.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>

<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <header class="banner-verificacao">
        <div class="banner-conteudo">

            <h1>Senha</h1>

            <p>
                Digite sua senha e depois, clique em confirmar
                (qualquer dúvida, acesse o portal do aluno).
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

        <h2>Defina sua Senha</h2>

        <p class="dica-codigo">
            Definindo uma nova senha para <strong><?= htmlspecialchars($email_recuperacao, ENT_QUOTES, 'UTF-8') ?></strong>.
        </p>

        <form method="post" id="formSenha" action="confirmacao-senha.php?<?= htmlspecialchars(http_build_query(array_filter(['email' => $email_recuperacao, 'redirecionar' => $redirecionar])), ENT_QUOTES, 'UTF-8') ?>">

            <h3>Senha</h3>
            <input type="password" name="senha" id="campoSenha" class="input-email" placeholder="Exempl#1" required>

            <ul class="requisitos-senha" id="requisitosSenha">
                <li data-regra="tamanho"><i class="fa-regular fa-circle"></i> Pelo menos 8 caracteres</li>
                <li data-regra="maiuscula"><i class="fa-regular fa-circle"></i> Uma letra maiúscula</li>
                <li data-regra="minuscula"><i class="fa-regular fa-circle"></i> Uma letra minúscula</li>
                <li data-regra="numero"><i class="fa-regular fa-circle"></i> Um número</li>
                <li data-regra="especial"><i class="fa-regular fa-circle"></i> Um caractere especial</li>
                <li data-regra="iguais"><i class="fa-regular fa-circle"></i> As duas senhas iguais</li>
            </ul>

            <h3>Confirmação</h3>
            <input type="password" name="confirmacao" id="campoConfirmacao" class="input-email" placeholder="Exempl#1" required>

            <?php if ($erros_senha): ?>
            <ul class="aviso-erro lista-erros">
                <?php foreach ($erros_senha as $erro): ?>
                <li><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <br>

            <button type="submit" class="btn-garantir-vaga">
                Confirmar senha
            </button>

        </form>

    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

    <script src="../js/paginas/auth-confirmacao-senha.js"></script>

</body>
</html>