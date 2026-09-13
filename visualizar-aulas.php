<html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        // Dados do módulo/aulas: centralizados em dados.php
        require_once __DIR__ . '/dados.php';
    ?>

    <title>Era Vargas</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding-top: 43px;
            background-color: #ffffff;
            color: #222;
            font-family: Georgia, "Times New Roman", serif;
        }

        :root {
            --vinho: #a71935;
            --vinho-escuro: #94152e;
            --bege: #f5efe5;
            --cinza: #666;
            --preto: #222;
            --amarelo: #e4c41d;
        }

        .hero {
            height: 205px;

            background: #8b1e2d;
            background-size: cover;
            background-position: center top;

            position: relative;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
        }

        .curso {
            position: absolute;

            top: 15px;
            left: 20px;

            display: flex;
            align-items: center;

            gap: 10px;

            font-size: 12px;
            color: white;
        }

        .curso-indicador {
            width: 13px;
            height: 13px;

            background-color: var(--amarelo);
        }

        .hero h1 {
            font-size: 24px;
            font-weight: bold;

            margin: 0;
        }

        .conteudo {
            padding: 14px 17px 40px;
        }

        .detalhes {
            background-color: var(--bege);

            border-radius: 7px;

            padding: 18px;

            min-height: 180px;
        }

        .detalhes-titulo {
            font-size: 14px;
            font-weight: bold;

            margin-bottom: 30px;
        }

        .detalhes h2 {
            font-size: 15px;
            font-weight: bold;

            margin-bottom: 12px;
        }

        .detalhes p {
            font-family: Arial, sans-serif;

            font-size: 13px;
            line-height: 1.6;

            margin: 0;

            color: #333;
        }

        .modulo {
            margin-top: 46px;
        }

        .modulo-cabecalho {
            display: flex;
            align-items: center;

            gap: 20px;

            margin-bottom: 10px;
        }

        .modulo-indicador {
            width: 12px;
            height: 12px;

            background-color: var(--vinho);
        }

        .modulo-titulo {
            font-size: 15px;
            font-weight: normal;

            margin: 0;
        }

        .timeline {
            position: relative;

            margin-left: 4px;
        }

        .timeline a{
            text-decoration: none;
            color: var(--preto);
        }

        .timeline::before {
            content: "";

            position: absolute;

            left: 0;
            top: 0;
            bottom: 0;

            width: 2px;

            background-color: #777;
        }

        .aula {
            position: relative;

            min-height: 65px;

            padding-left: 32px;
            padding-right: 45px;

            display: flex;
            align-items: center;
        }

        .aula::before {
            content: "";

            position: absolute;

            left: -5px;

            width: 11px;
            height: 11px;

            border-radius: 50%;

            background-color: var(--vinho);
        }

        .aula.principal {
            min-height: 75px;
        }

        .aula.principal::before {
            display: none;
        }

        .aula h3 {
            font-size: 17px;

            font-weight: bold;

            margin: 0;
        }

        .aula span {
            font-size: 14px;
            font-weight: normal;

            line-height: 1.4;
        }

        .btn-play {
            position: absolute;

            right: 0;

            width: 30px;
            height: 30px;

            border: none;
            border-radius: 50%;

            background-color: var(--vinho);

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;
        }

        .btn-play i {
            color: var(--amarelo);

            font-size: 16px;

            margin-left: 2px;
        }

        .exercicios {
            min-height: 58px;
        }

        .icone-exercicio {
            position: absolute;

            right: 2px;

            font-size: 18px;

            color: #444;
        }

    </style>

</head>


<body>


    <?php
        include("../alexandria-frontend/includes/header.html");
    ?>

    <header class="hero">

        <div class="curso">

            <div class="curso-indicador"></div>

            <span>
                Curso Preparatório para vestibular
            </span>

        </div>

        <h1>
            Era Vargas
        </h1>

    </header>

    <main class="conteudo">

        <section class="detalhes">

            <div class="detalhes-titulo">
                Detalhes
            </div>

            <h2>
                O que você aprenderá nesse módulo:
            </h2>

            <p>
                Este é um dos principais módulos do percurso de Ciências
                Humanas e grandes vestibulares. Aqui, retornaremos, de acordo
                com o contexto histórico da época, a ascensão de Getúlio
                Vargas ao poder, as diferentes manifestações entre os
                diferentes grupos políticos, além da criação e consolidação
                das leis trabalhistas no país.
            </p>

        </section>

        <section class="modulo">

            <div class="modulo-cabecalho">

                <div class="modulo-indicador"></div>

                <h2 class="modulo-titulo">
                    Módulo
                </h2>

            </div>


            <div class="timeline">

                <?php foreach ($modulo_aulas_era_vargas as $item): ?>

                    <?php if ($item['tipo'] === 'principal'): ?>
                        <div class="aula principal">
                            <a href="<?= htmlspecialchars($item['link']) ?>">
                                <h3>
                                    <?= htmlspecialchars($item['titulo']) ?>
                                    <span><?= htmlspecialchars($item['subtitulo']) ?></span>
                                </h3>
                            </a>
                        </div>

                    <?php elseif ($item['tipo'] === 'exercicio'): ?>
                        <div class="aula exercicios">
                            <span><?= htmlspecialchars($item['titulo']) ?></span>
                            <i class="bi bi-clipboard icone-exercicio"></i>
                        </div>

                    <?php else: ?>
                        <div class="aula">
                            <span><?= htmlspecialchars($item['titulo']) ?></span>
                            <button class="btn-play">
                                <i class="bi bi-play-fill"></i>
                            </button>
                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

        </section>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>