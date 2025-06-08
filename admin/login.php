<?php
/* admin panel prijava */
ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once __DIR__.'/../config/config.php';
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $u=trim($_POST['username']);
    $p=$_POST['password']??'';
    $stmt=mysqli_prepare($con,"SELECT id,pass_hash FROM admini WHERE username=?");
    mysqli_stmt_bind_param($stmt,'s',$u);
    mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($res);
    if($row && password_verify($p,$row['pass_hash'])){
        $_SESSION['admin']=true;
        $_SESSION['admin_id']=$row['id'];
        header('Location: panel.php');exit;
    }else{
        $err='Neispravni podaci';
    }
}
/*
echo password_hash('123', PASSWORD_DEFAULT);
$2y$10$EENrbOhnrwiW3NnT47spDuFiehg675F9K3VmIHQWiDnxdnL4.Hesq 
*/
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Admin prijava</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width:400px;">
<h2 class="mb-4">Admin prijava</h2>
<?php if($err):?><div class="alert alert-danger"><?=$err?></div><?php endif;?>
<form method="post" class="vstack gap-3">
<input class="form-control" name="username" placeholder="Korisničko ime" required>
<input type="password" class="form-control" name="password" placeholder="Lozinka" required>
<button class="btn btn-primary w-100">Prijava</button>
</form>
</div>
</body>
</html>

