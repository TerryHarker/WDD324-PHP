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
$moegliche_sortierspalten = array('title', 'status');

// Status-Werte setzen
$statusValues = array(
    '-1' => 'gelöscht',
    '0' => 'versteckt',
    '1' => 'öffentlich'
);

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

    // Bildnamen auslesen vor dem löschen
    $query = "SELECT imgurl FROM `project` WHERE ID=:deleteID";
    $statement = $db->prepare($query); // Befehl ohne daten schicken zur Vorbereitung
    $statement->execute(array(':deleteID' => $_GET['id'])); // Daten mitschicken, um den Befehl auszuführen
    $delete_img = $statement->fetchColumn();

    // altes Bild löschen
    if(is_file('../'.BILDERORDNER.'/'.$delete_img)){
        unlink('../'.BILDERORDNER.'/'.$delete_img);
    }

    // Projekt löschen
    $query = "DELETE FROM `project` WHERE ID=:deleteID";

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
$query = "SELECT * FROM `project` ORDER BY $sortierung $richtung LIMIT 0, 10"; // SQL Query als String
echo 'aktuelle Abfrage: '.$query;

$statement = $db->query($query); // Befehl abschicken
$statement->execute();
$projects = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">

<?php include('partials/htmlhead.php'); ?>
<body>
    <?php include('partials/header.php'); ?>

    <section class="main-section">
		<div class="container">

    <p><a href="project-edit.php" class="btn btn-primary">NEU</a></p>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th><a href="project-list.php?sort=ID&richtung=<?php echo $richtung ?>" class="text-white">ID</a></th>
                <th>Bild</th>
                <th><a href="project-list.php?sort=title&richtung=<?php echo $richtung ?>" class="text-white">Titel</a></th>
                <th><a href="project-list.php?sort=status&richtung=<?php echo $richtung ?>" class="text-white">Status</a></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $projects as $project ){ ?>
            <tr>
                <td><?php echo $project['ID']; ?></td>
                <td><img src="../<?php echo BILDERORDNER.'/'.$project['imgurl']; ?>" width="30" /></td>
                <td><?php echo $project['title']; ?></td>
                <td><?php echo $statusValues[ $project['status'] ]; ?></td>
                <td><a href="project-edit.php?id=<?php echo $project['ID']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
                <td><a href="project-list.php?action=delete&id=<?php echo $project['ID']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
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