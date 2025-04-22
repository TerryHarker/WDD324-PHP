<?php
/**
 * Session funktionen für das Login handling
 */


/**
 * loginCheck - prüft die Login Sessiondaten auf Gültigkeit
 * @return bool $isLoggedIn true, wenn die Session gültig ist, false wenn sie ungültig ist
 */
function loginCheck(){
    if( !isset($_SESSION) ){
        // keine Session vorhanden - nicht eingeloggt
        // echo 'keine Session';
        return false;
    }
    
    if( !defined('SESSIONLIFETIME') ){
        // kein Konfigurationswert vorhanden - abbruch
        // echo 'keine Session lifetime aus configration';
        return false;
    }

    $isLoggedIn = true;

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
    session_regenerate_id(); // Neue Session ID

    // echo 'Session nicht gültig';
    return $isLoggedIn;
}

/**
 * loginRefresh - erneuert die Session (keep alive)
 * @return void
 */
function loginRefresh(){
    $_SESSION['timestamp'] = time(); // Timestamp erneuern (bei aktivität werden wir nicht ausgeloggt)
}

/**
 * logout - setzt die Sessiondaten zurück
 * @return void
 * */
function logout(){
    // Session auf "nicht eingeloggt" zurücksetzen
    unset($_SESSION['isloggedin']);
    unset($_SESSION['timestamp']);
    unset($_SESSION['useragent']);
    unset($_SESSION['ipaddress']);

    session_regenerate_id(); // Neue Session ID
}
?>