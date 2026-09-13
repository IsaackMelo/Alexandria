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

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --vinho-alexandria: #8b1e2d;
            --vinho-escuro: #5e1220;
            --dourado-alexandria: #d4af37;
            --dourado-claro: #f0d060;
            --bege-fundo: #f5efe6;
            --bege-card: #fdf8f2;
            --preto-contraste: #1a1a1a;
            --cinza-destaque: #dee0e3;
            --cinza-texto: #555;
            --branco: #ffffff;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: var(--vinho-alexandria);
        }

        .layout {
            width: 100%;
            min-height: 100vh;
            display: flex;
            margin: 0;
            padding: 40px;
        }

        .left,
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .left {
            background-image: url('../alexandria-frontend/imagens/imagem-login.png');
            background-position: center;
        }

        .right {
            background-color: white;
        }

        .hero-section {
            background-size: cover;
            background-position: center;
            min-height: 92vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .back-button {
            position: absolute;
            top: 25px;
            left: 25px;
            color: var(--vinho-alexandria);
            font-size: 32px;
            cursor: pointer;
            text-decoration: none;
            z-index: 10;
            background: transparent;
            border: none;
        }

        .back-button:hover {
            color: var(--vinho-escuro);
        }

        .hero-eyebrow {
            display: inline-block;
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 6px 18px;
            border-radius: 2px;
            margin-bottom: 28px;
        }

        .hero-title {
            font-size: clamp(1.2rem, 2.25vw, 2.1rem);
            color: var(--preto-contraste);
            line-height: 1;
            margin-bottom: 24px;
            font-weight: 700;
        }

        .hero-title span {
            color: var(--vinho-alexandria);
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: var(--preto-contraste);
            max-width: 640px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }

        .login-card {
            width: 100%;
            max-width: 850px;
            padding: 50px 110px;
        }

        h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            color: #651B1B;
            text-align: center;
            margin-bottom: 5px;
        }

        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-bottom: 28px;
        }

        .divider::before,
        .divider::after {
            content: "";
            width: 75px;
            height: 2px;
            background: #D9A63A;
        }

        .diamond {
            width: 10px;
            height: 10px;
            background: #D9A63A;
            transform: rotate(45deg);
        }

        .formulario {
    width: 100%;
}

        .button {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 22px;
}

.btn-login {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    background-color: var(--dourado-alexandria);
    color: var(--preto-contraste);

    font-weight: 700;
    font-size: 1rem;

    width: 230px;
    height: 53px;

    border-radius: 6px;
    border: none;

    text-decoration: none;

    cursor: pointer;

    transition:
        background-color 0.25s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.btn-login:hover {
    background-color: var(--dourado-claro);
    color: var(--preto-contraste);
    transform: translateY(-2px);
    box-shadow: 0 7px 18px rgba(212, 175, 55, 0.25);
}

.ja-tem-conta {
    text-align: center;
    color: #27384e;
    font-size: 14px;
    margin: 0;
}

.ja-tem-conta a {
    color: #d29f19;
    font-weight: 600;
    text-decoration: none;
}

.ja-tem-conta a:hover {
    text-decoration: underline;
}

.form-label {
    display: block;
    color: var(--vinho-alexandria);
    font-family: 'Cormorant Garamond', serif;
    font-size: 19px;
    font-weight: 700;
    margin-bottom: 6px;
}

.grupo-input {
    display: flex;
    width: 100%;
    height: 52px;
    margin-bottom: 18px;
}

.icone-input {
    width: 52px;
    min-width: 52px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    background-color: #ffffff;

    border: 1px solid #bfc5cc;
    border-right: 1px solid #bfc5cc;

    border-radius: 6px 0 0 6px;

    color: #111111;

    font-size: 20px;
}

.campo-input {
    width: 100%;
    height: 52px;

    border: 1px solid #bfc5cc;
    border-left: none;

    border-radius: 0 6px 6px 0;

    padding: 0 15px;

    font-family: "Inter", sans-serif;
    font-size: 14px;

    outline: none;

    color: var(--preto-contraste);
    background-color: #ffffff;

    transition: 0.2s ease;
}

.campo-input:focus {
    border-color: var(--dourado-alexandria);

    box-shadow:
        0 0 0 3px rgba(212, 175, 55, 0.12);
}

.grupo-input:focus-within .icone-input {
    border-color: var(--dourado-alexandria);
}

.campo-input::placeholder {
    color: #8992a0;
}

.grupo-telefone {
    display: flex;
    width: 100%;
    height: 52px;
    margin-bottom: 28px;
}

.codigo-pais {
    width: 58px;
    min-width: 58px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    background-color: #ffffff;

    border: 1px solid #bfc5cc;
    border-radius: 6px 0 0 6px;

    font-size: 14px;
    color: #333;
}

.grupo-telefone .icone-input {
    border-left: none;
    border-radius: 0;
}

.grupo-telefone .campo-input {
    border-radius: 0 6px 6px 0;
}

.grupo-telefone:focus-within .codigo-pais,
.grupo-telefone:focus-within .icone-input {
    border-color: var(--dourado-alexandria);
}

        .grupo-senha {
            display: flex;
            width: 100%;
            height: 52px;
            margin-bottom: 18px;
        }

        .grupo-senha .icone-input {
            border-radius: 7px 0 0 7px;
        }

        .grupo-senha .campo-input {
            border-radius: 0;
            border-left: none;
            border-right: none;
        }

        .grupo-senha:focus-within .icone-input {
            border-color: var(--dourado-alexandria);
        }

        .grupo-senha:focus-within .botao-senha {
            border-color: var(--dourado-alexandria);
        }

        .botao-senha {
            width: 52px;
            min-width: 52px;
            height: 52px;
            background: #ffffff;
            border: 1px solid #c8ced6;
            border-left: none;
            border-radius: 0 7px 7px 0;
            color: #111111;
            cursor: pointer;
            font-size: 18px;
            transition: 0.2s ease;
        }

        .botao-senha:hover {
            background: #fafafa;
        }

        .termos {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 3px;
            margin-bottom: 26px;
            font-size: 13px;
            color: #333;
            line-height: 1.5;
        }

        .termos input {
            width: 21px;
            height: 21px;
            min-width: 21px;
            margin-top: 0;
            border: 1px solid #bfc5cc;
            border-radius: 5px;
            cursor: pointer;
            accent-color: var(--dourado-alexandria);
        }

        .termos a {
            color: #d29f19;
            text-decoration: none;
            font-weight: 600;
        }

        .termos a:hover {
            text-decoration: underline;
        }

        .botao-cadastrar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 17px;
            width: 230px;
            height: 53px;
            margin: 0 auto 18px;
            background: var(--dourado-alexandria);
            border: none;
            border-radius: 6px;
            color: #111;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition:
                transform 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .botao-cadastrar:hover {
            background: var(--dourado-claro);
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(212, 175, 55, 0.25);
        }

        .botao-cadastrar i {
            font-size: 17px;
        }

        .ja-tem-conta {
            text-align: center;
            color: #27384e;
            font-size: 14px;
        }

        .ja-tem-conta a {
            color: #d29f19;
            font-weight: 600;
            text-decoration: none;
        }

        .ja-tem-conta a:hover {
            text-decoration: underline;
        }

    </style>

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

                                <a href="termos.php">
                                    Termos de Uso
                                </a>

                                e a

                                <a href="politicas.php">
                                    Política de Privacidade
                                </a>.

                            </label>

                        </div>


    <div class="button">
        <a href="email2.php" class="btn-login">
            Confirmar Email &nbsp;
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>


    <p class="ja-tem-conta">

        Já tem uma conta?

        <a href="login.html">
            Faça login
        </a>

    </p>

</form>

            </div>

        </div>

    </div>

    <script>

        function voltarPagina() {

            if (window.history.length > 1) {

                window.history.back();

            } else {

                window.location.href = "index.html";

            }

        }

        sif (!termos) {

                    alert(
                        "Você precisa aceitar os Termos de Uso e a Política de Privacidade."
                    );

                    return;

                }

    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>