<?php
// Konstante definieren
define("BILDERORDNER", "images"); // z.B. ein Konfigurationswert

// Variable erstellen in PHP immer mit $
$ausgabe = "Hallo Welt aus der Variable";

// Das ist ein String, kann aber als Zahl interpretiert werden (ein doofes Beispiel, um zu zeigen, dass PHP dynamische Datentypen hat)
$number = "3 Elefanten"; 

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP und HTML</title>
</head>
<body>
    <?php echo $ausgabe; ?>
    <?php echo '<br>So heisst der Bilderordner: '.BILDERORDNER; ?>
    <br>
    <?php echo 'Das ist das Resultat: '.(3*$number); ?>
</body>
</html>