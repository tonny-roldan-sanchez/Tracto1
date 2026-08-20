<?php
class MiEspacioModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    /**
     * Obtiene todos los apartados del usuario
     */
    public function obtenerPorUsuario($id_usuario) {
        $sql = "SELECT a.*, e.numero_espacio, e.terreno, e.precio_mensual, c.placa, c.marca, c.modelo 
                FROM apartados a
                JOIN espacios e ON a.id_espacio = e.id_espacio
                LEFT JOIN camiones c ON a.id_camion = c.id_camion
                WHERE a.id_usuario = ?
                ORDER BY a.fecha_creacion DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un apartado específico
     */
    public function obtenerPorId($id_apartado) {
        $sql = "SELECT a.*, e.numero_espacio, e.terreno, e.precio_mensual, c.placa, c.marca, c.modelo 
                FROM apartados a
                JOIN espacios e ON a.id_espacio = e.id_espacio
                LEFT JOIN camiones c ON a.id_camion = c.id_camion
                WHERE a.id_apartado = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_apartado]);
        return $stmt->fetch();
    }

    /**
     * Obtiene espacios disponibles
     */
    public function obtenerEspaciosDisponibles() {
        $sql = "SELECT * FROM espacios WHERE estado = 'disponible' ORDER BY terreno, numero_espacio";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Crea una nueva reserva
     */
    public function guardar($id_usuario, $id_espacio, $id_camion, $fecha_inicio, $fecha_fin, $precio_total) {
        $sql = "INSERT INTO apartados (id_usuario, id_espacio, id_camion, fecha_inicio, fecha_fin, estado, precio_total)
                VALUES (?, ?, ?, ?, ?, 'activo', ?)";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$id_usuario, $id_espacio, $id_camion, $fecha_inicio, $fecha_fin, $precio_total])) {
            // Actualizar estado del espacio a ocupado
            $this->cambiarEstadoEspacio($id_espacio, 'ocupado');
            return true;
        }
        return false;
    }

    /**
     * Actualiza una reserva
     */
    public function actualizar($id_apartado, $fecha_fin, $motivo) {
        $sql = "UPDATE apartados SET fecha_fin = ?, motivo = ? WHERE id_apartado = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$fecha_fin, $motivo, $id_apartado]);
    }

    /**
     * Finaliza una reserva
     */
    public function finalizar($id_apartado) {
        $apartado = $this->obtenerPorId($id_apartado);
        if ($apartado) {
            // Liberar el espacio
            $this->cambiarEstadoEspacio($apartado['id_espacio'], 'disponible');
            // Marcar apartado como finalizado
            $sql = "UPDATE apartados SET estado = 'finalizado' WHERE id_apartado = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id_apartado]);
        }
        return false;
    }

    /**
     * Cambia el estado del espacio
     */
    private function cambiarEstadoEspacio($id_espacio, $estado) {
        $sql = "UPDATE espacios SET estado = ? WHERE id_espacio = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$estado, $id_espacio]);
    }

    /**
     * Obtiene estadísticas de espacios
     */
    public function obtenerEstadisticas() {
        $sql = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN estado = 'disponible' THEN 1 ELSE 0 END) as disponibles,
                SUM(CASE WHEN estado = 'ocupado' THEN 1 ELSE 0 END) as ocupados,
                SUM(CASE WHEN estado = 'reservado' THEN 1 ELSE 0 END) as reservados
                FROM espacios";
        return $this->db->query($sql)->fetch();
    }
}
?>
