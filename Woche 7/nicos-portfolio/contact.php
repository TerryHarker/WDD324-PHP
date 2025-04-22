<?php
require_once('configuration.php');
require_once('functions/html.functions.php');

// Metadaten für htmlhead.php
$page_title = "Nico's Portfolio | Kontakt";
$meta_desc = '';
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
	
	<?php include('partials/htmlhead.php'); ?>

	<body>
		
		<?php include('partials/header.php'); ?>
	
		<section class="main-section">
			<div class="container">
				<div class="mt-3">
					<h1>Contact me</h1>
					<p><a href="mailto:terry@bytekultur.net">nico@myportfolio.biz</a></p>
				</div>
				<div class="mt-5">
					<h2>Send me a message</h2>
					<form action="/submit_form" method="post">
						<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" class="form-control" id="name" name="name" required>
						</div>
						<div class="mb-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" class="form-control" id="email" name="email" required>
						</div>
						<div class="mb-3">
						<label for="message" class="form-label">Message</label>
						<textarea class="form-control" id="message" name="message" rows="3" required></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</section>
		
		
		<?php include('partials/footer.php'); ?>
		
	</body>
</html>