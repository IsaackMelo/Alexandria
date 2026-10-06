<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Missão, Visão e Valores - Alexandria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/web-missao.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>
<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <section class="hero">
        <div class="hero-content">
            <span class="badge-vermelho">Nossa Identidade</span>
            <h1>Missão, Visão e <span>Valores</span></h1>
            <p>Conheça os princípios que guiam a Alexandria, a plataforma de estudos de história mais completa para os concursos e processos de elite.</p>
            <div class="hero-btns">
                <a href="plano.php" class="btn-hero-primary">Garantir minha vaga</a>
                <a href="missao.php" class="btn-hero-secondary">Conhecer a Missão</a>
            </div>
        </div>
    </section>

    <section class="section-mvv">
        
        <div class="row-mvv">
            <img src="../imagens/cicuta.jpg" alt="Pintura Clássica" class="img-mvv">
            <div class="content-mvv">
                <span class="tag-secao"><i class="fa-solid fa-square"></i> Nossa Missão</span>
                <h2>Transformar a Educação em História</h2>
                <p>Proporcionar uma plataforma acessível e completa que capacite estudantes a dominar a história de forma estratégica e eficiente. Nosso objetivo é ser o maior ecossistema de ensino de história, focado em alta performance acadêmica e concursos de elite.</p>
                <ul class="lista-check">
                    <li><i class="fa-solid fa-check-square"></i> Facilitar o acesso a conteúdos de história.</li>
                    <li><i class="fa-solid fa-check-square"></i> Ajudar os estudantes a atingir suas metas.</li>
                    <li><i class="fa-solid fa-check-square"></i> Produzir uma educação mais emancipatória.</li>
                </ul>
            </div>
        </div>

        <div class="row-mvv">
            <div class="content-mvv">
                <span class="tag-secao"><i class="fa-solid fa-square" style="color: var(--dourado);"></i> Nossa Visão</span>
                <h2>Ser Referência Global em Educação Histórica.</h2>
                <p>Acreditamos em ser reconhecidos mundialmente como a plataforma mais inovadora, acessível e eficaz para o ensino de História. Queremos inspirar gerações de estudantes a compreender o passado e construir um futuro melhor.</p>
                
                <div class="stats-container">
                    <div class="stat-box gold">
                        <h3>50K+</h3>
                        <p>Total de Aprovação</p>
                    </div>
                    <div class="stat-box red">
                        <h3>98%</h3>
                        <p>Taxa de Aprovação</p>
                    </div>
                </div>
            </div>
            <img src="../imagens/napoleao.jpg" alt="Napoleão" class="img-mvv">
        </div>

    </section>

    <section class="secao-valores">
        <span class="tag-center">Nossos Princípios</span>
        <h2>Valores Fundamentais</h2>
        <p>Os princípios que guiam cada decisão e ação na Alexandria</p>

        <div class="grid-valores">
            <div class="card-valor">
                <img src="../imagens/santa.jpg" alt="Excelência">
                <h3>Excelência</h3>
                <p>Buscamos sempre a qualidade máxima em tudo o que fazemos, desde o conteúdo até o atendimento aos nossos estudantes.</p>
            </div>
            <div class="card-valor">
                <img src="../imagens/vocacao.jpg" alt="Inovação">
                <h3>Inovação</h3>
                <p>Constantemente buscamos novas metodologias e tecnologias para melhorar a experiência de aprendizado de nossos alunos.</p>
            </div>
            <div class="card-valor">
                <img src="../imagens/chaves.jpg" alt="Integridade">
                <h3>Integridade</h3>
                <p>Agimos com transparência, ética e responsabilidade em todas as nossas relações e compromissos.</p>
            </div>
        </div>
    </section>

    <?php
        include __DIR__ . '/../includes/red.html';
        include __DIR__ . '/../includes/footer.html';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>