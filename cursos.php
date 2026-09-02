<?php
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Alexandria – Meus Cursos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria: #8b1e2d;
            --dourado-alexandria: #d4af37;
            --dourado-claro: #f0d060;
            --branco: #ffffff;
            --cinza-claro: #f5efe6;
            --cinza-medio: #e8dfd7;
            --cinza-escuro: #777777;
            --texto-escuro: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cinza-claro);
            display: flex;
        }

        /* Barra lateral */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 156px;
            z-index: 1000;
            background: var(--vinho-alexandria);
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

        .sidebar-menu, .sidebar-footer {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .sidebar-menu li, .sidebar-footer li {
            width: 100%;
            margin-bottom: 2px;
        }

        .sidebar-menu li a, .sidebar-footer li a {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--dourado-alexandria);
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover, .sidebar-footer li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        .sidebar-menu li a.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--dourado-claro);
        }

        .sidebar-menu li a .imagem-icone, .sidebar-footer li a .imagem-icone {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            object-fit: contain;
        }

        .sidebar-menu li a .icone-fonte, .sidebar-footer li a .icone-fonte {
            width: 18px;
            font-size: 14px;
            margin-right: 10px;
            text-align: center;
            color: var(--dourado-alexandria);
        }

        .sidebar-menu li a .text, .sidebar-footer li a .text {
            font-size: 11px;
            font-weight: 500;
        }
        /* Isso deixa o conteúdo principal do texto centralizado */
        .container-principal {
            margin-left: 156px;
            width: calc(100% - 156px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* barra do topo*/
        .barra-superior {
            background: var(--branco);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--cinza-medio);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Caixa de Pesquisa */
        .caixa-pesquisa {
            display: flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            padding: 8px 14px;
            width: 380px;
            max-width: 100%;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);
        }

        .caixa-pesquisa i {
            color: #666666;
            font-size: 14px;
            margin-right: 10px;
        }

        .caixa-pesquisa input {
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: var(--texto-escuro);
            width: 100%;
        }

        .caixa-pesquisa input::placeholder {
            color: #999999;
        }

        .distintivo-funcao {
            background: var(--vinho-alexandria);
            color: var(--branco);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .distintivo-funcao i {
            font-size: 10px;
        }

        .direita-barra-superior {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nome-usuario {
            font-size: 14px;
            font-weight: 500;
            color: var(--texto-escuro);
        }

        .avatar-usuario {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--dourado-alexandria);
        }

        .corpo-conteudo {
            padding: 30px 40px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .secao-boas-vindas {
            margin-bottom: 30px;
            border-bottom: 1px solid var(--cinza-medio);
            padding-bottom: 15px;
        }

        .secao-boas-vindas h1 {
            font-size: 20px;
            font-weight: 600;
            color: var(--texto-escuro);
            margin-bottom: 4px;
        }

        .secao-boas-vindas p {
            font-size: 13px;
            color: var(--cinza-escuro);
        }

        
        .grade-cursos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .cartao-curso {
            background: var(--branco);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e0d6cd;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            max-width: 280px; 
            margin: 0 auto; 
            width: 100%;
        }

        .cartao-curso.cartao-ativo {
            border: 2px solid #00a8cc;
        }

        .container-imagem-curso {
            width: 100%;
            height: 130px; 
            background: #f0f0f0;
            overflow: hidden;
        }

        .container-imagem-curso img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .informacoes-curso {
            padding: 12px; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .titulo-curso {
            font-size: 13px; 
            font-weight: 600;
            color: var(--texto-escuro);
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .progresso-curso {
            font-size: 11px;
            color: var(--cinza-escuro);
            border-top: 1px solid #eee;
            padding-top: 8px;
        }

        /* Paginação */
        .container-paginacao {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: auto;
            padding-bottom: 20px;
        }

        .botao-pagina {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            border: 1px solid #dcdcdc;
            background: var(--branco);
            color: var(--texto-escuro);
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .botao-pagina:hover {
            background: #f0f0f0;
        }

        .botao-pagina.active {
            background: var(--vinho-alexandria);
            color: var(--branco);
            border-color: var(--vinho-alexandria);
        }

        /* Modal de validação do curso */
        .modal-validacao {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.28);
        }

        .modal-validacao.aberto {
            display: flex;
        }

        .cartao-validacao {
            width: min(100%, 360px);
            background: var(--branco);
            border-radius: 5px;
            padding: 16px 10px 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
            text-align: center;
            animation: aparecer-modal 0.18s ease-out;
        }

        .icone-validacao {
            width: 38px;
            height: 38px;
            margin: 0 auto 9px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fde4e6;
            color: var(--vinho-alexandria);
            font-size: 18px;
        }

        .cartao-validacao h2 {
            margin-bottom: 8px;
            color: #202020;
            font-size: 13px;
            font-weight: 600;
        }

        .cartao-validacao p {
            margin: 0 auto 2px;
            color: #555;
            font-size: 10px;
            line-height: 1.5;
        }

        .curso-selecionado {
            color: var(--vinho-alexandria) !important;
            font-size: 10px !important;
        }

        .acoes-validacao {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-top: 14px;
            padding: 0;
        }

        .botao-validacao {
            min-width: 72px;
            height: 27px;
            padding: 0 10px;
            border-radius: 2px;
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            cursor: pointer;
            transition: filter 0.2s ease, background 0.2s ease;
        }

        .botao-validacao:hover {
            filter: brightness(0.94);
        }

        .botao-cancelar {
            color: #b8b8b8;
            background: var(--branco);
            border: 1px solid #d6d6d6;
        }

        .botao-iniciar {
            color: var(--branco);
            background: var(--vinho-alexandria);
            border: 1px solid var(--vinho-alexandria);
        }

        @keyframes aparecer-modal {
            from { opacity: 0; transform: translateY(5px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .cartao-curso {
            cursor: pointer;
        }

        .cartao-curso:focus-visible {
            outline: 3px solid var(--dourado-alexandria);
            outline-offset: 3px;
        }

        @media (max-width: 1200px) {
            .grade-cursos {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .cartao-validacao {
                width: min(100%, 330px);
            }

            .acoes-validacao {
                gap: 28px;
            }
            .container-principal {
                margin-left: 60px;
                width: calc(100% - 60px);
            }

            .grade-cursos {
                grid-template-columns: 1fr;
            }

            .corpo-conteudo {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-top-group">
        <div class="sidebar-header">
            <a href="#"><img src="imagens/logo.png" alt="Alexandria Logo"/></a>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <img src="imagens/cursos.png" class="imagem-icone" alt="">
                    <span class="text">Cursos disponíveis</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/meus-cursos.png" class="imagem-icone" alt="">
                    <span class="text">Meus cursos</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/prancheta.png" class="imagem-icone" alt="">
                    <span class="text">Artigos</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/ia.png" class="imagem-icone" alt="">
                    <span class="text">Chat AI</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/banco_questao.png" class="imagem-icone" alt="">
                    <span class="text">Banco de questões</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="imagens/notificacao.png" class="imagem-icone" alt="">
                    <span class="text">Notificação</span>
                </a>
            </li>
        </ul>
        </div>
        <ul class="sidebar-menu sidebar-footer">
            <li>
                <a href="#" class="logout">
                    <span class="icone-fonte"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container-principal">
        <div class="barra-superior">
            <div class="caixa-pesquisa">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Buscar cursos...">
            </div>
            
            <div class="direita-barra-superior">
                <div class="distintivo-funcao"><span>Estudante</span><i class="fas fa-chevron-down"></i></div>
                <div class="nome-usuario">Igor Bueno</div>
                <div class="avatar-usuario"><i class="fas fa-user"></i></div>
            </div>
        </div>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="corpo-conteudo">
            <div>
                <div class="secao-boas-vindas">
                    <h1>Olá, Igor</h1>
                    <p>Continue aprendendo e conquistando seus objetivos.</p>
                </div>

                <div class="grade-cursos">
                    <!-- Card 1 -->
                    <div class="cartao-curso">
                        <div class="container-imagem-curso"><img src="imagens/getulio.png" alt="Era Vargas"></div>
                        <div class="informacoes-curso">
                            <div class="titulo-curso">Era Vargas (1930 - 1945)</div>
                            <div class="progresso-curso">0% concluído</div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="cartao-curso">
                        <div class="container-imagem-curso"><img src="imagens/filosofia.png" alt="Idade Moderna"></div>
                        <div class="informacoes-curso">
                            <div class="titulo-curso">Idade Moderna e Renascimento</div>
                            <div class="progresso-curso">0% concluído</div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="cartao-curso">
                        <div class="container-imagem-curso"><img src="imagens/ditadura.png" alt="Ditadura Militar"></div>
                        <div class="informacoes-curso">
                            <div class="titulo-curso">Ditadura Militar no Brasil (1964-1985)</div>
                            <div class="progresso-curso">0% concluído</div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="cartao-curso">
                        <div class="container-imagem-curso"><img src="imagens/colonial.png" alt="Brasil Colônia"></div>
                        <div class="informacoes-curso">
                            <div class="titulo-curso">Brasil Colônia (1530-1822)</div>
                            <div class="progresso-curso">0% concluído</div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="cartao-curso">
                        <div class="container-imagem-curso"><img src="imagens/roma.png" alt="Antiguidade Clássica"></div>
                        <div class="informacoes-curso">
                            <div class="titulo-curso">Antiguidade Clássica (Grécia e Roma)</div>
                            <div class="progresso-curso">0% concluído</div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="cartao-curso">
                        <div class="container-imagem-curso"><img src="imagens/guerrafria.png" alt="Guerra Fria"></div>
                        <div class="informacoes-curso">
                            <div class="titulo-curso">Guerra Fria (1945 - tempos atuais)</div>
                            <div class="progresso-curso">0% concluído</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-paginacao">
                <a href="#" class="botao-pagina"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="botao-pagina active">1</a>
                <a href="#" class="botao-pagina">2</a>
                <a href="#" class="botao-pagina">3</a>
                <a href="#" class="botao-pagina"><i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="modal-validacao" id="modalValidacao" role="dialog" aria-modal="true" aria-labelledby="tituloValidacao" aria-hidden="true">
        <div class="cartao-validacao" role="document">
            <div class="icone-validacao" aria-hidden="true">
            <i class="fa-solid fa-book-open"></i>
            </div>
            <h2 id="tituloValidacao">Quer começar esse curso?</h2>
            <p>Você está prestes a começar o curso</p>
            <p class="curso-selecionado" id="cursoSelecionado">Era Vargas (1930 - 1945).</p>
            <div class="acoes-validacao">
                <button type="button" class="botao-validacao botao-cancelar" id="botaoCancelar">Cancelar</button>
                <button type="button" class="botao-validacao botao-iniciar" id="botaoIniciar">Começar curso</button>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const modal = document.getElementById('modalValidacao');
            const cursoSelecionado = document.getElementById('cursoSelecionado');
            const botaoCancelar = document.getElementById('botaoCancelar');
            const botaoIniciar = document.getElementById('botaoIniciar');
            let cursoAtual = '';

            function abrirModal(card) {
                cursoAtual = card.querySelector('.titulo-curso')?.textContent.trim() || 'este curso';
                cursoSelecionado.textContent = `${cursoAtual}.`;
                modal.classList.add('aberto');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                botaoIniciar.focus();
            }

            function fecharModal() {
                modal.classList.remove('aberto');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            document.querySelectorAll('.cartao-curso').forEach((card) => {
                card.setAttribute('tabindex', '0');
                card.setAttribute('role', 'button');
                card.addEventListener('click', () => abrirModal(card));
                card.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        abrirModal(card);
                    }
                });
            });

            botaoCancelar.addEventListener('click', fecharModal);
            modal.addEventListener('click', (event) => {
                if (event.target === modal) fecharModal();
            });
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('aberto')) fecharModal();
            });

            botaoIniciar.addEventListener('click', () => {
                // Substitua esta rota pela página real do curso.
                window.location.href = `curso.php?nome=${encodeURIComponent(cursoAtual)}`;
            });
        })();
    </script>
</body>
</html>
