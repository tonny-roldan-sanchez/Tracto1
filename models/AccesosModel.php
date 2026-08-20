<?php
class AccesosModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    /**
     * Obtiene todos los accesos del usuario
     */
    public function obtenerPorUsuario($id_usuario) {
        $sql = "SELECT a.*, c.placa, c.marca, c.modelo 
                FROM accesos a
                JOIN camiones c ON a.id_camion = c.id_camion
                WHERE a.id_usuario = ?
                ORDER BY a.fecha DESC, a.hora DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene accesos de un camión específico
     */
    public function obtenerPorCamion($id_camion) {
        $sql = "SELECT a.*, c.placa, c.marca 
                FROM accesos a
                JOIN camiones c ON a.id_camion = c.id_camion
                WHERE a.id_camion = ?
                ORDER BY a.fecha DESC, a.hora DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_camion]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un acceso específico
     */
    public function obtenerPorId($id_acceso) {
        $sql = "SELECT a.*, c.placa, c.marca, c.modelo 
                FROM accesos a
                JOIN camiones c ON a.id_camion = c.id_camion
                WHERE a.id_acceso = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_acceso]);
        return $stmt->fetch();
    }

    /**
     * Registra una entrada o salida
     */
    public function guardar($id_usuario, $id_camion, $tipo, $observaciones = null) {
        $sql = "INSERT INTO accesos (id_usuario, id_camion, tipo, fecha, hora, observaciones)
                VALUES (?, ?, ?, CURDATE(), CURTIME(), ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_usuario, $id_camion, $tipo, $observaciones]);
    }

    /**
     * Obtiene el último acceso de un camión
     */
    public function obtenerUltimo($id_camion) {
        $sql = "SELECT * FROM accesos 
                WHERE id_camion = ?
                ORDER BY fecha DESC, hora DESC
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_camion]);
        return $stmt->fetch();
    }

    /**
     * Obtiene accesos del día
     */
    public function obtenerDelDia($id_usuario) {
        $sql = "SELECT a.*, c.placa, c.marca 
                FROM accesos a
                JOIN camiones c ON a.id_camion = c.id_camion
                WHERE a.id_usuario = ? AND a.fecha = CURDATE()
                ORDER BY a.hora DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene estadísticas de accesos
     */
    public function obtenerEstadisticas($id_usuario) {
        $sql = "SELECT 
                COUNT(*) as total_accesos,
                SUM(CASE WHEN tipo = 'entrada' THEN 1 ELSE 0 END) as entradas,
                SUM(CASE WHEN tipo = 'salida' THEN 1 ELSE 0 END) as salidas
                FROM accesos
                WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetch();
    }
}
?>
