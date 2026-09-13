<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Artigos - Alexandria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria:   #8b1e2d;
            --vinho-escuro:       #5e1220;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --bege-fundo:         #e9e2d5;
            --bege-card:          #fdf8f2;
            --preto-contraste:    #1a1a1a;
            --cinza-destaque:     #dee0e3;
            --cinza-texto:        #555555;
            --branco:             #ffffff;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--branco);
            color: var(--preto-contraste);
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, .titulo-serif {
            font-family: 'Playfair Display', serif;
        }

        a { text-decoration: none; }

        .acesse {
            color: var(--preto-contraste);
            text-decoration: none;
        }

        .banner-artigos-topo {
            background-color: var(--bege-fundo);
            padding: 50px 80px;
            border-bottom: 1px solid #d1c8b4;
            position: relative;
            min-height: 220px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .banner-artigos-topo::before {
            content: "";
            position: absolute;
            inset: 0;

            background-image:
                linear-gradient(
                    90deg,
                    rgba(94, 18, 32, 0.93) 0%,
                    rgba(94, 18, 32, 0.55) 60%,
                    rgba(94, 18, 32, 0.20) 100%
                ),
                url('https://upload.wikimedia.org/wikipedia/commons/e/ea/Saint_Augustine_by_Philippe_de_Champaigne.jpg');

            background-size: cover;
            background-position: center 20%;

            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1000;
        }

        .banner-artigos-topo h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--branco);
        }

        .banner-artigos-topo p {
            font-size: 0.95rem;
            margin-bottom: 20px;
            color: var(--branco);
        }

        .hero-btns {
            display: flex;
            gap: 16px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 36px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.25s, transform 0.2s;
            border: none;
        }

        .btn-hero-primary:hover {
            background-color: var(--dourado-claro);
            transform: translateY(-2px);
        }

        .btn-hero-secondary {
            background-color: transparent;
            color: var(--branco);
            font-weight: 600;
            font-size: 1rem;
            padding: 14px 36px;
            border-radius: 4px;
            text-decoration: none;
            border: 2px solid var(--branco);
            transition: border-color 0.25s, color 0.25s;
        }

        .btn-hero-secondary:hover {
            border-color: var(--dourado-alexandria);
            color: var(--dourado-alexandria);
        }

        .container-blog-index {
            background-color: var(--branco);
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .lista-posts {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .sidebar {
            width: 350px;
            flex-shrink: 0;
        }

        .post-card-item {
            display: flex;
            gap: 25px;
            align-items: flex-start;
            padding-bottom: 40px;
            border-bottom: 1px solid #eaeaea;
        }

        .post-card-item:last-child {
            border-bottom: none;
        }

        .post-card-img {
            width: 260px;
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .post-card-conteudo {
            flex: 1;
        }

        .post-categoria {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--vinho-alexandria);
            font-weight: 700;
            font-size: 0.75rem;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .post-categoria i { font-size: 8px; }

        .post-card-titulo {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .post-card-titulo a {
            color: var(--preto-contraste);
            transition: color 0.2s;
        }
        .post-card-titulo a:hover { color: var(--vinho-alexandria); }

        .post-card-resumo {
            font-size: 0.9rem;
            color: var(--cinza-texto);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .post-meta {
            display: flex;
            gap: 20px;
            color: var(--preto-contraste);
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .post-meta i {
            color: var(--dourado-alexandria);
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .input-busca {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            margin-bottom: 25px;
            outline: none;
        }

        .input-busca::placeholder { color: #888; }

        .widget {
            border: 1px solid #eaeaea;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 25px;
        }

        .widget-titulo {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 15px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 8px;
        }

        .lista-mais-lidos {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item-mais-lido {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-weight: 500;
            font-size: 0.85rem;
            color: inherit;
            cursor: pointer;
            transition: color 0.2s;
        }

        .item-mais-lido a{
            color: var(--preto-contraste);
            text-decoration: none;
        }

        .item-mais-lido a:hover{
            color: var(--vinho-alexandria);
        }

        .item-mais-lido:hover { color: var(--vinho-alexandria); }

        .badge-numero {
            background-color: var(--vinho-alexandria);
            color: var(--branco);
            font-weight: 700;
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 3px;
            min-width: 28px;
            text-align: center;
        }

        .widget-destaque {
            background-color: var(--bege-fundo);
            border: none;
            border-left: 3px solid var(--dourado-alexandria);
        }

        .widget-destaque p {
            font-size: 0.85rem;
            margin-bottom: 15px;
            color: var(--cinza-texto);
        }

        .btn-widget {
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            border: none;
            padding: 8px 16px;
            font-weight: 700;
            font-size: 0.8rem;
            border-radius: 4px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <?php
        include("../alexandria-frontend/includes/navbar.html");
    ?>

    <section class="banner-artigos-topo">
        <div class="content">
            <h1>Artigos</h1>
            <p>Quer ter acesso a artigos exclusivos? Se inscreva na nossa plataforma.</p>
            <div class="hero-btns">
                <a href="plano.php" class="btn-hero-primary">Garantir minha vaga</a>
                <a href="missao.php" class="btn-hero-secondary">Conhecer a Missão</a>
            </div>
        </div>
    </section>

    <main class="container-blog-index">
        
        <section class="lista-posts">
            
            <article class="post-card-item">
                <img src="../alexandria-frontend/imagens/cruzadas.jpg" alt="Constantinopla" class="post-card-img">
                <div class="post-card-conteudo">
                    <div class="post-categoria"><i class="fa-solid fa-square"></i> Idade Média</div>
                    <h2 class="post-card-titulo"><a href="artigo.php">A Queda de Constantinopla e o Fim da Idade Média</a></h2>
                    <p class="post-card-resumo">Em 1453, a tomada de Constantinopla pelo Império Otomano encerrou definitivamente a Idade Média e alterou o equilíbrio político, religioso e comercial do mundo. O artigo explora os últimos dias do império bizantino, o impacto da pólvora nas guerras e como a queda da cidade abriu caminho para uma nova era de expansão marítima europeia.</p>
                    <div class="post-meta">
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 8 min</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 17 maio 2026</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Victor</span>
                    </div>
                </div>
            </article>

            <article class="post-card-item">
                <img src="../alexandria-frontend/imagens/revolucao.jpg" alt="Revolução Francesa" class="post-card-img">
                <div class="post-card-conteudo">
                    <div class="post-categoria"><i class="fa-solid fa-square"></i> História Moderna</div>
                    <h2 class="post-card-titulo"><a href="#">A Revolução Francesa e o Nascimento do Mundo Moderno</a></h2>
                    <p class="post-card-resumo">A Revolução Francesa derrubou monarquias absolutas, espalhou ideais republicanos e redefiniu os rumos da política e do poder público. O artigo acompanha os eventos da revolução, desde a queda da Bastilha até o período do Terror, analisando seus efeitos duradouros na política mundial.</p>
                    <div class="post-meta">
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 6 min</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 14 maio 2026</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Victor</span>
                    </div>
                </div>
            </article>

            <article class="post-card-item">
                <img src="../alexandria-frontend/imagens/guerra.jpg" alt="Primeira Guerra Mundial" class="post-card-img">
                <div class="post-card-conteudo">
                    <div class="post-categoria"><i class="fa-solid fa-square"></i> História Contemporânea</div>
                    <h2 class="post-card-titulo"><a href="#">A Primeira Guerra Mundial e o Colapso dos Impérios</a></h2>
                    <p class="post-card-resumo">Trincheiras, gás tóxico e batalhas mecanizadas: a Primeira Guerra Mundial destruiu antigas dinastias e transformou a geopolítica global. O artigo explora como o imperialismo gerou a guerra moderna e preparou o terreno para os crises do século XX.</p>
                    <div class="post-meta">
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 7 min</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 10 maio 2026</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Igor</span>
                    </div>
                </div>
            </article>

            <article class="post-card-item">
                <img src="../alexandria-frontend/imagens/templarios.jpg" alt="Cavaleiros Templários" class="post-card-img">
                <div class="post-card-conteudo">
                    <div class="post-categoria"><i class="fa-solid fa-square"></i> Idade Média</div>
                    <h2 class="post-card-titulo"><a href="#">Os Cavaleiros Templários: Guerreiros, Monges e Mitos</a></h2>
                    <p class="post-card-resumo">Criados durante as Cruzadas, os templários se tornaram uma das ordens mais poderosas da cristandade medieval. O artigo aborda sua origem, a influência financeira, perseguição política e o verniz das lendas que permaneceram até hoje envolvendo tesouros e sociedades secretas.</p>
                    <div class="post-meta">
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 9 min</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 4 maio 2026</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Eliane</span>
                    </div>
                </div>
            </article>

            <article class="post-card-item">
                <img src="../alexandria-frontend/imagens/romano.jpg" alt="Império Romano" class="post-card-img">
                <div class="post-card-conteudo">
                    <div class="post-categoria"><i class="fa-solid fa-square"></i> Antiguidade</div>
                    <h2 class="post-card-titulo"><a href="#">O Império Romano: Como Uma República se Tornou um Império</a></h2>
                    <p class="post-card-resumo">Roma emergiu entre uma pequena cidade-estado e se tornou uma das maiores potências da história. Este artigo analisa a transformação da República Romana em Império, o papel de figuras como Júlio César e Augusto, e os fatores que permitiram a Roma dominar o Mediterrâneo por séculos.</p>
                    <div class="post-meta">
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 7 min</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> 1 maio 2026</span>
                        <span><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Lucas</span>
                    </div>
                </div>
            </article>

        </section>

        <aside class="sidebar">
            <input type="text" class="input-busca" placeholder="Buscar artigos...">

            <div class="widget">
                <h3 class="widget-titulo">Mais Lidos</h3>
                <ul class="lista-mais-lidos">
                    <li class="item-mais-lido">
                        <span class="badge-numero">01</span>
                        Os Cavaleiros Templários: Guerreiros, Monges e Mitos
                    </li>
                    <li href="artigo.php"  class="item-mais-lido">
                        <span class="badge-numero">02</span>
                        <a href="artigo.php">A Queda de Constantinopla e o Fim da Idade Média</a>
                    </li>
                    <li class="item-mais-lido">
                        <span class="badge-numero">03</span>
                        A Revolução Francesa e o Nascimento do Mundo Moderno
                    </li>
                    <li class="item-mais-lido">
                        <span class="badge-numero">04</span>
                        A Primeira Guerra Mundial e o Colapso dos Impérios
                    </li>
                    <li class="item-mais-lido">
                        <span class="badge-numero">05</span>
                        O Império Romano: Como Uma República se Tornou um Império
                    </li>
                </ul>
            </div>

            <div class="widget widget-destaque">
                <h3 class="widget-titulo">Aprofunde-se ainda mais</h3>
                <p>Entre na plataforma para ter acesso a conteúdo exclusivo.</p>
                <a href="plano.php" class="btn-widget">Garantir minha vaga</a>
            </div>
        </aside>

    </main>

    <?php
        include("../alexandria-frontend/includes/red.html");
        include("../alexandria-frontend/includes/footer.html");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>