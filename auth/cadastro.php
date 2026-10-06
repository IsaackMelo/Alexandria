<?php
require_once __DIR__ . '/../includes/dados.php';
$redirecionar = destino_redirecionamento();
$qs_redirecionar = $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '';
?>
<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meu Site</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/auth-cadastro.css">

<link rel="stylesheet" href="../estilo/responsivo.css">
</head>

<body>

    <div class="layout">

        <div class="left rounded-start-4 p-3">

            <div class="fundo-site w-100 h-100">

                <section class="hero-section">

                    <button
                        type="button"
                        onclick="history.back()"
                        class="back-button"
                    >
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

        <div class="right rounded-end-4">

            <div class="login-card">

                <h1>Cadastre-se</h1>

                <div class="divider">

                    <div class="diamond"></div>

                </div>

                <form class="formulario" id="formCadastro">

    <div>

        <label
            for="nome"
            class="form-label"
        >
            Nome
        </label>

        <div class="grupo-input">

            <div class="icone-input">
                <i class="bi bi-person"></i>
            </div>

            <input
                type="text"
                id="nome"
                class="campo-input"
                placeholder="Digite seu nome completo"
                autocomplete="name"
            >

        </div>

    </div>

    <div>

        <label
            for="email"
            class="form-label"
        >
            Email
        </label>

        <div class="grupo-input">

            <div class="icone-input">
                <i class="bi bi-envelope"></i>
            </div>

            <input
                type="email"
                id="email"
                class="campo-input"
                placeholder="seuemail@exemplo.com"
                autocomplete="email"
            >

        </div>

    </div>

    <div>

        <label
            for="dataNascimento"
            class="form-label"
        >
            Data de Nascimento
        </label>

        <div class="grupo-input">

            <div class="icone-input">
                <i class="bi bi-calendar3"></i>
            </div>

            <input
                type="text"
                id="dataNascimento"
                class="campo-input"
                placeholder="dd/mm/aaaa"
                maxlength="10"
            >

        </div>

    </div>

    <div>

        <label
            for="telefone"
            class="form-label"
        >
            Telefone
        </label>

        <div class="grupo-telefone">

            <div class="codigo-pais">
                <i class="bi bi-telephone"></i>
            </div>

            <div class="icone-input">
                +55
            </div>

            <input
                type="tel"
                id="telefone"
                class="campo-input"
                placeholder="11 992409200"
                maxlength="12"
                autocomplete="tel"
            >

        </div>

    </div>

    <div class="termos">

                            <input
                                type="checkbox"
                                id="termos"
                                required
                            >

                            <label for="termos">

                                Li e aceito os

                                <a href="../comuns/../web/termos.php">
                                    Termos de Uso
                                </a>

                                e a

                                <a href="../comuns/../web/politicas.php">
                                    Política de Privacidade
                                </a>.

                            </label>

                        </div>

    <div class="button">
        <a href="confirmacao-conta.php<?= $qs_redirecionar ?>" class="btn-login">
            Confirmar Email &nbsp;
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <p class="ja-tem-conta">

        Já tem uma conta?

        <a href="login.php<?= $qs_redirecionar ?>">
            Faça login
        </a>

    </p>

</form>

            </div>

        </div>

    </div>

    <script src="../js/paginas/auth-cadastro.js"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>