<?php
// Einfache Bereinigungen

$zahl = '1 sdf';
$zahl = (int)$zahl; // Typ INT erzwingen/umwandeln, notfalls 0

// Tags weglöschen
$text = 'Ich bin ein <b>Text</b> mit <script>alert("bösem code");</script>';
$text = strip_tags($text, '<b>');
echo $text; 

// Code lesbar machen (z.B. für Coder Forum)
$forumeintrag = 'Hier ist mein <script>Code</script>';
$forumeintrag = htmlentities($forumeintrag);
echo $forumeintrag; 

?>