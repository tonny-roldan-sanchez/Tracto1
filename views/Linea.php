<?php
require_once 'views/includes/SideBarView.php';
require_once 'views/includes/NavBarView.php';

$lineaSeleccionadaId = (int) ($lineaSeleccionadaId ?? 0);
$lineaSeleccionada = $lineaSeleccionada ?? null;
$lineas = is_array($lineas ?? null) ? $lineas : [];
$camionesPensionados = is_array($camionesPensionados ?? null) ? $camionesPensionados : [];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Lineas - Tracto Pensión</title>
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
						<div class="d-xl-flex justify-content-between align-items-start mb-4">
							<div>
								<h2 class="text-dark font-weight-bold mb-2">
									<i class="mdi mdi-source-branch mr-2"></i>Lineas
								</h2>
								<p class="text-muted">Administra las lineas y consulta sus carros pensionados.</p>
							</div>
						</div>

						<?php if (!empty($mensajeLinea)): ?>
							<div class="alert alert-<?= htmlspecialchars($mensajeLinea['tipo']) ?>" role="alert">
								<?= htmlspecialchars($mensajeLinea['mensaje']) ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($mensajeBusquedaLinea)): ?>
							<div class="alert alert-<?= htmlspecialchars($mensajeBusquedaLinea['tipo']) ?>" role="alert">
								<?= htmlspecialchars($mensajeBusquedaLinea['mensaje']) ?>
							</div>
						<?php endif; ?>

						<div class="row">
							<div class="col-lg-5 mb-4">
								<div class="card border-0 shadow-sm h-100">
									<div class="card-body">
										<h4 class="card-title">Agregar linea</h4>
										<form method="post" action="index.php?menu=linea">
											  <?= csrf_input(); ?>
											<div class="form-group">
												<label for="nom_linea">Nombre de la linea</label>
												<input
													type="text"
													class="form-control"
													id="nom_linea"
													name="nom_linea"
													maxlength="80"
													value="<?= htmlspecialchars($lineaSeleccionada['nom_linea'] ?? '') ?>"
													required>
											</div>
											<div class="d-flex flex-wrap">
												<button type="submit" name="accion" value="agregar" class="btn btn-primary mr-2 mb-2">
													<i class="mdi mdi-plus mr-1"></i>Agregar
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-lg-7 mb-4">
								<div class="card border-0 shadow-sm h-100">
									<div class="card-body">
										<h4 class="card-title">Buscar linea</h4>
										<form method="get" action="index.php" class="form-row align-items-end">
											<input type="hidden" name="menu" value="linea">
											<div class="col-md-8 form-group mb-md-0">
												<label for="buscar">Nombre</label>
												<input type="search" class="form-control" id="buscar" name="buscar" value="<?= htmlspecialchars($busquedaLinea ?? '') ?>" placeholder="Escribe una linea">
											</div>
											<div class="col-md-4">
												<button type="submit" class="btn btn-info btn-block">
													<i class="mdi mdi-magnify mr-1"></i>Buscar
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="card border-0 shadow-sm mb-4">
							<div class="card-body">
								<h4 class="card-title">Lineas registradas</h4>
								<div class="table-responsive">
									<table class="table table-hover mb-0">
										<thead>
											<tr>
												<th>Nombre de la linea</th>
												<th class="text-right">
													<div>Accion</div>
													<form method="post" action="index.php?menu=linea" class="d-inline">
														<?= csrf_input(); ?>
														<input type="hidden" name="id_linea" value="<?= $lineaSeleccionadaId ?>">
														<button type="submit" name="accion" value="eliminar" class="btn btn-sm btn-danger mt-2" <?= (!$lineaSeleccionada || (int) $lineaSeleccionada['total_camiones'] > 0) ? 'disabled title="Selecciona una linea sin camiones"' : "onclick=\"return confirm('¿Eliminar esta linea?');\"" ?>>
																		<i class="mdi mdi-delete mr-1"></i>Eliminar
														</button>
													</form>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($lineas): ?>
												<?php foreach ($lineas as $linea): ?>
													<tr class="<?= (int) $linea['id_linea'] === $lineaSeleccionadaId ? 'table-primary' : '' ?>">
															<td>
																<form method="post" action="index.php?menu=linea" class="form-inline">
																	<?= csrf_input(); ?>
																	<input type="hidden" name="id_linea" value="<?= (int) $linea['id_linea'] ?>">
																		<span id="nombre-linea-<?= (int) $linea['id_linea'] ?>" class="mr-2">
																			<?= htmlspecialchars($linea['nom_linea']) ?>
																		</span>
																		<input type="text" name="nom_linea" value="<?= htmlspecialchars($linea['nom_linea']) ?>" class="form-control mr-2 d-none" id="editar-linea-<?= (int) $linea['id_linea'] ?>" maxlength="80" required>
																		<button type="button" class="btn btn-sm btn-warning" id="boton-editar-<?= (int) $linea['id_linea'] ?>" onclick="activarEdicionLinea(<?= (int) $linea['id_linea'] ?>)">
																		<i class="mdi mdi-pencil mr-1"></i>Modificar
																	</button>
																		<button type="submit" name="accion" value="modificar" class="btn btn-sm btn-success d-none" id="boton-guardar-<?= (int) $linea['id_linea'] ?>">
																			<i class="mdi mdi-content-save mr-1"></i>Guardar
																		</button>
																</form>
															</td>
														<td class="text-right">
															<a class="btn btn-sm btn-outline-primary" href="index.php?menu=linea&id_linea=<?= (int) $linea['id_linea'] ?>">
																<i class="mdi mdi-eye mr-1"></i>Seleccionar
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="2" class="text-center text-muted">No hay lineas registradas.</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<?php if ($lineaSeleccionada): ?>
							<div class="card border-0 shadow-sm">
								<div class="card-body">
									<h4 class="card-title">
										Carros pensionados de: <?= htmlspecialchars($lineaSeleccionada['nom_linea']) ?>
									</h4>
									<div class="table-responsive">
										<table class="table table-hover mb-0">
											<thead>
												<tr>
													<th>Placa</th>
													<th>Modelo</th>
													<th>Pensionado</th>
													<th>Estado de cuenta</th>
													<th>Proximo pago</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($camionesPensionados): ?>
													<?php foreach ($camionesPensionados as $camion): ?>
														<tr>
															<td><strong><?= htmlspecialchars($camion['placa']) ?></strong></td>
															<td><?= htmlspecialchars($camion['modelo']) ?></td>
															<td><?= htmlspecialchars($camion['pensionado']) ?></td>
															<td><?= htmlspecialchars($camion['estado_cuenta'] ?? 'Sin estado') ?></td>
															<td><?= !empty($camion['proximo_pago']) ? htmlspecialchars(date('d/m/Y', strtotime($camion['proximo_pago']))) : '-' ?></td>
														</tr>
													<?php endforeach; ?>
												<?php else: ?>
													<tr>
														<td colspan="5" class="text-center text-muted">Esta linea no tiene carros pensionados registrados.</td>
													</tr>
												<?php endif; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<footer class="footer">
						<div class="footer-inner-wraper">
							<div class="d-flex justify-content-start">
								<span class="text-muted text-left d-block">Copyright &copy; 2025 Tracto Pensión San Leonardo. Todos los derechos reservados.</span>
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
		<script>
			function activarEdicionLinea(idLinea) {
				document.getElementById('nombre-linea-' + idLinea).classList.add('d-none');
				document.getElementById('editar-linea-' + idLinea).classList.remove('d-none');
				document.getElementById('boton-editar-' + idLinea).classList.add('d-none');
				document.getElementById('boton-guardar-' + idLinea).classList.remove('d-none');
				document.getElementById('editar-linea-' + idLinea).focus();
			}
		</script>
	</body>
</html>
