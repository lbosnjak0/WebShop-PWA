<?php
/* admin panel */
require_once __DIR__.'/../config/config.php';
if(empty($_SESSION['admin'])){header('Location: login.php');exit;}

// dostavljanje proizvoda
if(isset($_GET['delivered'])){
    $oid=(int)$_GET['delivered'];
    mysqli_query($con,"UPDATE narudzbe SET status=2 WHERE id=$oid");
    header('Location: panel.php');exit;
}

$orders=mysqli_query($con,"SELECT n.id, n.status, n.created_at, k.username FROM narudzbe n LEFT JOIN korisnici k ON n.korisnik_id=k.id ORDER BY n.id DESC");
$categories=mysqli_query($con,"SELECT * FROM kategorije ORDER BY id DESC");
$products=mysqli_query($con,"SELECT p.id,p.naziv,p.opis,p.cijena,k.naziv AS kat FROM proizvodi p LEFT JOIN kategorije k ON p.idKategorija=k.id ORDER BY p.id DESC");
$users=mysqli_query($con,"SELECT id,username,email FROM korisnici ORDER BY id DESC");
$reviews=mysqli_query($con,"SELECT r.id,r.tekst,r.created_at,k.username FROM recenzije r LEFT JOIN korisnici k ON r.korisnik_id=k.id ORDER BY r.created_at DESC");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Admin panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-4">
<a href="logout.php" class="btn btn-sm btn-secondary float-end">Odjava</a>
<h2>Admin panel</h2>
<h4 class="mt-4">Narudžbe</h4>
<table class="table table-sm">
<thead><tr><th>#</th><th>Korisnik</th><th>Status</th><th>Akcija</th></tr></thead>
<tbody>
<?php while($o=mysqli_fetch_assoc($orders)): ?>
<tr>
<td><?=$o['id']?></td>
<td><?=htmlspecialchars($o['username'])?></td>
<td><?=$o['status']==1?'U tijeku':'Dostavljeno'?></td>
<td><?php if($o['status']==1): ?><a href="?delivered=<?=$o['id']?>" class="btn btn-sm btn-success">Označi dostavljeno</a><?php endif; ?></td>
</tr>
<?php endwhile; ?>
</tbody></table>

<h4 class="mt-5">Kategorije</h4>
<table class="table table-sm">
<thead><tr><th>#</th><th>Naziv</th><th>Akcija</th></tr></thead>
<tbody>
<?php while($k=mysqli_fetch_assoc($categories)): ?>
<tr>
<td><?=$k['id']?></td>
<td><?=htmlspecialchars($k['naziv'])?></td>
<td><a href="delete_kat.php?id=<?=$k['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Brisati kategoriju?')">Obriši</a></td>
</tr>
<?php endwhile; ?>
</tbody></table>
<form method="post" action="save_kat.php" class="d-flex mb-4"><input class="form-control me-2" name="naziv" placeholder="Nova kategorija" required><button class="btn btn-primary">Dodaj</button></form>

<h4>Proizvodi</h4>
<table class="table table-sm">
<thead><tr><th>#</th><th>Naziv</th><th>Opis</th><th>Kategorija</th><th>Cijena</th><th>Akcija</th></tr></thead>
<tbody>
<?php while($p=mysqli_fetch_assoc($products)): ?>
<tr>
<td><?=$p['id']?></td>
<td><?=htmlspecialchars($p['naziv'])?></td>
<td><?=mb_strimwidth(strip_tags($p['opis']),0,50,'…')?></td>
<td><?=$p['kat']?></td>
<td><?=$p['cijena']?></td>
<td><a href="delete_prod.php?id=<?=$p['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Brisati proizvod?')">Obriši</a></td>
</tr>
<?php endwhile; ?>
</tbody></table>
<form method="post" action="save_prod.php" enctype="multipart/form-data" class="row g-2 mb-4">
<div class="col"><input class="form-control" name="naziv" placeholder="Naziv" required></div>
<div class="col"><input class="form-control" name="opis" placeholder="Opis" required></div>
<div class="col"><input class="form-control" name="cijena" placeholder="Cijena" required></div>
<div class="col"><select class="form-select" name="kategorija">
<?php mysqli_data_seek($categories,0); while($k=mysqli_fetch_assoc($categories)): ?>
<option value="<?=$k['id']?>"><?=$k['naziv']?></option>
<?php endwhile; ?>
</select></div>
<div class="col"><input type="file" class="form-control" name="image"></div>
<div class="col"><button class="btn btn-primary">Dodaj</button></div>
</form>

<h4 class="mt-5">Korisnici</h4>
<table class="table table-sm">
<thead><tr><th>#</th><th>Korisničko ime</th><th>Email</th><th>Akcija</th></tr></thead>
<tbody>
<?php while($u=mysqli_fetch_assoc($users)): ?>
<tr>
<td><?=$u['id']?></td>
<td><?=htmlspecialchars($u['username'])?></td>
<td><?=htmlspecialchars($u['email'])?></td>
<td><a href="delete_user.php?id=<?=$u['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Brisati korisnika?')">Obriši</a></td>
</tr>
<?php endwhile; ?>
</tbody></table>
<form method="post" action="save_user.php" class="row g-2 mb-4">
<div class="col"><input class="form-control" name="username" placeholder="Korisničko ime" required></div>
<div class="col"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
<div class="col"><input class="form-control" type="password" name="password" placeholder="Lozinka" required></div>
<div class="col"><button class="btn btn-primary">Dodaj</button></div>
</form>

<h4 class="mt-5">Recenzije</h4>
<table class="table table-sm">
<thead><tr><th>#</th><th>Korisnik</th><th>Tekst</th><th>Datum</th><th>Akcija</th></tr></thead>
<tbody>
<?php while($r=mysqli_fetch_assoc($reviews)): ?>
<tr>
<td><?=$r['id']?></td>
<td><?=htmlspecialchars($r['username']??'Anonimni')?></td>
<td><?=htmlspecialchars(mb_strimwidth($r['tekst'],0,50,'…'))?></td>
<td><?=$r['created_at']?></td>
<td><a href="delete_review.php?id=<?=$r['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Brisati recenziju?')">Obriši</a></td>
</tr>
<?php endwhile; ?>
</tbody></table>
<form method="post" action="save_review.php" class="mb-4">
<textarea class="form-control mb-2" name="tekst" rows="3" placeholder="Nova recenzija" required></textarea>
<button class="btn btn-primary">Dodaj</button>
</form>
</div>
</body>
</html>

