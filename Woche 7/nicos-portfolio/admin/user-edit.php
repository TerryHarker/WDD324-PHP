<?php
require_once('../configuration.php');
require_once('../functions/html.functions.php');
require_once('../functions/session.functions.php');

session_name( md5(SESSIONNAME) );
session_start(); // Session eröffnen und allenfalls session ID erstellen

$isLoggedIn = loginCheck();

/**
 * LOGIN LOGIK
 */
if( $isLoggedIn == true){
    // session noch gültig - zeit erneuern
    loginRefresh();
}else{
    // session nicht gültig - zurücksetzen
    logout();
    header('Location: login.php');
    exit;
}

$db = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME, DBUSER, DBPASSWORT);

$id = 0;
$vorname = '';
$nachname = '';
$geburtsdatum = '';
$email = '';
$telefon = '';
$username = '';
$passwort = '';

// Erster Schritt: READ (vorbereitung des Formulars)
if( isset($_GET['id']) ){
    $id = $_GET['id'];

    // User Query mit Platzhalter für die ID erstellen - ID ist User Input 
    $query = "SELECT * FROM `user` WHERE ID=:editID"; 
    echo 'aktuelle Abfrage: '.$query;

    // $statement = $db->query($query);
    $statement = $db->prepare($query); // Query zur Vorbereitung an den DB Server schicken
    $statement->execute( array(':editID' => $id) ); // Daten schicken

    $user = $statement->fetch(PDO::FETCH_ASSOC); // fetch für nur ein User-Array

    // print_r($user);

    $vorname = $user['vorname'];
    $nachname = $user['nachname'];
    $geburtsdatum = $user['geburtsdatum'];
    $email = $user['email'];
    $telefon = $user['telefon'];
    $username = $user['username'];
    
}

// Formular wurde abgeschickt
if( isset($_POST['id']) ){
    echo '<pre>POST ';
    print_r($_POST);
    echo '</pre>';
    
    // Variablen überschreiben (sanitizing weggelassen, müsste aber auch gemacht werden)
    $id = (int)$_POST['id'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geburtsdatum = $_POST['geburtsdatum'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $username = $_POST['username'];
    $passwort = $_POST['passwort'];

    // validierung: weggelassen, müsste aber auch gemacht werden

    // Daten-Array vorbereiten - nur die Daten, die sowohl für INSERT als auch UPDATE gebraucht werden 
    $daten = array(
        ':vorname' => $vorname,
        ':nachname' => $nachname,
        ':geburtsdatum' => $geburtsdatum,
        ':email' => $email,
        ':telefon' => $telefon,
        ':username' => $username
    );

    if($id==0){

        // keine ID vorhanden - INSERT: Query zum Erstellen eines neuen Datensatzes erstellen
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $daten[':passwort_hash'] = $passwort_hash; // Passwort ins Daten-Array hinzufügen - neu: immer passwort erstellen

        $query = "INSERT INTO `user` (vorname, nachname, geburtsdatum, email, telefon, username, passwort) ";
        $query .= "VALUES ( :vorname, :nachname, :geburtsdatum, :email, :telefon, :username, :passwort_hash )";

    }else{
        
        // ID vorhanden - UPDATE: Query zum Aktualisieren mit Platzhaltern erstellen
        $query = "UPDATE `user` SET ";
        $query .= "vorname = :vorname";
        $query .= ", nachname = :nachname";
        $query .= ", geburtsdatum = :geburtsdatum";
        $query .= ", email = :email";
        $query .= ", telefon = :telefon";
        $query .= ", username = :username";

        // Passwort wird nur angehängt, wenn es überschrieben (nicht leer) ist
        if( !empty($passwort) ){
            $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
            $daten[':passwort_hash'] = $passwort_hash; // Passwort ins Daten-Array, wenn es überschrieben werden soll (nicht leer)
            
            $query .= ", passwort = :passwort_hash"; // Passwort-Spalte dem Query hinzufügen, wenn PW nicht leer
        }

        // Zum schluss noch where hinzufügen bei bestehendem Datensatz: 
        $daten[':updateID'] = $id;
        $query .= " WHERE ID=:updateID"; // Nur diesen Datensatz updaten
    }


    /*
     Wichtig: Anzahl Elemente im Daten-Array und Platzhalter im Query müssen übereinstimmen!
     Daher immer an beide denken, z.B. Passwort und ID werden nicht in allen fällen benötigt. 
     */
    echo '<pre>Speicherbefehl: '.$query.'</pre>';
    $statement = $db->prepare($query);
    $resultat = $statement->execute( $daten );
    var_dump($resultat);

    if($resultat==true){
        echo 'hat funktioniert';
    }
}
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">

<?php include('partials/htmlhead.php'); ?>
<body>
    <?php include('partials/header.php'); ?>

    <section class="main-section">
		<div class="container">
                    
            <h2>User erfassen / editieren</h2>
            <form action="user-edit.php" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                    <div class="invalid-feedback">Bitte geben Sie eine gültige E-Mail-Adresse ein.</div>
                </div>
                <div class="mb-3">
                    <label for="passwort" class="form-label">Passwort:</label>
                    <input type="password" id="passwort" name="passwort" class="form-control" value="">
                    <div class="invalid-feedback">Bitte geben Sie ein Passwort ein.</div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <button type="submit" class="btn btn-primary">Speichern</button>
                <a href="user-list.php" class="btn btn-secondary">Abbrechen</a>
            </form>
        </div>
    </section>
    <?php
    include('partials/footer.php');
    ?>
</html>