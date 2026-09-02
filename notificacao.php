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
            margin-left: 156px;
            width: calc(100% - 156px);
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

        .conteudo-principal {
            background: var(--branco);
            flex: 1;
            padding: 35px 30px 80px;
        }

        .area-notificacoes {
            max-width: 842px;
            margin: 0 auto;
        }

        .filtros-notificacoes {
            min-height: 90px;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 16px 7px;
            border: 1px solid var(--cinza-medio);
            border-radius: 17px;
            background: var(--branco);
        }

        .botao-filtro, .botao-ordenar {
            height: 39px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            border: 1px solid var(--cinza-medio);
            border-radius: 5px;
            background: var(--branco);
            color: var(--preto-contraste);
            font: 600 12px 'Inter', sans-serif;
            white-space: nowrap;
        }

        .botao-filtro i {
            color: var(--vinho-alexandria);
            font-size: 18px;
        }

        .botao-filtro.ativo {
            background: var(--vinho-alexandria);
            color: var(--branco);
            border-color: var(--vinho-alexandria);
        }

        .botao-filtro.ativo i {
            color: var(--dourado-alexandria);
        }

        .botao-marcar {
            color: var(--vinho-alexandria);
            margin-left: 15px;
        }

        .botao-ordenar {
            margin-left: auto;
        }

        .lista-notificacoes {
            margin-top: 1px;
            border-radius: 17px;
            overflow: hidden;
        }

        .item-notificacao {
            position: relative;
            min-height: 110px;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 11px;
            border: 1px solid var(--cinza-medio);
            border-top: 0;
            background: var(--branco);
        }

        .item-notificacao:first-child {
            border-top: 1px solid var(--cinza-medio);
            border-radius: 17px 17px 0 0;
        }

        .item-notificacao:last-child {
            border-radius: 0 0 17px 17px;
        }

        .ponto-status {
            position: absolute;
            top: 10px;
            right: 11px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
        }

        .ponto-status.amarelo {
            background: #d7b52f;
        }

        .ponto-status.verde {
            background: #7edc86;
        }

        .ponto-status.cinza {
            background: #858585;
        }

        .icone-notificacao {
            width: 62px;
            height: 62px;
            min-width: 62px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            color: #a71f35;
            background: #ffc6c9;
            font-size: 27px;
        }

        .item-notificacao:nth-child(2) .icone-notificacao {
            background: #f3ff82;
            color: #c8ae35;
        }

        .item-notificacao:nth-child(3) .icone-notificacao {
            background: #ffaaa9;
            color: #a42c3d;
        }

        .item-notificacao:nth-child(4) .icone-notificacao {
            background: #a6e8ac;
            color: #248d4a;
        }

        .item-notificacao:nth-child(5) .icone-notificacao {
            background: #cec6ff;
            color: #4384e8;
        }

        .texto-notificacao {
            flex: 1;
            min-width: 0;
        }

        .texto-notificacao h2 {
            margin: 0 0 4px;
            font-size: 14px;
            font-weight: 700;
        }

        .texto-notificacao p {
            max-width: 560px;
            margin: 0 0 3px;
            color: var(--cinza-texto);
            font-size: 12px;
            line-height: 1.35;
        }

        .texto-notificacao time {
            color: #676767;
            font-size: 12px;
        }

        .acao-notificacao {
            width: 135px;
            min-width: 135px;
            height: 39px;
            border: 2px solid var(--vinho-alexandria);
            border-radius: 12px;
            background: var(--branco);
            color: var(--vinho-alexandria);
            font-size: 14px;
        }

        .acao-notificacao.sucesso {
            border-color: #6dd46f;
            background: #d1ffca;
            color: #3e7445;
        }


    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-top-group">
            <div class="sidebar-header">
                <a href="#"><img src="imagens/logo.png" alt="Alexandria Logo"/></a>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#"><img src="imagens/cursos.png" class="icon-img" alt=""><span class="text">Cursos disponíveis</span></a></li>
                <li><a href="#"><img src="imagens/meus-cursos.png" class="icon-img" alt=""><span class="text">Meus cursos</span></a></li>
                <li><a href="#"><img src="imagens/prancheta.png" class="icon-img" alt=""><span class="text">Artigos</span></a></li>
                <li><a href="#"><img src="imagens/ia.png" class="icon-img" alt=""><span class="text">Chat AI</span></a></li>
                <li><a href="#"><img src="imagens/banco_questao.png" class="icon-img" alt=""><span class="text">Banco de questões</span></a></li>
                <li><a href="#"><img src="imagens/notificacao.png" class="icon-img" alt=""><span class="text">Notificação</span></a></li>
            </ul>
        </div>
        <ul class="sidebar-menu sidebar-footer"><li><a href="#" class="logout"><span class="icon-fa"><i class="fa-solid fa-right-from-bracket"></i></span><span class="text">Logout</span></a></li></ul>
    </div>

    <div class="container-principal">
        <div class="barra-superior">
            <div class="titulo-barra-superior">Notificações</div>
            <div class="direita-barra-superior">
                <div class="distintivo-funcao"><span>Estudante</span><i class="fas fa-chevron-down"></i></div>
                <div class="nome-usuario">Igor Bueno</div>
                <div class="avatar-usuario"><i class="fas fa-user"></i></div>
            </div>
        </div>

        <main class="conteudo-principal">
            <section class="area-notificacoes">
                <div class="filtros-notificacoes">
                    <button class="botao-filtro ativo"><i class="fa-regular fa-bell"></i> Todas <i class="fa-solid fa-chevron-down"></i></button>
                    <button class="botao-filtro"><i class="fa-regular fa-envelope"></i> Não lidas</button>
                    <button class="botao-filtro"><i class="fa-regular fa-bookmark"></i> Importantes</button>
                    <button class="botao-filtro botao-marcar"><i class="fa-regular fa-circle-check"></i> Marcar todas como lidas</button>
                    <button class="botao-ordenar">Ordenar por <i class="fa-solid fa-chevron-down"></i></button>
                </div>

                <div class="lista-notificacoes">
                    <article class="item-notificacao"><span class="ponto-status"></span><div class="icone-notificacao"><img src="imagens/livro 3.png"></div><div class="texto-notificacao"><h2>Novo módulo liberado: Brasil Império</h2><p>O conteúdo completo sobre o período imperial brasileiro já está disponível, incluindo exercícios comentados e mapas mentais.</p><time>Há 2 horas</time></div><button class="acao-notificacao">Ver Módulo</button></article>
                    <article class="item-notificacao"><span class="ponto-status amarelo"></span><div class="icone-notificacao"><i class="fa-regular fa-clipboard"></i></div><div class="texto-notificacao"><h2>Simulado ENEM de História disponível</h2><p>Um novo simulado focado em História Geral e História do Brasil foi adicionado à plataforma com correção automática.</p><time>Há 4 horas</time></div><button class="acao-notificacao">Fazer simulado</button></article>
                    <article class="item-notificacao"><span class="ponto-status amarelo"></span><div class="icone-notificacao"><i class="fa-solid fa-building-columns"></i></div><div class="texto-notificacao"><h2>Atualização na trilha de Revolução Francesa</h2><p>Adicionamos novas videoaulas e artigos complementares sobre o contexto político e social da Revolução Francesa.</p><time>Há 1 dia</time></div><button class="acao-notificacao">Explorar conteúdo</button></article>
                    <article class="item-notificacao"><span class="ponto-status verde"></span><div class="icone-notificacao"><i class="fa-regular fa-circle-check"></i></div><div class="texto-notificacao"><h2>Parabéns! Meta semanal concluída</h2><p>Você estudou por 7 dias consecutivos. Continue assim e alcance seus objetivos!</p><time>Há 1 dia</time></div><button class="acao-notificacao sucesso">Conquista</button></article>
                    <article class="item-notificacao"><span class="ponto-status cinza"></span><div class="icone-notificacao"><i class="fa-solid fa-comments"></i></div><div class="texto-notificacao"><h2>Nova mensagem do Chat AI</h2><p>Seu assistente de estudos tem uma resposta para sua última pergunta.</p><time>Há 2 dias</time></div><button class="acao-notificacao">Ver mensagem</button></article>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
