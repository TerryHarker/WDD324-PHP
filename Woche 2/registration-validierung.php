<?php
/*
 * Verarbeitung des Formulars
 * dieses Beispiel zeigt die Struktur einer Validierung, ist aber nicht vollständig.
 * Hier sind weitere Beispiele: https://learn.bytekultur.net/formulare/kontaktformular-validierung
 */


$hasErrors      = false; // Statusvariable für Fehler (true=fehlerhaft)
$errorMessages  = array(); // Container zum Sammeln von Fehlermeldungen 

// isset prüft ob ein mitgegebener Wert existiert
if( isset($_POST['username']) && isset($_POST['password']) ){
    // Formular ist anscheinend abgeschickt worden
    // echo 'username/password wurde mitgeschickt';

    // username Pflichtfeld überprüfen
    if( empty($_POST['username']) ){
        $errorMessages[] = 'Username ist leer';
        $hasErrors = true;
    }
    // passwort Pflichtfeld überprüfen
    if( empty($_POST['password']) ){
        $errorMessages[] = 'Passwort ist leer';
        $hasErrors = true;
    }
    
    // email Pflichtfeld überprüfen - Diese prüfung ist nicht unbedingt nötig, wenn filter_var angewendet wird
    /*
    if( empty($_POST['email']) ){
        $errorMessages[] = 'E-Mail ist leer';
        $hasErrors = true;
    }
    */

    // E-Mail Format prüfen
    $validEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if($validEmail == false){
        $hasErrors = true;
        $errorMessages[] = 'Bitte eine gültige Email adresse angeben';
    }

    // passwort muss den Regeln entsprechen
    $regex_kleinbuchstaben = "/[a-z]/";
    if (!preg_match($regex_kleinbuchstaben, $_POST['password'])) {
        $hasErrors = true;
        $errorMessages[] = "Passwort muss mindestens einen Kleinbuchstaben enthalten."; 
    }
    $regex_grossbuchstaben = "/[A-Z]/";
    if (!preg_match($regex_grossbuchstaben, $_POST['password'])) {
        $hasErrors = true;
        $errorMessages[] = "Passwort muss mindestens einen Grossbuchstaben enthalten."; 
    }
    

    // Wenn nach allen Validierungsprüfungen keine Fehler entstanden sind
    if($hasErrors == false){
        // Verarbeitung kann hier beginnen
        echo 'Bereit zum verschicken';
    }
    
}

// "Monitor" für die POST oder GET Daten:
echo '<pre> POST: ';
print_r($_POST);
print_r($errorMessages);
echo '</pre>';

?>

<h3>Registration</h3>

<?php if( count($errorMessages) > 0 ){ ?>
<div style="color:red;"><?php echo implode( '<br>', $errorMessages); ?></div>
<?php } ?>

<form action="" method="POST">
    <div>
        <label for="username">Username*</label>
        <input type="text" id="username" name="username">
    </div>
    <div>
        <label for="password">Passwort*</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="email">E-Mail*</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="gender">Geschlecht</label>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
        <input type="radio" id="neutral" name="gender" value="neutral">
        <label for="neutral">Neutral</label>
    </div>
    <div>
        <label for="country">Country</label>
        <select id="country" name="country">
            <option value="CH">Schweiz</option>
            <option value="DE">Deutschland</option>
            <option value="AT">Österreich</option>
        </select>
    </div>
    <div>
        <label >Newsletter</label>
        <input type="checkbox" id="newsletter" name="newsletter" value="1">
        <label for="newsletter">Ja</label>
    </div>
    <br>
    <button type="submit">Registrieren</button>
</form>