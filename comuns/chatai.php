<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

$nome_chat = explode(' ', trim($_SESSION['conta']['nome'] ?? 'Estudante'))[0];
$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
?>
<?php include __DIR__ . '/../includes/topbar.php'; ?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Alexandria – Chat AI</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-chatai.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body class="pagina-chat">
    
    <?php
        include __DIR__ . '/../includes/sidebar.php';
    ?>

    <div class="container-principal">

        <div class="conteudo-chat" id="conteudoChat">
            <h1 class="saudacao-principal">Olá, <?= $e($nome_chat) ?>.</h1>
            <h2 class="subtitulo-saudacao">Por onde começamos?</h2>
            <p class="descricao-saudacao">Sou seu assistente de estudos. Pergunte sobre qualquer assunto e vamos aprender juntos!</p>

            <div class="boas-vindas" id="boasVindas">
            <div class="grade-cartoes">
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="../imagens/partenon 2.png"></div>
                    <div class="titulo-tema">Grécia Antiga</div>
                    <div class="texto-tema">Democracia ateniense, filosofia e principais acontecimentos.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="../imagens/coliseu 2.png"></div>
                    <div class="titulo-tema">Roma Antiga</div>
                    <div class="texto-tema">República, império, direito romano e expansão territorial.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="../imagens/naufragio 2.png"></div>
                    <div class="titulo-tema">Grandes Navegações</div>
                    <div class="texto-tema">Descobrimentos, rotas marítimas e impactos históricos.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
                <div class="cartao-tema">
                    <div class="icone-tema"><img src="../imagens/guilhotina 1.png"></div>
                    <div class="titulo-tema">Revoluções</div>
                    <div class="texto-tema">Revolução Francesa, Independência dos EUA e seus efeitos.</div>
                    <div class="seta-tema"><i class="fas fa-arrow-right"></i></div>
                </div>
            </div>
            </div>

            <div class="lista-mensagens" id="listaMensagens" hidden aria-live="polite"></div>

            <div class="envoltorio-entrada">
                <div class="arquivo-selecionado" id="arquivoSelecionado">
                    <i class="fas fa-paperclip"></i>
                    <span id="nomeArquivo"></span>
                    <button type="button" id="removerArquivo" aria-label="Remover arquivo"><i class="fas fa-xmark"></i></button>
                </div>
                <div class="container-entrada">
                    <button class="botao-adicionar" id="botaoAdicionar" type="button" title="Anexar imagem ou PDF" aria-label="Anexar imagem ou PDF">+</button>
                    <input type="file" id="arquivoChat" accept="image/*,application/pdf" hidden>
                    <input type="text" class="entrada-chat" id="entradaChat" placeholder="Pergunte o que quiser" autocomplete="off">
                    <div class="distintivo-pro">
                        Pro <i class="fas fa-chevron-down"></i>
                    </div>
                    <button class="botao-enviar" id="botaoEnviar" type="button" aria-label="Enviar mensagem" disabled>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            <div class="informacoes-footer">
                <div class="item-informacao">
                    <i class="fas fa-check-circle"></i>
                    <span>Respostas confiáveis</span>
                </div>
                <div class="separador-ponto"></div>
                <div class="item-informacao">
                    <i class="fas fa-clock"></i>
                    <span>Atualizado constantemente</span>
                </div>
                <div class="separador-ponto"></div>
                <div class="item-informacao">
                    <i class="fas fa-lock"></i>
                    <span>Dados protegidos</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/paginas/comuns-chatai.js"></script>
</body>
</html>