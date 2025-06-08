<?php
require_once __DIR__ . '/config/config.php';
error_reporting(0);

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

<main class="py-4">
  <div class="container">
    <div class="row">

      <!-- Aside -->
       <?php require_once __DIR__ . '/elementi/aside.php';?>

      <!-- Main -->
      <section class="col-lg-9">

        <!-- Vijesti -->
        <h2 class="mb-3">Najnovije vijesti</h2>
        <div class="row">
          <article class="col-md-6 mb-4">
            <div class="card h-100">
              <img src="slike/main/shop.jpg" alt="Slika vijesti 1">
              <div class="card-body">
                <h5 class="card-title">Otvaranje novog dućana</h5>
                <p class="card-text">S ponosom najavljujemo otvorenje našeg drugog dućana u Zagrebu...</p>
                <a href="news.php" class="btn btn-sm btn-primary">Saznaj više</a>
              </div>
            </div>
          </article>

          <article class="col-md-6 mb-4">
            <div class="card h-100">
              <img src="slike/main/sale.jpg" alt="Slika vijesti 2">
              <div class="card-body">
                <h5 class="card-title">Ljetna rasprodaja</h5>
                <p class="card-text">Iskoristite do 30% popusta na odabrane artikle do kraja svibnja...</p>
                <a href="news.php" class="btn btn-sm btn-primary">Saznaj više</a>
              </div>
            </div>
          </article>
        </div>

        <!-- Proizvodi -->
        <h2 class="mt-4 mb-3">Izdvojeni artikli</h2>
        <div class="row">
          <div class="col-sm-6 col-md-4 mb-4">
            <div class="card h-100">
              <img src="slike/main/swamp.jpg" class="card-img-top" alt="Proizvod 1">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Komplet Čudovište iz močvare</h5>
                <p class="card-text">Kategorija: Knjiga</p>
                <p class="card-text">Spektakularan horror strip od poznatog pisca Alan Moora</p>
                <p class="card-text">Cijena: 200 €</p>
                <a href="#" class="btn btn-outline-primary mt-auto">Detalji</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 mb-4">
            <div class="card h-100">
              <img src="slike/main/s25.jpg" class="card-img-top" alt="Proizvod 2">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Samsung Galaxy S25</h5>
                <p class="card-text">Kategorija: Mobitel</p>
                <p class="card-text">Mobitel Samsung Galaxy S25 5G 12/256GB ledeno plavi SM-S931</p>
                <p class="card-text">Cijena: 1000 €</p>
                <a href="#" class="btn btn-outline-primary mt-auto">Detalji</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 mb-4">
            <div class="card h-100">
              <img src="slike/main/bike.jpg" class="card-img-top" alt="Proizvod 3">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Himo Z20 MAX</h5>
                <p class="card-text">Kategorija: E-mobility</p>
                <p class="card-text">Combo Sale - HIMO Z20 MAX Folding Electric Bike*2</p>
                <p class="card-text">Cijena: 1600 €</p>
                <a href="#" class="btn btn-outline-primary mt-auto">Detalji</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>

<!-- Footer -->
<?php require_once __DIR__ . '/elementi/footer.php';?>

<!-- Bootstrap bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Handles product card expansion behaviour -->
<script src="js/product-card.js"></script>

</body>
</html>