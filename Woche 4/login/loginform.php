<?php
require_once( 'config.php' );
session_name( md5(SESSIONNAME) );
session_start(); // Session eröffnen und allenfalls session ID erstellen

$username = 'Terry';
$passwort = 'test1234';

$successmessage = '';
$errormessage = '';

// Formular abgeschickt?
if( isset($_POST['username']) && isset($_POST['password']) ){

    if($_POST['username'] == $username && $_POST['password'] == $passwort){
        // alles korrekt, der User hat sich richtig authentifiziert
        $successmessage = 'du bist eingeloggt';

        // loginstatus in Session schreiben
        $_SESSION['isloggedin'] = true;
        header('Location: geschuetzter-bereich.php'); // umleiten auf adminseite
        exit;
    }else{
        
        $errormessage = 'Username und/oder Passwort falsch'; // generische Fehlermeldung
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
    <input type="hidden" name="<?=$token ?>" value="1">
    <button type="submit">Login</button>
</form>
User: Terry / Passwort: test1234