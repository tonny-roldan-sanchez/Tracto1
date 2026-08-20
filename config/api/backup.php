<?php
/**
 * API para gestionar respaldos de base de datos
 */

// Limpiar cualquier salida anterior
ob_start();

// Cargar las funciones globales primero
require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../controllers/BackupController.php';

// Validar que la solicitud sea GET o POST
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'descargar') {
    ob_end_clean();
    $backup = new BackupController();
    $filename = $_GET['filename'] ?? null;
    if ($filename) {
        $backup->descargarRespaldo($filename);
    } else {
        http_response_code(400);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'message' => 'No se especificó el archivo'], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    http_response_code(405);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => 'Método no permitido'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Configurar headers JSON para POST
header('Content-Type: application/json; charset=utf-8');

$backup = new BackupController();
$action = $_POST['action'] ?? null;

$response = [];

switch ($action) {
    case 'generar':
        $response = $backup->generarRespaldo();
        break;
        
    case 'importar':
        // Verificar que se ha subido un archivo
        if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            $response = [
                'success' => false,
                'message' => 'Error en la carga del archivo'
            ];
            break;
        }
        
        $archivo = $_FILES['archivo'];
        
        // Validar que sea un archivo SQL
        if (pathinfo($archivo['name'], PATHINFO_EXTENSION) !== 'sql') {
            $response = [
                'success' => false,
                'message' => 'Solo se permiten archivos .sql'
            ];
            break;
        }
        
        // Validar tamaño (máximo 100MB)
        if ($archivo['size'] > 104857600) {
            $response = [
                'success' => false,
                'message' => 'El archivo es demasiado grande (máximo 100MB)'
            ];
            break;
        }
        
        // Crear directorio de respaldos si no existe
        $backupDir = __DIR__ . '/../respaldos';
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }
        
        // Nombre seguro para el archivo
        $timestamp = date('Y-m-d_H-i-s');
        $filename = $backupDir . DIRECTORY_SEPARATOR . 'respaldo_importado_' . $timestamp . '.sql';
        
        // Mover el archivo subido
        if (move_uploaded_file($archivo['tmp_name'], $filename)) {
            $response = $backup->importarRespaldo($filename);
            
            // Limpiar el archivo temporal después de importar
            if ($response['success']) {
                unlink($filename);
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al guardar el archivo'
            ];
        }
        break;
        
    case 'descargar':
        $filename = $_POST['filename'] ?? null;
        if (!$filename) {
            $response = [
                'success' => false,
                'message' => 'No se especificó el archivo'
            ];
            break;
        }
        
        $backup->descargarRespaldo($filename);
        break;
        
    default:
        $response = [
            'success' => false,
            'message' => 'Acción no reconocida'
        ];
}

ob_end_clean();
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
