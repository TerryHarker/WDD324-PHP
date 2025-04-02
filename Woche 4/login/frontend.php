<?php
require_once( 'config.php' );
session_name( md5(SESSIONNAME) );
session_start(); // Zugriff auf Session
$isLoggedIn = true; // login Status variable initialisieren

// logout, falls erwünscht
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    // Logout prozess ausführen
    unset($_SESSION['isloggedin']);
    unset($_SESSION['timestamp']);
    unset($_SESSION['ipaddress']);
    unset($_SESSION['useragent']);
}

// Abfragen ob ein User eingeloggt ist
if( !isset($_SESSION['isloggedin']) || $_SESSION['isloggedin']!==true ){
    // loginstatus fehlt - session ungültig
    $isLoggedIn = false;
}

if( empty($_SESSION['timestamp']) ){
    // timestamp fehlt - session ungültig
    $isLoggedIn = false;
}else{
    $aktuelleZeit = time();
    $inaktivitaet = $aktuelleZeit - $_SESSION['timestamp'];
    $sessionLifetime = SESSIONLIFETIME*60; // Lifetime in Minuten aus der Config * 60 = Lifetime in Sekunden
    if( $inaktivitaet > $sessionLifetime ){
        // Zu lange inaktiv - session ungültig!
        $isLoggedIn = false;
    }
}

if( empty($_SESSION['ipaddress']) || $_SESSION['ipaddress'] !== $_SERVER['REMOTE_ADDR'] ){
    $isLoggedIn = false;
}

if( empty($_SESSION['useragent']) || $_SESSION['useragent'] !== $_SERVER['HTTP_USER_AGENT'] ){
    $isLoggedIn = false;
}

if( $isLoggedIn == true){
    // session noch gültig - zeit erneuern
    $_SESSION['timestamp'] = time(); // Timestamp erneuern (bei aktivität werden wir nicht ausgeloggt)
}else{
    // session nicht gültig - zurücksetzen
    unset($_SESSION['isloggedin']);
    unset($_SESSION['timestamp']);
    unset($_SESSION['ipaddress']);
    unset($_SESSION['useragent']);
}

session_regenerate_id(); // Neue Session ID

echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>
<h3>Webseite (öffentlich)</h3>
<p>Diese Seite dürfen alle sehen.</p>

<?php
if($isLoggedIn == true){
?>
<p>Diesen Abschnitt dürfen nur eingeloggte User sehen</p>
<a href="frontend.php?action=logout">Logout</a> | 
<a href="2fa.php">2FA einrichten</a>
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