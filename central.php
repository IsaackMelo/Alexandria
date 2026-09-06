<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Termos de Uso | Alexandria</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <link 
        rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link 
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" 
        rel="stylesheet"
    >

    <style>

        :root {
            --vinho: #6d2428;
            --texto: #303238;
            --cinza: #747474;
            --borda: #e6e1dc;
            --fundo: #faf9f7;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "DM Sans", sans-serif;
            background: var(--fundo);
            color: var(--texto);
        }

        .terms-page {
            min-height: 100vh;
            padding: 40px 30px;
        }

        .terms-container {
            width: 100%;
            max-width: 1720px;
            margin: auto;

            background: #ffffff;

            border: 1px solid var(--borda);
            border-radius: 18px;

            padding: 34px 46px 28px;

            box-shadow:
                0 15px 50px rgba(110, 70, 50, 0.04);
        }

        .header-area {
            display: flex;
            align-items: center;
            gap: 24px;

            margin-bottom: 20px;
        }

        .title-icon {
            width: 74px;
            height: 74px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    #f8eded 0%,
                    #f3e6e7 70%,
                    #efe2e3 100%
                );

            color: var(--vinho);

            font-size: 34px;
        }


        .page-title {
            font-family: "Playfair Display", serif;

            color: var(--vinho);

            font-size: 2.7rem;

            font-weight: 700;

            margin-bottom: 6px;
        }

        .page-description {
            font-size: 1rem;

            color: #5f6267;

            margin-bottom: 0;

            max-width: 500px;

            line-height: 1.7;
        }

        .update-info {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-left: 130px;

            color: #666a70;

            font-size: 0.95rem;
        }

        .update-info i {
            font-size: 20px;
            color: #777;
        }

        .update-info strong {
            color: var(--vinho);
            font-weight: 600;
        }

        .main-divider {
            border: none;
            border-top: 1px solid var(--borda);

            margin: 32px 0 16px;
        }

        .accordion {
            margin: 10px;
            --bs-accordion-border-width: 0;
            --bs-accordion-border-radius: 0;
            --bs-accordion-inner-border-radius: 0;
            --bs-accordion-btn-focus-box-shadow: none;
            --bs-accordion-btn-bg: transparent;
            --bs-accordion-active-bg: transparent;
            --bs-accordion-active-color: var(--texto);
        }


        .accordion-item {
            border: none;

            border-bottom: 1px solid var(--borda);

            background: transparent;
        }

        .accordion-item:last-child {
            border-bottom: none;
        }

        .accordion-button {
            display: flex;

            padding: 20px 0;

            background: transparent;

            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            box-shadow: none;
        }

        .accordion-button::after {
            background-image: none;

            content: "\F282";

            font-family: "bootstrap-icons";

            font-size: 22px;

            color: var(--vinho);

            transform: none;

            width: auto;
            height: auto;
        }

        .accordion-button:not(.collapsed)::after {
            content: "\F286";
        }

        .accordion-header-content {
            display: flex;

            align-items: center;

            width: 100%;

            gap: 28px;

            padding-right: 20px;
        }

        .section-icon {
            width: 64px;
            height: 64px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            font-size: 27px;
        }

        .icon-ban {
            background: #f8eef3;
            color: #8f2e62;
        }

        .icon-percent {
            background: #f8f7ee;
            color: #8f8a2e;
        }

        .icon-bag {
            background: #eef8f5;
            color: #2e8f74;
        }

        .icon-card {
            background: #f3f8ee;
            color: #588f2e;
        }

        .icon-cash {
            background: #eef8f3;
            color: #2e8f56;
        }

        .icon-bug {
            background: #f6eef8;
            color: #8f2e8a;
        }

        .icon-user {
            background: #f8eeee;
            color: #8f2e35;
        }

        .icon-platform {
            background: #faf4e7;
            color: #b88324;
        }

        .icon-profile {
            background: #edf1f6;
            color: #426084;
        }

        .icon-security {
            background: #edf5f1;
            color: #3d7a62;
        }

        .icon-edit {
            background: #f1edf7;
            color: #75529a;
        }

        .icon-cancel {
            background: #f6eded;
            color: #844242;
        }

        .icon-law {
            background: #f8eee7;
            color: #c96b32;
        }

        .section-number {
            position: relative;

            width: 50px;
            height: 50px;
            min-width: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            font-size: 1rem;
            font-weight: 600;
            color: var(--vinho);

            z-index: 1;
        }

        .section-number::before {
            content: "";

            position: absolute;
            inset: 0;

            border-radius: 10px;

            background: #f5e7e7;

            opacity: 0;
            transform: scale(0.75);

            transition:
                opacity 0.35s ease,
                transform 0.4s cubic-bezier(.22, 1, .36, 1);

            z-index: -1;
        }

        .section-title {
            font-family: "DM Sans", sans-serif;
            font-size: 1.08rem;
            font-weight: 500;
            color: #303238;
            margin: 0;

            transform-origin: left center;

            transition:
                color 0.35s ease,
                font-size 0.35s ease,
                font-weight 0.35s ease,
                transform 0.35s ease;
        }


        .accordion-body {
            padding:
                0
                60px
                28px
                84px;
        }

        .accordion-body-content {
            max-width: 1000px;
        }

        .accordion-body h3 {
            font-family: "Playfair Display", serif;

            color: var(--vinho);

            font-size: 1.4rem;

            font-weight: 700;

            margin-bottom: 20px;
        }

        .accordion-body p {
            font-size: 1rem;

            line-height: 1.9;

            color: #35383d;

            margin-bottom: 16px;
        }

        .accordion-button:not(.collapsed) .section-title {
            font-family: "Playfair Display", serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--vinho);

            transform: translateX(2px);
        }

        .accordion-button:not(.collapsed) .section-number::before {
            opacity: 1;
            transform: scale(1);
        }

        .accordion-button:not(.collapsed)
        .section-number {

            display: flex;

            align-items: center;
            justify-content: center;

            width: 50px;
            height: 50px;

            min-width: 50px;

            border-radius: 10px;

            background: #f5e7e7;

            color: var(--vinho);
        }

        .back-button {
            width: 54px;
            height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            border: none;

            background: #f7f6f4;

            color: var(--vinho);

            font-size: 25px;

            cursor: pointer;

            transition: 0.2s;
        }

        .back-button:hover {
            background: #f0e9e8;

            transform: translateX(-2px);
        }

        .theme-divider {
            display: flex;
            align-items: center;
            gap: 16px;

            margin: 34px 0 4px;
        }

        .theme-divider::before {
            content: "";

            width: 45px;
            height: 1px;

            background: var(--borda);
        }

        .theme-divider::after {
            content: "";

            flex: 1;
            height: 1px;

            background: linear-gradient(
                to right,
                var(--borda),
                transparent
            );
        }

        .theme-divider-content {
            display: flex;
            align-items: center;
            gap: 10px;

            white-space: nowrap;
        }

        .theme-divider-number {
            width: 28px;
            height: 28px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #e1c9cb;
            border-radius: 50%;

            background: #fffafa;

            color: var(--vinho);

            font-family: "Playfair Display", serif;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .theme-divider-title {
            color: var(--vinho);

            font-size: 0.7rem;
            font-weight: 700;

            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .accordion > .theme-divider:first-child {
            margin-top: 4px;
        }

    </style>

</head>


<body>

<?php
include("../FRONT/includes/navbar.html")
?>

    <main class="terms-page">

        <div class="terms-container">

            <div class="header-area">

                <button class="back-button" onclick="window.history.back()">

                    <i class="bi bi-chevron-left"></i>

                </button>


                <div>

                    <h1 class="page-title">
                        Central de Ajuda
                    </h1>


                    <div class="update-info">

                        <i class="bi bi-calendar3"></i>

                        <span>
                            Última atualização:
                            <strong>
                                01 de setembro de 2026
                            </strong>
                        </span>

                    </div>

                </div>

            </div>


            <hr class="main-divider">

            <div class="accordion" id="termsAccordion">

                <div class="theme-divider-content">

                    <span class="theme-divider-number">
                        I
                    </span>

                    <span class="theme-divider-title">
                        Conta e Acesso
                    </span>

                </div>

            </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term1"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-profile">

                                    <i class="bi bi-person"></i>

                                </div>

                                <span class="section-number">
                                    01.
                                </span>

                                <h3 class="section-title">
                                    Como faço para criar minha conta?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term1"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <div class="accordion-body-content">

                                <p>
                                    Para criar sua conta, acesse a página de inscrição, preencha seus dados pessoais, confirme seu email e escolha uma senha segura. Você terá acesso imediato à plataforma após a confirmação.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term2"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-platform">

                                    <i class="bi bi-laptop"></i>

                                </div>


                                <span class="section-number">
                                    02.
                                </span>


                                <h3 class="section-title">
                                    Esqueci minha senha, como recupero?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <div class="accordion-body-content">

                                <p>
                                    Clique em 'Esqueci minha senha' na página de login, insira seu email registrado e você receberá um link de recuperação. Siga as instruções do email para redefinir sua senha.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term3"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-security">

                                    <i class="bi bi-shield-check"></i>

                                </div>


                                <span class="section-number">
                                    03.
                                </span>


                                <h3 class="section-title">
                                    Posso usar a mesma conta em múltiplos dispositivos?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Sim, você pode acessar sua conta de qualquer dispositivo. No entanto, não é permitido compartilhar sua conta com outras pessoas, conforme nossos termos de uso.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion" id="termsAccordion">

                    <div class="theme-divider-content">

                        <span class="theme-divider-number">
                            II
                        </span>

                        <span class="theme-divider-title">
                            Cursos e Conteúdo
                        </span>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term4"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-edit">

                                    <i class="bi bi-pencil"></i>

                                </div>


                                <span class="section-number">
                                    04.
                                </span>


                                <h3 class="section-title">
                                     Quanto tempo tenho acesso aos cursos?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term4"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Você tem acesso vitalício aos cursos que adquirir. Pode estudar no seu próprio ritmo, revisitar aulas quantas vezes quiser e fazer download de materiais quando disponível.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term5"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-cancel">

                                    <i class="bi bi-x-lg"></i>

                                </div>


                                <span class="section-number">
                                    05.
                                </span>


                                <h3 class="section-title">
                                    As aulas têm legendas?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term5"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Sim, todas as nossas aulas possuem legendas em português para melhor acessibilidade. Você pode ativar ou desativar conforme sua preferência.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term6"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-law">

                                    <i class="bi bi-signpost-split"></i>

                                </div>


                                <span class="section-number">
                                    06.
                                </span>


                                <h3 class="section-title">
                                    Posso fazer download das aulas?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term6"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Aulas em vídeo não podem ser baixadas, mas você pode assistir offline através do aplicativo Alexandria. Materiais didáticos em PDF estão disponíveis para download.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion" id="termsAccordion">

                    <div class="theme-divider-content">

                        <span class="theme-divider-number">
                            III
                        </span>

                        <span class="theme-divider-title">
                            Técnico
                        </span>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term7"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-ban">

                                    <i class="bi bi-ban"></i>

                                </div>


                                <span class="section-number">
                                    07.
                                </span>


                                <h3 class="section-title">
                                    Qual navegador devo usar?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term7"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                A plataforma funciona em todos os navegadores modernos: Chrome, Firefox, Safari e Edge. Recomendamos manter seu navegador atualizado para melhor performance.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term8"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-cash">

                                    <i class="bi bi-cash"></i>

                                </div>


                                <span class="section-number">
                                    08.
                                </span>


                                <h3 class="section-title">
                                    Estou com problemas de conexão. Como resolver?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term8"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Verifique sua conexão de internet, limpe o cache do navegador, desabilite extensões e tente novamente. Se o problema persistir, entre em contato com nosso suporte técnico.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term9"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-bug">

                                    <i class="bi bi-bug"></i>

                                </div>


                                <span class="section-number">
                                    09.
                                </span>


                                <h3 class="section-title">
                                    Como faço para reportar um bug?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term9"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Use a opção 'Reportar Problema' no menu de ajuda da plataforma ou envie um email para suporte@alexandria.com.br com detalhes do problema e screenshots.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="accordion" id="termsAccordion">

                    <div class="theme-divider-content">

                        <span class="theme-divider-number">
                            IV
                        </span>

                        <span class="theme-divider-title">
                            Pagamento e Reembolso
                        </span>

                    </div>

                </div>

                
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term10"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-card">

                                    <i class="bi bi-credit-card"></i>

                                </div>


                                <span class="section-number">
                                    10.
                                </span>


                                <h3 class="section-title">
                                    Quais são as formas de pagamento aceitas?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term10"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Aceitamos cartão de crédito (Visa, Mastercard, Elo), débito, PIX e boleto bancário. Parcelamento em até 12x está disponível para cartão de crédito.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term11"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-bag">

                                    <i class="bi bi-bag"></i>

                                </div>


                                <span class="section-number">
                                    11.
                                </span>


                                <h3 class="section-title">
                                    Qual é a política de reembolso?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term11"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Oferecemos reembolso total se solicitado dentro de 7 dias da compra. Após este período, reembolsos parciais podem ser analisados caso a caso.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#term12"
                        >

                            <div class="accordion-header-content">

                                <div class="section-icon icon-percent">

                                    <i class="bi bi-percent"></i>

                                </div>


                                <span class="section-number">
                                    12.
                                </span>


                                <h3 class="section-title">
                                    Meu pagamento foi recusado. O que faço?
                                </h3>

                            </div>

                        </button>

                    </h2>


                    <div
                        id="term12"
                        class="accordion-collapse collapse"
                        data-bs-parent="#termsAccordion"
                    >

                        <div class="accordion-body">

                            <p>
                                Verifique se seus dados estão corretos, tente outro método de pagamento ou entre em contato com nosso suporte. Problemas com seu banco também podem ser a causa.
                            </p>

                        </div>

                    </div>

                </div>


            </div>


        </div>

    </main>

    <?php
        include("../FRONT/includes/footer.html");
    ?>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


</body>
</html>