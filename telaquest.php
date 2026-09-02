<?php
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alexandria - Questão 01</title>

    <link rel="icon" type="image/png" href="imagens/alex.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>

        :root{
            --vinho:#8b1e2d;
            --dourado:#d4af37;
            --dourado-claro:#f0d060;
            --branco:#fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5efe6;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 156px;
            z-index: 1000;
            background: var(--vinho);
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            padding: 5px 0 10px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
        }

        .sidebar-top-group {
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 15px 10px 20px 10px;
            text-align: center;
        }

        .sidebar-header img {
            width: 90%;
            max-width: 130px;
            height: auto;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            width: 100%;
            margin-bottom: 2px;
        }

        .sidebar-menu li a, .sidebar-footer li a{
            display: flex;
            align-items: center;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--dourado);
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        .sidebar-menu li a .icon-img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            object-fit: contain;
        }

        .sidebar-menu li a .icon-fa, .sidebar-footer li a .icon-fa{
            width: 18px;
            font-size: 14px;
            margin-right: 10px;
            text-align: center;
            color: var(--dourado);
        }

        .sidebar-menu li a .text, .sidebar-footer li a .text{
            font-size: 11px;
            font-weight: 500;
        }

        .sidebar-footer {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            
        }

        

        .sidebar-footer li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        /* conteudo da pagina */
        .conteudo {
            margin-left: 156px;
            padding: 30px 40px;
        }

        .topo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            margin-bottom: 5px;
            border-bottom: 1px solid #e3e3e3;
        }

        .topo h4 {
            font-weight: 600;
        }

        .usuario {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .usuario span {
            font-weight: 600;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--vinho);
            color: #fff;
        }

        .voltar {
            display: inline-block;
            margin: 15px 0 25px;
            text-decoration: none;
            color: var(--vinho);
            font-size: 14px;
        }

        .voltar:hover {
            text-decoration: underline;
        }

        .card-questao {
            width: 100%;
            background: #fff;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            padding: 30px 35px;
        }

        .num-questao {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: var(--dourado);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .fonte-questao {
            color: var(--vinho);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .enunciado {
            line-height: 1.6;
            font-size: 15px;
        }

        /* alternativas da questao */
        .alternativa {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .alternativa:hover {
            background: #fafafa;
        }

        .alternativa.selecionada {
            background: #eee;
            border-color: #ccc;
        }

        .letra {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--dourado);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .btn-enviar {
            background: var(--vinho);
            color: #fff;
            border: none;
            padding: 12px 26px;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn-enviar:hover {
            background: #6e1622;
            color: #fff;
        }

        .btn-enviar:disabled {
            opacity: .6;
        }

    </style>

</head>

<body>

    <!-- menu lateral fixo -->
    <div class="sidebar">
        <div class="sidebar-top-group">

        <div class="sidebar-header">
            <a href="#">
                <img src="imagens/logo.png" alt="Logo">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <img src="imagens/cursos.png" class="icon-img" alt="Cursos">
                    <span class="text">Cursos disponíveis</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="imagens/meus-cursos.png" class="icon-img" alt="Meus cursos">
                    <span class="text">Meus cursos</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="imagens/prancheta.png" class="icon-img" alt="Artigos">
                    <span class="text">Artigos</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="imagens/ia.png" class="icon-img" alt="IA">
                    <span class="text">Chat AI</span>
                </a>
            </li>

            <li>
                <a href="#" class="active">
                    <img src="imagens/banco_questao.png" class="icon-img" alt="Banco de questões">
                    <span class="text">Banco de questões</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="imagens/notificacao.png" class="icon-img" alt="Notificações">
                    <span class="text">Notificações</span>
                </a>
            </li>
        </ul>
        </div>

        <ul class="sidebar-footer">
            <li>
                <a href="#">
                    <span class="icon-fa">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>

    </div>

    <main class="conteudo">

        <div class="topo">

            <h4>QUESTÃO 01</h4>

            <div class="usuario">
                <span>Igor Bueno</span>

                <div class="avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

        </div>

        <a href="#" class="voltar">&lsaquo; Voltar para o Banco de questões</a>

        <div class="card-questao">

            <div class="d-flex gap-3 mb-3">

                <div class="num-questao">01</div>

                <div>
                    <div class="fonte-questao">Fuvest 2023</div>

                    <div class="enunciado">
                        O governo de Getúlio Vargas (1930–1945) ficou marcado por medidas que
                        transformaram as relações entre o Estado e a sociedade brasileira.
                        Assinale a alternativa que melhor representa uma dessas medidas.
                    </div>
                </div>

            </div>

            <hr>

            <p class="fw-bold mb-3">Alternativas:</p>

            <div id="lista-alternativas">

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

        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-enviar" id="btnEnviar" disabled>Enviar resposta</button>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        // pega todas as alternativas e o botao de enviar
        const alternativas = document.querySelectorAll(".alternativa");
        const botao = document.getElementById("btnEnviar");

        let resposta = ""; // guarda a letra escolhida

        alternativas.forEach(function (alternativa) {

            alternativa.addEventListener("click", function () {

                // tira o "selecionada" de todo mundo antes de marcar a nova
                alternativas.forEach(function (item) {
                    item.classList.remove("selecionada");
                });

                alternativa.classList.add("selecionada");
                resposta = alternativa.dataset.letra;

                botao.disabled = false;

            });

        });

        botao.addEventListener("click", function () {

            if (resposta === "") {
                return;
            }

            // por enquanto so mostra um alert, dps da pra mandar pro backend
            alert("Resposta enviada: alternativa " + resposta);

        });

    </script>

</body>

</html>
