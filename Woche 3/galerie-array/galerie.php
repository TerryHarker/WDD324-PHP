<?php
// Daten Array für die Galerie in einem mehrdimensionalen Array
$projekte = array(
    array(
        'bild' => 'media/Business-20.png',
        'titel' => 'Business 20',
        'jahr' => '2025'
    ),
    array(
        'bild' => 'media/eaef_Blurr-402x.jpg',
        'titel' => 'BLurr',
        'jahr' => '2024'
    ),
    array(
        'bild' => 'media/Pompeo.jpg',
        'titel' => 'Pompeo',
        'jahr' => '2024'
    ),
    array(
        'bild' => 'media/biznus.jpg',
        'titel' => 'BizNus',
        'jahr' => '2023'
    )
);
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Webddesign Projekte</title>
		<meta name="title" content="Nico's Portfolio | Webdesign Projekte">
		<meta name="description" content="Meine aktuellen Projekte">
		<meta name="author" content="Nico">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/theme.css">
	</head>
	<body>

	
		<section class="main-section">
			<div class="container">
				
				<div class="mt-5">
						<h2>Aktuelle Projekte</h2>
				</div>
				<div class="row mt-4">
					
					<?php
					// Ausgabe der Daten aus dem Galerie-Array  mittles Loop - es entsteht für jedes Projekt die gleiche HTML Struktur mit Bild, Titel und Text
					foreach($projekte as $projekt){
					?>
					<div class="col-12 col-sm-6 col-md-3">
						<img src="<?php echo $projekt['bild'] ?>">
						<p><strong><?php echo $projekt['titel'] ?></strong><br><?php echo $projekt['jahr'] ?></p>
					</div>
					<?php
					}
					?>
					
				</div>
				<div>
					<em class="text-muted">image credit: webflow.io</em>
				</div>
			</div>
		</section>
		
		
	</body>
</html>