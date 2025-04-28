<?php
/**
 * CONFIGURATION
 * Werte festlegen, die für das ganze Projekt gelten, die sich aber ändern könnten
 * z.B. kann sich die Datenbank oder Dateistruktur bis zum Projekt Root ändern, 
 * wenn das Projekt auf einem anderen Server eingerichtet wird.
 */

// SEF URLs
define('SEF_URLS', true); // SEF URLs aktiv oder nicht

// Bilder
define('BILDERORDNER', 'images'); // Ordner, in den alle Bilder hochgeladen werden

// Session config
define('SESSIONNAME', 'irgendwas'); // Session verstecken mit eigenem Cookiename
define('SESSIONLIFETIME', '10'); // Anzahl Minuten für inaktive Sessions

// Datenbank Verbindungs-Daten
define('DBSERVER', 'localhost'); // DB Server, immer localhost, wenn DB Server da ist wo auch unser script liegt
define('DBNAME', 'nico_db'); // Name der Datenbank
define('DBUSER', 'root'); // MAMP und XAMPP: root
define('DBPASSWORT', ''); // MAMP: root, XAMPP: leer
?>