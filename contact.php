<?php
/* Kontakt page. */
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

        <!-- SECTION: Kontakt -->
        <section class="col-lg-9 col-md-9">
          <h2 class="mb-4">Kontakt</h2>

          <div class="row gy-4">
            <!-- 1) Google Maps -->
            <div class="col-12">
              <div class="ratio ratio-16x9 shadow-sm rounded">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2705.297062064555!2d15.884435755248496!3d45.80113224098203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1shr!2shr!4v1748977842273!5m2!1shr!2shr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>

            <!-- 2) Kontakntna forma -->
            <div class="col-12">
              <form action="#" method="post" class="row g-3 needs-validation" novalidate>
                <!-- Hidden field za identifikaciju forme (ako želite backend obradu u istom fajlu) -->
                <input type="hidden" name="action" value="contact_form">

                <div class="col-md-6">
                  <label for="Ime" class="form-label">Ime <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="Ime" name="Ime" required>
                  <div class="invalid-feedback">
                    Molimo unesite svoje ime.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="prezime" class="form-label">prezime <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="prezime" name="prezime" required>
                  <div class="invalid-feedback">
                    Molimo unesite svoje prezime.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="email" class="form-label">Vaš E-mail <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
                  <div class="invalid-feedback">
                    Molimo unesite ispravan e-mail.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="drzava" class="form-label">Drzava <span class="text-danger">*</span></label>
                  <select id="drzava" name="drzava" class="form-select" required>
                    <option value="">Odaberite...</option>
                    <option value="Hrvatska">Hrvatska</option>
                    <option value="Slovenija">Slovenija</option>
                    <option value="Bosna i Hercegoina">Bosna i Hercegoina</option>
                    <option value="Srbija">Srbija</option>
                    <option value="Drugo">Drugo</option>
                  </select>
                  <div class="invalid-feedback">
                    Molimo odaberite državu.
                  </div>
                </div>

                <!-- Newsletter Checkbox -->
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                    <label class="form-check-label" for="newsletter">
                      Želim primati newsletter
                    </label>
                  </div>
                </div>

                <!-- Subject (textarea) -->
                <div class="col-12">
                  <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="subject" name="subject" rows="4" required></textarea>
                  <div class="invalid-feedback">
                    Molimo napišite poruku.
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                  <button class="btn btn-primary px-4" type="submit">Pošalji poruku</button>
                </div>
              </form>
            </div>
          </div><!-- /.row -->
        </section>

      </div><!-- /.row -->
    </div><!-- /.container -->
  </main>

  <!-- FOOTER -->
  <?php require_once __DIR__ . '/elementi/footer.php'; ?>

  <!-- Bootstrap JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Enable client-side form validation -->
  <script>
    // Primjerić Bootstrap-ove validacije
    (function () {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })();
  </script>

</body>
</html>
