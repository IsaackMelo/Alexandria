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
            background: var(--branco);
        }

        .barra-lateral {
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

        .grupo-superior-barra-lateral {
            display: flex;
            flex-direction: column;
        }

        .cabecalho-barra-lateral {
            padding: 15px 10px 20px 10px;
            text-align: center;
        }

        .cabecalho-barra-lateral img {
            width: 90%;
            max-width: 130px;
            height: auto;
        }

        .menu-barra-lateral {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-barra-lateral li {
            width: 100%;
            margin-bottom: 2px;
        }

        .menu-barra-lateral li a, .footer-barra-lateral li a{
            display: flex;
            align-items: center;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--dourado-alexandria);
            transition: all 0.2s ease;
        }

        .menu-barra-lateral li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        .menu-barra-lateral li a .imagem-icone {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            object-fit: contain;
        }

        .menu-barra-lateral li a .icone-fonte, .footer-barra-lateral li a .icone-fonte{
            width: 18px;
            font-size: 14px;
            margin-right: 10px;
            text-align: center;
            color: var(--dourado-alexandria);
        }

        .menu-barra-lateral li a .text, .footer-barra-lateral li a .text{
            font-size: 11px;
            font-weight: 500;
        }

        .footer-barra-lateral {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            
        }
        
        .footer-barra-lateral li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        /* ========== TOP BAR ========== */
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
            color: var(--texto-escuro);
        }

        .centro-barra-superior {
            display: flex;
            gap: 15px;
            align-items: center;
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
        }

        .distintivo-funcao i {
            font-size: 10px;
        }

        .direita-barra-superior {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nome-usuario {
            font-size: 14px;
            font-weight: 500;
            color: var(--texto-escuro);
        }

        .avatar-usuario {
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
        .conteudo-chat {
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

        .saudacao-principal {
            font-size: 36px;
            font-weight: 700;
            color: var(--texto-escuro);
            margin-bottom: 5px;
        }

        .subtitulo-saudacao {
            font-size: 32px;
            font-weight: 600;
            color: var(--vinho-alexandria);
            margin-bottom: 25px;
        }

        .descricao-saudacao {
            font-size: 14px;
            color: #777;
            margin-bottom: 50px;
        }

        .grade-cartoes {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            width: 100%;
            margin-bottom: 60px;
        }

        .cartao-tema {
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

        .cartao-tema:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transform: translateY(-2px);
            border-color: var(--vinho-alexandria);
        }

        .icone-tema {
            font-size: 24px;
            color: var(--vinho-alexandria);
            margin-bottom: 15px;
        }

        .titulo-tema {
            font-size: 14px;
            font-weight: 600;
            color: var(--vinho-alexandria);
            margin-bottom: 10px;
        }

        .texto-tema {
            font-size: 12px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .seta-tema {
            color: var(--vinho-alexandria);
            font-size: 14px;
            margin-top: auto;
            align-self: flex-end;
        }

        .envoltorio-entrada {
            width: 100%;
            max-width: 800px;
            position: relative;
            margin-bottom: 40px;
        }

        .container-entrada {
            display: flex;
            align-items: center;
            background: var(--branco);
            border: 1px solid #eee;
            border-radius: 50px;
            padding: 8px 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .botao-adicionar {
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

        .entrada-chat {
            flex: 1;
            border: none;
            padding: 10px;
            font-size: 15px;
            outline: none;
            color: var(--texto-escuro);
        }

        .distintivo-pro {
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

        .botao-enviar {
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

        .informacoes-footer {
            display: flex;
            justify-content: center;
            gap: 40px;
            width: 100%;
        }

        .item-informacao {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #999;
        }

        .separador-ponto {
            width: 4px;
            height: 4px;
            background: #ccc;
            border-radius: 50%;
            align-self: center;
        }

    </style>
</head>
<body>
    <div class="barra-lateral">
        <div class="grupo-superior-barra-lateral">
        <div class="cabecalho-barra-lateral">
            <a href="#"><img src="imagens/logo.png" alt="Alexandria Logo"/></a>
        </div>
        
        <ul class="menu-barra-lateral">
            <li>
                <a href="#">
                    <img src="imagens/cursos.png" class="imagem-icone" alt="">
                    <span class="text">Cursos disponíveis</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/meus-cursos.png" class="imagem-icone" alt="">
                    <span class="text">Meus cursos</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/prancheta.png" class="imagem-icone" alt="">
                    <span class="text">Artigos</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
                    <img src="imagens/ia.png" class="imagem-icone" alt="">
                    <span class="text">Chat AI</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/banco_questao.png" class="imagem-icone" alt="">
                    <span class="text">Banco de questões</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/notificacao.png" class="imagem-icone" alt="">
                    <span class="text">Notificação</span>
                </a>
            </li>
        </ul>
        </div>

        <ul class="menu-barra-lateral footer-barra-lateral">
            <li>
                <a href="#" class="logout">
                    <span class="icone-fonte"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container-principal">
        <div class="barra-superior">
            <div class="titulo-barra-superior">Chat AI</div>
            <div class="direita-barra-superior">
                <div class="distintivo-funcao">
                    <span>Estudante</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="nome-usuario">Igor Bueno</div>
                <div class="avatar-usuario">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

        <div class="conteudo-chat">
            <h1 class="saudacao-principal">Olá, Igor.</h1>
            <h2 class="subtitulo-saudacao">Por onde começamos?</h2>
            <p class="descricao-saudacao">Sou seu assistente de estudos. Pergunte sobre qualquer assunto e vamos aprender juntos!</p>

            <div class="grade-cartoes">
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="imagens/partenon 2.png"></div>
                    <div class="titulo-tema">Grécia Antiga</div>
                    <div class="texto-tema">Democracia ateniense, filosofia e principais acontecimentos.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="imagens/coliseu 2.png"></div>
                    <div class="titulo-tema">Roma Antiga</div>
                    <div class="texto-tema">República, império, direito romano e expansão territorial.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="imagens/naufragio 2.png"></div>
                    <div class="titulo-tema">Grandes Navegações</div>
                    <div class="texto-tema">Descobrimentos, rotas marítimas e impactos históricos.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="imagens/guilhotina 1.png"></div>
                    <div class="titulo-tema">Revoluções</div>
                    <div class="texto-tema">Revolução Francesa, Independência dos EUA e seus efeitos.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
            </div>

            <div class="envoltorio-entrada">
                <div class="container-entrada">
                    <button class="botao-adicionar">+</button>
                    <input type="text" class="entrada-chat" placeholder="Pergunte o que quiser">
                    <div class="distintivo-pro">
                        Pro <i class="fas fa-chevron-down"></i>
                    </div>
                    <button class="botao-enviar">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            <div class="informacoes-footer">
                <div class="item-informacao">
                    <i class="fas fa-check-circle"></i>
                    <span>Respostas confiáveis</span>
                </div>
                <div class="separador-ponto"></div>
                <div class="item-informacao">
                    <i class="fas fa-clock"></i>
                    <span>Atualizado constantemente</span>
                </div>
                <div class="separador-ponto"></div>
                <div class="item-informacao">
                    <i class="fas fa-lock"></i>
                    <span>Dados protegidos</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
