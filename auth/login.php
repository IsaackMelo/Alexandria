<?php
session_start();
require_once ("../includes/dados.php");

$erro = '';
$emailDigitado = '';
$redirecionar = destino_redirecionamento();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailDigitado  = trim($_POST['email'] ?? '');
    $senhaDigitada  = trim($_POST['senha'] ?? '');

    $contaEncontrada = null;

    foreach ($contas as $conta) {
        if (strcasecmp($conta['email'], $emailDigitado) === 0 && $conta['senha'] === $senhaDigitada) {
            $contaEncontrada = $conta;
            break;
        }
    }

    if ($contaEncontrada) {
        unset($contaEncontrada['senha']);
        $_SESSION['conta'] = $contaEncontrada;

        if ($redirecionar !== '' && $contaEncontrada['tipo'] !== 'ADM') {
            header('Location: ' . $redirecionar);
            exit;
        }

        if ($contaEncontrada['tipo'] === 'ADM') {
            header('Location: ../comuns/visualizar-curso.php');
            exit;
        }

        if (empty($contaEncontrada['plano'])) {
            header('Location: ../web/plano.php');
            exit;
        }

        header('Location: ../comuns/visualizar-curso.php');
        exit;
    } else {
        $erro = 'E-mail ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/auth-login.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <div class="layout">
        <div class="left rounded-start-4 p-3">
            <div class="fundo-site">
                <section class="hero-section">

    <button type="button" onclick="history.back()" class="back-button">
        <i class="bi bi-arrow-left"></i>
    </button>

    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <div class="text-center">

                <span class="hero-eyebrow">
                    Prepare-se. Compreenda. Conquiste sua vaga.
                </span>

                <h1 class="hero-title">
                    Domine a História.<br>
                    <span>Conquiste</span> seu próximo objetivo.
                </h1>

                <p class="hero-subtitle">
                    Na Alexandria, você encontra uma preparação completa
                    em História do Brasil e Geral, organizada para
                    vestibulares e concursos.
                </p>

            </div>
        </div>
    </div>

</section>
            </div>
        </div>
        <div class="right rounded-end-4 p3">
            <div class="login-card">
    <h1>Login</h1>
    <div class="divider">
        <div class="diamond"></div>
    </div>

    <?php if ($erro): ?>
        <div class="alert alert-danger py-2 text-center" role="alert">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="login.php">
            <input type="hidden" name="redirecionar" value="<?= htmlspecialchars($redirecionar, ENT_QUOTES, 'UTF-8') ?>">
        <label>E-mail</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-envelope fs-4"></i>
            </span>
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="alexandria@gmail.com"
                value="<?= htmlspecialchars($emailDigitado) ?>"
                required>
        </div>
        <label>Senha</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-lock fs-4"></i>
            </span>
            <input
                type="password"
                name="senha"
                id="campoSenha"
                class="form-control"
                placeholder="Sua senha"
                required>
            <span class="input-group-text botao-olho" id="alternarSenha" role="button" tabindex="0" aria-label="Mostrar senha" aria-pressed="false">
                <i class="bi bi-eye fs-4"></i>
            </span>
        </div>
        <div class="options">
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember">
                <label
                    class="form-check-label"
                    for="remember">
                    Lembrar de mim
                </label>
            </div>
            <a href="verificacao-email.php<?= $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '' ?>">Esqueci minha senha</a>
        </div>
        <div class="button">
            <button type="submit" class="btn-login">
                Entrar &nbsp;
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>
    </form>

    <div class="register">
        Não tem uma conta?
        <a href="cadastro.php<?= $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '' ?>">
            Crie agora
        </a>
    </div>
</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/paginas/auth-login.js"></script>
</body>
</html>