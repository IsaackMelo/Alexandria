<?php
$modo_formulario = 'editar';
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SESSION['conta']['tipo'] !== 'ADM') {
    header('Location: ../comuns/visualizar-curso.php');
    exit;
}
?>
<?php

require_once __DIR__ . '/../includes/dados.php';

$id_acervo    = null;
$acervo_atual = null;
if ($modo_formulario === 'editar') {
    $id_acervo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    foreach ($acervos as $item) {
        if ($item['id'] === $id_acervo) {
            $acervo_atual = $item;
            break;
        }
    }
}

$valor_titulo    = $acervo_atual['nome'] ?? '';
$valor_descricao = $acervo_atual['descricao'] ?? '';
$valor_imagem    = $acervo_atual['logo'] ?? '';
$valor_nome_completo = $acervo_atual['nome_completo'] ?? '';
$valor_slug          = $acervo_atual['slug'] ?? '';
$valor_tipo          = $acervo_atual['tipo'] ?? 'vestibular';
$valor_site          = $acervo_atual['site'] ?? '';

$link_adicionar_prova = 'adicionar-prova.php';

$provas_do_acervo = array_filter($provas, function ($prova) use ($valor_slug) {
    return $valor_slug !== '' && ($prova['banca'] ?? '') === $valor_slug;
});

$link_voltar = '../comuns/visualizar-acervo.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>ADM - <?= $modo_formulario === 'editar' ? 'Editar' : 'Adicionar' ?> Acervo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/adm-acervo.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php 
    include __DIR__ . '/../includes/topbar.php';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

    <div class="container-principal">

        <div class="conteudo-adicionar-acervo">

            <a href="<?= htmlspecialchars($link_voltar) ?>" class="link-voltar">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>

            <h1 class="titulo-pagina"><?= $modo_formulario === 'editar' ? 'Editar Acervo' : 'Criar Acervo' ?></h1>
            <p class="subtitulo-pagina"><?= $modo_formulario === 'editar' ? 'Atualize as informações do acervo abaixo.' : 'Preencha as informações abaixo para cadastrar um novo acervo.' ?></p>

            <form id="formAdicionarAcervo" action="#" method="POST" enctype="multipart/form-data">

                <?php if ($modo_formulario === 'editar'): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_acervo) ?>">
                <?php endif; ?>

                <div class="row g-4">

                    <div class="col-lg-8">
                        <div class="card-secao">

                            <div class="row g-4">

                                <div class="col-md-4">
                                    <div class="rotulo-campo">
                                        <i class="bi bi-image"></i> Imagem de Capa
                                    </div>

                                    <label class="upload-imagem" id="labelUploadImagem">
                                        <i class="fas fa-cloud-upload-alt" style="<?= $valor_imagem ? 'display:none;' : '' ?>"></i>
                                        <span style="<?= $valor_imagem ? 'display:none;' : '' ?>">Clique para adicionar uma capa</span>
                                        <img src="<?= htmlspecialchars($valor_imagem) ?>" alt="Pré-visualização da capa" class="preview-real" id="previewImagemAcervo" style="<?= $valor_imagem ? 'display:block;' : '' ?>">
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
                                           value="<?= htmlspecialchars($valor_titulo) ?>"
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
                                                  ><?= htmlspecialchars($valor_descricao) ?></textarea>
                                        <div class="contador-caracteres"><span id="contadorAtual"><?= mb_strlen($valor_descricao) ?></span>/2000</div>
                                    </div>
                                    <div class="row g-3 mt-2">
                                        <div class="col-md-6">
                                            <div class="rotulo-campo"><i class="bi bi-building"></i> Nome completo da banca</div>
                                            <input type="text" class="form-control-alexandria" id="inputNomeCompletoAcervo" name="nome_completo"
                                                   placeholder="Ex.: Fundação Universitária para o Vestibular" value="<?= htmlspecialchars($valor_nome_completo) ?>" maxlength="160">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rotulo-campo"><i class="bi bi-link-45deg"></i> Identificador (slug)</div>
                                            <input type="text" class="form-control-alexandria" id="inputSlugAcervo" name="slug"
                                                   placeholder="Ex.: fuvest" value="<?= htmlspecialchars($valor_slug) ?>" maxlength="40" pattern="[a-z0-9-]+">
                                            <small class="text-muted">Usado no endereço das provas (visualizar-prova.php?banca=slug).</small>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rotulo-campo"><i class="bi bi-tag"></i> Tipo de acervo</div>
                                            <select class="form-control-alexandria" id="selectTipoAcervo" name="tipo">
                                                <?php foreach ($tipos_acervo as $chave_tipo => $rotulo_tipo): ?>
                                                <option value="<?= $chave_tipo ?>" <?= $valor_tipo === $chave_tipo ? 'selected' : '' ?>><?= htmlspecialchars($rotulo_tipo) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rotulo-campo"><i class="bi bi-globe"></i> Site oficial</div>
                                            <input type="url" class="form-control-alexandria" id="inputSiteAcervo" name="site"
                                                   placeholder="https://..." value="<?= htmlspecialchars($valor_site) ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="acoes-formulario">
                            <button type="submit" class="btn-adicionar-prova">
                                <span class="icone-mais"><i class="fas fa-<?= $modo_formulario === 'editar' ? 'check' : 'plus' ?>"></i></span> <?= $modo_formulario === 'editar' ? 'Salvar alterações' : 'Adicionar prova' ?>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card-pre-visualizacao">
                            <div class="titulo-pre-visualizacao">
                                <i class="bi bi-eye"></i> Pré-visualização
                            </div>

                            <div class="mini-card-acervo">
                                <div class="mini-logo">
                                    <i class="bi bi-image" id="iconePreviewVazio" style="<?= $valor_imagem ? 'display:none;' : '' ?>"></i>
                                    <img src="<?= htmlspecialchars($valor_imagem) ?>" alt="" id="imgPreviewMini" style="<?= $valor_imagem ? 'display:block;' : '' ?>">
                                </div>
                                <div class="mini-corpo">
                                    <h6 id="tituloPreviewMini"><?= $valor_titulo !== '' ? htmlspecialchars($valor_titulo) : 'Título do acervo' ?></h6>
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

            <?php if ($modo_formulario === 'editar'): ?>
            <div class="card-provas-acervo">
                <h2 class="titulo-provas-acervo">Provas do acervo</h2>

                <a href="<?= htmlspecialchars($link_adicionar_prova) ?>?acervo_id=<?= (int) $id_acervo ?>" class="btn-adicionar-item-prova">
                    <span class="icone-mais-prova"><i class="fas fa-plus"></i></span> Adicionar Prova
                </a>

                <?php if (empty($provas_do_acervo)): ?>
                    <p class="aviso-sem-provas">Nenhuma prova cadastrada para este acervo ainda.</p>
                <?php else: ?>
                    <div class="lista-provas-acervo" id="listaProvasAcervo">
                        <?php foreach ($provas_do_acervo as $indice_prova => $prova): ?>
                            <div class="linha-prova-acervo">
                                <div class="info-prova-acervo">
                                    <span class="icone-prova-acervo"><i class="bi bi-journal-text"></i></span>
                                    <span class="titulo-linha-prova">
                                        <?= htmlspecialchars($prova['titulo'] ?? ($prova['ano'] . ' — ' . $prova['fase'] . ' (' . $prova['versao'] . ')')) ?>
                                        <small style="display:block; opacity:.7;"><?= (int) ($prova['total_perguntas'] ?? 0) ?> perguntas · <?= htmlspecialchars($prova['ano'] . ' · ' . $prova['fase'] . ' · ' . $prova['versao']) ?></small>
                                    </span>
                                </div>

                                <div class="acoes-linha-prova">
                                    <select class="select-dificuldade-prova" disabled>
                                        <option><?= htmlspecialchars($textos_dificuldade[strtolower($prova['dificuldade'])] ?? $prova['dificuldade']) ?></option>
                                    </select>

                                    <a href="editar-prova.php?acervo_id=<?= (int) $id_acervo ?>&amp;prova=<?= (int) $indice_prova ?>" class="acao-editar-prova">
                                        <i class="fas fa-pen"></i> Editar
                                    </a>

                                    <button type="button"
                                            class="acao-excluir-prova"
                                            title="Excluir prova"
                                            onclick="confirmarExclusaoProva(<?= (int) $indice_prova ?>, '<?= htmlspecialchars(addslashes($prova['ano'] . ' - ' . $prova['fase'] . ' ' . $prova['versao'])) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-atA0O1qEqiJDsBxdI0AGZgLcAujG6SC0zj/BZgY9M9NRhvpAf6yZmaAJk8bK9EIF" crossorigin="anonymous"></script>
    <script>
        const linkAdicionarProva = <?= json_encode($link_adicionar_prova) ?>;

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
                previewImagem.src = e.target.result;
                previewImagem.style.display = 'block';
                labelUploadTexto.style.display = 'none';
                iconeUpload.style.display = 'none';

                imgPreviewMini.src = e.target.result;
                imgPreviewMini.style.display = 'block';
                iconePreviewVazio.style.display = 'none';
            };
            leitor.readAsDataURL(arquivo);
        });

        const inputTitulo   = document.getElementById('inputTituloAcervo');
        const tituloPreview = document.getElementById('tituloPreviewMini');

        inputTitulo.addEventListener('input', function () {
            tituloPreview.textContent = this.value.trim() !== '' ? this.value : 'Título do acervo';
        });

        const textareaDescricao = document.getElementById('textareaDescricaoAcervo');
        const contadorAtual     = document.getElementById('contadorAtual');

        textareaDescricao.addEventListener('input', function () {
            contadorAtual.textContent = this.value.length;
        });

        document.getElementById('formAdicionarAcervo').addEventListener('submit', function (e) {
            e.preventDefault();

            window.location.href = linkAdicionarProva;
        });

        function confirmarExclusaoProva(indice, rotulo) {
            if (confirm('Tem certeza que deseja excluir a prova "' + rotulo + '"?')) {
                const linhas = document.querySelectorAll('#listaProvasAcervo .linha-prova-acervo');
                if (linhas[indice]) {
                    linhas[indice].remove();
                }
            }
        }
    </script>

</body>
</html>