<?php
/* admin panel dodavanje proizvoda u bazu */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}
$naziv=trim($_POST['naziv']??'');
$opis=trim($_POST['opis']??'');
$cijena=floatval($_POST['cijena']??0);
$kat=(int)($_POST['kategorija']??0);
if($naziv && $kat){
    $stmt=mysqli_prepare($con,"INSERT INTO proizvodi (idKategorija,naziv,opis,cijena,dostupnost) VALUES (?,?,?,?,10)");
    mysqli_stmt_bind_param($stmt,'issd',$kat,$naziv,$opis,$cijena);
    mysqli_stmt_execute($stmt);
    $pid=mysqli_insert_id($con);

    if(!empty($_FILES['image']['name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
        $dir=__DIR__.'/../slike/proizvodi/';
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        $ext=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        $fname=uniqid('img_',true).'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'],$dir.$fname);
        $path='slike/proizvodi/'.$fname;
        $alt=$naziv;
        $stmt=mysqli_prepare($con,"INSERT INTO slike_proizvoda (product_id,file_path,alt_text,sort) VALUES (?,?,?,1)");
        mysqli_stmt_bind_param($stmt,'iss',$pid,$path,$alt);
        mysqli_stmt_execute($stmt);
    }
}
header('Location: panel.php');

