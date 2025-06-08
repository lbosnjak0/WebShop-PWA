<?php
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<header class="py-4">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

            <!-- logo -->
            <h1 class="logo m-0">WebShop</h1>

            <!-- search -->
            <form class="flex-grow-1" style="max-width:500px">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search here…">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- cart -->
            <a href="kosarica.php" class="position-relative btn btn-outline-secondary d-flex align-items-center gap-2">
                <span class="fw-semibold">Košarica</span>
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-badge"><?= $cartCount ?></span>
            </a>
    </div>
</header>

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
.nav-header .nav-link.active{
    background:rgba(255,255,255,.15)
}
</style>
