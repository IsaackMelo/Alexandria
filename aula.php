<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Revolução de 1930</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --vinho-alexandria:   #8b1e2d;
    --vinho-escuro:       #5e1220;
    --dourado-alexandria: #d4af37;
    --dourado-claro:      #f0d060;
    --bege-fundo:         #f5efe6;
    --bege-card:          #fdf8f2;
    --preto-contraste:    #1a1a1a;
    --cinza-destaque:     #dee0e3;
    --cinza-texto:        #555;
    --branco:             #ffffff;
}

html,
body {
    width: 100%;
    height: 100%;
    font-family: Arial, Helvetica, sans-serif;
    background: var(--branco);
}

.topbar {
    width: 100%;
    height: 50px;

    background: var(--vinho-alexandria);

    display: flex;
    align-items: center;
    justify-content: space-between;

    color: white;

    padding: 0 12px;

    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);

    position: fixed;
    top: 0;
    left: 0;

    z-index: 1000;
}

.topbar-left {
    height: 100%;

    display: flex;
    align-items: center;
}

.menu-button {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(255,255,255,0.8);
    border-radius: 4px;

    background: transparent;
    color: white;

    margin-right: 20px;

    cursor: pointer;
}

.menu-button i {
    font-size: 21px;
}

.page-title {
    font-size: 14px;
    font-weight: 600;

    white-space: nowrap;
}

.topbar-right {
    display: flex;
    align-items: center;

    height: 100%;

    gap: 12px;
}

.topbar-icon {
    width: 32px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: transparent;
    border: none;

    color: white;

    cursor: pointer;
}

.topbar-icon i {
    font-size: 19px;
}

.page {
    width: 100%;
    min-height: 100vh;

    padding-top: 50px;

    display: flex;
}

.sidebar {
    width: 260px;
    min-width: 260px;

    min-height: calc(100vh - 50px);

    border-right: 1px solid #ddd;

    padding: 10px 5px;

    background: #fff;
}

.back-button {
    height: 42px;

    display: flex;
    align-items: center;

    padding-left: 7px;

    border-bottom: 1px solid #999;

    font-size: 13px;
    font-weight: 600;

    color: var(--preto-contraste);

    cursor: pointer;
}

.back-button i {
    font-size: 22px;
    margin-right: 14px;
}

.sidebar-title {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 10px 5px 7px;

    color: var(--vinho-alexandria);

    font-size: 13px;
    font-weight: 700;
}

.sidebar-tools {
    display: flex;
    gap: 14px;

    color: #777;
}

.sidebar-tools i {
    font-size: 17px;
}

.sidebar-search {
    width: 100%;
    height: 32px;

    border: 1px solid #ddd;
    border-radius: 4px;

    padding: 0 9px;

    font-size: 12px;

    margin-bottom: 7px;
}

.lesson-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.lesson-item {
    min-height: 40px;

    display: flex;
    align-items: center;

    padding: 5px 7px;

    font-size: 12px;

    cursor: pointer;

    border-radius: 4px;
}

.lesson-item.active {
    background: #f3ede5;
}

.lesson-number {
    width: 24px;
    height: 24px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: var(--vinho-alexandria);
    color: white;

    font-size: 12px;
    font-weight: bold;

    margin-right: 9px;

    flex-shrink: 0;
}

.lesson-name {
    flex: 1;
    line-height: 1.3;
}

.lesson-check {
    width: 11px;
    height: 11px;

    border: 1px solid #ddd;

    border-radius: 50%;

    flex-shrink: 0;
}

.content {
    flex: 1;

    min-width: 0;

    padding: 50px 40px 70px 45px;

    background: var(--branco);
}

.breadcrumb-area {
    display: flex;
    align-items: center;

    margin-bottom: 24px;
}

.breadcrumb {
    display: flex;
    align-items: center;

    margin-bottom: 0;
}

.breadcrumb-item {
    display: flex;
    align-items: center;

    color: #b1954a;

    font-size: 12px;
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";

    color: #555;

    font-size: 20px;
    line-height: 1;

    padding: 0 11px;

    display: flex;
    align-items: center;
}

.next-button {
    margin-left: auto;

    background: #f1cc54;

    border: none;
    border-radius: 5px;

    color: var(--preto-contraste);

    font-size: 12px;
    font-weight: 600;

    padding: 9px 14px;

    cursor: pointer;
}

.next-button i {
    margin-left: 7px;
    font-size: 14px;
}

.content h1 {
    font-size: 24px;

    font-weight: 700;

    margin-bottom: 22px;
}

.content h2 {
    font-size: 20px;

    font-weight: 700;

    margin-bottom: 24px;
}

.content p {
    max-width: 100%;

    font-size: 16px;

    line-height: 1.65;

    color: #222;

    text-align: justify;

    margin-bottom: 0;
}

.section-divider {
    width: 100%;

    border: none;
    border-top: 1px solid #888;

    margin: 70px 0 48px;
}


.materiais {
    width: 100%;
    margin-top: 65px;
}

.materiais-titulo {
    display: inline-block;

    font-family: Georgia, "Times New Roman", serif;
    font-size: 20px;
    font-weight: 700;

    color: #333;

    padding-bottom: 3px;
    border-bottom: 3px solid #333;

    margin-bottom: 25px;
}

.material-item {
    width: 100%;
    min-height: 85px;

    border-top: 1px solid #555;
    border-bottom: 1px solid #555;

    display: flex;
    align-items: center;

    padding: 14px 18px;

    transition: background-color 0.2s ease;
}

.material-item:hover {
    background-color: #fafafa;
}

.material-icon {
    width: 55px;
    min-width: 55px;

    display: flex;
    align-items: center;
    justify-content: flex-start;

    color: #333;
}

.material-icon i {
    font-size: 35px;
}

.material-info {
    display: flex;
    flex-direction: column;
    justify-content: center;

    flex: 1;
    min-width: 0;
}

.material-name {
    font-family: Georgia, "Times New Roman", serif;

    font-size: 17px;
    font-weight: 700;

    color: #222;

    margin-bottom: 4px;
}

.material-size {
    font-size: 13px;
    color: #555;
}

.material-download {
    display: flex;
    align-items: center;

    gap: 35px;
    margin-left: 20px;
}

.material-download-text {
    font-family: Georgia, "Times New Roman", serif;

    font-size: 17px;
    font-weight: 700;

    color: #222;
}

.material-download-button {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: none;
    background: transparent;

    color: #333;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        color 0.2s ease;
}

.material-download-button i {
    font-size: 27px;
}

.material-download-button:hover {
    color: var(--vinho-alexandria);
    transform: translateY(2px);
}

</style>

</head>

<body>

    <?php
        include("../FRONT/includes/header.html");
    ?>


    <main class="page">

        <aside class="sidebar">

            <div class="back-button">

                <i class="bi bi-arrow-left"></i>

                <span>
                    Voltar para as videoaulas
                </span>

            </div>


            <div class="sidebar-title">

                <span>
                    Lista de Conteúdos
                </span>

                <div class="sidebar-tools">

                    <i class="bi bi-gear-fill"></i>

                    <i class="bi bi-box-arrow-right"></i>

                </div>

            </div>


            <input
                type="text"
                class="sidebar-search"
                placeholder="Buscar conteúdo">


            <ul class="lesson-list">


                <li class="lesson-item active">

                    <span class="lesson-number">
                        1
                    </span>

                    <span class="lesson-name">
                        Era Vargas: Revolução de 1930
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span class="lesson-number">
                        2
                    </span>

                    <span class="lesson-name">
                        Era Vargas: Governo Provisório
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span class="lesson-number">
                        3
                    </span>

                    <span class="lesson-name">
                        Era Vargas: Governo Constitucional
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span class="lesson-number">
                        4
                    </span>

                    <span class="lesson-name">
                        Era Vargas: Estado Novo
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span class="lesson-number">
                        5
                    </span>

                    <span class="lesson-name">
                        Era Vargas: Fim da Era Vargas
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span style="width:18px;">
                        <i class="bi bi-clipboard"></i>
                    </span>

                    <span class="lesson-name">
                        Lista de Exercícios 1
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span style="width:18px;">
                        <i class="bi bi-clipboard"></i>
                    </span>

                    <span class="lesson-name">
                        Lista de Exercícios 2
                    </span>

                    <span class="lesson-check"></span>

                </li>


                <li class="lesson-item">

                    <span style="width:18px;">
                        <i class="bi bi-clipboard"></i>
                    </span>

                    <span class="lesson-name">
                        Lista de Exercícios 3
                    </span>

                    <span class="lesson-check"></span>

                </li>


            </ul>

        </aside>

        <section class="content">

            <div class="breadcrumb-area">

                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item">
                            História do Brasil
                        </li>

                        <li class="breadcrumb-item">
                            Era Vargas
                        </li>

                        <li class="breadcrumb-item active">
                            1. Revolução de 1930
                        </li>

                    </ol>

                </nav>


                <button class="next-button">

                    Próximo

                    <i class="bi bi-chevron-right"></i>

                </button>

            </div>

            <h1>
                1. Revolução de 1930
            </h1>


            <p>
                Entenda como ocorreu o golpe de Estado cívico-militar
                que depôs o presidente da República Washington Luís em
                24 de outubro de 1930 e impediu a posse do presidente
                eleito Júlio Prestes, encerrando o período conhecido
                como República Velha.
            </p>


            <hr class="section-divider">

            <h2>
                1. Introdução
            </h2>


            <p>
                A Revolução de 1930 representa um ponto de inflexão
                fundamental na história política brasileira, marcando
                o colapso da República Oligárquica e o início de um
                novo ciclo político sob a liderança de Getúlio Vargas.
                Este movimento cívico-militar, que culminou na deposição
                do presidente Washington Luís em 24 de outubro de 1930
                e impediu a posse do presidente eleito Júlio Prestes,
                reconfigurou profundamente as estruturas de poder
                político e econômico do país, abrindo caminho para a
                Era Vargas e as transformações que caracterizariam o
                Brasil do século XX.
            </p>


            <hr class="section-divider">

            <h2>
                2. Contexto Histórico: A Primeira República e Suas Contradições
            </h2>


            <p>
                A Primeira República brasileira, estabelecida em 1889
                após a proclamação da República, foi construída sobre
                um sistema político que concentrou o poder nas mãos
                das oligarquias estaduais, particularmente as de São
                Paulo e Minas Gerais. Este período, que se estenderia
                até 1930, ficaria conhecido como República Oligárquica,
                caracterizando-se pela exclusão política de amplos
                setores da população e pela manipulação sistemática
                dos processos eleitorais.
                <br><br>

                A estrutura política da Primeira República baseava-se
                na chamada Política dos Governadores, estabelecida
                durante o governo de Campos Sales (1898-1902). Este
                sistema funcionava através de um pacto entre o governo
                federal e os governos estaduais, garantindo a reeleição
                do presidente em exercício e a vitória dos candidatos
                governistas nas eleições.
                <br><br>

                O Congresso Nacional, composto por representantes das
                oligarquias locais, raramente questionava as decisões
                do Executivo, criando um sistema de poder altamente
                centralizado nas mãos do presidente e das elites
                estaduais.
            </p>

            <hr class="section-divider">

            <h2>
                3. As Causas Estruturais da Crise de 1930
            </h2>


            <p>
                A primeira causa fundamental da Revolução de 1930 residia 
                na crescente insatisfação de outras oligarquias estaduais 
                com o sistema de poder vigente. Estados como Rio Grande do 
                Sul, Paraíba, Bahia e Rio de Janeiro viam-se sistematicamente 
                excluídos das decisões políticas importantes, tendo suas demandas 
                negligenciadas em favor dos interesses paulistas e mineiros. 
                Esta exclusão gerava um sentimento de injustiça política que 
                se intensificava à medida que estes estados ganhavam importância 
                econômica e demográfica.
                <br><br>
                O Rio Grande do Sul, em particular, sob a liderança de Getúlio 
                Vargas, havia desenvolvido uma elite política sofisticada e 
                ambiciosa que questionava a legitimidade do sistema oligárquico. 
                A Paraíba, por sua vez, sob o comando de João Pessoa, também 
                buscava maior participação no cenário político nacional. Estes 
                estados, juntamente com Minas Gerais (que também enfrentava divisões 
                internas), forneceriam a base para a articulação de uma frente de 
                oposição ao governo federal.
            </p>

            <div class="materiais">

                <div class="materiais-titulo">
                    Materiais
                </div>

                <div class="material-item">

                    <div class="material-icon">
                        <i class="bi bi-file-earmark-word"></i>
                    </div>

                    <div class="material-info">

                        <div class="material-name">
                            Exercícios revolução de 1930
                        </div>

                        <div class="material-size">
                            Word - 15.62 KB
                        </div>

                    </div>

                    <div class="material-download">

                        <span class="material-download-text">
                            Download
                        </span>

                        <button
                            type="button"
                            class="material-download-button"
                            title="Baixar material">

                            <i class="bi bi-download"></i>

                        </button>

                    </div>

                </div>

            </div>


        </section>

    </main>

</body>

</html>