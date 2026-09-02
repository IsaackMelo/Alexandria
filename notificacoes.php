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

        
        .conteudo-area {
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }

        
        .hero-card {
            background: linear-gradient(135deg, #6b1525 0%, #8b1e2d 40%, #a0283a 100%);
            border-radius: 16px;
            
            position: relative;
            margin-bottom: 30px;
            min-height: 280px;
            display: flex;
            align-items: flex-end;
            padding: 35px 40px;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1588392382834-a8911543e3c2?w=600&q=80') center/cover no-repeat;
            opacity: 0.25;
            mix-blend-mode: luminosity;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, rgba(139,30,45,0.9) 0%, rgba(139,30,45,0.3) 50%, transparent 100%);
        }

        .hero-overlay-icon {
            position: absolute;
            top: 50%;
            right: 12%;
            transform: translateY(-50%);
            font-size: 80px;
            color: rgba(212,175,55,0.2);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 65%;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--branco);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .hero-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
            font-weight: 400;
        }

        
        .metadata-row {
            display: flex;
            gap: 12px;
            margin-bottom: 35px;
            flex-wrap: wrap;
        }

        .metadata-badge {
            background: var(--bege-section);
            border: 1px solid var(--cinza-medio);
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            min-width: 160px;
        }

        .metadata-badge i {
            color: var(--vinho-alexandria);
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .metadata-badge .meta-label {
            font-size: 10px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            display: block;
        }

        .metadata-badge .meta-value {
            font-size: 13px;
            color: var(--cinza-texto);
            font-weight: 500;
            display: block;
        }

        
        .section-card {
            background: var(--bege-section);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 14px;
            padding: 30px 35px;
            margin-bottom: 20px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(139,30,45,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--vinho-alexandria);
            font-size: 18px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--vinho-alexandria);
            margin: 0;
        }

        .section-body {
            font-size: 14px;
            line-height: 1.8;
            color: var(--cinza-texto);
            padding-left: 52px;
        }

        .section-body p {
            margin-bottom: 12px;
        }

        .section-body p:last-child {
            margin-bottom: 0;
        }

        
        .sidebar-menu li a.active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--dourado-alexandria);
            color: var(--dourado-claro);
        }

        .sidebar-menu li a.active .text {
            font-weight: 700;
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
            <div class="titulo-barra-superior">Notificações</div>
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

        
        <div class="conteudo-area">
            
            
            <div class="hero-card">
                <i class="fa-solid fa-bell hero-overlay-icon"></i>
                <div class="hero-content">
                    <h1 class="hero-title">Como desenvolvemos as telas do Alexandria</h1>
                    <p class="hero-subtitle">Descubra o processo criativo e técnico por trás das interfaces da plataforma Alexandria, desde a concepção até a implementação final.</p>
                </div>
            </div>

            
            <div class="metadata-row">
                <div class="metadata-badge">
                    <i class="fa-regular fa-clock"></i>
                    <div>
                        <span class="meta-label">Tempo de leitura</span>
                        <span class="meta-value">8 min</span>
                    </div>
                </div>
                <div class="metadata-badge">
                    <i class="fa-regular fa-user"></i>
                    <div>
                        <span class="meta-label">Autor</span>
                        <span class="meta-value">Equipe Alexandria</span>
                    </div>
                </div>
                <div class="metadata-badge">
                    <i class="fa-regular fa-folder"></i>
                    <div>
                        <span class="meta-label">Categoria</span>
                        <span class="meta-value">Tecnologia</span>
                    </div>
                </div>
                <div class="metadata-badge">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <span class="meta-label">Última atualização</span>
                        <span class="meta-value">20 Ago 2026</span>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fa-solid fa-scroll"></i>
                    </div>
                    <h2 class="section-title">Introdução</h2>
                </div>
                <div class="section-body">
                    <p>Nós estamos finalizando a produção das telas da plataforma de estudos de História voltada para concursos e vestibulares, e acompanhar esse processo tomando forma tem sido uma experiência extremamente enriquecedora. Desde o início, nossa intenção foi criar um ambiente que não fosse apenas funcional, mas que também transmitisse identidade, organização e imersão no conteúdo histórico. Cada tela foi pensada para equilibrar estética e praticidade, buscando facilitar o aprendizado sem tornar a experiência visual cansativa ou genérica.</p>
                    
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <h2 class="section-title">Design de interface</h2>
                </div>
                <div class="section-body">
                    <p>Ao longo do desenvolvimento, procuramos construir uma interface que valorizasse tanto a leitura quanto a navegação. As páginas de artigos, cursos e conteúdos foram desenhadas para oferecer maior foco ao estudante, enquanto elementos como sidebars, notificações, perfis e áreas de progresso ajudam a tornar a plataforma mais dinâmica e intuitiva. Também tivemos uma preocupação constante em criar uma linguagem visual coerente, inspirada em referências clássicas e acadêmicas, mas adaptada para um ambiente digital moderno e acessível.</p>
                    
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h2 class="section-title">Tecnologias utilizadas</h2>
                </div>
                <div class="section-body">
                    <p>Outro aspecto importante durante a produção foi pensar em como diferentes públicos utilizariam a plataforma. Um estudante de vestibular normalmente busca objetividade e revisão rápida, enquanto alguém focado em concursos precisa, muitas vezes, de profundidade, constância e organização de longo prazo. Por isso, estruturamos as telas para acomodar tanto leituras rápidas quanto estudos mais extensos, permitindo uma experiência flexível e confortável para diferentes perfis de usuários.</p>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <h2 class="section-title">Conclusão</h2>
                </div>
                <div class="section-body">
                    <p>Agora, na etapa final, sentimos que a plataforma conseguiu alcançar a proposta inicial: unir design, acessibilidade e conteúdo em um espaço que incentive o estudo de História de forma mais envolvente. Ver as telas prontas, com identidade própria e conectadas entre si, transmite a sensação de que o projeto deixou de ser apenas uma ideia e passou a se tornar algo concreto, capaz de realmente auxiliar estudantes em sua preparação para concursos e vestibulares.</p>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>