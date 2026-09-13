<?php
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Revolução de 1930 · Alexandria</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ==========================================================
           TOKENS
           ========================================================== */
        :root {
            --vinho-alexandria: #8b1e2d;
            --dourado:        #b8720f;
            --dourado-escuro: #9c6009;
            --dourado-fundo:  #fbeed9;
            --creme-fundo:    #faf6f0;
            --branco-cartao:  #ffffff;
            --texto:          #1c1a17;
            --texto-suave:    #78716a;
            --linha:          #eee6d8;
            --verde-ok:       #4c8a3c;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--creme-fundo);
            color: var(--texto);
            display: flex;
        }

        a { color: inherit; }

        :focus-visible { outline: 2px solid var(--dourado); outline-offset: 2px; }

        button { font-family: inherit; cursor: pointer; }

        /* ==========================================================
           COLUNA DE CONTEÚDO (a sidebar do projeto fica de fora
           deste arquivo — ver includes/sidebar.html)
           ========================================================== */
        .container-principal {
            margin-left: 156px;
            width: calc(100% - 156px);
            min-height: 100vh;
            padding: 28px 32px 40px;
        }

        /* ---------- cabeçalho da aula ---------- */
        .cabecalho-aula {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .titulo-aula-grupo {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .voltar-aula {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            color: var(--vinho-alexandria);
            font-size: 20px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .titulo-aula-grupo h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -.01em;
            color: var(--texto);
            line-height: 1.2;
        }

        .titulo-aula-grupo p {
            margin-top: 2px;
            font-size: 14.5px;
            color: var(--texto-suave);
        }


        /* Espaço reservado entre o header e o conteúdo principal */
        .cabecalho-aula {
            min-height: 28px;
            margin-bottom: 16px;
        }

        /* ---------- grade principal ---------- */
        .layout-aula {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 368px;
            gap: 24px;
            align-items: start;
        }

        .cartao {
            background: var(--branco-cartao);
            border: 1px solid var(--linha);
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(30, 20, 10, .04);
        }

        /* ---------- vídeo ---------- */
        .video-card { padding: 14px; }

        .video-preview {
            position: relative;
            aspect-ratio: 16 / 9.1;
            overflow: hidden;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #6f4b3e;
        }

        .imagem-video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-preview::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(100deg, rgba(40, 20, 15, .35), rgba(40, 20, 15, 0) 55%);
        }

        .botao-play, .controles-video { position: relative; z-index: 2; }

        .botao-play {
            width: 68px;
            height: 68px;
            display: grid;
            place-items: center;
            padding-left: 5px;
            border: none;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            color: #fff;
            font-size: 26px;
            box-shadow: 0 6px 16px rgba(0,0,0,.25);
        }

        .controles-video {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 14px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: #fff;
            font-size: 14px;
        }

        .controles-video .fa-play { font-size: 13px; }
        .tempo-video { font-size: 13px; white-space: nowrap; opacity: .95; }

        .progresso-video {
            flex: 1;
            height: 4px;
            border-radius: 2px;
            background: rgba(255,255,255,.35);
            position: relative;
        }
        .progresso-video::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 15%;
            border-radius: 2px;
            background: var(--dourado);
        }
        .progresso-video::after {
            content: '';
            position: absolute;
            left: 15%; top: 50%;
            width: 10px; height: 10px;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: var(--dourado);
        }

        .caixa-velocidade, .caixa-cc {
            font-size: 12px;
            font-weight: 600;
            padding: 2px 6px;
            border: 1px solid rgba(255,255,255,.6);
            border-radius: 4px;
        }

        .controles-video i.icone-ctrl {
            font-size: 14px;
            opacity: .95;
        }

        /* ---------- sobre esta aula ---------- */
        .sobre-aula { margin-top: 20px; padding: 24px 26px; }

        .sobre-aula-cabecalho {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .icone-circulo {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--dourado-fundo);
            color: var(--dourado-escuro);
            font-size: 14px;
        }

        .sobre-aula h2 { font-size: 17px; font-weight: 700; }

        .sobre-aula p {
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--texto-suave);
            max-width: 78ch;
        }

        .info-aula-linha {
            display: flex;
            gap: 48px;
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid var(--linha);
            flex-wrap: wrap;
        }

        .info-aula-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-aula-item i {
            font-size: 18px;
            color: var(--dourado);
            width: 20px;
            text-align: center;
        }

        .info-aula-item strong {
            display: block;
            font-size: 14px;
            font-weight: 700;
        }

        .info-aula-item span {
            font-size: 12.5px;
            color: var(--texto-suave);
        }

        /* ---------- navegação inferior ---------- */
        .navegacao-aula {
            display: grid;
            grid-template-columns: 1fr 1.6fr 1fr;
            gap: 16px;
            margin-top: 20px;
        }

        .navegacao-aula a,
        .navegacao-aula button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            height: 52px;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 700;
            text-decoration: none;
            border: 1.5px solid var(--dourado);
            background: var(--branco-cartao);
            color: var(--dourado-escuro);
            transition: background .15s ease;
        }

        .navegacao-aula a:hover { background: var(--dourado-fundo); }

        .navegacao-aula .botao-central {
            background: var(--dourado);
            border-color: var(--dourado);
            color: #fff;
        }
        .navegacao-aula .botao-central:hover { background: var(--dourado-escuro); }

        /* ---------- coluna direita ---------- */
        .coluna-direita-aula {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .painel-aula { padding: 22px 20px; }

        .painel-aula h2 {
            font-size: 16.5px;
            font-weight: 700;
            color: var(--vinho-alexandria);
            margin-bottom: 14px;
        }

        .lista-conteudo { list-style: none; }

        .lista-conteudo li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 10px;
            border-radius: 10px;
            font-size: 12.5px;
            color: var(--texto);
            white-space: nowrap;
        }

        .lista-conteudo li span.rotulo {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lista-conteudo li + li { margin-top: 4px; }

        .lista-conteudo li.selecionado {
            background: var(--dourado-fundo);
            border-left: 3px solid var(--dourado);
            padding-left: 7px;
            font-weight: 700;
        }

        .status-item {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #fff;
        }

        .status-item.concluido { background: var(--verde-ok); }

        .status-item.atual {
            background: var(--dourado);
            padding-left: 1px;
        }

        .status-item.pendente {
            background: transparent;
            border: 2px solid #d8d1c4;
        }

        .lista-conteudo li span.rotulo { flex: 1; }

        .lista-conteudo li span.duracao {
            font-size: 12px;
            color: var(--texto-suave);
            flex-shrink: 0;
        }
        .lista-conteudo li.selecionado span.duracao { color: var(--dourado-escuro); }

        .botao-secundario {
            display: block;
            width: 100%;
            margin-top: 16px;
            padding: 12px;
            text-align: center;
            border: 1.5px solid var(--dourado);
            border-radius: 10px;
            background: var(--branco-cartao);
            color: var(--dourado-escuro);
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: background .15s ease;
        }
        .botao-secundario:hover { background: var(--dourado-fundo); }

        .download-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 2px;
        }

        .icone-pdf {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid var(--vinho-alexandria);
            border-radius: 7px;
            color: var(--vinho-alexandria);
            font-size: 15px;
        }

        .info-download { flex: 1; min-width: 0; }

        .nome-arquivo {
            display: block;
            font-size: 13.5px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tipo-arquivo { font-size: 12px; color: var(--texto-suave); }

        .botao-baixar {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid var(--dourado);
            border-radius: 8px;
            background: transparent;
            color: var(--dourado);
            font-size: 13px;
        }
        .botao-baixar:hover { background: var(--dourado-fundo); }

        .link-central {
            display: block;
            text-align: center;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--linha);
            font-size: 13px;
            font-weight: 700;
            color: var(--dourado-escuro);
            text-decoration: none;
        }
        .link-central:hover { color: var(--dourado); }

        .painel-anotacoes p {
            font-size: 13.5px;
            color: var(--texto-suave);
            margin-bottom: 16px;
        }




        /* ==========================================================
           DIMENSÃO EQUILIBRADA
           Uma única escala, sem acumular zooms anteriores.
           ========================================================== */
        body {
            overflow-x: hidden;
        }

        .container-principal {
            margin-left: 156px;
            width: calc(100% - 156px);
            padding: 18px 22px 26px;
        }

        .cabecalho-aula {
            gap: 16px;
            margin-bottom: 16px;
        }

        .titulo-aula-grupo {
            gap: 12px;
        }

        .titulo-aula-grupo h1 {
            font-size: 22px;
        }

        .titulo-aula-grupo p {
            font-size: 13px;
        }


        .layout-aula {
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
        }

        .video-card {
            padding: 10px;
        }

        .video-preview {
            border-radius: 8px;
            max-height: 560px;
        }

        .botao-play {
            width: 56px;
            height: 56px;
            font-size: 21px;
        }

        .sobre-aula {
            margin-top: 14px;
            padding: 18px 20px;
        }

        .navegacao-aula {
            gap: 10px;
            margin-top: 14px;
        }

        .navegacao-aula a,
        .navegacao-aula button {
            height: 44px;
            border-radius: 8px;
            font-size: 13px;
        }

        .coluna-direita-aula {
            gap: 14px;
        }

        .painel-aula {
            padding: 16px;
        }

        .painel-aula h2 {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .lista-conteudo li {
            padding: 7px;
            font-size: 11px;
        }

        .status-item {
            width: 19px;
            height: 19px;
        }

        .botao-secundario {
            margin-top: 10px;
            padding: 9px;
            font-size: 12px;
        }

        /* O header incluído usa estes valores de forma independente */
        .topbar {
            height: 43px;
            padding: 0 8px;
        }

        .menu-button {
            width: 30px;
            height: 30px;
            margin-right: 14px;
        }

        .menu-button i {
            font-size: 18px;
        }

        .page-title {
            font-size: 11px;
        }

        .topbar-right {
            gap: 8px;
        }

        .topbar-icon {
            width: 26px;
            height: 28px;
        }

        .topbar-icon i {
            font-size: 15px;
        }

        .page {
            padding-top: 43px;
        }

        @media (max-width: 900px) {
            .container-principal {
                margin-left: 0;
                width: 100%;
                padding: 14px;
            }

            .layout-aula {
                grid-template-columns: 1fr;
            }
        }




        /* ==========================================================
           CORREÇÃO FINAL DE RESPONSIVIDADE E ESPAÇAMENTO
           ========================================================== */
        html {
            font-size: 16px;
        }

        body {
            overflow-x: hidden;
            font-size: 16px;
        }

        .container-principal {
            width: calc(250% - 150px);
            min-height: 250vh;
            
            padding: 50px 28px 32px;
        }

        /* Espaçamento controlado entre o header e o conteúdo */
        .cabecalho-aula {
            min-height: 24px;
            margin: 0 0 20px;
        }

        .layout-aula {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 24px;
            align-items: start;
        }

        .video-card {
            width: 100%;
            padding: 12px;
        }

        .video-preview {
            width: 100%;
            max-height: none;
            aspect-ratio: 16 / 9;
        }

        .sobre-aula {
            margin-top: 18px;
            padding: 22px 24px;
        }

        .navegacao-aula {
            margin-top: 18px;
            gap: 12px;
        }

        .navegacao-aula a,
        .navegacao-aula button {
            min-height: 46px;
        }

        .coluna-direita-aula {
            display: flex;
            gap: 18px;
        }

        .painel-aula {
            padding: 18px;
        }

        /* Não aplicar a escala reduzida do cabeçalho dentro da página */
        .topbar {
            height: 43px;
        }

        .page {
            padding-top: 43px;
        }

        .menu-sidebar {
            width: 156px;
        }

        @media (max-width: 1100px) {
            .container-principal {
                padding: 20px 22px 28px;
            }

            .layout-aula {
                grid-template-columns: minmax(0, 1fr) 280px;
                gap: 18px;
            }
        }

        @media (max-width: 850px) {
            .container-principal {
                width: 100%;
                margin-left: 0;
                padding: 18px;
            }

            .layout-aula {
                grid-template-columns: 1fr;
            }

            .coluna-direita-aula {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
            }
        }

        @media (max-width: 600px) {
            .container-principal {
                padding: 14px 12px 22px;
            }

            .cabecalho-aula {
                min-height: 16px;
                margin-bottom: 14px;
            }

            .video-card {
                padding: 7px;
            }

            .sobre-aula {
                margin-top: 12px;
                padding: 16px;
            }

            .navegacao-aula {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .coluna-direita-aula {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .page-title {
                max-width: 190px;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }



        /* ==========================================================
           ÍCONE DO VÍDEO — TAMANHO RESPONSIVO CONTROLADO
           ========================================================== */
        .video-preview {
            position: relative;
            isolation: isolate;
            overflow: hidden;
        }

        .botao-play {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 2;
            width: clamp(42px, 4.5vw, 58px);
            height: clamp(42px, 4.5vw, 58px);
            padding: 0 0 0 3px;
            transform: translate(-50%, -50%);
            display: grid;
            place-items: center;
            border: 0;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            color: #ffffff;
            font-size: clamp(16px, 1.8vw, 23px);
            line-height: 1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .24);
        }

        .botao-play i {
            display: block;
            line-height: 1;
        }

        @media (max-width: 600px) {
            .botao-play {
                width: 42px;
                height: 42px;
                font-size: 16px;
            }
        }



        /* ==========================================================
           ZOOM NATIVO DO NAVEGADOR
           Não usar zoom CSS nem vw no tamanho do botão.
           Ctrl - reduz a página; Ctrl + aumenta a página.
           ========================================================== */
        .video-preview {
            position: relative;
            overflow: hidden;
        }

        .botao-play {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 2;
            width: 52px;
            height: 52px;
            min-width: 52px;
            min-height: 52px;
            max-width: 52px;
            max-height: 52px;
            padding: 0 0 0 3px;
            transform: translate(-50%, -50%);
            display: grid;
            place-items: center;
            border: 0;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            color: #ffffff;
            font-size: 20px;
            line-height: 1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .24);
        }

        .botao-play i {
            display: block;
            line-height: 1;
        }

        @media (max-width: 600px) {
            .botao-play {
                width: 44px;
                height: 44px;
                min-width: 44px;
                min-height: 44px;
                max-width: 44px;
                max-height: 44px;
                font-size: 17px;
            }
        }

    </style>
</head>
<body>

    

    <div class="container-principal">

        <?php include __DIR__ . '/includes/header.html'; ?>

        </header>

        <div class="layout-aula">

            <div>
                <section class="cartao video-card" aria-label="Vídeo da aula">
                    <div class="video-preview">
                        <img class="imagem-video" id="imagemVideo" src="imagens/getuliovargas.png" alt="Getúlio Vargas">
                        <button class="botao-play" aria-label="Reproduzir aula"><i class="fas fa-play"></i></button>
                        <div class="controles-video">
                            <i class="fas fa-play icone-ctrl"></i>
                            <i class="fas fa-volume-high icone-ctrl"></i>
                            <span class="tempo-video">00:00 / 12:45</span>
                            <div class="progresso-video"></div>
                            <span class="caixa-velocidade">1x</span>
                            <span class="caixa-cc">CC</span>
                            <i class="fas fa-gear icone-ctrl"></i>
                            <i class="fas fa-expand icone-ctrl"></i>
                        </div>
                    </div>
                </section>

                <section class="cartao sobre-aula">
                    <div class="sobre-aula-cabecalho">
                        <span class="icone-circulo"><i class="fa-solid fa-book-open"></i></span>
                        <h2>Sobre esta aula</h2>
                    </div>
                    <p>Nesta aula, você entenderá as causas, os principais eventos e as consequências da Revolução de 1930, um marco decisivo na história do Brasil que levou Getúlio Vargas ao poder e iniciou uma nova era política.</p>

                    <div class="info-aula-linha">
                        <div class="info-aula-item">
                            <i class="fa-regular fa-clock"></i>
                            <span><strong>12 min</strong>Duração</span>
                        </div>
                        <div class="info-aula-item">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span><strong>Intermediário</strong>Nível</span>
                        </div>
                        <div class="info-aula-item">
                            <i class="fa-regular fa-bookmark"></i>
                            <span><strong>História do Brasil</strong>Categoria</span>
                        </div>
                    </div>
                </section>

                <nav class="navegacao-aula" aria-label="Navegação entre aulas">
                    <button type="button" id="aulaAnterior"><i class="fa-solid fa-arrow-left"></i> Aula anterior</button>
                    <a class="botao-central" type="button" href="aula.php"><i class="fa-solid fa-book-open"></i> Ler conteúdo completo</a>
                    <button type="button" id="proximaAula">Próxima aula <i class="fa-solid fa-arrow-right"></i></button>
                </nav>
            </div>

            <aside class="coluna-direita-aula">
                <section class="cartao painel-aula">
                    <h2>Lista de Conteúdo</h2>
                    <ol class="lista-conteudo">
                        <li class="selecionado item-video" data-aula="0" tabindex="0"><span class="status-item atual"><i class="fa-solid fa-play"></i></span><span class="rotulo">1. Revolução de 1930</span><span class="duracao">12 min</span></li>
                        <li class="item-video" data-aula="1" tabindex="0"><span class="status-item pendente"></span><span class="rotulo">2. Governo Provisório (1930 - 1934)</span><span class="duracao">11 min</span></li>
                        <li class="item-video" data-aula="2" tabindex="0"><span class="status-item pendente"></span><span class="rotulo">3. Governo constitucional (1934 - 1937)</span><span class="duracao">11 min</span></li>
                        <li class="item-video" data-aula="3" tabindex="0"><span class="status-item pendente"></span><span class="rotulo">4. Estado Novo (1937 - 1945)</span><span class="duracao">14 min</span></li>
                        <li class="item-video" data-aula="4" tabindex="0"><span class="status-item pendente"></span><span class="rotulo">5. Fim da Era Vargas</span><span class="duracao">9 min</span></li>
                        <li class="item-exercicio oculto" data-exercicio="1" tabindex="0"><span class="status-item pendente"><i class="fa-solid fa-clipboard-list"></i></span><span class="rotulo">Lista de Exercícios 1</span><span class="duracao">Lista</span></li>
                        <li class="item-exercicio oculto" data-exercicio="2" tabindex="0"><span class="status-item pendente"><i class="fa-solid fa-clipboard-list"></i></span><span class="rotulo">Lista de Exercícios 2</span><span class="duracao">Lista</span></li>
                        <li class="item-exercicio oculto" data-exercicio="3" tabindex="0"><span class="status-item pendente"><i class="fa-solid fa-clipboard-list"></i></span><span class="rotulo">Lista de Exercícios 3</span><span class="duracao">Lista</span></li>
                    </ol>
                    <button type="button" id="verCursoCompleto" class="botao-secundario">Ver curso completo</button>
                </section>


                <section class="cartao painel-aula">
                    <h2>Materiais para download</h2>
                    <div class="download-item">
                        <span class="icone-pdf">PDF</span>
                        <span class="info-download">
                            <span class="nome-arquivo">Exercícios da aula</span>
                            <span class="tipo-arquivo">PDF · 120 KB</span>
                        </span>
                        <button class="botao-baixar" aria-label="Baixar"><i class="fa-solid fa-download"></i></button>
                    </div>
                    <div class="download-item">
                        <span class="icone-pdf">PDF</span>
                        <span class="info-download">
                            <span class="nome-arquivo">Exercícios revolução de 1930</span>
                            <span class="tipo-arquivo">PDF · 85 KB</span>
                        </span>
                        <button class="botao-baixar" aria-label="Baixar"><i class="fa-solid fa-download"></i></button>
                    </div>
                    <a href="#" class="link-central">Ver todos os materiais</a>
                </section>

                <section class="cartao painel-aula painel-anotacoes">
                    <h2>Minhas anotações</h2>
                    <p>Faça suas anotações sobre esta aula</p>
                    <a href="#" class="botao-secundario"><i class="fa-solid fa-pen"></i> Abrir anotações</a>
                </section>
            </aside>

        </div>
    </div>

    <main class="pagina-exercicio" id="paginaExercicio" hidden>
        <div class="cabecalho-pagina-exercicio">
            <button type="button" class="voltar-exercicio" id="voltarExercicio"><i class="fa-solid fa-arrow-left"></i> Voltar para as aulas</button>
            <span class="etiqueta-exercicio"><i class="fa-solid fa-clipboard-list"></i> Atividade avaliativa</span>
        </div>
        <article class="conteudo-exercicio">
            <p class="sobretitulo-exercicio">Era Vargas</p>
            <h1 id="tituloPaginaExercicio"></h1>
            <p class="introducao-pagina-exercicio" id="introducaoPaginaExercicio"></p>
            <div class="linha-decorativa-exercicio"></div>
            <div id="questoesPaginaExercicio"></div>
            <div class="instrucoes-pagina-exercicio"><i class="fa-solid fa-circle-info"></i><span><strong>Instruções:</strong> responda às questões no seu caderno ou no arquivo de atividades. Revise os textos das aulas antes de enviar suas respostas.</span></div>
        </article>
    </main>


    <style>

      .pagina-exercicio[hidden]{display:none}.pagina-exercicio{width:100%;min-height:calc(100vh - 80px);padding:28px clamp(24px,5vw,72px) 70px;background:var(--branco-cartao)}.cabecalho-pagina-exercicio{display:flex;align-items:center;justify-content:space-between;gap:20px;max-width:980px;margin:0 auto 42px}.voltar-exercicio{display:inline-flex;align-items:center;gap:9px;padding:9px 14px;border:1.5px solid var(--dourado);border-radius:9px;background:var(--branco-cartao);color:var(--dourado-escuro);font:600 13px inherit;cursor:pointer}.voltar-exercicio:hover{background:var(--dourado-fundo)}.pagina-exercicio .etiqueta-exercicio{display:inline-flex;align-items:center;gap:8px;color:var(--vinho-alexandria);font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.05em}.conteudo-exercicio{max-width:980px;margin:0 auto}.sobretitulo-exercicio{margin:0 0 10px;color:var(--dourado-escuro);font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.08em}.conteudo-exercicio h1{margin:0 0 14px;color:var(--texto);font-size:32px;line-height:1.2}.introducao-pagina-exercicio{max-width:780px;margin:0;color:var(--texto-suave);font-size:16px;line-height:1.75}.linha-decorativa-exercicio{width:70px;height:4px;margin:28px 0 30px;border-radius:3px;background:var(--vinho-alexandria)}.questao-pagina-exercicio{margin:0 0 20px;padding:23px 25px;border:1px solid var(--linha);border-left:5px solid var(--vinho-alexandria);border-radius:10px;background:#fffdfa;box-shadow:0 5px 16px rgba(30,20,10,.045);color:var(--texto);font-size:15px;line-height:1.75}.questao-pagina-exercicio strong{display:block;margin-bottom:8px;color:var(--vinho-alexandria);font-size:15px}.instrucoes-pagina-exercicio{display:flex;align-items:flex-start;gap:12px;margin-top:32px;padding:18px 20px;border-radius:10px;background:var(--dourado-fundo);color:var(--texto-suave);font-size:13px;line-height:1.6}.instrucoes-pagina-exercicio i{margin-top:3px;color:var(--dourado-escuro)}@media(max-width:600px){.pagina-exercicio{padding:22px 20px 50px}.cabecalho-pagina-exercicio{align-items:flex-start;flex-direction:column;margin-bottom:30px}.conteudo-exercicio h1{font-size:26px}.introducao-pagina-exercicio{font-size:14px}.questao-pagina-exercicio{padding:18px;font-size:14px}}
      .item-video,.item-exercicio{cursor:pointer;user-select:none;transition:background .18s ease,transform .18s ease}.item-video:hover,.item-exercicio:hover{background:var(--dourado-fundo);transform:translateX(2px)}.item-video:focus-visible,.item-exercicio:focus-visible{outline:2px solid var(--dourado);outline-offset:2px}.item-exercicio.oculto{display:none}.lista-conteudo.curso-expandido .item-exercicio.oculto{display:flex}.item-exercicio .status-item{background:transparent;color:var(--texto-suave);font-size:14px}.item-exercicio:hover .status-item{color:var(--dourado-escuro)}.curso-expandido + #verCursoCompleto{}.navegacao-aula button:disabled{opacity:.42;cursor:not-allowed;background:#f8f5ef}

      /* A tela de exercícios ocupa toda a janela, fora da coluna da aula */
      .pagina-exercicio {
          position: fixed;
          inset: 0;
          z-index: 4;
          width: auto;
          min-height: 100vh;
          overflow-y: auto;
          padding-top: 92px;
      }

      /* Refinamento: tela de exercícios centralizada e suave */
      .pagina-exercicio {
          display: flex;
          flex-direction: column;
          align-items: center;
          min-height: calc(100vh - 80px);
          padding: 42px 24px 76px;
          background: linear-gradient(180deg, #fbfaf8 0%, #f7f8f9 100%);
      }

      .cabecalho-pagina-exercicio,
      .conteudo-exercicio {
          width: min(100%, 820px);
      }

      .cabecalho-pagina-exercicio {
          margin: 0 auto 30px;
          padding-bottom: 18px;
          border-bottom: 1px solid #eee9e2;
      }

      .voltar-exercicio {
          padding: 9px 15px;
          border-color: #e2c77a;
          border-radius: 999px;
          background: rgba(255, 255, 255, .82);
          color: var(--dourado-escuro);
          box-shadow: 0 3px 10px rgba(60, 45, 25, .04);
          transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
      }

      .voltar-exercicio:hover {
          background: #fff8e8;
          transform: translateY(-1px);
          box-shadow: 0 6px 14px rgba(60, 45, 25, .08);
      }

      .conteudo-exercicio {
          padding: 42px 52px 46px;
          border: 1px solid #eee9e2;
          border-radius: 18px;
          background: rgba(255, 255, 255, .94);
          box-shadow: 0 12px 34px rgba(42, 31, 23, .065);
      }

      .sobretitulo-exercicio {
          margin-bottom: 12px;
          color: #a2762b;
          font-size: 11px;
          letter-spacing: .12em;
      }

      .conteudo-exercicio h1 {
          margin-bottom: 16px;
          color: #29333b;
          font-size: clamp(25px, 3vw, 32px);
          letter-spacing: -.02em;
      }

      .introducao-pagina-exercicio {
          max-width: 680px;
          color: #68737b;
          font-size: 15px;
          line-height: 1.8;
      }

      .linha-decorativa-exercicio {
          width: 54px;
          height: 3px;
          margin: 25px 0 28px;
          background: #c49a43;
          opacity: .85;
      }

      .questao-pagina-exercicio {
          margin: 0 0 16px;
          padding: 20px 22px;
          border: 1px solid #eee8dd;
          border-left: 3px solid #a96d2f;
          border-radius: 11px;
          background: #fffdf9;
          box-shadow: 0 4px 13px rgba(42, 31, 23, .035);
          color: #4b555d;
          font-size: 14px;
          line-height: 1.75;
          transition: box-shadow .2s ease, transform .2s ease;
      }

      .questao-pagina-exercicio:hover {
          transform: translateY(-1px);
          box-shadow: 0 7px 17px rgba(42, 31, 23, .065);
      }

      .questao-pagina-exercicio strong {
          margin-bottom: 6px;
          color: #8b1e2d;
          font-size: 13px;
          letter-spacing: .02em;
      }

      .instrucoes-pagina-exercicio {
          margin-top: 26px;
          padding: 16px 18px;
          border: 1px solid #f0e4c6;
          border-radius: 10px;
          background: #fffbf0;
          color: #777066;
          font-size: 12.5px;
          line-height: 1.65;
      }

      @media (max-width: 600px) {
          .pagina-exercicio { padding: 26px 16px 50px; }
          .cabecalho-pagina-exercicio { margin-bottom: 22px; }
          .conteudo-exercicio { padding: 29px 21px 32px; border-radius: 14px; }
          .cabecalho-pagina-exercicio .etiqueta-exercicio { font-size: 10px; }
          .introducao-pagina-exercicio { font-size: 14px; line-height: 1.7; }
          .questao-pagina-exercicio { padding: 17px 16px; font-size: 13.5px; }
      }

    </style>
    <script>
      (() => {
        const lista = document.querySelector('.lista-conteudo');
        const botao = document.getElementById('verCursoCompleto');
        const exercicios = [...document.querySelectorAll('.item-exercicio')];
        botao?.addEventListener('click', () => {
          const expandido = lista.classList.toggle('curso-expandido');
          botao.textContent = expandido ? 'Ocultar exercícios' : 'Ver curso completo';
          if (expandido) exercicios[0]?.focus();
        });
      })();
    </script>
    <script>
      (() => {
        const aulas=[
          {titulo:'1. Revolução de 1930',descricao:'Nesta aula, você entenderá as causas, os principais eventos e as consequências da Revolução de 1930, um marco decisivo na história do Brasil que levou Getúlio Vargas ao poder e iniciou uma nova era política.',duracao:'12 min',imagem:'imagens/revolucao-1930.png',alt:'Revolução de 1930'},
          {titulo:'2. Governo Provisório (1930 - 1934)',descricao:'Nesta aula, você conhecerá a reorganização do Estado brasileiro durante o Governo Provisório e as principais reformas do período.',duracao:'11 min',imagem:'imagens/governo-provisorio.png',alt:'Governo Provisório de Getúlio Vargas'},
          {titulo:'3. Governo Constitucional (1934 - 1937)',descricao:'Nesta aula, você compreenderá a Constituição de 1934, os conflitos políticos e o caminho que levou ao Estado Novo.',duracao:'11 min',imagem:'imagens/governo-constitucional.png',alt:'Governo Constitucional'},
          {titulo:'4. Estado Novo (1937 - 1945)',descricao:'Nesta aula, você estudará a ditadura do Estado Novo, a centralização do poder, a propaganda oficial e as políticas de industrialização.',duracao:'14 min',imagem:'imagens/estado-novo.png',alt:'Estado Novo'},
          {titulo:'5. Fim da Era Vargas',descricao:'Nesta aula, você analisará a deposição de Vargas em 1945 e o legado político, social e econômico deixado pela Era Vargas.',duracao:'9 min',imagem:'imagens/fim-era-vargas.png',alt:'Fim da Era Vargas'}
        ];
        let atual=0; const itens=[...document.querySelectorAll('.item-video')]; const texto=document.querySelector('.sobre-aula p'); const tempo=document.querySelector('.tempo-video'); const tituloVideo=document.querySelector('.titulo-aula-grupo h1'); const imagemVideo=document.getElementById('imagemVideo'); const imagemFallback='imagens/getuliovargas.png'; const anterior=document.getElementById('aulaAnterior'); const proxima=document.getElementById('proximaAula');
        function renderizar(i){ atual=Math.max(0,Math.min(aulas.length-1,i)); const aula=aulas[atual]; itens.forEach((item,n)=>{item.classList.toggle('selecionado',n===atual);const status=item.querySelector('.status-item');status.className='status-item '+(n===atual?'atual':'pendente');status.innerHTML=n===atual?'<i class="fa-solid fa-play"></i>':''}); if(tituloVideo)tituloVideo.textContent=aula.titulo;if(texto)texto.textContent=aula.descricao;if(tempo)tempo.textContent='00:00 / '+aula.duracao;if(imagemVideo){imagemVideo.onerror=()=>{imagemVideo.onerror=null;imagemVideo.src=imagemFallback};imagemVideo.src=aula.imagem;imagemVideo.alt=aula.alt}if(anterior)anterior.disabled=atual===0;if(proxima)proxima.disabled=atual===aulas.length-1;history.replaceState(null,'','#video-'+(atual+1));window.scrollTo({top:0,behavior:'smooth'})}
        itens.forEach(item=>{item.addEventListener('click',()=>renderizar(Number(item.dataset.aula)));item.addEventListener('keydown',e=>{if(e.key==='Enter'||e.key===' '){e.preventDefault();renderizar(Number(item.dataset.aula))}})}); anterior?.addEventListener('click',()=>renderizar(atual-1));proxima?.addEventListener('click',()=>renderizar(atual+1)); const hash=Number((location.hash.match(/video-(\d+)/)||[])[1]);renderizar(Number.isInteger(hash)&&hash>0?hash-1:0);
      })();
    </script>


    <script>
      (() => {
        const dados = {
          1: { titulo: 'Lista de Exercícios 1', introducao: 'Reforce os conhecimentos sobre a Revolução de 1930 e o contexto da Primeira República.', questoes: ['Explique dois fatores políticos que contribuíram para a crise da República Oligárquica e relacione-os à Revolução de 1930.', 'Compare a Política dos Governadores com o projeto político defendido pelos grupos que apoiaram Getúlio Vargas.'] },
          2: { titulo: 'Lista de Exercícios 2', introducao: 'Pratique os conteúdos sobre o Governo Provisório e o Governo Constitucional.', questoes: ['Quais foram as principais medidas de centralização adotadas por Vargas após 1930?', 'Analise a importância da Constituição de 1934 para a história política brasileira.'] },
          3: { titulo: 'Lista de Exercícios 3', introducao: 'Avalie sua compreensão sobre o Estado Novo e o fim da Era Vargas.', questoes: ['Identifique características autoritárias do Estado Novo e explique como a propaganda ajudou a sustentar o regime.', 'Por que a participação brasileira na Segunda Guerra Mundial contribuiu para a crise do Estado Novo?'] }
        };
        const layoutAula = document.querySelector('.layout-aula');
        const pagina = document.getElementById('paginaExercicio');
        const titulo = document.getElementById('tituloPaginaExercicio');
        const introducao = document.getElementById('introducaoPaginaExercicio');
        const questoes = document.getElementById('questoesPaginaExercicio');
        const voltar = document.getElementById('voltarExercicio');
        function abrirExercicio(numero) {
          const exercicio = dados[numero];
          if (!exercicio) return;
          titulo.textContent = exercicio.titulo;
          introducao.textContent = exercicio.introducao;
          questoes.innerHTML = exercicio.questoes.map((texto, i) => `<section class="questao-pagina-exercicio"><strong>Questão ${i + 1}</strong><span>${texto}</span></section>`).join('');
          layoutAula.hidden = true;
          pagina.hidden = false;
          window.scrollTo({top:0, behavior:'smooth'});
          history.replaceState(null, '', '#exercicio-' + numero);
        }
        function voltarAulas() {
          pagina.hidden = true;
          layoutAula.hidden = false;
          history.replaceState(null, '', location.pathname);
          window.scrollTo({top:0, behavior:'smooth'});
        }
        document.querySelectorAll('.item-exercicio').forEach(item => {
          const abrirTelaDeQuestao = () => {
            window.location.href = 'teladequest.php?lista=' + encodeURIComponent(item.dataset.exercicio);
          };
          item.addEventListener('click', abrirTelaDeQuestao);
          item.addEventListener('keydown', event => {
            if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); abrirTelaDeQuestao(); }
          });
        });
        voltar.addEventListener('click', voltarAulas);
      })();
    </script>

</body>
</html>
