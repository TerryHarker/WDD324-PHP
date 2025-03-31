<?php
require_once( 'config.php' );
session_name( md5(SESSIONNAME) );
session_start(); // Zugriff auf Session
$isLoggedIn = true; // login Status variable initialisieren

// logout, falls erwünscht
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    // Logout prozess ausführen
    unset($_SESSION['isloggedin']);
}


// Abfragen ob ein User eingeloggt ist
if( !isset($_SESSION['isloggedin']) || $_SESSION['isloggedin']!==true ){
    // user ist nicht eingeloggt
    $isLoggedIn = false;
}
session_regenerate_id(); // Neue Session ID
?>
<h3>Webseite (öffentlich)</h3>
<p>Diese Seite dürfen alle sehen.</p>

<?php
if($isLoggedIn == true){
?>
<p>Diesen Abschnitt dürfen nur eingeloggte User sehen</p>
<a href="frontend.php?action=logout">Logout</a>
<?php
}
?>

<?php
if($isLoggedIn !== true){
?>
<a href="loginform.php">Login</a>
<?php
}
?>