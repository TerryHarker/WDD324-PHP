<?php
/**
 * Hier soll der Logout Prozess stehen
 */
require_once( '../configuration.php' );
session_name( md5(SESSIONNAME) );
session_start();

// Session auf "nicht eingeloggt" zurücksetzen
unset($_SESSION['isloggedin']);
unset($_SESSION['timestamp']);
unset($_SESSION['useragent']);
unset($_SESSION['ipaddress']);


session_regenerate_id(); // Neue Session ID

// nach dem Zurücksetzen
header('Location: login.php');
exit;
?>