<?php
// zuerst den Dateinamen für den Aktivstatus der Nav ermitteln
$aktueller_url = $_SERVER['PHP_SELF']; // $_SERVER ist ein Super Global, global = auf allen Ebenen gültig, daher kann es hier im Function Scope verwendet werden
$letzter_slash = strrpos($aktueller_url, '/');
$dateiname = substr($aktueller_url, $letzter_slash+1);
// echo 'dateiname: '.$dateiname;


// Nav HTML aufbauen
$admin_nav = '<ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">';

$activeClass = $dateiname=='index.php'?'active':'';
$admin_nav .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="index.php">Home</a></li>';

$activeClass = $dateiname=='project-list.php'?'active':'';
$admin_nav .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="project-list.php">Projekte</a></li>';

$activeClass = $dateiname=='user-list.php'?'active':'';
$admin_nav .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="user-list.php">Benutzer</a></li>';

$admin_nav .= '</ul>';
?>
        <header class="navbar navbar-expand-md bd-navbar">
			<nav class="container flex-wrap flex-md-nowrap" aria-label="Main navigation">
				<a class="navbar-brand p-0 me-2" href="/">ADMIN - NICO's PORTFOLIO<a>

				<?php echo $admin_nav; ?>

			</nav>
		</header>