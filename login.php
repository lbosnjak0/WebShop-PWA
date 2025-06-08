<?php
/* prijava i registracija za korisnike. */
require_once __DIR__.'/config/config.php';

$errLogin = $errReg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    /* ----------  A) PRIJAVA  ---------- */
    if ($action === 'login') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $stmt = mysqli_prepare($con,
          "SELECT id, username, pass_hash
           FROM korisnici
           WHERE username = ?");
        mysqli_stmt_bind_param($stmt,'s',$username);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $u   = mysqli_fetch_assoc($res);

        if ($u && password_verify($password, $u['pass_hash'])) {
            $_SESSION['login']    = true;
            $_SESSION['user_id']  = $u['id'];
            $_SESSION['username'] = $u['username'];
            header('Location: profil.php');  exit;
        } else {
            $errLogin = 'Krivo korisničko ime ili lozinka.';
        }

    /* ----------  B) REGISTRACIJA  ---------- */
    } elseif ($action === 'register') {
        $username = trim($_POST['reg_username'] ?? '');
        $email    = trim($_POST['reg_email'] ?? '');
        $pass1    = $_POST['reg_password'] ?? '';
        $pass2    = $_POST['reg_password2'] ?? '';

        if ($pass1 !== $pass2) {
            $errReg = 'Lozinke se ne podudaraju.';
        } else {
            /* provjeri jedinstvenost */
            $stmt = mysqli_prepare($con,
              "SELECT COUNT(*) FROM korisnici WHERE username = ? OR email = ?");
            mysqli_stmt_bind_param($stmt,'ss',$username,$email);
            mysqli_stmt_execute($stmt);
            $cntRes = mysqli_stmt_get_result($stmt);
            $exists = (int)mysqli_fetch_row($cntRes)[0];

            if ($exists) {
                $errReg = 'Korisničko ime ili e-mail već postoji.';
            } else {
                $hash = password_hash($pass1, PASSWORD_DEFAULT);
                $stmt = mysqli_prepare($con,
                  "INSERT INTO korisnici (username,email,pass_hash)
                   VALUES (?,?,?)");
                mysqli_stmt_bind_param($stmt,'sss',$username,$email,$hash);
                mysqli_stmt_execute($stmt);

                /* automatska prijava */
                $_SESSION['login']    = true;
                $_SESSION['user_id']  = mysqli_insert_id($con);
                $_SESSION['username'] = $username;
                header('Location: profil.php'); exit;
            }
        }
    }
}
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
<body class="bg-light">

<?php require_once __DIR__ . '/elementi/top-header.php';?>
<?php require_once __DIR__ . '/elementi/main-header.php';?>
<?php require_once __DIR__ . '/elementi/nav.php';?>

<div class="container py-5" style="max-width:500px;">
  <ul class="nav nav-tabs mb-4" id="authTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="tab-login" data-bs-toggle="tab"
              data-bs-target="#pane-login" type="button" role="tab">Prijava</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="tab-reg" data-bs-toggle="tab"
              data-bs-target="#pane-reg" type="button" role="tab">Registracija</button>
    </li>
  </ul>

  <div class="tab-content">

    <!-- ===================================  PRIJAVA  -->
    <div class="tab-pane fade show active" id="pane-login" role="tabpanel">
      <?php if ($errLogin): ?>
        <div class="alert alert-danger"><?= $errLogin ?></div>
      <?php endif; ?>

      <form method="post" class="vstack gap-3">
        <input type="hidden" name="action" value="login">
        <input class="form-control" name="username" placeholder="Korisničko ime" required>
        <input class="form-control" type="password" name="password" placeholder="Lozinka" required>
        <button class="btn btn-primary w-100">Prijavi se</button>
      </form>
    </div>

    <!-- =================================  REGISTRACIJA -->
    <div class="tab-pane fade" id="pane-reg" role="tabpanel">
      <?php if ($errReg): ?>
        <div class="alert alert-danger"><?= $errReg ?></div>
      <?php endif; ?>

      <form method="post" class="vstack gap-3">
        <input type="hidden" name="action" value="register">
        <input class="form-control" name="reg_username" placeholder="Korisničko ime" required>
        <input class="form-control" type="email" name="reg_email" placeholder="E-mail" required>
        <input class="form-control" type="password" name="reg_password" placeholder="Lozinka" required>
        <input class="form-control" type="password" name="reg_password2" placeholder="Ponovi lozinku" required>
        <button class="btn btn-success w-100">Registriraj se</button>
      </form>
    </div>

  </div>

  <a class="d-block mt-4 small" href="index.php">← natrag na početnu</a>
</div>
<?php require_once __DIR__ . '/elementi/footer.php';?>

<!-- Bootstrap JS utilities -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>