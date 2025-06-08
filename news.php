<?php
/* stranica sa vijestima */
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
      <section class="col-lg-9 col-md-9">
        <h2 class="mb-4">Vijesti</h2>
        <div class="row gy-4">

        <!-- ======= 1. vijest ======= -->
        <div class="col-md-12">
            <article class="card h-100 p-2">

                <!-- sve tri točke (slika, naslov, dugme) vode u isti modal -->
                <a data-bs-toggle="modal" data-bs-target="#news1">
                    <img src="slike/news/shop1.jpg" alt="">
                </a>

                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-decoration-none text-dark"
                           data-bs-toggle="modal" data-bs-target="#news1">
                           Otvaranje novog dućana
                        </a>
                    </h5>

                    <p class="small text-muted mb-1">12. svibnja 2025.</p>
                    <p class="card-text small">
                        S ponosom najavljujemo otvorenje našeg drugog dućana u Zagrebu...
                    </p>

                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#news1">
                        Saznaj više
                    </button>
                </div>
            </article>
        </div>

        <!-- ======= 2. vijest ======= -->
        <div class="col-md-12">
            <article class="card h-100 p-2">
                <a data-bs-toggle="modal" data-bs-target="#news2">
                    <img src="slike/news/spring.jpg" alt="">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-decoration-none text-dark"
                           data-bs-toggle="modal" data-bs-target="#news2">
                           Spring sale
                        </a>
                    </h5>
                    <p class="small text-muted mb-1">3. travnja 2025.</p>
                    <p class="card-text small">
                        Iskoristite do 30 % popusta na odabrane artikle do kraja travnja...
                    </p>
                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#news2">
                        Saznaj više
                    </button>
                </div>
            </article>
        </div>

        <!-- ======= 3. vijest ======= -->
        <div class="col-md-12">
            <article class="card h-100 p-2">
                <a data-bs-toggle="modal" data-bs-target="#news3">
                    <img src="slike/news/bikes.jpg" alt="">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-decoration-none text-dark"
                           data-bs-toggle="modal" data-bs-target="#news3">
                           Nova kolekcija e-bicikala
                        </a>
                    </h5>
                    <p class="small text-muted mb-1">20. ožujka 2025.</p>
                    <p class="card-text small">
                        Stigla je linija e-mobilnih gradskih bicikala s većom autonomijom…
                    </p>
                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#news3">
                        Saznaj više
                    </button>
                </div>
            </article>
        </div>

        <!-- ======= 4. vijest ======= -->
        <div class="col-md-12">
            <article class="card h-100 p-2">
                <a data-bs-toggle="modal" data-bs-target="#news4">
                    <img src="slike/news/stripovi.jpg" alt="">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-decoration-none text-dark"
                           data-bs-toggle="modal" data-bs-target="#news4">
                           Suradnja s lokalnim brendom
                        </a>
                    </h5>
                    <p class="small text-muted mb-1">5. veljače 2025.</p>
                    <p class="card-text small">
                        Predstavljamo limitiranu kolekciju stripova sa Fibrom iz Zagreba...
                    </p>
                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#news4">
                        Saznaj više
                    </button>
                </div>
            </article>
        </div>

        <!-- ======= 5. vijest ======= -->
        <div class="col-md-12">
            <article class="card h-100 p-2">
                <a data-bs-toggle="modal" data-bs-target="#news5">
                    <img src="slike/news/tree.jpg" alt="">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-decoration-none text-dark"
                           data-bs-toggle="modal" data-bs-target="#news5">
                           Humanitarna akcija
                        </a>
                    </h5>
                    <p class="small text-muted mb-1">28. sijećnja 2025.</p>
                    <p class="card-text small">
                        Prihod od svake prodane platnene vrećice doniramo za sadnju drveća…
                    </p>
                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#news5">
                        Saznaj više
                    </button>
                </div>
            </article>
        </div>

    </div><!-- /.row -->
</section>

<!-- Više teksta i sadrzaja -->

<div class="modal fade" id="news1" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <img src="slike/news/shop1.jpg" class="img-fluid rounded-top" alt="">
      <div class="modal-header">
        <h5 class="modal-title">Otvaranje novog dućana</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Uzvanici i stanovnici Zagreba pridružili su nam se 12. svibnja na svečanom otvaranju
        našeg drugog poslovnog prostora pored trgovačkog Z centra. Na površini od 500 m²
        predstavili smo prošireni asortiman sportskih i lifestyle proizvoda…</p>
        <p>Na vikend otvaranja 20% popusta na sve proizvode</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="news2" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <img src="slike/news/spring.jpg" class="img-fluid rounded-top" alt="">
      <div class="modal-header">
        <h5 class="modal-title">Proljetna rasprodaja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Od 3. do 30. travnja čekaju vas popusti do 30 % na odabrane artikle. Posebno
        izdvajamo monitele, tripove i e-mobilnost. Akcija vrijedi u
        webshopu i svim fizičkim poslovnicama…</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="news3" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <img src="slike/news/bikes.jpg" class="img-fluid rounded-top" alt="">
      <div class="modal-header">
        <h5 class="modal-title">Nova kolekcija e-bicikala</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Stigla nova kolekcija e bicikala od Himona. Stigla je nova linija gradskih e-bicikala, 
            nova i stara linija preklopnih e-bicikala, te stara linija off road e-bicikala.</p>
        <p>Uskoro bi trebala doći nova linija e-romobila i hoverbordova.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="news4" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <img src="slike/news/stripovi.jpg" class="img-fluid rounded-top" alt="">
      <div class="modal-header">
        <h5 class="modal-title">Suradnja s lokalnim brendom</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Sa ponosom možemo najaviti da ćemo od sada u našim fizičkim i online dućanima prodavati stripove
            od izdavača Fibre</p>
        <p>Koji su najavili da će vratiti u prodaju jedan rasprodani serijal koji će dobiti 
            najviše glasova na njihovoj web stranici. Tako da svi posjetiti fibra.hr i glasajte</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="news5" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <img src="slike/news/tree.jpg" class="img-fluid rounded-top" alt="">
      <div class="modal-header">
        <h5 class="modal-title">Humanitarna akcija </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Svakom prodajom platnenih vrećica doniramo dio za sadnju drveća. Te čemo svakom prodajom
             povrtnih i voćnih proizvoda u našim fizičkim lokacijama donirati lokalnim farmama.</p>
      </div>
    </div>
  </div>
</div>
</main>

<!-- Footer -->
<?php require_once __DIR__ . '/elementi/footer.php';?>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>