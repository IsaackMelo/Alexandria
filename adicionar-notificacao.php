<?php
/**
 * adicionar-notificacao.php
 * Formulário de cadastro de uma nova notificação.
 */

// Categorias disponíveis, cada uma com um ícone e uma cor sugeridos por padrão.
$categorias = [
    'modulo'      => ['label' => 'Módulo',      'icone' => 'bi-journal-bookmark', 'bg' => '#F6DCE1', 'fg' => '#9C3B52'],
    'simulado'    => ['label' => 'Simulado',    'icone' => 'bi-clipboard-check',  'bg' => '#F4E7B8', 'fg' => '#8A6D1B'],
    'atualizacao' => ['label' => 'Atualização', 'icone' => 'bi-bank',              'bg' => '#F1C3BC', 'fg' => '#A23F31'],
    'conquista'   => ['label' => 'Conquista',   'icone' => 'bi-trophy',            'bg' => '#CBE8D3', 'fg' => '#2F7A45'],
    'chat'        => ['label' => 'Chat AI',     'icone' => 'bi-chat-dots',         'bg' => '#DCD6F0', 'fg' => '#584C9C'],
    'outro'       => ['label' => 'Outro',       'icone' => 'bi-bell',              'bg' => '#EFE9DC', 'fg' => '#6B5A2C'],
];

// Opções de ícone que o admin pode escolher manualmente, além da sugestão da categoria.
$icones_disponiveis = [
    'bi-journal-bookmark', 'bi-clipboard-check', 'bi-bank', 'bi-trophy', 'bi-chat-dots',
    'bi-bell', 'bi-star', 'bi-megaphone', 'bi-mortarboard', 'bi-award', 'bi-lightbulb', 'bi-calendar-event',
];

// Paleta de cores (fundo do chip + cor do ícone) que o admin pode escolher manualmente.
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
<title>Nova notificação</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@500;600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="estilo/adicionar-notificacao.css">

</head>


<body>

    <?php
        include("../alexandria-frontend/includes/barraadm.html");
        include("../alexandria-frontend/includes/sidebaradm.html");
    ?>

<div class="page">

  <div class="page-head">
    <div>
      <h1>Nova notificação</h1>
      <p>Preencha os campos abaixo para publicar uma notificação para os alunos.</p>
    </div>
    <a href="visualizar-notificacao.php" class="btn-voltar">
      <i class="bi bi-arrow-left"></i> Voltar
    </a>
  </div>

  <hr class="divider">

  <form class="card" id="formNotificacao" method="post" action="salvar-notificacao.php">

    <p class="section-title">Identidade visual</p>

    <div class="picker-row">
      <div class="picker-col">
        <label class="field-label">Categoria</label>
        <select name="categoria" id="campoCategoria">
          <?php foreach ($categorias as $chave => $c): ?>
          <option value="<?= $chave ?>"><?= htmlspecialchars($c['label']) ?></option>
          <?php endforeach; ?>
        </select>
        <p class="field-hint">Define o texto de agrupamento. Ícone e cor abaixo já vêm sugeridos, mas podem ser trocados.</p>
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
        <input type="text" name="titulo" id="campoTitulo" placeholder="Ex: Novo módulo liberado: Brasil Império" required>
      </div>
    </div>

    <div class="field-row">
      <div class="field full">
        <label class="field-label" for="campoDescricao">Descrição curta</label>
        <textarea name="descricao" id="campoDescricao" placeholder="Resumo de uma ou duas linhas — é o que aparece na listagem de notificações." required></textarea>
      </div>
    </div>

    <div class="field-row">
      <div class="field">
        <label class="field-label" for="campoTempo">Tempo de leitura</label>
        <div class="input-suffix">
          <input type="number" name="tempo_leitura" id="campoTempo" min="1" value="2" required>
          <span>minutos</span>
        </div>
      </div>
    </div>

    <div class="field-row">
      <div class="field full">
        <label class="field-label">Texto completo</label>

        <!-- ===================== CAMPO DE TEXTO RICO (componente) ===================== -->
        <style>
          .rte-box{
            --rte-bg: #faf8f3;
            --rte-border: #e7e2d6;
            --rte-border-focus: #d8cfb8;
            --rte-ink: #2f2e2b;
            --rte-muted: #8b8676;
            --rte-icon: #4a4843;
            --rte-hover: #efe9dc;
            --rte-active-bg: #e7dfca;
            --rte-active-ink: #6b5a2c;
            --rte-divider: #e2dccc;

            font-family: 'Source Sans 3', Arial, sans-serif;
            background: var(--rte-bg);
            border: 1px solid var(--rte-border);
            border-radius: 14px;
            position: relative;
            box-sizing: border-box;
          }
          .rte-box *{ box-sizing:border-box; }
          .rte-box.focused{ border-color: var(--rte-border-focus); }

          .rte-toolbar{
            display:flex;
            align-items:center;
            gap:.15rem;
            padding:.65rem .85rem;
            border-bottom:1px solid var(--rte-divider);
            flex-wrap:wrap;
          }
          .rte-divider{
            width:1px;
            height:20px;
            background:var(--rte-divider);
            margin:0 .5rem;
            flex-shrink:0;
          }
          .rte-btn{
            border:none;
            background:transparent;
            color:var(--rte-icon);
            width:30px;
            height:30px;
            border-radius:7px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:.95rem;
            cursor:pointer;
            transition:background .12s ease, color .12s ease;
          }
          .rte-btn:hover{ background:var(--rte-hover); }
          .rte-btn.active{ background:var(--rte-active-bg); color:var(--rte-active-ink); }
          .rte-btn i.bi-type-underline{ text-decoration:underline; }

          .rte-content{
            min-height:150px;
            max-height:420px;
            overflow-y:auto;
            padding:1rem 1.1rem 1.25rem;
            font-size:.98rem;
            line-height:1.6;
            outline:none;
            color: var(--rte-ink);
          }
          .rte-content:empty::before{
            content: attr(data-placeholder);
            color: var(--rte-muted);
            pointer-events:none;
          }
          .rte-content ul, .rte-content ol{ padding-left:1.4rem; margin:.4rem 0; }
          .rte-content a{ color:#3457d5; }
          .rte-content img{ max-width:100%; border-radius:6px; margin:.4rem 0; }
          .rte-content table{ border-collapse:collapse; width:100%; margin:.5rem 0; }
          .rte-content table td{ border:1px solid var(--rte-border); padding:.35rem .55rem; }

          .rte-more-wrap{ position:relative; margin-left:auto; }
          .rte-more-panel{
            display:none;
            position:absolute;
            top:calc(100% + 8px);
            right:0;
            background:#fff;
            border:1px solid var(--rte-border);
            border-radius:12px;
            box-shadow:0 8px 24px rgba(0,0,0,.08);
            padding:.6rem;
            width:300px;
            z-index:20;
          }
          .rte-more-panel.show{ display:block; }
          .rte-more-row{
            display:flex;
            align-items:center;
            gap:.35rem;
            flex-wrap:wrap;
            margin-bottom:.5rem;
          }
          .rte-more-row:last-child{ margin-bottom:0; }
          .rte-select{
            height:30px;
            border-radius:7px;
            border:1px solid var(--rte-border);
            background:#fff;
            font-size:.8rem;
            padding:0 .35rem;
            color:var(--rte-ink);
          }
          .rte-color{
            width:30px; height:30px;
            padding:2px;
            border-radius:7px;
            border:1px solid var(--rte-border);
            background:#fff;
            cursor:pointer;
          }
          .rte-footer{
            display:flex;
            justify-content:flex-end;
            align-items:center;
            padding:.4rem .9rem .6rem;
            font-size:.72rem;
            color:var(--rte-muted);
          }
        </style>

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

          <div class="rte-content" contenteditable="true"></div>

          <div class="rte-footer">
            <span class="rte-wordcount">0 palavras</span>
          </div>
        </div>

        <script>
        (function(){
          // Evita reprocessar caixas já inicializadas — importante quando este componente
          // aparece mais de uma vez na mesma página.
          function initBox(box){
            if(box.dataset.rteInit === '1') return;
            box.dataset.rteInit = '1';

            const content = box.querySelector('.rte-content');
            content.setAttribute('data-placeholder', box.getAttribute('data-placeholder') || '');

            const morePanel = box.querySelector('.rte-more-panel');
            const moreToggle = box.querySelector('[data-action="more"]');
            const wordcountEl = box.querySelector('.rte-wordcount');

            let savedRange = null;
            let history = [content.innerHTML];
            let historyIndex = 0;
            let typingTimer = null;

            function saveSelection(){
              const sel = window.getSelection();
              if(sel.rangeCount > 0 && content.contains(sel.anchorNode)) savedRange = sel.getRangeAt(0);
            }
            function restoreSelection(){
              const sel = window.getSelection();
              sel.removeAllRanges();
              if(savedRange) sel.addRange(savedRange);
            }
            function pushHistory(){
              if(content.innerHTML === history[historyIndex]) return;
              history = history.slice(0, historyIndex + 1);
              history.push(content.innerHTML);
              historyIndex = history.length - 1;
            }
            function undo(){
              if(historyIndex > 0){ historyIndex--; content.innerHTML = history[historyIndex]; updateWordcount(); }
            }
            function redo(){
              if(historyIndex < history.length - 1){ historyIndex++; content.innerHTML = history[historyIndex]; updateWordcount(); }
            }
            function updateWordcount(){
              const text = content.innerText.trim();
              const words = text.length ? text.split(/\s+/).length : 0;
              wordcountEl.textContent = words + (words === 1 ? ' palavra' : ' palavras');
            }
            function updateActiveStates(){
              box.querySelectorAll('[data-cmd]').forEach(btn=>{
                try{ btn.classList.toggle('active', document.queryCommandState(btn.dataset.cmd)); }catch(e){}
              });
            }
            function exec(cmd, value=null){
              content.focus();
              restoreSelection();
              document.execCommand(cmd, false, value);
              pushHistory();
              updateActiveStates();
              updateWordcount();
            }

            content.addEventListener('focus', ()=> box.classList.add('focused'));
            content.addEventListener('blur', ()=> box.classList.remove('focused'));
            content.addEventListener('mouseup', saveSelection);
            content.addEventListener('keyup', ()=>{ saveSelection(); updateActiveStates(); });
            content.addEventListener('input', ()=>{
              updateWordcount();
              clearTimeout(typingTimer);
              typingTimer = setTimeout(pushHistory, 500);
            });

            box.querySelectorAll('[data-cmd]').forEach(btn=>{
              btn.addEventListener('click', ()=> exec(btn.dataset.cmd));
            });

            box.querySelector('[data-action="clear"]').addEventListener('click', ()=>{
              content.focus();
              restoreSelection();
              document.execCommand('removeFormat');
              pushHistory();
            });

            box.querySelector('[data-action="undo"]').addEventListener('click', undo);
            box.querySelector('[data-action="redo"]').addEventListener('click', redo);

            box.querySelector('[data-action="link"]').addEventListener('click', ()=>{
              saveSelection();
              const url = prompt('Cole o link:');
              if(!url) return;
              const safeUrl = /^https?:\/\//i.test(url) ? url : 'https://' + url;
              exec('createLink', safeUrl);
            });

            box.querySelector('[data-action="image"]').addEventListener('click', ()=>{
              const input = document.createElement('input');
              input.type = 'file';
              input.accept = 'image/*';
              input.onchange = e=>{
                const file = e.target.files[0];
                if(!file) return;
                const reader = new FileReader();
                reader.onload = ev=> exec('insertImage', ev.target.result);
                reader.readAsDataURL(file);
              };
              input.click();
            });

            box.querySelector('.rte-font-family').addEventListener('change', function(){ exec('fontName', this.value); });
            box.querySelector('.rte-font-size').addEventListener('change', function(){ exec('fontSize', this.value); });
            box.querySelector('.rte-text-color').addEventListener('input', function(){ exec('foreColor', this.value); });
            box.querySelector('.rte-highlight-color').addEventListener('input', function(){ exec('hiliteColor', this.value); });

            moreToggle.addEventListener('click', (e)=>{
              e.stopPropagation();
              morePanel.classList.toggle('show');
            });
            document.addEventListener('click', (e)=>{
              if(!box.contains(e.target)) morePanel.classList.remove('show');
            });
          }

          // Inicializa somente as caixas ainda não inicializadas nesta página.
          document.querySelectorAll('.rte-box:not([data-rte-init])').forEach(initBox);
        })();
        </script>
        <!-- ===================== FIM DO COMPONENTE ===================== -->

        <input type="hidden" name="texto_html" id="campoTextoCompleto">
      </div>
    </div>

    <div class="form-footer">
      <a href="visualizar-notificacao.php" class="btn-text btn-cancel">Cancelar</a>
      <button type="submit" class="btn-text btn-publicar">Publicar notificação</button>
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

  // Ao trocar a categoria, sugere o ícone e a cor padrão dela.
  campoCategoria.addEventListener('change', function(){
    const cfg = categorias[this.value];
    if (!cfg) return;
    selecionarIcone(cfg.icone);
    selecionarCor(cfg.bg, cfg.fg);
  });

  // Estado inicial (categoria "Módulo").
  selecionarIcone('bi-journal-bookmark');
  selecionarCor('#F6DCE1', '#9C3B52');

  // Antes de enviar, copia o HTML digitado no editor de texto rico para o campo oculto.
  document.getElementById('formNotificacao').addEventListener('submit', function(){
    const rte = document.querySelector('.rte-content');
    if (rte) document.getElementById('campoTextoCompleto').value = rte.innerHTML;
  });
</script>

</body>
</html>