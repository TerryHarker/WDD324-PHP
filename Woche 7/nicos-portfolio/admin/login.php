<?php
require_once('../configuration.php');
require_once('../functions/html.functions.php');

session_name( md5(SESSIONNAME) );
session_start(); // Session eröffnen und allenfalls session ID erstellen

$db = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME, DBUSER, DBPASSWORT);

$successmessage = '';
$errormessage = '';


// Formular abgeschickt?
if( isset($_POST['username']) && isset($_POST['password']) ){

    // Bereinigen mit trim() wegen leerschlag
    $daten = array( ':email' => trim($_POST['username']) );

    $query = "SELECT * FROM `user` WHERE `email`= :email LIMIT 1";
    $statement = $db->prepare($query);
    $statement->execute( $daten );
    $user = $statement->fetch(PDO::FETCH_ASSOC); // array oder false wenn kein user gefunden
    
    // var_dump($user);

    if($user === false){
        $errormessage = 'Username und/oder Passwort falsch'; // generische Fehlermeldung
    }else if( password_verify($_POST['password'], $user['password']) ){
        // alles korrekt, der User hat sich richtig authentifiziert
        $successmessage = 'du bist eingeloggt';

        // loginstatus in Session schreiben
        $_SESSION['isloggedin'] = true;
        $_SESSION['timestamp'] = time(); // aktuelle Zeit des Logins merken
        $_SESSION['ipaddress'] = $_SERVER['REMOTE_ADDR']; // IP
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];// User Agent

        header('Location: index.php'); // umleiten auf adminseite
        exit;
    }else{
        $errormessage = 'Username und/oder Passwort falsch'; // generische Fehlermeldung
    }

}

session_regenerate_id(); // Neue Session ID
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">

<?php include('partials/htmlhead.php'); ?>
<body>
    <?php include('partials/header.php'); ?>

    <section class="main-section">
		<div class="container">

            <div class="mt-5">
                <h1 class="heading-1">Login</h1>
                
            </div>
            <?php
            if( !empty($successmessage) ){
                echo '<div style="color:green">'.$successmessage.'</div>';
            }
            if( !empty($errormessage) ){
                echo '<div style="color:red">'.$errormessage.'</div>';
            }
            ?>            
            <form action="" method="POST">
                <div class="mb-3">
                <label for="username" class="form-label">E-Mail:</label>
                <input type="email" id="username" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" class="form-control" name="password" required>
                </div>
                <div>
                <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            User: nico@gmail.com / Passwort: test1234
        

        </div>
    </section>

    <?php
    include('partials/footer.php');
    ?>
</html>