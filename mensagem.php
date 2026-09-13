<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Confirmação de código</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --vinho-alexandria: #8b1e2d;
            --vinho-escuro: #5e1220;
            --dourado-alexandria: #d4af37;
            --dourado-claro: #f0d060;
            --branco-fundo: #ffffff;
            --preto-contraste: #1a1a1a;
            --cinza-destaque: #dee0e3;
            --cinza-texto: #555;
            --branco: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--branco-fundo);
            color: var(--preto-contraste);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .banner-verificacao {
            position: relative;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/e/ea/Saint_Augustine_by_Philippe_de_Champaigne.jpg');
            background-size: cover;
            background-position: center 20%;
            min-height: 220px;
            display: flex;
            align-items: center;
            border-bottom: 4px solid var(--dourado-alexandria);
        }

        .banner-verificacao::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                90deg,
                rgba(94, 18, 32, 0.93) 0%,
                rgba(94, 18, 32, 0.55) 60%,
                rgba(94, 18, 32, 0.20) 100%
            );
        }

        .banner-verificacao .banner-conteudo {
            position: relative;
            z-index: 2;
            padding: 30px 60px;
            max-width: 620px;
        }

        .banner-verificacao h1 {
            font-family: 'Playfair Display', serif;
            color: var(--branco);
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .banner-verificacao p {
            color: var(--cinza-destaque);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .banner-botoes {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-garantir-vaga {
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-verificar {
            background-color: var(--vinho-alexandria);
            color: var(--branco);
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-garantir-vaga:hover {
            background-color: var(--dourado-claro);
        }

        .btn-conhecer-plataforma {
            background-color: transparent;
            color: var(--branco);
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 4px;
            border: 1px solid var(--branco);
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-conhecer-plataforma:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .secao-pergunta {
            padding: 90px 20px;
            text-align: center;
            background-color: var(--branco-fundo);
        }

        .secao-pergunta h2 {
            font-family: 'Inter', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 30px;
        }

        .pergunta-botoes {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-sim {
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 11px 42px;
            border-radius: 4px;
            border: none;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-sim:hover {
            background-color: var(--dourado-claro);
        }

        .btn-nao {
            background-color: transparent;
            color: var(--vinho-alexandria);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 11px 42px;
            border-radius: 4px;
            border: 1.5px solid var(--vinho-alexandria);
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-nao:hover {
            background-color: var(--vinho-alexandria);
            color: var(--branco);
        }

        .secao-confirmacao {
            padding: 90px 20px;
            text-align: center;
            background-color: var(--branco-fundo);
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .secao-confirmacao h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 40px;
        }

        .secao-confirmacao h3 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 30px;
        }

        .codigo-caixinhas {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 34px;
        }

        .input-codigo {
            width: 46px;
            height: 46px;
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--preto-contraste);
            background-color: var(--dourado-alexandria);
            border: none;
            border-radius: 6px;
            outline: none;
            transition: background-color 0.3s;
        }

        .input-codigo:focus {
            background-color: var(--dourado-claro);
        }

        .btn-confirmar-email {
            background-color: var(--vinho-alexandria);
            color: var(--branco);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 11px 30px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-confirmar-email:hover {
            background-color: var(--vinho-escuro);
        }

    </style>
</head>

<body>

    <?php
        include("../alexandria-frontend/includes/navbar.html")
    ?>

    <header class="banner-verificacao">

        <div class="banner-conteudo">

            <h1>Confirmação de Email</h1>

            <p>
                Para prosseguir com o seu acesso à conta, por favor, coloque o código de seu email.
            </p>

            <div class="banner-botoes">

                <a href="plano.php" class="btn-garantir-vaga">
                    Garantir Minha Vaga
                </a>

                <a href="missao.php" class="btn-conhecer-plataforma">
                    Conhecer a Missão
                </a>

            </div>

        </div>

    </header>

    <section class="secao-confirmacao">

        <h2>Confirmação de Email</h2>

        <h3>Informe codigo de confirmação</h3>

        <form>

            <div class="codigo-caixinhas">

                <input type="text" class="input-codigo" maxlength="1" inputmode="numeric">
                <input type="text" class="input-codigo" maxlength="1" inputmode="numeric">
                <input type="text" class="input-codigo" maxlength="1" inputmode="numeric">
                <input type="text" class="input-codigo" maxlength="1" inputmode="numeric">
                <input type="text" class="input-codigo" maxlength="1" inputmode="numeric">

            </div>

            <a href="senha2.php" class="btn-verificar">
                    Verificar
            </a>

        </form>

    </section>

    <?php
        include("../alexandria-frontend/includes/footer.html")
    ?>

    <script>
        const caixinhas = document.querySelectorAll('.input-codigo');

        caixinhas.forEach((caixinha, indice) => {

            caixinha.addEventListener('input', () => {

                if (
                    caixinha.value.length === 1 &&
                    indice < caixinhas.length - 1
                ) {
                    caixinhas[indice + 1].focus();
                }

            });

        });
    </script>

</body>
</html>