<?php
/** About stranica sa informacijama */
require_once __DIR__ . '/config/config.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Web Shop</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (za ikonice) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Vaš custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="slike/favicon.ico">
</head>
<body>

  <!-- HEADER (top-header, main-header, nav) -->
  <?php require_once __DIR__ . '/elementi/top-header.php'; ?>
  <?php require_once __DIR__ . '/elementi/main-header.php'; ?>
  <?php require_once __DIR__ . '/elementi/nav.php'; ?>

  <!-- GLAVNI SADRŽAJ -->
  <main class="py-4">
    <div class="container">
      <div class="row">

        <!-- ASIDE (ostaje isti) -->
        <?php require_once __DIR__ . '/elementi/aside.php'; ?>

        <!-- SECTION: O NAMA -->
        <section class="col-lg-9 col-md-9">
          <!-- Naslov i podnaslov -->
          <h2 class="mb-2">O nama</h2>
          <h5 class="text-muted mb-4">Naša priča, misija i vrijednosti</h5>

          <!-- Tri paragrafa teksta -->
          <p>
            Dobrodošli u Web Shop – online trgovinu koja je pokrenuta sa željom da
            ponudimo vrhunski izbor proizvoda po pristupačnim cijenama. Od samog početka,
            naš je cilj izgraditi mjesto gdje ćete uvijek pronaći najnovije trendove,
            ali i provjerene klasike iz svijeta tehnologije, sporta i knjiga.
          </p>

          <p>
            Kroz godine smo se razvijali zahvaljujući povjerenju tisuća zadovoljnih korisnika.
            Svakodnevno radimo na proširenju ponude, poboljšanju korisničkog iskustva te
            osiguravanju brzih i sigurnih dostava. Naša internetska platforma optimizirana
            je za sve uređaje, a podrška korisnicima stoji vam na raspolaganju 24/7.
          </p>

          <!-- Ugrađeni video (YouTube) -->
          <div class="ratio ratio-16x9 shadow-sm rounded mb-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/o-5UDSpEzTk?si=ECQpsmNP1u-rmJi7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>

          <p>
            Naš tim čine mladi, ambiciozni ljudi.
            Svaki dan radimo na unaprjeđenju web sučelja, automatizaciji procesa naručivanja
            i skladištenja.  
            Svjesni smo važnosti održivosti, pa se trudimo upotrijebiti ekološki prihvatljiva
            pakovanja i podržavamo projekte društveno odgovornog poslovanja.
          </p>

        </section>

      </div><!-- /.row -->
    </div><!-- /.container -->
  </main>

  <!-- FOOTER -->
  <?php require_once __DIR__ . '/elementi/footer.php'; ?>

  <!-- Bootstrap JavaScript bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
