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

$sortierung = 'ID'; // Standard Spalte für die Sortierung ist ID
$richtung = 'ASC'; // Standard-RIchtung für die Sortierung ist aufsteigend

// die möglichen (erlaubten) Werte für die Sortierung festlegen:
$moegliche_sortierspalten = array('vorname', 'nachname', 'geburtsdatum', 'email', 'username');

// Richtung jeweils auf absteigend umkehren für die nächste Abfrage, wenn sie aufsteigend ist 
if( isset($_GET['richtung']) && $_GET['richtung']=='ASC'){
    $richtung = 'DESC';
}
// Nur wenn eine Sortierung gewünscht ist und die sortierspalte aus dem GET im Array enthalten ist (erlaubt ist), wird diese zur Sortierung übernommen
if( isset($_GET['sort']) && in_array( $_GET['sort'], $moegliche_sortierspalten) ){
    $sortierung = $_GET['sort'];
}

// Löschbefehl ausführen - VOR dem READ
if( isset($_GET['action']) && $_GET['action']=='delete' ){

    /* 
    Dieser Befehl enthält eine Variable aus GET, also User Input
    Wir müssen ihn mit prepared Statement gegen SQL Injections absichern 
    */
    $query = "DELETE FROM `user` WHERE ID=:deleteID";

    // $statement = $db->query($query); 
    $statement = $db->prepare($query); // Befehl ohne daten schicken zur Vorbereitung
    $inputs = array(':deleteID' => $_GET['id']); // Daten in Array sammeln
    $resultat = $statement->execute($inputs); // Daten mitschicken, um den Befehl auszuführen
}

/*
Abfrage mit variablen:
dieser Befehl enthält auch Variablen, die Variablen enthalten jedoch keine Daten
sondern Strukturbezeichnungen und Befehlsbausteine 
(Tabellenspalte bei Sort betrifft die Struktur, ASC/DESC ist ein SQL Baustein)
Der bei prepare() mitgelieferte Befehl muss vollständig interpretiert werden können, 
sonst kann er später nicht ausgeführt werden. Daher wurden die Variablen anders abgesichert, siehe oben
*/
$query = "SELECT * FROM `user` ORDER BY $sortierung $richtung LIMIT 0, 10"; // SQL Query als String
echo 'aktuelle Abfrage: '.$query;

$statement = $db->query($query); // Befehl abschicken
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">

<?php include('partials/htmlhead.php'); ?>
<body>
    <?php include('partials/header.php'); ?>

    <section class="main-section">
		<div class="container">

    <p><a href="user-edit.php" class="btn btn-primary">NEU</a></p>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th><a href="user-list.php?sort=ID&richtung=<?php echo $richtung ?>" class="text-white">ID</a></th>
                <th><a href="user-list.php?sort=email&richtung=<?php echo $richtung ?>" class="text-white">E-Mail</a></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $users as $user ){ ?>
            <tr>
                <td><?php echo $user['ID']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><a href="user-edit.php?id=<?php echo $user['ID']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
                <td><a href="user-list.php?action=delete&id=<?php echo $user['ID']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>Seitenzahlen / Pagination (nicht aktiv): 
        <a href="user-list.php?start=0" class="btn btn-secondary btn-sm">1</a> 
        <a href="user-list.php?start=10" class="btn btn-secondary btn-sm">2</a> 
        <a href="user-list.php?start=20" class="btn btn-secondary btn-sm">3</a> 
        <a href="user-list.php?start=30" class="btn btn-secondary btn-sm">4</a> 
        <a href="user-list.php?start=..." class="btn btn-secondary btn-sm">...</a> 
    </p>

            </div>
        </section>
    <?php
    include('partials/footer.php');
    ?>
</html>