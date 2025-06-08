<?php
$sql = "SELECT id, naziv FROM kategorije ORDER BY naziv";
$kat_qry = mysqli_query($con, $sql);
if ($kat_qry === false) {
    die('SQL greška: '.mysqli_error($con));
}

$self   = basename($_SERVER['PHP_SELF']);
$cat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
?>
<nav class="navbar navbar-expand-lg nav-header">
  <div class="container">
    <button class="navbar-toggler ms-auto" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $self==='news.php'?'active':'' ?>" href="news.php">Vijesti</a>
        </li>

        <?php while ($kat = mysqli_fetch_assoc($kat_qry)): ?>
          <?php $isActive = ($self==='category.php' && $cat_id===$kat['id']) ? 'active':''; ?>
          <li class="nav-item">
            <a class="nav-link <?= $isActive ?>" href="category.php?id=<?= $kat['id'] ?>">
              <?= htmlspecialchars($kat['naziv']) ?>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>

      <a href="admin/login.php" class="nav-link text-white fw-bold">Admin Login</a>
    </div>
  </div>
</nav>

<!--  ISTI CSS KOJI SI VEĆ IMAO  -->
<style>
:root{
  --accent: black; 
  --text-dark:#333;
}
.logo{
  color:var(--accent);
  font-size:1.75rem;
  font-weight:700
}
.cart-badge{
  position:absolute;
  top:-6px;
  right:-6px;
  width:18px;
  height:18px;
  border-radius:50%;
  background:#f0b400;
  color:#fff;
  font-size:.65rem;
  display:flex;
  align-items:center;
  justify-content:center;
}
.nav-header{
  background:var(--accent);
}
.nav-header .nav-link{
  color: white;
  font-weight:600
}
.nav-header .nav-link.active{
  background: gray;
  }
</style>