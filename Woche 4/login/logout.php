<?php
/**
 * Hier soll der Logout Prozess stehen
 */
require_once( 'config.php' );
session_name( md5(SESSIONNAME) );
session_start();
unset($_SESSION['isloggedin']);
session_regenerate_id(); // Neue Session ID

// nach dem Zurücksetzen
header('Location: loginform.php');
exit;
?>
Du wirst abgemeldet...