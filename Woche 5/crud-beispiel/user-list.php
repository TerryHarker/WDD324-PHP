<?php
require_once('config.php'); // DB Verbindungsdaten als Konstanten
$db = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME, DBUSER, DBPASSWORT);

$sortierung = 'ID';
$richtung = 'ASC'; // standardwert
if( isset($_GET['richtung']) && $_GET['richtung']=='ASC'){
    $richtung = 'DESC';
}
if( isset($_GET['sort'])){
    $sortierung = $_GET['sort'];
}

// Löschbefehl ausführen - VOR dem READ
if( isset($_GET['action']) && $_GET['action']=='delete' ){
    $query = "DELETE FROM `user` WHERE ID=".$_GET['id'];
    $statement = $db->query($query); 
    $resultat = $statement->execute();
}

// Abfrage mit variablen:
$query = "SELECT * FROM `user` ORDER BY $sortierung $richtung LIMIT 0, 10"; // SQL Query als String
echo 'aktuelle Abfrage: '.$query;

$statement = $db->query($query); // Befehl abschicken
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