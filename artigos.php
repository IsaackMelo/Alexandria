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
    <link rel="stylesheet" href="estilo/artigos.css">

</head>

<body>

    <?php
        include("../alexandria-frontend/includes/sidebar.html");
    ?>
    <?php include("../alexandria-frontend/includes/barra-superior.html");?>


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
                    <h2 class="post-card-titulo"><a href="artigo-plataforma.php">A Queda de Constantinopla e o Fim da Idade Média</a></h2>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>