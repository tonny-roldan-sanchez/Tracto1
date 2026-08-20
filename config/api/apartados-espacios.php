<?php
/**
 * API REST para Espacios Apartados
 * Ubicación: /api/apartados-espacios.php
 * 
 * Uso: Permite operaciones CRUD vía AJAX/Fetch
 * 
 * Ejemplos:
 * GET  /api/apartados-espacios.php?action=getAll
 * GET  /api/apartados-espacios.php?action=getById&id=1
 * POST /api/apartados-espacios.php { action: 'create', data: {...} }
 * POST /api/apartados-espacios.php { action: 'update', id: 1, data: {...} }
 * POST /api/apartados-espacios.php { action: 'delete', id: 1 }
 */

declare(strict_types=1);

// Incluir archivos necesarios
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/ApartarEspacio.php';

// Headers para API
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// Manejo de CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    $model = new ApartarEspacioModel();
    $action = $_GET['action'] ?? ($_POST['action'] ?? '');
    $response = ['success' => false, 'message' => 'Acción no especificada'];

    switch ($action) {
        case 'getAll':
            $espacios = $model->getAll();
            $response = [
                'success' => true,
                'data' => $espacios,
                'count' => count($espacios)
            ];
            break;

        case 'getById':
            $id = (int)($_GET['id'] ?? 0);
            if ($id === 0) {
                http_response_code(400);
                $response = ['success' => false, 'message' => 'ID requerido'];
                break;
            }
            
            $espacio = $model->getById($id);
            if ($espacio) {
                $response = [
                    'success' => true,
                    'data' => $espacio
                ];
            } else {
                http_response_code(404);
                $response = ['success' => false, 'message' => 'Espacio no encontrado'];
            }
            break;

        case 'create':
            $input = json_decode(file_get_contents('php://input'), true);
            $datos = $input['data'] ?? [];

            if (empty($datos['folio'])) {
                http_response_code(400);
                $response = ['success' => false, 'message' => 'Folio requerido'];
                break;
            }

            if ($model->create($datos)) {
                http_response_code(201);
                $response = ['success' => true, 'message' => 'Espacio creado'];
            } else {
                http_response_code(500);
                $response = ['success' => false, 'message' => 'Error al crear'];
            }
            break;

        case 'update':
            $input = json_decode(file_get_contents('php://input'), true);
            $id = (int)($input['id'] ?? 0);
            $datos = $input['data'] ?? [];

            if ($id === 0) {
                http_response_code(400);
                $response = ['success' => false, 'message' => 'ID requerido'];
                break;
            }

            if ($model->update($id, $datos)) {
                $response = ['success' => true, 'message' => 'Espacio actualizado'];
            } else {
                http_response_code(500);
                $response = ['success' => false, 'message' => 'Error al actualizar'];
            }
            break;

        case 'delete':
            $input = json_decode(file_get_contents('php://input'), true);
            $id = (int)($input['id'] ?? 0);

            if ($id === 0) {
                http_response_code(400);
                $response = ['success' => false, 'message' => 'ID requerido'];
                break;
            }

            if ($model->delete($id)) {
                $response = ['success' => true, 'message' => 'Espacio eliminado'];
            } else {
                http_response_code(500);
                $response = ['success' => false, 'message' => 'Error al eliminar'];
            }
            break;

        case 'getSiguienteFolio':
            $folio = $model->getSiguienteFolio();
            $response = ['success' => true, 'folio' => $folio];
            break;

        case 'searchByStatus':
            $estado = $_GET['status'] ?? '';
            if (empty($estado)) {
                http_response_code(400);
                $response = ['success' => false, 'message' => 'Estado requerido'];
                break;
            }

            $espacios = $model->getAll();
            $filtrados = array_filter($espacios, function($e) use ($estado) {
                return $e['estado'] === $estado;
            });

            $response = [
                'success' => true,
                'data' => array_values($filtrados),
                'count' => count($filtrados)
            ];
            break;

        default:
            http_response_code(400);
            $response = ['success' => false, 'message' => 'Acción no válida'];
    }

} catch (Exception $e) {
    http_response_code(500);
    logger('Error en API: ' . $e->getMessage());
    $response = [
        'success' => false,
        'message' => 'Error interno del servidor',
        'error' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
?>
