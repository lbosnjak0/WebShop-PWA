<?php
/* admin panel odjava */
require_once __DIR__ . '/../config/config.php';
unset($_SESSION['admin'], $_SESSION['admin_id']);
header('Location: ../index.php');

