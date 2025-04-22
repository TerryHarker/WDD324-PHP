<?php
require_once('../configuration.php');
require_once('../functions/html.functions.php');
require_once('../functions/session.functions.php');

session_name( md5(SESSIONNAME) );
session_start(); // Session eröffnen und allenfalls session ID erstellen

$isLoggedIn = loginCheck();
// var_dump($isLoggedIn);

/**
 * LOGIN LOGIK
 */
if( $isLoggedIn == true){
    // session noch gültig - zeit erneuern
    loginRefresh();
}else{
    // session nicht gültig - zurücksetzen
    logout();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">

<?php include('partials/htmlhead.php'); ?>
<body>
    <?php include('partials/header.php'); ?>

    <section class="main-section">
		<div class="container">

            <div class="mt-5">
                <h1 class="heading-1">Adminbereich</h1>
                Dieser bereich ist nur für Admins zu sehen               
            </div>          
           
        </div>
    </section>

    <?php
    include('partials/footer.php');
    ?>
</html>