<?php 
require_once 'views/includes/SideBarView.php'; 
require_once 'views/includes/NavBarView.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tracto Pensión</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="public/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="public/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css">

    <!-- Plugin css -->
    <link rel="stylesheet" href="public/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="public/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="public/assets/css/demo_1/style.css">

    <link rel="shortcut icon" href="public/assets/images/favicon.png" />

</head>

<body>

<div class="container-scroller">

    <!-- Navbar -->
    <?=NavBarView(); ?>

    <div class="container-fluid page-body-wrapper">

        <!-- Configuración -->
        <div id="settings-trigger">
            <i class="mdi mdi-settings"></i>
        </div>

        <div id="theme-settings" class="settings-panel">

            <i class="settings-close mdi mdi-close"></i>

            <p class="settings-heading">SIDEBAR SKINS</p>

            <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div>
                Default
            </div>

            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-light border mr-3"></div>
                Light
            </div>

            <p class="settings-heading mt-2">HEADER SKINS</p>

            <div class="color-tiles mx-0 px-4">
                <div class="tiles primary"></div>
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default light"></div>
            </div>

        </div>

        <!-- Sidebar -->
        <?=SideBarView(); ?>

        <!-- Main -->
        <div class="main-panel">

            <div class="content-wrapper">

                <!-- Título -->
                <div class="page-header">
                    <h3 class="page-title">

                        <i class="mdi mdi-truck text-dark mr-2"></i>
                        Mi Camión

                    </h3>
                </div>

                <!-- Imagen arriba -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">

                    <div class="card-body text-center">

                        <img src="public/assets/images/samples/1280x768/12.jpg"
                             alt="Camión"
                             class="img-fluid rounded shadow-sm"
                             width="350">

                    </div>

                </div>

                <!-- Información abajo -->
                <div class="card shadow-sm border-0 rounded-4">

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-4">

                            <i class="mdi mdi-information-outline text-primary mr-2"
                               style="font-size: 28px;"></i>

                            <h4 class="mb-0 font-weight-bold">
                                Información Del Camión
                            </h4>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-borderless">

                                <tbody>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Placa:
                                        </td>

                                        <td>
                                            123-BF-5
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Marca:
                                        </td>

                                        <td>
                                            Freightliner
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Modelo:
                                        </td>

                                        <td>
                                            Cascadia 2020
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Color:
                                        </td>

                                        <td>
                                            Blanco
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Fecha de Entrada:
                                        </td>

                                        <td>
                                            22/04/2026
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Hora de Entrada:
                                        </td>

                                        <td>
                                            19:55 hrs
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">
                                            Estado:
                                        </td>

                                        <td>

                                            <label class="badge badge-success p-2">
                                                En pensión
                                            </label>

                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <!-- Botón -->
                        <div class="mt-4">

                            <a href="index.php?view=apartar_espacio"
                               class="btn btn-primary rounded-pill">

                                <i class="mdi mdi-map-marker"></i>
                                Confirmar Reserva

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Footer -->
            <footer class="footer">

                <div class="footer-inner-wraper">

                    <div class="d-sm-flex justify-content-center justify-content-sm-between">

                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">

                            Copyright © 2026
                            Tracto Pensión San Leonardo

                        </span>


                    </div>

                </div>

            </footer>

        </div>

    </div>

</div>

<!-- plugins:js -->
<script src="public/assets/vendors/js/vendor.bundle.base.js"></script>

<!-- Plugin js -->
<script src="public/assets/vendors/chart.js/Chart.min.js"></script>
<script src="public/assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>

<!-- inject:js -->
<script src="public/assets/js/off-canvas.js"></script>
<script src="public/assets/js/hoverable-collapse.js"></script>
<script src="public/assets/js/misc.js"></script>
<script src="public/assets/js/settings.js"></script>
<script src="public/assets/js/todolist.js"></script>

<!-- Custom js -->
<script src="public/assets/js/dashboard.js"></script>

</body>
</html>