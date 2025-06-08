<?php
/* izbriši iz kosarice. */
require_once __DIR__ . '/config/config.php';
$pid = isset($_POST['pid']) ? (int)$_POST['pid'] : 0;
if ($pid > 0 && isset($_SESSION['cart'][$pid])) {
    unset($_SESSION['cart'][$pid]);
}
$referer = $_SERVER['HTTP_REFERER'] ?? 'kosarica.php';
header('Location: ' . $referer);

