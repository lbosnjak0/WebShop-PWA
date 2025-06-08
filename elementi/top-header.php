<?php
// top header pokazuje ako je user ulogiran
$ulogiran = !empty($_SESSION['login']);        // true ili false
$username = $_SESSION['username'] ?? 'Gost';   // ako nije logiran
?>

<div class="bg-light border-bottom small py-1">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="list-inline mb-0">
                <?php if ($ulogiran): ?>
                    <li class="list-inline-item me-lg-3">
                        <a class="nav-link" href="profil.php">
                            <i class="fa fa-user me-1"></i>Dobro došao – <?= htmlspecialchars($username) ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="list-inline-item me-lg-3">
                        <a class="nav-link" href="lista-zelja.php"><i class="fa fa-heart me-1"></i>Lista želja</a>
                    </li>
                    <li class="list-inline-item me-lg-3">
                        <a class="nav-link" href="kosarica.php"><i class="fa fa-shopping-cart me-1"></i>Košarica</a>
                    </li>
                    <li class="list-inline-item me-lg-3">
                        <a class="nav-link" href="about.php"><i class="fa fa-address-card me-1"></i>O&nbsp;nama</a>
                    </li>
                    <li class="list-inline-item me-lg-3">
                        <a class="nav-link" href="contact.php"><i class="fa fa-address-book me-1"></i>Kontakt</a>
                    </li>
                    <?php if ($ulogiran): ?>
                        <li class="list-inline-item me-lg-3">
                            <a class="nav-link" href="recenzije.php"><i class="fa fa-star me-1"></i>Recenzije</a>
                        </li>
                    <?php endif; ?>
                    <?php if (!$ulogiran): ?>
                        <li class="list-inline-item">
                            <a class="nav-link" href="login.php"><i class="fa fa-sign-in-alt me-1"></i>Prijava</a>
                        </li>
                        <?php else: ?>
                            <li class="list-inline-item">
                                <a class="nav-link" href="logout.php"><i class="fa fa-sign-out me-1"></i>Odjava</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <a href="dostava.php" class="btn btn-outline-secondary btn-sm">Praćenje narudžbe</a>
        </div>
</div>

<style>
:root{
    --accent:#ff6b6b;      
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
    color:#fff;
    font-weight:600
}
.nav-header .nav-link.active,
.nav-header .nav-link:hover{
    background:rgba(255,255,255,.15)
}
</style>
