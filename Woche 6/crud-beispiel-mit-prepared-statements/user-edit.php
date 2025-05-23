<?php
/**
 * User Edit mit Prepared statements und anderen Massnahmen, um gegen 
 * SQL Injections abzusichern
 * Beispiel unter https://www.php.net/manual/de/pdo.prepare.php
 */
require_once('config.php'); // DB Verbindungsdaten als Konstanten
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
<h2>User erfassen / editieren</h2>
<form action="user-edit.php" method="POST">
    <div>
        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" value="<?php echo $vorname; ?>">
    </div>
    <div>
        <label for="nachname">Nachname:</label>
        <input type="text" id="nachname" name="nachname"  value="<?php echo $nachname; ?>">
    </div>
    <div>
        <label for="geburtsdatum">Geburtsdatum:</label>
        <input type="date" id="geburtsdatum" name="geburtsdatum"  value="<?php echo $geburtsdatum; ?>">
    </div>
    <div>
        <label for="email">E-Mail:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div>
        <label for="telefon">Telefon:</label>
        <input type="tel" id="telefon" name="telefon" value="<?php echo $telefon; ?>">
    </div>
    <div>
        <label for="telefon">Username:</label>
        <input type="tel" id="username" name="username" value="<?php echo $username; ?>">
    </div>
    <div>
        <label for="telefon">Passwort:</label>
        <input type="password" id="passwort" name="passwort" value="">
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <button type="submit">Speichern</button>
    <a href="user-list.php"><button type="button">Abbrechen</button></a>
</form>