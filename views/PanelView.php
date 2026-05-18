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
    <link rel="stylesheet" href="public/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="public/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="public/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="public/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="public/assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="public/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">

      <?= NavBarView(); ?>

      <div class="container-fluid page-body-wrapper">
        <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>

        <?= SideBarView(); ?>

        <div class="main-panel">
          <div class="content-wrapper">

            <!-- Encabezado -->
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2">Dashboard (Cliente)</h2>
              <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                <div class="btn-group bg-white p-3" role="group">
                  <button type="button" class="btn btn-link text-dark py-0 border-right">1 Month</button>
                  <button type="button" class="btn btn-link text-light py-0">3 Month</button>
                </div>
                <div class="dropdown ml-0 ml-md-4 mt-2 mt-lg-0">
                  <button class="btn bg-white dropdown-toggle p-3 d-flex align-items-center" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-calendar mr-1"></i>24 Mar 2019 - 24 Mar 2019
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabs -->
            <div class="row">
              <div class="col-md-12">
                <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border">
                  <ul class="nav nav-tabs tab-transparent" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">Users</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="business-tab" data-toggle="tab" href="#business-1" role="tab" aria-selected="false">Business</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="performance-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Performance</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="conversion-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Conversion</a>
                    </li>
                  </ul>
                  <div class="d-md-block d-none">
                    <a href="#" class="text-light p-1"><i class="mdi mdi-view-dashboard"></i></a>
                    <a href="#" class="text-light p-1"><i class="mdi mdi-dots-vertical"></i></a>
                  </div>
                </div>

                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">

                    <!-- 4 Tarjetas de métricas -->
                    <div class="row">

                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Camiones Registrados</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">70</h2>
                            <i class="mdi mdi-truck icon-lg text-primary"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Espacios disponibles</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">20</h2>
                            <i class="mdi mdi-package-variant icon-lg text-success"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Pagos pendientes</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">8</h2>
                            <i class="mdi mdi-cash-multiple icon-lg text-warning"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Pagos al corriente</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">10</h2>
                            <i class="mdi mdi-check-circle icon-lg text-success"></i>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- fin tarjetas -->
<!-- Gráfica Ocupación Actual -->
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center mb-3">Ocupación Actual</h4>
        <div class="d-flex align-items-center justify-content-center">
          <canvas id="ocupacionChart" width="200" height="200"></canvas>
          <div class="ml-4">
            <div class="d-flex align-items-center mb-2">
              <div style="width:16px;height:16px;background:#7ed321;border:1px solid #ccc;margin-right:8px;"></div>
              <span>Ocupado</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="width:16px;height:16px;background:#ffffff;border:1px solid #ccc;margin-right:8px;"></div>
              <span>Disponible</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- fin gráfica ocupación -->

<!-- Tabla Actividad Reciente -->
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">

        <h4 class="card-title mb-3">
          <a href="#" class="text-primary font-weight-bold">Actividad Reciente</a>
        </h4>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Línea</th>
                <th>Nombre del operador</th>
                <th>Pensionado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $actividad = [
                ['fecha' => '13/03/2026', 'linea' => 'GRL',           'operador' => 'Enrique Guzmán',    'pensionado' => 'Boleto'],
                ['fecha' => '12/03/2026', 'linea' => 'PETROPIPAS',    'operador' => 'Luis Roldán',       'pensionado' => 'Boleto'],
                ['fecha' => '11/03/2026', 'linea' => 'COSTA A COSTA', 'operador' => 'Julio Rodríguez',   'pensionado' => 'Boleto'],
                ['fecha' => '10/03/2026', 'linea' => 'SANTEX',        'operador' => 'Rodrigo Velázquez', 'pensionado' => 'SI'],
                ['fecha' => '07/03/2026', 'linea' => 'EVERYTIME',     'operador' => 'Manuel Hernández',  'pensionado' => 'SI'],
              ];
              foreach ($actividad as $row): ?>
              <tr>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['linea'] ?></td>
                <td><?= $row['operador'] ?></td>
                <td><?= $row['pensionado'] ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- fin tabla actividad reciente -->

                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- content-wrapper ends -->

          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                  Copyright © 2025 Tracto Pensión San Leonardo. Todos los derechos reservados.
                </span>
              </div>
            </div>
          </footer>

        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script src="public/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="public/assets/js/off-canvas.js"></script>
    <script src="public/assets/js/hoverable-collapse.js"></script>
    <script src="public/assets/js/misc.js"></script>
    <script src="public/assets/js/settings.js"></script>
    <script src="public/assets/js/todolist.js"></script>
  </body>
</html>