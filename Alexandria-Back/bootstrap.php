<?php

require_once BASE_PATH . '/config/database.php';

require_once BASE_PATH . '/utils/JWT.php';

require_once BASE_PATH . '/middlewares/AuthMiddleware.php';
require_once BASE_PATH . '/middlewares/AdminMiddleware.php';
require_once BASE_PATH . '/middlewares/PlanoMiddleware.php';

require_once BASE_PATH . '/models/Usuario.php';
require_once BASE_PATH . '/models/Conteudo.php';
require_once BASE_PATH . '/models/Simulado.php';
require_once BASE_PATH . '/models/Resultado.php';
require_once BASE_PATH . '/models/Questao.php';
require_once BASE_PATH . '/models/Plano.php';
require_once BASE_PATH . '/models/Assinatura.php';
require_once BASE_PATH . '/models/Contato.php';

require_once BASE_PATH . '/controllers/AuthController.php';
require_once BASE_PATH . '/controllers/UsuarioController.php';
require_once BASE_PATH . '/controllers/ConteudoController.php';
require_once BASE_PATH . '/controllers/SimuladoController.php';
require_once BASE_PATH . '/controllers/QuestaoController.php';
require_once BASE_PATH . '/controllers/IAController.php';
require_once BASE_PATH . '/controllers/PlanoController.php';
require_once BASE_PATH . '/controllers/AssinaturaController.php';
require_once BASE_PATH . '/controllers/PagamentoController.php';
require_once BASE_PATH . '/controllers/ContatoController.php';