<html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            background: linear-gradient(180deg, #ffffff 0%, #fcfbfa 100%);
            color: #222;
            font-family: Georgia, "Times New Roman", serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
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

            background: linear-gradient(135deg, #8b1e2d 0%, #74172a 58%, #5f1524 100%);
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
            font-size: 25px;
            font-weight: bold;
            letter-spacing: -.02em;
            text-shadow: 0 2px 12px rgba(0,0,0,.16);
            margin: 0;
        }

        .conteudo {
            padding: 18px 24px 52px;
            max-width: 1180px;
            margin: 0 auto;
        }

        .detalhes {
            background: linear-gradient(135deg, #f7f1e8, #fbf8f3);
            border: 1px solid rgba(167,25,53,.06);
            border-radius: 12px;
            padding: 22px 24px;

            min-height: 180px;
            box-shadow: 0 8px 24px rgba(70,42,25,.055);
        }

        .detalhes-titulo {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: var(--vinho-escuro);
            margin-bottom: 26px;
        }

        .detalhes h2 {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: -.01em;
            margin-bottom: 13px;
        }

        .detalhes p {
            font-family: Arial, sans-serif;

            font-size: 13px;
            line-height: 1.72;
            letter-spacing: .008em;

            margin: 0;

            color: #333;
        }

        .modulo {
            margin-top: 50px;
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
            font-size: 16px;
            font-weight: normal;
            letter-spacing: .01em;
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

        /* Cada linha possui um contêiner próprio para a grifagem integral */
        .linha-opcao {
            width: 100%;
            border-top: 1px solid #dedede;
            transition: background-color .22s ease, box-shadow .22s ease;
        }

        .linha-opcao:not(:has(.principal)):hover,
        .linha-opcao:not(:has(.principal)):focus-within,
        .linha-opcao:not(:has(.principal)):has(.ativo) {
            background-color: #e9e9e9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
        }

        .aula {
            position: relative;
            min-height: 65px;
            height: 65px;
            padding: 0 58px 0 32px;
            display: flex;
            align-items: center;
            width: 100%;
            background: transparent;
        }

        .aula::before {
            content: "";
            position: absolute;
            left: -5px;
            top: 50%;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background-color: var(--vinho);
            transform: translateY(-50%);
        }

        .aula.principal {
            min-height: 75px;
            height: 75px;
            padding-left: 32px;
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

        /* Botão de play preservado no estilo original */
        .btn-play {
            position: absolute;
            right: 14px;
            top: 50%;
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 50%;
            background-color: var(--vinho);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .btn-play i {
            color: var(--amarelo);
            font-size: 16px;
            margin-left: 2px;
        }

        .exercicios {
            min-height: 65px;
            height: 65px;
        }

        .icone-exercicio {
            position: absolute;
            right: 18px;
            top: 50%;
            font-size: 18px;
            color: #444;
            transform: translateY(-50%);
        }

        .linha-opcao > .aula:not(.principal) > span,
        .linha-opcao > .aula:not(.principal) .btn-play,
        .linha-opcao > .aula:not(.principal) .icone-exercicio,
        .linha-opcao > .aula:not(.principal)::before {
            transition: color .22s ease, background-color .22s ease, box-shadow .22s ease;
        }

        .linha-opcao:not(:has(.principal)):hover > .aula > span,
        .linha-opcao:not(:has(.principal)):focus-within > .aula > span,
        .linha-opcao:has(.ativo) > .aula > span {
            color: #222;
            font-weight: 600;
        }

        /* O círculo permanece vermelho, inclusive quando a linha é grifada */
        .linha-opcao > .aula:not(.principal)::before,
        .linha-opcao:hover > .aula:not(.principal)::before,
        .linha-opcao:focus-within > .aula:not(.principal)::before,
        .linha-opcao:has(.ativo) > .aula:not(.principal)::before {
            background-color: var(--vinho);
            box-shadow: none;
        }

        .linha-opcao:not(:has(.principal)):focus-within {
            outline: 2px solid #10b8b5;
            outline-offset: -2px;
        }

        @media (prefers-reduced-motion: reduce) {
            .aula:not(.principal),
            .aula:not(.principal) > span,
            .aula:not(.principal)::before,
            .aula:not(.principal) .btn-play,
            .aula:not(.principal) .icone-exercicio {
                transition: none;
            }
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

                <div class="linha-opcao">
                    <div class="aula principal">
                    <a href="aula.php">
                        <h3>

                            Era Vargas

                            <span>
                                (1930 - 1945)
                            </span>

                        </h3>
                    </a>
                </div>
                </div>

                <div class="linha-opcao">
                    <div class="aula aula-video-item" data-aula="1">

                    <span>
                        Revolução de 1930
                    </span>

                    <a href="cursovideo.php"><button class="btn-play">

                        <i class="bi bi-play-fill"></i>

                    </button></a>

                </div>
                </div>

                <div class="linha-opcao">
                    <div class="aula aula-video-item" data-aula="2">

                    <span>
                        Governo Provisório
                        (1930 - 1934)
                    </span>

                    <a href="cursovideo.php#video-2"><button class="btn-play">

                        <i class="bi bi-play-fill"></i>

                    </button></a>

                </div>
                </div>

                <div class="linha-opcao">
                    <div class="aula aula-video-item" data-aula="3">

                    <span>
                        Governo Constitucional
                        (1934 - 1937)
                    </span>

                    <a href="cursovideo.php#video-3"><button class="btn-play">

                        <i class="bi bi-play-fill"></i>

                    </button></a>

                </div>
                </div>

                <div class="linha-opcao">
                    <div class="aula aula-video-item" data-aula="4">

                    <span>
                        Estado Novo
                        (1937 - 1945)
                    </span>

                    <a href="cursovideo.php#video-4"><button class="btn-play">

                        <i class="bi bi-play-fill"></i>

                    </button></a>

                </div>
                </div>

                <div class="linha-opcao">
                    <div class="aula aula-video-item" data-aula="5">

                    <span>
                        Fim da Era Vargas
                    </span>

                    <a href="cursovideo.php#video-5"><button class="btn-play">

                        <i class="bi bi-play-fill"></i>

                    </button></a>

                </div>
                </div>

                <div class="linha-opcao">
                    <div class="aula exercicios" data-exercicio="1" tabindex="0">

                    <span>
                        Lista de exercícios 1
                    </span>

                    <i class="bi bi-clipboard icone-exercicio"></i>

                </div>
                </div>


                <div class="linha-opcao">
                    <div class="aula exercicios" data-exercicio="2" tabindex="0">

                    <span>
                        Lista de exercícios 2
                    </span>

                    <i class="bi bi-clipboard icone-exercicio"></i>

                </div>
                </div>


                <div class="linha-opcao">
                    <div class="aula exercicios" data-exercicio="3" tabindex="0">

                    <span>
                        Lista de exercícios 3
                    </span>

                    <i class="bi bi-clipboard icone-exercicio"></i>

                </div>
                </div>


            </div>

        </section>

    </main>


    <script>
      (() => {
        const itens = [...document.querySelectorAll('.aula-video-item')];
        itens.forEach(item => {
          const link = item.querySelector('a[href]');
          item.addEventListener('click', event => {
            if (event.target.closest('.btn-play')) return;
            event.preventDefault();
            itens.forEach(outro => outro.classList.remove('ativo'));
            item.classList.add('ativo');
            if (link) setTimeout(() => { window.location.href = link.href; }, 20);
          });
        });

        const listas = [...document.querySelectorAll('.aula.exercicios[data-exercicio]')];
        listas.forEach(lista => {
          const abrirTelaDeQuestao = () => {
            window.location.href = 'teladequest.php?lista=' + encodeURIComponent(lista.dataset.exercicio);
          };
          lista.addEventListener('click', abrirTelaDeQuestao);
          lista.addEventListener('keydown', event => {
            if (event.key === 'Enter' || event.key === ' ') {
              event.preventDefault();
              abrirTelaDeQuestao();
            }
          });
        });
      })();
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>
