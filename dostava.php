<?php
/* Prikazi narudzbe od korisnika */
require_once __DIR__ . '/config/config.php';
if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
$uid = (int)$_SESSION['user_id'];
$res = mysqli_query($con, "SELECT id, status, created_at FROM narudzbe WHERE korisnik_id = $uid ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Praćenje narudžbi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php require_once __DIR__ . '/elementi/top-header.php'; ?>
<?php require_once __DIR__ . '/elementi/main-header.php'; ?>
<?php require_once __DIR__ . '/elementi/nav.php'; ?>
<div class="container my-5">
<h2>Praćenje narudžbi</h2>
<?php if (mysqli_num_rows($res)===0): ?>
<p>Nemate narudžbi.</p>
<?php else: ?>
<table class="table">
<thead><tr><th>#</th><th>Status</th><th>Datum</th></tr></thead>
<tbody>
<?php while($o=mysqli_fetch_assoc($res)): ?>
<tr><td><?= $o['id'] ?></td><td><?= $o['status']==1?'U tijeku':'Dostavljeno' ?></td><td><?= $o['created_at'] ?></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php endif; ?>
</div>
<?php require_once __DIR__ . '/elementi/footer.php'; ?>
<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

