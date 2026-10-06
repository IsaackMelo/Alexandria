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
$modo_formulario = 'adicionar';

require_once __DIR__ . '/../includes/dados.php';

$id_notificacao    = null;
$notificacao_atual = null;
if ($modo_formulario === 'editar') {
    $id_notificacao = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    foreach ($notificacoes as $item) {
        if ($item['id'] === $id_notificacao) {
            $notificacao_atual = $item;
            break;
        }
    }
}

$valor_titulo_notif     = $notificacao_atual['titulo'] ?? '';
$valor_descricao_notif  = $notificacao_atual['descricao'] ?? '';
$valor_categoria_notif  = $notificacao_atual['tipo'] ?? 'modulo';
$valor_status_notif     = $notificacao_atual['status'] ?? 'nao_lida';
$valor_autor_notif      = $notificacao_atual['autor'] ?? '';
$valor_rotulo_categoria = $notificacao_atual['categoria'] ?? '';
$valor_tempo_notif      = (int) ($notificacao_atual['tempo_leitura'] ?? 2) ?: 2;
$valor_atualizado_notif = $notificacao_atual['atualizado_em'] ?? date('Y-m-d');
$valor_acao_rotulo      = $notificacao_atual['acao']['rotulo'] ?? '';
$valor_acao_link        = $notificacao_atual['acao']['link'] ?? '';
$valor_banner_imagem    = $notificacao_atual['banner_imagem'] ?? '';

$html_secoes_notif = '';
foreach ($notificacao_atual['secoes'] ?? [] as $secao) {
    if (!empty($secao['titulo'])) {
        $html_secoes_notif .= '<h3>' . htmlspecialchars($secao['titulo']) . '</h3>';
    }
    foreach ($secao['paragrafos'] ?? [] as $paragrafo) {
        $html_secoes_notif .= '<p>' . htmlspecialchars($paragrafo) . '</p>';
    }
}

$rotulos_status_notif = ['urgente' => 'Urgente (destaque)', 'nao_lida' => 'Não lida', 'lida' => 'Lida'];
$autores_notif        = array_values(array_unique(array_filter(array_column($notificacoes, 'autor'))));

$destinos_acao = [
    'visualizar-curso.php'        => 'Cursos disponíveis',
    'visualizar-artigos.php'      => 'Artigos',
    'visualizar-acervo.php'       => 'Acervos',
    'visualizar-questoes.php'     => 'Banco de questões',
    'chatai.php'                  => 'Chat AI',
];
foreach ($acervos as $acervo_destino) {
    $destinos_acao['visualizar-prova.php?banca=' . $acervo_destino['slug']] = 'Provas ' . $acervo_destino['nome'];
}

$categorias = [
    'modulo'      => ['label' => 'Módulo',      'icone' => 'bi-journal-bookmark', 'bg' => '#F6DCE1', 'fg' => '#9C3B52'],
    'simulado'    => ['label' => 'Simulado',    'icone' => 'bi-clipboard-check',  'bg' => '#F4E7B8', 'fg' => '#8A6D1B'],
    'atualizacao' => ['label' => 'Atualização', 'icone' => 'bi-bank',              'bg' => '#F1C3BC', 'fg' => '#A23F31'],
    'conquista'   => ['label' => 'Conquista',   'icone' => 'bi-trophy',            'bg' => '#CBE8D3', 'fg' => '#2F7A45'],
    'chat'        => ['label' => 'Chat AI',     'icone' => 'bi-chat-dots',         'bg' => '#DCD6F0', 'fg' => '#584C9C'],
    'outro'       => ['label' => 'Outro',       'icone' => 'bi-bell',              'bg' => '#EFE9DC', 'fg' => '#6B5A2C'],
];

$icones_disponiveis = [
    'bi-journal-bookmark', 'bi-clipboard-check', 'bi-bank', 'bi-trophy', 'bi-chat-dots',
    'bi-bell', 'bi-star', 'bi-megaphone', 'bi-mortarboard', 'bi-award', 'bi-lightbulb', 'bi-calendar-event',
];

$cores_disponiveis = [
    ['bg' => '#F6DCE1', 'fg' => '#9C3B52'],
    ['bg' => '#F4E7B8', 'fg' => '#8A6D1B'],
    ['bg' => '#F1C3BC', 'fg' => '#A23F31'],
    ['bg' => '#CBE8D3', 'fg' => '#2F7A45'],
    ['bg' => '#DCD6F0', 'fg' => '#584C9C'],
    ['bg' => '#D7E6F5', 'fg' => '#2C5C8A'],
    ['bg' => '#EFE9DC', 'fg' => '#6B5A2C'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $modo_formulario === 'editar' ? 'Editar notificação' : 'Nova notificação' ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@500;600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/adm-notificacao.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

<?php
  include __DIR__ . '/../includes/sidebar.php';
?>
<div class="area-formulario">
<?php include __DIR__ . '/../includes/topbar.php'; ?>

<div class="page">

  <div class="page-head">
    <div>
      <h1><?= $modo_formulario === 'editar' ? 'Editar notificação' : 'Nova notificação' ?></h1>
      <p><?= $modo_formulario === 'editar' ? 'Atualize os campos abaixo e salve para republicar a notificação.' : 'Preencha os campos abaixo para publicar uma notificação para os alunos.' ?></p>
      <?php if ($modo_formulario === 'editar' && $notificacao_atual === null): ?>
      <p style="color:#B3273E; font-weight:600;">Notificação não encontrada. Verifique o parâmetro "id" da URL.</p>
      <?php endif; ?>
    </div>
    <a href="../comuns/visualizar-notificacoes.php" class="btn-voltar">
      <i class="bi bi-arrow-left"></i> Voltar
    </a>
  </div>

  <hr class="divider">

  <form class="card" id="formNotificacao" method="post" action="#">

    <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id_notificacao) ?>">

    <p class="section-title">Identidade visual</p>

    <div class="picker-row">
      <div class="picker-col">
        <label class="field-label">Tipo</label>
        <select name="tipo" id="campoCategoria">
          <?php foreach ($categorias as $chave => $c): ?>
          <option value="<?= $chave ?>" <?= $chave === $valor_categoria_notif ? 'selected' : '' ?>><?= htmlspecialchars($c['label']) ?></option>
          <?php endforeach; ?>
        </select>
        <p class="field-hint">Define o ícone, a cor e o banner da notificação. Ícone e cor abaixo já vêm sugeridos, mas podem ser trocados.</p>
      </div>
      <div class="preview-wrap">
        <div class="preview-chip" id="previewChip"><i class="bi bi-journal-bookmark" id="previewIcone"></i></div>
        <span class="preview-label">Pré-visualização</span>
      </div>
    </div>

    <div class="picker-row">
      <div class="picker-col">
        <label class="field-label">Ícone</label>
        <div class="icon-grid" id="gradeIcones">
          <?php foreach ($icones_disponiveis as $icn): ?>
          <button type="button" class="icon-option" data-icone="<?= $icn ?>" title="<?= $icn ?>">
            <i class="bi <?= $icn ?>"></i>
          </button>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="picker-col">
        <label class="field-label">Cor</label>
        <div class="color-grid" id="gradeCores">
          <?php foreach ($cores_disponiveis as $cor): ?>
          <button type="button" class="color-option" data-bg="<?= $cor['bg'] ?>" data-fg="<?= $cor['fg'] ?>" style="background:<?= $cor['bg'] ?>;"></button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <input type="hidden" name="icone" id="campoIcone" value="bi-journal-bookmark">
    <input type="hidden" name="cor_fundo" id="campoCorFundo" value="#F6DCE1">
    <input type="hidden" name="cor_texto" id="campoCorTexto" value="#9C3B52">

    <p class="section-title">Conteúdo</p>

    <div class="field-row">
      <div class="field full">
        <label class="field-label" for="campoTitulo">Título</label>
        <input type="text" name="titulo" id="campoTitulo" placeholder="Ex: Novo módulo liberado: Brasil Império" value="<?= htmlspecialchars($valor_titulo_notif) ?>" required>
      </div>
    </div>

    <div class="field-row">
      <div class="field full">
        <label class="field-label" for="campoDescricao">Descrição curta</label>
        <textarea name="descricao" id="campoDescricao" placeholder="Resumo de uma ou duas linhas — é o que aparece na listagem de notificações." required><?= htmlspecialchars($valor_descricao_notif) ?></textarea>
      </div>
    </div>

    <div class="field-row">
      <div class="field">
        <label class="field-label" for="campoStatus">Status</label>
        <select name="status" id="campoStatus">
          <?php foreach ($rotulos_status_notif as $chave_status => $rotulo_status): ?>
          <option value="<?= $chave_status ?>" <?= $chave_status === $valor_status_notif ? 'selected' : '' ?>><?= htmlspecialchars($rotulo_status) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field">
        <label class="field-label" for="campoCategoriaTexto">Categoria exibida</label>
        <input type="text" name="categoria" id="campoCategoriaTexto" placeholder="Ex: Novo conteúdo" value="<?= htmlspecialchars($valor_rotulo_categoria) ?>">
      </div>
    </div>
    <div class="field-row">
      <div class="field">
        <label class="field-label" for="campoAutor">Autor</label>
        <input type="text" name="autor" id="campoAutor" list="listaAutoresNotif" placeholder="Ex: Equipe Pedagógica Alexandria" value="<?= htmlspecialchars($valor_autor_notif) ?>">
        <datalist id="listaAutoresNotif">
          <?php foreach ($autores_notif as $autor_opcao): ?>
          <option value="<?= htmlspecialchars($autor_opcao) ?>"></option>
          <?php endforeach; ?>
        </datalist>
      </div>
      <div class="field">
        <label class="field-label" for="campoAtualizado">Última atualização</label>
        <input type="date" name="atualizado_em" id="campoAtualizado" value="<?= htmlspecialchars($valor_atualizado_notif) ?>">
      </div>
    </div>
    <div class="field-row">
      <div class="field">
        <label class="field-label" for="campoTempo">Tempo de leitura</label>
        <div class="input-suffix">
          <input type="number" name="tempo_leitura" id="campoTempo" min="1" value="<?= (int) $valor_tempo_notif ?>" required>
          <span>minutos</span>
        </div>
      </div>
      <div class="field">
        <label class="field-label" for="campoBanner">Imagem do banner (opcional)</label>
        <input type="text" name="banner_imagem" id="campoBanner" placeholder="../imagens/arquivo.png" value="<?= htmlspecialchars($valor_banner_imagem) ?>">
      </div>
    </div>

    <p class="section-title">Botão de ação do banner</p>
    <div class="field-row">
      <div class="field">
        <label class="field-label" for="campoAcaoRotulo">Texto do botão</label>
        <input type="text" name="acao_rotulo" id="campoAcaoRotulo" placeholder="Ex: Ver cursos" value="<?= htmlspecialchars($valor_acao_rotulo) ?>">
      </div>
      <div class="field">
        <label class="field-label" for="campoAcaoLink">Destino</label>
        <input type="text" name="acao_link" id="campoAcaoLink" list="listaDestinosAcao" placeholder="Ex: visualizar-curso.php" value="<?= htmlspecialchars($valor_acao_link) ?>">
        <datalist id="listaDestinosAcao">
          <?php foreach ($destinos_acao as $link_destino => $rotulo_destino): ?>
          <option value="<?= htmlspecialchars($link_destino) ?>"><?= htmlspecialchars($rotulo_destino) ?></option>
          <?php endforeach; ?>
        </datalist>
      </div>
    </div>

    <div class="field-row">
      <div class="field full">
        <label class="field-label">Texto completo (seções)</label>
        <p class="field-hint">Use títulos para separar as seções exibidas na página da notificação.</p>


        <div class="rte-box" data-placeholder="Conte sobre o que é o curso, seus objetivos e o que o aluno vai aprender…">
          <div class="rte-toolbar">
            <button class="rte-btn" data-cmd="bold" title="Negrito"><i class="bi bi-type-bold"></i></button>
            <button class="rte-btn" data-cmd="italic" title="Itálico"><i class="bi bi-type-italic"></i></button>
            <button class="rte-btn" data-cmd="underline" title="Sublinhado"><i class="bi bi-type-underline"></i></button>
            <div class="rte-divider"></div>
            <button class="rte-btn" data-action="link" title="Inserir link"><i class="bi bi-link-45deg"></i></button>
            <div class="rte-divider"></div>
            <button class="rte-btn" data-cmd="insertUnorderedList" title="Lista com marcadores"><i class="bi bi-list-ul"></i></button>
            <button class="rte-btn" data-cmd="insertOrderedList" title="Lista numerada"><i class="bi bi-list-ol"></i></button>
            <div class="rte-divider"></div>
            <button class="rte-btn" data-action="clear" title="Limpar formatação"><i class="bi bi-type"></i></button>

            <div class="rte-more-wrap">
              <button class="rte-btn" data-action="more" title="Mais opções"><i class="bi bi-three-dots"></i></button>
              <div class="rte-more-panel">
                <div class="rte-more-row">
                  <select class="rte-select rte-font-family" title="Fonte">
                    <option value="'Source Sans 3', sans-serif" selected>Sans</option>
                    <option value="Georgia, serif">Serif</option>
                    <option value="'Courier New', monospace">Monoespaçada</option>
                  </select>
                  <select class="rte-select rte-font-size" title="Tamanho">
                    <option value="2">Pequeno</option>
                    <option value="3" selected>Normal</option>
                    <option value="5">Grande</option>
                    <option value="6">Enorme</option>
                  </select>
                </div>
                <div class="rte-more-row">
                  <button class="rte-btn" data-cmd="justifyLeft" title="Alinhar à esquerda"><i class="bi bi-text-left"></i></button>
                  <button class="rte-btn" data-cmd="justifyCenter" title="Centralizar"><i class="bi bi-text-center"></i></button>
                  <button class="rte-btn" data-cmd="justifyRight" title="Alinhar à direita"><i class="bi bi-text-right"></i></button>
                  <div class="rte-divider"></div>
                  <button class="rte-btn" data-cmd="strikeThrough" title="Tachado"><i class="bi bi-type-strikethrough"></i></button>
                  <button class="rte-btn" data-action="image" title="Inserir imagem"><i class="bi bi-image"></i></button>
                </div>
                <div class="rte-more-row">
                  <input type="color" class="rte-color rte-text-color" value="#2f2e2b" title="Cor do texto">
                  <input type="color" class="rte-color rte-highlight-color" value="#fff3b0" title="Cor de destaque">
                  <div class="rte-divider"></div>
                  <button class="rte-btn" data-action="undo" title="Desfazer"><i class="bi bi-arrow-counterclockwise"></i></button>
                  <button class="rte-btn" data-action="redo" title="Refazer"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
              </div>
            </div>
          </div>

          <div class="rte-content" contenteditable="true"><?= $html_secoes_notif ?></div>

          <div class="rte-footer">
            <span class="rte-wordcount">0 palavras</span>
          </div>
        </div>

        <script src="../js/paginas/adm-adicionar-notificacao.js"></script>

        <input type="hidden" name="texto_html" id="campoTextoCompleto">
      </div>
    </div>

    <div class="form-footer">
      <a href="../comuns/visualizar-notificacoes.php" class="btn-text btn-cancel">Cancelar</a>
      <button type="submit" class="btn-text btn-publicar"><?= $modo_formulario === 'editar' ? 'Salvar alterações' : 'Publicar notificação' ?></button>
    </div>

  </form>

</div>

<script>
  const categorias = <?= json_encode($categorias, JSON_UNESCAPED_UNICODE) ?>;

  const campoCategoria = document.getElementById('campoCategoria');
  const campoIcone = document.getElementById('campoIcone');
  const campoCorFundo = document.getElementById('campoCorFundo');
  const campoCorTexto = document.getElementById('campoCorTexto');
  const previewChip = document.getElementById('previewChip');
  const previewIcone = document.getElementById('previewIcone');
  const gradeIcones = document.getElementById('gradeIcones');
  const gradeCores = document.getElementById('gradeCores');

  function atualizarPreview(){
    const bg = campoCorFundo.value;
    const fg = campoCorTexto.value;
    previewChip.style.background = bg;
    previewChip.style.color = fg;
    previewIcone.className = 'bi ' + campoIcone.value;
  }

  function selecionarIcone(nome){
    campoIcone.value = nome;
    gradeIcones.querySelectorAll('.icon-option').forEach(btn=>{
      btn.classList.toggle('selected', btn.dataset.icone === nome);
    });
    atualizarPreview();
  }

  function selecionarCor(bg, fg){
    campoCorFundo.value = bg;
    campoCorTexto.value = fg;
    gradeCores.querySelectorAll('.color-option').forEach(btn=>{
      btn.classList.toggle('selected', btn.dataset.bg === bg);
    });
    atualizarPreview();
  }

  gradeIcones.querySelectorAll('.icon-option').forEach(btn=>{
    btn.addEventListener('click', ()=> selecionarIcone(btn.dataset.icone));
  });
  gradeCores.querySelectorAll('.color-option').forEach(btn=>{
    btn.addEventListener('click', ()=> selecionarCor(btn.dataset.bg, btn.dataset.fg));
  });

  campoCategoria.addEventListener('change', function(){
    const cfg = categorias[this.value];
    if (!cfg) return;
    selecionarIcone(cfg.icone);
    selecionarCor(cfg.bg, cfg.fg);
  });

  <?php $cfg_inicial = $categorias[$valor_categoria_notif] ?? $categorias['modulo']; ?>
  selecionarIcone(<?= json_encode($cfg_inicial['icone']) ?>);
  selecionarCor(<?= json_encode($cfg_inicial['bg']) ?>, <?= json_encode($cfg_inicial['fg']) ?>);

  document.getElementById('formNotificacao').addEventListener('submit', function(){
    const rte = document.querySelector('.rte-content');
    if (rte) document.getElementById('campoTextoCompleto').value = rte.innerHTML;
  });
</script>

</div>
</body>
</html>