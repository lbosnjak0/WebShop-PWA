<?php
/* lista zelja za ulogiranog korisnika */
require_once __DIR__ . '/config/config.php';
if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
$uid = (int)$_SESSION['user_id'];
$res = mysqli_query($con, "SELECT p.id, p.naziv, p.cijena FROM proizvodi p JOIN wishlist w ON p.id = w.proizvod_id WHERE w.korisnik_id = $uid");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Lista želja</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php require_once __DIR__ . '/elementi/top-header.php'; ?>
<?php require_once __DIR__ . '/elementi/main-header.php'; ?>
<?php require_once __DIR__ . '/elementi/nav.php'; ?>
<div class="container my-5">
<h2>Lista želja</h2>
<?php if (mysqli_num_rows($res)===0): ?>
<p>Nema proizvoda u listi želja.</p>
<?php else: ?>
<table class="table">
<thead><tr><th>Proizvod</th><th>Cijena</th></tr></thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($res)): ?>
<tr><td><?= htmlspecialchars($row['naziv']) ?></td><td>€ <?= number_format($row['cijena'],2,',','.') ?></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php endif; ?>
</div>
<?php require_once __DIR__ . '/elementi/footer.php'; ?>
<!-- Bootstrap scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

