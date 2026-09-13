<?php
// Dados dos cursos: centralizados em dados.php
require_once __DIR__ . '/dados.php';

?>





<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="imagens/alex.png">
    <title>ADM | Cursos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinho-alexandria: #8b1e2d;
            --dourado-alexandria: #d4af37;
            --dourado-claro: #f0d060;
            --branco: #fff;
            --fundo: #faf8f5;
            --cinza-medio: #e8dfd7;
            --cinza-escuro: #777;
            --texto-escuro: #333;
        }

        * { 
            box-sizing: border-box; 
        }

        body { 
            margin: 0; 
            background: var(--fundo); 
            color: var(--texto-escuro); 
            font-family: 'Inter', sans-serif; 
        }

        .conteudo-adm { 
            margin-left: 156px; 
            min-height: 100vh; 
            padding: 30px 40px 40px; 
        }

        .cabecalho { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-end; gap: 20px; 
            margin-bottom: 22px; 
            border-bottom: 1px solid var(--cinza-medio); 
            padding-bottom: 18px; 
        }

        .cabecalho h1 { 
            margin: 0 0 5px; 
            font-family: 'Playfair Display', serif; 
            font-size: 25px; 
        }

        .cabecalho p { 
            margin: 0; 
            color: var(--cinza-escuro); 
            font-size: 13px; 
        }

        .botao-novo { 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; border: 0; 
            border-radius: 5px; 
            padding: 10px 15px; 
            color: #fff; 
            background: var(--vinho-alexandria); 
            font-size: 12px; font-weight: 600; 
            text-decoration: none; 
            white-space: nowrap; 
            transition: .2s; 
        }

        .botao-novo:hover { 
            color: #fff; 
            background: #6f1724; 
        }

        .barra-controles { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            gap: 15px; 
            margin-bottom: 22px; 
        }

        .contador { 
            color: var(--cinza-escuro); 
            font-size: 12px; 
        }

        .controles { 
            display: flex; 
            gap: 10px; 
        }
        
        .busca, .filtro { 
            height: 36px; 
            border: 1px solid #dcd3ca; 
            border-radius: 5px; 
            background: #fff; 
            color: var(--texto-escuro); 
            font: inherit; 
            font-size: 12px; 
            outline: none; 
        }

        .busca { 
            width: 230px; 
            padding: 0 12px; 
        }

        .filtro { 
            padding: 0 9px; 
        }

        .busca:focus, .filtro:focus { 
            border-color: var(--dourado-alexandria); 
            box-shadow: 0 0 0 3px rgba(212,175,55,.15); 
        }

        .grade-cursos { 
            display: grid; 
            grid-template-columns: 
            repeat(3, minmax(0px, 1fr)); 
            gap: 24px; 
        }

        .cartao-curso { 
            overflow: hidden; 
            max-width: 300px; 
            width: 100%; 
            margin: 0 auto; 
            border: 1px solid #e0d6cd; 
            border-radius: 10px; 
            background: #fff; 
            box-shadow: 0 2px 8px rgba(0,0,0,.04); 
            transition: transform .2s, box-shadow .2s; 
        }

        .cartao-curso:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 5px 16px rgba(75,44,20,.12); 
        }

        .container-imagem-curso { 
            position: relative; 
            height: 145px; 
            overflow: hidden; 
            background: #f0f0f0; 
        }
        
        .container-imagem-curso img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
        }

        .status { 
            position: absolute; 
            top: 10px; 
            right: 10px; 
            padding: 5px 8px; 
            border-radius: 20px; 
            color: #1f7548; 
            background: #e5f5eb; 
            font-size: 10px; 
            font-weight: 600; 
        }

        .informacoes-curso { 
            padding: 14px; 
        }

        .titulo-curso { 
            min-height: 35px; 
            margin-bottom: 13px; 
            color: var(--texto-escuro); 
            font-size: 13px; 
            font-weight: 600; 
            line-height: 1.35; 
        }

        .detalhes-curso { 
            display: flex; 
            justify-content: space-between; 
            gap: 8px; 
            padding: 9px 0; 
            border-top: 1px solid #eee; 
            color: var(--cinza-escuro); 
            font-size: 10px; 
        }

        .detalhes-curso span { 
            display: inline-flex; 
            align-items: center; 
            gap: 5px; 
        }

        .acoes-curso { 
            display: flex; 
            gap: 7px; 
            margin-top: 12px; 
        }

        .acao { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 6px; 
            min-height: 31px; 
            border-radius: 4px; 
            font-size: 10px; 
            font-weight: 600; 
            text-decoration: none; 
            cursor: pointer; 
            transition: .2s; 
        }

        .acao-editar { 
            flex: 1; 
            border: 1px solid var(--vinho-alexandria); 
            color: var(--vinho-alexandria); 
            background: #fff; 
        }

        .acao-editar:hover { 
            color: #fff; 
            background: var(--vinho-alexandria); 
        }

        .acao-visualizar, .acao-excluir { 
            width: 34px; 
            border: 1px solid #ddd5ce; 
            color: #777; 
            background: #fff; 
        }

        .acao-visualizar:hover { 
            color: #2878a8; 
            border-color: #b8d7e8; 
            background: #eef8fd; 
        }

        .acao-excluir:hover { 
            color: #b52929; 
            border-color: #efc9c9; 
            background: #fff0f0; 
        }

        .sem-resultados { 
            display: none; 
            grid-column: 1 / -1; 
            padding: 45px; 
            color: var(--cinza-escuro); 
            text-align: center; 
        }

        .paginacao { 
            display: flex; 
            justify-content: center; 
            gap: 8px; 
            margin-top: 32px; 
        }

        .pagina { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            width: 36px; 
            height: 36px; 
            border: 1px solid #dcdcdc; 
            border-radius: 6px; 
            color: var(--texto-escuro); 
            background: #fff; 
            font-size: 13px; 
            text-decoration: none; 
        }

        .pagina.ativa, .pagina:hover { 
            border-color: var(--vinho-alexandria); 
            color: #fff; 
            background: var(--vinho-alexandria); 
        }
        
    </style>
</head>
<body>
<?php
    include("../alexandria-frontend/includes/sidebaradm.html");
    include("../alexandria-frontend/includes/barraadm.html");
?>

<main class="conteudo-adm">
    <header class="cabecalho">
        <div>
            <h1>Gerenciamento de cursos</h1>
            <p>Os cursos abaixo são os mesmos disponíveis para os usuários.</p>
        </div>
        <a href="adicionar-curso.php" class="botao-novo"><i class="fa-solid fa-plus"></i> Novo curso</a>
    </header>

    <div class="barra-controles">
        <span class="contador" id="contador"><?= count($cursos) ?> curso<?= count($cursos) === 1 ? '' : 's' ?> cadastrado<?= count($cursos) === 1 ? '' : 's' ?></span>
        <div class="controles">
            <input type="search" class="busca" id="buscaCurso" placeholder="Buscar cursos..." aria-label="Buscar cursos">
            <select class="filtro" id="filtroStatus" aria-label="Filtrar cursos">
                <option value="todos">Todos os cursos</option>
                <option value="publicado">Publicados</option>
                <option value="rascunho">Rascunhos</option>
            </select>
        </div>
    </div>

    <section class="grade-cursos" id="gradeCursos" aria-label="Cursos disponíveis para gerenciamento">
        <?php foreach ($cursos as $curso): ?>
            <article class="cartao-curso" data-status="<?= htmlspecialchars($curso['status']) ?>">
                <div class="container-imagem-curso">
                    <img src="<?= htmlspecialchars($curso['imagem']) ?>" alt="<?= htmlspecialchars($curso['titulo']) ?>">
                    <span class="status"><?= $curso['status'] === 'publicado' ? 'Publicado' : 'Rascunho' ?></span>
                </div>
                <div class="informacoes-curso">
                    <div class="titulo-curso"><?= htmlspecialchars($curso['titulo']) ?></div>
                    <div class="detalhes-curso">
                        <span><i class="fa-solid fa-users"></i> <?= (int) $curso['alunos'] ?> alunos</span>
                        <span><i class="fa-solid fa-book"></i> <?= htmlspecialchars($curso['categoria']) ?></span>
                    </div>
                    <div class="acoes-curso">
                        <a class="acao acao-editar" href="editar-curso.php?curso=<?= urlencode($curso['slug']) ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a class="acao acao-visualizar" href="visualizar-curso.php?curso=<?= urlencode($curso['slug']) ?>" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <button class="acao acao-excluir" type="button" title="Excluir" data-curso="<?= htmlspecialchars($curso['titulo']) ?>"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </article>
<?php endforeach; ?>
        <div class="sem-resultados" id="semResultados">Nenhum curso encontrado.</div>
    </section>

    <nav class="paginacao" aria-label="Paginação"><a href="#" class="pagina"><i class="fas fa-chevron-left"></i></a><a href="#" class="pagina ativa">1</a><a href="visualizar-curso.php?page=2" class="pagina">2</a><a href="visualizar-curso.php?page=3" class="pagina">3</a><a href="visualizar-curso.php?page=2" class="pagina"><i class="fas fa-chevron-right"></i></a></nav>
</main>

<script>
    const busca = document.getElementById('buscaCurso');
    const filtro = document.getElementById('filtroStatus');
    const contador = document.getElementById('contador');
    const semResultados = document.getElementById('semResultados');
    const cards = [...document.querySelectorAll('.cartao-curso')];

    function filtrarCursos() {
        const termo = busca.value.toLocaleLowerCase('pt-BR').trim();
        const status = filtro.value;
        let encontrados = 0;
        cards.forEach(card => {
            const correspondeTexto = card.textContent.toLocaleLowerCase('pt-BR').includes(termo);
            const correspondeStatus = status === 'todos' || card.dataset.status === status;
            const mostrar = correspondeTexto && correspondeStatus;
            card.style.display = mostrar ? '' : 'none';
            if (mostrar) encontrados++;
        });
        contador.textContent = `${encontrados} curso${encontrados === 1 ? '' : 's'} encontrado${encontrados === 1 ? '' : 's'}`;
        semResultados.style.display = encontrados ? 'none' : 'block';
    }
    busca.addEventListener('input', filtrarCursos);
    filtro.addEventListener('change', filtrarCursos);

    document.querySelectorAll('.acao-excluir').forEach(botao => {
        botao.addEventListener('click', () => {
            const curso = botao.dataset.curso;
            if (confirm(`Deseja realmente excluir o curso “${curso}”?`)) {
                botao.closest('.cartao-curso').remove();
                const indice = cards.indexOf(botao.closest('.cartao-curso'));
                if (indice !== -1) cards.splice(indice, 1);
                filtrarCursos();
            }
        });
    });
</script>
</body>
</html>
