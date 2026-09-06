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


        /* CONTEÚDO DO CABEÇALHO */

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

        .icon-cash {
            background: #eef8f3;
            color: #2e8f56;
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
                        Políticas de Privacidade
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
                                    Informações que coletamos
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
                                    Coletamos informações que você fornece diretamente, como nome, email, telefone, endereço e dados de pagamento. Também coletamos informações automaticamente sobre seu uso da plataforma, incluindo endereço IP, tipo de navegador, páginas visitadas, tempo de permanência e cliques. Usamos cookies e tecnologias similares para melhorar sua experiência.
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
                                    Como Usamos Suas Informações
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
                                    Usamos suas informações para: (a) fornecer e melhorar nossos serviços; (b) processar pagamentos; (c) enviar comunicações sobre sua conta; (d) personalizar sua experiência; (e) analisar tendências e uso; (f) cumprir obrigações legais; (g) prevenir fraudes e atividades ilícitas. Nunca vendemos suas informações pessoais para terceiros.
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
                                    Compartilhamento de Dados
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
                                Compartilhamos informações apenas quando necessário com: (a) processadores de pagamento para transações seguras; (b) provedores de hospedagem e serviços técnicos; (c) autoridades legais quando exigido por lei. Todos os parceiros são obrigados a manter a confidencialidade de seus dados.
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
                                     Segurança de Dados
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
                                Implementamos medidas de segurança técnicas, administrativas e físicas para proteger suas informações contra acesso não autorizado, alteração, divulgação ou destruição. Usamos criptografia SSL/TLS para transmissão de dados sensíveis. No entanto, nenhum método de transmissão pela internet é 100% seguro
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
                                    Retenção de Dados
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
                                Retemos suas informações pessoais enquanto sua conta estiver ativa ou conforme necessário para fornecer serviços. Você pode solicitar a exclusão de seus dados a qualquer momento, sujeito a obrigações legais de retenção. Alguns dados podem ser retidos para fins de conformidade legal ou resolução de disputas.
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
                                    Seus Direitos de Privacidade
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
                                Você tem direito a: (a) acessar suas informações pessoais; (b) corrigir dados imprecisos; (c) solicitar exclusão de dados; (d) opor-se ao processamento; (e) solicitar portabilidade de dados. Para exercer esses direitos, entre em contato através de privacidade@alexandria.com.br. Responderemos em até 30 dias.
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
                                    Cookies e Rastreamento
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
                                Usamos cookies para melhorar sua experiência, lembrar suas preferências e analisar o uso. Você pode controlar cookies através das configurações do seu navegador. Desabilitar cookies pode afetar a funcionalidade da plataforma. Também usamos ferramentas de análise como Google Analytics para entender padrões de uso.
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
                                    Mudanças nesta Política
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
                                Podemos atualizar esta política de privacidade periodicamente. Notificaremos você sobre mudanças significativas via email ou através de um aviso destacado na plataforma. Sua continuação no uso da plataforma após tais notificações constitui sua aceitação das mudanças.
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