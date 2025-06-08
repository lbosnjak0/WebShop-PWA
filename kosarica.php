<?php
/* kosarica */
require_once __DIR__ . '/config/config.php';
$cart = $_SESSION['cart'] ?? [];
$total = 0;
$items = [];
if ($cart) {
    $ids = implode(',', array_keys($cart));
    $res = mysqli_query($con, "SELECT id, naziv, cijena FROM proizvodi WHERE id IN ($ids)");
    while ($row = mysqli_fetch_assoc($res)) {
        $row['qty'] = $cart[$row['id']];
        $row['subtotal'] = $row['cijena'] * $row['qty'];
        $total += $row['subtotal'];
        $items[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['login']) && $items) {
    $uid = (int)$_SESSION['user_id'];
    mysqli_begin_transaction($con);
    $stmt = mysqli_prepare($con, "INSERT INTO narudzbe (korisnik_id) VALUES (?)");
    mysqli_stmt_bind_param($stmt,'i',$uid);
    mysqli_stmt_execute($stmt);
    $orderId = mysqli_insert_id($con);
    $stmtItem = mysqli_prepare($con, "INSERT INTO stavke_narudzbe (narudzba_id, proizvod_id, kolicina) VALUES (?,?,?)");
    foreach ($items as $it) {
        mysqli_stmt_bind_param($stmtItem,'iii',$orderId,$it['id'],$it['qty']);
        mysqli_stmt_execute($stmtItem);
    }
    mysqli_commit($con);
    $_SESSION['cart'] = [];
    header('Location: dostava.php?order=' . $orderId);
    exit;
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Košarica</title>
<!-- Bootstrap 5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php require_once __DIR__ . '/elementi/top-header.php'; ?>
<?php require_once __DIR__ . '/elementi/main-header.php'; ?>
<?php require_once __DIR__ . '/elementi/nav.php'; ?>
<div class="container my-5">
<h2>Košarica</h2>
<?php if (!$items): ?>
    <p>Košarica je prazna.</p>
<?php else: ?>
<table class="table">
<thead>
    <tr>
        <th>Proizvod</th>
        <th>Količina</th>
        <th>Cijena</th>
        <th>Ukupno</th>
        <th></th>
    </tr>
</thead>
<tbody>
<?php foreach($items as $it): ?>
<tr>
    <td><?= htmlspecialchars($it['naziv']) ?></td>
    <td><?= $it['qty'] ?></td>
    <td>€ <?= number_format($it['cijena'],2,',','.') ?></td>
    <td>€ <?= number_format($it['subtotal'],2,',','.') ?></td>
    <td>
        <form method="post" action="remove_from_cart.php">
            <input type="hidden" name="pid" value="<?= $it['id'] ?>">
            <button class="btn btn-sm btn-outline-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
<tr class="fw-bold">
    <td colspan="4" class="text-end">Ukupno:</td>
    <td>€ <?= number_format($total,2,',','.') ?></td>
</tr>
</tbody></table>
<?php if (!empty($_SESSION['login'])): ?>
<form method="post"><button class="btn btn-success">Kupi</button></form>
<?php else: ?>
<p><a href="login.php">Prijavite se</a> za kupnju.</p>
<?php endif; ?>
<?php endif; ?>
</div>
<?php require_once __DIR__ . '/elementi/footer.php'; ?>
<!-- Bootstrap for responsive layout -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

