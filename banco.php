<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria - Acervo Geral</title>

    <link rel="icon" type="image/png" href="imagens/alex.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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

    <?php include("../alexandria-frontend/includes/barra-superior.html");?>


    <main class="conteudo">



        <p class="subtitulo">Treine com questões de história e melhore seu desempenho.</p>

        <section class="card-acervo card-filtros-completo">

            <div class="filtros-topo-titulo">
                <i class="fa-solid fa-filter"></i> Filtro
            </div>

            <div class="filtros-grid-principal">

                <div class="filtros-lado-esquerdo">

                    <div class="linha-selects-3">
                        <div class="campo-filtro">
                            <label for="filtroDificuldade">Nível de dificuldade</label>
                            <select id="filtroDificuldade">
                                <option value="todos">Qualquer dificuldade</option>
                                <option value="Facil">Fácil</option>
                                <option value="Medio">Médio</option>
                                <option value="Dificil">Difícil</option>
                            </select>
                        </div>

                        <div class="campo-filtro">
                            <label for="filtroAssunto">Assuntos</label>
                            <select id="filtroAssunto">
                                <option value="todos">Todos os assuntos</option>
                                <option value="Revolução Francesa">Revolução Francesa</option>
                                <option value="Segunda Guerra">Segunda Guerra</option>
                                <option value="Estado Novo">Estado Novo</option>
                                <option value="Ditadura Militar">Ditadura Militar</option>
                                <option value="Primeira Guerra Mundial">Primeira Guerra Mundial</option>
                                <option value="Revolução Industrial">Revolução Industrial</option>
                                <option value="Canudos">Canudos</option>
                                <option value="Era Vargas">Era Vargas</option>
                            </select>
                        </div>

                        <div class="campo-filtro">
                            <label for="filtroVestibular">Vestibular</label>
                            <select id="filtroVestibular">
                                <option value="todos">Todos os vestibulares</option>
                                <option value="ENEM">ENEM</option>
                                <option value="FUVEST">FUVEST</option>
                                <option value="UNICAMP">UNICAMP</option>
                                <option value="UNESP">UNESP</option>
                                <option value="CEBRASPE">CEBRASPE</option>
                            </select>
                        </div>
                    </div>

                    <div class="linha-selects-2">
                        <div class="campo-filtro">
                            <label>Data de referência</label>
                            <div class="grupo-anos">
                                <select id="filtroAnoMin">
                                    <option value="todos">Ano mínimo</option>
                                    <option value="2012">2012</option>
                                    <option value="2015">2015</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2025">2025</option>
                                </select>
                                <select id="filtroAnoMax">
                                    <option value="todos">Ano máximo</option>
                                    <option value="2012">2012</option>
                                    <option value="2015">2015</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>

                        <div class="campo-filtro">
                            <label for="filtroTipo">Tipo de questão</label>
                            <select id="filtroTipo">
                                <option value="todos">Ambos</option>
                                <option value="Alternativo">Alternativo</option>
                                <option value="Dissertativo">Dissertativo</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="filtros-lado-direito">

                    <div class="campo-busca">
                        <label for="inputBusca">Pesquise por questões:</label>
                        <div class="input-busca-wrapper">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="inputBusca" placeholder="Buscar questões..." oninput="filtrarProvas()">
                        </div>
                    </div>

                    <div class="area-botao-filtrar">
                        <button class="btn-filtrar" onclick="filtrarProvas()">Filtrar</button>
                    </div>

                </div>

            </div>
        </section>

        <div class="ordenar-area">
            <span>Ordenar por</span>
            <select id="selectOrdem" onchange="ordenarProvas()">
                <option value="recentes">Mais recentes</option>
                <option value="antigas">Mais antigas</option>
            </select>
        </div>

        <section class="lista-provas" id="listaProvas">

            <div class="item-prova" data-dificuldade="Facil" data-assunto="Revolução Francesa" data-vestibular="UNICAMP" data-ano="2020" data-tipo="Dissertativo">
                <span class="badge-dificuldade facil">Fácil</span>
                <span class="info-texto">Revolução Francesa</span>
                <span class="info-texto">UNICAMP</span>
                <span class="info-texto">2020</span>
                <span class="info-texto">Dissertativo</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-assunto="Segunda Guerra" data-vestibular="FUVEST" data-ano="2021" data-tipo="Alternativo">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">Segunda Guerra</span>
                <span class="info-texto">FUVEST</span>
                <span class="info-texto">2021</span>
                <span class="info-texto">Alternativo</span>
                <div class="botoes-prova">
                 <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-assunto="Estado Novo" data-vestibular="CEBRASPE" data-ano="2015" data-tipo="Alternativo">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">Estado Novo</span>
                <span class="info-texto">CEBRASPE</span>
                <span class="info-texto">2015</span>
                <span class="info-texto">Alternativo</span>
                <div class="botoes-prova">
                   <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-assunto="Ditadura Militar" data-vestibular="UNICAMP" data-ano="2017" data-tipo="Dissertativo">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">Ditadura Militar</span>
                <span class="info-texto">UNICAMP</span>
                <span class="info-texto">2017</span>
                <span class="info-texto">Dissertativo</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Facil" data-assunto="Primeira Guerra Mundial" data-vestibular="UNESP" data-ano="2019" data-tipo="Alternativo">
                <span class="badge-dificuldade facil">Fácil</span>
                <span class="info-texto">Primeira Guerra Mundial</span>
                <span class="info-texto">UNESP</span>
                <span class="info-texto">2019</span>
                <span class="info-texto">Alternativo</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Dificil" data-assunto="Revolução Industrial" data-vestibular="UNICAMP" data-ano="2018" data-tipo="Alternativo">
                <span class="badge-dificuldade dificil">Difícil</span>
                <span class="info-texto">Revolução Industrial</span>
                <span class="info-texto">UNICAMP</span>
                <span class="info-texto">2018</span>
                <span class="info-texto">Alternativo</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-assunto="Canudos" data-vestibular="UNICAMP" data-ano="2012" data-tipo="Alternativo">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">Canudos</span>
                <span class="info-texto">UNICAMP</span>
                <span class="info-texto">2012</span>
                <span class="info-texto">Alternativo</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

            <div class="item-prova" data-dificuldade="Medio" data-assunto="Era Vargas" data-vestibular="ENEM" data-ano="2025" data-tipo="Dissertativo">
                <span class="badge-dificuldade medio">Médio</span>
                <span class="info-texto">Era Vargas</span>
                <span class="info-texto">ENEM</span>
                <span class="info-texto">2025</span>
                <span class="info-texto">Dissertativo</span>
                <div class="botoes-prova">
                    <a href="teladequest.php" class="btn-prova">Prova</a>
                    <button class="btn-gabarito">Gabarito</button>
                </div>
            </div>

        </section>

    </main>

    <script>

        function filtrarProvas() {

            const dif = document.getElementById('filtroDificuldade').value;
            const assunto = document.getElementById('filtroAssunto').value;
            const vestibular = document.getElementById('filtroVestibular').value;
            const anoMin = document.getElementById('filtroAnoMin').value;
            const anoMax = document.getElementById('filtroAnoMax').value;
            const tipo = document.getElementById('filtroTipo').value;
            const busca = document.getElementById('inputBusca').value.toLowerCase();

            const itens = document.querySelectorAll('.item-prova');

            itens.forEach(function(item) {
                let mostrar = true;

                if (dif !== 'todos' && item.dataset.dificuldade !== dif) mostrar = false;

                if (assunto !== 'todos' && item.dataset.assunto !== assunto) mostrar = false;

                if (vestibular !== 'todos' && item.dataset.vestibular !== vestibular) mostrar = false;

                if (anoMin !== 'todos' && parseInt(item.dataset.ano) < parseInt(anoMin)) mostrar = false;
                if (anoMax !== 'todos' && parseInt(item.dataset.ano) > parseInt(anoMax)) mostrar = false;

                if (tipo !== 'todos' && item.dataset.tipo !== tipo) mostrar = false;

                if (busca !== '') {
                    const textoCompleto = item.textContent.toLowerCase();
                    if (!textoCompleto.includes(busca)) {
                        mostrar = false;
                    }
                }

                item.style.display = mostrar ? 'flex' : 'none';
            });
        }

        function ordenarProvas() {
            const ordem = document.getElementById('selectOrdem').value;
            const lista = document.getElementById('listaProvas');
            const itens = Array.from(document.querySelectorAll('.item-prova'));

            itens.sort(function(a, b) {
                const anoA = parseInt(a.dataset.ano);
                const anoB = parseInt(b.dataset.ano);

                return ordem === 'recentes' ? (anoB - anoA) : (anoA - anoB);
            });

            itens.forEach(function(item) {
                lista.appendChild(item);
            });
        }
    </script>

</body>
</html>