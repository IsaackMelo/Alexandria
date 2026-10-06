<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Planos</title> 
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/web-plano.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>
<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <header class="banner-verificacao">
        <div class="banner-conteudo">

            <h1>Planos</h1>

            <p>Quer ter acesso aos nossos contúdos? Acompanhe nossas tabelas de planos!</p>

            <div class="banner-botoes">
                
                <a href="plano.php" class="btn-garantir-vaga">Garantir Minha Vaga</a>

                <a href="missao.php" class="btn-conhecer-plataforma">Conhecer a Missão</a>
            </div>

        </div>
    </header>

    <section class="secao-planos">
        <div class="planos-grid">

            <div class="plano-card">
                
                <h2 class="plano-titulo">Básico</h2>

                <p class="plano-preco">R$20,00</p>
                <p class="plano-periodo">/Mês</p>

                <hr class="plano-divisor">

                <ul class="plano-lista">
                    <li><span class="plano-numero numero-vinho">01</span> Conteúdos em texto otimizado para sua trilha;</li>
                    <li><span class="plano-numero numero-vinho">02</span> Banco de questões;</li>
                    <li><span class="plano-numero numero-vinho">03</span> Suporte exclusivo.</li>
                </ul>

                <a href="../checkout/descricao.php?plano=basico" class="plano-btn-dourado">Garantir Minha Vaga</a>
            </div>

            <div class="plano-card plano-destaque">
                <h2 class="plano-titulo">Avançado</h2>

                <p class="plano-preco">R$30,00</p>
                <p class="plano-periodo">/Mês</p>

                <hr class="plano-divisor">

                <ul class="plano-lista">
                    <li><span class="plano-numero numero-dourado">01</span> Tudo da Anterior;</li>
                    <li><span class="plano-numero numero-dourado">02</span> Simulados otimizados para os temas e trilha;</li>
                    <li><span class="plano-numero numero-dourado">03</span> Artigos exclusivos.</li>
                </ul>

                <a href="../checkout/descricao.php?plano=avancado" class="plano-btn-vinho">Garantir Minha Vaga</a>
            </div>

            <div class="plano-card">
                <h2 class="plano-titulo">Premium</h2>

                <p class="plano-preco">R$40,00</p>
                <p class="plano-periodo">/Mês</p>

                <hr class="plano-divisor">

                <ul class="plano-lista">
                    <li><span class="plano-numero numero-vinho">01</span> Tudo das anteriores;</li>
                    <li><span class="plano-numero numero-vinho">02</span> Alexandr.IA para tirar todas suas dúvidas depois dos simulados;</li>
                    <li><span class="plano-numero numero-vinho">03</span> Acesso ilimitado a todas trilhas de concursos e vestibulares.</li>
                </ul>

                <a href="../checkout/descricao.php?plano=premium" class="plano-btn-dourado">Garantir Minha Vaga</a>
            </div>

        </div>
    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

</body>
</html>

