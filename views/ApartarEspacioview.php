<?php 
declare(strict_types=1);
require_once 'views/includes/SideBarView.php'; 
require_once 'views/includes/NavBarView.php';
require_once 'config/database.php';
require_once 'models/ApartarEspacio.php';
require_once 'controllers/ApartarEspacio.php';

// Inicializar controlador
$controller = new ApartarEspacioController();

// Procesar formularios POST
$controller->procesarFormulario();

// Obtener datos
$espacios = $controller->obtenerTodos();
$editar = null;
$modoEditar = false;

// Si viene un ID para editar
if (isset($_GET['editar'])) {
    $id = (int)$_GET['editar'];
    $editar = $controller->obtenerPorId($id);
    $modoEditar = $editar !== null;
}

// Obtener mensajes de sesión
$mensaje = $_SESSION['mensaje'] ?? '';
$tipoMensaje = $_SESSION['tipo_mensaje'] ?? '';
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tracto Pensión - Gestión</title>
    <link rel="stylesheet" href="public/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="public/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="public/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="public/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="public/assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="public/assets/images/favicon.png" />
    <style>
        .alert { margin-bottom: 20px; }
        .form-section { margin-bottom: 30px; }
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; }
        .modal-overlay.active { display: flex; align-items: center; justify-content: center; }
        .modal-content { background: white; padding: 30px; border-radius: 8px; width: 90%; max-width: 500px; }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?=NavBarView(); ?>

        <div class="container-fluid page-body-wrapper">
            <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div>Default
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                </div>
            </div>

            <?=SideBarView(); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="page-header">
                        <h3 class="page-title">Gestión de Espacios Apartados</h3>
                    </div>

                    <!-- Mensajes de alerta -->
                    <?php if (!empty($mensaje)): ?>
                        <div class="alert alert-<?= $tipoMensaje === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                            <?= e($mensaje) ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <!-- Formulario de Crear/Editar -->
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $modoEditar ? 'Editar Espacio' : 'Crear Nuevo Espacio' ?></h4>
                                    
                                    <form method="POST" class="form-section">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                        <input type="hidden" name="accion" value="<?= $modoEditar ? 'actualizar' : 'crear' ?>">
                                        
                                        <?php if ($modoEditar): ?>
                                            <input type="hidden" name="id_apartado" value="<?= $editar['id_apartado'] ?>">
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <label for="folio">Folio *</label>
                                            <input type="text" class="form-control" id="folio" name="folio" 
                                                   value="<?= e($editar['folio'] ?? $controller->getSiguienteFolio()) ?>" 
                                                   <?= $modoEditar ? '' : 'readonly' ?> required>
                                        </div>

                                        <div class="form-group">
                                            <label for="estado">Estado *</label>
                                            <select class="form-control" id="estado" name="estado" required>
                                                <option value="">-- Seleccionar --</option>
                                                <option value="en_espera" <?= ($editar['estado'] ?? '') === 'en_espera' ? 'selected' : '' ?>>En Espera</option>
                                                <option value="confirmado" <?= ($editar['estado'] ?? '') === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                                                <option value="cancelado" <?= ($editar['estado'] ?? '') === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                                <option value="completado" <?= ($editar['estado'] ?? '') === 'completado' ? 'selected' : '' ?>>Completado</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea class="form-control" id="observaciones" name="observaciones" rows="4"><?= e($editar['observaciones'] ?? '') ?></textarea>
                                        </div>

                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-success">
                                                <i class="mdi mdi-check"></i> <?= $modoEditar ? 'Actualizar' : 'Guardar' ?>
                                            </button>
                                            <?php if ($modoEditar): ?>
                                                <a href="index.php?menu=apartarespacio" class="btn btn-secondary">
                                                    <i class="mdi mdi-close"></i> Cancelar
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Espacios -->
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <h4 class="card-title mb-0">Espacios Registrados</h4>
                                            <p class="card-description mb-0">Total: <?= count($espacios) ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Fecha</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($espacios)): ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted">
                                                            No hay espacios registrados. Crea uno nuevo.
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($espacios as $espacio): ?>
                                                        <tr>
                                                            <td><strong><?= e($espacio['folio']) ?></strong></td>
                                                            <td><?= date('d/m/Y H:i', strtotime($espacio['fecha_creacion'])) ?></td>
                                                            <td>
                                                                <?php 
                                                                    $badgeClass = match($espacio['estado']) {
                                                                        'en_espera' => 'badge-info',
                                                                        'confirmado' => 'badge-warning',
                                                                        'completado' => 'badge-success',
                                                                        'cancelado' => 'badge-danger',
                                                                        default => 'badge-secondary'
                                                                    };
                                                                    $estadoTexto = ucfirst(str_replace('_', ' ', $espacio['estado']));
                                                                ?>
                                                                <label class="badge <?= $badgeClass ?>">
                                                                    <?= $estadoTexto ?>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <a href="index.php?menu=apartarespacio&editar=<?= $espacio['id_apartado'] ?>" 
                                                                   class="btn btn-outline-primary btn-sm" title="Editar">
                                                                    <i class="mdi mdi-pencil"></i> Editar
                                                                </a>
                                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                                        onclick="confirmarEliminacion(<?= $espacio['id_apartado'] ?>, '<?= e($espacio['folio']) ?>')" 
                                                                        title="Eliminar">
                                                                    <i class="mdi mdi-delete"></i> Eliminar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2026 <a href="#">Tracto Pensión</a>.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hecho para el ITSSMT <i class="mdi mdi-heart text-danger"></i></span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal-overlay" id="modalEliminar">
        <div class="modal-content">
            <h5 class="mb-3">Confirmar Eliminación</h5>
            <p>¿Estás seguro de que deseas eliminar el espacio <strong id="folioEliminar"></strong>?</p>
            <p class="text-muted small">Esta acción no se puede deshacer.</p>
            
            <form id="formEliminar" method="POST" style="margin-top: 20px;">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id_apartado" id="idApartadoEliminar" value="">
                
                <div class="btn-group d-flex gap-2" style="gap: 10px;">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="public/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="public/assets/js/off-canvas.js"></script>
    <script src="public/assets/js/hoverable-collapse.js"></script>
    <script src="public/assets/js/misc.js"></script>
    <script src="public/assets/js/settings.js"></script>
    <script src="public/assets/js/todolist.js"></script>
    <script src="public/assets/js/dashboard.js"></script>

    <script>
        function confirmarEliminacion(id, folio) {
            document.getElementById('idApartadoEliminar').value = id;
            document.getElementById('folioEliminar').textContent = folio;
            document.getElementById('modalEliminar').classList.add('active');
        }

        function cerrarModal() {
            document.getElementById('modalEliminar').classList.remove('active');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modalEliminar').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });
    </script>
</body>
</html>