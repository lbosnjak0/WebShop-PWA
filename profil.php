<?php
/** User profile page where users can update their data. */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config/config.php';

/* 1) PROVJERA PRIJAVE */
if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

/* 2) Dohvati sve podatke o korisniku iz baze */
$userId = (int) $_SESSION['user_id'];
$query  = "SELECT username, email, pass_hash, Dan_Uclanjenja,
                  ime, telefon, ulica, postanski_broj, grad, drzava
           FROM korisnici WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
if ($stmt === false) {
    die("SQL priprema za SELECT nije uspjela: " . mysqli_error($con));
}
mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user   = mysqli_fetch_assoc($result);

if (!$user) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

/* 3) Provjeri popunjenost profila */
$polja = ['ime', 'telefon', 'ulica', 'postanski_broj', 'grad', 'drzava'];
$kompletan = true;
foreach ($polja as $polje) {
    if (empty(trim($user[$polje] ?? ''))) {
        $kompletan = false;
        break;
    }
}

/* 4) Ako je poslan POST, obrađujemo ažuriranje */
$errMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime            = trim($_POST['ime'] ?? '');
    $telefon        = trim($_POST['telefon'] ?? '');
    $ulica          = trim($_POST['ulica'] ?? '');
    $postanski_broj = trim($_POST['postanski_broj'] ?? '');
    $grad           = trim($_POST['grad'] ?? '');
    $drzava         = trim($_POST['drzava'] ?? '');

    if ($ime === '' || $telefon === '' || $ulica === '' ||
        $postanski_broj === '' || $grad === '' || $drzava === '') {
        $errMsg = 'Molimo popunite sva obavezna polja (označena zvjezdicom).';
    } else {
        $updateSql = "
            UPDATE korisnici
            SET ime = ?, telefon = ?, ulica = ?,
                postanski_broj = ?, grad = ?, drzava = ?
            WHERE id = ?";
        $uStmt = mysqli_prepare($con, $updateSql);
        if ($uStmt === false) {
            die("SQL priprema za UPDATE nije uspjela: " . mysqli_error($con));
        }

        // šest stringova + jedan integer = ukupno 7 tipova: 'ssssssi'
        mysqli_stmt_bind_param(
            $uStmt, 'ssssssi',
            $ime, $telefon, $ulica,
            $postanski_broj, $grad, $drzava, $userId
        );

        if (!mysqli_stmt_execute($uStmt)) {
            die("SQL izvršenje za UPDATE nije uspjelo: " . mysqli_stmt_error($uStmt));
        }

        header("Location: profil.php?updated=1");
        exit;
    }
}

if (isset($_GET['updated']) && $_GET['updated'] == '1') {
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);
    $kompletan = true;
}
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

  <!-- HEADER -->
  <?php require_once __DIR__ . '/elementi/top-header.php'; ?>
  <?php require_once __DIR__ . '/elementi/main-header.php'; ?>
  <?php require_once __DIR__ . '/elementi/nav.php'; ?>

  <main class="py-4">
    <div class="container">
      <div class="row">

        <section class="col-lg-12 col-md-12">
          <h2 class="mb-4">Vaš profil</h2>

          <?php if (!$kompletan): ?>
            <div class="alert alert-warning">
              Molimo Vas da dovršite podatke u profilu prije nego što nastavite dalje.
            </div>
          <?php endif; ?>

          <?php if ($errMsg): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errMsg) ?></div>
          <?php endif; ?>

          <form method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
              <label for="ime" class="form-label">Ime i prezime <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="ime" name="ime"
                     value="<?= htmlspecialchars($user['ime'] ?? '') ?>" required>
              <div class="invalid-feedback">
                Molimo unesite svoje ime i prezime.
              </div>
            </div>

            <div class="col-md-6">
              <label for="username" class="form-label">Korisničko ime</label>
              <input type="text" class="form-control" id="username"
                     value="<?= htmlspecialchars($user['username']) ?>" disabled>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email"
                     value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>

            <div class="col-md-6">
              <label for="telefon" class="form-label">Broj mobitela <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="telefon" name="telefon"
                     value="<?= htmlspecialchars($user['telefon'] ?? '') ?>" required>
              <div class="invalid-feedback">
                Molimo unesite broj mobitela.
              </div>
            </div>

            <div class="col-md-6">
              <label for="ulica" class="form-label">Ulica i broj <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="ulica" name="ulica"
                     value="<?= htmlspecialchars($user['ulica'] ?? '') ?>" required>
              <div class="invalid-feedback">
                Molimo unesite ulicu i kućni broj.
              </div>
            </div>

            <div class="col-md-6">
              <label for="postanski_broj" class="form-label">Poštanski broj <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="postanski_broj" name="postanski_broj"
                     value="<?= htmlspecialchars($user['postanski_broj'] ?? '') ?>" required>
              <div class="invalid-feedback">
                Molimo unesite poštanski broj.
              </div>
            </div>

            <div class="col-md-6">
              <label for="grad" class="form-label">Grad <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="grad" name="grad"
                     value="<?= htmlspecialchars($user['grad'] ?? '') ?>" required>
              <div class="invalid-feedback">
                Molimo unesite grad.
              </div>
            </div>

            <div class="col-md-6">
              <label for="drzava" class="form-label">Država <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="drzava" name="drzava"
                     value="<?= htmlspecialchars($user['drzava'] ?? '') ?>" required>
              <div class="invalid-feedback">
                Molimo unesite državu.
              </div>
            </div>

            <div class="col-md-6">
              <label for="Dan_Uclanjenja" class="form-label">Vrijeme registracije</label>
              <input type="text" class="form-control" id="Dan_Uclanjenja"
                     value="<?= htmlspecialchars($user['Dan_Uclanjenja']) ?>" disabled>
            </div>

            <div class="col-12">
              <button class="btn btn-success px-4" type="submit">
                Spremi promjene
              </button>
            </div>
          </form>
        </section>

      </div>
    </div>
  </main>

<?php require_once __DIR__ . '/elementi/footer.php'; ?>

  <!-- Bootstrap JS for collapse and validation components -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Client-side form validation -->
  <script>
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
