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
                        <h3 class="page-title">Apartar Espacio</h3>
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

                    <div class="card">
                        <div class="card-body">
                            <h2 class="mb-4" style="text-align: center; color: #003d7a; font-weight: bold;">Apartar Espacio</h2>

                            <!-- Tabs para seleccionar terreno -->
                            <div class="btn-group mb-4" role="group" style="display: flex; gap: 0; width: 100%; border-bottom: 1px solid #ddd;">
                                <button type="button" class="terreno-tab active" data-terreno="1" style="flex: 1; padding: 12px; background-color: #003d7a; color: white; border: none; cursor: pointer; font-weight: bold;">
                                    Terreno 1 - Pensionados
                                </button>
                                <button type="button" class="terreno-tab" data-terreno="2" style="flex: 1; padding: 12px; background-color: #e0e0e0; color: #333; border: none; cursor: pointer; font-weight: bold;">
                                    Terreno 2 - De paso / Doble remolque
                                </button>
                            </div>

                            <!-- Mapa de Espacios -->
                            <div class="mt-4">
                                <h4 style="color: #003d7a; margin-bottom: 20px;">Mapa De Espacios</h4>
                                
                                <!-- Contenedor del mapa de espacios -->
                                <div id="espacios-container" style="background-color: #e8e8e8; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                                    <div style="display: grid; grid-template-columns: repeat(11, 1fr); gap: 8px; max-width: 600px; margin: 0 auto;">
                                        <!-- Los espacios se cargarán dinámicamente aquí -->
                                    </div>
                                </div>

                                <!-- Leyenda -->
                                <div style="display: flex; justify-content: center; gap: 30px; margin: 20px 0; align-items: center;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 20px; height: 20px; background-color: #28a745; border-radius: 50%; border: 2px solid #20c997;"></div>
                                        <span style="font-weight: bold; color: #333;">Libre</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 20px; height: 20px; background-color: #dc3545; border-radius: 50%; border: 2px solid #c82333;"></div>
                                        <span style="font-weight: bold; color: #333;">Ocupado</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de Selección -->
                            <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <p style="margin: 0; font-weight: bold; color: #666;">Seleccione Su Espacio:</p>
                                </div>
                                <div style="background-color: white; padding: 10px 20px; border-radius: 3px; min-width: 150px; text-align: center;">
                                    <p style="margin: 0; color: #333;">Espacio Seleccionado: <strong id="espacioSeleccionado">-</strong></p>
                                </div>
                            </div>

                            <!-- Botón Apartar Espacio -->
                            <form id="formApartar" method="POST" style="text-align: center;">
                                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                <input type="hidden" name="accion" value="apartar">
                                <input type="hidden" name="terreno_id" id="terreno_id" value="1">
                                <input type="hidden" name="numero_espacio" id="numero_espacio" value="">
                                
                                <button type="submit" class="btn" style="background-color: #ff7043; color: white; padding: 12px 40px; font-size: 16px; font-weight: bold; border: none; border-radius: 5px; cursor: pointer;">
                                    Apartar Espacio
                                </button>
                            </form>
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

    <script src="public/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="public/assets/js/off-canvas.js"></script>
    <script src="public/assets/js/hoverable-collapse.js"></script>
    <script src="public/assets/js/misc.js"></script>
    <script src="public/assets/js/settings.js"></script>
    <script src="public/assets/js/todolist.js"></script>
    <script src="public/assets/js/dashboard.js"></script>

    <script>
        // Datos de espacios por terreno
        const espaciosPorTerreno = {
            1: {
                nombre: 'Terreno 1 - Pensionados',
                total: 21,
                ocupados: [2, 5, 8, 12, 18] // Espacios ocupados
            },
            2: {
                nombre: 'Terreno 2 - De paso / Doble remolque',
                total: 30,
                ocupados: [3, 7, 10, 15, 22, 25]
            }
        };

        let terrenoActual = 1;
        let espacioSeleccionado = null;

        // Inicializar
        document.addEventListener('DOMContentLoaded', function() {
            renderizarEspacios();
            
            // Event listeners para tabs
            document.querySelectorAll('.terreno-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    cambiarTerreno(this.dataset.terreno);
                });
            });

            // Validar formulario
            document.getElementById('formApartar').addEventListener('submit', function(e) {
                if (!espacioSeleccionado) {
                    e.preventDefault();
                    alert('Por favor, selecciona un espacio primero');
                }
            });
        });

        function cambiarTerreno(terreno) {
            terrenoActual = parseInt(terreno);
            espacioSeleccionado = null;
            document.getElementById('espacioSeleccionado').textContent = '-';
            document.getElementById('terreno_id').value = terrenoActual;
            
            // Actualizar tabs
            document.querySelectorAll('.terreno-tab').forEach(tab => {
                tab.classList.remove('active');
                if (tab.dataset.terreno === terreno) {
                    tab.classList.add('active');
                    tab.style.backgroundColor = '#003d7a';
                    tab.style.color = 'white';
                } else {
                    tab.style.backgroundColor = '#e0e0e0';
                    tab.style.color = '#333';
                }
            });
            
            renderizarEspacios();
        }

        function renderizarEspacios() {
            const terreno = espaciosPorTerreno[terrenoActual];
            const grid = document.querySelector('#espacios-container div');
            grid.innerHTML = '';
            
            for (let i = 1; i <= terreno.total; i++) {
                const espacio = document.createElement('button');
                espacio.type = 'button';
                espacio.className = 'espacio-btn';
                espacio.textContent = i;
                
                const ocupado = terreno.ocupados.includes(i);
                const seleccionado = espacioSeleccionado === i;
                
                if (ocupado) {
                    espacio.style.cssText = `
                        background-color: #dc3545;
                        color: white;
                        border: 2px solid #c82333;
                        padding: 10px;
                        border-radius: 5px;
                        cursor: not-allowed;
                        font-weight: bold;
                        opacity: 0.7;
                    `;
                    espacio.disabled = true;
                } else {
                    espacio.style.cssText = `
                        background-color: ${seleccionado ? '#003d7a' : '#28a745'};
                        color: white;
                        border: 2px solid ${seleccionado ? '#002050' : '#20c997'};
                        padding: 10px;
                        border-radius: 5px;
                        cursor: pointer;
                        font-weight: bold;
                        transition: all 0.3s ease;
                    `;
                    
                    espacio.addEventListener('click', () => seleccionarEspacio(i));
                    espacio.addEventListener('mouseover', function() {
                        if (!ocupado && espacioSeleccionado !== i) {
                            this.style.backgroundColor = '#20c997';
                            this.style.transform = 'scale(1.1)';
                        }
                    });
                    espacio.addEventListener('mouseout', function() {
                        if (!ocupado && espacioSeleccionado !== i) {
                            this.style.backgroundColor = '#28a745';
                            this.style.transform = 'scale(1)';
                        }
                    });
                }
                
                grid.appendChild(espacio);
            }
        }

        function seleccionarEspacio(numero) {
            const terreno = espaciosPorTerreno[terrenoActual];
            
            // Verificar si está ocupado
            if (terreno.ocupados.includes(numero)) {
                alert('Este espacio está ocupado. Por favor, selecciona otro.');
                return;
            }
            
            espacioSeleccionado = numero;
            document.getElementById('numero_espacio').value = numero;
            document.getElementById('espacioSeleccionado').textContent = numero;
            
            renderizarEspacios();
        }
    </script>
</body>
</html>