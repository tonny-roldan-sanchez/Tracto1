<?php
class MiCamionModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    /**
     * Obtiene todos los camiones del usuario
     */
    public function obtenerPorUsuario($id_usuario) {
        $sql = "SELECT * FROM camiones WHERE id_usuario = ? ORDER BY fecha_creacion DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un camión específico
     */
    public function obtenerPorId($id_camion) {
        $sql = "SELECT * FROM camiones WHERE id_camion = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_camion]);
        return $stmt->fetch();
    }

    /**
     * Registra un nuevo camión
     */
    public function guardar($id_usuario, $placa, $marca, $modelo, $color, $anio) {
        $sql = "INSERT INTO camiones (id_usuario, placa, marca, modelo, color, anio, fecha_entrada, hora_entrada, estado) 
                VALUES (?, ?, ?, ?, ?, ?, CURDATE(), CURTIME(), 'en_pension')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_usuario, strtoupper($placa), $marca, $modelo, $color, $anio]);
    }

    /**
     * Actualiza datos del camión
     */
    public function actualizar($id_camion, $marca, $modelo, $color, $anio) {
        $sql = "UPDATE camiones SET marca = ?, modelo = ?, color = ?, anio = ? WHERE id_camion = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$marca, $modelo, $color, $anio, $id_camion]);
    }

    /**
     * Cambia estado del camión
     */
    public function cambiarEstado($id_camion, $estado) {
        $sql = "UPDATE camiones SET estado = ? WHERE id_camion = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$estado, $id_camion]);
    }

    /**
     * Elimina un camión
     */
    public function eliminar($id_camion) {
        $sql = "DELETE FROM camiones WHERE id_camion = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_camion]);
    }

    /**
     * Obtiene el apartado activo del camión
     */
    public function obtenerApartadoActivo($id_camion) {
        $sql = "SELECT a.*, e.numero_espacio, e.terreno FROM apartados a 
                JOIN espacios e ON a.id_espacio = e.id_espacio
                WHERE a.id_camion = ? AND a.estado = 'activo' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_camion]);
        return $stmt->fetch();
    }
}
?>
