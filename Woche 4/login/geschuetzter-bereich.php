<?php
require_once( 'config.php' );
session_name( md5(SESSIONNAME) );
session_start(); // Zugriff auf Session
$isLoggedIn = true;

// Abfragen ob ein User eingeloggt ist
if( !isset($_SESSION['isloggedin']) || $_SESSION['isloggedin']!==true ){
    // user ist nicht eingeloggt
    $isLoggedIn = false;
}



session_regenerate_id();
if($isLoggedIn == false){
    header('Location: loginform.php'); // leitet um auf loginform.php
    exit; // bricht das script
}

?>
<h3>Geschützter Bereich (Adminbereich)</h3>
<p>Diese Seite darf nur angezeigt werden, wenn ein Benutzer sich vorher erfolgreich authentifiziert hat.</p>

<a href="logout.php">Logout</a>