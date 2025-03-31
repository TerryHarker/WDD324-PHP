<?php
/** 
 * password_hash demo  
 * 
 * mit password_hash() können dank einem wechselnden Salt unterschiedliche Hashes 
 * für den gleichen Ausgangswert erstellt werden. So sollten Passworte abgelegt werden. 
 * 
 * password_verify() kann das Passwort nicht mehr lesbar machen, 
 * hilft uns aber, den User Input danach wieder zu verifzieren, obwohl er nur noch als Hash gespeichert ist
 * */ 
?>
<h1>PW Hash Demo</h1>
<p>Siehe <a href="https://www.php.net/manual/de/function.password-hash" target="_blank">password_hash() auf PHP.NET</a></p>

<?php
$username = 'Terry';
$password = 'test1234'; // Passwort im Klartext - ausser in dieser Demo nie so speichern!
$password_hash = '$2y$10$IoWdMwwFOw6jJekEjz0DcO7yhMC2yES362CgPMgp3vTxKJcA2y.4u'; // hash von 'test1234' - so wird ein Passwort gespeichert

// Hashing Methoden im Vergleich
echo '<br>Ein MD5 hash von '.$password.': '.md5($password);
echo '<br>Anderer MD5 hash von '.$password.': '.md5($password);
echo '<br>';
echo '<br>Ein PW hash von '.$password.': '.password_hash($password, PASSWORD_DEFAULT );
echo '<br>Anderer PW hash von '.$password.': '.password_hash($password, PASSWORD_DEFAULT );
echo '<br>';
echo '<br>';

echo '<strong>Passwort prüfen mit password_verify()</strong>';
// So wird ein mit password_hash erzeugter hash eines Passwortes überprüft:  
$passwort_test = password_verify($password, $password_hash); // true wenn das PW korrekt ist
echo '<br>Ist "'.$password.'" das gleiche passwort wie der hash? ';
var_dump($passwort_test);
$passwort_test2 = password_verify('falschesPW', $password_hash); // true wenn das PW korrekt ist
echo '<br>Ist "falschesPW" das gleiche passwort wie der hash? ';
var_dump($passwort_test2);
?>