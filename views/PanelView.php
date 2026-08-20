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

            <div class="row">
              <div class="col-12">
                <div class="card border-0 shadow-sm mb-4">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                      <div>
                        <h3 class="text-dark font-weight-bold mb-1">Dashboard</h3>
                        <p class="text-muted mb-0">Resumen general del estado del sistema</p>
                      </div>
                      <div class="text-right">
                        <h4 class="text-primary mb-0">Bienvenido</h4>
                        <small class="text-muted">Tracto Pensión San Leonardo</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <?php
              $colorMap = [
                'primary' => ['text' => 'text-primary', 'bg' => 'bg-primary bg-opacity-10'],
                'success' => ['text' => 'text-success', 'bg' => 'bg-success bg-opacity-10'],
                'warning' => ['text' => 'text-warning', 'bg' => 'bg-warning bg-opacity-10'],
                'info' => ['text' => 'text-info', 'bg' => 'bg-info bg-opacity-10'],
              ];
              foreach ($panelData['stats'] as $stat):
                $colors = $colorMap[$stat['color']] ?? $colorMap['primary'];
              ?>
              <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                      <div>
                        <h6 class="text-muted mb-2"><?= htmlspecialchars($stat['title']) ?></h6>
                        <h2 class="font-weight-bold text-dark mb-0"><?= htmlspecialchars($stat['value']) ?></h2>
                      </div>
                      <div class="icon-box rounded-circle <?= htmlspecialchars($colors['bg']) ?> p-3">
                        <i class="mdi <?= htmlspecialchars($stat['icon']) ?> <?= htmlspecialchars($colors['text']) ?> mdi-24px"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>

            <div class="row">
              <div class="col-lg-7 col-md-12 mb-4">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">
                    <h4 class="card-title mb-3">Ocupación Actual</h4>
                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                      <canvas id="ocupacionChart" width="220" height="220"></canvas>
                      <div class="ml-4 mt-3 mt-md-0">
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

              <div class="col-lg-5 col-md-12 mb-4">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">
                    <h4 class="card-title mb-3">Actividad Reciente</h4>
                    <div class="list-group list-group-flush">
                      <?php foreach ($panelData['activity'] as $row): ?>
                      <div class="list-group-item px-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h6 class="mb-1 text-dark"><?= $row['operador'] ?></h6>
                            <small class="text-muted"><?= $row['linea'] ?> • <?= $row['pensionado'] ?></small>
                          </div>
                          <span class="text-muted small"><?= $row['fecha'] ?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
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