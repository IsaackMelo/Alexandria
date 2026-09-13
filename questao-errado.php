<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Questão 01 (Resposta Incorreta)</title>

    <link rel="icon" type="image/png" href="imagens/alex.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/telaerro.css">

    <style>
        :root {
            --vinho-alexandria:   #8b1e2d;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --branco:             #ffffff;
            --bege-fundo:         #f5efe6;  
            --bege-card:          #fdf8f2;
            --bege-section:      #f9f5f1;
            --preto-contraste:   #1a1a1a;
            --cinza-texto:       #4a4a4a;
            --cinza-medio:       #e0e0e0;
        }
    </style>
</head>

<body>

    <?php
        include("includes/baraadm.html");
        include("includes/sidebaradm.html");
    ?>

        <a href="javascript:void(0)" onclick="history.back()" class="voltar">&lsaquo; Voltar para o Banco de questões</a>

        <!-- Painel com 2 colunas lado a lado -->
        <div class="painel-duplo">

            <!-- Coluna 1: Card da Questão -->
            <div class="card-custom">
                <div>
                    <span class="num-questao">01.</span>
                    <span class="fonte-questao">Fuvest 2023</span>
                    <p class="enunciado">
                        O governo de Getúlio Vargas (1930–1945) ficou marcado por medidas que
                        transformaram as relações entre o Estado e a sociedade brasileira.
                        Assinale a alternativa que melhor representa uma dessas medidas.
                    </p>
                </div>

                <hr class="divisor">

                <p class="titulo-alternativas">Alternativas:</p>

                <div class="lista-alternativas">
                    <div class="alternativa" data-letra="A">
                        <div class="letra">A</div>
                        <div>Criação da Constituição de 1891, que estabeleceu o federalismo brasileiro.</div>
                    </div>

                    <div class="alternativa" data-letra="B">
                        <div class="letra">B</div>
                        <div>Política de valorização do café por meio do Convênio de Taubaté.</div>
                    </div>

                    <div class="alternativa" data-letra="C">
                        <div class="letra">C</div>
                        <div>Criação da Consolidação das Leis do Trabalho (CLT).</div>
                    </div>

                    <div class="alternativa" data-letra="D">
                        <div class="letra">D</div>
                        <div>Adoção do parlamentarismo como forma de governo.</div>
                    </div>

                    <div class="alternativa" data-letra="E">
                        <div class="letra">E</div>
                        <div>Privatização de empresas estatais para reduzir a intervenção do Estado.</div>
                    </div>
                </div>
            </div>

            <!-- Coluna 2: Card de Progressão da Questão -->
            <div class="card-custom">
                <div class="progresso-header">
                    <h5>Progressão da questão</h5>
                    <span class="contador-progresso">1 de 1</span>
                </div>

                <!-- Contadores de Status -->
                <div class="lista-status">
                    <div class="badge-progresso badge-acerto"><span>Acertos</span> <strong>0</strong></div>
                    <div class="badge-progresso badge-erro"><span>Erros</span> <strong>1</strong></div>
                    <div class="badge-progresso badge-branco"><span>Em Branco</span> <strong>0</strong></div>
                </div>

                <hr class="divisor">

                <!-- Tempo Gasto -->
                <div class="linha-tempo">
                    <span>Tempo gasto</span>
                    <strong>00:02:45</strong>
                </div>

                <!-- Questões Numeradas -->
                <div class="lista-progresso-questoes">
                    <span class="pill-questao pill-erro">1</span>
                    <span class="pill-questao pill-neutro">2</span>
                    <span class="pill-questao pill-neutro">3</span>
                </div>
            </div>

        </div>

        <!-- Card Inferior: Feedback / Resposta Errada -->
        <div class="card-feedback">
            <div class="feedback-conteudo">
                <div class="feedback-titulo">
                    <i class="fa-solid fa-circle-xmark"></i>
                    Resposta errada
                </div>

                <p class="feedback-texto">
                    O governo Vargas promoveu diversas reformas trabalhistas, sendo a Consolidação das Leis do Trabalho (CLT), criada em 1943, uma das principais. Ela unificou a legislação trabalhista e garantiu direitos como férias, jornada de trabalho limitada e proteção ao trabalhador.
                </p>

                <div class="feedback-gabarito">Gabarito correto: C</div>

                <div class="feedback-referencia">
                    <strong>Referência:</strong><br>
                    FAUSTO, Boris. História do Brasil. São Paulo: Edusp, 2018.
                </div>
            </div>

            <div>
                <img src="imagens/vargas.jpg" alt="Getúlio Vargas" class="feedback-imagem">
            </div>
        </div>

        <!-- Botões de Navegação Inferiores -->
        <div class="botoes-navegacao">
            <a href="questao.php" class="btn-nav-outline"><i class="fa-solid fa-chevron-left"></i> Questão anterior</a>
            <a href="#" class="btn-nav-vinho">Próxima questão <i class="fa-solid fa-chevron-right"></i></a>
        </div>

    </main>

    <script>
        // Pega a letra que veio na URL (exemplo: telaerro.html?letra=A)
        const params = new URLSearchParams(window.location.search);
        const letraMarcada = params.get("letra") || "D";

        // Procura a alternativa com essa letra e adiciona a cor vermelha (classe errada)
        const alternativa = document.querySelector(`.alternativa[data-letra="${letraMarcada}"]`);
        if (alternativa) {
            alternativa.classList.add("errada");
        }
    </script>

</body>

</html>