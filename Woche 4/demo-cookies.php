<?php
/**
 * COOKIE DEMO SCRIPT
 * Mit diesem Script wird ein Wert in ein Cookie geschrieben,
 * damit er später von anderen Scripts wieder abrufbar ist 
 * Teste dies mit einem Cookie Manager in deinem Browser!
 */

// Auftrag für den Browser, ein Cookie zu erstellen
setcookie('test', 'Hallo Welt'); // Cookie ohne Ablauf - "Session cookie"
$cookieExpiry = 60;

setcookie('kurzertest', 'Diese Info bleibt '.$cookieExpiry.' Sekunden gültig', time()+$cookieExpiry);

echo '<pre>';
print_r($_COOKIE);
echo '</pre>';

// Auftrag zum Cookie löschen an den Browser
// setcookie('test', '', 0);

?>