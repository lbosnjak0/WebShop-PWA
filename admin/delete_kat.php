<?php
/* admin panel brisanje kategorije iz baze */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}
$id=(int)($_GET['id']??0);
if($id){
    $stmt=mysqli_prepare($con,"DELETE FROM kategorije WHERE id=?");
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
}
header('Location: panel.php');

