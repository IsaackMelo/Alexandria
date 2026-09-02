<?php

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Alexandria – Chat AI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria: #8b1e2d;
            --dourado-alexandria: #d4af37;
            --dourado-claro: #f0d060;
            --branco: #ffffff;
            --cinza-medio: #e8dfd7;
            --texto-escuro: #333333;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--branco); }

        .barra-lateral {
            position: fixed; top: 0; left: 0; height: 100vh; width: 156px; z-index: 1000;
            background: var(--vinho-alexandria); display: flex; flex-direction: column;
            justify-content: space-between; padding: 5px 0 10px 0; box-shadow: 2px 0 10px rgba(0,0,0,0.3);
        }
        .grupo-superior-barra-lateral { display: flex; flex-direction: column; }
        .cabecalho-barra-lateral { padding: 15px 10px 20px 10px; text-align: center; }
        .cabecalho-barra-lateral img { width: 90%; max-width: 130px; height: auto; }
        .menu-barra-lateral { list-style: none; padding: 0; margin: 0; }
        .menu-barra-lateral li { width: 100%; margin-bottom: 2px; }
        .menu-barra-lateral li a, .footer-barra-lateral li a {
            display: flex; align-items: center; padding: 8px 12px; text-decoration: none;
            color: var(--dourado-alexandria); transition: all 0.2s ease;
        }
        .menu-barra-lateral li a:hover, .footer-barra-lateral li a:hover {
            background: rgba(255, 255, 255, 0.05); color: var(--dourado-claro);
        }
        .menu-barra-lateral li a .imagem-icone { width: 18px; height: 18px; margin-right: 10px; object-fit: contain; }
        .menu-barra-lateral li a .icone-fonte, .footer-barra-lateral li a .icone-fonte {
            width: 18px; font-size: 14px; margin-right: 10px; text-align: center; color: var(--dourado-alexandria);
        }
        .menu-barra-lateral li a .text, .footer-barra-lateral li a .text { font-size: 11px; font-weight: 500; }
        .footer-barra-lateral { list-style: none; padding: 0; margin: 0; width: 100%; }

        /* ========== TOP BAR ========== */
        .barra-superior {
            background: var(--branco); padding: 15px 30px; display: flex; justify-content: space-between;
            align-items: center; border-bottom: 1px solid var(--cinza-medio); box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .titulo-barra-superior { font-family: 'Inter', sans-serif; font-size: 18px; font-weight: 600; color: var(--texto-escuro); }
        .centro-barra-superior { display: flex; gap: 15px; align-items: center; }
        .distintivo-funcao {
            background: var(--vinho-alexandria); color: var(--branco); padding: 6px 12px; border-radius: 4px;
            font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px;
        }
        .distintivo-funcao i { font-size: 10px; }
        .direita-barra-superior { display: flex; align-items: center; gap: 20px; }
        .nome-usuario { font-size: 14px; font-weight: 500; color: var(--texto-escuro); }
        .avatar-usuario {
            width: 40px; height: 40px; border-radius: 50%; background: var(--vinho-alexandria);
            display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--dourado-alexandria);
        }

        /* ========== CONTEÚDO PRINCIPAL ========== */
        /* A tipografia abaixo não alcança a sidebar nem a topbar. */
        .conteudo-principal *:not(i) { font-family: Arial, Helvetica, sans-serif; }
        .container-principal { min-height: 100vh; margin-left: 156px; background: var(--branco); }
        .conteudo-principal { padding: 10px 10px 12px; font-family: Arial, Helvetica, sans-serif; }
        .grade-editor { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 10px; align-items: start; }
        .cartao-conteudo { background: var(--branco); border: 1px solid #dfdfdf; border-radius: 8px; box-shadow: 0 1px 2px rgba(0, 0, 0, .04); }
        .campos-principais { min-height: 162px; padding: 12px 10px 8px; }
        .campo-artigo + .campo-artigo { margin-top: 11px; }
        .rotulo-campo { display: block; margin-bottom: 8px; color: #222; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1; }
        .entrada-artigo, .seletor-categoria, .entrada-tag { width: 100%; border: 0; outline: 0; color: #333; background: transparent; font-family: Arial, Helvetica, sans-serif; }
        .entrada-artigo { height: 28px; padding: 0 2px 8px; border-bottom: 1px solid #d8d8d8; font-size: 20px; }
        .entrada-artigo::placeholder { color: #c9c9c9; opacity: 1; }

        .preview-artigo { min-height: 157px; padding: 12px 9px 8px; }
        .titulo-bloco-preview { margin: 0 0 9px; padding-bottom: 8px; border-bottom: 1px solid #dedede; color: #222; font-family: Arial, Helvetica, sans-serif; font-size: 16px; }
        .corpo-preview { display: flex; gap: 12px; align-items: center; min-height: 96px; }
        .capa-preview { width: 138px; height: 96px; flex: 0 0 138px; display: flex; align-items: center; justify-content: center; border: 1px dashed #d5d5d5; border-radius: 9px; color: #d4d4d4; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center; }
        .capa-preview i { display: block; margin-bottom: 6px; color: #333; font-size: 13px; }
        .dados-preview { min-width: 0; flex: 1; }
        .categoria-preview { display: flex; align-items: center; gap: 4px; margin-bottom: 8px; color: var(--vinho-alexandria); font-size: 10px; font-weight: 600; }
        .categoria-preview i { font-size: 9px; }
        .titulo-preview { margin: 0 0 8px; overflow: hidden; color: #222; font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: 700; text-overflow: ellipsis; white-space: nowrap; }
        .descricao-preview { margin-bottom: 14px; overflow: hidden; color: #333; font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-overflow: ellipsis; white-space: nowrap; }
        .metadados-preview { display: flex; gap: 18px; color: #444; font-family: Arial, Helvetica, sans-serif; font-size: 10px; white-space: nowrap; }
        .metadados-preview span { display: inline-flex; align-items: center; gap: 5px; }
        .metadados-preview i { color: #c8a92e; font-size: 8px; }

        .grade-detalhes { display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr); gap: 10px; }
        .cartao-tags, .cartao-categoria { height: 94px; padding: 9px 7px; }
        .cabecalho-cartao { display: flex; align-items: center; gap: 10px; height: 25px; padding: 0 2px 7px; border-bottom: 1px solid #dedede; color: #333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
        .cabecalho-cartao::before { width: 2px; height: 24px; margin-left: -7px; background: var(--vinho-alexandria); content: ''; }
        .cabecalho-cartao i { color: var(--vinho-alexandria); font-size: 12px; }
        .entrada-tag-wrapper { display: flex; align-items: center; gap: 5px; height: 25px; margin-top: 7px; padding: 0 5px; border: 1px solid #ddd; border-radius: 3px; }
        .entrada-tag { min-width: 0; font-size: 10px; }
        .entrada-tag::placeholder { color: #555; }
        .botao-adicionar-tag { width: 13px; height: 20px; padding: 0; border: 0; border-radius: 2px; color: var(--branco); background: var(--vinho-alexandria); cursor: pointer; font-size: 10px; line-height: 20px; }
        .lista-tags { display: flex; flex-wrap: wrap; gap: 4px; margin-top: 5px; }
        .tag-artigo { display: inline-flex; align-items: center; gap: 5px; padding: 5px 8px; border-radius: 4px; color: #333; background: #e8e8e8; font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
        .tag-artigo button { padding: 0; border: 0; color: #777; background: transparent; cursor: pointer; font-size: 9px; }
        .seletor-categoria { height: 25px; margin-top: 7px; padding: 0 6px; border: 1px solid #ddd; border-radius: 3px; color: #333; font-size: 10px; }
        .acoes-artigo { display: flex; justify-content: center; gap: 19px; padding-top: 1px; }
        .botao-artigo { display: inline-flex; align-items: center; justify-content: center; gap: 20px; width: 200px; height: 40px; border-radius: 4px; cursor: pointer; font-family: Arial, Helvetica, sans-serif; font-size: 16px; }
        .botao-publicar { border: 1px solid #d3b339; color: #111; background: #d8b72f; }
        .botao-rascunho { border: 1px solid var(--vinho-alexandria); color: #333; background: var(--branco); }
        .botao-artigo i { color: #222; font-size: 17px; }

        .secao-artigos { margin-top: 10px; padding: 10px 4px 10px; border: 1px solid #e1e1e1; border-radius: 5px; }
        .cabecalho-artigos { display: flex; align-items: center; justify-content: space-between; gap: 15px; padding: 0 0 10px; border-bottom: 1px solid #e5e5e5; }
        .titulo-artigos { margin: 0; color: #101010; font-family: Arial, Helvetica, sans-serif; font-size: 20px; font-weight: 700; }
        .ferramentas-artigos { display: flex; align-items: center; gap: 38px; }
        .busca-artigos { display: flex; align-items: center; width: 285px; height: 43px; padding: 0 11px; border: 1px solid #e1e1e1; border-radius: 10px; }
        .busca-artigos input { width: 100%; border: 0; outline: 0; color: #444; font-family: Arial, Helvetica, sans-serif; font-size: 15px; }
        .busca-artigos input::placeholder { color: #929292; }
        .busca-artigos i { color: var(--vinho-alexandria); font-size: 15px; }
        .botao-filtros { display: inline-flex; align-items: center; justify-content: center; gap: 16px; width: 124px; height: 43px; border: 1px solid #e1e1e1; border-radius: 10px; color: #7f2638; background: var(--branco); cursor: pointer; font-size: 16px; font-weight: 600; }
        .abas-artigos { display: flex; gap: 9px; padding: 10px 0 12px; }
        .aba-artigo { padding: 0; border: 0; color: #555; background: transparent; cursor: pointer; font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: 700; }
        .aba-artigo.ativa, .aba-artigo:hover { color: var(--vinho-alexandria); }

        .tabela-artigos { width: 100%; border-collapse: separate; border-spacing: 0; border: 1px solid #e2e2e2; border-radius: 5px; overflow: hidden; font-family: Arial, Helvetica, sans-serif; }
        .tabela-artigos th { height: 51px; color: #151515; background: #fff; font-size: 17px; font-weight: 700; text-align: left; }
        .tabela-artigos th, .tabela-artigos td { padding: 0 10px; }
        .tabela-artigos th:first-child, .tabela-artigos td:first-child { width: 29%; padding-left: 12px; }
        .tabela-artigos th:nth-child(2), .tabela-artigos td:nth-child(2) { width: 16%; }
        .tabela-artigos th:nth-child(3), .tabela-artigos td:nth-child(3) { width: 12%; }
        .tabela-artigos th:nth-child(4), .tabela-artigos td:nth-child(4) { width: 10%; }
        .tabela-artigos th:nth-child(5), .tabela-artigos td:nth-child(5) { width: 12%; }
        .tabela-artigos th:last-child, .tabela-artigos td:last-child { width: 13%; }
        .tabela-artigos tbody tr { height: 66px; border-top: 1px solid #f0f0f0; }
        .tabela-artigos tbody td { color: #333; font-size: 14px; vertical-align: middle; }
        .identificacao-artigo { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .miniatura-artigo { width: 61px; height: 40px; flex: 0 0 61px; display: block; border-radius: 5px; overflow: hidden; object-fit: cover; object-position: center; }
        .miniatura-grecia { background: linear-gradient(180deg, #8fc2e0 0 47%, #d9b06a 47% 61%, #8f6b43 61% 66%, #eee2c5 66% 100%); }
        .miniatura-egito { background: linear-gradient(160deg, #a5c7d7 0 45%, #d9b47a 45% 100%); }
        .miniatura-independencia { background: linear-gradient(145deg, #735034 0 34%, #b48b5d 34% 58%, #607a57 58% 100%); }
        .miniatura-navegacao { background: linear-gradient(180deg, #76b1cc 0 46%, #2e7191 46% 68%, #c49a5b 68% 100%); }
        .miniatura-roma { background: linear-gradient(180deg, #92b4c0 0 42%, #a3917a 42% 100%); }
        .miniatura-industrial { background: linear-gradient(160deg, #777 0 35%, #a5a5a5 35% 64%, #454545 64% 100%); }
        .texto-artigo { min-width: 0; }
        .texto-artigo strong, .texto-artigo span { display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .texto-artigo strong { color: #171717; font-size: 14px; }
        .texto-artigo span { max-width: 300px; margin-top: 5px; color: #929292; font-size: 12px; }
        .categoria-tabela, .leitura-tabela { color: #858585 !important; font-weight: 600; }
        .status-artigo { display: inline-block; padding: 10px 11px; border-radius: 10px; font-size: 13px; }
        .status-publicado { color: #246b37; background: #e2f3e4; }
        .status-rascunho { color: #8b6a00; background: #fff0bd; }
        .acoes-tabela { display: flex; align-items: center; gap: 10px; }
        .acao-tabela { width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; padding: 0; border: 0; color: var(--vinho-alexandria); background: #f3f1e9; cursor: pointer; font-size: 13px; }
        .rodape-tabela { display: flex; align-items: center; justify-content: space-between; padding: 16px 8px 0 9px; }
        .resumo-tabela { color: #989898; font-size: 15px; }
        .paginacao { display: flex; gap: 10px; }
        .pagina { width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 11px; color: #222; background: #dedede; cursor: pointer; font-size: 18px; font-weight: 600; }
        .pagina.ativa { color: #fff; background: #b31e3b; }

        @media (max-width: 1100px) {
            .ferramentas-artigos { gap: 12px; }
            .busca-artigos { width: 220px; }
            .botao-artigo { width: 170px; gap: 10px; }
            .tabela-artigos th, .tabela-artigos td { padding: 0 6px; }
        }
        @media (max-width: 850px) {
            .container-principal { margin-left: 0; padding-top: 0; }
            .barra-lateral { position: static; width: 100%; height: auto; }
            .grupo-superior-barra-lateral { flex-direction: row; align-items: center; }
            .menu-barra-lateral { display: flex; overflow-x: auto; }
            .menu-barra-lateral li { min-width: max-content; }
            .footer-barra-lateral { display: none; }
            .grade-editor, .grade-detalhes { grid-template-columns: 1fr; }
            .acoes-artigo { padding: 8px 0 0; }
            .cabecalho-artigos, .ferramentas-artigos { align-items: stretch; flex-direction: column; }
            .busca-artigos, .botao-filtros { width: 100%; }
            .tabela-artigos { display: block; overflow-x: auto; white-space: nowrap; }
        }
    </style>
</head>
<body>
    <div class="barra-lateral">
        <div class="grupo-superior-barra-lateral">
            <div class="cabecalho-barra-lateral">
                <a href="#"><img src="imagens/logo.png" alt="Alexandria Logo"/></a>
            </div>

            <ul class="menu-barra-lateral">
                <li><a href="#"><img src="imagens/cursos.png" class="imagem-icone" alt=""><span class="text">Cursos disponíveis</span></a></li>
                <li><a href="#"><img src="imagens/meus-cursos.png" class="imagem-icone" alt=""><span class="text">Meus cursos</span></a></li>
                <li><a href="#"><img src="imagens/prancheta.png" class="imagem-icone" alt=""><span class="text">Artigos</span></a></li>
                <li><a href="#" class="active"><img src="imagens/ia.png" class="imagem-icone" alt=""><span class="text">Chat AI</span></a></li>
                <li><a href="#"><img src="imagens/banco_questao.png" class="imagem-icone" alt=""><span class="text">Banco de questões</span></a></li>
                <li><a href="#"><img src="imagens/notificacao.png" class="imagem-icone" alt=""><span class="text">Notificação</span></a></li>
            </ul>
        </div>

        <ul class="menu-barra-lateral footer-barra-lateral">
            <li><a href="#" class="logout"><span class="icone-fonte"><i class="fa-solid fa-right-from-bracket"></i></span><span class="text">Logout</span></a></li>
        </ul>
    </div>

    <div class="container-principal">
        <div class="barra-superior">
            <div class="titulo-barra-superior">Incluir Artigos</div>
            <div class="direita-barra-superior">
                <div class="distintivo-funcao"><span>Estudante</span><i class="fas fa-chevron-down"></i></div>
                <div class="nome-usuario">Igor Bueno</div>
                <div class="avatar-usuario"><i class="fas fa-user"></i></div>
            </div>
        </div>

        <main class="conteudo-principal" aria-label="Gerenciamento de artigos">
            <div class="grade-editor">
                <section class="cartao-conteudo campos-principais" aria-label="Dados do artigo">
                    <div class="campo-artigo">
                        <label class="rotulo-campo" for="titulo-artigo">TÍTULO DO ARTIGO</label>
                        <input class="entrada-artigo" id="titulo-artigo" type="text" placeholder="Digite o título do artigo..." autocomplete="off">
                    </div>
                    <div class="campo-artigo">
                        <label class="rotulo-campo" for="descricao-artigo">DESCRIÇÃO DO ARTIGO</label>
                        <input class="entrada-artigo" id="descricao-artigo" type="text" placeholder="Digite uma breve descrição do artigo..." autocomplete="off">
                    </div>
                </section>

                <section class="cartao-conteudo preview-artigo" aria-label="Pré-visualização do artigo">
                    <h2 class="titulo-bloco-preview">Preview</h2>
                    <div class="corpo-preview">
                        <div class="capa-preview"><div><i class="fa-solid fa-upload"></i><br>Adicionar Capa</div></div>
                        <div class="dados-preview">
                            <div class="categoria-preview"><i class="fa-solid fa-circle"></i><span>Selecione uma categoria</span></div>
                            <h3 class="titulo-preview" id="preview-titulo">Digite o título do artigo...</h3>
                            <p class="descricao-preview" id="preview-descricao">Digite uma breve descrição do artigo...</p>
                            <div class="metadados-preview"><span><i class="fa-solid fa-square"></i>0 min</span><span><i class="fa-solid fa-square"></i>17 maio 2026</span><span><i class="fa-solid fa-square"></i>Igor Bueno</span></div>
                        </div>
                    </div>
                </section>

                <div class="grade-detalhes">
                    <section class="cartao-conteudo cartao-tags" aria-label="Tags do artigo">
                        <div class="cabecalho-cartao"><i class="fa-solid fa-tag"></i><span>TAGS</span></div>
                        <div class="entrada-tag-wrapper"><input class="entrada-tag" id="entrada-tag" type="text" placeholder="Adicionar TAG" autocomplete="off"><button class="botao-adicionar-tag" id="adicionar-tag" type="button" aria-label="Adicionar tag">+</button></div>
                        <div class="lista-tags" id="lista-tags"><span class="tag-artigo">Enem <button type="button" aria-label="Remover tag Enem">×</button></span></div>
                    </section>
                    <section class="cartao-conteudo cartao-categoria" aria-label="Categoria do artigo">
                        <div class="cabecalho-cartao"><i class="fa-regular fa-folder"></i><span>CATEGORIA</span></div>
                        <select class="seletor-categoria" id="seletor-categoria" aria-label="Selecione uma categoria">
                            <option value="">Selecione uma categoria</option><option>História Antiga</option><option>Idade Moderna</option><option>História do Brasil</option>
                        </select>
                    </section>
                </div>

                <div class="acoes-artigo" aria-label="Ações do artigo">
                    <button class="botao-artigo botao-publicar" type="button"><i class="fa-solid fa-paper-plane"></i><span>Publicar Artigo</span></button>
                    <button class="botao-artigo botao-rascunho" type="button"><i class="fa-regular fa-floppy-disk"></i><span>Salvar Rascunho</span></button>
                </div>
            </div>

            <section class="secao-artigos" aria-labelledby="titulo-artigos">
                <div class="cabecalho-artigos">
                    <h1 class="titulo-artigos" id="titulo-artigos">Artigos Cadastrados</h1>
                    <div class="ferramentas-artigos">
                        <label class="busca-artigos" for="busca-artigos"><input id="busca-artigos" type="search" placeholder="Buscar artigos..." autocomplete="off"><i class="fa-solid fa-magnifying-glass"></i></label>
                        <button class="botao-filtros" type="button"><i class="fa-solid fa-filter"></i><span>Filtros</span></button>
                    </div>
                </div>

                <nav class="abas-artigos" aria-label="Filtros de artigos">
                    <button class="aba-artigo ativa" type="button" data-filtro="todos">Todos (6)</button>
                    <button class="aba-artigo" type="button" data-filtro="rascunho">Rascunhos (2)</button>
                    <button class="aba-artigo" type="button" data-filtro="arquivado">Arquivados (1)</button>
                    <button class="aba-artigo" type="button" data-filtro="publicado">Publicados (4)</button>
                </nav>

                <table class="tabela-artigos">
                    <thead><tr><th scope="col">Título</th><th scope="col">Categoria</th><th scope="col">Status</th><th scope="col">Data</th><th scope="col">Leitura</th><th scope="col">Ações</th></tr></thead>
                    <tbody id="corpo-tabela-artigos">
                        <tr data-status="publicado"><td><div class="identificacao-artigo"><img class="miniatura-artigo" src="imagens/image 97.png" alt="Templo grego"><div class="texto-artigo"><strong>A Grécia Antiga e suas Cidades-Estado</strong><span>Entenda como as pólis gregas moldaram a política.</span></div></div></td><td class="categoria-tabela">História Antiga</td><td><span class="status-artigo status-publicado">Publicado</span></td><td>22/08/2026</td><td class="leitura-tabela">6 minutos</td><td><div class="acoes-tabela"><button class="acao-tabela" type="button" aria-label="Visualizar"><i class="fa-regular fa-eye"></i></button><button class="acao-tabela" type="button" aria-label="Editar"><i class="fa-solid fa-pencil"></i></button><button class="acao-tabela" type="button" aria-label="Mais opções"><i class="fa-solid fa-ellipsis-vertical"></i></button></div></td></tr>
                        <tr data-status="publicado"><td><div class="identificacao-artigo"><img class="miniatura-artigo" src="imagens/image 98.png" alt="Pirâmides do Egito"><div class="texto-artigo"><strong>Egito Antigo: Sociedade e Cultura</strong><span>Explore a sociedade, religião e cultura do Egito Antigo.</span></div></div></td><td class="categoria-tabela">História Antiga</td><td><span class="status-artigo status-publicado">Publicado</span></td><td>21/08/2026</td><td class="leitura-tabela">5 minutos</td><td><div class="acoes-tabela"><button class="acao-tabela" type="button" aria-label="Visualizar"><i class="fa-regular fa-eye"></i></button><button class="acao-tabela" type="button" aria-label="Editar"><i class="fa-solid fa-pencil"></i></button><button class="acao-tabela" type="button" aria-label="Mais opções"><i class="fa-solid fa-ellipsis-vertical"></i></button></div></td></tr>
                        <tr data-status="publicado"><td><div class="identificacao-artigo"><img class="miniatura-artigo" src="imagens/image 99.png" alt="Representação da independência"><div class="texto-artigo"><strong>Independência do Brasil</strong><span>Contexto histórico, causas e consequências.</span></div></div></td><td class="categoria-tabela">Idade Moderna</td><td><span class="status-artigo status-publicado">Publicado</span></td><td>20/08/2026</td><td class="leitura-tabela">4 minutos</td><td><div class="acoes-tabela"><button class="acao-tabela" type="button" aria-label="Visualizar"><i class="fa-regular fa-eye"></i></button><button class="acao-tabela" type="button" aria-label="Editar"><i class="fa-solid fa-pencil"></i></button><button class="acao-tabela" type="button" aria-label="Mais opções"><i class="fa-solid fa-ellipsis-vertical"></i></button></div></td></tr>
                        <tr data-status="publicado"><td><div class="identificacao-artigo"><img class="miniatura-artigo" src="imagens/image 100.png" alt="Navegação histórica"><div class="texto-artigo"><strong>Navegações Portuguesas</strong><span>As grandes expedições que mudaram o mundo.</span></div></div></td><td class="categoria-tabela">Idade Moderna</td><td><span class="status-artigo status-publicado">Publicado</span></td><td>19/08/2026</td><td class="leitura-tabela">7 minutos</td><td><div class="acoes-tabela"><button class="acao-tabela" type="button" aria-label="Visualizar"><i class="fa-regular fa-eye"></i></button><button class="acao-tabela" type="button" aria-label="Editar"><i class="fa-solid fa-pencil"></i></button><button class="acao-tabela" type="button" aria-label="Mais opções"><i class="fa-solid fa-ellipsis-vertical"></i></button></div></td></tr>
                        <tr data-status="rascunho"><td><div class="identificacao-artigo"><img class="miniatura-artigo" src="imagens/image 101.png" alt="Coliseu de Roma"><div class="texto-artigo"><strong>Roma: Da Monarquia ao Império</strong><span>A ascensão de Roma e sua transformação em império.</span></div></div></td><td class="categoria-tabela">História Antiga</td><td><span class="status-artigo status-rascunho">Rascunho</span></td><td>18/08/2026</td><td class="leitura-tabela">5 minutos</td><td><div class="acoes-tabela"><button class="acao-tabela" type="button" aria-label="Visualizar"><i class="fa-regular fa-eye"></i></button><button class="acao-tabela" type="button" aria-label="Editar"><i class="fa-solid fa-pencil"></i></button><button class="acao-tabela" type="button" aria-label="Mais opções"><i class="fa-solid fa-ellipsis-vertical"></i></button></div></td></tr>
                        <tr data-status="rascunho"><td><div class="identificacao-artigo"><img class="miniatura-artigo" src="imagens/image 102.png" alt="Revolução Industrial"><div class="texto-artigo"><strong>Revolução Industrial</strong><span>O impacto da indústria na sociedade e economia.</span></div></div></td><td class="categoria-tabela">História Antiga</td><td><span class="status-artigo status-rascunho">Rascunho</span></td><td>17/08/2026</td><td class="leitura-tabela">5 minutos</td><td><div class="acoes-tabela"><button class="acao-tabela" type="button" aria-label="Visualizar"><i class="fa-regular fa-eye"></i></button><button class="acao-tabela" type="button" aria-label="Editar"><i class="fa-solid fa-pencil"></i></button><button class="acao-tabela" type="button" aria-label="Mais opções"><i class="fa-solid fa-ellipsis-vertical"></i></button></div></td></tr>
                    </tbody>
                </table>

                <div class="rodape-tabela"><span class="resumo-tabela" id="resumo-tabela">Mostrando 1 a 6 de 12 artigos.</span><div class="paginacao" aria-label="Paginação"><button class="pagina" type="button" aria-label="Página anterior"><i class="fa-solid fa-chevron-left"></i></button><button class="pagina ativa" type="button">1</button><button class="pagina" type="button">2</button><button class="pagina" type="button">3</button><button class="pagina" type="button" aria-label="Próxima página"><i class="fa-solid fa-chevron-right"></i></button></div></div>
            </section>
        </main>
    </div>

    <script>
        (function () {
            const titulo = document.getElementById('titulo-artigo');
            const descricao = document.getElementById('descricao-artigo');
            const previewTitulo = document.getElementById('preview-titulo');
            const previewDescricao = document.getElementById('preview-descricao');
            const tagInput = document.getElementById('entrada-tag');
            const tagList = document.getElementById('lista-tags');
            const addTag = document.getElementById('adicionar-tag');
            const search = document.getElementById('busca-artigos');
            const rows = Array.from(document.querySelectorAll('#corpo-tabela-artigos tr'));
            const tabs = Array.from(document.querySelectorAll('.aba-artigo'));

            titulo.addEventListener('input', function () { previewTitulo.textContent = this.value.trim() || 'Digite o título do artigo...'; });
            descricao.addEventListener('input', function () { previewDescricao.textContent = this.value.trim() || 'Digite uma breve descrição do artigo...'; });

            function createTag(value) {
                const cleanValue = value.trim();
                if (!cleanValue) return;
                const tag = document.createElement('span');
                tag.className = 'tag-artigo';
                tag.textContent = cleanValue + ' ';
                const remove = document.createElement('button');
                remove.type = 'button'; remove.setAttribute('aria-label', 'Remover tag'); remove.textContent = '×';
                remove.addEventListener('click', function () { tag.remove(); });
                tag.appendChild(remove); tagList.appendChild(tag); tagInput.value = '';
            }
            addTag.addEventListener('click', function () { createTag(tagInput.value); });
            tagInput.addEventListener('keydown', function (event) { if (event.key === 'Enter') { event.preventDefault(); createTag(tagInput.value); } });
            tagList.querySelectorAll('button').forEach(function (button) { button.addEventListener('click', function () { button.parentElement.remove(); }); });

            function filterRows() {
                const activeFilter = document.querySelector('.aba-artigo.ativa').dataset.filtro;
                const term = search.value.trim().toLowerCase();
                rows.forEach(function (row) {
                    const matchesFilter = activeFilter === 'todos' || row.dataset.status === activeFilter;
                    const matchesSearch = !term || row.textContent.toLowerCase().includes(term);
                    row.style.display = matchesFilter && matchesSearch ? '' : 'none';
                });
            }
            tabs.forEach(function (tab) { tab.addEventListener('click', function () { tabs.forEach(function (item) { item.classList.remove('ativa'); }); tab.classList.add('ativa'); filterRows(); }); });
            search.addEventListener('input', filterRows);
        }());
    </script>
</body>
</html>
