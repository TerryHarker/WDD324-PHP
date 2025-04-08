<?php
define('DBSERVER', 'localhost'); // DB Server, immer localhost, wenn DB Server da ist wo auch unser script liegt
define('DBNAME', 'wdd324_demo'); // Name der Datenbank
define('DBUSER', 'root'); // MAMP und XAMPP: root
define('DBPASSWORT', ''); // MAMP: root, XAMPP: leer

// instanzieren und verbinden
$db = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME, DBUSER, DBPASSWORT); 
// print_r($db);

// Bereit zum Arbeiten mit Daten
$query = "SELECT * FROM `user`"; // SQL Query als String
$statement = $db->query($query); // Befehl abschicken
$daten = $statement->fetchAll(PDO::FETCH_ASSOC); // Resultat erhalten

// print_r($daten);

foreach($daten as $user){
    echo '<li>'.$user['email'].'</li>';
}
?>