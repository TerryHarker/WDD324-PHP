<?php
// print_r($_SERVER);
$aktueller_url = $_SERVER['PHP_SELF'];
$letzter_slash = strrpos($aktueller_url, '/');

$dateiname = substr($aktueller_url, $letzter_slash+1);
echo 'dateiname: '.$dateiname;
?>
        <header class="navbar navbar-expand-md bd-navbar">
			<nav class="container flex-wrap flex-md-nowrap" aria-label="Main navigation">
				<a class="navbar-brand p-0 me-2" href="/">NICO's PORTFOLIO<a>
				<ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
					<li class="nav-item col-6 col-md-auto">
						<a class="nav-link p-2 <?php echo $dateiname=='index.php'?'active':''; ?>" href="index.php">Home</a>
					</li>
					<li class="nav-item col-6 col-md-auto">
						<a class="nav-link p-2 <?php echo $dateiname=='portfolio.php'?'active':''; ?>" href="portfolio.php">Portfolio</a>
					</li>
					<li class="nav-item col-6 col-md-auto">
						<a class="nav-link p-2 <?php echo $dateiname=='contact.php'?'active':''; ?>" href="contact.php">Kontakt</a>
					</li>
				</ul>
			</nav>
		</header>