<?php
// Cargar configuración global primero
require_once 'functions.php';
require_once 'models/PanelModel.php';
require_once 'controllers/PanelController.php';

$menu=$_GET['menu']??'login';

if ($menu=='login'){
    include 'views/LoginView.php';
}
else if ($menu=='registro'){
    include 'views/RegistroLoginView.php';
}
else if ($menu=='panel'){
    $panelModel = new PanelModel();
    $panelController = new PanelController($panelModel);
    $panelData = $panelController->getDashboardData();
    include 'views/PanelView.php';
}
else if ($menu=='micamion'){
    include 'views/MiCamionView.php';

}
else if ($menu=='miespacio'){
    include 'views/MiEspacioview.php';
}
else if ($menu=='apartarespacio'){
    // Cargar el modelo y controlador

    
    include 'views/ApartarEspacioview.php';
}


else if ($menu=='pagos'){
    include 'views/PagosView.php';
}

else if ($menu=='respaldo'){
    require_once 'config/database.php';
    require_once 'controllers/BackupController.php';

    include 'views/BackupView.php';
}

else if ($menu=='historial'){
    require_once 'config/database.php';
    require_once 'models/Historial.php';
    require_once 'controllers/HistorialController.php';

    $historialModel = new HistorialModel();
    $historialController = new HistorialController($historialModel);
    $historialController->run();

    $historial = $historialController->getHistorial();
    $message = $historialController->getMessage();
    $type = $historialController->getType();
    $registroSeleccionado = $historialController->getRegistroSeleccionado();
    $ultimoId = $historialController->getUltimoId();

    include 'views/Historialview.php';
}

else if ($menu=='accesos'){
    include 'views/Accesosview.php';
}

else if ($menu == 'perfil') {

    include 'views/PerfilView.php';

}


else if ($menu == 'password') {

    include 'views/CambiarContraseñaView.php';

}


else if ($menu == 'password') {

    include 'views/CambiarContraseñaView.php';

}


else {
    include 'views/Error404View.php';
}


//este es el index 
?>