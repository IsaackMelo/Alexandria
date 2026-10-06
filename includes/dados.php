<?php

$tipos_acervo = ['vestibular' => 'Vestibular', 'concurso' => 'Concurso público'];

$acervos = [
    [
        'id' => 1, 'nome' => 'FGV', 'slug' => 'fgv', 'nome_completo' => 'Fundação Getulio Vargas',
        'tipo' => 'concurso', 'site' => 'https://conhecimento.fgv.br/concursos', 'logo' => '../imagens/fgv.jpg',
        'descricao' => 'Conhecida pelo rigor técnico e por enunciados longos e interpretativos. Ideal para quem busca carreiras em Direito, Economia e Administração Pública.',
        'link' => 'visualizar-prova.php?banca=fgv',
    ],
    [
        'id' => 2, 'nome' => 'CEBRASPE', 'slug' => 'cebraspe', 'nome_completo' => 'Centro Brasileiro de Pesquisa em Avaliação e Seleção e de Promoção de Eventos',
        'tipo' => 'concurso', 'site' => 'https://www.cebraspe.org.br', 'logo' => '../imagens/cebraspe.jpg',
        'descricao' => 'Famosa pelo modelo "certo ou errado", em que uma resposta errada anula uma certa. Exige leitura atenta e domínio de detalhes históricos.',
        'link' => 'visualizar-prova.php?banca=cebraspe',
    ],
    [
        'id' => 3, 'nome' => 'FUVEST', 'slug' => 'fuvest', 'nome_completo' => 'Fundação Universitária para o Vestibular',
        'tipo' => 'vestibular', 'site' => 'https://www.fuvest.br', 'logo' => '../imagens/fuvest.jpg',
        'descricao' => 'Responsável pelo vestibular da USP. A primeira fase é objetiva e a segunda é discursiva, com questões que cobram análise de fontes e contexto histórico.',
        'link' => 'visualizar-prova.php?banca=fuvest',
    ],
    [
        'id' => 4, 'nome' => 'ENEM', 'slug' => 'enem', 'nome_completo' => 'Exame Nacional do Ensino Médio',
        'tipo' => 'vestibular', 'site' => 'https://www.gov.br/inep', 'logo' => '../imagens/enem.png',
        'descricao' => 'Principal porta de entrada para universidades públicas via SISU. Em Ciências Humanas, valoriza interpretação de textos, imagens e a relação entre passado e presente.',
        'link' => 'visualizar-prova.php?banca=enem',
    ],
    [
        'id' => 5, 'nome' => 'EsPCEx', 'slug' => 'espcex', 'nome_completo' => 'Escola Preparatória de Cadetes do Exército',
        'tipo' => 'vestibular', 'site' => 'https://www.espcex.eb.mil.br', 'logo' => '../imagens/espcex.png',
        'descricao' => 'Concurso de ingresso na carreira militar do Exército. As questões de História são diretas e cobram datas, personagens e processos históricos com precisão.',
        'link' => 'visualizar-prova.php?banca=espcex',
    ],
    [
        'id' => 6, 'nome' => 'VUNESP', 'slug' => 'vunesp', 'nome_completo' => 'Fundação para o Vestibular da Universidade Estadual Paulista',
        'tipo' => 'concurso', 'site' => 'https://www.vunesp.com.br', 'logo' => '../imagens/vunesp.png',
        'descricao' => 'Organiza o vestibular da UNESP e diversos concursos estaduais e municipais de São Paulo, com questões objetivas de nível médio a avançado.',
        'link' => 'visualizar-prova.php?banca=vunesp',
    ],
];

$categorias_artigos_disponiveis = ['Antiguidade', 'Idade Média', 'História Moderna', 'História Contemporânea', 'História do Brasil'];

$artigos = [
    [
        'titulo' => 'A Queda de Constantinopla e o Fim da Idade Média',
        'resumo' => 'Em 1453, a tomada de Constantinopla pelo Império Otomano encerrou definitivamente a Idade Média e alterou o equilíbrio político, religioso e comercial do mundo. O artigo explora os últimos dias do Império Bizantino, o impacto da pólvora nas guerras e como a queda da cidade abriu caminho para uma nova era de expansão marítima europeia.',
        'categoria' => 'Idade Média',
        'imagem' => 'cruzadas.jpg',
        'tempo_leitura' => '5 min',
        'data' => '17 maio 2025',
        'autor' => 'Victor',
        'tags' => ['Império Bizantino', 'Império Otomano', 'Idade Média', 'Grandes Navegações'],
        'conteudo' => implode('', [
            '<h3>Uma cidade entre dois mundos</h3>',
            '<p>Durante mais de mil anos, Constantinopla foi a <strong>capital do Império Romano do Oriente</strong> e uma das cidades mais ricas do mundo. Situada entre a Europa e a Ásia, controlava o estreito do Bósforo e, com ele, boa parte das rotas comerciais que ligavam o Mediterrâneo ao Mar Negro e ao Oriente.</p>',
            '<p>No século XV, porém, o Império Bizantino estava reduzido a pouco mais que a própria cidade. Enfraquecido por disputas internas, pelo saque realizado pelos cruzados em 1204 e pela perda de territórios para os turcos, dependia de muralhas construídas séculos antes para resistir.</p>',
            '<h3>O cerco de 1453</h3>',
            '<p>Em abril de 1453, o sultão otomano <strong>Mehmed II</strong> cercou Constantinopla com um exército muito superior e com uma arma decisiva: canhões de grande calibre, capazes de abrir brechas nas antigas muralhas. Após quase dois meses de cerco, a cidade caiu em <strong>29 de maio</strong>, e o último imperador, Constantino XI, morreu em combate.</p>',
            '<h3>Consequências da conquista</h3>',
            '<p>A conquista transformou Constantinopla em <strong>Istambul</strong>, nova capital otomana, e deu aos turcos o controle das rotas terrestres para o Oriente. Para os comerciantes europeus, o acesso às especiarias ficou mais caro e difícil, o que incentivou portugueses e espanhóis a buscar caminhos marítimos alternativos.</p>',
            '<p>Por isso, muitos historiadores usam 1453 como marco do <strong>fim da Idade Média</strong>: a data simboliza o encerramento de um mundo centrado no Mediterrâneo e o início de uma era de expansão oceânica que levaria os europeus à África, à Ásia e à América.</p>',
            '<blockquote><p><em>“A cidade caiu, mas o mundo que dela nasceu seria marítimo.”</em></p></blockquote><h3>Pontos-chave</h3><ul><li>Constantinopla controlava o estreito do <strong>Bósforo</strong>.</li><li>Os <strong>canhões</strong> otomanos romperam as muralhas milenares.</li><li>A queda estimulou a busca de <u>rotas marítimas</u> para o Oriente.</li></ul>',
        ]),
    ],
    [
        'titulo' => 'A Revolução Francesa e o Nascimento do Mundo Moderno',
        'resumo' => 'A Revolução Francesa derrubou monarquias absolutas, espalhou ideais republicanos e redefiniu os rumos da política e do poder público. O artigo acompanha os eventos da revolução, desde a queda da Bastilha até o período do Terror, e analisa seus efeitos duradouros na política mundial.',
        'categoria' => 'História Moderna',
        'imagem' => 'revolucao.jpg',
        'tempo_leitura' => '6 min',
        'data' => '14 maio 2025',
        'autor' => 'Victor',
        'tags' => ['Revolução Francesa', 'Iluminismo', 'Antigo Regime', 'Napoleão'],
        'conteudo' => implode('', [
            '<h3>A França do Antigo Regime</h3>',
            '<p>No fim do século XVIII, a França vivia sob o <strong>Antigo Regime</strong>: uma monarquia absoluta em que o clero e a nobreza possuíam privilégios, enquanto o <em>Terceiro Estado</em> — burgueses, trabalhadores urbanos e camponeses — sustentava o país com impostos.</p>',
            '<p>A crise financeira da Coroa, agravada pelos gastos com guerras e com a corte de Versalhes, levou Luís XVI a convocar os <strong>Estados Gerais</strong> em 1789. Insatisfeitos com o sistema de votação, os representantes do <em>Terceiro Estado</em> se declararam Assembleia Nacional e juraram dar uma Constituição ao país.</p>',
            '<h3>1789: a queda da Bastilha</h3>',
            '<p>Em <strong>14 de julho de 1789</strong>, a população de Paris tomou a Bastilha, símbolo do poder real. Nas semanas seguintes, a Assembleia aboliu os privilégios feudais e aprovou a <strong>Declaração dos Direitos do Homem e do Cidadão</strong>, inspirada nos ideais iluministas de liberdade e igualdade.</p>',
            '<h3>Radicalização e legado</h3>',
            '<p>A radicalização veio com a proclamação da República em 1792, a execução do rei em 1793 e o período do <strong>Terror</strong>, liderado pelos jacobinos de Robespierre. Após sua queda, o governo do Diretório abriu espaço para a ascensão de Napoleão Bonaparte, que chegou ao poder com o golpe do <strong>18 de Brumário</strong>, em 1799.</p>',
            '<p>Mesmo com idas e vindas, a Revolução deixou um legado duradouro: a ideia de soberania popular, a separação entre Estado e Igreja, o fim dos privilégios de nascimento e a difusão de constituições escritas por toda a Europa e pelas Américas.</p>',
            '<h3>Linha do tempo</h3><ol><li><strong>1789</strong> — Estados Gerais e tomada da Bastilha.</li><li><strong>1792</strong> — Proclamação da República.</li><li><strong>1793</strong> — Execução de Luís XVI e início do Terror.</li><li><strong>1799</strong> — Golpe do 18 de Brumário.</li></ol>',
        ]),
    ],
    [
        'titulo' => 'A Primeira Guerra Mundial e o Colapso dos Impérios',
        'resumo' => 'O conflito que começou em 1914 redesenhou o mapa mundial e derrubou impérios seculares. O artigo apresenta as causas, as principais batalhas e as consequências que moldaram o século XX, da queda dos impérios Austro-Húngaro e Otomano ao surgimento de novas nações.',
        'categoria' => 'História Contemporânea',
        'imagem' => 'guerra.jpg',
        'tempo_leitura' => '7 min',
        'data' => '9 maio 2025',
        'autor' => 'Victor',
        'tags' => ['Primeira Guerra Mundial', 'Imperialismo', 'Tratado de Versalhes', 'Século XX'],
        'conteudo' => implode('', [
            '<h3>As causas do conflito</h3>',
            '<p>No início do século XX, as potências europeias disputavam mercados, colônias e influência. Essa rivalidade imperialista, somada ao nacionalismo e à corrida armamentista, levou à formação de dois grandes blocos: a <strong>Tríplice Entente</strong> (França, Reino Unido e Rússia) e a <strong>Tríplice Aliança</strong> (Alemanha, Áustria-Hungria e Itália).</p>',
            '<p>O estopim veio em <strong>28 de junho de 1914</strong>, com o assassinato do arquiduque Francisco Ferdinando, herdeiro do trono austro-húngaro, em Sarajevo. Em poucas semanas, o sistema de alianças arrastou as principais potências para a guerra.</p>',
            '<h3>A guerra de trincheiras</h3>',
            '<p>Na frente ocidental, o conflito se transformou em uma <strong>guerra de trincheiras</strong>, com batalhas como as de Verdun e do Somme, que deixaram centenas de milhares de mortos sem grandes avanços territoriais. Novas armas, como metralhadoras, gases tóxicos, tanques e aviões, mudaram a forma de combater.</p>',
            '<p>Em 1917, dois fatos alteraram o rumo da guerra: a entrada dos Estados Unidos ao lado da Entente e a Revolução Russa, que tirou a Rússia do conflito. Enfraquecidos, os impérios centrais se renderam, e o <em>armistício</em> foi assinado em 11 de novembro de 1918.</p>',
            '<h3>O fim dos impérios</h3>',
            '<p>O <strong>Tratado de Versalhes</strong> impôs duras sanções à Alemanha, e os impérios Alemão, Austro-Húngaro, Russo e Otomano deixaram de existir. O novo mapa da Europa e o ressentimento gerado pelos acordos de paz ajudariam a preparar o terreno para a Segunda Guerra Mundial.</p>',
            '<h3>Pontos-chave</h3><ul><li>Imperialismo, nacionalismo e corrida armamentista criaram o clima de guerra.</li><li>O sistema de alianças transformou uma crise regional em conflito mundial.</li><li>As duras condições impostas à Alemanha ajudaram a preparar a <strong>Segunda Guerra Mundial</strong>.</li></ul>',
        ]),
    ],
    [
        'titulo' => 'Napoleão Bonaparte: do Consulado ao Império',
        'resumo' => 'Filho da Revolução Francesa e coroado imperador em 1804, Napoleão espalhou pela Europa códigos de leis modernos e, ao mesmo tempo, um projeto de dominação militar. O artigo percorre sua ascensão, o Código Civil, o Bloqueio Continental e os efeitos de suas guerras — inclusive a vinda da família real portuguesa ao Brasil.',
        'categoria' => 'História Moderna',
        'imagem' => 'napoleao.jpg',
        'tempo_leitura' => '6 min',
        'data' => '5 maio 2025',
        'autor' => 'Camila',
        'tags' => ['Napoleão', 'Revolução Francesa', 'Bloqueio Continental', 'Família Real no Brasil'],
        'conteudo' => implode('', [
            '<h3>A ascensão ao poder</h3>',
            '<p>Napoleão Bonaparte ganhou prestígio como general durante as guerras revolucionárias francesas. Em 1799, aproveitando a instabilidade do Diretório, liderou o golpe do <strong>18 de Brumário</strong> e assumiu o poder como <em>Primeiro Cônsul</em>.</p>',
            '<p>No Consulado, reorganizou a administração, criou o Banco da França, reconciliou o Estado com a Igreja Católica e, em 1804, promulgou o <strong>Código Civil</strong>, que consolidou a igualdade perante a lei e o direito à propriedade. No mesmo ano, coroou-se imperador.</p>',
            '<h3>O império e o Bloqueio Continental</h3>',
            '<p>À frente de exércitos numerosos e bem organizados, Napoleão venceu batalhas como a de Austerlitz e passou a controlar grande parte da Europa continental. Para enfraquecer a Inglaterra, decretou em 1806 o <strong>Bloqueio Continental</strong>, que proibia os países europeus de comerciar com os britânicos.</p>',
            '<p>Portugal, aliado comercial da Inglaterra, não aderiu ao bloqueio e foi invadido pelas tropas francesas. Em 1807, a <strong>família real portuguesa</strong> transferiu-se para o Brasil, episódio que levaria à abertura dos portos e, anos depois, à independência brasileira.</p>',
            '<h3>Declínio e legado</h3>',
            '<p>A desastrosa campanha contra a Rússia, em 1812, marcou o início do declínio. Derrotado em Leipzig e depois em <strong>Waterloo</strong>, em 1815, Napoleão morreu exilado na ilha de Santa Helena. O Congresso de Viena tentou restaurar a antiga ordem, mas as ideias difundidas por suas conquistas continuaram a transformar a Europa.</p>',
            '<blockquote><p>A vinda da corte portuguesa ao Brasil, em 1808, é uma consequência direta da política de Napoleão na Europa.</p></blockquote>',
        ]),
    ],
    [
        'titulo' => 'Sócrates e o Nascimento da Filosofia em Atenas',
        'resumo' => 'Condenado a beber cicuta em 399 a.C., Sócrates tornou-se o símbolo do pensamento crítico. O artigo situa o filósofo na Atenas democrática, explica o método socrático e discute por que suas perguntas incomodaram tanto os cidadãos de sua época.',
        'categoria' => 'Antiguidade',
        'imagem' => 'cicuta.jpg',
        'tempo_leitura' => '5 min',
        'data' => '28 abr 2025',
        'autor' => 'Victor',
        'tags' => ['Grécia Antiga', 'Filosofia', 'Democracia Ateniense', 'Sócrates'],
        'conteudo' => implode('', [
            '<h3>Atenas no século V a.C.</h3>',
            '<p>No século V a.C., Atenas vivia seu auge político e cultural. Após as vitórias nas Guerras Médicas, a cidade consolidou a democracia, construiu o Partenon e atraiu artistas, oradores e pensadores de todo o mundo grego.</p>',
            '<p>Nesse ambiente, Sócrates circulava pela <strong>ágora</strong> conversando com jovens e cidadãos. Ele não escreveu nenhuma obra: o que sabemos de suas ideias vem principalmente dos diálogos de seu discípulo <strong>Platão</strong>.</p>',
            '<h3>O método socrático</h3>',
            '<p>Seu método consistia em fazer perguntas sucessivas até revelar as contradições nas opiniões do interlocutor. A célebre frase <em>"só sei que nada sei"</em> resume a atitude de reconhecer a própria ignorância como ponto de partida para buscar o conhecimento.</p>',
            '<h3>Julgamento e morte</h3>',
            '<p>Depois da derrota de Atenas na Guerra do Peloponeso, o clima político ficou tenso. Em <strong>399 a.C.</strong>, Sócrates foi acusado de corromper a juventude e de não reconhecer os deuses da cidade. Julgado por um tribunal popular, foi condenado à morte e bebeu <strong>cicuta</strong>.</p>',
            '<p>A morte de Sócrates, retratada séculos depois por pintores como Jacques-Louis David, tornou-se um símbolo da defesa da liberdade de pensamento. Seus discípulos, especialmente <strong>Platão</strong> e, depois, Aristóteles, deram origem às grandes tradições da filosofia ocidental.</p>',
            '<h3>O método em três passos</h3><ol><li>Partir de uma opinião do interlocutor.</li><li>Fazer perguntas que revelem <em>contradições</em>.</li><li>Reconhecer a ignorância e buscar uma definição melhor.</li></ol>',
        ]),
    ],
    [
        'titulo' => 'A Morte de Júlio César e o Fim da República Romana',
        'resumo' => 'Nos Idos de Março de 44 a.C., Júlio César foi assassinado por senadores que diziam defender a República. O artigo explica as tensões que levaram ao crime e mostra como sua morte, em vez de salvar as instituições republicanas, abriu caminho para o Império de Otávio Augusto.',
        'categoria' => 'Antiguidade',
        'imagem' => 'romano.jpg',
        'tempo_leitura' => '6 min',
        'data' => '21 abr 2025',
        'autor' => 'Camila',
        'tags' => ['Roma', 'República Romana', 'Júlio César', 'Império Romano'],
        'conteudo' => implode('', [
            '<h3>A crise da República</h3>',
            '<p>No século I a.C., a República Romana enfrentava uma crise profunda. As conquistas haviam enriquecido uma pequena elite, enquanto camponeses perdiam suas terras, e generais passaram a comandar exércitos mais fiéis a eles do que ao Senado.</p>',
            '<p>Júlio César construiu sua popularidade com as vitórias na Gália e com medidas favoráveis à plebe. Em 49 a.C., desafiou o Senado ao atravessar o <strong>rio Rubicão</strong> com suas tropas, iniciando uma guerra civil contra Pompeu, da qual saiu vitorioso.</p>',
            '<h3>César no poder</h3>',
            '<p>Nomeado <strong>ditador perpétuo</strong>, César concentrou poderes, reformou o calendário e ampliou o número de senadores. Para parte da aristocracia, essas medidas indicavam que ele pretendia se tornar rei, algo inaceitável na tradição republicana.</p>',
            '<h3>O assassinato e suas consequências</h3>',
            '<p>Em <strong>15 de março de 44 a.C.</strong>, um grupo de senadores liderado por Bruto e Cássio o apunhalou durante uma sessão do Senado. Os conspiradores esperavam restaurar a República, mas o assassinato provocou uma nova onda de guerras civis.</p>',
            '<p>Da disputa entre Marco Antônio e Otávio, herdeiro de César, saiu vencedor Otávio. Em 27 a.C., ele recebeu o título de <strong>Augusto</strong> e tornou-se o primeiro imperador romano, mantendo a aparência das instituições republicanas, mas concentrando o poder em suas mãos.</p>',
            '<h3>Personagens</h3><ul><li><strong>Júlio César</strong> — general e ditador perpétuo.</li><li><strong>Bruto e Cássio</strong> — líderes da conspiração.</li><li><strong>Otávio Augusto</strong> — primeiro imperador romano.</li></ul>',
        ]),
    ],
];

$niveis_curso = ['basico' => 'Básico', 'intermediario' => 'Intermediário', 'avancado' => 'Avançado'];

$cursos = [
    [
        'id' => 1, 'titulo' => 'Era Vargas (1930 - 1945)', 'slug' => 'era-vargas', 'imagem' => '../imagens/getulio.png',
        'categoria' => 'História do Brasil', 'nivel' => 'intermediario', 'carga_horaria' => '14 h', 'professor' => 'Victor Almeida',
        'descricao' => 'Da Revolução de 1930 ao fim do Estado Novo: a ascensão de Getúlio Vargas, as leis trabalhistas e a centralização do poder.',
        'tags' => ['Getúlio Vargas', 'Estado Novo', 'CLT', 'República'],
        'alunos' => 0, 'status' => 'publicado',
    ],
    [
        'id' => 2, 'titulo' => 'Idade Moderna e Renascimento', 'slug' => 'idade-moderna', 'imagem' => '../imagens/filosofia.png',
        'categoria' => 'História Geral', 'nivel' => 'basico', 'carga_horaria' => '10 h', 'professor' => 'Camila Rodrigues',
        'descricao' => 'Renascimento, Reforma Protestante, absolutismo e Grandes Navegações: as transformações que inauguraram o mundo moderno.',
        'tags' => ['Renascimento', 'Reforma Protestante', 'Absolutismo', 'Grandes Navegações'],
        'alunos' => 0, 'status' => 'publicado',
    ],
    [
        'id' => 3, 'titulo' => 'Ditadura Militar no Brasil (1964-1985)', 'slug' => 'ditadura-militar', 'imagem' => '../imagens/ditadura.png',
        'categoria' => 'História do Brasil', 'nivel' => 'avancado', 'carga_horaria' => '12 h', 'professor' => 'Victor Almeida',
        'descricao' => 'O golpe de 1964, os anos de chumbo, o "milagre econômico" e a redemocratização do país.',
        'tags' => ['Golpe de 1964', 'AI-5', 'Milagre Econômico', 'Diretas Já'],
        'alunos' => 0, 'status' => 'publicado',
    ],
    [
        'id' => 4, 'titulo' => 'Brasil Colônia (1530-1822)', 'slug' => 'brasil-colonia', 'imagem' => '../imagens/colonial.png',
        'categoria' => 'História do Brasil', 'nivel' => 'basico', 'carga_horaria' => '11 h', 'professor' => 'Camila Rodrigues',
        'descricao' => 'Capitanias hereditárias, economia açucareira, invasões estrangeiras e o ciclo do ouro em Minas Gerais.',
        'tags' => ['Capitanias Hereditárias', 'Ciclo do Açúcar', 'Ciclo do Ouro', 'Colonização'],
        'alunos' => 0, 'status' => 'publicado',
    ],
    [
        'id' => 5, 'titulo' => 'Antiguidade Clássica (Grécia e Roma)', 'slug' => 'antiguidade-classica', 'imagem' => '../imagens/roma.png',
        'categoria' => 'História Geral', 'nivel' => 'basico', 'carga_horaria' => '9 h', 'professor' => 'Camila Rodrigues',
        'descricao' => 'A pólis grega, a democracia ateniense e a trajetória de Roma da República à queda do Império do Ocidente.',
        'tags' => ['Grécia Antiga', 'Democracia Ateniense', 'Roma', 'Império Romano'],
        'alunos' => 0, 'status' => 'publicado',
    ],
    [
        'id' => 6, 'titulo' => 'Guerra Fria (1945 - tempos atuais)', 'slug' => 'guerra-fria', 'imagem' => '../imagens/guerrafria.png',
        'categoria' => 'História Geral', 'nivel' => 'intermediario', 'carga_horaria' => '10 h', 'professor' => 'Victor Almeida',
        'descricao' => 'A disputa entre Estados Unidos e União Soviética, a corrida armamentista, os conflitos por procuração e a queda do Muro de Berlim.',
        'tags' => ['Guerra Fria', 'EUA', 'URSS', 'Muro de Berlim'],
        'alunos' => 0, 'status' => 'publicado',
    ],
];

$notificacoes = [
    [
        'id' => 1,
        'tipo' => 'modulo',
        'titulo' => 'Novo módulo liberado: Brasil Império',
        'descricao' => 'O conteúdo completo sobre o período imperial brasileiro já está disponível, incluindo exercícios comentados e mapas mentais.',
        'tempo' => 'Há 2 horas',
        'status' => 'urgente',
        'autor' => 'Equipe Pedagógica Alexandria',
        'categoria' => 'Novo conteúdo',
        'tempo_leitura' => '3 min',
        'atualizado_em' => '2026-09-15',
        'acao' => ['rotulo' => 'Ver cursos', 'link' => 'visualizar-curso.php'],
        'secoes' => [
            [
                'titulo' => 'O que foi liberado',
                'icone' => 'fa-solid fa-crown',
                'paragrafos' => [
                    'O módulo Brasil Império cobre o período de 1822 a 1889, da Independência à Proclamação da República. O conteúdo está dividido entre o Período Regencial, o Segundo Reinado e a crise final da monarquia.',
                    'Cada aula traz um resumo em texto, videoaula e uma lista de exercícios comentados com questões de vestibulares e concursos.',
                ],
            ],
            [
                'titulo' => 'Materiais de apoio',
                'icone' => 'fa-solid fa-diagram-project',
                'paragrafos' => [
                    'Além das aulas, o módulo inclui mapas mentais para revisão rápida dos principais temas: revoltas regenciais, política externa, economia cafeeira e o processo abolicionista.',
                ],
            ],
            [
                'titulo' => 'Como começar',
                'icone' => 'fa-solid fa-play',
                'paragrafos' => [
                    'Acesse a área de cursos disponíveis e inicie o módulo. O seu progresso fica salvo e pode ser acompanhado em Meus cursos.',
                ],
            ],
        ],
    ],
    [
        'id' => 2,
        'tipo' => 'simulado',
        'titulo' => 'Simulado ENEM de História disponível',
        'descricao' => 'Um novo simulado focado em História Geral e História do Brasil foi adicionado à plataforma com correção automática.',
        'tempo' => 'Há 4 horas',
        'status' => 'nao_lida',
        'autor' => 'Coordenação de Avaliações',
        'categoria' => 'Simulados',
        'tempo_leitura' => '2 min',
        'atualizado_em' => '2026-09-15',
        'acao' => ['rotulo' => 'Ver provas do ENEM', 'link' => 'visualizar-prova.php?banca=enem'],
        'secoes' => [
            [
                'titulo' => 'Sobre o simulado',
                'icone' => 'fa-solid fa-clipboard-list',
                'paragrafos' => [
                    'O simulado reúne 45 questões no formato do ENEM, equilibrando História Geral e História do Brasil, com enunciados interpretativos e uso de fontes históricas.',
                ],
            ],
            [
                'titulo' => 'Correção automática',
                'icone' => 'fa-solid fa-check-double',
                'paragrafos' => [
                    'Ao finalizar, você recebe a nota na hora, o gabarito comentado de cada questão e um resumo dos temas em que teve mais dificuldade.',
                    'Recomendamos reservar cerca de 1 hora e 30 minutos para realizar a prova em condições próximas às do exame.',
                ],
            ],
        ],
    ],
    [
        'id' => 3,
        'tipo' => 'atualizacao',
        'titulo' => 'Atualização na trilha de Revolução Francesa',
        'descricao' => 'Adicionamos novas videoaulas e artigos complementares sobre o contexto político e social da Revolução Francesa.',
        'tempo' => 'Há 1 dia',
        'status' => 'nao_lida',
        'autor' => 'Equipe de Conteúdo',
        'categoria' => 'Atualização',
        'tempo_leitura' => '4 min',
        'atualizado_em' => '2026-09-14',
        'acao' => ['rotulo' => 'Ler o artigo', 'link' => 'visualizar-artigo.php?id=1'],
        'secoes' => [
            [
                'titulo' => 'Novas videoaulas',
                'icone' => 'fa-solid fa-video',
                'paragrafos' => [
                    'Foram adicionadas três videoaulas: a crise do Antigo Regime, a fase da Convenção e o período do Diretório até a ascensão de Napoleão.',
                ],
            ],
            [
                'titulo' => 'Artigos complementares',
                'icone' => 'fa-solid fa-book-open',
                'paragrafos' => [
                    'Os novos artigos aprofundam o papel da burguesia, dos sans-culottes e dos camponeses, além de discutir a influência do Iluminismo nos ideais revolucionários.',
                    'Todo o material foi revisado com base nas questões mais cobradas nos últimos vestibulares.',
                ],
            ],
        ],
    ],
    [
        'id' => 4,
        'tipo' => 'conquista',
        'titulo' => 'Parabéns! Meta semanal concluída',
        'descricao' => 'Você estudou por 7 dias consecutivos. Continue assim e alcance seus objetivos!',
        'tempo' => 'Há 1 dia',
        'status' => 'lida',
        'autor' => 'Alexandria',
        'categoria' => 'Conquistas',
        'tempo_leitura' => '1 min',
        'atualizado_em' => '2026-09-14',
        'acao' => ['rotulo' => 'Continuar estudando', 'link' => 'visualizar-curso.php'],
        'secoes' => [
            [
                'titulo' => 'Sequência de 7 dias',
                'icone' => 'fa-solid fa-fire',
                'paragrafos' => [
                    'Você acessou a plataforma e concluiu atividades durante sete dias seguidos. A constância é um dos fatores que mais contribuem para a aprovação.',
                ],
            ],
            [
                'titulo' => 'Próximo objetivo',
                'icone' => 'fa-solid fa-bullseye',
                'paragrafos' => [
                    'Mantenha o ritmo por mais uma semana para desbloquear a conquista de 14 dias consecutivos.',
                ],
            ],
        ],
    ],
    [
        'id' => 5,
        'tipo' => 'chat',
        'titulo' => 'Nova mensagem do Chat AI',
        'descricao' => 'Seu assistente de estudos tem uma resposta para a sua última pergunta.',
        'tempo' => 'Há 2 dias',
        'status' => 'lida',
        'autor' => 'Chat AI Alexandria',
        'categoria' => 'Assistente de estudos',
        'tempo_leitura' => '2 min',
        'atualizado_em' => '2026-09-13',
        'acao' => ['rotulo' => 'Abrir o Chat AI', 'link' => '../comuns/chatai.php'],
        'secoes' => [
            [
                'titulo' => 'Resposta disponível',
                'icone' => 'fa-solid fa-comments',
                'paragrafos' => [
                    'O assistente respondeu à sua pergunta sobre as diferenças entre o Período Regencial e o Segundo Reinado, com um resumo dos principais acontecimentos de cada fase.',
                ],
            ],
            [
                'titulo' => 'Dica de estudo',
                'icone' => 'fa-solid fa-lightbulb',
                'paragrafos' => [
                    'Você pode pedir ao Chat AI questões de treino sobre o tema ou um mapa mental para revisar o conteúdo antes das provas.',
                ],
            ],
        ],
    ],
];

$bannerTipos = [
    'modulo'      => ['inicio' => '#5e1220', 'fim' => '#a0283a', 'destaque' => '#d4af37', 'icone' => 'fa-solid fa-book-open',        'rotulo' => 'Novo módulo'],
    'simulado'    => ['inicio' => '#5c4611', 'fim' => '#a8841f', 'destaque' => '#f0d060', 'icone' => 'fa-solid fa-clipboard-list',   'rotulo' => 'Simulado'],
    'atualizacao' => ['inicio' => '#6b1f15', 'fim' => '#b0463a', 'destaque' => '#f1c3bc', 'icone' => 'fa-solid fa-building-columns', 'rotulo' => 'Atualização'],
    'conquista'   => ['inicio' => '#1f5132', 'fim' => '#3d8b57', 'destaque' => '#cbe8d3', 'icone' => 'fa-solid fa-trophy',           'rotulo' => 'Conquista'],
    'chat'        => ['inicio' => '#352c6b', 'fim' => '#6a5cb8', 'destaque' => '#dcd6f0', 'icone' => 'fa-solid fa-robot',            'rotulo' => 'Chat AI'],
];

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

$bancas_questoes = [
    'ENEM' => 'enem', 'FUVEST' => 'fuvest', 'UNICAMP' => 'unicamp', 'UNESP' => 'unesp',
    'FGV' => 'fgv', 'CEBRASPE' => 'cebraspe', 'VUNESP' => 'vunesp', 'EsPCEx' => 'espcex',
];

$questoes = [
    [
        'id' => 1, 'dificuldade' => 'facil', 'assunto' => 'Revolução Francesa', 'banca' => 'UNICAMP', 'ano' => 2020, 'tipo' => 'dissertativo', 'curso' => 'idade-moderna',
        'fonte'             => 'UNICAMP 2020',
        'enunciado'         => 'Explique de que forma a crise financeira do Estado francês, no final do século XVIII, contribuiu para a eclosão da Revolução Francesa em 1789.',
        'resposta_esperada' => 'A resposta deve citar o endividamento da monarquia francesa (agravado pelo apoio à Independência dos EUA e pelos gastos da corte), a tentativa fracassada de reformar o sistema tributário cobrando impostos da nobreza e do clero, e a consequente convocação dos Estados Gerais em 1789, que desencadeou o processo revolucionário.',
        'explicacao'        => 'A Coroa francesa acumulava uma dívida enorme, em parte por financiar a guerra de independência das treze colônias. As tentativas de reforma fiscal esbarravam nos privilégios da nobreza e do clero, levando à convocação dos Estados Gerais, palco inicial da Revolução.',
        'referencia'        => 'HOBSBAWM, Eric. A Era das Revoluções.',
    ],
    [
        'id' => 2, 'dificuldade' => 'medio', 'assunto' => 'Segunda Guerra', 'banca' => 'FUVEST', 'ano' => 2021, 'tipo' => 'alternativa', 'curso' => 'guerra-fria',
        'fonte'        => 'FUVEST 2021',
        'enunciado'    => 'A Segunda Guerra Mundial (1939-1945) teve início após:',
        'alternativas' => [
            'A invasão da Polônia pela Alemanha nazista, em setembro de 1939.',
            'O ataque japonês a Pearl Harbor, em dezembro de 1941.',
            'A assinatura do Tratado de Versalhes, em 1919.',
            'A Revolução Russa, em 1917.',
        ],
        'correta'    => 0,
        'explicacao' => 'A invasão da Polônia pela Alemanha, em 1º de setembro de 1939, levou França e Reino Unido a declararem guerra à Alemanha, marcando o início oficial do conflito na Europa.',
        'referencia' => 'HOBSBAWM, Eric. Era dos Extremos.',
    ],
    [
        'id' => 3, 'dificuldade' => 'medio', 'assunto' => 'Estado Novo', 'banca' => 'CEBRASPE', 'ano' => 2015, 'tipo' => 'alternativa', 'curso' => 'era-vargas',
        'fonte'        => 'CEBRASPE 2015',
        'enunciado'    => 'O Estado Novo, período da Era Vargas iniciado em 1937, caracterizou-se por:',
        'alternativas' => [
            'Ampla liberdade de imprensa e eleições diretas regulares.',
            'Centralização do poder no Executivo, censura e forte propaganda estatal.',
            'Descentralização política em favor dos estados da federação.',
            'Adoção do parlamentarismo como forma de governo.',
        ],
        'correta'    => 1,
        'explicacao' => 'Com a outorga da Constituição de 1937, Vargas fechou o Congresso, extinguiu os partidos políticos e criou o DIP (Departamento de Imprensa e Propaganda) para controlar a informação e promover o culto à sua imagem.',
        'referencia' => 'FAUSTO, Boris. História do Brasil. São Paulo: Edusp, 2018.',
        'imagem'     => '../imagens/estado-novo.png',
    ],
    [
        'id' => 4, 'dificuldade' => 'medio', 'assunto' => 'Ditadura Militar', 'banca' => 'UNICAMP', 'ano' => 2017, 'tipo' => 'dissertativo', 'curso' => 'ditadura-militar',
        'fonte'             => 'UNICAMP 2017',
        'enunciado'         => 'Caracterize o Ato Institucional nº 5 (AI-5), de 1968, e explique seu impacto na vida política brasileira durante a ditadura militar.',
        'resposta_esperada' => 'A resposta deve mencionar que o AI-5 suspendeu garantias constitucionais (como o habeas corpus para crimes políticos), permitiu ao Executivo fechar o Congresso e cassar mandatos, e ampliou a censura e a repressão, dando início à fase mais dura do regime, conhecida como "anos de chumbo".',
        'explicacao'        => 'O AI-5 concentrou poderes no Executivo e suprimiu garantias individuais, sendo um marco no recrudescimento da repressão política durante o regime militar brasileiro.',
        'referencia'        => 'GASPARI, Elio. A Ditadura Escancarada.',
    ],
    [
        'id' => 5, 'dificuldade' => 'facil', 'assunto' => 'Primeira Guerra Mundial', 'banca' => 'UNESP', 'ano' => 2019, 'tipo' => 'alternativa',
        'fonte'        => 'UNESP 2019',
        'enunciado'    => 'O estopim da Primeira Guerra Mundial (1914-1918) foi:',
        'alternativas' => [
            'A invasão da Bélgica pela Alemanha.',
            'O assassinato do arquiduque Francisco Ferdinando, em Sarajevo.',
            'O ataque a Pearl Harbor.',
            'A Revolução Bolchevique de 1917.',
        ],
        'correta'    => 1,
        'explicacao' => 'O assassinato do arquiduque Francisco Ferdinando, herdeiro do trono austro-húngaro, em junho de 1914, acionou o sistema de alianças militares europeu e desencadeou o conflito.',
        'referencia' => 'HOBSBAWM, Eric. Era dos Extremos.',
        'imagem'     => '../imagens/guerra.jpg',
    ],
    [
        'id' => 6, 'dificuldade' => 'medio', 'assunto' => 'Era Vargas', 'banca' => 'FUVEST', 'ano' => 2023, 'tipo' => 'alternativa', 'curso' => 'era-vargas',
        'fonte'        => 'FUVEST 2023',
        'enunciado'    => 'O governo de Getúlio Vargas (1930–1945) ficou marcado por medidas que transformaram as relações entre o Estado e a sociedade brasileira. Assinale a alternativa que melhor representa uma dessas medidas.',
        'alternativas' => [
            'Criação da Constituição de 1891, que estabeleceu o federalismo brasileiro.',
            'Política de valorização do café por meio do Convênio de Taubaté.',
            'Criação da Consolidação das Leis do Trabalho (CLT).',
            'Adoção do parlamentarismo como forma de governo.',
            'Privatização de empresas estatais para reduzir a intervenção do Estado.',
        ],
        'correta'    => 2,
        'explicacao' => 'O governo Vargas promoveu diversas reformas trabalhistas, sendo a Consolidação das Leis do Trabalho (CLT), criada em 1943, uma das principais. Ela unificou a legislação trabalhista e garantiu direitos como férias, jornada de trabalho limitada e proteção ao trabalhador.',
        'referencia' => 'FAUSTO, Boris. História do Brasil. São Paulo: Edusp, 2018.',
        'imagem'     => '../imagens/vargas.jpg',
    ],
    [
        'id' => 7, 'dificuldade' => 'facil', 'assunto' => 'Revolução de 1930', 'banca' => 'VUNESP', 'ano' => 2022, 'tipo' => 'alternativa', 'curso' => 'era-vargas',
        'fonte'        => 'VUNESP 2022',
        'enunciado'    => 'A Revolução de 1930, que levou Getúlio Vargas ao poder, está diretamente relacionada:',
        'alternativas' => [
            'À ruptura da política do café com leite e à crise econômica de 1929.',
            'À vitória de Júlio Prestes com apoio de todos os estados.',
            'À proclamação da República e ao exílio de D. Pedro II.',
            'Ao fim da Segunda Guerra Mundial e à deposição de Vargas.',
        ],
        'correta'    => 0,
        'explicacao' => 'A indicação do paulista Júlio Prestes por Washington Luís rompeu o revezamento entre São Paulo e Minas Gerais. Somada aos efeitos da crise de 1929 sobre o café, essa ruptura uniu Minas, Rio Grande do Sul e Paraíba na Aliança Liberal, que chegou ao poder pelas armas.',
        'referencia' => 'FAUSTO, Boris. A Revolução de 1930: historiografia e história.',
        'imagem'     => '../imagens/getuliovargas.png',
    ],
    [
        'id' => 8, 'dificuldade' => 'medio', 'assunto' => 'Era Vargas', 'banca' => 'ENEM', 'ano' => 2025, 'tipo' => 'dissertativo', 'curso' => 'era-vargas',
        'fonte'             => 'ENEM 2025 (questão adaptada)',
        'enunciado'         => 'Getúlio Vargas ficou conhecido como "pai dos pobres", embora seu governo também tenha sido marcado pela repressão. Analise essa contradição, citando ao menos uma medida social e uma medida autoritária do período.',
        'resposta_esperada' => 'Espera-se que o aluno cite medidas sociais como a criação do salário mínimo (1940), da Carteira de Trabalho e da CLT (1943), e medidas autoritárias como o fechamento do Congresso e a censura do DIP no Estado Novo, relacionando-as ao trabalhismo e ao controle dos sindicatos pelo Estado.',
        'explicacao'        => 'O trabalhismo varguista combinou a concessão de direitos aos trabalhadores urbanos com o controle dos sindicatos pelo Ministério do Trabalho e com a propaganda oficial, construindo apoio popular ao mesmo tempo em que limitava a oposição.',
        'referencia'        => 'GOMES, Angela de Castro. A invenção do trabalhismo.',
    ],
    [
        'id' => 9, 'dificuldade' => 'medio', 'assunto' => 'Constituição de 1934', 'banca' => 'CEBRASPE', 'ano' => 2015, 'tipo' => 'alternativa', 'curso' => 'era-vargas',
        'fonte'        => 'CEBRASPE 2015',
        'enunciado'    => 'Entre as novidades trazidas pela Constituição de 1934, destaca-se:',
        'alternativas' => [
            'A instituição do voto secreto e do voto feminino.',
            'O fim do sistema federativo no Brasil.',
            'A criação do Poder Moderador.',
            'A proibição de qualquer legislação trabalhista.',
        ],
        'correta'    => 0,
        'explicacao' => 'Influenciada pela Revolução Constitucionalista de 1932, a Constituição de 1934 incorporou o voto secreto e o voto feminino, já previstos no Código Eleitoral de 1932, além de criar a Justiça Eleitoral e garantir direitos trabalhistas.',
        'referencia' => 'FAUSTO, Boris. História do Brasil. São Paulo: Edusp, 2018.',
    ],
    [
        'id' => 10, 'dificuldade' => 'facil', 'assunto' => 'Renascimento', 'banca' => 'ENEM', 'ano' => 2020, 'tipo' => 'alternativa', 'curso' => 'idade-moderna',
        'fonte'        => 'ENEM 2020 - Dia 1',
        'enunciado'    => 'O Renascimento cultural, iniciado nas cidades italianas entre os séculos XIV e XVI, caracterizou-se principalmente pelo:',
        'alternativas' => [
            'Abandono completo da religião e da arte sacra.',
            'Antropocentrismo e pela valorização da cultura greco-romana.',
            'Retorno às técnicas artísticas da arte bizantina.',
            'Rejeição do estudo da natureza e da matemática.',
        ],
        'correta'    => 1,
        'explicacao' => 'Os renascentistas colocaram o ser humano no centro das reflexões (antropocentrismo) e buscaram inspiração na Antiguidade Clássica, sem abandonar os temas religiosos, como mostram as obras de Michelangelo, Rafael e Perugino.',
        'referencia' => 'BURKE, Peter. O Renascimento italiano.',
        'imagem'     => '../imagens/chaves.jpg',
    ],
    [
        'id' => 11, 'dificuldade' => 'medio', 'assunto' => 'Reforma Protestante', 'banca' => 'FUVEST', 'ano' => 2018, 'tipo' => 'alternativa', 'curso' => 'idade-moderna',
        'fonte'        => 'FUVEST 2018',
        'enunciado'    => 'Em 1517, Martinho Lutero publicou suas 95 teses. Entre as críticas feitas por Lutero à Igreja Católica estava:',
        'alternativas' => [
            'A defesa da venda de indulgências como forma de salvação.',
            'A condenação da tradução da Bíblia para as línguas nacionais.',
            'A crítica à venda de indulgências e a defesa da salvação pela fé.',
            'A exigência de que o papa tivesse poder sobre os reis.',
        ],
        'correta'    => 2,
        'explicacao' => 'Lutero atacou a venda de indulgências e defendeu que a salvação viria pela fé, e não pelas obras ou pagamentos. Também traduziu a Bíblia para o alemão, estimulando a leitura individual das escrituras.',
        'referencia' => 'DELUMEAU, Jean. Nascimento e afirmação da Reforma.',
        'imagem'     => '../imagens/vocacao.jpg',
    ],
    [
        'id' => 12, 'dificuldade' => 'facil', 'assunto' => 'Grandes Navegações', 'banca' => 'UNESP', 'ano' => 2017, 'tipo' => 'alternativa', 'curso' => 'idade-moderna',
        'fonte'        => 'UNESP 2017',
        'enunciado'    => 'O pioneirismo português nas Grandes Navegações dos séculos XV e XVI é explicado, entre outros fatores:',
        'alternativas' => [
            'Pela ausência de interesse comercial da burguesia lusitana.',
            'Pela centralização política precoce e pela posição geográfica favorável.',
            'Pelo isolamento de Portugal em relação ao comércio mediterrâneo.',
            'Pela proibição da Igreja às expedições marítimas.',
        ],
        'correta'    => 1,
        'explicacao' => 'Portugal centralizou o poder real ainda no século XIV (Revolução de Avis), contava com uma burguesia mercantil interessada no comércio com o Oriente e tinha localização estratégica voltada para o Atlântico.',
        'referencia' => 'BOXER, Charles. O Império Marítimo Português.',
        'imagem'     => '../imagens/image 100.png',
    ],
    [
        'id' => 13, 'dificuldade' => 'medio', 'assunto' => 'Golpe de 1964', 'banca' => 'ENEM', 'ano' => 2020, 'tipo' => 'alternativa', 'curso' => 'ditadura-militar',
        'fonte'        => 'ENEM 2020 - Dia 1',
        'enunciado'    => 'O golpe civil-militar que depôs o presidente João Goulart, em 1964, ocorreu em um contexto marcado:',
        'alternativas' => [
            'Pelo fim da Guerra Fria e pela queda do Muro de Berlim.',
            'Pela polarização da Guerra Fria e pela oposição às Reformas de Base.',
            'Pelo apoio unânime do Congresso às propostas do governo.',
            'Pela vitória eleitoral de Jânio Quadros sobre os militares.',
        ],
        'correta'    => 1,
        'explicacao' => 'As Reformas de Base propostas por Jango (agrária, urbana, educacional) eram vistas por setores empresariais, militares e pelos Estados Unidos como uma ameaça comunista, no auge da polarização da Guerra Fria.',
        'referencia' => 'NAPOLITANO, Marcos. 1964: História do Regime Militar Brasileiro.',
        'imagem'     => '../imagens/ditadura.png',
    ],
    [
        'id' => 14, 'dificuldade' => 'medio', 'assunto' => 'Redemocratização', 'banca' => 'FGV', 'ano' => 2021, 'tipo' => 'alternativa', 'curso' => 'ditadura-militar',
        'fonte'        => 'FGV 2021',
        'enunciado'    => 'O movimento Diretas Já (1983-1984) reuniu milhões de pessoas em comícios pelo país. Seu principal objetivo era:',
        'alternativas' => [
            'A volta da monarquia parlamentarista.',
            'A aprovação da emenda que restabelecia eleições diretas para presidente.',
            'A prorrogação do mandato do presidente Figueiredo.',
            'A extinção dos partidos políticos de oposição.',
        ],
        'correta'    => 1,
        'explicacao' => 'O movimento apoiava a Emenda Dante de Oliveira, que restabeleceria as eleições diretas para presidente. Apesar da mobilização, a emenda foi rejeitada em 1984, e Tancredo Neves foi eleito indiretamente pelo Colégio Eleitoral no ano seguinte.',
        'referencia' => 'NAPOLITANO, Marcos. 1964: História do Regime Militar Brasileiro.',
    ],
    [
        'id' => 15, 'dificuldade' => 'facil', 'assunto' => 'Capitanias Hereditárias', 'banca' => 'UNESP', 'ano' => 2016, 'tipo' => 'alternativa', 'curso' => 'brasil-colonia',
        'fonte'        => 'UNESP 2016',
        'enunciado'    => 'O sistema de capitanias hereditárias, implantado pela Coroa portuguesa a partir de 1534, tinha como objetivo:',
        'alternativas' => [
            'Transferir a particulares os custos da ocupação e defesa do território.',
            'Garantir a autonomia política total da colônia em relação a Portugal.',
            'Impedir o cultivo da cana-de-açúcar no litoral.',
            'Distribuir terras igualmente entre os povos indígenas.',
        ],
        'correta'    => 0,
        'explicacao' => 'Sem recursos para colonizar todo o território, a Coroa entregou faixas de terra a donatários, que deveriam povoar, explorar e defender a região às próprias custas. O fracasso da maioria delas levou à criação do Governo-Geral em 1548.',
        'referencia' => 'FAUSTO, Boris. História do Brasil. São Paulo: Edusp, 2018.',
        'imagem'     => '../imagens/colonial.png',
    ],
    [
        'id' => 16, 'dificuldade' => 'medio', 'assunto' => 'Ciclo do Ouro', 'banca' => 'ENEM', 'ano' => 2020, 'tipo' => 'alternativa', 'curso' => 'brasil-colonia',
        'fonte'        => 'ENEM 2020 - Dia 1',
        'enunciado'    => 'A descoberta de ouro em Minas Gerais, no final do século XVII, provocou na colônia:',
        'alternativas' => [
            'O esvaziamento populacional da região Sudeste.',
            'O deslocamento do eixo econômico para o Centro-Sul e a transferência da capital para o Rio de Janeiro.',
            'O fim imediato do tráfico de africanos escravizados.',
            'A redução do controle fiscal da Coroa portuguesa.',
        ],
        'correta'    => 1,
        'explicacao' => 'A mineração atraiu grande número de pessoas para Minas Gerais, estimulou o comércio interno e levou a capital a ser transferida de Salvador para o Rio de Janeiro em 1763. A Coroa ampliou a fiscalização com o quinto e as Casas de Fundição.',
        'referencia' => 'SOUZA, Laura de Mello e. Desclassificados do Ouro.',
    ],
    [
        'id' => 17, 'dificuldade' => 'dificil', 'assunto' => 'Invasões Holandesas', 'banca' => 'FUVEST', 'ano' => 2018, 'tipo' => 'dissertativo', 'curso' => 'brasil-colonia',
        'fonte'             => 'FUVEST 2018 - Fase 2',
        'enunciado'         => 'Relacione a União Ibérica (1580-1640) à ocupação holandesa em Pernambuco (1630-1654), explicando os interesses econômicos envolvidos.',
        'resposta_esperada' => 'O aluno deve explicar que, com a União Ibérica, Portugal passou ao domínio espanhol e herdou os inimigos da Espanha, entre eles os Países Baixos. Proibidos de comerciar o açúcar brasileiro, os holandeses, por meio da Companhia das Índias Ocidentais, ocuparam Pernambuco para controlar a produção açucareira, sendo expulsos na Insurreição Pernambucana.',
        'explicacao'        => 'Os holandeses financiavam e refinavam boa parte do açúcar produzido no Brasil. A ocupação de Pernambuco, com o governo de Maurício de Nassau, buscou garantir diretamente o acesso a esse produto.',
        'referencia'        => 'MELLO, Evaldo Cabral de. O Negócio do Brasil.',
    ],
    [
        'id' => 18, 'dificuldade' => 'facil', 'assunto' => 'Democracia Ateniense', 'banca' => 'FGV', 'ano' => 2021, 'tipo' => 'alternativa', 'curso' => 'antiguidade-classica',
        'fonte'        => 'FGV 2021',
        'enunciado'    => 'Sobre a democracia em Atenas, no século V a.C., é correto afirmar que:',
        'alternativas' => [
            'Todos os habitantes da cidade participavam das decisões políticas.',
            'Apenas cidadãos homens, adultos e livres participavam da Eclésia.',
            'O poder era exercido por um rei escolhido pelos deuses.',
            'Mulheres e estrangeiros tinham os mesmos direitos políticos que os cidadãos.',
        ],
        'correta'    => 1,
        'explicacao' => 'A democracia ateniense era direta, mas excludente: mulheres, estrangeiros (metecos) e escravizados não tinham direitos políticos. Apenas os cidadãos votavam na assembleia, a Eclésia.',
        'referencia' => 'FINLEY, Moses. Democracia Antiga e Moderna.',
        'imagem'     => '../imagens/image 97.png',
    ],
    [
        'id' => 19, 'dificuldade' => 'medio', 'assunto' => 'Império Romano', 'banca' => 'UNICAMP', 'ano' => 2019, 'tipo' => 'alternativa', 'curso' => 'antiguidade-classica',
        'fonte'        => 'UNICAMP 2019',
        'enunciado'    => 'A transição da República para o Império em Roma, consolidada por Otávio Augusto em 27 a.C., foi resultado principalmente:',
        'alternativas' => [
            'De uma invasão estrangeira que destituiu o Senado.',
            'De sucessivas guerras civis e da concentração de poder militar e político.',
            'De uma eleição direta realizada por todos os habitantes do império.',
            'Da adoção do cristianismo como religião oficial.',
        ],
        'correta'    => 1,
        'explicacao' => 'As guerras civis do século I a.C., o assassinato de Júlio César e a disputa entre Otávio e Marco Antônio enfraqueceram as instituições republicanas e permitiram a Otávio concentrar poderes como primeiro imperador.',
        'referencia' => 'BEARD, Mary. SPQR: Uma história da Roma Antiga.',
        'imagem'     => '../imagens/romano.jpg',
    ],
    [
        'id' => 20, 'dificuldade' => 'medio', 'assunto' => 'Guerra Fria', 'banca' => 'ENEM', 'ano' => 2020, 'tipo' => 'alternativa', 'curso' => 'guerra-fria',
        'fonte'        => 'ENEM 2020 - Dia 1',
        'enunciado'    => 'A corrida espacial entre Estados Unidos e União Soviética, durante a Guerra Fria, pode ser entendida como:',
        'alternativas' => [
            'Um projeto de cooperação científica entre as duas potências.',
            'Uma disputa por prestígio tecnológico e demonstração de poder militar.',
            'Uma consequência do fim da Segunda Guerra Mundial sem relação política.',
            'Uma iniciativa da ONU para explorar a Lua de forma conjunta.',
        ],
        'correta'    => 1,
        'explicacao' => 'O lançamento do Sputnik (1957) e a chegada do homem à Lua (1969) eram também demonstrações da capacidade de lançar mísseis e da superioridade de cada sistema, capitalista ou socialista.',
        'referencia' => 'GADDIS, John Lewis. A Guerra Fria.',
        'imagem'     => '../imagens/guerrafria.png',
    ],
    [
        'id' => 21, 'dificuldade' => 'facil', 'assunto' => 'Muro de Berlim', 'banca' => 'EsPCEx', 'ano' => 2019, 'tipo' => 'alternativa', 'curso' => 'guerra-fria',
        'fonte'        => 'EsPCEx 2019',
        'enunciado'    => 'A queda do Muro de Berlim, em 1989, simbolizou:',
        'alternativas' => [
            'O início da Guerra Fria.',
            'O fim da divisão do mundo em blocos capitalista e socialista.',
            'A consolidação do bloco socialista na Europa.',
            'O início da Segunda Guerra Mundial.',
        ],
        'correta'    => 1,
        'explicacao' => 'A queda do muro antecipou a reunificação alemã (1990) e o colapso da União Soviética (1991), marcando o fim da ordem bipolar da Guerra Fria.',
        'referencia' => 'GADDIS, John Lewis. A Guerra Fria.',
    ],
    [
        'id' => 22, 'dificuldade' => 'dificil', 'assunto' => 'Revolução Industrial', 'banca' => 'UNICAMP', 'ano' => 2018, 'tipo' => 'alternativa',
        'fonte'        => 'UNICAMP 2018',
        'enunciado'    => 'A Revolução Industrial, iniciada na Inglaterra no século XVIII, alterou profundamente as relações de trabalho. Uma dessas mudanças foi:',
        'alternativas' => [
            'O fortalecimento das corporações de ofício medievais.',
            'A separação entre o trabalhador e os meios de produção, com a generalização do trabalho assalariado.',
            'A redução da jornada de trabalho para oito horas logo nas primeiras fábricas.',
            'O fim do trabalho infantil nas indústrias têxteis.',
        ],
        'correta'    => 1,
        'explicacao' => 'Nas fábricas, o trabalhador deixou de controlar o processo produtivo e passou a vender sua força de trabalho em troca de salário, submetido a longas jornadas e à disciplina do relógio. Mulheres e crianças eram amplamente empregadas.',
        'referencia' => 'THOMPSON, E. P. A formação da classe operária inglesa.',
        'imagem'     => '../imagens/image 102.png',
    ],
    [
        'id' => 23, 'dificuldade' => 'medio', 'assunto' => 'Canudos', 'banca' => 'UNICAMP', 'ano' => 2012, 'tipo' => 'alternativa',
        'fonte'        => 'UNICAMP 2012',
        'enunciado'    => 'A Guerra de Canudos (1896-1897), no sertão da Bahia, foi retratada pelo governo republicano como:',
        'alternativas' => [
            'Um movimento operário inspirado no anarquismo europeu.',
            'Uma ameaça monarquista à recém-proclamada República.',
            'Uma rebelião de militares contra o presidente Deodoro.',
            'Uma revolta dos cafeicultores paulistas.',
        ],
        'correta'    => 1,
        'explicacao' => 'O arraial liderado por Antônio Conselheiro foi acusado de ser um foco monarquista. Após quatro expedições militares, Canudos foi destruído em 1897, episódio narrado por Euclides da Cunha em Os Sertões.',
        'referencia' => 'CUNHA, Euclides da. Os Sertões.',
    ],
    [
        'id' => 24, 'dificuldade' => 'medio', 'assunto' => 'República Velha', 'banca' => 'VUNESP', 'ano' => 2022, 'tipo' => 'alternativa',
        'fonte'        => 'VUNESP 2022',
        'enunciado'    => 'A chamada "política do café com leite", na Primeira República, consistia:',
        'alternativas' => [
            'No revezamento entre São Paulo e Minas Gerais na indicação dos presidentes.',
            'Na proibição da exportação de café e leite para a Europa.',
            'Na aliança entre operários e camponeses contra os coronéis.',
            'Na divisão igualitária do poder entre todos os estados.',
        ],
        'correta'    => 0,
        'explicacao' => 'As oligarquias de São Paulo (café) e Minas Gerais (leite) alternavam-se na Presidência, apoiadas pela Política dos Governadores e pelo coronelismo, que controlava os votos no interior.',
        'referencia' => 'FAUSTO, Boris. História do Brasil. São Paulo: Edusp, 2018.',
    ],
    [
        'id' => 25, 'dificuldade' => 'medio', 'assunto' => 'Revolução Russa', 'banca' => 'EsPCEx', 'ano' => 2019, 'tipo' => 'alternativa',
        'fonte'        => 'EsPCEx 2019',
        'enunciado'    => 'Em outubro de 1917, os bolcheviques tomaram o poder na Rússia. Entre as primeiras medidas do novo governo liderado por Lenin, destaca-se:',
        'alternativas' => [
            'A entrada da Rússia na Primeira Guerra ao lado da Alemanha.',
            'A retirada da Rússia da Primeira Guerra e a nacionalização de terras e indústrias.',
            'A restauração do poder absoluto do czar Nicolau II.',
            'A adoção imediata de uma economia de livre mercado.',
        ],
        'correta'    => 1,
        'explicacao' => 'Com o lema "paz, terra e pão", os bolcheviques assinaram o Tratado de Brest-Litovsk, retirando a Rússia da guerra, e iniciaram a nacionalização de terras, bancos e indústrias.',
        'referencia' => 'REIS FILHO, Daniel Aarão. As Revoluções Russas e o Socialismo Soviético.',
    ],
];

$textos_dificuldade = ['facil' => 'Fácil', 'medio' => 'Médio', 'dificil' => 'Difícil'];
$textos_tipo        = ['alternativa' => 'Alternativa', 'dissertativo' => 'Dissertativo'];

$provas = [
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2025 - Fase 1 (V1)',
        'dificuldade' => 'Medio', 'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V1', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'A Revolução Francesa (1789) é frequentemente apontada como um marco na transição para o mundo moderno. Sobre esse processo, é correto afirmar que:',
                'alternativas' => [
                    'Manteve intactos os privilégios do clero e da nobreza, sem alterar a estrutura do Antigo Regime.',
                    'Resultou na abolição dos privilégios feudais e na difusão de ideais como liberdade, igualdade e fraternidade.',
                    'Foi um movimento restrito à aristocracia francesa, sem participação popular.',
                    'Fortaleceu o poder absoluto da monarquia francesa até meados do século XIX.',
                ],
                'correta'      => 1,
                'explicacao'   => 'A Revolução Francesa pôs fim ao Antigo Regime, aboliu privilégios feudais na Noite de 4 de Agosto de 1789 e consolidou ideais iluministas que influenciaram movimentos políticos em todo o mundo.',
                'referencia'   => 'HOBSBAWM, Eric. A Era das Revoluções.',
            ],
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'A "Declaração dos Direitos do Homem e do Cidadão" (1789) é considerada um dos principais documentos da Revolução Francesa porque:',
                'alternativas' => [
                    'Instituiu o voto obrigatório para todos os cidadãos franceses.',
                    'Proclamou princípios de liberdade e igualdade civil que inspiraram constituições posteriores.',
                    'Restaurou os poderes absolutos do rei Luís XVI.',
                    'Estabeleceu o fim definitivo da escravidão nas colônias francesas.',
                ],
                'correta'      => 1,
                'explicacao'   => 'O documento consagrou princípios liberais — igualdade perante a lei, liberdade individual e soberania popular — que se tornaram referência para diversas constituições modernas.',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2025 - Fase 1 (V2)',
        'dificuldade' => 'Medio', 'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V2', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'A ascensão de Getúlio Vargas ao poder, em 1930, encerrou o período conhecido como República Velha. Um dos fatores que contribuiu diretamente para esse desfecho foi:',
                'alternativas' => [
                    'O fortalecimento da política do café com leite entre São Paulo e Minas Gerais.',
                    'A insatisfação de oligarquias excluídas do poder, somada à crise econômica de 1929.',
                    'A vitória eleitoral tranquila de Vargas nas urnas de 1930.',
                    'O apoio unânime do Exército ao governo de Washington Luís.',
                ],
                'correta'      => 1,
                'explicacao'   => 'A quebra do acordo do "café com leite", a crise de 1929 (que afetou a economia cafeeira) e a insatisfação de estados como Rio Grande do Sul e Paraíba criaram as condições para a Revolução de 1930.',
                'imagem'       => '../imagens/getuliovargas.png',
            ],
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'O Estado Novo (1937-1945), período final da Era Vargas, caracterizou-se principalmente por:',
                'alternativas' => [
                    'Ampla liberdade de imprensa e pluripartidarismo.',
                    'Centralização do poder, censura e forte propaganda estatal.',
                    'Descentralização administrativa em favor dos estados.',
                    'Adoção do parlamentarismo como sistema de governo.',
                ],
                'correta'      => 1,
                'explicacao'   => 'Com a outorga da Constituição de 1937, Vargas fechou o Congresso, extinguiu partidos políticos e criou o DIP (Departamento de Imprensa e Propaganda) para controlar a informação.',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2025 - Fase 1 (V3)',
        'dificuldade' => 'Medio', 'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V3', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'O absolutismo monárquico, predominante em boa parte da Europa moderna, fundamentava-se na ideia de que:',
                'alternativas' => [
                    'O poder do rei deveria ser limitado por uma assembleia eleita.',
                    'O poder real derivava diretamente de Deus, não sendo sujeito a controle popular.',
                    'A nobreza e o clero deveriam governar em conjunto com o rei, em plano de igualdade.',
                    'As cidades-estado italianas serviam de modelo político para toda a Europa.',
                ],
                'correta'      => 1,
                'explicacao'   => 'A teoria do direito divino dos reis sustentava que o monarca recebia sua autoridade diretamente de Deus, o que justificava a concentração de poder e a ausência de mecanismos de controle popular.',
            ],
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'O Renascimento cultural, que floresceu na Itália a partir do século XIV, teve como uma de suas principais características:',
                'alternativas' => [
                    'A rejeição total do conhecimento produzido na Antiguidade Clássica.',
                    'O antropocentrismo, valorizando o ser humano e a razão como centro das reflexões.',
                    'O fortalecimento exclusivo da arte religiosa medieval.',
                    'O isolamento cultural entre as cidades italianas.',
                ],
                'correta'      => 1,
                'explicacao'   => 'O Renascimento resgatou valores greco-romanos e colocou o homem (antropocentrismo) no centro das artes, da ciência e da filosofia, em contraste com o teocentrismo medieval.',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2025 - Fase 1 (V4)',
        'dificuldade' => 'Medio', 'ano' => 2025, 'fase' => 'Fase 1', 'versao' => 'V4', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'O sistema de capitanias hereditárias, adotado por Portugal no início da colonização do Brasil (1534), tinha como principal objetivo:',
                'alternativas' => [
                    'Garantir a igualdade de terras entre todos os colonos.',
                    'Povoar e defender o território a baixo custo para a Coroa portuguesa.',
                    'Estabelecer um governo democrático nas terras coloniais.',
                    'Abolir o trabalho escravo nas primeiras vilas coloniais.',
                ],
                'correta'      => 1,
                'explicacao'   => 'Sem recursos suficientes para colonizar diretamente o território, a Coroa portuguesa repassou a particulares (donatários) a responsabilidade de povoar e defender as capitanias, mantendo baixo custo para o reino.',
            ],
            [
                'fonte'        => 'FUVEST 2025 - Fase 1',
                'enunciado'    => 'O ciclo do açúcar, predominante no Brasil colonial entre os séculos XVI e XVII, apoiava-se fundamentalmente:',
                'alternativas' => [
                    'No trabalho assalariado de imigrantes europeus.',
                    'No trabalho escravo de africanos e na grande propriedade monocultora.',
                    'Na produção artesanal em pequenas propriedades familiares.',
                    'No comércio exclusivo com a Espanha.',
                ],
                'correta'      => 1,
                'explicacao'   => 'A economia açucareira se organizou em torno dos engenhos, grandes propriedades voltadas à monocultura de exportação e sustentadas pelo trabalho escravo de africanos.',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2025 - Fase 2 (Dia 1)',
        'dificuldade' => 'Medio', 'ano' => 2025, 'fase' => 'Fase 2', 'versao' => 'Dia 1', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2025 - Fase 2',
                'enunciado'    => 'A Guerra Fria (1945-1991) foi marcada pela disputa entre Estados Unidos e União Soviética. Um exemplo característico dessa rivalidade, sem confronto militar direto entre as duas potências, foi:',
                'alternativas' => [
                    'A Primeira Guerra Mundial.',
                    'A corrida espacial e armamentista.',
                    'A unificação da Alemanha em 1871.',
                    'A Revolução Industrial inglesa.',
                ],
                'correta'      => 1,
                'explicacao'   => 'Como as duas superpotências evitavam o confronto militar direto (que poderia gerar uma guerra nuclear), a disputa se deu por meio de corridas tecnológicas, como a espacial e a armamentista, além de conflitos por procuração.',
            ],
            [
                'fonte'        => 'FUVEST 2025 - Fase 2',
                'enunciado'    => 'A queda do Muro de Berlim, em 1989, é considerada um símbolo do(a):',
                'alternativas' => [
                    'Início da Guerra Fria.',
                    'Fim da Guerra Fria e da divisão do mundo em blocos capitalista e socialista.',
                    'Consolidação do bloco socialista na Europa.',
                    'Início da Segunda Guerra Mundial.',
                ],
                'correta'      => 1,
                'explicacao'   => 'A queda do muro simbolizou o enfraquecimento do bloco socialista e antecipou o fim da Guerra Fria, culminando na reunificação alemã (1990) e no colapso da URSS (1991).',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2025 - Fase 2 (Dia 2)',
        'dificuldade' => 'Medio', 'ano' => 2025, 'fase' => 'Fase 2', 'versao' => 'Dia 2', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2025 - Fase 2',
                'enunciado'    => 'Na Grécia Antiga, a democracia ateniense, desenvolvida especialmente a partir do século V a.C., caracterizava-se por:',
                'alternativas' => [
                    'Participação política de todos os habitantes da cidade, sem exceções.',
                    'Participação restrita aos cidadãos do sexo masculino, excluindo mulheres, estrangeiros e escravizados.',
                    'Governo hereditário exercido por uma única família.',
                    'Ausência total de assembleias populares.',
                ],
                'correta'      => 1,
                'explicacao'   => 'Apesar de pioneira, a democracia ateniense era limitada: apenas cidadãos homens, adultos e livres, nascidos de pai ateniense, podiam participar das decisões políticas na Ecclesia.',
            ],
            [
                'fonte'        => 'FUVEST 2025 - Fase 2',
                'enunciado'    => 'A transição de Roma da República para o Império, consolidada com Otávio Augusto (27 a.C.), foi resultado principalmente:',
                'alternativas' => [
                    'De uma invasão estrangeira que destituiu o Senado romano.',
                    'De sucessivas guerras civis e da crescente concentração de poder militar e político.',
                    'De uma eleição direta realizada por todos os cidadãos do império.',
                    'Da adoção do cristianismo como religião oficial de Roma.',
                ],
                'correta'      => 1,
                'explicacao'   => 'As guerras civis (como a disputa entre Otávio e Marco Antônio) e o enfraquecimento das instituições republicanas permitiram que Otávio concentrasse poderes, tornando-se o primeiro imperador romano.',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2024 - Fase 1 (V1)',
        'dificuldade' => 'Dificil', 'ano' => 2024, 'fase' => 'Fase 1', 'versao' => 'V1', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2024 - Fase 1',
                'enunciado'    => 'A Primeira Guerra Mundial (1914-1918) teve, entre suas causas estruturais, a disputa imperialista entre as potências europeias. O estopim do conflito foi:',
                'alternativas' => [
                    'A invasão da Polônia pela Alemanha.',
                    'O assassinato do arquiduque Francisco Ferdinando, em Sarajevo.',
                    'A Revolução Russa de 1917.',
                    'O ataque a Pearl Harbor.',
                ],
                'correta'      => 1,
                'explicacao'   => 'O assassinato do arquiduque Francisco Ferdinando, herdeiro do trono austro-húngaro, em junho de 1914, desencadeou o sistema de alianças militares que levou à eclosão do conflito.',
            ],
            [
                'fonte'        => 'FUVEST 2024 - Fase 1',
                'enunciado'    => 'O Tratado de Versalhes (1919), que encerrou formalmente a Primeira Guerra Mundial, é frequentemente apontado por historiadores como um fator que contribuiu para:',
                'alternativas' => [
                    'A estabilidade política duradoura na Europa do entreguerras.',
                    'O ressentimento alemão diante das duras sanções impostas, favorecendo o avanço do nazismo.',
                    'A imediata reconstrução econômica da Alemanha sem restrições.',
                    'O fortalecimento do Império Austro-Húngaro.',
                ],
                'correta'      => 1,
                'explicacao'   => 'As pesadas indenizações, a perda de territórios e a humilhação nacional impostas à Alemanha alimentaram um sentimento de revanchismo explorado posteriormente pelo discurso nazista.',
                'referencia'   => 'HOBSBAWM, Eric. Era dos Extremos.',
            ],
        ],
    ],
    [
        'banca' => 'fuvest', 'titulo' => 'FUVEST 2024 - Fase 1 (V2)',
        'dificuldade' => 'Dificil', 'ano' => 2024, 'fase' => 'Fase 1', 'versao' => 'V2', 'link' => 'questao.php',
        'perguntas' => [
            [
                'fonte'        => 'FUVEST 2024 - Fase 1',
                'enunciado'    => 'O golpe civil-militar de 1964 no Brasil resultou em um regime marcado pela repressão política. O Ato Institucional nº 5 (AI-5), de 1968, é considerado um marco desse período porque:',
                'alternativas' => [
                    'Restabeleceu as eleições diretas para presidente.',
                    'Suspendeu garantias constitucionais e ampliou a censura e a repressão política.',
                    'Aboliu a censura à imprensa no país.',
                    'Instituiu o pluripartidarismo pleno.',
                ],
                'correta'      => 1,
                'explicacao'   => 'O AI-5 suspendeu o habeas corpus para crimes políticos, permitiu cassações de mandatos e ampliou os poderes do Executivo, dando início à fase mais dura da repressão na ditadura militar.',
            ],
            [
                'fonte'        => 'FUVEST 2024 - Fase 1',
                'enunciado'    => 'O chamado "milagre econômico" brasileiro (1969-1973), durante a ditadura militar, caracterizou-se por:',
                'alternativas' => [
                    'Alto crescimento do PIB combinado com aumento da concentração de renda.',
                    'Redução das desigualdades sociais no país.',
                    'Estagnação completa da economia brasileira.',
                    'Fim do endividamento externo brasileiro.',
                ],
                'correta'      => 0,
                'explicacao'   => 'O período teve elevadas taxas de crescimento econômico, financiadas em parte por endividamento externo, mas acompanhadas de forte concentração de renda e arrocho salarial.',
            ],
        ],
    ],
    [
        'banca' => 'enem', 'titulo' => 'ENEM 2020 - Dia 1 (Ciências Humanas)',
        'dificuldade' => 'Medio', 'ano' => 2020, 'fase' => 'Única', 'versao' => 'Dia 1', 'link' => 'questao.php',
        'questoes' => [10, 13, 16, 20],
    ],
    [
        'banca' => 'fgv', 'titulo' => 'FGV 2021 - Conhecimentos Gerais',
        'dificuldade' => 'Medio', 'ano' => 2021, 'fase' => 'Única', 'versao' => 'Tipo 1', 'link' => 'questao.php',
        'questoes' => [18, 14],
    ],
    [
        'banca' => 'cebraspe', 'titulo' => 'CEBRASPE 2015 - História do Brasil',
        'dificuldade' => 'Medio', 'ano' => 2015, 'fase' => 'Única', 'versao' => 'Caderno A', 'link' => 'questao.php',
        'questoes' => [9, 3],
    ],
    [
        'banca' => 'vunesp', 'titulo' => 'VUNESP 2022 - República no Brasil',
        'dificuldade' => 'Facil', 'ano' => 2022, 'fase' => 'Única', 'versao' => 'V1', 'link' => 'questao.php',
        'questoes' => [24, 7],
    ],
    [
        'banca' => 'espcex', 'titulo' => 'EsPCEx 2019 - História Geral',
        'dificuldade' => 'Medio', 'ano' => 2019, 'fase' => 'Única', 'versao' => 'Modelo A', 'link' => 'questao.php',
        'questoes' => [25, 21],
    ],
];

function montar_timeline_modulo(array $modulo, string $slug_curso): array {
    $itens = $modulo['itens'] ?? [];

    $numero_conteudo  = 0;
    $numero_exercicio = 0;
    $timeline        = [];
    $itens_numerados = [];

    foreach ($itens as $item) {
        $tipo      = $item['tipo'] ?? 'texto';
        $titulo    = $item['titulo'] ?? '';
        $subtitulo = $item['subtitulo'] ?? '';
        $rotulo    = trim($titulo . ' ' . $subtitulo);

        if ($tipo === 'principal') {
            $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'subtitulo' => $subtitulo]);
            $timeline[] = [
                'tipo'   => 'principal',
                'rotulo' => $rotulo,
                'href'   => 'visualizar-aula.php?' . http_build_query($parametros),
                'extra'  => '',
                'icone'  => 'fa-solid fa-graduation-cap',
            ];
            continue;
        }

        if ($tipo === 'exercicio') {
            $numero_exercicio++;
            $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'lista' => $numero_exercicio]);
            $timeline[] = [
                'tipo'   => 'exercicio',
                'rotulo' => $titulo !== '' ? $titulo : ('Lista de exercícios ' . $numero_exercicio),
                'href'   => 'questao.php?' . http_build_query($parametros),
                'extra'  => 'Lista',
                'icone'  => 'fa-solid fa-clipboard-list',
            ];
            continue;
        }

        $numero_conteudo++;
        $destino    = $tipo === 'video' ? 'visualizar-video.php' : 'visualizar-aula.php';
        $parametros = array_filter(['curso' => $slug_curso, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'numero' => $numero_conteudo]);
        $href       = $destino . '?' . http_build_query($parametros);

        $timeline[] = [
            'tipo'   => $tipo,
            'rotulo' => $rotulo,
            'href'   => $href,
            'extra'  => $tipo === 'video' ? ($item['duracao'] ?? '') : 'Leitura',
            'icone'  => $tipo === 'video' ? 'fa-solid fa-play' : 'fa-solid fa-book-open',
            'numero' => $numero_conteudo,
        ];

        $itens_numerados[$numero_conteudo] = array_merge($item, [
            'numero' => $numero_conteudo,
            'href'   => $href,
        ]);
    }

    return ['timeline' => $timeline, 'itens_numerados' => $itens_numerados];
}

$modulos_aulas = [
    'era-vargas' => [
        'descricao' => 'Este é um dos principais módulos do percurso de Ciências Humanas e grandes vestibulares. Aqui, retornaremos, de acordo com o contexto histórico da época, a ascensão de Getúlio Vargas ao poder, as diferentes manifestações entre os diferentes grupos políticos, além da criação e consolidação das leis trabalhistas no país.',
        'itens' => [
            ['tipo' => 'principal', 'titulo' => 'Era Vargas', 'subtitulo' => '(1930 - 1945)'],
            [
                'tipo' => 'texto',
                'titulo' => 'Revolução de 1930',
                'resumo' => 'Entenda como ocorreu o golpe de Estado cívico-militar que depôs o presidente da República Washington Luís em 24 de outubro de 1930 e impediu a posse do presidente eleito Júlio Prestes, encerrando o período conhecido como República Velha.',
                'secoes' => [
                    [
                        'titulo' => '1. Introdução',
                        'paragrafos' => [
                            'A Revolução de 1930 representa um ponto de inflexão fundamental na história política brasileira, marcando o colapso da República Oligárquica e o início de um novo ciclo político sob a liderança de Getúlio Vargas. Este movimento cívico-militar, que culminou na deposição do presidente Washington Luís em 24 de outubro de 1930 e impediu a posse do presidente eleito Júlio Prestes, reconfigurou profundamente as estruturas de poder político e econômico do país, abrindo caminho para a Era Vargas e as transformações que caracterizariam o Brasil do século XX.',
                        ],
                    ],
                    [
                        'titulo' => '2. Contexto Histórico: A Primeira República e Suas Contradições',
                        'paragrafos' => [
                            'A Primeira República brasileira, estabelecida em 1889 após a proclamação da República, foi construída sobre um sistema político que concentrou o poder nas mãos das oligarquias estaduais, particularmente as de São Paulo e Minas Gerais. Este período, que se estenderia até 1930, ficaria conhecido como República Oligárquica, caracterizando-se pela exclusão política de amplos setores da população e pela manipulação sistemática dos processos eleitorais.',
                            'A estrutura política da Primeira República baseava-se na chamada Política dos Governadores, estabelecida durante o governo de Campos Sales (1898-1902). Este sistema funcionava através de um pacto entre o governo federal e os governos estaduais, garantindo a reeleição do presidente em exercício e a vitória dos candidatos governistas nas eleições.',
                            'O Congresso Nacional, composto por representantes das oligarquias locais, raramente questionava as decisões do Executivo, criando um sistema de poder altamente centralizado nas mãos do presidente e das elites estaduais.',
                        ],
                    ],
                    [
                        'titulo' => '3. As Causas Estruturais da Crise de 1930',
                        'paragrafos' => [
                            'A primeira causa fundamental da Revolução de 1930 residia na crescente insatisfação de outras oligarquias estaduais com o sistema de poder vigente. Estados como Rio Grande do Sul, Paraíba, Bahia e Rio de Janeiro viam-se sistematicamente excluídos das decisões políticas importantes, tendo suas demandas negligenciadas em favor dos interesses paulistas e mineiros. Esta exclusão gerava um sentimento de injustiça política que se intensificava à medida que estes estados ganhavam importância econômica e demográfica.',
                            'O Rio Grande do Sul, em particular, sob a liderança de Getúlio Vargas, havia desenvolvido uma elite política sofisticada e ambiciosa que questionava a legitimidade do sistema oligárquico. A Paraíba, por sua vez, sob o comando de João Pessoa, também buscava maior participação no cenário político nacional. Estes estados, juntamente com Minas Gerais (que também enfrentava divisões internas), forneceriam a base para a articulação de uma frente de oposição ao governo federal.',
                        ],
                    ],
                ],
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Governo Provisório',
                'subtitulo' => '(1930 - 1934)',
                'descricao' => 'Nesta aula, você conhecerá a reorganização do Estado brasileiro durante o Governo Provisório e as principais reformas do período.',
                'duracao' => '11 min',
                'imagem' => '../imagens/governo-provisorio.png',
                'alt' => 'Governo Provisório de Getúlio Vargas',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Governo Constitucional',
                'subtitulo' => '(1934 - 1937)',
                'descricao' => 'Nesta aula, você compreenderá a Constituição de 1934, os conflitos políticos e o caminho que levou ao Estado Novo.',
                'duracao' => '11 min',
                'imagem' => '../imagens/governo-constitucional.png',
                'alt' => 'Governo Constitucional',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Estado Novo',
                'subtitulo' => '(1937 - 1945)',
                'descricao' => 'Nesta aula, você estudará a ditadura do Estado Novo, a centralização do poder, a propaganda oficial e as políticas de industrialização.',
                'duracao' => '14 min',
                'imagem' => '../imagens/estado-novo.png',
                'alt' => 'Estado Novo',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Fim da Era Vargas',
                'descricao' => 'Nesta aula, você analisará a deposição de Vargas em 1945 e o legado político, social e econômico deixado pela Era Vargas.',
                'duracao' => '9 min',
                'imagem' => '../imagens/fim-era-vargas.png',
                'alt' => 'Fim da Era Vargas',
            ],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1', 'descricao' => 'Revolução de 1930 e Governo Constitucional.', 'questoes' => [7, 9]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2', 'descricao' => 'Estado Novo e legislação trabalhista.', 'questoes' => [3, 6]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 3', 'descricao' => 'Questão discursiva sobre o legado de Vargas.', 'questoes' => [8]],
        ],
        'materiais' => [
            ['nome' => 'Exercícios da aula', 'tipo' => 'PDF · 120 KB'],
            ['nome' => 'Exercícios revolução de 1930', 'tipo' => 'Word · 15.62 KB'],
            ['nome' => 'Linha do tempo da Era Vargas', 'tipo' => 'PDF · 240 KB'],
        ],
    ],

    'idade-moderna' => [
        'descricao' => 'Neste módulo você vai entender as transformações que marcaram a passagem da Idade Média para a Idade Moderna: o florescimento cultural do Renascimento, as rupturas religiosas da Reforma, a centralização do poder nas monarquias absolutistas e o início da expansão marítima europeia.',
        'itens' => [
            ['tipo' => 'principal', 'titulo' => 'Idade Moderna e Renascimento'],
            [
                'tipo' => 'texto',
                'titulo' => 'O Renascimento Cultural e Artístico',
                'resumo' => 'Descubra como as cidades italianas dos séculos XIV a XVI se tornaram o berço de uma nova forma de ver o mundo, que colocou o ser humano no centro das reflexões e retomou a herança da Antiguidade Clássica.',
                'secoes' => [
                    [
                        'titulo' => '1. Um novo olhar sobre o mundo',
                        'paragrafos' => [
                            'O Renascimento foi um movimento cultural que se desenvolveu inicialmente nas cidades italianas, como Florença, Veneza e Roma. Ricas graças ao comércio com o Oriente, essas cidades contavam com uma burguesia disposta a investir em arte e conhecimento.',
                            'Os renascentistas valorizavam o antropocentrismo, o racionalismo e o estudo da natureza, sem romper totalmente com a religião. A inspiração vinha da cultura greco-romana, redescoberta em manuscritos e ruínas.',
                        ],
                    ],
                    [
                        'titulo' => '2. O mecenato e os grandes artistas',
                        'paragrafos' => [
                            'Famílias poderosas, como os Médici, e também papas financiavam artistas em troca de prestígio: era o mecenato. Leonardo da Vinci, Michelangelo, Rafael e Botticelli produziram obras que combinavam técnica, perspectiva e estudo anatômico.',
                            'A pintura renascentista adotou a perspectiva linear, criando a ilusão de profundidade, e passou a representar corpos humanos com proporção e realismo.',
                        ],
                    ],
                    [
                        'titulo' => '3. A difusão pela Europa',
                        'paragrafos' => [
                            'A invenção da prensa de tipos móveis por Gutenberg, por volta de 1450, barateou os livros e espalhou as ideias renascentistas pela Europa. Pensadores como Erasmo de Roterdã, Thomas More e Montaigne ampliaram o humanismo para além da Itália.',
                        ],
                    ],
                ],
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Reforma Protestante e Contrarreforma',
                'descricao' => 'Nesta aula, você entenderá as críticas de Lutero e Calvino à Igreja Católica, a formação das igrejas protestantes e a resposta católica com o Concílio de Trento.',
                'duracao' => '13 min',
                'imagem' => '../imagens/vocacao.jpg',
                'alt' => 'A Vocação de São Mateus, de Caravaggio',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Absolutismo Monárquico Europeu',
                'descricao' => 'Nesta aula, você conhecerá a centralização do poder nas mãos dos reis, as teorias de Hobbes, Bossuet e Maquiavel e o exemplo de Luís XIV na França.',
                'duracao' => '10 min',
                'imagem' => '../imagens/filosofia.png',
                'alt' => 'Idade Moderna',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Grandes Navegações e Expansão Marítima',
                'descricao' => 'Nesta aula, você acompanhará o pioneirismo português, as viagens de Colombo, Vasco da Gama e Cabral e as consequências da chegada dos europeus à América.',
                'duracao' => '12 min',
                'imagem' => '../imagens/image 100.png',
                'alt' => 'Caravelas em alto-mar',
            ],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1', 'descricao' => 'Renascimento e Reforma Protestante.', 'questoes' => [10, 11]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2', 'descricao' => 'Grandes Navegações e crise do Antigo Regime.', 'questoes' => [12, 1]],
        ],
        'materiais' => [
            ['nome' => 'Mapa mental: Renascimento e Reforma', 'tipo' => 'PDF · 340 KB'],
            ['nome' => 'Linha do tempo da Idade Moderna', 'tipo' => 'PDF · 210 KB'],
        ],
    ],

    'ditadura-militar' => [
        'descricao' => 'Este módulo aborda o regime militar brasileiro, do golpe de 1964 à redemocratização em 1985: o contexto da Guerra Fria, os atos institucionais, a repressão política, o chamado "milagre econômico" e o processo de abertura que encerrou o período.',
        'itens' => [
            ['tipo' => 'principal', 'titulo' => 'Ditadura Militar no Brasil', 'subtitulo' => '(1964 - 1985)'],
            [
                'tipo' => 'texto',
                'titulo' => 'O Golpe de 1964',
                'resumo' => 'Entenda o cenário político que levou à deposição do presidente João Goulart em 31 de março de 1964 e à instalação de um regime militar que duraria 21 anos.',
                'secoes' => [
                    [
                        'titulo' => '1. O governo João Goulart',
                        'paragrafos' => [
                            'João Goulart, o Jango, assumiu a Presidência em 1961, após a renúncia de Jânio Quadros. Sua posse só foi aceita pelos setores conservadores com a adoção temporária do parlamentarismo, derrubado por plebiscito em 1963.',
                            'Jango propôs as Reformas de Base — agrária, urbana, educacional e bancária — e aproximou-se de sindicatos e movimentos sociais, o que gerou forte oposição de empresários, latifundiários e parte das Forças Armadas.',
                        ],
                    ],
                    [
                        'titulo' => '2. A Guerra Fria e a conspiração',
                        'paragrafos' => [
                            'No contexto da Guerra Fria, e pouco depois da Revolução Cubana, as propostas de Jango foram apresentadas por seus opositores como uma ameaça comunista. Organizações como o IPES e o IBAD financiaram campanhas contra o governo, e os Estados Unidos acompanharam a conspiração de perto.',
                            'Grandes manifestações, como a Marcha da Família com Deus pela Liberdade, deram apoio civil à derrubada do presidente.',
                        ],
                    ],
                    [
                        'titulo' => '3. A tomada do poder',
                        'paragrafos' => [
                            'Em 31 de março de 1964, tropas partiram de Minas Gerais em direção ao Rio de Janeiro. Sem resistência armada, Jango deixou Brasília e exilou-se no Uruguai. O marechal Castelo Branco foi eleito presidente pelo Congresso, dando início ao regime militar.',
                        ],
                    ],
                ],
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Anos de Chumbo e o AI-5',
                'descricao' => 'Nesta aula, você entenderá o Ato Institucional nº 5, a censura, a repressão aos opositores e a luta armada no governo Médici.',
                'duracao' => '14 min',
                'imagem' => '../imagens/ditadura.png',
                'alt' => 'Ditadura Militar no Brasil',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'O "Milagre Econômico"',
                'descricao' => 'Nesta aula, você analisará o crescimento acelerado entre 1968 e 1973, o endividamento externo e o aumento da concentração de renda.',
                'duracao' => '11 min',
                'imagem' => '../imagens/ditadura.png',
                'alt' => 'Milagre Econômico',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Abertura Política e Redemocratização',
                'descricao' => 'Nesta aula, você acompanhará a abertura "lenta, gradual e segura" de Geisel, a Lei da Anistia, as Diretas Já e a eleição de Tancredo Neves.',
                'duracao' => '12 min',
                'imagem' => '../imagens/ditadura.png',
                'alt' => 'Redemocratização',
            ],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1', 'descricao' => 'Golpe de 1964 e anos de chumbo.', 'questoes' => [13, 4]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2', 'descricao' => 'Abertura política e Diretas Já.', 'questoes' => [14]],
        ],
        'materiais' => [
            ['nome' => 'Resumo: Atos Institucionais', 'tipo' => 'PDF · 180 KB'],
            ['nome' => 'Cronologia do regime militar (1964-1985)', 'tipo' => 'PDF · 260 KB'],
        ],
    ],

    'brasil-colonia' => [
        'descricao' => 'Um panorama do Brasil entre 1530 e 1822: a organização das capitanias hereditárias, o ciclo do açúcar e o trabalho escravo, as invasões estrangeiras e o posterior ciclo do ouro em Minas Gerais, que mudou o eixo econômico da colônia.',
        'itens' => [
            ['tipo' => 'principal', 'titulo' => 'Brasil Colônia', 'subtitulo' => '(1530 - 1822)'],
            [
                'tipo' => 'texto',
                'titulo' => 'Capitanias Hereditárias e Governo-Geral',
                'resumo' => 'Veja como a Coroa portuguesa organizou a ocupação do território brasileiro, primeiro transferindo a colonização a particulares e depois centralizando a administração com o Governo-Geral.',
                'secoes' => [
                    [
                        'titulo' => '1. Por que colonizar?',
                        'paragrafos' => [
                            'Nas primeiras décadas após 1500, Portugal se limitou a explorar o pau-brasil por meio de feitorias. A presença de franceses no litoral e a queda nos lucros do comércio com o Oriente levaram a Coroa a iniciar a colonização efetiva a partir de 1530, com a expedição de Martim Afonso de Sousa.',
                        ],
                    ],
                    [
                        'titulo' => '2. As capitanias hereditárias',
                        'paragrafos' => [
                            'Em 1534, o território foi dividido em faixas de terra entregues a donatários, que recebiam a Carta de Doação e o Foral. Eles tinham o dever de povoar, defender e desenvolver a economia da capitania, podendo doar sesmarias e cobrar tributos.',
                            'A falta de recursos, os conflitos com os povos indígenas e a distância de Portugal fizeram a maioria das capitanias fracassar. Apenas São Vicente e Pernambuco prosperaram, principalmente com a produção de açúcar.',
                        ],
                    ],
                    [
                        'titulo' => '3. O Governo-Geral',
                        'paragrafos' => [
                            'Em 1548, a Coroa criou o Governo-Geral para centralizar a administração, sem extinguir as capitanias. Tomé de Sousa, primeiro governador-geral, fundou Salvador em 1549, que se tornou a capital da colônia. Com ele chegaram os primeiros jesuítas, responsáveis pela catequese dos indígenas.',
                        ],
                    ],
                ],
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Ciclo do Açúcar e os Engenhos',
                'descricao' => 'Nesta aula, você conhecerá a estrutura dos engenhos, o papel dos senhores de engenho e a exploração do trabalho de africanos escravizados.',
                'duracao' => '12 min',
                'imagem' => '../imagens/colonial.png',
                'alt' => 'Brasil Colônia',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Invasões Holandesas e Francesas',
                'descricao' => 'Nesta aula, você entenderá a União Ibérica, a ocupação holandesa de Pernambuco, o governo de Maurício de Nassau e a França Antártica.',
                'duracao' => '13 min',
                'imagem' => '../imagens/image 99.png',
                'alt' => 'Pintura de batalha',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Ciclo do Ouro em Minas Gerais',
                'descricao' => 'Nesta aula, você estudará a mineração, a cobrança do quinto, a transferência da capital para o Rio de Janeiro e a Inconfidência Mineira.',
                'duracao' => '11 min',
                'imagem' => '../imagens/colonial.png',
                'alt' => 'Ciclo do Ouro',
            ],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1', 'descricao' => 'Capitanias hereditárias e Governo-Geral.', 'questoes' => [15]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2', 'descricao' => 'Invasões holandesas e ciclo do ouro.', 'questoes' => [16, 17]],
        ],
        'materiais' => [
            ['nome' => 'Mapa das capitanias hereditárias', 'tipo' => 'PDF · 520 KB'],
            ['nome' => 'Resumo: economia colonial', 'tipo' => 'PDF · 150 KB'],
        ],
    ],

    'antiguidade-classica' => [
        'descricao' => 'Explore as bases da civilização ocidental na Grécia e em Roma: a organização das pólis e o nascimento da democracia ateniense, os grandes conflitos da Antiguidade e a trajetória romana, da República ao Império, até sua queda no Ocidente.',
        'itens' => [
            ['tipo' => 'principal', 'titulo' => 'Antiguidade Clássica', 'subtitulo' => '(Grécia e Roma)'],
            [
                'tipo' => 'texto',
                'titulo' => 'Grécia Antiga: Pólis e Democracia',
                'resumo' => 'Conheça a organização das cidades-Estado gregas e compare os modelos de Esparta e Atenas, onde surgiu a democracia no século V a.C.',
                'secoes' => [
                    [
                        'titulo' => '1. As pólis gregas',
                        'paragrafos' => [
                            'A Grécia Antiga nunca foi um Estado unificado. O relevo montanhoso favoreceu o surgimento de pólis, cidades-Estado independentes, com leis, governos e exércitos próprios, mas que compartilhavam a língua, a religião e os Jogos Olímpicos.',
                        ],
                    ],
                    [
                        'titulo' => '2. Esparta: a cidade militar',
                        'paragrafos' => [
                            'Esparta era governada por uma oligarquia e organizada em torno da guerra. Os meninos eram retirados das famílias aos sete anos para receber educação militar, e o trabalho agrícola era realizado pelos hilotas, população submetida pelos espartanos.',
                        ],
                    ],
                    [
                        'titulo' => '3. Atenas e a democracia',
                        'paragrafos' => [
                            'Em Atenas, as reformas de Sólon e Clístenes ampliaram a participação política. No século V a.C., sob Péricles, os cidadãos reuniam-se na Eclésia para votar leis e decidir sobre a guerra e a paz.',
                            'Era, porém, uma democracia restrita: mulheres, estrangeiros e escravizados não eram considerados cidadãos. Ainda assim, o modelo ateniense tornou-se referência para o pensamento político ocidental.',
                        ],
                    ],
                ],
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Guerras Médicas e Guerra do Peloponeso',
                'descricao' => 'Nesta aula, você acompanhará a vitória grega contra os persas, a hegemonia ateniense na Liga de Delos e o conflito com Esparta.',
                'duracao' => '12 min',
                'imagem' => '../imagens/image 99.png',
                'alt' => 'Pintura de batalha antiga',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Roma: da República ao Império',
                'descricao' => 'Nesta aula, você entenderá as instituições republicanas, as conquistas, as guerras civis e a ascensão de Otávio Augusto.',
                'duracao' => '14 min',
                'imagem' => '../imagens/image 101.png',
                'alt' => 'Coliseu de Roma',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Queda do Império Romano do Ocidente',
                'descricao' => 'Nesta aula, você analisará a crise do século III, a divisão do império, as migrações germânicas e a deposição de Rômulo Augústulo em 476.',
                'duracao' => '10 min',
                'imagem' => '../imagens/romano.jpg',
                'alt' => 'A Morte de Júlio César',
            ],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1', 'descricao' => 'Pólis gregas e democracia ateniense.', 'questoes' => [18]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2', 'descricao' => 'República e Império Romano.', 'questoes' => [19]],
        ],
        'materiais' => [
            ['nome' => 'Quadro comparativo: Esparta x Atenas', 'tipo' => 'PDF · 190 KB'],
            ['nome' => 'Linha do tempo de Roma Antiga', 'tipo' => 'PDF · 230 KB'],
        ],
    ],

    'guerra-fria' => [
        'descricao' => 'Da rivalidade entre Estados Unidos e União Soviética após a Segunda Guerra Mundial até a queda do Muro de Berlim: acompanhe a corrida armamentista e espacial, os conflitos por procuração ao redor do mundo e o desfecho que redesenhou a ordem mundial.',
        'itens' => [
            ['tipo' => 'principal', 'titulo' => 'Guerra Fria', 'subtitulo' => '(1945 - tempos atuais)'],
            [
                'tipo' => 'texto',
                'titulo' => 'Origens da Guerra Fria',
                'resumo' => 'Entenda como a aliança entre Estados Unidos e União Soviética contra o nazismo deu lugar, logo após 1945, a uma disputa global entre dois modelos políticos e econômicos.',
                'secoes' => [
                    [
                        'titulo' => '1. Um mundo bipolar',
                        'paragrafos' => [
                            'Ao fim da Segunda Guerra Mundial, a Europa estava destruída e duas superpotências emergiram: os Estados Unidos, capitalistas, e a União Soviética, socialista. A disputa entre elas por áreas de influência ficou conhecida como Guerra Fria, pois nunca houve confronto militar direto entre as duas.',
                        ],
                    ],
                    [
                        'titulo' => '2. Doutrina Truman e Plano Marshall',
                        'paragrafos' => [
                            'Em 1947, o presidente Harry Truman anunciou que os Estados Unidos apoiariam países ameaçados pelo comunismo. No mesmo ano, o Plano Marshall ofereceu empréstimos para a reconstrução da Europa Ocidental, fortalecendo a influência norte-americana.',
                            'A União Soviética respondeu com o Comecon, de cooperação econômica, e consolidou governos socialistas no Leste Europeu, formando o que Churchill chamou de "cortina de ferro".',
                        ],
                    ],
                    [
                        'titulo' => '3. Alianças militares',
                        'paragrafos' => [
                            'Em 1949 foi criada a OTAN, aliança militar liderada pelos Estados Unidos. Em 1955, os soviéticos organizaram o Pacto de Varsóvia. A Alemanha, dividida em duas, e Berlim, cercada pelo território socialista, tornaram-se o principal símbolo da divisão do mundo.',
                        ],
                    ],
                ],
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Corrida Armamentista e Espacial',
                'descricao' => 'Nesta aula, você conhecerá a disputa nuclear, a crise dos mísseis em Cuba e a corrida espacial, do Sputnik à chegada à Lua.',
                'duracao' => '13 min',
                'imagem' => '../imagens/guerrafria.png',
                'alt' => 'Guerra Fria',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Conflitos por Procuração: Coreia e Vietnã',
                'descricao' => 'Nesta aula, você entenderá como as superpotências se enfrentaram indiretamente em guerras na Ásia, com destaque para a Coreia e o Vietnã.',
                'duracao' => '12 min',
                'imagem' => '../imagens/guerrafria.png',
                'alt' => 'Conflitos da Guerra Fria',
            ],
            [
                'tipo' => 'video',
                'titulo' => 'Queda do Muro de Berlim',
                'descricao' => 'Nesta aula, você acompanhará as reformas de Gorbachev, a queda do muro em 1989 e o fim da União Soviética em 1991.',
                'duracao' => '10 min',
                'imagem' => '../imagens/guerrafria.png',
                'alt' => 'Queda do Muro de Berlim',
            ],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 1', 'descricao' => 'Da Segunda Guerra à corrida espacial.', 'questoes' => [2, 20]],
            ['tipo' => 'exercicio', 'titulo' => 'Lista de exercícios 2', 'descricao' => 'O fim da ordem bipolar.', 'questoes' => [21]],
        ],
        'materiais' => [
            ['nome' => 'Mapa: blocos da Guerra Fria', 'tipo' => 'PDF · 410 KB'],
            ['nome' => 'Resumo: conflitos por procuração', 'tipo' => 'PDF · 170 KB'],
        ],
    ],
];

$contas = [
    [
        'id' => 1,
        'nome' => 'Victor Augusto',
        'email' => 'alexandria@alexandria.com',
        'data_nascimento' => '1998-04-12',
        'telefone' => '(11) 91234-5678',
        'senha' => 'senha123',
        'tipo' => 'ADM',
        'membro_desde' => '2023-02-01',
    ],
    [
        'id' => 2,
        'nome' => 'Marina Souza',
        'email' => 'marina.souza@gmail.com',
        'data_nascimento' => '2003-09-21',
        'telefone' => '(21) 99876-5432',
        'senha' => 'marina2024',
        'tipo' => 'USER',
        'plano' => 'basico',
        'plano_desde' => '2026-09-16',
        'membro_desde' => '2024-03-15',
        'questoes_respondidas' => 184,
        'simulados_realizados' => 2,
        'cursos_iniciados' => [
            ['slug' => 'era-vargas',     'progresso' => 35],
            ['slug' => 'brasil-colonia', 'progresso' => 10],
        ],
    ],
    [
        'id' => 3,
        'nome' => 'João Pedro Ferreira',
        'email' => 'joao.ferreira@hotmail.com',
        'data_nascimento' => '2000-01-05',
        'telefone' => '(31) 98765-4321',
        'senha' => 'joaop2000',
        'tipo' => 'USER',
        'plano' => 'avancado',
        'plano_desde' => '2026-08-02',
        'membro_desde' => '2024-01-10',
        'questoes_respondidas' => 1248,
        'simulados_realizados' => 12,
        'cursos_iniciados' => [
            ['slug' => 'era-vargas',       'progresso' => 60],
            ['slug' => 'ditadura-militar', 'progresso' => 25],
            ['slug' => 'guerra-fria',      'progresso' => 80],
            ['slug' => 'idade-moderna',    'progresso' => 100],
        ],
    ],
    [
        'id' => 4,
        'nome' => 'Ana Beatriz Lima',
        'email' => 'ana.lima@outlook.com',
        'data_nascimento' => '1999-11-30',
        'telefone' => '(41) 97654-3210',
        'senha' => 'anabeatriz99',
        'tipo' => 'USER',
        'plano' => 'premium',
        'plano_desde' => '2026-05-20',
        'membro_desde' => '2023-08-22',
        'questoes_respondidas' => 2530,
        'simulados_realizados' => 27,
        'cursos_iniciados' => [
            ['slug' => 'antiguidade-classica', 'progresso' => 45],
            ['slug' => 'idade-moderna',        'progresso' => 15],
            ['slug' => 'brasil-colonia',       'progresso' => 70],
            ['slug' => 'era-vargas',           'progresso' => 100],
            ['slug' => 'guerra-fria',          'progresso' => 5],
            ['slug' => 'ditadura-militar',     'progresso' => 50],
        ],
    ],
    [
        'id' => 5,
        'nome' => 'Rafael Costa',
        'email' => 'rafael.costa@yahoo.com',
        'data_nascimento' => '2002-06-17',
        'telefone' => '(51) 96543-2109',
        'senha' => 'rafael123',
        'tipo' => 'USER',
        'plano' => 'basico',
        'plano_desde' => '2026-09-18',
        'membro_desde' => '2025-05-04',
        'questoes_respondidas' => 0,
        'simulados_realizados' => 0,
        'cursos_iniciados' => [],
    ],
    [
        'id' => 6,
        'nome' => 'Camila Rodrigues',
        'email' => 'camila.rodrigues@alexandria.com',
        'data_nascimento' => '1995-03-08',
        'telefone' => '(61) 95432-1098',
        'senha' => 'camila2025',
        'tipo' => 'ADM',
        'membro_desde' => '2023-06-30',
    ],
];

function cursos_iniciados_da_conta(int $id_conta): array {
    global $contas, $cursos;

    $conta = null;
    foreach ($contas as $item) {
        if ((int) $item['id'] === $id_conta) {
            $conta = $item;
            break;
        }
    }
    if ($conta === null) {
        return [];
    }

    $cursos_por_slug = array_column($cursos, null, 'slug');
    $resultado = [];

    foreach ($conta['cursos_iniciados'] ?? [] as $iniciado) {
        $slug = $iniciado['slug'] ?? '';
        if (!isset($cursos_por_slug[$slug])) {
            continue;
        }
        $progresso = max(0, min(100, (int) ($iniciado['progresso'] ?? 0)));
        $resultado[] = $cursos_por_slug[$slug] + ['progresso' => $progresso];
    }

    return $resultado;
}

function questao_por_id(int $id): ?array {
    global $questoes;
    foreach ($questoes as $questao) {
        if ((int) $questao['id'] === $id) {
            return $questao;
        }
    }
    return null;
}

foreach ($provas as $indice_prova_calc => $prova_calc) {
    if (empty($prova_calc['perguntas']) && !empty($prova_calc['questoes'])) {
        $perguntas_calc = [];
        foreach ($prova_calc['questoes'] as $id_questao_calc) {
            $questao_calc = questao_por_id((int) $id_questao_calc);
            if ($questao_calc !== null) {
                $perguntas_calc[] = $questao_calc;
            }
        }
        $provas[$indice_prova_calc]['perguntas'] = $perguntas_calc;
    }
    $provas[$indice_prova_calc]['id']   = $indice_prova_calc;
    $provas[$indice_prova_calc]['link'] = 'questao.php?prova=' . $indice_prova_calc;
    $provas[$indice_prova_calc]['total_perguntas'] = count($provas[$indice_prova_calc]['perguntas']);
}

foreach ($acervos as $indice_acervo_calc => $acervo_calc) {
    $provas_acervo_calc = array_filter($provas, fn($p) => ($p['banca'] ?? '') === $acervo_calc['slug']);
    $acervos[$indice_acervo_calc]['total_provas']    = count($provas_acervo_calc);
    $acervos[$indice_acervo_calc]['total_perguntas'] = array_sum(array_column($provas_acervo_calc, 'total_perguntas'));
}

foreach ($cursos as $indice_curso_calc => $curso_calc) {
    $alunos_calc = 0;
    foreach ($contas as $conta_calc) {
        foreach ($conta_calc['cursos_iniciados'] ?? [] as $iniciado_calc) {
            if (($iniciado_calc['slug'] ?? '') === $curso_calc['slug']) {
                $alunos_calc++;
            }
        }
    }
    $itens_calc = $modulos_aulas[$curso_calc['slug']]['itens'] ?? [];
    $cursos[$indice_curso_calc]['alunos']        = $alunos_calc;
    $cursos[$indice_curso_calc]['total_aulas']   = count(array_filter($itens_calc, fn($i) => in_array($i['tipo'] ?? '', ['texto', 'video'], true)));
    $cursos[$indice_curso_calc]['total_listas']  = count(array_filter($itens_calc, fn($i) => ($i['tipo'] ?? '') === 'exercicio'));
    $cursos[$indice_curso_calc]['total_questoes'] = count(array_filter($questoes, fn($q) => ($q['curso'] ?? '') === $curso_calc['slug']));
}

function lista_exercicios_do_curso(string $slug_curso, int $numero_lista): ?array {
    global $modulos_aulas;
    $numero = 0;
    foreach ($modulos_aulas[$slug_curso]['itens'] ?? [] as $indice => $item) {
        if (($item['tipo'] ?? '') !== 'exercicio') {
            continue;
        }
        $numero++;
        if ($numero === $numero_lista) {
            return ['indice' => $indice, 'numero' => $numero, 'item' => $item];
        }
    }
    return null;
}

function contexto_questoes(array $parametros): array {
    global $questoes, $provas, $cursos;

    $indice = isset($parametros['q']) ? max(0, (int) $parametros['q']) : 0;

    if (isset($parametros['prova']) && isset($provas[(int) $parametros['prova']])) {
        $id_prova  = (int) $parametros['prova'];
        $prova     = $provas[$id_prova];
        $perguntas = array_values($prova['perguntas'] ?? []);
        $contexto  = [
            'origem'        => 'prova',
            'titulo'        => $prova['titulo'] ?? ('Prova ' . ($prova['ano'] ?? '')),
            'perguntas'     => $perguntas,
            'base'          => ['prova' => $id_prova],
            'chave'         => 'prova-' . $id_prova,
            'link_voltar'   => 'visualizar-prova.php?banca=' . rawurlencode($prova['banca'] ?? ''),
            'rotulo_voltar' => 'Voltar para o acervo',
        ];
    }
    elseif (!empty($parametros['curso']) && !empty($parametros['lista'])) {
        $slug  = (string) $parametros['curso'];
        $lista = lista_exercicios_do_curso($slug, (int) $parametros['lista']);
        $perguntas = [];
        foreach ($lista['item']['questoes'] ?? [] as $id_questao) {
            $questao = questao_por_id((int) $id_questao);
            if ($questao !== null) {
                $perguntas[] = $questao;
            }
        }
        $titulo_curso = '';
        foreach ($cursos as $curso) {
            if ($curso['slug'] === $slug) {
                $titulo_curso = $curso['titulo'];
                break;
            }
        }
        $contexto = [
            'origem'        => 'lista',
            'titulo'        => trim($titulo_curso . ' · ' . ($lista['item']['titulo'] ?? 'Lista de exercícios'), ' ·'),
            'perguntas'     => $perguntas,
            'base'          => ['curso' => $slug, 'lista' => (int) $parametros['lista']],
            'chave'         => 'lista-' . $slug . '-' . (int) $parametros['lista'],
            'link_voltar'   => 'visualizar-aulas.php?slug=' . rawurlencode($slug),
            'rotulo_voltar' => 'Voltar para o curso',
        ];
    }
    else {
        $perguntas = array_values($questoes);
        if (isset($parametros['id'])) {
            foreach ($perguntas as $posicao => $questao) {
                if ((int) $questao['id'] === (int) $parametros['id']) {
                    $indice = $posicao;
                    break;
                }
            }
        }
        $contexto = [
            'origem'        => 'banco',
            'titulo'        => 'Banco de questões',
            'perguntas'     => $perguntas,
            'base'          => [],
            'chave'         => 'banco',
            'link_voltar'   => 'visualizar-questoes.php',
            'rotulo_voltar' => 'Voltar para o Banco de questões',
        ];
    }

    $total  = count($contexto['perguntas']);
    $indice = $total > 0 ? min($indice, $total - 1) : 0;

    return $contexto + [
        'indice'   => $indice,
        'total'    => $total,
        'pergunta' => $contexto['perguntas'][$indice] ?? null,
    ];
}

function url_questao(array $contexto, int $indice, string $pagina = 'questao.php', array $extra = []): string {
    $parametros = $contexto['base'];
    if ($contexto['origem'] === 'banco') {
        $parametros['id'] = $contexto['perguntas'][$indice]['id'] ?? null;
    } else {
        $parametros['q'] = $indice;
    }
    return $pagina . '?' . http_build_query(array_filter($parametros + $extra, fn($v) => $v !== null && $v !== ''));
}

function perguntas_para_editor(array $perguntas): array {
    $resultado = ['perguntas' => [], 'dissertativas' => [], 'contador_perguntas' => 0, 'contador_alternativas' => 0];

    foreach ($perguntas as $pergunta) {
        if (($pergunta['tipo'] ?? 'alternativa') === 'dissertativo') {
            $resultado['dissertativas'][] = $pergunta;
            continue;
        }
        $resultado['contador_perguntas']++;
        $alternativas_js = [];
        $id_correta_js   = null;
        foreach (array_values($pergunta['alternativas'] ?? []) as $indice_alternativa => $texto_alternativa) {
            $resultado['contador_alternativas']++;
            $id_alternativa_js = 'alt-' . $resultado['contador_alternativas'];
            $alternativas_js[] = ['id' => $id_alternativa_js, 'texto' => $texto_alternativa];
            if (isset($pergunta['correta']) && (int) $pergunta['correta'] === $indice_alternativa) {
                $id_correta_js = $id_alternativa_js;
            }
        }
        $resultado['perguntas'][] = [
            'id'           => 'pergunta-' . $resultado['contador_perguntas'],
            'id_questao'   => $pergunta['id'] ?? null,
            'fonte'        => $pergunta['fonte'] ?? '',
            'enunciado'    => $pergunta['enunciado'] ?? '',
            'alternativas' => $alternativas_js,
            'corretaId'    => $id_correta_js,
            'explicacao'   => $pergunta['explicacao'] ?? '',
            'referencia'   => $pergunta['referencia'] ?? '',
            'imagem'       => !empty($pergunta['imagem']) ? ['nome' => basename($pergunta['imagem']), 'url' => $pergunta['imagem']] : null,
        ];
    }

    return $resultado;
}

function html_artigo_seguro($conteudo): string {
    if (is_array($conteudo)) {
        return implode('', array_map(fn($p) => '<p>' . htmlspecialchars((string) $p) . '</p>', $conteudo));
    }
    $conteudo = trim((string) $conteudo);
    if ($conteudo === '') {
        return '';
    }

    $tags_permitidas = [
        'p', 'br', 'div', 'span', 'b', 'strong', 'i', 'em', 'u', 's', 'strike', 'del',
        'sub', 'sup', 'font', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol', 'li',
        'blockquote', 'pre', 'code', 'hr', 'a', 'img', 'mark',
    ];
    $atributos_permitidos = ['href', 'target', 'src', 'alt', 'title', 'style', 'color', 'size', 'face', 'align'];
    $estilos_permitidos   = ['color', 'background-color', 'text-align', 'font-weight', 'font-style', 'text-decoration', 'font-size', 'font-family'];

    if (!class_exists('DOMDocument')) {
        return strip_tags(preg_replace('/<(\w+)[^>]*>/', '<$1>', $conteudo), '<p><br><b><strong><i><em><u><s><h3><h4><ul><ol><li><blockquote>');
    }

    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="UTF-8"><div id="raiz-artigo">' . $conteudo . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $limpar = function (DOMNode $no) use (&$limpar, $tags_permitidas, $atributos_permitidos, $estilos_permitidos) {
        foreach (iterator_to_array($no->childNodes) as $filho) {
            if ($filho instanceof DOMComment || $filho instanceof DOMProcessingInstruction) {
                $no->removeChild($filho);
                continue;
            }
            if (!($filho instanceof DOMElement)) {
                continue;
            }
            $tag = strtolower($filho->nodeName);
            if (in_array($tag, ['script', 'style', 'iframe', 'object', 'embed', 'form', 'input', 'button', 'textarea', 'select'], true)) {
                $no->removeChild($filho);
                continue;
            }
            $limpar($filho);
            if (!in_array($tag, $tags_permitidas, true)) {
                while ($filho->firstChild) {
                    $no->insertBefore($filho->firstChild, $filho);
                }
                $no->removeChild($filho);
                continue;
            }
            foreach (iterator_to_array($filho->attributes) as $atributo) {
                $nome  = strtolower($atributo->nodeName);
                $valor = trim($atributo->nodeValue);
                if (!in_array($nome, $atributos_permitidos, true)) {
                    $filho->removeAttribute($atributo->nodeName);
                } elseif (in_array($nome, ['href', 'src'], true) && !preg_match('#^(https?:|mailto:|\.{0,2}/|[\w\-]+\.(php|html?|png|jpe?g|gif|webp)|\#|data:image/)#i', $valor)) {
                    $filho->removeAttribute($atributo->nodeName);
                } elseif ($nome === 'style') {
                    $regras = [];
                    foreach (explode(';', $valor) as $regra) {
                        [$propriedade, $conteudo_regra] = array_pad(array_map('trim', explode(':', $regra, 2)), 2, '');
                        if (in_array(strtolower($propriedade), $estilos_permitidos, true)
                            && $conteudo_regra !== ''
                            && !preg_match('/url\s*\(|expression|javascript/i', $conteudo_regra)) {
                            $regras[] = strtolower($propriedade) . ': ' . $conteudo_regra;
                        }
                    }
                    if ($regras) {
                        $filho->setAttribute('style', implode('; ', $regras));
                    } else {
                        $filho->removeAttribute('style');
                    }
                }
            }
            if ($tag === 'a') {
                $filho->setAttribute('rel', 'noopener');
            }
        }
    };

    $raiz = $dom->getElementById('raiz-artigo') ?? $dom->documentElement;
    $limpar($raiz);

    $html = '';
    foreach ($raiz->childNodes as $filho) {
        $html .= $dom->saveHTML($filho);
    }
    return $html;
}
$planos_alexandria = [
    'basico' => [
        'slug'   => 'basico',
        'nome'   => 'Plano Básico',
        'curto'  => 'Básico',
        'preco'  => 20.00,
        'nivel'  => 1,
        'itens'  => [
            'Conteúdos em texto otimizado para sua trilha;',
            'Banco de questões;',
            'Suporte exclusivo.',
        ],
    ],
    'avancado' => [
        'slug'   => 'avancado',
        'nome'   => 'Plano Avançado',
        'curto'  => 'Avançado',
        'preco'  => 30.00,
        'nivel'  => 2,
        'itens'  => [
            'Tudo da anterior;',
            'Simulados otimizados para os temas e trilha;',
            'Artigos exclusivos.',
        ],
    ],
    'premium' => [
        'slug'   => 'premium',
        'nome'   => 'Plano Premium',
        'curto'  => 'Premium',
        'preco'  => 40.00,
        'nivel'  => 3,
        'itens'  => [
            'Tudo das anteriores;',
            'Alexandr.IA para tirar todas suas dúvidas depois dos simulados;',
            'Acesso ilimitado a todas trilhas de concursos e vestibulares.',
        ],
    ],
];

$metodos_pagamento = [
    'cartao' => ['nome' => 'Cartão de Crédito', 'icone' => 'fa-regular fa-credit-card'],
    'pix'    => ['nome' => 'PIX',               'icone' => 'fa-brands fa-pix icone-pix'],
    'boleto' => ['nome' => 'Boleto',            'icone' => 'fa-solid fa-barcode'],
];

function preco_formatado(float $valor): string {
    return 'R$' . number_format($valor, 2, ',', '.');
}

function nivel_do_plano(?string $slug): int {
    global $planos_alexandria;
    return $planos_alexandria[$slug]['nivel'] ?? 0;
}

/**
 * Destino seguro para voltar depois do login/cadastro.
 * Aceita apenas caminhos relativos do próprio projeto (?redirecionar=...).
 */
function destino_redirecionamento(string $padrao = ''): string {
    $destino = $_GET['redirecionar'] ?? $_POST['redirecionar'] ?? '';
    $destino = trim((string) $destino);

    if ($destino === '' || preg_match('#^(https?:)?//#i', $destino) || str_contains($destino, '://')) {
        return $padrao;
    }

    return $destino;
}

/**
 * Regras de troca de plano no checkout.
 *
 * - Até 7 dias após a contratação, o aluno paga apenas a diferença de valor e
 *   o novo plano vale na hora.
 * - Depois de 7 dias, paga o valor cheio e o novo plano só começa quando
 *   terminar o período de 30 dias do plano atual.
 * - Sem plano ativo, paga o valor cheio e o acesso é imediato.
 *
 * @return array{tipo:string, valor:float, valor_cheio:float, dias_de_plano:int,
 *               inicio_acesso:?string, fim_plano_atual:?string, imediato:bool}
 */
function calculo_troca_de_plano(?string $plano_atual, string $plano_novo, ?string $plano_desde): array {
    global $planos_alexandria;

    $valor_cheio = $planos_alexandria[$plano_novo]['preco'] ?? 0.0;
    $resultado = [
        'tipo'            => 'novo',
        'valor'           => $valor_cheio,
        'valor_cheio'     => $valor_cheio,
        'dias_de_plano'   => 0,
        'inicio_acesso'   => null,
        'fim_plano_atual' => null,
        'imediato'        => true,
    ];

    if (!$plano_atual || !isset($planos_alexandria[$plano_atual])) {
        return $resultado;
    }

    $inicio = $plano_desde ? DateTime::createFromFormat('Y-m-d', $plano_desde) : false;
    if (!$inicio) {
        return $resultado;
    }

    $hoje = new DateTime('today');
    $dias = (int) $inicio->diff($hoje)->days;
    $fim  = (clone $inicio)->modify('+30 days');

    $resultado['dias_de_plano']   = $dias;
    $resultado['fim_plano_atual'] = $fim->format('Y-m-d');

    if ($dias <= 7) {
        $resultado['tipo']  = 'diferenca';
        $resultado['valor'] = max(0.0, $valor_cheio - $planos_alexandria[$plano_atual]['preco']);
        return $resultado;
    }

    $resultado['tipo']          = 'agendado';
    $resultado['imediato']      = false;
    $resultado['inicio_acesso'] = $fim->format('Y-m-d');
    return $resultado;
}

/** 'AAAA-MM-DD' -> 'DD/MM/AAAA'. */
function data_br(?string $data): string {
    $dt = $data ? DateTime::createFromFormat('Y-m-d', $data) : false;
    return $dt ? $dt->format('d/m/Y') : '—';
}
