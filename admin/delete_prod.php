<?php
/* admin panel brisanje proizvoda i njegove slike iz baze */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}
$id=(int)($_GET['id']??0);
if($id){
    // brisanje slika koje su povezane sa proizvodom
    $stmt=mysqli_prepare($con,"SELECT file_path FROM slike_proizvoda WHERE product_id=?");
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);
    while($row=mysqli_fetch_assoc($res)){
        $filepath=__DIR__.'/../'.$row['file_path'];
        if(is_file($filepath)){
            unlink($filepath);
        }
    }
    mysqli_stmt_close($stmt);

    // izbrisi sve slike 
    $stmt=mysqli_prepare($con,"DELETE FROM slike_proizvoda WHERE product_id=?");
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // izbrisi proizvod
    $stmt=mysqli_prepare($con,"DELETE FROM proizvodi WHERE id=?");
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
header('Location: panel.php');

