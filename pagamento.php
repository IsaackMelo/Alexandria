<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Confirmação do Pagamento</title>

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
            --verde-pix: #2BA894;
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

        .secao-checkout {
            padding: 50px 60px 70px 60px;
            background-color: var(--branco-fundo);
            flex: 1;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            max-width: 1260px;
            margin: 0 auto;
            align-items: start;
        }

        .titulo-secao-simples {
            font-family: 'Inter', sans-serif;
            color: var(--preto-contraste);
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .pagamento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .pagamento-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 22px 12px;
            background-color: var(--branco-fundo);
            border: 1.5px solid var(--cinza-destaque);
            border-radius: 4px;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .pagamento-card.selecionado {
            border: 1.5px solid var(--vinho-alexandria);
        }

        .pagamento-card i {
            font-size: 1.5rem;
            color: var(--preto-contraste);
        }

        .pagamento-card .icone-pix {
            color: var(--verde-pix);
        }

        .pagamento-card span {
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--preto-contraste);
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .cartao-form {
            margin-top: 24px;
        }

        .form-grupo {
            margin-bottom: 18px;
        }

        .form-grupo label {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--preto-contraste);
            margin-bottom: 8px;
        }

        .input-cartao {
            width: 100%;
            padding: 10px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: var(--preto-contraste);
            border: 1.5px solid var(--cinza-destaque);
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-cartao::placeholder {
            color: var(--cinza-texto);
            opacity: 0.8;
        }

        .input-cartao:focus {
            border-color: var(--vinho-alexandria);
        }

        .form-grupo-dupla {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .privacidade-box {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            width: fit-content;
            max-width: 100%;
            margin: 24px auto 0 auto;
            padding: 16px 26px;
            background-color: #fbe4e8;
            border-radius: 6px;
        }

        .privacidade-box i {
            font-size: 1.05rem;
            color: var(--vinho-alexandria);
            margin-top: 4px;
        }

        .privacidade-box h3 {
            font-family: 'Inter', sans-serif;
            color: var(--preto-contraste);
            font-size: 0.98rem;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .privacidade-box p {
            font-family: 'Inter', sans-serif;
            font-size: 0.86rem;
            color: var(--cinza-texto);
            line-height: 1.4;
        }

        .resumo-wrapper {
            position: sticky;
            top: 90px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .resumo-compra {
            background-color: var(--branco-fundo);
            border: 1px solid var(--cinza-destaque);
            border-radius: 6px;
            padding: 22px 24px;
        }

        .resumo-compra h2 {
            font-family: 'Inter', sans-serif;
            color: var(--preto-contraste);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .resumo-plano {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--preto-contraste);
            margin-bottom: 10px;
        }

        .resumo-itens {
            list-style: none;
            margin-bottom: 12px;
        }

        .resumo-itens li {
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            color: var(--preto-contraste);
            padding: 4px 0;
        }

        .resumo-total {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding-top: 12px;
            border-top: 1px solid var(--cinza-destaque);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--preto-contraste);
        }

        .btn-confirmar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 16px;
            background-color: var(--vinho-alexandria);
            color: var(--branco);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-confirmar:hover {
            background-color: var(--vinho-escuro);
        }

        .btn-confirmar i {
            font-size: 0.85rem;
        }

        .btn-descri {
            text-decoration: none;
            color: var(--branco);
        }

    </style>
</head>

<body>

<?php
        include("../alexandria-frontend/includes/navbar.html");
    ?>

    <header class="banner-verificacao">

        <div class="banner-conteudo">

            <h1>Planos</h1>

            <p>
                Quer ter acesso aos nossos contúdos?
                Acompanhe nossas tabelas de planos!
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

    <section class="secao-checkout">

        <div class="checkout-grid">

            <div class="checkout-conteudo">

                <h2 class="titulo-secao-simples">
                    Confirmação do pagamento
                </h2>

                <div class="pagamento-grid">

                    <div class="pagamento-card selecionado">
                        <i class="fa-regular fa-credit-card"></i>
                        <span>Cartão de Crédito</span>
                    </div>

                    <div class="pagamento-card">
                        <i class="fa-brands fa-pix icone-pix"></i>
                        <span>PIX</span>
                    </div>

                    <div class="pagamento-card">
                        <i class="fa-solid fa-barcode"></i>
                        <span>Boleto</span>
                    </div>

                </div>

                <form class="cartao-form">

                    <div class="form-grupo">
                        <label for="nome-titular">
                            Nome do titular
                        </label>

                        <input
                            type="text"
                            id="nome-titular"
                            class="input-cartao"
                            placeholder="Digite como está no cartão"
                        >
                    </div>

                    <div class="form-grupo">
                        <label for="numero-cartao">
                            Número do cartão
                        </label>

                        <input
                            type="text"
                            id="numero-cartao"
                            class="input-cartao"
                            placeholder="0000 0000 0000 0000"
                            inputmode="numeric"
                        >
                    </div>

                    <div class="form-grupo-dupla">

                        <div class="form-grupo">
                            <label for="validade-cartao">
                                Validade
                            </label>

                            <input
                                type="text"
                                id="validade-cartao"
                                class="input-cartao"
                                placeholder="MM / AA"
                            >
                        </div>

                        <div class="form-grupo">
                            <label for="cvv-cartao">
                                Código de segurança
                            </label>

                            <input
                                type="text"
                                id="cvv-cartao"
                                class="input-cartao"
                                placeholder="CVV"
                                inputmode="numeric"
                                maxlength="4"
                            >
                        </div>

                    </div>

                </form>

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

                        <span>
                            Plano Premium
                        </span>

                        <span>
                            R$40,00
                        </span>

                    </div>

                    <ul class="resumo-itens">

                        <li>Banco de questões;</li>
                        <li>Suporte Exclusivo;</li>
                        <li>Simulados otimizados;</li>
                        <li>Artigos exclusivos;</li>
                        <li>Alexandr.IA;</li>
                        <li>Todas as trilhas.</li>

                    </ul>

                    <div class="resumo-total">

                        <span>
                            Total:
                        </span>

                        <span>
                            R$40,00
                        </span>

                    </div>

                </div>

                <button type="button" class="btn-confirmar">

                    <a href="checagem.php" class="btn-descri">
                        Continuar &nbsp;
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </button>

            </aside>

        </div>

    </section>

    <?php
        include("../alexandria-frontend/includes/footer.html");
    ?>

    <script>
        const pagamentoCards =
            document.querySelectorAll('.pagamento-card');

        pagamentoCards.forEach((card) => {

            card.addEventListener('click', () => {

                pagamentoCards.forEach((c) =>
                    c.classList.remove('selecionado')
                );

                card.classList.add('selecionado');

            });

        });
    </script>

</body>

</html>