<?php
// session_start();

// Werte in Sessions nicht voraussetzen - falls nicht vorhanden, Standardwert verwenden
$username = isset($_SESSION['username'])? $_SESSION['username']: 'Gast';

echo 'Hallo, '.$username.'!';
?>