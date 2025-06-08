<?php
/* admin panel dodavanje kategorije u bazu */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}
$name=trim($_POST['naziv']??'');
if($name){
    $stmt=mysqli_prepare($con,"INSERT INTO kategorije (naziv) VALUES (?)");
    mysqli_stmt_bind_param($stmt,'s',$name);
    mysqli_stmt_execute($stmt);
}
header('Location: panel.php');

