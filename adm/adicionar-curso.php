<?php
$modo_formulario = 'adicionar';
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

$chave_curso = $modo_formulario === 'editar' ? ($_GET['curso'] ?? '') : '';

$curso_atual = null;
foreach ($cursos as $item) {
    if ($item['slug'] === $chave_curso) {
        $curso_atual = $item;
        break;
    }
}

$valor_titulo_curso     = $curso_atual['titulo'] ?? '';
$valor_imagem_curso     = $curso_atual['imagem'] ?? '';
$valor_slug_curso       = $curso_atual['slug'] ?? '';
$valor_id_curso         = $curso_atual['id'] ?? '';
$valor_descricao_curso  = $curso_atual['descricao'] ?? '';

$modulo_atual_curso  = $modulos_aulas[$chave_curso] ?? null;
$itens_conteudo_curso = [];

if ($modulo_atual_curso) {
    $numero_item_conteudo = 0;

    foreach ($modulo_atual_curso['itens'] ?? [] as $indice_item => $item) {
        $tipo_original = $item['tipo'] ?? 'texto';

        if ($tipo_original === 'principal') {
            continue;
        }

        $numero_item_conteudo++;

        $itens_conteudo_curso[] = [
            'tipo_js' => $tipo_original === 'exercicio' ? 'exercicio' : 'aula',
            'numero'  => $numero_item_conteudo,
            'id'      => 'modulo-' . $indice_item,
            'titulo'  => trim(($item['titulo'] ?? '') . ' ' . ($item['subtitulo'] ?? '')),
            'detalhe' => $tipo_original === 'video'
                ? 'Vídeo' . (!empty($item['duracao']) ? ' · ' . $item['duracao'] : '')
                : ($tipo_original === 'exercicio'
                    ? count($item['questoes'] ?? []) . ' questão(ões)'
                    : 'Leitura' . (!empty($item['secoes']) ? ' · ' . count($item['secoes']) . ' seções' : '')),
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criar Curso</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/adm-curso.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>

    <?php
    include __DIR__ . '/../includes/topbar.php';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

<div class="page-wrap">

  <a href="#" class="voltar-link" onclick="window.history.back(); return false;">
    <i class="bi bi-arrow-left"></i> Voltar
  </a>

  <h1 class="titulo-pagina"><?= $modo_formulario === 'editar' ? 'Editar Curso' : 'Criar Curso' ?></h1>
  <p class="subtitulo-pagina"><?= $modo_formulario === 'editar' ? 'Atualize as informações do curso abaixo.' : 'Preencha as informações abaixo para cadastrar um novo curso.' ?></p>

  <div class="row g-5 align-items-start">
    <div class="col-lg-8">
      <form id="formCriarCurso" novalidate>

        <input type="hidden" id="idCurso" value="<?= htmlspecialchars((string) $valor_id_curso) ?>">
        <input type="hidden" id="slugCurso" value="<?= htmlspecialchars($valor_slug_curso) ?>">

        <div class="card-curso mb-5">
          <div class="row g-4">

            <div class="col-lg-5">
              <label class="label-campo"><i class="bi bi-image"></i> Imagem de Capa</label>

              <label class="upload-capa" for="inputImagem">
                <span id="capaPlaceholder" style="<?= $valor_imagem_curso ? 'display:none;' : '' ?>"><i class="bi bi-cloud-arrow-up d-block mb-2"></i>Clique para adicionar uma capa</span>
                <img id="previewCapa" src="<?= htmlspecialchars($valor_imagem_curso) ?>" style="<?= $valor_imagem_curso ? 'display:block;' : 'display:none;' ?>" alt="Pré-visualização da imagem de capa">
              </label>
              <input type="file" id="inputImagem" accept="image/*">
            </div>

            <div class="col-lg-7">
              <label class="label-campo" for="tituloCurso"><i class="bi bi-type-bold"></i> Título do Curso</label>
              <input type="text" id="tituloCurso" class="form-control form-control-custom mb-4"
                     placeholder="Ex.: História do Brasil: da Independência ao Império"
                     value="<?= htmlspecialchars($valor_titulo_curso) ?>">

              <label class="label-campo" for="descricaoCurso"><i class="bi bi-card-text"></i> Descrição do Curso</label>
              <textarea id="descricaoCurso" class="form-control form-control-custom" maxlength="2000"
                        placeholder="Descreva do que se trata o curso, o que o aluno vai aprender, pré-requisitos, etc."><?= htmlspecialchars($valor_descricao_curso) ?></textarea>
              <div class="contador-caracteres"><span id="contadorAtual"><?= mb_strlen($valor_descricao_curso) ?></span>/2000</div>
            </div>
          </div>

          <?php
            $curso_form        = $curso_atual ?? null;
            $categorias_cursos = array_values(array_unique(array_column($cursos, 'categoria')));
            $professores_curso = array_values(array_unique(array_column($cursos, 'professor')));
          ?>
          <div class="row g-4 mt-4">
            <div class="col-md-6">
              <label class="label-campo" for="categoriaCurso"><i class="bi bi-bookmark"></i> Categoria</label>
              <select id="categoriaCurso" name="categoria" class="form-select form-select-custom">
                <option value="" <?= empty($curso_form['categoria']) ? 'selected' : '' ?> disabled>Selecione a categoria</option>
                <?php foreach ($categorias_cursos as $categoria_opcao): ?>
                <option value="<?= htmlspecialchars($categoria_opcao) ?>" <?= ($curso_form['categoria'] ?? '') === $categoria_opcao ? 'selected' : '' ?>><?= htmlspecialchars($categoria_opcao) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="label-campo" for="nivelCurso"><i class="bi bi-bar-chart"></i> Nível</label>
              <select id="nivelCurso" name="nivel" class="form-select form-select-custom">
                <?php foreach ($niveis_curso as $chave_nivel => $rotulo_nivel): ?>
                <option value="<?= $chave_nivel ?>" <?= ($curso_form['nivel'] ?? 'basico') === $chave_nivel ? 'selected' : '' ?>><?= htmlspecialchars($rotulo_nivel) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label class="label-campo" for="cargaHorariaCurso"><i class="bi bi-clock-history"></i> Carga horária</label>
              <input type="text" id="cargaHorariaCurso" name="carga_horaria" class="form-control form-control-custom" placeholder="Ex.: 12 h" value="<?= htmlspecialchars($curso_form['carga_horaria'] ?? '') ?>">
            </div>
            <div class="col-md-4">
              <label class="label-campo" for="professorCurso"><i class="bi bi-person-video3"></i> Professor</label>
              <input type="text" id="professorCurso" name="professor" list="listaProfessores" class="form-control form-control-custom" placeholder="Ex.: Victor Almeida" value="<?= htmlspecialchars($curso_form['professor'] ?? '') ?>">
              <datalist id="listaProfessores">
                <?php foreach ($professores_curso as $professor_opcao): ?>
                <option value="<?= htmlspecialchars($professor_opcao) ?>"></option>
                <?php endforeach; ?>
              </datalist>
            </div>
            <div class="col-md-4">
              <label class="label-campo" for="statusCurso"><i class="bi bi-toggle-on"></i> Status</label>
              <select id="statusCurso" name="status" class="form-select form-select-custom">
                <option value="publicado" <?= ($curso_form['status'] ?? '') === 'publicado' ? 'selected' : '' ?>>Publicado</option>
                <option value="rascunho" <?= ($curso_form['status'] ?? 'rascunho') === 'rascunho' ? 'selected' : '' ?>>Rascunho</option>
              </select>
            </div>
            <div class="col-12">
              <label class="label-campo" for="tagsCurso"><i class="bi bi-tags"></i> Tags</label>
              <input type="text" id="tagsCurso" name="tags" class="form-control form-control-custom" placeholder="Ex.: Getúlio Vargas, Estado Novo, CLT" value="<?= htmlspecialchars(implode(', ', $curso_form['tags'] ?? [])) ?>">
              <small class="text-muted">Separe as tags por vírgula. Elas também são sugeridas nas aulas do curso.</small>
            </div>
            <div class="col-12">
              <label class="label-campo" for="descricaoModulo"><i class="bi bi-journal-text"></i> O que o aluno aprenderá neste módulo</label>
              <textarea id="descricaoModulo" name="descricao_modulo" class="form-control form-control-custom" rows="4" placeholder="Texto exibido em &quot;Detalhes&quot; na página do curso."><?= htmlspecialchars($modulos_aulas[$curso_form['slug'] ?? '']['descricao'] ?? '') ?></textarea>
            </div>
          </div>
        </div>

        <div class="card-curso mb-5">
          <h2 class="titulo-secundario">Conteúdo do curso</h2>
          <button type="button" class="btn-adicionar-aula" id="btnAdicionarAula">
            <span class="icone-mais"><i class="bi bi-plus"></i></span>
            Adicionar Aula ou Exercício
          </button>

          <div id="listaAulas" class="mt-4">
            <?php foreach ($itens_conteudo_curso as $item_conteudo): ?>
              <div class="item-conteudo"
                   data-tipo="<?= $item_conteudo['tipo_js'] ?>"
                   data-numero="<?= $item_conteudo['numero'] ?>"
                   data-id="<?= htmlspecialchars($item_conteudo['id']) ?>"
                   data-titulo="<?= htmlspecialchars($item_conteudo['titulo']) ?>">
                <div class="item-info">
                  <span class="item-icone"><i class="bi"></i></span>
                  <span class="item-nome"><?= htmlspecialchars($item_conteudo['titulo']) ?></span>
                  <small class="text-muted ms-2"><?= htmlspecialchars($item_conteudo['detalhe']) ?></small>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                  <select class="seletor-tipo-item">
                    <option value="aula" <?= $item_conteudo['tipo_js'] === 'aula' ? 'selected' : '' ?>>Aula</option>
                    <option value="exercicio" <?= $item_conteudo['tipo_js'] === 'exercicio' ? 'selected' : '' ?>>Exercício</option>
                  </select>
                  <div class="item-acoes">
                    <button type="button" class="btn-editar-item">
                      <i class="bi bi-pencil"></i> Editar
                    </button>
                    <button type="button" class="btn-remover-item" title="Remover">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="footer-acoes">
          <button type="button" class="btn btn-cancelar" onclick="window.history.back();">Cancelar</button>
          <button type="submit" class="btn btn-salvar">Salvar Curso</button>
        </div>

      </form>
    </div>

    <div class="col-lg-4">
      <div class="preview-curso-wrap">
        <label class="label-campo"><i class="bi bi-eye"></i> Pré-visualização</label>

        <div class="preview-curso-card">
          <div class="preview-curso-imagem" id="previewCursoImagem">
            <?= $valor_imagem_curso ? '<img src="' . htmlspecialchars($valor_imagem_curso) . '" alt="" style="width:100%;height:100%;object-fit:cover;">' : '<i class="bi bi-image"></i>' ?>
          </div>
          <div class="preview-curso-corpo">
            <h3 id="previewCursoTitulo"><?= $valor_titulo_curso !== '' ? htmlspecialchars($valor_titulo_curso) : 'Título do curso' ?></h3>
            <p class="preview-curso-descricao" id="previewCursoDescricao"><?= $valor_descricao_curso !== '' ? htmlspecialchars($valor_descricao_curso) : 'A descrição do curso vai aparecer aqui.' ?></p>
            <p class="preview-curso-progresso">0% concluída</p>
          </div>
        </div>

        <p class="preview-curso-nota">É assim que o card do curso vai aparecer para os alunos na Alexandria.</p>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
  const descricao = document.getElementById('descricaoCurso');
  const contador = document.getElementById('contadorAtual');
  descricao.addEventListener('input', () => {
    contador.textContent = descricao.value.length;
  });

  const tituloCurso = document.getElementById('tituloCurso');
  const previewCursoTitulo = document.getElementById('previewCursoTitulo');
  const previewCursoDescricao = document.getElementById('previewCursoDescricao');
  const previewCursoImagem = document.getElementById('previewCursoImagem');

  tituloCurso.addEventListener('input', () => {
    previewCursoTitulo.textContent = tituloCurso.value.trim() || 'Título do curso';
  });

  descricao.addEventListener('input', () => {
    previewCursoDescricao.textContent = descricao.value.trim() || 'A descrição do curso vai aparecer aqui.';
  });

  const inputImagem = document.getElementById('inputImagem');
  const previewCapa = document.getElementById('previewCapa');
  const capaPlaceholder = document.getElementById('capaPlaceholder');
  inputImagem.addEventListener('change', (e) => {
    const arquivo = e.target.files[0];
    if (arquivo) {
      const url = URL.createObjectURL(arquivo);
      previewCapa.src = url;
      previewCapa.style.display = 'block';
      capaPlaceholder.style.display = 'none';

      previewCursoImagem.innerHTML = `<img src="${url}" alt="Capa do curso">`;
    }
  });

  const ICONES_TIPO = {
    aula: 'bi-journal-text',
    exercicio: 'bi-pencil-square'
  };

  const DESTINO_EDICAO = {
    aula: 'editar-aula.php',
    exercicio: 'editar-exercicio.php'
  };

  let contadorItens = 0;
  const listaAulas = document.getElementById('listaAulas');

  function atualizarVisualItem(item){
    const tipo = item.dataset.tipo;
    const numero = item.dataset.numero;
    const icone = item.querySelector('.item-icone i');
    const nome = item.querySelector('.item-nome');

    icone.className = 'bi ' + ICONES_TIPO[tipo];

    nome.textContent = (item.dataset.titulo && item.dataset.titulo.trim() !== '')
      ? item.dataset.titulo
      : (tipo === 'aula' ? 'Aula' : 'Exercício') + ' ' + numero;
  }

  function inicializarItemConteudo(item){
    item.querySelector('.seletor-tipo-item').value = item.dataset.tipo;
    atualizarVisualItem(item);

    item.querySelector('.seletor-tipo-item').addEventListener('change', (e) => {
      item.dataset.tipo = e.target.value;
      atualizarVisualItem(item);
    });

    item.querySelector('.btn-editar-item').addEventListener('click', () => {
      const tipo = item.dataset.tipo;
      const id = item.dataset.id;
      window.location.href = `${DESTINO_EDICAO[tipo]}?id=${encodeURIComponent(id)}&curso=<?= urlencode($chave_curso) ?>`;
    });

    item.querySelector('.btn-remover-item').addEventListener('click', () => {
      item.remove();
    });
  }

  function criarItemConteudo(tipoInicial = 'aula'){
    contadorItens++;

    const item = document.createElement('div');
    item.className = 'item-conteudo';
    item.dataset.tipo = tipoInicial;
    item.dataset.numero = contadorItens;
    item.dataset.id = 'item-' + contadorItens;

    item.innerHTML = `
      <div class="item-info">
        <span class="item-icone"><i class="bi"></i></span>
        <span class="item-nome"></span>
      </div>
      <div class="d-flex align-items-center gap-2 flex-wrap">
        <select class="seletor-tipo-item">
          <option value="aula">Aula</option>
          <option value="exercicio">Exercício</option>
        </select>
        <div class="item-acoes">
          <button type="button" class="btn-editar-item">
            <i class="bi bi-pencil"></i> Editar
          </button>
          <button type="button" class="btn-remover-item" title="Remover">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
    `;

    inicializarItemConteudo(item);

    return item;
  }

  document.getElementById('btnAdicionarAula').addEventListener('click', () => {
    const item = criarItemConteudo('aula');
    listaAulas.appendChild(item);
  });

  document.querySelectorAll('#listaAulas .item-conteudo').forEach((item) => {
    inicializarItemConteudo(item);

    const numeroItem = parseInt(item.dataset.numero, 10);
    if (!isNaN(numeroItem) && numeroItem > contadorItens) {
      contadorItens = numeroItem;
    }
  });

  document.getElementById('formCriarCurso').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Curso salvo com sucesso! (ação de exemplo — conecte ao seu backend)');
  });
</script>

</body>
</html>