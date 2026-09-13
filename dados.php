<?php
/**
 * dados.php
 *
 * Arquivo central com os dados usados pelas telas de visualização do
 * Alexandria (acervos, artigos, cursos, notificações, questões, provas e
 * aulas). Hoje os dados estão fixos aqui como arrays PHP; quando o backend
 * (banco de dados) for integrado, basta trocar cada array por uma consulta
 * real, mantendo o mesmo nome de variável para não precisar mexer nas
 * páginas que os usam.
 *
 * Uso: dê um require_once __DIR__ . '/dados.php'; no topo do arquivo que
 * precisa dos dados.
 */

// ============================================================
// ACERVOS (visualizar-acervo.php)
// ============================================================
$acervos = [
    ['id' => 1, 'nome' => 'FGiV',     'logo' => 'imagens/logo-fgv.png',      'descricao' => 'Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.', 'link' => 'acervo.php?banca=fgv'],
    ['id' => 2, 'nome' => 'CEBRASPE', 'logo' => 'imagens/logo-cebraspe.png', 'descricao' => 'Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.', 'link' => 'acervo.php?banca=cebraspe'],
    ['id' => 3, 'nome' => 'FUVEST',   'logo' => 'imagens/logo-fuvest.png',   'descricao' => 'Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.', 'link' => 'acervo.php?banca=fuvest'],
    ['id' => 4, 'nome' => 'ENEM',     'logo' => 'imagens/logo-enem.png',     'descricao' => 'Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.', 'link' => 'acervo.php?banca=enem'],
    ['id' => 5, 'nome' => 'EsPCEx',   'logo' => 'imagens/logo-espcex.png',   'descricao' => 'Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.', 'link' => 'acervo.php?banca=espcex'],
    ['id' => 6, 'nome' => 'VUNESP',   'logo' => 'imagens/logo-vunesp.png',   'descricao' => 'Conhecida pelo rigor técnico. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.', 'link' => 'acervo.php?banca=vunesp'],
];

// ============================================================
// ARTIGOS (visualizar-artigos.php)
// ============================================================
$artigos = [
    [
        'titulo' => 'A Queda de Constantinopla e o Fim da Idade Média',
        'resumo' => 'Em 1453, a tomada de Constantinopla pelo Império Otomano encerrou definitivamente a Idade Média e alterou o equilíbrio político, religioso e comercial do mundo. O artigo explora os últimos dias do Império Bizantino, o impacto da pólvora nas guerras e como a queda da cidade abriu caminho para uma nova era de expansão marítima europeia.',
        'categoria' => 'Idade Média',
        'imagem' => 'constantinopla.jpg',
        'tempo_leitura' => '5 min',
        'data' => '17 maio 2025',
        'autor' => 'Victor',
    ],
    [
        'titulo' => 'A Revolução Francesa e o Nascimento do Mundo Moderno',
        'resumo' => 'A Revolução Francesa derrubou monarquias absolutas, espalhou ideais republicanos e redefiniu os rumos da política e do poder público. O artigo acompanha os eventos da revolução, desde a queda da Bastilha até o período do Terror, e analisa seus efeitos duradouros na política mundial.',
        'categoria' => 'História Moderna',
        'imagem' => 'revolucao-francesa.jpg',
        'tempo_leitura' => '6 min',
        'data' => '14 maio 2025',
        'autor' => 'Victor',
    ],
    [
        'titulo' => 'A Primeira Guerra Mundial e o Colapso dos Impérios',
        'resumo' => 'O conflito que começou em 1914 redesenhou o mapa mundial e derrubou impérios seculares. O artigo apresenta as causas, as principais batalhas e as consequências que moldaram o século XX, da queda dos impérios Austro-Húngaro e Otomano ao surgimento de novas nações.',
        'categoria' => 'História Contemporânea',
        'imagem' => 'primeira-guerra.jpg',
        'tempo_leitura' => '7 min',
        'data' => '9 maio 2025',
        'autor' => 'Victor',
    ],
];

// ============================================================
// CURSOS (visualizar-curso.php)
// ============================================================
$cursos = [
    ['id' => 1, 'titulo' => 'Eia Vargas (1930 - 1945)',               'imagem' => 'imagens/getulio.png',    'categoria' => 'História', 'alunos' => 0, 'status' => 'publicado', 'slug' => 'era-vargas'],
    ['id' => 2, 'titulo' => 'Idade Moderna e Renascimento',           'imagem' => 'imagens/filosofia.png',  'categoria' => 'História', 'alunos' => 0, 'status' => 'publicado', 'slug' => 'idade-moderna'],
    ['id' => 3, 'titulo' => 'Ditadura Militar no Brasil (1964-1985)', 'imagem' => 'imagens/ditadura.png',   'categoria' => 'História', 'alunos' => 0, 'status' => 'publicado', 'slug' => 'ditadura-militar'],
    ['id' => 4, 'titulo' => 'Brasil Colônia (1530-1822)',             'imagem' => 'imagens/colonial.png',   'categoria' => 'História', 'alunos' => 0, 'status' => 'publicado', 'slug' => 'brasil-colonia'],
    ['id' => 5, 'titulo' => 'Antiguidade Clássica (Grécia e Roma)',   'imagem' => 'imagens/roma.png',       'categoria' => 'História', 'alunos' => 0, 'status' => 'publicado', 'slug' => 'antiguidade-classica'],
    ['id' => 6, 'titulo' => 'Guerra Fria (1945 - tempos atuais)',     'imagem' => 'imagens/guerrafria.png', 'categoria' => 'História', 'alunos' => 0, 'status' => 'publicado', 'slug' => 'guerra-fria'],
];

// ============================================================
// NOTIFICAÇÕES (visualizar-notificacao.php)
// ============================================================
$notificacoes = [
    [
        'id' => 1,
        'tipo' => 'modulo',
        'titulo' => 'Novo módulo liberado: Brasil Império',
        'descricao' => 'O conteúdo completo sobre o período imperial brasileiro já está disponível, incluindo exercícios comentados e mapas mentais.',
        'tempo' => 'Há 2 horas',
        'status' => 'urgente',
    ],
    [
        'id' => 2,
        'tipo' => 'simulado',
        'titulo' => 'Simulado ENEM de História disponível',
        'descricao' => 'Um novo simulado focado em História Geral e História do Brasil foi adicionado à plataforma com correção automática.',
        'tempo' => 'Há 4 horas',
        'status' => 'nao_lida',
    ],
    [
        'id' => 3,
        'tipo' => 'atualizacao',
        'titulo' => 'Atualização na trilha de Revolução Francesa',
        'descricao' => 'Adicionamos novas videoaulas e artigos complementares sobre o contexto político e social da Revolução Francesa.',
        'tempo' => 'Há 1 dia',
        'status' => 'nao_lida',
    ],
    [
        'id' => 4,
        'tipo' => 'conquista',
        'titulo' => 'Parabéns! Meta semanal concluída',
        'descricao' => 'Você estudou por 7 dias consecutivos. Continue assim e alcance seus objetivos!',
        'tempo' => 'Há 1 dia',
        'status' => 'lida',
    ],
    [
        'id' => 5,
        'tipo' => 'chat',
        'titulo' => 'Nova mensagem do Chat AI',
        'descricao' => 'Seu assistente de estudos tem uma resposta para a sua última pergunta.',
        'tempo' => 'Há 2 dias',
        'status' => 'lida',
    ],
];

// Configuração visual por tipo de notificação.
$tiposConfig = [
    'modulo'      => ['bg' => '#F6DCE1', 'fg' => '#9C3B52', 'icon' => 'book'],
    'simulado'    => ['bg' => '#F4E7B8', 'fg' => '#8A6D1B', 'icon' => 'clipboard'],
    'atualizacao' => ['bg' => '#F1C3BC', 'fg' => '#A23F31', 'icon' => 'landmark'],
    'conquista'   => ['bg' => '#CBE8D3', 'fg' => '#2F7A45', 'icon' => 'check'],
    'chat'        => ['bg' => '#DCD6F0', 'fg' => '#584C9C', 'icon' => 'chat'],
];

$statusConfig = [
    'urgente'  => '#B3273E',
    'nao_lida' => '#D9A824',
    'lida'     => '#B9B2A8',
];

function icone_svg($nome) {
    $icones = [
        'book' => '<path d="M4 5.5C4 4.67 4.67 4 5.5 4H11v14H5.5A1.5 1.5 0 0 1 4 16.5v-11Z"/><path d="M20 5.5c0-.83-.67-1.5-1.5-1.5H13v14h5.5c.83 0 1.5-.67 1.5-1.5v-11Z"/>',
        'clipboard' => '<rect x="6" y="4" width="12" height="16" rx="1.5"/><path d="M9 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/><path d="M9 11h6M9 15h6"/>',
        'landmark' => '<path d="M4 21h16"/><path d="M5 21V10M9 21V10M15 21V10M19 21V10"/><path d="M3 10 12 4l9 6"/>',
        'check' => '<path d="M20 6 9 17l-5-5"/>',
        'chat' => '<path d="M21 12a8 8 0 0 1-11.6 7.1L4 21l1.6-5A8 8 0 1 1 21 12Z"/>',
        'eye' => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>',
        'pencil' => '<path d="m15 4 5 5-11 11H4v-5L15 4Z"/>',
        'trash' => '<path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 13h10l1-13"/>',
        'x' => '<path d="M18 6 6 18"/><path d="M6 6l12 12"/>',
        'chevron' => '<path d="m6 9 6 6 6-6"/>',
    ];
    return $icones[$nome] ?? '';
}

// ============================================================
// QUESTÕES / BANCO DE QUESTÕES (visualizar-questoes.php)
// ============================================================
$questoes = [
    ['id' => 1, 'dificuldade' => 'facil', 'assunto' => 'Revolução Francesa',    'banca' => 'UNICAMP',  'ano' => 2020, 'tipo' => 'dissertativo'],
    ['id' => 2, 'dificuldade' => 'medio', 'assunto' => 'Segunda Guerra',        'banca' => 'FUVEST',   'ano' => 2021, 'tipo' => 'alternativa'],
    ['id' => 3, 'dificuldade' => 'medio', 'assunto' => 'Estado Novo',           'banca' => 'CEBRASPE', 'ano' => 2015, 'tipo' => 'alternativa'],
    ['id' => 4, 'dificuldade' => 'medio', 'assunto' => 'Ditadura Militar',      'banca' => 'UNICAMP',  'ano' => 2017, 'tipo' => 'dissertativo'],
    ['id' => 5, 'dificuldade' => 'facil', 'assunto' => 'Primeira Guerra Mundial','banca' => 'UNESP',   'ano' => 2019, 'tipo' => 'alternativa'],
];

$textos_dificuldade = ['facil' => 'Fácil', 'medio' => 'Médio', 'dificil' => 'Difícil'];
$textos_tipo        = ['alternativa' => 'Alternativa', 'dissertativo' => 'Dissertativo'];

// ============================================================
// PROVAS / ACERVO FUVEST (visualizar-prova.php)
// Consumido no front via json_encode($provas) e renderizado em JS.
// ============================================================
$provas = [
    ['dificuldade' => 'Medio',   'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V1',    'link' => 'questao.php'],
    ['dificuldade' => 'Medio',   'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V2',    'link' => 'questao.php'],
    ['dificuldade' => 'Medio',   'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V3',    'link' => 'questao.php'],
    ['dificuldade' => 'Medio',   'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V4',    'link' => 'questao.php'],
    ['dificuldade' => 'Medio',   'ano' => 2025, 'fase' => 'Fase 2', 'versao' => 'Dia 1', 'link' => 'questao.php'],
    ['dificuldade' => 'Medio',   'ano' => 2025, 'fase' => 'Fase 2', 'versao' => 'Dia 2', 'link' => 'questao.php'],
    ['dificuldade' => 'Dificil', 'ano' => 2024, 'fase' => 'Fase 1', 'versao' => 'V1',    'link' => 'questao.php'],
    ['dificuldade' => 'Dificil', 'ano' => 2024, 'fase' => 'Fase 1', 'versao' => 'V2',    'link' => 'questao.php'],
];

// ============================================================
// MÓDULO DE AULAS - ERA VARGAS (visualizar-aulas.php)
// ============================================================
$modulo_aulas_era_vargas = [
    ['tipo' => 'principal', 'titulo' => 'Era Vargas', 'subtitulo' => '(1930 - 1945)', 'link' => 'aula.php'],
    ['tipo' => 'aula', 'titulo' => 'Revolução de 1930'],
    ['tipo' => 'aula', 'titulo' => 'Governo Provisório (1930 - 1934)'],
    ['tipo' => 'aula', 'titulo' => 'Governo Constitucional (1934 - 1937)'],
    ['tipo' => 'aula', 'titulo' => 'Estado Novo (1937 - 1945)'],
    ['tipo' => 'aula', 'titulo' => 'Fim da Era Vargas'],
    ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 3'],
    ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2'],
    ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1'],
];

// ============================================================
// AULA "REVOLUÇÃO DE 1930" (visualizar-aula.php)
// ============================================================

// Lista de conteúdos mostrada na barra lateral da aula.
$conteudos_aula_revolucao_1930 = [
    ['tipo' => 'aula',      'nome' => 'Era Vargas: Revolução de 1930',        'ativo' => true],
    ['tipo' => 'aula',      'nome' => 'Era Vargas: Governo Provisório',       'ativo' => false],
    ['tipo' => 'aula',      'nome' => 'Era Vargas: Governo Constitucional',   'ativo' => false],
    ['tipo' => 'aula',      'nome' => 'Era Vargas: Estado Novo',              'ativo' => false],
    ['tipo' => 'aula',      'nome' => 'Era Vargas: Fim da Era Vargas',        'ativo' => false],
    ['tipo' => 'exercicio', 'nome' => 'Lista de Exercícios 1',                'ativo' => false],
    ['tipo' => 'exercicio', 'nome' => 'Lista de Exercícios 2',                'ativo' => false],
    ['tipo' => 'exercicio', 'nome' => 'Lista de Exercícios 3',                'ativo' => false],
];

// Materiais para download da aula.
$materiais_aula_revolucao_1930 = [
    ['nome' => 'Exercícios revolução de 1930', 'tamanho' => 'Word - 15.62 KB', 'icone' => 'bi-file-earmark-word'],
];
