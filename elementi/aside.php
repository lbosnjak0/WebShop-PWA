<?php
/* ASIDE sa brojačem posjećenosti*/
/* brojač: jedna JSON datoteka u /data/ */
$page = basename($_SERVER['PHP_SELF']);          
$dataFile = __DIR__ . '/../data/counters.json';   

if (!is_dir(dirname($dataFile))) {
    mkdir(dirname($dataFile), 0777, true);
}

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, '{}');
}

$counter = json_decode(file_get_contents($dataFile), true) ?? [];
$counter[$page] = ($counter[$page] ?? 0) + 1;
file_put_contents($dataFile, json_encode($counter, JSON_PRETTY_PRINT));

$views = $counter[$page];

?>

<!--  ASIDE  -->
<aside class="col-md-3 mb-4">

    <!-- BROJAČ POSJETA -->
    <div class="card mb-4 text-center">
        <div class="card-header bg-warning fw-bold">Pregleda ove stranice</div>
        <div class="card-body">
            <span class="display-6"><?= $views ?></span>
        </div>
    </div>

    <!-- RADNO VRIJEME -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white fw-bold">Radno vrijeme</div>
        <table class="table table-sm mb-0">
            <tr><th>Pon - Pet</th><td>08:00 - 20:00</td></tr>
            <tr><th>Subota</th><td>09:00 - 15:00</td></tr>
            <tr><th>Nedjelja</th><td>Zatvoreno</td></tr>
        </table>
    </div>

    <!-- POPUSTI -->
    <div class="card">
        <div class="card-header bg-success text-white fw-bold">Akcije & Popusti</div>
        <ul class="list-group list-group-flush small">
            <li class="list-group-item">10% za sve nove korisnike</li>
            <li class="list-group-item">Proljetna rasprodaja je tu</li>
            <li class="list-group-item">Besplatna dostava iznad 50 €</li>
        </ul>
    </div>
</aside>