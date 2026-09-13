<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>A Queda de Constantinopla - Alexandria</title>

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
            --cinza-texto:        #333333;
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

        .banner-artigo {
            background-color: var(--bege-fundo);
            padding: 50px 80px;
            border-bottom: 1px solid #d1c8b4;
            position: relative;
            min-height: 220px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .banner-artigo::before {
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
            margin-left: 156px;
            z-index: 1000;
        }

        .banner-artigo h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--branco);
        }

        .banner-artigo p {
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

        .container-blog {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .conteudo-post {
            flex: 1;
        }

        .sidebar {
            width: 350px;
            flex-shrink: 0;
        }

        .post-imagem-principal {
            width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .post-categoria {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--vinho-alexandria);
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .post-categoria i { font-size: 10px; }

        .post-meta {
            display: flex;
            gap: 30px;
            color: var(--preto-contraste);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .post-meta i{
            color: var(--dourado-alexandria); 
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .post-titulo {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .post-texto {
            color: var(--cinza-texto);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .post-texto p { margin-bottom: 20px; }

        .post-imagem-interna {
            display: block;
            max-width: 80%;
            margin: 40px auto;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .input-busca {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            margin-bottom: 30px;
            outline: none;
        }

        .input-busca::placeholder { color: #888; }

        .widget {
            border: 1px solid #eaeaea;
            padding: 25px;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        .widget-titulo {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--preto-contraste);
            margin-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 10px;
        }

        .lista-mais-lidos {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item-mais-lido {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-weight: 500;
            font-size: 0.95rem;
            color: inherit;
            cursor: pointer;
            transition: color 0.2s;
        }

        .item-mais-lido a{
            color: var(--preto-contraste);
            text-decoration: none;
        }

        .item-mais-lido a:hover { color: var(--vinho-alexandria); }

        .item-mais-lido:hover { color: var(--vinho-alexandria); }

        .badge-numero {
            background-color: var(--vinho-alexandria);
            color: var(--branco);
            font-weight: 700;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 4px;
            text-align: center;
        }
        .badge-numero2 {
            background-color: var(--dourado-alexandria);
            color: var(--branco);
            font-weight: 700;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 4px;
            text-align: center;
        }

        .widget-destaque {
            background-color: var(--bege-fundo);
            border: none;
            border-left: 4px solid var(--dourado-alexandria);
        }

        .widget-destaque p {
            font-size: 0.95rem;
            margin-bottom: 20px;
            color: var(--cinza-texto);
        }

        .btn-widget {
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            border: none;
            padding: 10px 20px;
            font-weight: 700;
            font-size: 0.85rem;
            border-radius: 4px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <?php
        include("../alexandria-frontend/includes/sidebar.html")
    ?>

    <section class="banner-artigo">
        <div class="content">
            <h1>Artigos</h1>
            <p>Quer ter acesso a artigos exclusivos? Se inscreva na nossa plataforma.</p>
            <div class="hero-btns">
                <a href="plano.php" class="btn-hero-primary">Garantir minha vaga</a>
                <a href="missao.php" class="btn-hero-secondary">Conhecer a Missão</a>
            </div>
        </div>
    </section>

    <main class="container-blog">
        
        <article class="conteudo-post">
            <img src="imagens/cruzadas.jpg" alt="Pintura ilustrativa das Cruzadas e Constantinopla" class="post-imagem-principal">
            <br>
            <div class="post-categoria">
                <i class="fa-solid fa-square"></i> Idade Média
            </div>

            <div class="post-meta">
                <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> 8 min</span>
                <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> 17 maio 2026</span>
                <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> Victor</span>
            </div>

            <h1 class="post-titulo">A Queda de Constantinopla e o Fim da Idade Média</h1>

            <div class="post-texto">
                <p>Durante séculos, a cidade de Constantinopla ergueu-se como uma muralha entre dois mundos. Fundada sobre as antigas bases de Bizâncio e transformada pelo imperador Constantino I em capital do Império Romano do Oriente, ela tornou-se não apenas um centro político e econômico, mas também o coração espiritual da cristandade oriental. Suas muralhas gigantescas, suas igrejas repletas de mosaicos dourados e o esplendor da Basílica de Santa Sofia simbolizavam a continuidade de Roma em meio ao colapso do Ocidente. Enquanto a Europa medieval fragmentava-se em reinos feudais, Constantinopla permanecia como uma das maiores cidades do mundo, preservando a herança clássica greco-romana, mantendo imensas rotas comerciais e servindo como ponte entre o Oriente e o Ocidente.</p>
                
                <p>Contudo, ao longo dos séculos finais da Idade Média, o império que outrora dominara o Mediterrâneo oriental começou lentamente a definhar, corroído por inimigos externos, corrompido por disputas internas e pressionado por profundas transformações econômicas e militares. O declínio do Império Bizantino não ocorreu de maneira súbita. Durante a Alta Idade Média, os bizantinos ainda haviam demonstrado força militar e capacidade administrativa, sobretudo sob governantes como Justiniano I, que tentou restaurar a antiga glória romana reconquistando territórios no Ocidente.</p>

                <p>Entretanto, as guerras constantes, os desafios teológicos e as tensões contínuas fragilizaram progressivamente o Estado. Nos séculos seguintes, o avanço islâmico retirou importantes regiões do império, como Egito, Síria e Palestina, diminuindo drasticamente suas receitas e influência. Posteriormente, novas ameaças surgiriam: persas, eslavos, búlgaros, normandos e, principalmente, os turcos.</p>

                <p>A situação agravou-se ainda mais após a Quarta Cruzada, em 1204. Originalmente convocada para combater os muçulmanos na Terra Santa, a expedição desviou-se de seu objetivo e acabou saqueando Constantinopla, num dos episódios mais traumáticos da história medieval. Cavaleiros cristãos do Ocidente invadiram a capital bizantina, pilharam igrejas, destruíram tesouros e fragmentaram o império. Embora os bizantinos tenham retomado a cidade décadas depois, o golpe jamais seria totalmente superado. O prestígio imperial estava arruinado, a economia enfraquecida e as divisões religiosas entre católicos e ortodoxos aprofundaram-se ainda mais. A partir deste momento, Constantinopla transformou-se gradualmente em uma sombra de sua antiga grandeza.</p>
            </div>
        </article>

        <aside class="sidebar">
            <input type="text" class="input-busca" placeholder="Buscar artigos...">

            <div class="widget">
                <h3 class="widget-titulo">Mais Lidos</h3>
                <ul class="lista-mais-lidos">
                    <li class="item-mais-lido">
                        <span class="badge-numero">01</span>
                        Os Cavaleiros Templários: Guerreiros, Monges e Mitos
                    </li>
                    <li class="item-mais-lido">
                        <span class="badge-numero2">02</span>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>