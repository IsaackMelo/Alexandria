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

<!-- Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  :root{
    --bg-page:#faf8f5;
    --bg-card:#ffffff;
    --bordo:#8b1e2d;
    --bordo-escuro:#6f1724;
    --texto-titulo:#1f2733;
    --texto-corpo:#5b5f66;
    --borda-suave:#e3dbd3;
    --placeholder:#9a9490;
  }

  body{
    background-color: var(--bg-page);
    font-family:"Inter", sans-serif;
    color: var(--texto-corpo);
  }

  .page-wrap{
    max-width: 1220px;
    margin: 0 auto;
    padding: 32px 20px 64px;
  }

  /* Voltar */
  .voltar-link{
    color: var(--bordo);
    text-decoration:none;
    font-weight:600;
    font-size:0.95rem;
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-bottom: 18px;
  }
  .voltar-link:hover{ color: var(--bordo-escuro); }

  /* Título */
  .titulo-pagina{
    font-family:"Playfair Display", serif;
    font-weight:800;
    color: var(--bordo);
    font-size: 2.6rem;
    margin-bottom: 4px;
  }
  .subtitulo-pagina{
    color:#8a8f96;
    font-size:1rem;
    margin-bottom: 38px;
  }

  /* Cards */
  .card-curso{
    background-color: var(--bg-card);
    border: 1px solid var(--borda-suave);
    border-radius: 14px;
    padding: 36px;
  }

  .label-campo{
    font-family:"Playfair Display", serif;
    font-weight:700;
    color: var(--texto-titulo);
    font-size: 1.02rem;
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom: 14px;
  }
  .label-campo i{
    color: var(--bordo);
    font-size: 1.05rem;
  }

  /* Upload de imagem de capa (área clicável, sem pré-visualização por padrão) */
  .upload-capa{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:8px;
    min-height:200px;
    border:1px dashed #cfc4ba;
    border-radius:10px;
    color: var(--placeholder);
    font-weight:600;
    font-size:0.92rem;
    cursor:pointer;
    text-align:center;
    position:relative;
    overflow:hidden;
    background:#fbf9f4;
    transition:border-color .15s ease, color .15s ease;
  }
  .upload-capa:hover{
    border-color: var(--bordo);
    color: var(--bordo);
  }
  .upload-capa i{
    font-size:24px;
  }
  .upload-capa img{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
  }

  input#inputImagem{ display:none; }

  /* Inputs */
  .form-control-custom{
    background-color: #fbf9f4;
    border: 1px solid var(--borda-suave);
    border-radius: 8px;
    color: var(--texto-titulo);
    font-size:0.95rem;
    padding: 11px 14px;
  }
  .form-control-custom::placeholder{ color: var(--placeholder); }
  .form-control-custom:focus{
    background-color:#fff;
    border-color: var(--bordo);
    box-shadow: 0 0 0 0.2rem rgba(139,30,45,0.12);
  }

  textarea.form-control-custom{
    min-height: 210px;
    resize: vertical;
  }

  .contador-caracteres{
    text-align:right;
    font-size:0.8rem;
    color: var(--placeholder);
    margin-top: 10px;
  }

  /* Select customizado */
  .form-select-custom{
    background-color: #fbf9f4;
    border: 1px solid var(--borda-suave);
    border-radius: 8px;
    color: var(--placeholder);
    font-size:0.95rem;
    padding: 11px 14px;
  }
  .form-select-custom:focus{
    border-color: var(--bordo);
    box-shadow: 0 0 0 0.2rem rgba(139,30,45,0.12);
    color: var(--texto-titulo);
  }

  /* Conteúdo do curso */
  .titulo-secundario{
    font-family:"Playfair Display", serif;
    font-weight:700;
    color: var(--texto-titulo);
    font-size: 1.7rem;
    margin-bottom: 22px;
  }

  .btn-adicionar-aula{
    width:100%;
    background-color: #d8d4cd;
    border: none;
    border-radius: 10px;
    color:#7b7f85;
    font-weight:500;
    font-size:1rem;
    padding: 20px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    transition: background-color .15s ease;
  }
  .btn-adicionar-aula:hover{
    background-color:#cfcbc3;
    color:#5f636a;
  }
  .icone-mais{
    width:26px;
    height:26px;
    border-radius:50%;
    background-color:#a9adb3;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:0.95rem;
  }
  .btn-adicionar-aula:hover .icone-mais{
    background-color:#8d9199;
  }

  /* ===== Item de aula/exercício ===== */
  .item-conteudo{
    background-color:#fbf9f4;
    border: 1px solid var(--borda-suave);
    border-radius: 10px;
    padding: 18px 20px;
    margin-bottom: 14px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:14px;
    flex-wrap:wrap;
  }
  .item-conteudo .item-info{
    display:flex;
    align-items:center;
    gap:14px;
    flex-grow:1;
    min-width:0;
  }
  .item-conteudo .item-icone{
    width:34px;
    height:34px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f6eee7;
    color: var(--bordo);
    font-size:1rem;
    flex-shrink:0;
  }
  .item-conteudo .item-nome{
    font-weight:600;
    color: var(--texto-titulo);
    font-size:0.95rem;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
  }
  .seletor-tipo-item{
    background-color:#fff;
    border: 1px solid var(--borda-suave);
    border-radius: 7px;
    color: var(--texto-titulo);
    font-size:0.82rem;
    font-weight:600;
    padding: 6px 10px;
    max-width:150px;
    flex-shrink:0;
  }
  .seletor-tipo-item:focus{
    border-color: var(--bordo);
    box-shadow: 0 0 0 0.15rem rgba(139,30,45,0.12);
    outline:none;
  }
  .item-conteudo .item-acoes{
    display:flex;
    align-items:center;
    gap:8px;
    flex-shrink:0;
  }
  .btn-editar-item{
    background: transparent;
    border: 1px solid var(--bordo);
    color: var(--bordo);
    font-weight:600;
    font-size:0.82rem;
    border-radius: 7px;
    padding: 7px 14px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    white-space:nowrap;
  }
  .btn-editar-item:hover{
    background-color: rgba(139,30,45,0.08);
    color: var(--bordo-escuro);
  }
  .btn-remover-item{
    background: transparent;
    border: 1px solid var(--borda-suave);
    color:#a3383f;
    border-radius: 7px;
    padding: 7px 10px;
    display:inline-flex;
    align-items:center;
  }
  .btn-remover-item:hover{
    background-color: rgba(163,56,63,0.08);
    border-color:#a3383f;
  }
  @media (max-width: 575px){
    .item-conteudo{ flex-direction:column; align-items:stretch; }
    .item-conteudo .item-acoes{ justify-content:flex-end; }
  }

  /* Rodapé de ações */
  .footer-acoes{
    border-top: 1px solid var(--borda-suave);
    padding-top: 26px;
    margin-top: 42px;
    display:flex;
    justify-content:flex-end;
    gap:12px;
  }

  .btn-cancelar{
    background: transparent;
    border: 1px solid var(--bordo);
    color: var(--bordo);
    font-weight:600;
    border-radius: 8px;
    padding: 10px 26px;
  }
  .btn-cancelar:hover{
    background-color: rgba(139,30,45,0.06);
    color: var(--bordo-escuro);
  }

  .btn-salvar{
    background-color: var(--bordo);
    border: 1px solid var(--bordo);
    color: #fff;
    font-weight:600;
    border-radius: 8px;
    padding: 10px 26px;
  }
  .btn-salvar:hover{
    background-color: var(--bordo-escuro);
    border-color: var(--bordo-escuro);
  }

  @media (max-width: 767px){
    .titulo-pagina{ font-size: 2.1rem; }
    .footer-acoes{ flex-direction: column-reverse; }
    .footer-acoes .btn{ width:100%; }
  }

  /* ===== Pré-visualização do curso ===== */
  .preview-curso-wrap{
    position:sticky;
    top:24px;
  }
  .preview-curso-nota{
    color: var(--placeholder);
    font-size:0.82rem;
    margin-top:14px;
    line-height:1.5;
  }
  .preview-curso-card{
    background:#fff;
    border:1px solid var(--borda-suave);
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(75,44,20,0.05);
  }
  .preview-curso-imagem{
    height:150px;
    background:#f0ebe6;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#b9b0a4;
    font-size:1.8rem;
    overflow:hidden;
  }
  .preview-curso-imagem img{
    width:100%;
    height:100%;
    object-fit:cover;
  }
  .preview-curso-corpo{
    padding:18px 20px 20px;
  }
  .preview-curso-corpo h3{
    font-family:"Playfair Display", serif;
    font-weight:700;
    color: var(--texto-titulo);
    font-size:1.08rem;
    margin:0 0 14px;
    line-height:1.35;
  }
  .preview-curso-progresso{
    border-top:1px solid var(--borda-suave);
    padding-top:12px;
    margin:0;
    color: var(--placeholder);
    font-size:0.82rem;
  }
  @media (max-width: 991px){
    .preview-curso-wrap{ position:static; margin-top:8px; }
  }
</style>
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