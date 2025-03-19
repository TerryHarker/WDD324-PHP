<?php
// namespace: diese komponenten von PHP Mailer müssen zur Verfügung stehen
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; // fürs debugging

require 'vendor/autoload.php'; // autoload lädt alle notwendigen Bibliotheken

$hasErrors      = false;    // Statusvariable für Fehler (true=fehlerhaft)
$errorMessages  = array();  // Container zum Sammeln von Fehlermeldungen
$successMessage = '';       // Variable für die Bestätigungsmessage wenn alles geklappt hat

if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) ){

    // Werte stehen in POST zur Verfügung - los gehts
    $mailer = new PHPMailer(true); // Mailer instanzieren
    $mailer->isSMTP(); // SMTP (Postausgang) verwenden, ohne diese Einstellung wird über den lokalen Server gesendet

    // SMTP Konfiguration - ähnlich wie beim konfigurieren deines Mail Clients
    $mailer->Host       = 'smtp.gmail.com'; // Postausgangsserver
    $mailer->SMTPAuth   = true; // Authentifizierung einschalten
    $mailer->Username   = 'meine@email.com'; // deine Mail adresse
    $mailer->Password   = ''; // dein mail passwort oder App Passwort im Falle von Google ('ajek vhhq erbs ouuu')
    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Verschlüsselungsmethode: implicit TLS encryption
    $mailer->Port       = 465; // Port für den POstausgang (meist 465 oder 587)

    // E-Mail Header
    $mailer->setFrom('terry@bytekultur.net'); // absender 
    $mailer->addAddress('test-9z0yd4t8c@srv1.mail-tester.com'); // empfänger

    /* Spam Test: 
     * https://mail-tester.com
     * 
     * mein Test: test-9z0yd4t8c@srv1.mail-tester.com
     * meine Auswertung: https://www.mail-tester.com/test-9z0yd4t8c
     */

    // E-Mail Inhalt
    $mailer->Subject = 'Neue Registrierung';
    $mailer->Body = $_POST['username'].' hat sich gerade registriert';

    // Senden und überprüfen
    $mailSent = $mailer->send();
    if($mailSent){
        $successMessage = 'Vielen Dank für deine Registration';
    }else{
        $errorMessages[] = 'Konnte das Mail nicht versenden';
    }
}

?>
<h3>Registration</h3>

<?php if( !empty($successMessage) > 0 ){ ?>
<div style="color:green;"><?php echo $successMessage; ?></div>
<?php } ?>
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
    
    <button type="submit">Registrieren</button>
</form>