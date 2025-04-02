<?php
require_once( 'config.php' );
require 'vendor/autoload.php';
session_name( md5(SESSIONNAME) );
session_start(); // Session eröffnen und allenfalls session ID erstellen

use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\QRServerProvider;

$username = 'Terry';
$passwort = '$2y$10$AkRZuLdHjmS.tQ3YQcURueKUemOmUHVg6aJpjT9CuOKYjPgrp5m42'; // hash von 'test1234'
$tfasecret = 'MLG5D5UV7XOJ4OH675WYJHWXEUL42FG7'; // beim einrichten generiert

$successmessage = '';
$errormessage = '';

// Formular abgeschickt?
if( isset($_POST['username']) && isset($_POST['password'])&& isset($_POST['tfacode']) ){

    $passwortCheck = password_verify($_POST['password'], $passwort);
    // var_dump( $passwortCheck );
    // exit; 

    $qrc = new QRServerProvider();
    $tfa = new TwoFactorAuth($qrc);
    $tfa_check = $tfa->verifyCode($tfasecret, $_POST['tfacode']);
    // var_dump( $tfa_check );
    // exit; 

    if($_POST['username'] == $username && $passwortCheck===true && $tfa_check===true ){
        // alles korrekt, der User hat sich richtig authentifiziert
        $successmessage = 'du bist eingeloggt';

        // loginstatus in Session schreiben
        $_SESSION['isloggedin'] = true;
        $_SESSION['timestamp'] = time(); // aktuelle Zeit des Logins merken
        $_SESSION['ipaddress'] = $_SERVER['REMOTE_ADDR']; // IP
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];// User Agent

        header('Location: frontend.php'); // umleiten auf adminseite
        exit;
    }else{
        if($tfa_check == false){
            $errormessage = 'Deine 2FA stimmt nicht...';
        }else{
            $errormessage = 'Username und/oder Passwort falsch'; // generische Fehlermeldung
        }
    }

}

session_regenerate_id(); // Neue Session ID
?>

<?php
if( !empty($successmessage) ){
    echo '<div style="color:green">'.$successmessage.'</div>';
}
if( !empty($errormessage) ){
    echo '<div style="color:red">'.$errormessage.'</div>';
}
?>
<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="password">2FA:</label>
    <input type="text" id="tfacode" name="tfacode" required>
    <br>
    <input type="hidden" name="<?=$token ?>" value="1">
    <button type="submit">Login</button>
</form>
User: Terry / Passwort: test1234