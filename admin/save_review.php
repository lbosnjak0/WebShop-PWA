<?php
/* admin panel dodavanje recenzije u bazu */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}
$tekst = trim($_POST['tekst'] ?? '');
if($tekst !== ''){
    $stmt = mysqli_prepare($con,"INSERT INTO recenzije (korisnik_id, tekst) VALUES (NULL, ?)");
    mysqli_stmt_bind_param($stmt,'s',$tekst);
    mysqli_stmt_execute($stmt);
}
header('Location: panel.php');
