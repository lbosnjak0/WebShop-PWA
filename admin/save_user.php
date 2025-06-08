<?php
/* admin panel dodavanje korisnika u bazu */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}

$u = trim($_POST['username'] ?? '');
$e = trim($_POST['email'] ?? '');
$p = $_POST['password'] ?? '';

if($u && $e && $p){
    $stmt = mysqli_prepare($con,"SELECT COUNT(*) FROM korisnici WHERE username=? OR email=?");
    mysqli_stmt_bind_param($stmt,'ss',$u,$e);
    mysqli_stmt_execute($stmt);
    $cnt = (int)mysqli_fetch_row(mysqli_stmt_get_result($stmt))[0];
    if(!$cnt){
        $hash = password_hash($p, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($con,"INSERT INTO korisnici (username,email,pass_hash) VALUES (?,?,?)");
        mysqli_stmt_bind_param($stmt,'sss',$u,$e,$hash);
        mysqli_stmt_execute($stmt);
    }
}
header('Location: panel.php');

