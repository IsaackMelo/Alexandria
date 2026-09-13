<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Banco de Questões</title>

    <link rel="icon" type="image/png" href="imagens/alex.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cloudflare.com">

    <link rel="stylesheet" href="estilo/simulado.css">

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

   

        <p class="subtitulo">Explore os acervos disponíveis para estudo e simulados.</p>

        <!-- Barra de pesquisa refinada -->
        <div class="area-pesquisa-simulados">
            <div class="barra-pesquisa">
                <i class="fa-solid fa-magnifying-glass icone-lupa"></i>
                <input type="text" id="campoBuscaAcervo" placeholder="Buscar por banca, faculdade ou palavra-chave..." autocomplete="off">
                <button type="button" id="btnLimparBusca" class="btn-limpar" title="Limpar busca" style="display: none;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <span class="contador-acervos" id="contadorResultados">6 acervos disponíveis</span>
        </div>

        <!-- cards -->
        <div class="cardsvest" id="gridCardsAcervos">
            <div class="card">
                <img src="imagens/fgv.jpg" alt="FGV">
                <div class="card-conteudo">
                    <h3>FGV</h3>
                    <p>Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.</p>
                    <button onclick="abrirModal('FGV')">ACESSAR ACERVO</button>
                </div>
            </div>
            <div class="card">
                <img src="imagens/cebraspe.jpg" alt="cebraspe">
                <div class="card-conteudo">
                    <h3>CEBRASPE</h3>
                    <p>Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.</p>
                    <button onclick="abrirModal('CEBRASPE')">ACESSAR ACERVO</button>
                </div>
            </div>
            <div class="card">
                <img src="imagens/fuvest.jpg" alt="fuvest">
                <div class="card-conteudo">
                    <h3>FUVEST</h3>
                    <p>Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.</p>
                    <button onclick="abrirModal('FUVEST')">ACESSAR ACERVO</button>
                </div>
            </div>
            <div class="card">
                <img src="imagens/enem.png" alt="enem">
                <div class="card-conteudo">
                    <h3>ENEM</h3>
                    <p>Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.</p>
                    <button onclick="abrirModal('ENEM')">ACESSAR ACERVO</button>
                </div>
            </div>
            <div class="card">
                <img src="imagens/espcex.png" alt="EsPCEx">
                <div class="card-conteudo">
                    <h3>EsPCEx</h3>
                    <p>Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.</p>
                    <button onclick="abrirModal('EsPCEx')">ACESSAR ACERVO</button>
                </div>
            </div>
            <div class="card">
                <img src="imagens/vunesp.png" alt="VUNESP">
                <div class="card-conteudo">
                    <h3>VUNESP</h3>
                    <p>Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.</p>
                    <button onclick="abrirModal('VUNESP')">ACESSAR ACERVO</button>
                </div>
            </div>
        </div>

        <!-- Estado vazio caso a busca não retorne itens -->
        <div id="semResultados" class="sem-resultados" style="display: none;">
            <i class="fa-solid fa-folder-open"></i>
            <p>Nenhum acervo encontrado para sua busca.</p>
        </div>

    </main>

    <!-- mensagem que aparece na tela -->
    <dialog id="modalAcervo">
        <p>Quer acessar o acervo <strong id="nomeAcervo"></strong>?</p>
        <div class="botoes">
            <button class="btn-cancelar" onclick="document.getElementById('modalAcervo').close()">Cancelar</button>
            <button class="btn-confirmar" onclick="confirmarAcesso()">Confirmar</button>
        </div>
    </dialog>

    <script>
        let acervoAtual = "";

        // modal aparece
        function abrirModal(nome) {
            acervoAtual = nome;
            // pega o id do card que a gnt clicar no acessar acervo
            document.getElementById("nomeAcervo").textContent = nome;
            // aparece o modal do acervo que a gnt escolher
            document.getElementById("modalAcervo").showModal();
        }

        function confirmarAcesso() {
            if (acervoAtual === "FUVEST") {
                window.location.href = "telaacervoesp.php";
            } else {
                window.location.href = "telaacervoesp.php";
            }
        }

        // Filtro de busca em tempo real nos cards de acervo
        const campoBusca = document.getElementById("campoBuscaAcervo");
        const btnLimpar = document.getElementById("btnLimparBusca");
        const gridCards = document.getElementById("gridCardsAcervos");
        const semResultados = document.getElementById("semResultados");
        const contadorResultados = document.getElementById("contadorResultados");

        if (campoBusca) {
            campoBusca.addEventListener("input", function () {
                const termo = this.value.trim().toLowerCase();
                const cards = gridCards.getElementsByClassName("card");
                let visiveis = 0;

                btnLimpar.style.display = termo.length > 0 ? "inline-flex" : "none";

                for (let i = 0; i < cards.length; i++) {
                    const titulo = cards[i].querySelector("h3") ? cards[i].querySelector("h3").innerText.toLowerCase() : "";
                    const descricao = cards[i].querySelector("p") ? cards[i].querySelector("p").innerText.toLowerCase() : "";

                    if (titulo.includes(termo) || descricao.includes(termo)) {
                        cards[i].style.display = "";
                        visiveis++;
                    } else {
                        cards[i].style.display = "none";
                    }
                }

                if (contadorResultados) {
                    if (termo === "") {
                        contadorResultados.textContent = `${cards.length} acervos disponíveis`;
                    } else {
                        contadorResultados.textContent = visiveis === 1 ? "1 acervo encontrado" : `${visiveis} acervos encontrados`;
                    }
                }

                if (semResultados) {
                    semResultados.style.display = visiveis === 0 ? "block" : "none";
                }
            });

            btnLimpar.addEventListener("click", function () {
                campoBusca.value = "";
                campoBusca.dispatchEvent(new Event("input"));
                campoBusca.focus();
            });
        }
    </script>
</body>

</html>
