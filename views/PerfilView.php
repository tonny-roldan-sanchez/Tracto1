<?php
require_once 'views/includes/SideBarView.php';
require_once 'views/includes/NavBarView.php';

$usuario = $_SESSION['usuario'] ?? [];
$usuario['nombre'] = $usuario['nombre'] ?? 'Usuario';
$usuario['correo'] = $usuario['correo'] ?? $usuario['email'] ?? '';
$usuario['telefono'] = $usuario['telefono'] ?? 'No registrado';
$usuario['rol'] = $usuario['rol'] ?? 'Usuario';
$usuario['foto'] = $usuario['foto'] ?? 'public/assets/images/faces/face28.png';
$mensajePerfil = $_SESSION['mensaje_perfil'] ?? '';
$errorPerfil = $_SESSION['error_perfil'] ?? '';
unset($_SESSION['mensaje_perfil'], $_SESSION['error_perfil']);
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil</title>

    <link rel="stylesheet" href="public/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="public/assets/css/demo_1/style.css">

</head>

<body>

    <div class="container-scroller">

        <?= NavBarView(); ?>

        <div class="container-fluid page-body-wrapper">

            <?= SideBarView(); ?>

            <div class="main-panel">

                <div class="content-wrapper">

                    <!-- Título -->
                    <div class="page-header">

                        <h3 class="page-title">

                            <i class="mdi mdi-account-circle mr-2"></i>
                            Mi Perfil

                        </h3>

                    </div>

                    <?php if ($mensajePerfil !== ''): ?>
                        <div class="alert alert-success"><?= e($mensajePerfil) ?></div>
                    <?php endif; ?>
                    <?php if ($errorPerfil !== ''): ?>
                        <div class="alert alert-danger"><?= e($errorPerfil) ?></div>
                    <?php endif; ?>

                    <!-- Card -->
                    <div class="card shadow-sm border-0">

                        <div class="card-body">

                            <div class="row">

                                <!-- Foto -->
                                <div class="col-md-4 text-center">

                                    <img src="<?= e($usuario['foto']) ?>"
                                        class="rounded-circle shadow"
                                        width="180">

                                    <h4 class="mt-3">
                                        <?= e($usuario['nombre']) ?>
                                    </h4>

                                    <label class="badge badge-primary p-2">
                                        <?= e($usuario['rol']) ?>
                                    </label>

                                </div>

                                <!-- Información -->
                                <div class="col-md-8">

                                    <form method="POST" enctype="multipart/form-data">
                                        <?= csrf_input() ?>

                                        <div class="form-group">
                                            <label for="foto">Foto de perfil</label>
                                            <input type="file" class="form-control-file" id="foto" name="foto"
                                                accept="image/jpeg,image/png,image/gif,image/webp">
                                            <small class="form-text text-muted">Formatos JPG, PNG, GIF o WEBP. Máximo 5 MB.</small>
                                        </div>

                                        <div class="form-group">

                                            <label>
                                                Nombre
                                            </label>

                                            <input type="text"
                                                class="form-control"
                                                value="<?= e($usuario['nombre']) ?>">

                                        </div>

                                        <div class="form-group">

                                            <label>
                                                Correo
                                            </label>

                                            <input type="email"
                                                class="form-control"
                                                value="<?= e($usuario['correo']) ?>">

                                        </div>

                                        <div class="form-group">

                                            <label>
                                                Teléfono
                                            </label>

                                            <input type="text"
                                                class="form-control"
                                                value="<?= e($usuario['telefono']) ?>">

                                        </div>

                                        <div class="form-group">

                                            <label>
                                                Contraseña
                                            </label>

                                            <input type="password"
                                                class="form-control"
                                                placeholder="********">

                                        </div>

                                        <div class="mt-4">

                                            <button class="btn btn-primary mr-2">

                                                <i class="mdi mdi-content-save"></i>
                                                Guardar Cambios

                                            </button>

                                            <button class="btn btn-danger">

                                                <i class="mdi mdi-delete"></i>
                                                Eliminar Perfil

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <footer class="footer">
            <div class="footer-inner-wraper">
                <span class="text-muted text-left d-block">Copyright © 2025 Tracto Pensión San Leonardo. Todos los derechos reservados.</span>
            </div>
        </footer>

    </div>

    <!-- plugins:js -->
    <script src="public/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- inject:js -->
    <script src="public/assets/js/off-canvas.js"></script>
    <script src="public/assets/js/hoverable-collapse.js"></script>
    <script src="public/assets/js/misc.js"></script>
    <script src="public/assets/js/settings.js"></script>
    <script src="public/assets/js/todolist.js"></script>

</body>

</html>