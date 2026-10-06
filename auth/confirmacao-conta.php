<?php
require_once __DIR__ . '/../includes/dados.php';
$redirecionar = destino_redirecionamento();
$qs_redirecionar = $redirecionar !== '' ? '?redirecionar=' . urlencode($redirecionar) : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Alexandria - Verificação de conta</title> 

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/auth-confirmacao-conta.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>
<body class="pagina-site">

    <?php
        include __DIR__ . '/../includes/navbar.html';
    ?>

    <header class="banner-verificacao">
        <div class="banner-conteudo">

            <h1>Verificação de conta</h1>

            <p>Já tem acesso à nossa plataforma? Se a resposta for não, apenas clique no botão vermelho e crie agora mesmo!</p>

            <div class="banner-botoes">
                
                <a href="../web/plano.php" class="btn-garantir-vaga">Garantir Minha Vaga</a>

                <a href="../web/missao.php" class="btn-conhecer-plataforma">Conhecer a Missão</a>
            </div>

        </div>
    </header>

    <section class="secao-pergunta">

        <h2>Você já tem conta no site?</h2>

        <div class="pergunta-botoes">
            
            <a href="login.php<?= $qs_redirecionar ?>" class="btn-sim">Sim</a>

            <a href="cadastro.php<?= $qs_redirecionar ?>" class="btn-nao">Não</a>
        </div>

    </section>

    <?php
        include __DIR__ . '/../includes/footer.html';
    ?>

</body>
</html>