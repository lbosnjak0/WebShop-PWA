<?php
/* lista kategorija u bazi */
require_once __DIR__ . '/config/config.php';

/* 1) VALIDIRAJ ID KATEGORIJE */
$kat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($kat_id <= 0) { header('Location: index.php'); exit; }

/* 2) DOHVATI NAZIV KATEGORIJE */
$stmt = mysqli_prepare($con, "SELECT naziv FROM kategorije WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $kat_id);
mysqli_stmt_execute($stmt);
$kat_res = mysqli_stmt_get_result($stmt);
$kat_row = mysqli_fetch_assoc($kat_res);
if (!$kat_row) { header('Location: index.php'); exit; }
$kat_naziv = $kat_row['naziv'];

/* 3) DOHVATI PROIZVODE + PRVU SLIKU (thumbnail) */
$sql = "
  SELECT p.id, p.naziv, p.opis, p.cijena, p.dostupnost,
         COALESCE(
            (SELECT file_path
             FROM slike_proizvoda
             WHERE product_id = p.id
             ORDER BY sort LIMIT 1),
            'slike/placeholder.jpg'
         ) AS thumbnail
  FROM proizvodi p
  WHERE p.idKategorija = ?
  ORDER BY p.id DESC";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $kat_id);
mysqli_stmt_execute($stmt);
$proiz_res = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Shop</title>
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

<div class="container my-5">
  <div class="row">
    <?php require_once __DIR__ . '/elementi/aside.php';?>

    <main class="col-md-9">
      <h2 class="mb-4"><?= htmlspecialchars($kat_naziv) ?></h2>

      <?php if (mysqli_num_rows($proiz_res) === 0): ?>
          <p>U ovoj kategoriji trenutačno nema proizvoda.</p>
      <?php else: ?>
        <div class="row g-4">
          <?php while ($p = mysqli_fetch_assoc($proiz_res)): ?>
            <div class="col-sm-6 col-lg-4">
              <article class="card h-100 product-card">
                <img src="<?= $p['thumbnail'] ?>"
                     class="card-img-top" alt="">

                <div class="card-body d-flex flex-column">
                  <h6 class="card-title mb-1">
                    <?= htmlspecialchars($p['naziv']) ?>
                  </h6>

                  <p class="small text-muted flex-grow-1 short-text">
                    <?= mb_strimwidth(strip_tags($p['opis']), 0, 80, '…') ?>
                  </p>
                  <p class="small text-muted flex-grow-1 full-text d-none">
                    <?= htmlspecialchars($p['opis']) ?>
                  </p>

                  <div class="fw-bold mb-1">
                    € <?= number_format($p['cijena'], 2, ',', '.') ?>
                  </div>

                  <span class="badge
                        <?= $p['dostupnost'] ? 'bg-success' : 'bg-danger' ?>">
                    <?= $p['dostupnost'] ? 'Na zalihi' : 'Nedostupno' ?>
                  </span>

                  <div class="mt-3 d-flex gap-2">
                    <form method="post" action="add_to_cart.php" class="flex-grow-1">
                      <input type="hidden" name="pid" value="<?= $p['id'] ?>">
                      <button class="btn btn-sm btn-primary w-100" <?= $p['dostupnost'] ? '' : 'disabled' ?>>
                        Dodaj u košaricu
                      </button>
                    </form>
                    <form method="post" action="add_to_wishlist.php">
                      <input type="hidden" name="pid" value="<?= $p['id'] ?>">
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-heart"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </article>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </main>
  </div>
</div>

<!-- Footer -->
<?php require_once __DIR__ . '/elementi/footer.php';?>

<!-- Bootstrap functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Behaviour for expanding product cards -->
<script src="js/product-card.js"></script>

</body>
</html>