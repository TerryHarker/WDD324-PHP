        <section class="footer-section">
			<div class="container">
				<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
				  <div class="col-md-4 d-flex align-items-center">
					<span class="mb-3 mb-md-0 text-body-secondary">© 2025 Nico the webdesigner</span>
				</div>
				<?php if( isset($isLoggedIn) && $isLoggedIn == true){ ?>
				<div class="mb-3 mb-md-0 text-body-secondary"><a href="logout.php">Logout</a></div>
				<?php } ?>
				</footer>
			</div>
		</section>