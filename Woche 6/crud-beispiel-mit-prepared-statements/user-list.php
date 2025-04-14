<?php
/**
 * User List mit Prepared statements und anderen Massnahmen, um gegen 
 * SQL Injections abzusichern
 * Beispiel unter https://www.php.net/manual/de/pdo.prepare.php
 */
require_once('config.php'); // DB Verbindungsdaten als Konstanten
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
<p><a href="user-edit.php">NEU</a></p>
<table border="1">
    <tr>
        <th><a href="user-list.php?sort=ID&richtung=<?php echo $richtung ?>">ID</a></th>
        <th><a href="user-list.php?sort=username&richtung=<?php echo $richtung ?>">Username</a></th>
        <th><a href="user-list.php?sort=vorname&richtung=<?php echo $richtung ?>">Vorname</a></th>
        <th><a href="user-list.php?sort=nachname&richtung=<?php echo $richtung ?>">Nachname</a></th>
        <th><a href="user-list.php?sort=geburtsdatum&richtung=<?php echo $richtung ?>">Geburtsdatum</a></th>
        <th><a href="user-list.php?sort=email&richtung=<?php echo $richtung ?>">E-Mail</a></th>
        <th><a href="user-list.php?sort=telefon&richtung=<?php echo $richtung ?>">Telefon</a></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach( $users as $user ){ ?>
    <tr>
        <td><?php echo $user['ID']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['vorname']; ?></td>
        <td><?php echo $user['nachname']; ?></td>
        <td><?php echo $user['geburtsdatum']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['telefon']; ?></td>
        <td><a href="user-edit.php?id=<?php echo $user['ID']; ?>">edit</a></td>
        <td><a href="user-list.php?action=delete&id=<?php echo $user['ID']; ?>">delete</a></td>
    </tr>
    <?php } ?>
</table>
<p>Seitenzahlen / Pagination (nicht aktiv): 
<a href="user-list.php?start=0">1</a> 
<a href="user-list.php?start=10">2</a> 
<a href="user-list.php?start=20">3</a> 
<a href="user-list.php?start=30">4</a> 
<a href="user-list.php?start=...">...</a> </p>