<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Finalizar Compra</title>

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

        .checkout-etapa-titulo {
            font-family: 'Playfair Display', serif;
            color: var(--vinho-alexandria);
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 18px;
            margin-top: 40px;
        }

        .checkout-etapa-titulo.primeira-etapa {
            margin-top: 0;
        }

        .planos-mini-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .plano-mini-card {
            display: flex;
            flex-direction: column;
            padding: 20px 16px;
            background-color: var(--branco-fundo);
            border: 1.5px solid var(--cinza-destaque);
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .plano-mini-card.selecionado {
            border: 1.5px solid var(--vinho-alexandria);
        }

        .plano-mini-titulo {
            font-family: 'Playfair Display', serif;
            color: var(--vinho-alexandria);
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .plano-mini-preco {
            font-family: 'Inter', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--preto-contraste);
        }

        .plano-mini-periodo {
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            color: var(--cinza-texto);
            margin-bottom: 14px;
        }

        .plano-mini-divisor {
            border: none;
            border-top: 1.5px solid var(--preto-contraste);
            margin-bottom: 14px;
        }

        .plano-mini-card.selecionado .plano-mini-divisor {
            border-top-color: var(--vinho-alexandria);
        }

        .plano-mini-lista {
            list-style: none;
            text-align: left;
        }

        .plano-mini-lista li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            color: var(--preto-contraste);
        }

        .plano-mini-numero {
            flex-shrink: 0;
            width: 18px;
            height: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: 700;
            color: var(--branco);
            border-radius: 3px;
        }

        .plano-mini-numero.numero-vinho {
            background-color: var(--vinho-alexandria);
        }

        .plano-mini-numero.numero-dourado {
            background-color: var(--dourado-alexandria);
        }

        .conta-opcoes {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .conta-linha {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border: 1.5px solid var(--cinza-destaque);
            border-radius: 4px;
        }

        .conta-linha p {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--preto-contraste);
        }

        .btn-entrar {
            background-color: transparent;
            color: var(--vinho-alexandria);
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 8px 22px;
            border: 1.5px solid var(--vinho-alexandria);
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-entrar:hover {
            background-color: var(--vinho-alexandria);
            color: var(--branco);
        }

        .btn-criar-conta {
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 8px 22px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-criar-conta:hover {
            background-color: var(--dourado-claro);
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

                <h2 class="checkout-etapa-titulo primeira-etapa">
                    1. Escolher o plano
                </h2>

                <div class="planos-mini-grid">

                    <div class="plano-mini-card"
                        data-nome="Plano Básico"
                        data-preco="R$20,00"
                        data-itens="Conteúdos em texto otimizado;Banco de questões;Suporte exclusivo">

                        <h3 class="plano-mini-titulo">
                            Básico
                        </h3>

                        <p class="plano-mini-preco">
                            R$20,00
                        </p>

                        <p class="plano-mini-periodo">
                            /Mês
                        </p>

                        <hr class="plano-mini-divisor">

                        <ul class="plano-mini-lista">

                            <li>
                                <span class="plano-mini-numero numero-vinho">
                                    01
                                </span>
                                Conteúdos em texto otimizado para sua trilha;
                            </li>

                            <li>
                                <span class="plano-mini-numero numero-vinho">
                                    02
                                </span>
                                Banco de questões;
                            </li>

                            <li>
                                <span class="plano-mini-numero numero-vinho">
                                    03
                                </span>
                                Suporte exclusivo.
                            </li>

                        </ul>

                    </div>

                    <div class="plano-mini-card"
                        data-nome="Plano Avançado"
                        data-preco="R$30,00"
                        data-itens="Tudo da anterior;Simulados otimizados;Artigos exclusivos">

                        <h3 class="plano-mini-titulo">
                            Avançado
                        </h3>

                        <p class="plano-mini-preco">
                            R$30,00
                        </p>

                        <p class="plano-mini-periodo">
                            /Mês
                        </p>

                        <hr class="plano-mini-divisor">

                        <ul class="plano-mini-lista">

                            <li>
                                <span class="plano-mini-numero numero-dourado">
                                    01
                                </span>
                                Tudo da Anterior;
                            </li>

                            <li>
                                <span class="plano-mini-numero numero-dourado">
                                    02
                                </span>
                                Simulados otimizados para os temas e trilha;
                            </li>

                            <li>
                                <span class="plano-mini-numero numero-dourado">
                                    03
                                </span>
                                Artigos exclusivos.
                            </li>

                        </ul>

                    </div>

                    <div class="plano-mini-card selecionado"
                        data-nome="Plano Premium"
                        data-preco="R$40,00"
                        data-itens="Tudo das anteriores;Banco de questões;Suporte Exclusivo;Simulados otimizados;Artigos exclusivos;Alexandr.IA;Todas as trilhas">

                        <h3 class="plano-mini-titulo">
                            Premium
                        </h3>

                        <p class="plano-mini-preco">
                            R$40,00
                        </p>

                        <p class="plano-mini-periodo">
                            /Mês
                        </p>

                        <hr class="plano-mini-divisor">

                        <ul class="plano-mini-lista">

                            <li>
                                <span class="plano-mini-numero numero-vinho">
                                    01
                                </span>
                                Tudo das anteriores;
                            </li>

                            <li>
                                <span class="plano-mini-numero numero-vinho">
                                    02
                                </span>
                                Alexandr.IA para tirar todas suas dúvidas depois dos simulados;
                            </li>

                            <li>
                                <span class="plano-mini-numero numero-vinho">
                                    03
                                </span>
                                Acesso ilimitado a todas trilhas de concursos e vestibulares.
                            </li>

                        </ul>

                    </div>

                </div>

                <h2 class="checkout-etapa-titulo">
                    2. Acessar ou Criar Conta
                </h2>

                <div class="conta-opcoes">

                    <div class="conta-linha">

                        <p>Já tem conta?</p>

                        <a href="login.php" class="btn-entrar">
                            Entrar
                        </a>

                    </div>

                    <div class="conta-linha">

                        <p>Novo por aqui?</p>

                        <a href="cadastro.php" class="btn-criar-conta">
                            Criar Conta
                        </a>

                    </div>

                </div>

                <h2 class="checkout-etapa-titulo">
                    3. Escolher Método de Pagamento
                </h2>

                <div class="pagamento-grid">

                    <div class="pagamento-card selecionado">

                        <i class="fa-regular fa-credit-card"></i>

                        <span>
                            Cartão de Crédito
                        </span>

                    </div>

                    <div class="pagamento-card">

                        <i class="fa-brands fa-pix icone-pix"></i>

                        <span>
                            PIX
                        </span>

                    </div>

                    <div class="pagamento-card">

                        <i class="fa-solid fa-barcode"></i>

                        <span>
                            Boleto
                        </span>

                    </div>

                </div>

            </div>

            <aside class="resumo-wrapper">

                <div class="resumo-compra">

                    <h2>
                        Descrição da compra
                    </h2>

                    <div class="resumo-plano">

                        <span id="resumo-nome-plano">
                            Plano Premium
                        </span>

                        <span id="resumo-preco-plano">
                            R$40,00
                        </span>

                    </div>

                    <ul class="resumo-itens" id="resumo-lista-itens">

                        <li>Banco de questões;</li>
                        <li>Suporte Exclusivo;</li>
                        <li>Simulados otimizados;</li>
                        <li>Artigos exclusivos;</li>
                        <li>Alexandr.IA;</li>
                        <li>Todas as trilhas.</li>

                    </ul>

                    <div class="resumo-total">

                        <span>Total:</span>

                        <span id="resumo-total-valor">
                            R$40,00
                        </span>

                    </div>

                </div>

                <button type="button" class="btn-confirmar">

                    <a href="pagamento.php" class="btn-descri">
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
        const planoCards = document.querySelectorAll('.plano-mini-card');

        const resumoNome =
            document.getElementById('resumo-nome-plano');

        const resumoPreco =
            document.getElementById('resumo-preco-plano');

        const resumoTotal =
            document.getElementById('resumo-total-valor');

        const resumoLista =
            document.getElementById('resumo-lista-itens');

        planoCards.forEach((card) => {

            card.addEventListener('click', () => {

                planoCards.forEach((c) =>
                    c.classList.remove('selecionado')
                );

                card.classList.add('selecionado');

                resumoNome.textContent =
                    card.dataset.nome;

                resumoPreco.textContent =
                    card.dataset.preco;

                resumoTotal.textContent =
                    card.dataset.preco;

                resumoLista.innerHTML = '';

                card.dataset.itens
                    .split(';')
                    .forEach((item) => {

                        const li =
                            document.createElement('li');

                        li.textContent =
                            item.trim() + ';';

                        resumoLista.appendChild(li);

                    });

            });

        });

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