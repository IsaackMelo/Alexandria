<?php
$cursos = [
    'era-vargas'=>['Era Vargas (1930 - 1945)','getulio.png','História','Publicado','0'],

    'idade-moderna'=>['Idade Moderna e Renascimento','filosofia.png','História','Publicado','0'],

    'ditadura-militar'=>['Ditadura Militar no Brasil (1964-1985)','ditadura.png','História','Publicado','0'],

    'brasil-colonia'=>['Brasil Colônia (1530-1822)','colonial.png','História','Publicado','0'],

    'antiguidade-classica'=>['Antiguidade Clássica (Grécia e Roma)','roma.png','História','Publicado','0'],

    'guerra-fria'=>['Guerra Fria (1945 - tempos atuais)','guerrafria.png','História','Publicado','0']
];

$chave = $_GET['curso'] ?? 'era-vargas';
$curso = $cursos[$chave] ?? $cursos['era-vargas'];

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
<link rel="stylesheet" href="estilo/adicionar-curso.css">
</head>


<body>

    <?php
    include("../alexandria-frontend/includes/barraadm.html");
    include("../alexandria-frontend/includes/sidebaradm.html");
    ?>

<div class="page-wrap">

  <a href="#" class="voltar-link" onclick="window.history.back(); return false;">
    <i class="bi bi-arrow-left"></i> Voltar
  </a>

  <h1 class="titulo-pagina">Criar Curso</h1>
  <p class="subtitulo-pagina">Preencha as informações abaixo para cadastrar um novo curso.</p>

  <div class="row g-5 align-items-start">
    <div class="col-lg-8">
      <form id="formCriarCurso" novalidate>

        <!-- Card principal: dados do curso -->
        <div class="card-curso mb-5">
          <div class="row g-4">

            <!-- Coluna esquerda: imagem + período -->
            <div class="col-lg-5">
              <label class="label-campo"><i class="bi bi-image"></i> Imagem de Capa</label>

              <label class="upload-capa" for="inputImagem">
                <span id="capaPlaceholder"><i class="bi bi-cloud-arrow-up d-block mb-2"></i>Clique para adicionar uma capa</span>
                <img id="previewCapa" style="display:none;" alt="Pré-visualização da imagem de capa">
              </label>
              <input type="file" id="inputImagem" accept="image/*">
            </div>

            <!-- Coluna direita: título + descrição -->
            <div class="col-lg-7">
              <label class="label-campo" for="tituloCurso"><i class="bi bi-type-bold"></i> Título do Curso</label>
              <input type="text" id="tituloCurso" class="form-control form-control-custom mb-4"
                     placeholder="Ex.: História do Brasil: da Independência ao Império">
              <div class="contador-caracteres"><span id="contadorAtual">0</span>/2000</div>
            </div>
          </div>

          <!-- Período histórico -->
          <div class="mt-5">
            <label class="label-campo" for="periodoHistorico"><i class="bi bi-clock-history"></i> Período Histórico</label>
            <select id="periodoHistorico" class="form-select form-select-custom">
              <option selected disabled>Selecione o período histórico</option>
              <option value="pre-historia">Pré-História</option>
              <option value="antiguidade">Antiguidade</option>
              <option value="idade-media">Idade Média</option>
              <option value="idade-moderna">Idade Moderna</option>
              <option value="idade-contemporanea">Idade Contemporânea</option>
            </select>
          </div>
        </div>

        <!-- Card conteúdo do curso -->
        <div class="card-curso mb-5">
          <h2 class="titulo-secundario">Conteúdo do curso</h2>
          <button type="button" class="btn-adicionar-aula" id="btnAdicionarAula">
            <span class="icone-mais"><i class="bi bi-plus"></i></span>
            Adicionar Aula ou Exercício
          </button>

          <div id="listaAulas" class="mt-4"></div>
        </div>

        <!-- Rodapé -->
        <div class="footer-acoes">
          <button type="button" class="btn btn-cancelar" onclick="window.history.back();">Cancelar</button>
          <button type="submit" class="btn btn-salvar">Salvar Curso</button>
        </div>

      </form>
    </div>

    <!-- Coluna direita: pré-visualização de como o curso vai aparecer -->
    <div class="col-lg-4">
      <div class="preview-curso-wrap">
        <label class="label-campo"><i class="bi bi-eye"></i> Pré-visualização</label>

        <div class="preview-curso-card">
          <div class="preview-curso-imagem" id="previewCursoImagem">
            <i class="bi bi-image"></i>
          </div>
          <div class="preview-curso-corpo">
            <h3 id="previewCursoTitulo">Título do curso</h3>
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
  // Contador de caracteres da descrição
  const descricao = document.getElementById('descricaoCurso');
  const contador = document.getElementById('contadorAtual');
  descricao.addEventListener('input', () => {
    contador.textContent = descricao.value.length;
  });

  // Pré-visualização do card do curso (título e imagem)
  const tituloCurso = document.getElementById('tituloCurso');
  const previewCursoTitulo = document.getElementById('previewCursoTitulo');
  const previewCursoImagem = document.getElementById('previewCursoImagem');

  tituloCurso.addEventListener('input', () => {
    previewCursoTitulo.textContent = tituloCurso.value.trim() || 'Título do curso';
  });

  // Pré-visualização da imagem escolhida
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

      // reflete a mesma imagem no card de pré-visualização
      previewCursoImagem.innerHTML = `<img src="${url}" alt="Capa do curso">`;
    }
  });

  /* ===================== Aulas / Exercícios ===================== */

  // Ícones exibidos conforme o tipo escolhido
  const ICONES_TIPO = {
    aula: 'bi-journal-text',
    exercicio: 'bi-pencil-square'
  };

  // Para onde o botão "Editar" leva, conforme o tipo do item.
  // Ajuste os nomes dos arquivos de destino conforme as telas reais do seu sistema.
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
    nome.textContent = (tipo === 'aula' ? 'Aula' : 'Exercício') + ' ' + numero;
  }

  function criarItemConteudo(tipoInicial = 'aula'){
    contadorItens++;

    const item = document.createElement('div');
    item.className = 'item-conteudo';
    item.dataset.tipo = tipoInicial;
    item.dataset.numero = contadorItens;
    item.dataset.id = 'item-' + contadorItens; // troque por um id real vindo do backend, se houver

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

    // define o valor inicial do seletor e atualiza ícone/nome
    item.querySelector('.seletor-tipo-item').value = tipoInicial;
    atualizarVisualItem(item);

    // trocar entre Aula <-> Exercício
    item.querySelector('.seletor-tipo-item').addEventListener('change', (e) => {
      item.dataset.tipo = e.target.value;
      atualizarVisualItem(item);
    });

    // botão Editar: leva para outra tela, de acordo com o tipo atual do item
    item.querySelector('.btn-editar-item').addEventListener('click', () => {
      const tipo = item.dataset.tipo;
      const id = item.dataset.id;
      window.location.href = `${DESTINO_EDICAO[tipo]}?id=${encodeURIComponent(id)}&curso=<?= urlencode($chave) ?>`;
    });

    // botão remover
    item.querySelector('.btn-remover-item').addEventListener('click', () => {
      item.remove();
    });

    return item;
  }

  document.getElementById('btnAdicionarAula').addEventListener('click', () => {
    const item = criarItemConteudo('aula');
    listaAulas.appendChild(item);
  });

  /* ===================== Fim Aulas / Exercícios ===================== */

  // Envio do formulário (placeholder)
  document.getElementById('formCriarCurso').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Curso salvo com sucesso! (ação de exemplo — conecte ao seu backend)');
  });
</script>

</body>
</html>