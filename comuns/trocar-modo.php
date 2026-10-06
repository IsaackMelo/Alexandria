<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['conta']['tipo'])) {
    header('Location: ../auth/login.php');
    exit;
}

$conta         = &$_SESSION['conta'];
$tipo_original = $conta['tipo_original'] ?? $conta['tipo'];

if ($tipo_original !== 'ADM') {
    header('Location: visualizar-curso.php');
    exit;
}

$modo = strtoupper($_GET['modo'] ?? '');

if ($modo === 'USER') {
    $conta['tipo_original'] = 'ADM';
    $conta['tipo']          = 'USER';
    if (empty($conta['plano'])) {
        $conta['plano']           = 'premium';
        $conta['plano_temporario'] = true;
    }
} elseif ($modo === 'ADM') {
    $conta['tipo'] = 'ADM';
    unset($conta['tipo_original']);
    if (!empty($conta['plano_temporario'])) {
        unset($conta['plano'], $conta['plano_temporario']);
    }
}

header('Location: visualizar-curso.php');
exit;