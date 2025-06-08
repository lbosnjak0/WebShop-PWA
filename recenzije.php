<?php
/* recenzije */
/* dopusta prijavljenom korisniku da ostavi recenziju */
require_once __DIR__ . '/config/config.php';
if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
$uid = (int)$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tekst   = trim($_POST['tekst'] ?? '');
    $rating  = (int)($_POST['rating'] ?? 0);
    if ($rating < 0 || $rating > 5) {
        $rating = 0;
    }
    if ($tekst !== '') {
        $stmt = mysqli_prepare(
            $con,
            "INSERT INTO recenzije (korisnik_id, tekst, rating) VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, 'isi', $uid, $tekst, $rating);
        mysqli_stmt_execute($stmt);
    }
    header('Location: recenzije.php');
    exit;
}

$res = mysqli_query(
    $con,
    "SELECT r.tekst, r.rating, r.created_at, k.username
     FROM recenzije r
     LEFT JOIN korisnici k ON r.korisnik_id = k.id
     ORDER BY r.created_at DESC"
);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recenzije</title>
  <!-- Bootstrap 5-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="shortcut icon" href="slike/favicon.ico">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/product-img.css">
</head>
<body>

<!-- Header(top, main i nav)-->
<?php require_once __DIR__ . '/elementi/top-header.php';?>
<?php require_once __DIR__ . '/elementi/main-header.php';?>
<?php require_once __DIR__ . '/elementi/nav.php';?>

<div class="container my-5" style="max-width:600px;">
<h2 class="mb-4">Recenzije webshopa</h2>
<form method="post" class="mb-4">
<textarea class="form-control mb-2" name="tekst" rows="3" placeholder="Vaša recenzija..." required></textarea>
<div class="rating mb-2">
  <?php for($i=5;$i>=1;$i--): ?>
  <input type="radio" name="rating" id="star<?= $i ?>" value="<?= $i ?>">
  <label for="star<?= $i ?>" class="fa fa-star"></label>
  <?php endfor; ?>
  <input type="radio" name="rating" id="star0" value="0" checked>
  <label for="star0" class="fa fa-star zero-star"></label>
</div>
<button class="btn btn-primary">Dodaj recenziju</button>
</form>
<?php while($row = mysqli_fetch_assoc($res)): ?>
<div class="border rounded p-3 mb-3">
<div class="small text-muted"><?= htmlspecialchars($row['username'] ?? 'Anonimni') ?> - <?= $row['created_at'] ?></div>
<div>
  <?php for ($i = 1; $i <= 5; $i++): ?>
    <?php if ($i <= (int)$row['rating']): ?>
      <i class="fa-solid fa-star text-warning"></i>
    <?php else: ?>
      <i class="fa-regular fa-star text-warning"></i>
    <?php endif; ?>
  <?php endfor; ?>
  <span class="ms-2">(<?= (int)$row['rating'] ?>)</span>
</div>
<p class="mb-0"><?= nl2br(htmlspecialchars($row['tekst'])) ?></p>
</div>
<?php endwhile; ?>
</div>

<!-- Footer -->
<?php require_once __DIR__ . '/elementi/footer.php';?>

<!-- Bootstrap JS components -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Expands/collapses product text cards -->
<script src="js/product-card.js"></script>

</body>
</html>
