<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Acervo FUVEST</title>

    <!-- Iconezinho da aba -->
    <link rel="icon" type="image/png" href="imagens/alex.png">

    <!-- Icones do font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <!-- Fonte Inter do google -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS da pagina -->
    <link rel="stylesheet" href="estilo/telaacervoesp.css">

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
        include("../alexandria-frontend/includes/sidebar.html");
    ?>

       <?php
        include("../alexandria-frontend/includes/barra-superior.html");
    ?>
    <main class="conteudo">


    

        <p class="subtitulo">Treine com questões de história e melhore seu desempenho.</p>

        <!-- Cardzao com info da Fuvest e os filtros -->
        <section class="card-acervo">
            
            <!-- Lado esquerdo: logo e textinho da Fuvest -->
            <div class="info-acervo">
                <img src="imagens/fuvest.jpg" alt="FUVEST" class="logo-fuvest">
                <div>
                    <h3>ACERVO FUVEST</h3>
                    <p>Consulte o histórico completo de provas de História da Fundação Universitária para o Vestibular. Acesse cadernos de questões, gabaritos e resoluções oficiais!</p>
                </div>
            </div>

            <!-- Lado direito: selects de filtro -->
            <div class="filtros">
                <div class="filtro-titulo">
                    <i class="fa-solid fa-filter"></i> Filtro
                </div>

                <div class="grid-filtros">
                    <!-- Filtro dificuldade -->
                    <div class="campo-filtro">
                        <label for="filtroDificuldade">Nível de dificuldade</label>
                        <select id="filtroDificuldade">
                            <option value="todos">Qualquer dificuldade</option>
                            <option value="Facil">Fácil</option>
                            <option value="Medio">Médio</option>
                            <option value="Dificil">Difícil</option>
                        </select>
                    </div>

                    <!-- Filtro ano min e max -->
                    <div class="campo-filtro">
                        <label>Data de referência</label>
                        <div class="grupo-anos">
                            <select id="filtroAnoMin">
                                <option value="todos">Ano mínimo</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                            <select id="filtroAnoMax">
                                <option value="todos">Ano máximo</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>

                    <!-- Filtro fase -->
                    <div class="campo-filtro">
                        <label for="filtroFase">Fase</label>
                        <select id="filtroFase">
                            <option value="todos">Ambas</option>
                            <option value="Fase 1">Fase 1</option>
                            <option value="Fase 2">Fase 2</option>
                        </select>
                    </div>

                    <!-- Filtro grupo -->
                    <div class="campo-filtro">
                        <label for="filtroGrupo">Grupo</label>
                        <select id="filtroGrupo">
                            <option value="todos">Qualquer Grupo</option>
                            <option value="Grupo 1">Grupo 1</option>
                            <option value="Grupo 2">Grupo 2</option>
                        </select>
                    </div>

                    <!-- Filtro dia -->
                    <div class="campo-filtro">
                        <label for="filtroDia">Dia</label>
                        <select id="filtroDia">
                            <option value="todos">Ambos</option>
                            <option value="Dia 1">Dia 1</option>
                            <option value="Dia 2">Dia 2</option>
                        </select>
                    </div>

                    <!-- Botao de filtrar -->
                    <div class="campo-filtro campo-botao">
                        <button class="btn-filtrar" onclick="filtrarProvas()">Filtrar</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Barra pra ordenar por mais novo/antigo -->
        <div class="ordenar-area">
            <span>Ordenar por</span>
            <select id="selectOrdem" onchange="ordenarProvas()">
                <option value="recentes">Mais recentes</option>
                <option value="antigas">Mais antigas</option>
            </select>
        </div>

     
        <!-- os cards das provas -->
        
        <section class="lista-provas" id="listaProvas">

            <div class="item-prova" data-dificuldade="Medio" data-ano="2025" data-fase="Fase 1" data-versao="V1">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Fase 1</span>
                <span class="info-texto">V1</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            
            <div class="item-prova" data-dificuldade="Medio" data-ano="2025" data-fase="Fase 1" data-versao="V2">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Fase 1</span>
                <span class="info-texto">V2</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

        
            <div class="item-prova" data-dificuldade="Medio" data-ano="2025" data-fase="Fase 1" data-versao="V3">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Fase 1</span>
                <span class="info-texto">V3</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-ano="2025" data-fase="Fase 1" data-versao="V4">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Fase 1</span>
                <span class="info-texto">V4</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-ano="2025" data-fase="Fase 2" data-versao="Dia 1">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Fase 2</span>
                <span class="info-texto">Dia 1</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            
            <div class="item-prova" data-dificuldade="Medio" data-ano="2025" data-fase="Fase 2" data-versao="Dia 2">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Fase 2</span>
                <span class="info-texto">Dia 2</span>
                <div class="botoes-prova">
                <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Dificil" data-ano="2024" data-fase="Fase 1" data-versao="V1">
                <span class="badge-dificuldade dificil">Difícil</span>
                <span class="info-texto">2024</span>
                <span class="info-texto">Fase 1</span>
                <span class="info-texto">V1</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

          
            <div class="item-prova" data-dificuldade="Dificil" data-ano="2024" data-fase="Fase 1" data-versao="V2">
                <span class="badge-dificuldade dificil">Difícil</span>
                <span class="info-texto">2024</span>
                <span class="info-texto">Fase 1</span>
                <span class="info-texto">V2</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

        </section>

    </main>

    <!-- js: filtrar e ordenar os elementos-->

    <script>
        // Funcao pra filtrar as provas
        function filtrarProvas() {
            // Pega oq o user escolheu nos selects
            const dif = document.getElementById('filtroDificuldade').value;
            const anoMin = document.getElementById('filtroAnoMin').value;
            const anoMax = document.getElementById('filtroAnoMax').value;
            const fase = document.getElementById('filtroFase').value;
            const dia = document.getElementById('filtroDia').value;

            // Pega todos os cards de prova da tela
            const itens = document.querySelectorAll('.item-prova');

            // Passa de card em card checando se bate com o filtro
            itens.forEach(function(item) {
                let mostrar = true;

                // Se o filtro for diferente de 'todos' e nn bater, esconde
                if (dif !== 'todos' && item.dataset.dificuldade !== dif) mostrar = false;
                if (anoMin !== 'todos' && parseInt(item.dataset.ano) < parseInt(anoMin)) mostrar = false;
                if (anoMax !== 'todos' && parseInt(item.dataset.ano) > parseInt(anoMax)) mostrar = false;
                if (fase !== 'todos' && item.dataset.fase !== fase) mostrar = false;
                if (dia !== 'todos' && item.dataset.versao !== dia) mostrar = false;

                // Se mostrar for true da display flex, se for false da none (some)
                item.style.display = mostrar ? 'flex' : 'none';
            });
        }

        // Funcao pra ordenar os cards por ano
        function ordenarProvas() {
            const ordem = document.getElementById('selectOrdem').value;
            const lista = document.getElementById('listaProvas');
            const itens = Array.from(document.querySelectorAll('.item-prova'));

            // Compara os anos de 2 em 2
            itens.sort(function(a, b) {
                const anoA = parseInt(a.dataset.ano);
                const anoB = parseInt(b.dataset.ano);

                // Se for recentes: maior ano primeiro. Se antigas: menor ano primeiro
                return ordem === 'recentes' ? (anoB - anoA) : (anoA - anoB);
            });

            // Joga os cards de volta na lista na ordem certa
            itens.forEach(function(item) {
                lista.appendChild(item);
            });
        }
    </script>

</body>
</html>
