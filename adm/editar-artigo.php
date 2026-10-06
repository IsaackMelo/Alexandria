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
$modo_formulario = 'editar';

require_once __DIR__ . '/../includes/dados.php';

$id_artigo    = null;
$artigo_atual = null;
if ($modo_formulario === 'editar') {
    $id_artigo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id_artigo !== null && $id_artigo !== false && isset($artigos[$id_artigo])) {
        $artigo_atual = $artigos[$id_artigo];
    }
}

$valor_titulo        = $artigo_atual['titulo'] ?? '';
$valor_descricao     = $artigo_atual['resumo'] ?? '';
$valor_categoria     = $artigo_atual['categoria'] ?? '';
$valor_imagem        = $artigo_atual['imagem'] ?? '';
$valor_autor         = $artigo_atual['autor'] ?? '';
$valor_tempo_leitura = $artigo_atual['tempo_leitura'] ?? '';
$valor_data          = $artigo_atual['data'] ?? '';
$valor_tags          = implode(', ', $artigo_atual['tags'] ?? []);

$html_conteudo = html_artigo_seguro($artigo_atual['conteudo'] ?? '');

$autores_existentes = array_values(array_unique(array_column($artigos, 'autor')));

include __DIR__ . '/../includes/topbar.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title><?= $modo_formulario === 'editar' ? 'Editar artigo' : 'Novo artigo' ?> | Alexandria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/adm-artigo.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

<main class="pagina">
    <header class="cabecalho-pagina">
        <div>
            <a class="voltar" href="../comuns/visualizar-artigos.php"><i class="fa-solid fa-arrow-left"></i> Voltar para artigos</a>
            <h1><?= $modo_formulario === 'editar' ? 'Editar artigo' : 'Novo artigo' ?></h1>
            <p><?= $modo_formulario === 'editar' ? 'Atualize o conteúdo do artigo na Alexandria.' : 'Escreva, revise e publique um novo artigo na Alexandria.' ?></p>
            <?php if ($modo_formulario === 'editar' && $artigo_atual === null): ?>
            <p style="color:#b3261e; font-weight:600;">Artigo não encontrado. Verifique o parâmetro "id" da URL.</p>
            <?php endif; ?>
        </div>
    </header>

    <form id="form-artigo" class="layout-editor" onsubmit="return salvarArtigo(event)">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_artigo) ?>">
        <section class="cartao">
            <div class="cartao-cabecalho"><i class="fa-solid fa-pen-to-square"></i> Conteúdo do artigo</div>
            <div class="formulario">
                <div class="campo">
                    <label for="titulo-artigo">Título do artigo</label>
                    <input id="titulo-artigo" name="titulo" type="text" placeholder="Digite o título do artigo..." value="<?= htmlspecialchars($valor_titulo) ?>" required>
                </div>
                <div class="campo">
                    <label for="descricao-artigo">Descrição ou resumo</label>
                    <textarea id="descricao-artigo" name="descricao" placeholder="Escreva uma breve descrição do artigo..." required><?= htmlspecialchars($valor_descricao) ?></textarea>
                </div>

                <div class="campo">
                    <label for="conteudo-artigo">Texto do artigo</label>

                    <div class="rte-box" id="caixa-conteudo">
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

                        <div class="rte-conteudo" id="conteudo-artigo" contenteditable="true" data-placeholder="Comece a escrever o conteúdo do artigo..."><?= $html_conteudo ?></div>

                        <div class="rte-rodape">
                            <span id="contador-palavras">0 palavras</span>
                        </div>
                    </div>
                    <input type="hidden" name="conteudo" id="conteudo-artigo-valor">

                    <small class="ajuda">Use este espaço para desenvolver o texto completo do artigo.</small>
                </div>

                <div class="linha">
                    <div class="campo">
                        <label for="categoria-artigo">Categoria</label>
                        <select id="categoria-artigo" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <?php
                            $opcoes_categoria = $categorias_artigos_disponiveis;
                            foreach ($opcoes_categoria as $opcao) {
                                $selecionada = ($opcao === $valor_categoria) ? ' selected' : '';
                                echo '<option' . $selecionada . '>' . htmlspecialchars($opcao) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="tags-artigo">Tags</label>
                        <input id="tags-artigo" name="tags" type="text" placeholder="Ex.: Roma, Império, História" value="<?= htmlspecialchars($valor_tags) ?>">
                        <small class="ajuda">Separe as tags por vírgula.</small>
                    </div>
                </div>
                <div class="linha">
                    <div class="campo">
                        <label for="autor-artigo">Autor</label>
                        <input id="autor-artigo" name="autor" type="text" list="lista-autores" placeholder="Ex.: Victor" value="<?= htmlspecialchars($valor_autor) ?>" required>
                        <datalist id="lista-autores">
                            <?php foreach ($autores_existentes as $autor_existente): ?>
                            <option value="<?= htmlspecialchars($autor_existente) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="campo">
                        <label for="tempo-leitura-artigo">Tempo de leitura</label>
                        <input id="tempo-leitura-artigo" name="tempo_leitura" type="text" placeholder="Ex.: 5 min" value="<?= htmlspecialchars($valor_tempo_leitura) ?>">
                        <small class="ajuda">Deixe em branco para calcular pelo número de palavras.</small>
                    </div>
                </div>
                <div class="campo">
                    <label for="data-artigo">Data de publicação</label>
                    <input id="data-artigo" name="data" type="text" placeholder="Ex.: 17 maio 2025" value="<?= htmlspecialchars($valor_data) ?>">
                </div>
                <div class="campo">
                    <label for="capa-artigo">Imagem de capa</label>
                    <label class="upload-capa" for="capa-artigo">
                        <span><i class="fa-solid fa-cloud-arrow-up"></i><?= $valor_imagem ? 'Clique para trocar a capa' : 'Clique para adicionar uma capa' ?></span>
                        <input id="capa-artigo" name="capa" type="file" accept="image/png,image/jpeg,image/webp">
                    </label>
                    <?php if ($valor_imagem): ?>
                        <small class="ajuda">Capa atual: <?= htmlspecialchars($valor_imagem) ?> (envie um novo arquivo para substituí-la).</small>
                    <?php endif; ?>
                </div>
                <div class="acoes">
                    <a class="botao botao-secundario" href="../comuns/visualizar-artigos.php">Cancelar</a>
                    <button class="botao botao-rascunho" type="button" onclick="salvarArtigo(event, 'rascunho')"><i class="fa-regular fa-floppy-disk"></i> Salvar rascunho</button>
                    <button class="botao botao-publicar" type="submit"><i class="fa-solid fa-paper-plane"></i> <?= $modo_formulario === 'editar' ? 'Salvar alterações' : 'Publicar artigo' ?></button>
                </div>
            </div>
        </section>

        <aside class="cartao preview" aria-label="Pré-visualização do artigo">
            <div class="cartao-cabecalho">Pré-visualização</div>
            <div class="preview-conteudo">
                <div id="preview-capa" class="preview-capa"><?= $valor_imagem ? '<img src="../imagens/' . htmlspecialchars($valor_imagem) . '" alt="">' : '<i class="fa-regular fa-image"></i>' ?></div>

                <div class="post-categoria">
                    <i class="fa-solid fa-square"></i> <span id="preview-categoria">Selecione uma categoria</span>
                </div>

                <div class="post-meta">
                    <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> <span id="preview-tempo">Tempo de leitura</span></span>
                    <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> <span id="preview-data">Data</span></span>
                    <span><i class="fa-solid fa-circle" style="font-size: 6px;"></i> <span id="preview-autor">Autor</span></span>
                </div>

                <h1 id="preview-titulo" class="post-titulo">Título do artigo</h1>

                <div id="preview-texto" class="post-texto"><p>O texto do artigo aparecerá aqui.</p></div>

                <div id="preview-tags" class="tags-artigo"></div>
            </div>
        </aside>
    </form>
</main>
<script src="../js/paginas/adm-editar-artigo.js"></script>
</body>
</html>