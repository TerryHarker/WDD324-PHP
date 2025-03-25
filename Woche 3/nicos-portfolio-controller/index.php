<?php
require_once('configuration.php'); // Konfiguration der Seite (ausgelagert, damit man diese einzeln öffnen kann)
require_once('functions/html.functions.php');

// index.php?page=contact
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Pfade für das Einbinden des spezifischer Seiten-Codes: 
$script_url = 'scripts/'.$page.'.php'; // Verarbeitungs-PHP für diese Seite
$html_url = 'html/'.$page.'.php'; // Ausgabe HTML für diese Seite


// Verarbeitungs-Skript zur angeforderten einbinden, wenn es existiert
if( is_file($script_url) ){
	include($script_url);
}

?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Nico's Portfolio | Webdesign und anderes Design</title>
		<meta name="title" content="Nico's Portfolio | Webdesign und anderes Design">
		<meta name="description" content="Web- und anderes Design von Nico">
		<meta name="author" content="Nico">
		
		<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="assets/favicons/favicon.png">
		<link rel="icon" type="image/png" sizes="180x180" href="assets/favicons/favicon.png">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/theme.css">
	</head>
	<body>
		<header class="navbar navbar-expand-md bd-navbar">
			<nav class="container flex-wrap flex-md-nowrap" aria-label="Main navigation">
				<a class="navbar-brand p-0 me-2" href="/">NICO's PORTFOLIO<a>
				
				<?php echo writeNav($page, 'navbar-nav flex-row flex-wrap bd-navbar-nav') ?>

			</nav>
		</header>
	
		<?php
		
		// echo $html_url;

		// HTML Output zur angeforderten Seite einbinden, wenn es existiert
		if( is_file($html_url) ){
			include($html_url);
		}else{
			// sonst: 404 anzeigen
			?>
		<section class="main-section">
			<div class="container">
				<div class="mt-3">
					<h1>404 - Seite nicht gefunden</h1>
					Diese Seite existiert nicht oder nicht mehr.	
				</div>
			</div>
		</section>
			<?php
		}

		?>
		
		<section class="footer-section">
			<div class="container">
				<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
				  <div class="col-md-4 d-flex align-items-center">
					<span class="mb-3 mb-md-0 text-body-secondary">© 2024 Nico the webdesigner</span>
					
				</div>
				<div class="mb-3 mb-md-0 text-body-secondary"><?php echo writeNav($page, 'nav') ?></div>
			  
				  
				</footer>
			  </div>
		</section>

		
	</body>
</html>