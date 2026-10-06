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

$slug_curso_aula = $_GET['curso'] ?? '';
$id_item_aula    = $_GET['id'] ?? '';

$aula_atual  = null;
$indice_aula = null;

if ($slug_curso_aula !== '' && preg_match('/^modulo-(\d+)$/', $id_item_aula, $correspondencia)) {
    $indice_aula       = (int) $correspondencia[1];
    $itens_modulo_aula = $modulos_aulas[$slug_curso_aula]['itens'] ?? [];

    if (isset($itens_modulo_aula[$indice_aula]) && in_array($itens_modulo_aula[$indice_aula]['tipo'] ?? '', ['texto', 'video'], true)) {
        $aula_atual = $itens_modulo_aula[$indice_aula];
    }
}

$valor_titulo_aula    = $aula_atual['titulo'] ?? '';
$valor_subtitulo_aula = $aula_atual['subtitulo'] ?? '';
$valor_duracao_aula   = $aula_atual['duracao'] ?? '';
$valor_imagem_aula    = $aula_atual['imagem'] ?? '';
$valor_alt_aula       = $aula_atual['alt'] ?? '';
$valor_link_video     = $aula_atual['video'] ?? '';

$curso_da_aula = null;
foreach ($cursos as $item_curso) {
    if ($item_curso['slug'] === $slug_curso_aula) {
        $curso_da_aula = $item_curso;
        break;
    }
}
$valor_categoria_aula = $curso_da_aula['categoria'] ?? '';
$valor_tags_aula      = implode(', ', $curso_da_aula['tags'] ?? []);
$categorias_aula      = array_values(array_unique(array_column($cursos, 'categoria')));
$materiais_modulo     = $modulos_aulas[$slug_curso_aula]['materiais'] ?? [];
$valor_tipo_aula    = ($aula_atual['tipo'] ?? 'texto') === 'video' ? 'video' : 'texto';

$html_texto_aula = '';
if (!empty($aula_atual['resumo'])) {
    $html_texto_aula .= '<p>' . htmlspecialchars($aula_atual['resumo']) . '</p>';
}
foreach ($aula_atual['secoes'] ?? [] as $secao) {
    if (!empty($secao['titulo'])) {
        $html_texto_aula .= '<h3>' . htmlspecialchars($secao['titulo']) . '</h3>';
    }
    foreach ($secao['paragrafos'] ?? [] as $paragrafo) {
        $html_texto_aula .= '<p>' . htmlspecialchars($paragrafo) . '</p>';
    }
}

$valor_descricao_video = $aula_atual['descricao'] ?? '';

$link_voltar_aula = $slug_curso_aula !== ''
    ? 'editar-curso.php?curso=' . urlencode($slug_curso_aula)
    : '../comuns/visualizar-aulas.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title>Editar Aula | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/adm-editar-aula.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>
<?php
include __DIR__ . '/../includes/sidebar.php';
include __DIR__ . '/../includes/topbar.php';
?>
<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="<?= htmlspecialchars($link_voltar_aula) ?>"><i class="fa-solid fa-arrow-left"></i> Voltar para curso</a>
            <h1>Editar Aula</h1>
            <p>Escreva, e publique Aula na Alexandria.</p>
        </div>
    </header>

    <form id="form-aula" class="layout-editor" onsubmit="return salvarAula(event)">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id_item_aula) ?>">
        <input type="hidden" name="curso" value="<?= htmlspecialchars($slug_curso_aula) ?>">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-pen-to-square"></i> Conteúdo da aula</div>
            <div class="formulario">
                <div class="campo">
                    <label for="titulo-aula">Título da Aula</label>
                    <input id="titulo-aula" name="titulo" type="text" placeholder="Digite o título da aula..." value="<?= htmlspecialchars($valor_titulo_aula) ?>" required>
                </div>

                <div class="campo">
                    <label for="subtitulo-aula">Subtítulo (opcional)</label>
                    <input id="subtitulo-aula" name="subtitulo" type="text" placeholder="Ex.: (1930 - 1934)" value="<?= htmlspecialchars($valor_subtitulo_aula) ?>">
                    <small class="ajuda">Aparece ao lado do título na lista de conteúdo do curso.</small>
                </div>

                <div class="campo">
                    <label for="tipo-aula">Tipo de Aula</label>
                    <select id="tipo-aula" name="tipo">
                        <option value="texto" <?= $valor_tipo_aula === 'texto' ? 'selected' : '' ?>>Texto</option>
                        <option value="video" <?= $valor_tipo_aula === 'video' ? 'selected' : '' ?>>Vídeo</option>
                    </select>
                    <small class="ajuda">Escolha se esta aula será em formato de texto ou de vídeo.</small>
                </div>

                <div class="campo" id="secao-texto">
                    <label for="texto-aula">Texto da Aula</label>

                    <div class="rte-box" id="caixa-texto">
                        <div class="rte-toolbar">
                            <button type="button" class="rte-btn" data-cmd="bold" title="Negrito"><i class="fa-solid fa-bold"></i></button>
                            <button type="button" class="rte-btn" data-cmd="italic" title="Itálico"><i class="fa-solid fa-italic"></i></button>
                            <button type="button" class="rte-btn" data-cmd="underline" title="Sublinhado"><i class="fa-solid fa-underline"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-acao="link" title="Inserir link"><i class="fa-solid fa-link"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-cmd="insertUnorderedList" title="Lista com marcadores"><i class="fa-solid fa-list-ul"></i></button>
                            <button type="button" class="rte-btn" data-cmd="insertOrderedList" title="Lista numerada"><i class="fa-solid fa-list-ol"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-acao="limpar" title="Limpar formatação"><i class="fa-solid fa-eraser"></i></button>
                            <div class="rte-divisor"></div>
                            <button type="button" class="rte-btn" data-acao="citacao" title="Citação"><i class="fa-solid fa-quote-right"></i></button>


                            <div class="rte-mais-wrap">
                                <button type="button" class="rte-btn" data-acao="mais" title="Mais opções"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="rte-mais-painel">
                                    <div class="rte-mais-linha">
                                        <select class="rte-select rte-fonte" title="Fonte">
                                            <option value="Inter, sans-serif" selected>Sans</option>
                                            <option value="Georgia, serif">Serif</option>
                                            <option value="'Courier New', monospace">Monoespaçada</option>
                                        </select>
                                        <select class="rte-select rte-tamanho" title="Tamanho">
                                            <option value="2">Pequeno</option>
                                            <option value="3" selected>Normal</option>
                                            <option value="5">Grande</option>
                                            <option value="6">Enorme</option>
                                        </select>
                                    </div>
                                    <div class="rte-mais-linha">
                                        <button type="button" class="rte-btn" data-cmd="justifyLeft" title="Alinhar à esquerda"><i class="fa-solid fa-align-left"></i></button>
                                        <button type="button" class="rte-btn" data-cmd="justifyCenter" title="Centralizar"><i class="fa-solid fa-align-center"></i></button>
                                        <button type="button" class="rte-btn" data-cmd="justifyRight" title="Alinhar à direita"><i class="fa-solid fa-align-right"></i></button>
                                        <div class="rte-divisor"></div>
                                        <button type="button" class="rte-btn" data-cmd="strikeThrough" title="Tachado"><i class="fa-solid fa-strikethrough"></i></button>
                                        <button type="button" class="rte-btn" data-acao="imagem" title="Inserir imagem"><i class="fa-regular fa-image"></i></button>
                                    </div>
                                    <div class="rte-mais-linha">
                                        <input type="color" class="rte-cor rte-cor-texto" value="#2c2927" title="Cor do texto">
                                        <input type="color" class="rte-cor rte-cor-destaque" value="#fff3b0" title="Cor de destaque">
                                        <div class="rte-divisor"></div>
                                        <button type="button" class="rte-btn" data-acao="desfazer" title="Desfazer"><i class="fa-solid fa-rotate-left"></i></button>
                                        <button type="button" class="rte-btn" data-acao="refazer" title="Refazer"><i class="fa-solid fa-rotate-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rte-conteudo" id="texto-aula" contenteditable="true" data-placeholder="Comece a escrever o conteúdo da aula..."><?= $html_texto_aula ?></div>

                        <div class="rte-rodape">
                            <span id="contador-palavras">0 palavras</span>
                        </div>
                    </div>
                    <input type="hidden" name="texto" id="texto-aula-valor" value="<?= htmlspecialchars($html_texto_aula) ?>">

                    <small class="ajuda">Use este espaço para desenvolver o texto completo da Aula.</small>
                </div>

                <div class="campo" id="secao-video" style="display:none;">
                    <label>Vídeo da Aula</label>
                    <label class="zona-upload" for="arquivo-video" id="zona-video">
                        <span id="video-placeholder"><i class="fa-solid fa-file-video"></i>Arraste um arquivo de vídeo aqui ou clique para selecionar</span>
                        <span class="nome-arquivo" id="video-nome-arquivo" style="display:none;"></span>
                        <input type="file" id="arquivo-video" accept="video/*" hidden>
                    </label>

                    <div class="separador-ou">ou</div>

                    <input id="link-video" name="link_video" type="url" placeholder="Cole o link do vídeo (YouTube, Vimeo, etc.)" value="<?= htmlspecialchars($valor_link_video) ?>">
                    <small class="ajuda">Envie um arquivo de vídeo ou informe um link. Escolha apenas uma das opções.</small>
                </div>

                <div class="campo" id="secao-descricao-video" style="display:none;">
                    <label for="descricao-video">Descrição da Aula</label>
                    <textarea id="descricao-video" name="descricao_video" placeholder="Descreva brevemente o conteúdo desta aula em vídeo..."><?= htmlspecialchars($valor_descricao_video) ?></textarea>
                </div>

                <div class="linha" id="secao-detalhes-video" style="display:none;">
                    <div class="campo">
                        <label for="duracao-video">Duração</label>
                        <input id="duracao-video" name="duracao" type="text" placeholder="Ex.: 12 min" value="<?= htmlspecialchars($valor_duracao_aula) ?>">
                    </div>
                    <div class="campo">
                        <label for="imagem-video">Imagem de capa do vídeo</label>
                        <input id="imagem-video" name="imagem" type="text" placeholder="../imagens/arquivo.png" value="<?= htmlspecialchars($valor_imagem_aula) ?>">
                    </div>
                    <div class="campo">
                        <label for="alt-video">Texto alternativo da imagem</label>
                        <input id="alt-video" name="alt" type="text" placeholder="Descreva a imagem" value="<?= htmlspecialchars($valor_alt_aula) ?>">
                    </div>
                </div>

                <div class="campo">
                    <label>Material da Aula (PDF)</label>
                    <label class="zona-upload" for="material-pdf" id="zona-pdf">
                        <span id="pdf-placeholder"><i class="fa-solid fa-file-pdf"></i>Clique ou arraste o PDF aqui</span>
                        <span class="nome-arquivo" id="pdf-nome-arquivo" style="display:none;"></span>
                        <input type="file" id="material-pdf" accept="application/pdf" hidden>
                    </label>
                    <small class="ajuda">Material de apoio em PDF para os alunos baixarem (opcional).</small>
                    <?php if (!empty($materiais_modulo)): ?>
                    <small class="ajuda" style="display:block; margin-top:8px;">
                        Materiais já disponíveis no módulo:
                        <?= htmlspecialchars(implode(' · ', array_map(fn($m) => $m['nome'] . ' (' . $m['tipo'] . ')', $materiais_modulo))) ?>
                    </small>
                    <?php endif; ?>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="categoria-aula">Categoria</label>
                        <select id="categoria-aula" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <?php foreach ($categorias_aula as $categoria_opcao): ?>
                            <option <?= $categoria_opcao === $valor_categoria_aula ? 'selected' : '' ?>><?= htmlspecialchars($categoria_opcao) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="tags-aula">Tags</label>
                        <input id="tags-aula" name="tags" type="text" placeholder="Ex.: Roma, Império, História" value="<?= htmlspecialchars($valor_tags_aula) ?>">
                        <small class="ajuda">Separe as tags por vírgula.</small>
                    </div>
                </div>

                <div class="acoes">
                    <a class="botao botao-secundario" href="<?= htmlspecialchars($link_voltar_aula) ?>">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarAula(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> Publicar Aula</button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização da aula">
            <div class="cartao-cabecalho">Pré-visualização</div>
            <div class="preview-conteudo">
                <div class="preview-tipo" id="preview-tipo">Texto</div>
                <div id="preview-categoria" class="preview-categoria">Selecione uma categoria</div>
                <h2 id="preview-titulo">Título da aula</h2>
                <div id="preview-tags" class="lista-tags"></div>

                <div id="preview-bloco-video" class="preview-video-marcador" style="display:none;">
                    <i class="fa-solid fa-circle-play"></i> Vídeo da aula
                </div>
                <p id="preview-descricao-video" class="preview-descricao" style="display:none;">A descrição da aula aparecerá aqui.</p>

                <div id="preview-texto" class="preview-texto">O texto da Aula aparecerá aqui.</div>

                <div id="preview-pdf" class="preview-pdf-marcador" style="display:none;">
                    <i class="fa-solid fa-file-pdf"></i> <span id="preview-pdf-nome"></span>
                </div>
            </div>
        </aside>
    </form>
</main>
<script src="../js/paginas/adm-editar-aula.js"></script>
</body>
</html>