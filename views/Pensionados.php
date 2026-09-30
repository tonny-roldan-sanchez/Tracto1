<?php
require_once 'views/includes/SideBarView.php';
require_once 'views/includes/NavBarView.php';
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Pensionados - Tracto Pensión</title>
		<link rel="stylesheet" href="public/assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="public/assets/css/demo_1/style.css">
		<link rel="shortcut icon" href="public/assets/images/favicon.png">
	</head>
	<body>
		<div class="container-scroller">
			<?= NavBarView(); ?>

			<div class="container-fluid page-body-wrapper">
				<div id="settings-trigger"><i class="mdi mdi-settings"></i></div>

				<?= SideBarView(); ?>

				<div class="main-panel">
					<div class="content-wrapper">
						<div class="page-header">
							<h3 class="page-title">
								<i class="mdi mdi-account-group text-dark mr-2"></i>
								Pensionados
							</h3>
						</div>

						<div class="card border-0 shadow-sm">
							<div class="card-body text-center">
								<i class="mdi mdi-account-group mdi-48px text-primary"></i>
								<h4 class="font-weight-bold mt-3">Modulo de pensionados</h4>
								<p class="text-muted mb-0">La informacion de los pensionados estara disponible aqui.</p>
							</div>
						</div>
					</div>

					<footer class="footer">
						<div class="footer-inner-wraper">
							<div class="d-flex justify-content-start">
								<span class="text-muted text-left d-block">
									Copyright &copy; 2025 Tracto Pensión San Leonardo. Todos los derechos reservados.
								</span>
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>

		<script src="public/assets/vendors/js/vendor.bundle.base.js"></script>
		<script src="public/assets/js/off-canvas.js"></script>
		<script src="public/assets/js/hoverable-collapse.js"></script>
		<script src="public/assets/js/misc.js"></script>
		<script src="public/assets/js/settings.js"></script>
	</body>
</html>
