Dieser Text ist aus include-demo.php
<br>
<?php
// aktuelle Datei ermitteln.
echo $_SERVER['PHP_SELF'];

include('text.inc.php'); // fügt den Inhalt der Datei text.html hier ein
?>
<br>
Dieser Text ist auch "lokal"