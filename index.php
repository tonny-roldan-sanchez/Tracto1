<?php
// Cargar configuración global primero
require_once 'functions.php';

$menu=$_GET['menu']??'login';

if ($menu=='login'){
    include 'views/LoginView.php';
}
else if ($menu=='registro'){
    include 'views/RegistroLoginView.php';
}
else if ($menu=='panel'){
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
    require_once 'config/database.php';
    require_once 'models/ApartarEspacio.php';
    require_once 'controllers/ApartarEspacio.php';
    
    include 'views/ApartarEspacioview.php';
}


else if ($menu=='pagos'){
    include 'views/PagosView.php';
}

else if ($menu=='historial'){
    // Cargar modelo y controlador del historial para habilitar CRUD
    require_once 'config/database.php';
    require_once 'models/Historial.php';
    require_once 'controllers/Historial.php';

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