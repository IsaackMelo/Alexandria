<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

$isAdm  = $_SESSION['conta']['tipo'] === 'ADM';
$isUser = !$isAdm;

if ($isUser && empty($_SESSION['conta']['plano'])) {
    header('Location: ../web/plano.php');
    exit;
}
?>
<?php
require_once __DIR__ . '/../includes/dados.php';

$id_notificacao = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$notificacao = null;
foreach ($notificacoes as $item) {
    if ($id_notificacao !== null && $id_notificacao !== false && (int) $item['id'] === $id_notificacao) {
        $notificacao = $item;
        break;
    }
}

$banner_padrao = ['inicio' => '#5e1220', 'fim' => '#a0283a', 'destaque' => '#d4af37', 'icone' => 'fa-solid fa-bell', 'rotulo' => 'Notificação'];
$banner = $notificacao ? ($bannerTipos[$notificacao['tipo']] ?? $banner_padrao) : $banner_padrao;

$rotulos_status = ['urgente' => 'Urgente', 'nao_lida' => 'Não lida', 'lida' => 'Lida'];

function data_notificacao(?string $data): string {
    $dt = $data ? DateTime::createFromFormat('Y-m-d', $data) : false;
    if (!$dt) return '—';
    $meses = [1 => 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    return $dt->format('d') . ' ' . $meses[(int) $dt->format('n')] . ' ' . $dt->format('Y');
}

$estilo_banner = sprintf(
    '--banner-inicio: %s; --banner-fim: %s; --banner-destaque: %s;',
    $banner['inicio'], $banner['fim'], $banner['destaque']
);
if (!empty($notificacao['banner_imagem'])) {
    $estilo_banner .= " --banner-imagem: url('" . addslashes($notificacao['banner_imagem']) . "');";
}

$e = fn($valor) => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../imagens/alex.png">
    <title><?= $notificacao ? $e($notificacao['titulo']) . ' | ' : '' ?>Notificações</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estilo/alexandria.css">
    <link rel="stylesheet" href="../estilo/paginas/comuns-visualizar-notificacao.css">
<link rel="stylesheet" href="../estilo/responsivo.css">
</head>
<body>
    
    <?php include __DIR__ . '/../includes/sidebar.php';?>

    <div class="container-principal">
        
        <?php include __DIR__ . '/../includes/topbar.php';?>

        <div class="conteudo-area">

            <a href="visualizar-notificacoes.php" class="link-voltar"><i class="fa-solid fa-arrow-left"></i> Voltar para notificações</a>

            <?php if (!$notificacao): ?>

            <div class="hero-card" style="<?= $e($estilo_banner) ?>">
                <i class="<?= $e($banner['icone']) ?> hero-overlay-icon"></i>
                <div class="hero-content">
                    <h1 class="hero-title">Notificação não encontrada</h1>
                    <p class="hero-subtitle">A notificação solicitada não existe ou foi removida. Volte para a lista e escolha outra notificação.</p>
                    <a class="hero-acao" href="visualizar-notificacoes.php">Ver todas as notificações <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <?php else: ?>

            <div class="hero-card" style="<?= $e($estilo_banner) ?>">
                <i class="<?= $e($banner['icone']) ?> hero-overlay-icon"></i>
                <div class="hero-content">
                    <div class="hero-selos">
                        <span class="hero-selo destaque"><i class="<?= $e($banner['icone']) ?>"></i> <?= $e($banner['rotulo']) ?></span>
                        <span class="hero-selo"><?= $e($rotulos_status[$notificacao['status']] ?? $notificacao['status']) ?></span>
                        <span class="hero-selo"><i class="fa-regular fa-clock"></i> <?= $e($notificacao['tempo']) ?></span>
                    </div>
                    <h1 class="hero-title"><?= $e($notificacao['titulo']) ?></h1>
                    <p class="hero-subtitle"><?= $e($notificacao['descricao']) ?></p>
                    <?php if (!empty($notificacao['acao']['link'])): ?>
                    <a class="hero-acao" href="<?= $e($notificacao['acao']['link']) ?>">
                        <?= $e($notificacao['acao']['rotulo'] ?? 'Acessar') ?> <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="metadata-row">
                <div class="metadata-badge">
                    <i class="fa-regular fa-clock"></i>
                    <div>
                        <span class="meta-label">Tempo de leitura</span>
                        <span class="meta-value"><?= $e($notificacao['tempo_leitura'] ?? '—') ?></span>
                    </div>
                </div>
                <div class="metadata-badge">
                    <i class="fa-regular fa-user"></i>
                    <div>
                        <span class="meta-label">Autor</span>
                        <span class="meta-value"><?= $e($notificacao['autor'] ?? 'Equipe Alexandria') ?></span>
                    </div>
                </div>
                <div class="metadata-badge">
                    <i class="fa-regular fa-folder"></i>
                    <div>
                        <span class="meta-label">Categoria</span>
                        <span class="meta-value"><?= $e($notificacao['categoria'] ?? $banner['rotulo']) ?></span>
                    </div>
                </div>
                <div class="metadata-badge">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <span class="meta-label">Última atualização</span>
                        <span class="meta-value"><?= $e(data_notificacao($notificacao['atualizado_em'] ?? null)) ?></span>
                    </div>
                </div>
            </div>

            <?php foreach ($notificacao['secoes'] ?? [] as $secao): ?>
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="<?= $e($secao['icone'] ?? 'fa-solid fa-scroll') ?>"></i>
                    </div>
                    <h2 class="section-title"><?= $e($secao['titulo'] ?? '') ?></h2>
                </div>
                <div class="section-body">
                    <?php foreach ($secao['paragrafos'] ?? [] as $paragrafo): ?>
                    <p><?= $e($paragrafo) ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>