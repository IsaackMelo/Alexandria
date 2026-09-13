<?php
/**
 * adicionar-acervo.php
 * Formulário para cadastro de um novo acervo (imagem de capa, título e descrição),
 * com painel de pré-visualização ao lado, seguindo o mesmo padrão visual
 * das telas administrativas (sidebaradm.html / barraadm.html).
 */

// Página para onde o botão "Adicionar prova" deve redirecionar após salvar o acervo
$link_adicionar_prova = 'adicionar-prova.php';

// Página de retorno do link "Voltar"
$link_voltar = 'visualizar-acervo.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>ADM - Adicionar Acervo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria:   #8b1e2d;
            --vinho-escuro:       #6f1723;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --branco:             #ffffff;
            --cinza-medio:        #e8dfd7;
            --cinza-claro:        #f7f3ee;
            --cinza-upload:       #efe9e1;
            --texto-escuro:       #333333;
            --texto-suave:        #6b6b6b;
            --verde-sucesso:      #2f8f4e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cinza-claro);
        }

        /* ===== Barra superior ===== */
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

        .direita-barra-superior {
            display: flex;
            align-items: center;
            gap: 20px;
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

        .distintivo-funcao i { font-size: 10px; }

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

        .container-principal {
            margin-left: 156px;
            width: calc(100% - 156px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Conteúdo da página ===== */
        .conteudo-adicionar-acervo {
            padding: 30px 30px 60px 30px;
        }

        .link-voltar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--vinho-alexandria);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .link-voltar:hover {
            color: var(--vinho-escuro);
        }

        .titulo-pagina {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 34px;
            color: var(--vinho-alexandria);
            margin-bottom: 6px;
        }

        .subtitulo-pagina {
            color: var(--texto-suave);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .card-secao {
            background: var(--branco);
            border: 1px solid var(--cinza-medio);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .rotulo-campo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--texto-escuro);
            margin-bottom: 10px;
        }

        .rotulo-campo i,
        .rotulo-campo .bi {
            color: var(--vinho-alexandria);
            font-size: 15px;
        }

        .form-control-alexandria {
            width: 100%;
            border: 1px solid var(--cinza-medio);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            color: var(--texto-escuro);
            font-family: 'Inter', sans-serif;
        }

        .form-control-alexandria:focus {
            outline: none;
            border-color: var(--vinho-alexandria);
            box-shadow: 0 0 0 3px rgba(139, 30, 45, 0.1);
        }

        textarea.form-control-alexandria {
            resize: vertical;
            min-height: 90px;
        }

        .contador-caracteres {
            text-align: right;
            font-size: 12px;
            color: var(--texto-suave);
            margin-top: 6px;
        }

        /* Upload de imagem */
        .upload-imagem {
            width: 100%;
            max-width: 230px;
            aspect-ratio: 1 / 1;
            background: var(--cinza-upload);
            border: 1px dashed var(--cinza-medio);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            transition: border-color 0.15s ease, background 0.15s ease;
        }

        .upload-imagem:hover {
            border-color: var(--vinho-alexandria);
            background: #eae2d8;
        }

        .upload-imagem i {
            font-size: 26px;
            color: var(--texto-suave);
        }

        .upload-imagem span {
            font-size: 12.5px;
            color: var(--texto-suave);
            text-align: center;
            padding: 0 10px;
        }

        .upload-imagem img.preview-real {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .upload-imagem input[type="file"] {
            display: none;
        }

        /* Grupo período histórico (select) */
        .form-select-alexandria {
            width: 100%;
            border: 1px solid var(--cinza-medio);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            color: var(--texto-escuro);
            background: var(--branco);
        }

        .form-select-alexandria:focus {
            outline: none;
            border-color: var(--vinho-alexandria);
            box-shadow: 0 0 0 3px rgba(139, 30, 45, 0.1);
        }

        /* ===== Pré-visualização ===== */
        .card-pre-visualizacao {
            background: var(--branco);
            border: 1px solid var(--cinza-medio);
            border-radius: 12px;
            padding: 20px;
        }

        .titulo-pre-visualizacao {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--vinho-alexandria);
            margin-bottom: 16px;
        }

        .mini-card-acervo {
            border: 1px solid var(--cinza-medio);
            border-radius: 10px;
            overflow: hidden;
        }

        .mini-card-acervo .mini-logo {
            height: 130px;
            background: var(--cinza-claro);
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--cinza-medio);
            overflow: hidden;
        }

        .mini-card-acervo .mini-logo i {
            font-size: 30px;
            color: #bdb3a6;
        }

        .mini-card-acervo .mini-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .mini-card-acervo .mini-corpo {
            padding: 14px 16px;
        }

        .mini-card-acervo .mini-corpo h6 {
            font-size: 14px;
            font-weight: 700;
            color: var(--texto-escuro);
            margin-bottom: 6px;
        }

        .mini-card-acervo .mini-corpo hr {
            border: none;
            border-top: 1px solid var(--cinza-medio);
            margin: 8px 0;
        }

        .mini-card-acervo .mini-corpo .status-preview {
            font-size: 12px;
            color: var(--texto-suave);
        }

        .texto-ajuda-preview {
            font-size: 12.5px;
            color: var(--texto-suave);
            margin-top: 14px;
            line-height: 1.5;
        }

        /* ===== Botão principal ===== */
        .acoes-formulario {
            margin-top: 10px;
        }

        .btn-adicionar-prova {
            width: 100%;
            background: var(--cinza-upload);
            color: var(--texto-suave);
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: background 0.15s ease;
        }

        .btn-adicionar-prova:hover {
            background: #e5ddd2;
            color: var(--texto-suave);
        }

        .btn-adicionar-prova .icone-mais {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #a39a8c;
            color: var(--branco);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    <?php 
    include("../alexandria-frontend/includes/barraadm.html");
    include("../alexandria-frontend/includes/sidebaradm.html");
    ?>

    <div class="container-principal">

        <div class="conteudo-adicionar-acervo">

            <a href="<?= htmlspecialchars($link_voltar) ?>" class="link-voltar">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>

            <h1 class="titulo-pagina">Criar Acervo</h1>
            <p class="subtitulo-pagina">Preencha as informações abaixo para cadastrar um novo acervo.</p>

            <form id="formAdicionarAcervo" action="salvar-acervo.php" method="POST" enctype="multipart/form-data">

                <div class="row g-4">

                    <!-- Coluna do formulário -->
                    <div class="col-lg-8">
                        <div class="card-secao">

                            <div class="row g-4">

                                <div class="col-md-4">
                                    <div class="rotulo-campo">
                                        <i class="bi bi-image"></i> Imagem de Capa
                                    </div>

                                    <label class="upload-imagem" id="labelUploadImagem">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span>Clique para adicionar uma capa</span>
                                        <img src="" alt="Pré-visualização da capa" class="preview-real" id="previewImagemAcervo">
                                        <input type="file" name="imagem_acervo" id="inputImagemAcervo" accept="image/*">
                                    </label>
                                </div>

                                <div class="col-md-8">
                                    <div class="rotulo-campo">
                                        <i class="bi bi-type-bold"></i> Título do Acervo
                                    </div>
                                    <input type="text"
                                           class="form-control-alexandria"
                                           id="inputTituloAcervo"
                                           name="titulo_acervo"
                                           placeholder="Ex.: FGV, CEBRASPE, ENEM..."
                                           maxlength="80">

                                    <div class="mt-4">
                                        <div class="rotulo-campo">
                                            <i class="bi bi-file-text"></i> Descrição do Acervo
                                        </div>
                                        <textarea class="form-control-alexandria"
                                                  id="textareaDescricaoAcervo"
                                                  name="descricao_acervo"
                                                  maxlength="2000"
                                                  placeholder="Conte sobre a banca, seu estilo de prova e para quem ela é indicada..."
                                                  ></textarea>
                                        <div class="contador-caracteres"><span id="contadorAtual">0</span>/2000</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="acoes-formulario">
                            <button type="submit" class="btn-adicionar-prova">
                                <span class="icone-mais"><i class="fas fa-plus"></i></span> Adicionar prova
                            </button>
                        </div>
                    </div>

                    <!-- Coluna de pré-visualização -->
                    <div class="col-lg-4">
                        <div class="card-pre-visualizacao">
                            <div class="titulo-pre-visualizacao">
                                <i class="bi bi-eye"></i> Pré-visualização
                            </div>

                            <div class="mini-card-acervo">
                                <div class="mini-logo">
                                    <i class="bi bi-image" id="iconePreviewVazio"></i>
                                    <img src="" alt="" id="imgPreviewMini">
                                </div>
                                <div class="mini-corpo">
                                    <h6 id="tituloPreviewMini">Título do acervo</h6>
                                    <hr>
                                    <span class="status-preview">Pronto para publicação</span>
                                </div>
                            </div>

                            <p class="texto-ajuda-preview">
                                É assim que o card do acervo vai aparecer para os alunos na Alexandria.
                            </p>
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-atA0O1qEqiJDsBxdI0AGZgLcAujG6SC0zj/BZgY9M9NRhvpAf6yZmaAJk8bK9EIF" crossorigin="anonymous"></script>
    <script>
        const linkAdicionarProva = <?= json_encode($link_adicionar_prova) ?>;

        // ===== Upload e pré-visualização da imagem =====
        const inputImagem      = document.getElementById('inputImagemAcervo');
        const previewImagem    = document.getElementById('previewImagemAcervo');
        const labelUploadTexto = document.querySelector('#labelUploadImagem span');
        const iconeUpload      = document.querySelector('#labelUploadImagem i.fa-cloud-upload-alt');
        const iconePreviewVazio = document.getElementById('iconePreviewVazio');
        const imgPreviewMini   = document.getElementById('imgPreviewMini');

        inputImagem.addEventListener('change', function () {
            const arquivo = this.files && this.files[0];
            if (!arquivo) return;

            const leitor = new FileReader();
            leitor.onload = function (e) {
                // Card de upload
                previewImagem.src = e.target.result;
                previewImagem.style.display = 'block';
                labelUploadTexto.style.display = 'none';
                iconeUpload.style.display = 'none';

                // Mini card de pré-visualização
                imgPreviewMini.src = e.target.result;
                imgPreviewMini.style.display = 'block';
                iconePreviewVazio.style.display = 'none';
            };
            leitor.readAsDataURL(arquivo);
        });

        // ===== Título em tempo real na pré-visualização =====
        const inputTitulo   = document.getElementById('inputTituloAcervo');
        const tituloPreview = document.getElementById('tituloPreviewMini');

        inputTitulo.addEventListener('input', function () {
            tituloPreview.textContent = this.value.trim() !== '' ? this.value : 'Título do acervo';
        });

        // ===== Contador de caracteres da descrição =====
        const textareaDescricao = document.getElementById('textareaDescricaoAcervo');
        const contadorAtual     = document.getElementById('contadorAtual');

        textareaDescricao.addEventListener('input', function () {
            contadorAtual.textContent = this.value.length;
        });

        // ===== Envio do formulário: salva e redireciona para a tela de adicionar prova =====
        document.getElementById('formAdicionarAcervo').addEventListener('submit', function (e) {
            e.preventDefault();

            // Aqui você pode enviar os dados via fetch()/AJAX para salvar o acervo antes de redirecionar.
            // Exemplo:
            // fetch(this.action, { method: 'POST', body: new FormData(this) })
            //     .then(() => window.location.href = linkAdicionarProva);

            window.location.href = linkAdicionarProva;
        });
    </script>

</body>
</html>