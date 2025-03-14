<?php
/*
Diese Datei verarbeitet Formulardaten aus umfrage.html
*/

echo '<pre> GET: ';
print_r($_GET);
echo '</pre>';

echo '<pre> POST: ';
print_r($_GET);
echo '</pre>';
?>
<p>
    <strong>Hallo <?php echo $_GET['name']; // Wert aus dem Formfield 'name' ?>, 
    du interessierst dich für <?php echo implode(', ', $_GET['interests']); // zum string geflattete Werte aus 'interests' ?></strong>
</p>

<h4>POST</h4>
<p>
    <strong>Hallo <?php echo $_POST['name']; ?>, 
    du interessierst dich für <?php echo $_POST['interests']; ?></strong>
</p>
<p>
    <a href="umfrage.html.php">Zurück zur Umfrage</a>
</p>