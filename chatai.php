<?php
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Alexandria – Chat AI</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria:   #8b1e2d;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --branco:             #ffffff;
            --cinza-medio:        #e8dfd7;
            --texto-escuro:       #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--branco); /* Fundo branco conforme imagem do chat */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 156px;
            z-index: 1000;
            background: var(--vinho-alexandria );
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 5px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
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
            flex-grow: 1;
        }

        .sidebar-menu li {
            width: 100%;
            margin-bottom: 2px;
        }

        .sidebar-menu li a {
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

        .sidebar-menu li a .icon-fa {
            width: 18px;
            font-size: 14px;
            margin-right: 10px;
            text-align: center;
            color: var(--dourado-alexandria);
        }

        .sidebar-menu li a .text {
            font-size: 11px;
            font-weight: 500;

        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 5px;

        }

        .sidebar-footer li a {
            padding: 10px 12px;
            padding-top: 290px;
        }

        .main-container {
            margin-left: 140px;
            width: calc(100% - 118px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: var(--branco);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--cinza-medio);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .top-bar-title {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--texto-escuro);
        }

        .top-bar-center {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .role-badge {
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
        }

        .role-badge i {
            font-size: 10px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--texto-escuro);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vinho-alexandria); /* Fundo vinho para combinar com o grande */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--dourado-alexandria); /* Ícone dourado conforme solicitado */
        }

        /* ========== CHAT CONTENT STYLES ========== */
        .chat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
            max-width: 1000px;
            margin: 0 auto;
        }

        .greeting-main {
            font-size: 36px;
            font-weight: 700;
            color: var(--texto-escuro);
            margin-bottom: 5px;
        }

        .greeting-sub {
            font-size: 32px;
            font-weight: 600;
            color: var(--vinho-alexandria);
            margin-bottom: 25px;
        }

        .greeting-desc {
            font-size: 14px;
            color: #777;
            margin-bottom: 50px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            width: 100%;
            margin-bottom: 60px;
        }

        .topic-card {
            background: var(--branco);
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .topic-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transform: translateY(-2px);
            border-color: var(--vinho-alexandria);
        }

        .topic-icon {
            font-size: 24px;
            color: var(--vinho-alexandria);
            margin-bottom: 15px;
        }

        .topic-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--vinho-alexandria);
            margin-bottom: 10px;
        }

        .topic-text {
            font-size: 12px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .topic-arrow {
            color: var(--vinho-alexandria);
            font-size: 14px;
            margin-top: auto;
            align-self: flex-end;
        }

        .input-wrapper {
            width: 100%;
            max-width: 800px;
            position: relative;
            margin-bottom: 40px;
        }

        .input-container {
            display: flex;
            align-items: center;
            background: var(--branco);
            border: 1px solid #eee;
            border-radius: 50px;
            padding: 8px 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .btn-plus {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            color: var(--branco);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            margin-right: 15px;
        }

        .chat-input {
            flex: 1;
            border: none;
            padding: 10px;
            font-size: 15px;
            outline: none;
            color: var(--texto-escuro);
        }

        .pro-badge {
            background: #f8f4f0;
            color: #333;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            margin-right: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .btn-send {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            color: var(--branco);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
        }

        .footer-info {
            display: flex;
            justify-content: center;
            gap: 40px;
            width: 100%;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #999;
        }

        .dot-separator {
            width: 4px;
            height: 4px;
            background: #ccc;
            border-radius: 50%;
            align-self: center;
        }

    </style>
</head>
<body>
    <div class="sidebar">
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
                <a href="#" class="active">
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
                <a href="#">
                    <img src="imagens/notificacao.png" class="icon-img" alt="">
                    <span class="text">Notificação</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu sidebar-footer">
            <li>
                <a href="#" class="logout">
                    <span class="icon-fa"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-container">
        <div class="top-bar">
            <div class="top-bar-title">Chat AI</div>
            <div class="top-bar-right">
                <div class="role-badge">
                    <span>Estudante</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="user-name">Igor Bueno</div>
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

        <div class="chat-content">
            <h1 class="greeting-main">Olá, Igor.</h1>
            <h2 class="greeting-sub">Por onde começamos?</h2>
            <p class="greeting-desc">Sou seu assistente de estudos. Pergunte sobre qualquer assunto e vamos aprender juntos!</p>

            <div class="cards-grid">
                <div class="topic-card">
                    <div class="topic-icon"><img src="imagens/partenon 2.png"></div>
                    <div class="topic-title">Grécia Antiga</div>
                    <div class="topic-text">Democracia ateniense, filosofia e principais acontecimentos.</div>
                    <div class="topic-arrow"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="topic-card">
                    <div class="topic-icon"><img src="imagens/coliseu 2.png"></div>
                    <div class="topic-title">Roma Antiga</div>
                    <div class="topic-text">República, império, direito romano e expansão territorial.</div>
                    <div class="topic-arrow"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="topic-card">
                    <div class="topic-icon"><img src="imagens/naufragio 2.png"></div>
                    <div class="topic-title">Grandes Navegações</div>
                    <div class="topic-text">Descobrimentos, rotas marítimas e impactos históricos.</div>
                    <div class="topic-arrow"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="topic-card">
                    <div class="topic-icon"><img src="imagens/guilhotina 1.png"></div>
                    <div class="topic-title">Revoluções</div>
                    <div class="topic-text">Revolução Francesa, Independência dos EUA e seus efeitos.</div>
                    <div class="topic-arrow"><i class="fas fa-arrow-right"></i></div>
                </div>
            </div>

            <div class="input-wrapper">
                <div class="input-container">
                    <button class="btn-plus">+</button>
                    <input type="text" class="chat-input" placeholder="Pergunte o que quiser">
                    <div class="pro-badge">
                        Pro <i class="fas fa-chevron-down"></i>
                    </div>
                    <button class="btn-send">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            <div class="footer-info">
                <div class="info-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Respostas confiáveis</span>
                </div>
                <div class="dot-separator"></div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>Atualizado constantemente</span>
                </div>
                <div class="dot-separator"></div>
                <div class="info-item">
                    <i class="fas fa-lock"></i>
                    <span>Dados protegidos</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
