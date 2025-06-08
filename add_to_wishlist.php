<?php
/* Dodaj proizvod u listu zelja */
require_once __DIR__ . '/config/config.php';

$pid = isset($_POST['pid']) ? (int)$_POST['pid'] : 0;
if ($pid > 0 && !empty($_SESSION['login'])) {
    $uid = (int)$_SESSION['user_id'];
    $stmt = mysqli_prepare($con, "INSERT IGNORE INTO wishlist (korisnik_id, proizvod_id) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ii', $uid, $pid);
    mysqli_stmt_execute($stmt);
}

$referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header('Location: ' . $referer);

