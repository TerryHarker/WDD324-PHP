<?php
require_once('configuration.php');
require_once('functions/html.functions.php');

// Metadaten für htmlhead.php
$page_title = 'Nicos HTML Page | Home';
$meta_desc = '';
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
	
	<?php include('partials/htmlhead.php'); ?>	
	
	<body>
		<?php include('partials/header.php'); ?>
	
		<section class="main-section">
			<div class="container">
				
				
				<div class="mt-5">
						<h1 class="heading-xlarge">Hallo,<br><strong>Ich bin Nico</strong></h1>
						<p class="lead">Web- und anderes Design aller Art mache ich gerne für dich oder deine Firma.</p>
				</div>
				
			</div>
		</section>
		
		<?php include('partials/footer.php'); ?>
		
	</body>
</html>