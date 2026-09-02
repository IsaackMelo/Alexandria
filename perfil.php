<?php

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" conteudo="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>Alexandria – Meu Perfil</title>
    
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
            --cinza-escuro: #999999;
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
            color: var(--dourado-alexandria);
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--dourado-claro);
        }

        .sidebar-menu li a .imagem-icone {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            object-fit: contain;
        }

        .sidebar-menu li a .icone-fonte, .sidebar-footer li a .icone-fonte{
            width: 18px;
            font-size: 14px;
            margin-right: 10px;
            text-align: center;
            color: var(--dourado-alexandria);
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

        
        .container-principal {
            margin-left: 140px;
            width: calc(100% - 118px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        
        .barra-superior {
            background: var(--branco);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--cinza-medio);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .titulo-barra-superior {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--texto-escuro);
        }

        .centro-barra-superior {
            display: flex;
            gap: 15px;
            align-items: center;
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

        
        .conteudo {
            flex: 1;
            padding: 30px;
            display: flex;
            gap: 30px;
        }

        
        .secao-esquerda {
            flex: 0 0 300px;
        }

        .cartao-perfil {
            background: var(--branco);
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .avatar-perfil {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--vinho-alexandria);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 50px;
            color: var(--dourado-alexandria);
        }

        .nome-perfil {
            font-size: 16px;
            font-weight: 600;
            color: var(--texto-escuro);
            margin-bottom: 5px;
        }

        .funcao-perfil {
            font-size: 12px;
            color: var(--cinza-escuro);
            margin-bottom: 15px;
        }

        .botao-editar-perfil {
            border: 1px solid var(--vinho-alexandria);
            color: var(--vinho-alexandria);
            background: transparent;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
            margin-bottom: 20px;
        }

        .botao-editar-perfil:hover {
            background: var(--vinho-alexandria);
            color: var(--branco);
        }

        .estatisticas-perfil {
            display: flex;
            flex-direction: column;
            gap: 15px;
            text-align: left;
        }

        .item-estatistica {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--cinza-medio);
        }

        .item-estatistica:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .icone-estatistica {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f0e6f6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 16px;
            color: var(--vinho-alexandria);
        }

        .conteudo-estatistica {
            flex: 1;
        }

        .rotulo-estatistica {
            font-size: 11px;
            color: var(--cinza-escuro);
            margin-bottom: 3px;
        }

        .valor-estatistica {
            font-size: 13px;
            font-weight: 600;
            color: var(--texto-escuro);
        }
        .secao-direita {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cartao-informacao {
            background: var(--branco);
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .titulo-cartao-informacao {
            font-size: 16px;
            font-weight: 600;
            color: var(--texto-escuro);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .titulo-cartao-informacao i {
            color: var(--vinho-alexandria);
            font-size: 14px;
        }

        .subtitulo-cartao-informacao {
            font-size: 12px;
            color: var(--cinza-escuro);
            margin-bottom: 20px;
        }

        .grade-informacoes {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .campo-informacao {
            display: flex;
            flex-direction: column;
        }

        .rotulo-campo-informacao {
            font-size: 11px;
            color: var(--cinza-escuro);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .valor-campo-informacao {
            font-size: 13px;
            color: var(--texto-escuro);
            font-weight: 500;
        }

        .entrada-campo-informacao {
            font-size: 13px;
            color: var(--texto-escuro);
            padding: 8px 0;
            border: none;
            border-bottom: 1px solid var(--cinza-medio);
            background: transparent;
            font-family: 'Inter', sans-serif;
        }

        .entrada-campo-informacao:focus {
            outline: none;
            border-bottom-color: var(--dourado-alexandria);
        }

        .secao-privacidade {
            background: #faf9f8;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .titulo-privacidade {
            font-size: 13px;
            font-weight: 600;
            color: var(--texto-escuro);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .titulo-privacidade i {
            color: var(--vinho-alexandria);
        }

        .texto-privacidade {
            font-size: 12px;
            color: var(--cinza-escuro);
            line-height: 1.5;
        }

        .grupo-botoes {
            display: flex;
            gap: 12px;
        }

        .botao-cancelar {
            flex: 1;
            padding: 10px 16px;
            border: 1px solid var(--cinza-medio);
            background: var(--branco);
            color: var(--texto-escuro);
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .botao-cancelar:hover {
            background: var(--cinza-claro);
            border-color: var(--cinza-escuro);
        }

        .botao-salvar {
            flex: 1;
            padding: 10px 16px;
            border: none;
            background: var(--vinho-alexandria);
            color: var(--branco);
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .botao-salvar:hover {
            background: #6d1621;
        }

        /* responsividade*/
        @media (max-width: 1024px) {
            .conteudo {
                flex-direction: column;
            }

            .secao-esquerda {
                flex: 1;
            }

            .secao-direita {
                flex: 1;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .container-principal {
                margin-left: 60px;
                width: calc(100% - 60px);
            }

            .sidebar-menu li a {
                padding: 10px 6px;
            }

            .sidebar-menu li a .text {
                font-size: 7px;
            }

            .barra-superior {
                padding: 12px 20px;
            }

            .titulo-barra-superior {
                font-size: 16px;
            }

            .conteudo {
                padding: 20px;
                gap: 20px;
            }

            .grade-informacoes {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-top-group">
            <div class="sidebar-header">
                <img src="imagens/logo.png" alt="Alexandria Logo">
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="#">
                        <img src="imagens/cursos.png" class="imagem-icone" alt="Cursos">
                        <span class="text">Cursos disponíveis</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/meus-cursos.png" class="imagem-icone" alt="Meus Cursos">
                        <span class="text">Meus cursos</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/prancheta.png" class="imagem-icone" alt="Artigos">
                        <span class="text">Artigos</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/ia.png" class="imagem-icone" alt="Chat AI">
                        <span class="text">Chat AI</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/banco_questao.png" class="imagem-icone" alt="Banco de Questões">
                        <span class="text">Banco de questões</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="imagens/notificacao.png" class="imagem-icone" alt="Notificação">
                        <span class="text">Notificação</span>
                    </a>
                </li>
            </ul>
        </div>

        <ul class="sidebar-footer">
            <li>
                <a href="#">
                    <span class="icone-fonte"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container-principal">
        <div class="barra-superior">
            <div class="titulo-barra-superior">Meu Perfil</div>
            <div class="direita-barra-superior">
                <div class="distintivo-funcao">
                    <span>Estudante</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="nome-usuario">Igor Bueno</div>
                <div class="avatar-usuario">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

        <div class="conteudo">
            <div class="secao-esquerda">
                <div class="cartao-perfil">
                    <div class="avatar-perfil">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="nome-perfil">Igor Bueno de Santana</div>
                    <div class="funcao-perfil">Estudante</div>
                    <button class="botao-editar-perfil">Editar senha</button>

                    <div class="estatisticas-perfil">
                        <div class="item-estatistica">
                            <img src="imagens/datas (1) 3.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Membro desde</div>
                                <div class="valor-estatistica">10 de janeiro de 2024</div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="imagens/escudo 2.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Tipo de conta</div>
                                <div class="valor-estatistica">Estudante</div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="imagens/livro 3.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Cursos em andamento</div>
                                <div class="valor-estatistica">3</div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="imagens/alvo-com-flecha 2.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Questões respondidas</div>
                                <div class="valor-estatistica">1.248</div>
                            </div>
                        </div>
                        <div class="item-estatistica">
                            <img src="imagens/medalha 2.png">
                            <div class="conteudo-estatistica">
                                <div class="rotulo-estatistica">Simulados realizados</div>
                                <div class="valor-estatistica">12</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="secao-direita">
                <div class="cartao-informacao">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-user"></i>
                        Informações Pessoais
                    </div>
                    <div class="subtitulo-cartao-informacao">Atualize seus dados pessoais</div>

                    <div class="grade-informacoes">
                        <div class="campo-informacao">
                            <label class="rotulo-campo-informacao">Nome completo</label>
                            <div class="valor-campo-informacao">Igor Bueno de Santana</div>
                        </div>
                        <div class="campo-informacao">
                            <label class="rotulo-campo-informacao">Telefone</label>
                            <div class="valor-campo-informacao">55+ - 11 98765 - 4821</div>
                        </div>
                    </div>

                    <div class="campo-informacao" style="margin-bottom: 20px;">
                        <label class="rotulo-campo-informacao">E-mail</label>
                        <div class="valor-campo-informacao">igorbueno005@gmail.com</div>
                    </div>

                    <div class="campo-informacao" style="margin-bottom: 20px;">
                        <label class="rotulo-campo-informacao">Data de nascimento</label>
                        <div class="valor-campo-informacao">10 / 09 / 2008</div>
                    </div>
                </div>

                <!-- PRIVACIDADE -->
                <div class="cartao-informacao">
                    <div class="titulo-cartao-informacao">
                        <i class="fas fa-lock"></i>
                        Privacidade
                    </div>

                    <div class="secao-privacidade">
                        <div class="titulo-privacidade">
                            <i class="fas fa-shield-alt"></i>
                            Sua privacidade é importante.
                        </div>
                        <div class="texto-privacidade">
                            Seus dados estão protegidos.
                        </div>
                    </div>

                    <div class="grupo-botoes">
                        <button class="botao-cancelar">Cancelar</button>
                        <button class="botao-salvar">Salvar alterações</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
