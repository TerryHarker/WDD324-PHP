<?php
/**
 * Generieren für die Authenticator App
 */
require 'vendor/autoload.php';
use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\QRServerProvider;

// benötigt für den QR Code (um App und User in der Authenticator App anzuzeigen): 
$username = 'Terry';
$appName = 'WDD324 Demo';

$qrc = new QRServerProvider(); // QR Code generator
$tfa = new TwoFactorAuth($qrc, $appName); // 2FA Klasse instanzieren
$secret = $tfa->createSecret(); // Speichern für den Nutzer, z.B. in Datenbank ablegen und anzeigen, z.B. mit chunk_split($secret, 4, ' ')
$qrcode = $tfa->getQRCodeImageAsDataUri($username, $secret); // in img Tag als src ausgeben, um den Code anzuzeigen

?>
<h3>2 Faktor Authentifizierung erstellen für Account <?php echo $username; ?></h3>
<p>Gebe das Secret in deine Authenticator App ein oder scanne den QR code.</p>
Secret: <?php echo $secret; ?><br>
QR Code: <br>
<img src="<?php echo $qrcode; ?>">