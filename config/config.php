
<?php
/**
 * Globaln konfiguracija pokreće sesiju i povezuje se sa bazom
 */
session_start();

define('DB_SERVER', 'localhost');      // DB server adresa
define('DB_USER', 'root');             // DB username
define('DB_PASS', '');                 // DB password
define('DB_NAME', 'webshop');          // DB name
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3306);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (!$con) {
    die("Greška spajanja na bazu: " . mysqli_connect_error());
}
?>
