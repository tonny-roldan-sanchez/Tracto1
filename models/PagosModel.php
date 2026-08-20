<?php
class PagosModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    /**
     * Obtiene todos los pagos del usuario
     */
    public function obtenerPorUsuario($id_usuario) {
        $sql = "SELECT p.*, a.folio, e.numero_espacio, e.terreno 
                FROM pagos p
                LEFT JOIN apartados a ON p.id_apartado = a.id_apartado
                LEFT JOIN espacios e ON a.id_espacio = e.id_espacio
                WHERE p.id_usuario = ?
                ORDER BY p.fecha_creacion DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un pago específico
     */
    public function obtenerPorId($id_pago) {
        $sql = "SELECT p.*, a.folio, e.numero_espacio, e.terreno 
                FROM pagos p
                LEFT JOIN apartados a ON p.id_apartado = a.id_apartado
                LEFT JOIN espacios e ON a.id_espacio = e.id_espacio
                WHERE p.id_pago = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_pago]);
        return $stmt->fetch();
    }

    /**
     * Obtiene pagos pendientes del usuario
     */
    public function obtenerPendientes($id_usuario) {
        $sql = "SELECT p.*, a.folio, e.numero_espacio 
                FROM pagos p
                LEFT JOIN apartados a ON p.id_apartado = a.id_apartado
                LEFT JOIN espacios e ON a.id_espacio = e.id_espacio
                WHERE p.id_usuario = ? AND p.estado = 'pendiente'
                ORDER BY p.fecha_vencimiento ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    /**
     * Registra un nuevo pago
     */
    public function guardar($id_usuario, $id_apartado, $monto, $concepto, $metodo_pago, $fecha_vencimiento = null) {
        $sql = "INSERT INTO pagos (id_usuario, id_apartado, monto, concepto, metodo_pago, estado, fecha_vencimiento)
                VALUES (?, ?, ?, ?, ?, 'pendiente', ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_usuario, $id_apartado, $monto, $concepto, $metodo_pago, $fecha_vencimiento]);
    }

    /**
     * Marca un pago como pagado
     */
    public function marcarPagado($id_pago, $metodo_pago, $referencia = null) {
        $sql = "UPDATE pagos SET estado = 'pagado', fecha_pago = CURDATE(), metodo_pago = ?, referencia = ? 
                WHERE id_pago = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$metodo_pago, $referencia, $id_pago]);
    }

    /**
     * Rechaza un pago
     */
    public function rechazar($id_pago) {
        $sql = "UPDATE pagos SET estado = 'rechazado' WHERE id_pago = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_pago]);
    }

    /**
     * Obtiene el resumen de pagos por estado
     */
    public function obtenerResumen($id_usuario) {
        $sql = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN estado = 'pagado' THEN monto ELSE 0 END) as pagado,
                SUM(CASE WHEN estado = 'pendiente' THEN monto ELSE 0 END) as pendiente,
                SUM(CASE WHEN estado = 'rechazado' THEN monto ELSE 0 END) as rechazado
                FROM pagos
                WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetch();
    }
}
?>
