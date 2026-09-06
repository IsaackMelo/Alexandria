<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Era Vargas</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
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
            padding-top: 43px;;
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

            font-size: 9px;
            color: white;
        }

        .curso-indicador {
            width: 12px;
            height: 12px;
            background-color: var(--amarelo);
        }

        .hero h1 {
            font-size: 17px;
            font-weight: bold;
            margin: 0;
        }

        .conteudo {
            padding: 14px 17px 40px;
        }

        .detalhes {
            background-color: var(--bege);

            border-radius: 7px;

            padding: 13px;

            min-height: 180px;
        }

        .detalhes-titulo {
            font-size: 10px;
            font-weight: bold;

            margin-bottom: 38px;
        }

        .detalhes h2 {
            font-size: 10px;
            font-weight: bold;

            margin-bottom: 12px;
        }

        .detalhes p {
            font-family: Arial, sans-serif;

            font-size: 7px;
            line-height: 1.45;

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
            width: 10px;
            height: 10px;

            background-color: var(--vinho);
        }

        .modulo-titulo {
            font-size: 10px;
            font-weight: normal;

            margin: 0;
        }

        .timeline {
            position: relative;

            margin-left: 4px;
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

            min-height: 56px;

            padding-left: 27px;
            padding-right: 35px;

            display: flex;
            align-items: center;
        }

        .aula::before {
            content: "";

            position: absolute;

            left: -4px;

            width: 10px;
            height: 10px;

            border-radius: 50%;

            background-color: var(--vinho);
        }

        .aula.principal {
            min-height: 70px;
        }

        .aula.principal::before {
            display: none;
        }

        .aula h3 {
            font-size: 12px;

            font-weight: bold;

            margin: 0;
        }

        .aula span {
            font-size: 8px;
            font-weight: normal;
        }

        .btn-play {
            position: absolute;

            right: 0;

            width: 27px;
            height: 27px;

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

            font-size: 13px;

            margin-left: 2px;
        }

        .exercicios {
            min-height: 50px;
        }

        .icone-exercicio {
            position: absolute;

            right: 2px;

            font-size: 14px;

            color: #444;
        }

    </style>
</head>

<body>

 <?php
    include __DIR__ . '/header.html';
 ?>

    <header class="hero">

        <div class="curso">
            <div class="curso-indicador"></div>

            <span>
                Curso Preparatório para vestibular
            </span>
        </div>

        <h1>Era Vargas</h1>

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


        <!-- MÓDULO -->

        <section class="modulo">

            <div class="modulo-cabecalho">

                <div class="modulo-indicador"></div>

                <h2 class="modulo-titulo">
                    Módulo
                </h2>

            </div>

            <div class="timeline">

                <div class="aula principal">

                    <h3>
                        Era Vargas
                        <span>(1930 - 1945)</span>
                    </h3>

                </div>

                <div class="aula">

                    <span>
                        Revolução de 1930
                    </span>

                    <button class="btn-play">
                        <i class="bi bi-play-fill"></i>
                    </button>

                </div>

                <div class="aula">

                    <span>
                        Governo Provisório
                        (1930 - 1934)
                    </span>

                    <button class="btn-play">
                        <i class="bi bi-play-fill"></i>
                    </button>

                </div>

                <div class="aula">

                    <span>
                        Governo Constitucional
                        (1934 - 1937)
                    </span>

                    <button class="btn-play">
                        <i class="bi bi-play-fill"></i>
                    </button>

                </div>

                <div class="aula">

                    <span>
                        Estado Novo
                        (1937 - 1945)
                    </span>

                    <button class="btn-play">
                        <i class="bi bi-play-fill"></i>
                    </button>

                </div>

                <div class="aula">

                    <span>
                        Fim da Era Vargas
                    </span>

                    <button class="btn-play">
                        <i class="bi bi-play-fill"></i>
                    </button>

                </div>

                <div class="aula exercicios">

                    <span>
                        Lista de exercícios 3
                    </span>

                    <i class="bi bi-clipboard icone-exercicio"></i>

                </div>

                <div class="aula exercicios">

                    <span>
                        Lista de exercícios 2
                    </span>

                    <i class="bi bi-clipboard icone-exercicio"></i>

                </div>

                <div class="aula exercicios">

                    <span>
                        Lista de exercícios 1
                    </span>

                    <i class="bi bi-clipboard icone-exercicio"></i>

                </div>

            </div>

        </section>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>
