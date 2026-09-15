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
    <link rel="stylesheet" href="estilo/artigo-plataforma.css">

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