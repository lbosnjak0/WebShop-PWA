<?php
/** Dodaj proizvod u kosaricu */
require_once __DIR__ . '/config/config.php';
$pid = isset($_POST['pid']) ? (int)$_POST['pid'] : 0;
if ($pid > 0) {
    $_SESSION['cart'][$pid] = ($_SESSION['cart'][$pid] ?? 0) + 1;
}

$referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header('Location: ' . $referer);

