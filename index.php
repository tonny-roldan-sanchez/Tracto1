<?php
// Cargar configuración global primero
require_once 'functions.php';
require_once 'config/database.php';
require_once 'models/UsuarioModel.php';
require_once 'models/PanelModel.php';
require_once 'controllers/PanelController.php';

$menu=$_GET['menu']??'login';

// Cerrar completamente la sesión actual.
if ($menu === 'logout') {
    $_SESSION = [];
    session_destroy();
    redirect('index.php?menu=login');
}

// Iniciar sesión con el usuario nuevo, reemplazando cualquier sesión anterior.
if ($menu === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificador = trim((string) ($_POST['identificador'] ?? ''));
    $passwordLogin = (string) ($_POST['password'] ?? '');
    $usuarioModel = new Usuario((new Database())->getConnection());
    $usuario = $usuarioModel->obtenerPorEmail($identificador);

    if (!$usuario && method_exists($usuarioModel, 'obtenerPorNombre')) {
        $usuario = $usuarioModel->obtenerPorNombre($identificador);
    }

    if ($usuario && !empty($usuario['password']) && password_verify($passwordLogin, $usuario['password'])) {
        $_SESSION = [];
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = (int) $usuario['id'];
        $_SESSION['usuario'] = $usuario;
        redirect('index.php?menu=panel');
    }

    $errorLogin = 'Usuario o contraseña incorrectos.';
}

if ($menu === 'registro' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $errores = [];
    $usuarioRepetido = false;

    if ($nombre === '') {
        $errores[] = 'El nombre de usuario es obligatorio.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingresa un correo electrónico válido.';
    }
    if (strlen($password) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if (empty($_POST['terminos'])) {
        $errores[] = 'Debes aceptar los términos y condiciones.';
    }

    if (!$errores) {
        try {
            $usuarioModel = new Usuario((new Database())->getConnection());

            if ($usuarioModel->obtenerPorNombre($nombre)) {
                $usuarioRepetido = true;
                $errores[] = 'Usuario repetido, elige otro nombre de usuario.';
            } elseif ($usuarioModel->obtenerPorEmail($email)) {
                $errores[] = 'Ya existe una cuenta con ese correo electrónico.';
            } else {
                $usuarioId = $usuarioModel->registrar($nombre, $email, $password);
                $_SESSION = [];
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $usuarioId;
                $_SESSION['usuario'] = $usuarioModel->obtenerPorId($usuarioId);
                redirect('index.php?menu=perfil');
            }
        } catch (Throwable $e) {
            logger('Error durante el registro: ' . $e->getMessage());
            $errores[] = 'No fue posible crear la cuenta. Inténtalo nuevamente.';
        }
    }
}

if ($menu === 'perfil' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario_id'])) {
        redirect('index.php?menu=login');
    }

    verify_csrf_token();

    $archivo = $_FILES['foto'] ?? null;
    if (is_array($archivo) && ($archivo['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        $errores = [];
        $tiposPermitidos = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];

        if (($archivo['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $errores[] = 'No fue posible cargar la imagen.';
        } elseif (($archivo['size'] ?? 0) > 5 * 1024 * 1024) {
            $errores[] = 'La imagen no debe superar los 5 MB.';
        } else {
            $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($archivo['tmp_name']);
            if (!isset($tiposPermitidos[$tipo])) {
                $errores[] = 'El archivo debe ser una imagen JPG, PNG, GIF o WEBP.';
            }
        }

        if (!$errores) {
            $directorio = APP_ROOT . '/public/assets/uploads';
            if (!is_dir($directorio)) {
                mkdir($directorio, 0755, true);
            }

            $nombreArchivo = 'perfil_' . (int) $_SESSION['usuario_id'] . '_' . bin2hex(random_bytes(8)) . '.' . $tiposPermitidos[$tipo];
            $rutaArchivo = $directorio . '/' . $nombreArchivo;

            if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                $foto = 'public/assets/uploads/' . $nombreArchivo;
                $usuarioModel = new Usuario((new Database())->getConnection());
                if ($usuarioModel->actualizarFoto((int) $_SESSION['usuario_id'], $foto)) {
                    $_SESSION['usuario']['foto'] = $foto;
                    $_SESSION['mensaje_perfil'] = 'Foto de perfil actualizada correctamente.';
                } else {
                    $errores[] = 'No fue posible actualizar tu perfil.';
                }
            } else {
                $errores[] = 'No fue posible guardar la imagen.';
            }
        }

        if ($errores) {
            $_SESSION['error_perfil'] = implode(' ', $errores);
        }
    }

    redirect('index.php?menu=perfil');
}

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
    redirect('index.php?menu=panel');
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
    if (!isset($_SESSION['usuario_id'])) {
        redirect('index.php?menu=login');
    }

    $usuarioModel = new Usuario((new Database())->getConnection());
    $usuarioActual = $usuarioModel->obtenerPorId((int) $_SESSION['usuario_id']);

    if (!$usuarioActual) {
        $_SESSION = [];
        session_destroy();
        redirect('index.php?menu=login');
    }

    $_SESSION['usuario'] = $usuarioActual;

    include 'views/PerfilView.php';

}


else if ($menu == 'password') {

    include 'views/CambiarContraseñaView.php';

}


else {
    include 'views/Error404View.php';
}


//este es el index 
?>