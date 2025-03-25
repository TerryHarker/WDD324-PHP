<?php
require_once('configuration.php');
require_once('functions/html.functions.php');

// Metadaten für htmlhead.php
$page_title = '';
$meta_desc = '';

// Daten Array für die Galerie:
$projekte = array(
    array(
        'bild' => 'Business-20.png',
        'titel' => 'Business 20',
        'jahr' => '2025'
    ),
    array(
        'bild' => 'eaef_Blurr-402x.jpg',
        'titel' => 'BLurr',
        'jahr' => '2024'
    ),
    array(
        'bild' => 'Pompeo.jpg',
        'titel' => 'Pompeo',
        'jahr' => '2024'
    ),
    array(
        'bild' => 'biznus.jpg',
        'titel' => 'BizNus',
        'jahr' => '2023'
    )
);

?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
	
	<?php include('partials/htmlhead.php'); ?>
	
	<body>
		
		<?php include('partials/header.php'); ?>
	
		<section class="main-section">
			<div class="container">
				
				<div class="mt-5">
					<h2>Aktuelle Projekte</h2>
				</div>
				<div class="row mt-4">
					<?php
					foreach($projekte as $projekt){
					?>
					<div class="col-12 col-sm-6 col-md-3">
						<img src="<?php echo BILDERORDNER.'/'.$projekt['bild'] ?>">
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
		
		
		<?php include('partials/footer.php'); ?>

		
	</body>
</html>