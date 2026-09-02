<?php
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Notificações</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria:   #8b1e2d;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --branco:             #ffffff;
            --bege-fundo:         #f5efe6;  
            --bege-card:          #fdf8f2;
            --bege-section:      #f9f5f1;
            --preto-contraste:   #1a1a1a;
            --cinza-texto:       #4a4a4a;
            --cinza-medio:       #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            background: var(--bege-fundo);
        }

        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 156px;
            z-index: 1000;
            background: var(--vinho-alexandria);
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            padding: 5px 0 10px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
            transform: translateX(-100%);
            transition: transform 0.25s ease-in-out;
        }

        .sidebar.aberta {
            transform: translateX(0);
        }

        .sidebar-top-group {
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 15px 10px 20px 10px;
            text-align: center;
        }

        .sidebar-header img {
            width: 90%;
            max-width: 130px;
            height: auto;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            width: 100%;
            margin-bottom: 2px;
        }

        .sidebar-menu li a, .sidebar-footer li a {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--dourado-alexandria);
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        .sidebar-menu li a .icon-img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            object-fit: contain;
        }

        .sidebar-menu li a .icon-fa, .sidebar-footer li a .icon-fa {
            width: 18px;
            font-size: 14px;
            margin-right: 10px;
            text-align: center;
            color: var(--dourado-alexandria);
        }

        .sidebar-menu li a .text, .sidebar-footer li a .text {
            font-size: 11px;
            font-weight: 500;
        }

        .sidebar-footer {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .sidebar-footer li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        
        .container-principal {
            margin-left: 0;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        
        .barra-superior {
            background: var(--branco);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--cinza-medio);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .titulo-barra-superior {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--preto-contraste);
        }

        .direita-barra-superior {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .distintivo-funcao {
            background: var(--vinho-alexandria);
            color: var(--branco);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            border: none;
        }

        .distintivo-funcao i {
            font-size: 10px;
        }

        .nome-usuario {
            font-size: 14px;
            font-weight: 500;
            color: var(--preto-contraste);
        }

        .avatar-usuario {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vinho-alexandria); 
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--dourado-alexandria); 
        }

        .barra-superior {
            height: 100px;
            padding: 0 24px 0 18px;
            background: var(--vinho-alexandria);
            border-bottom: none;
            box-shadow: none;
            color: var(--branco);
        }

        .titulo-barra-superior {
            display: flex;
            align-items: center;
            gap: 58px;
            color: var(--branco);
            font-size: 20px;
            font-weight: 700;
        }

        .menu-superior {
            width: 47px;
            height: 47px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 6px;
            padding: 9px;
            border: 1px solid var(--branco);
            border-radius: 5px;
            background: transparent;
        }

        .menu-superior span {
            display: block;
            width: 100%;
            height: 3px;
            background: var(--branco);
        }

        .direita-barra-superior { 
            gap: 31px; 
        }

        .direita-barra-superior > i { 
            color: var(--branco); 
            font-size: 27px; 
        }
        .direita-barra-superior .fa-user { 
            color: var(--dourado-claro); 
            font-size: 22px; 
        }
        .distintivo-funcao, .nome-usuario { 
            display: none; 
        }
        .avatar-usuario { 
            width: auto; 
            height: auto;
             background: transparent; 
             color: var(--dourado-claro); 
            }


        .conteudo-aula {
            background: var(--branco);
            padding: 76px 30px 28px;
            color: var(--preto-contraste);
        }

        .cabecalho-aula {
            max-width: 1290px;
            margin: 0 auto 108px;
            display: flex;
            align-items: center;
            gap: 27px;
        }

        .voltar-aula {
            color: #222;
            font-size: 46px;
            line-height: 1;
            text-decoration: none;
            font-weight: 300;
        }

        .titulo-aula h1 {
            margin: 0 0 13px;
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 700;
        }

        .titulo-aula p {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 18px;
        }

        .layout-aula {
            max-width: 1308px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(360px, 1.08fr);
            gap: 38px;
            align-items: start;
        }

        .video-card {
            padding: 10px;
            border: 1px solid var(--cinza-medio);
            border-radius: 10px;
            background: var(--branco);
        }

        .video-preview {
            position: relative;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #111;
            border-radius: 10px;
            background: #6f4b3e;
        }

        .imagem-video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .video-preview::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(66, 35, 25, .55), rgba(184, 142, 105, .28));
            z-index: 1;
        }

        .video-preview .botao-play,
        .video-preview .controles-video {
            z-index: 2;
        }

        .botao-play {
            width: 103px;
            height: 103px;
            display: grid;
            place-items: center;
            padding-left: 7px;
            border: 0;
            border-radius: 50%;
            background: #ad263e;
            color: var(--branco);
            font-size: 45px;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .2);
        }

        .controles-video {
            position: absolute;
            right: 12px;
            bottom: 9px;
            left: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--branco);
            font-size: 14px;
            text-shadow: 0 1px 2px #000;
        }

        .progresso-video {
            height: 2px;
            flex: 1;
            background: rgba(255,255,255,.85);
        }

        .controles-video i { 
            font-size: 15px; 
        }

        .tempo-video { 
            font-size: 13px; 
            font-weight: 600; 
            white-space: nowrap; 
        }

        .coluna-direita-aula { 
            display: flex; 
            flex-direction: column; 
            gap: 15px; 
        }
        .painel-aula { 
            padding: 25px 13px 27px; 
            border: 1px solid var(--cinza-medio); 
            border-radius: 10px; 
            background: var(--branco);
         }

        .painel-aula h2 {
    margin: 0 0 16px;
    color: var(--vinho-alexandria);
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-size: 23px;
}

.lista-conteudo {
    list-style: none;
    margin: 0;
    padding: 0;
}

.lista-conteudo li {
    min-height: 52px;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 9px 13px;
    border-radius: 10px;
    font-size: 16px;
}

.lista-conteudo li + li {
    margin-top: 3px;
}

.lista-conteudo li.selecionado {
    background: #f2ede4;
}

.radio-conteudo {
    width: 20px;
    height: 20px;
    min-width: 20px;
    border: 2px solid #666;
    border-radius: 50%;
}

.botao-curso {
    width: 85%;
    height: 52px;
    display: block;
    margin: 23px auto 0;
    border: 3px solid var(--dourado-alexandria);
    border-radius: 10px;
    background: var(--branco);
    color: #a9840d;
    font-size: 14px;
}

.painel-downloads {
    padding: 31px 27px 25px;
}

.painel-downloads h2 {
    margin-bottom: 20px;
    text-align: left;
    font-size: 18px;
}

.download-item {
    display: flex;
    align-items: center;
    gap: 18px;
    min-height: 61px;
    color: var(--preto-contraste);
}

.download-item + .download-item {
    margin-top: 2px;
}

.icone-arquivo {
    font-size: 32px;
}

.nome-arquivo {
    flex: 1;
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
}

.download-item .fa-download {
    font-size: 28px;
}

.sobre-aula {
    max-width: 1308px;
    margin: 30px auto 0;
    padding: 12px 8px 14px;
    border: 1px solid var(--cinza-medio);
    border-radius: 10px;
}

.sobre-aula h2 {
    margin: 0 0 10px;
    color: var(--vinho-alexandria);
    font-size: 22px;
}

.sobre-aula p {
    margin: 0;
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    line-height: 1.45;
}

.navegacao-aula {
    display: grid;
    grid-template-columns: 1fr 1.4fr 1fr;
    gap: 44px;
    margin-top: 24px;
}

.navegacao-aula button {
    height: 52px;
    border: 3px solid var(--dourado-alexandria);
    border-radius: 10px;
    background: var(--branco);
    color: #ad8a18;
    font-family: 'Playfair Display', serif;
    font-size: 16px;
}

.navegacao-aula .botao-central {
    background: var(--dourado-alexandria);
    color: var(--branco);
}

</style>
</head>
<body>
    
    <div class="sidebar" id="sidebar-principal">
        <div class="sidebar-top-group">
            <div class="sidebar-header">
                <a href="#"><img src="imagens/logo.png" alt="Alexandria Logo"/></a>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="#">
                        <img src="imagens/cursos.png" class="icon-img" alt="">
                        <span class="text">Cursos disponíveis</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/meus-cursos.png" class="icon-img" alt="">
                        <span class="text">Meus cursos</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/prancheta.png" class="icon-img" alt="">
                        <span class="text">Artigos</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/ia.png" class="icon-img" alt="">
                        <span class="text">Chat AI</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/banco_questao.png" class="icon-img" alt="">
                        <span class="text">Banco de questões</span>
                    </a>
                </li>
                <li>
                    <a href="#" >
                        <img src="imagens/notificacao.png" class="icon-img" alt="">
                        <span class="text">Notificação</span>
                    </a>
                </li>
            </ul>
        </div>

        <ul class="sidebar-menu sidebar-footer">
            <li>
                <a href="#" class="logout">
                    <span class="icon-fa"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    
    <div class="container-principal">
        
<div class="barra-superior">
            <div class="titulo-barra-superior">
                <button class="menu-superior" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="sidebar-principal">
                    <span></span><span></span><span></span>
                </button>
                Revolução de 1930 e o Governo Provisório (1930 - 1934)
            </div>
            <div class="direita-barra-superior">
                <i class="fas fa-search" aria-label="Pesquisar"></i>
                <i class="fas fa-bell" aria-label="Notificações"></i>
                <div class="avatar-usuario"><i class="fas fa-user"></i></div>
            </div>
        </div>

        <main class="conteudo-aula">
            <header class="cabecalho-aula">
                <a href="#" class="voltar-aula" aria-label="Voltar">←</a>
                <div class="titulo-aula">
                    <h1>Revolução de 1930</h1>
                    <p>Era Vargas</p>
                </div>
            </header>

            <div class="layout-aula">
                <section class="video-card" aria-label="Vídeo da aula">
                    <div class="video-preview">
                        <img class="imagem-video" src="imagens/getuliovargas.png" alt="Getúlio Vargas" onerror="this.onerror=null; this.src='imagens/getulio-cke.webp';">
                        <button class="botao-play" aria-label="Reproduzir aula"><i class="fas fa-play"></i></button>
                        <div class="controles-video">
                            <i class="fas fa-play"></i>
                            <i class="fas fa-rotate-left"></i>
                            <i class="fas fa-volume-high"></i>
                            <span class="tempo-video">00:00</span>
                            <div class="progresso-video"></div>
                            <span class="tempo-video">10:00</span>
                            <i class="fas fa-closed-captioning"></i>
                            <i class="fas fa-gear"></i>
                            <i class="fas fa-expand"></i>
                        </div>
                    </div>
                </section>

                <aside class="coluna-direita-aula">
                    <section class="painel-aula">
                        <h2>Lista de Conteúdo</h2>
                        <ol class="lista-conteudo">
                            <li class="selecionado"><span class="radio-conteudo"></span><span>1. Revolução de 1930</span></li>
                            <li><span class="radio-conteudo"></span><span>2. Governo Provisório (1930 - 1934)</span></li>
                            <li><span class="radio-conteudo"></span><span>3. Governo Constitucional (1934 - 1937)</span></li>
                            <li><span class="radio-conteudo"></span><span>4. Estado Novo (1937 - 1945)</span></li>
                            <li><span class="radio-conteudo"></span><span>5. Fim da Era Vargas</span></li>
                        </ol>
                        <button class="botao-curso">Ver curso completo</button>
                    </section>

                    <section class="painel-aula painel-downloads">
                        <h2>Materiais para download</h2>
                        <div class="download-item"><i class="far fa-file-word icone-arquivo"></i><span class="nome-arquivo">Exercícios revolução de 1930</span><i class="fas fa-download"></i></div>
                        <div class="download-item"><i class="far fa-file-word icone-arquivo"></i><span class="nome-arquivo">Exercícios revolução de 1930</span><i class="fas fa-download"></i></div>
                    </section>
                </aside>
            </div>

            <section class="sobre-aula">
                <h2>Sobre esta aula</h2>
                <p>Nesta aula, você aprenderá as causas, os principais eventos e as consequências da Revolução de 1930, um marco decisivo na história do Brasil que levou Getúlio Vargas ao poder e iniciou uma nova era política</p>
                <nav class="navegacao-aula" aria-label="Navegação entre aulas">
                    <button>Aula anterior</button>
                    <button class="botao-central">Ler conteúdo completo</button>
                    <button>Próxima aula</button>
                </nav>
            </section>
        </main>
    </div>

    <script>
        const botaoMenu = document.querySelector('.menu-superior');
        const sidebar = document.querySelector('#sidebar-principal');

        botaoMenu.addEventListener('click', () => {
            const sidebarAberta = sidebar.classList.toggle('aberta');

            botaoMenu.setAttribute('aria-expanded', sidebarAberta);
            botaoMenu.setAttribute(
                'aria-label',
                sidebarAberta ? 'Fechar menu' : 'Abrir menu'
            );
        });

        document.addEventListener('click', (evento) => {
            const clicouFora = !sidebar.contains(evento.target);
            const clicouNoBotao = botaoMenu.contains(evento.target);

            if (clicouFora && !clicouNoBotao && sidebar.classList.contains('aberta')) {
                sidebar.classList.remove('aberta');
                botaoMenu.setAttribute('aria-expanded', 'false');
                botaoMenu.setAttribute('aria-label', 'Abrir menu');
            }
        });
    </script>

</body>
</html>
