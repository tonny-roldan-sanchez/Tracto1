<?php
declare(strict_types=1);

class ApartarEspacioModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Obtiene todos los espacios apartados
     */
    public function getAll(): array
    {
        try {
            $query = "SELECT * FROM apartados_espacios ORDER BY fecha_creacion DESC";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            logger('Error al obtener espacios apartados: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene un espacio apartado por ID
     */
    public function getById(int $id): ?array
    {
        try {
            $query = "SELECT * FROM apartados_espacios WHERE id_apartado = ?";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch() ?: null;
        } catch (PDOException $e) {
            logger('Error al obtener espacio apartado: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crea un nuevo espacio apartado
     */
    public function create(array $data): bool
    {
        try {
            $query = "INSERT INTO apartados_espacios 
                      (folio, usuario_id, estado, observaciones, fecha_creacion) 
                      VALUES (?, ?, ?, ?, NOW())";
            
            $stmt = $this->db->getConnection()->prepare($query);
            return $stmt->execute([
                $data['folio'] ?? '',
                $data['usuario_id'] ?? 1,
                $data['estado'] ?? 'en_espera',
                $data['observaciones'] ?? ''
            ]);
        } catch (PDOException $e) {
            logger('Error al crear espacio apartado: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza un espacio apartado
     */
    public function update(int $id, array $data): bool
    {
        try {
            $query = "UPDATE apartados_espacios 
                      SET folio = ?, estado = ?, observaciones = ? 
                      WHERE id_apartado = ?";
            
            $stmt = $this->db->getConnection()->prepare($query);
            return $stmt->execute([
                $data['folio'] ?? '',
                $data['estado'] ?? 'en_espera',
                $data['observaciones'] ?? '',
                $id
            ]);
        } catch (PDOException $e) {
            logger('Error al actualizar espacio apartado: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un espacio apartado
     */
    public function delete(int $id): bool
    {
        try {
            $query = "DELETE FROM apartados_espacios WHERE id_apartado = ?";
            $stmt = $this->db->getConnection()->prepare($query);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            logger('Error al eliminar espacio apartado: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene el siguiente folio disponible
     */
    public function getSiguienteFolio(): string
    {
        try {
            $query = "SELECT COUNT(*) as total FROM apartados_espacios";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetch();
            $numero = ($resultado['total'] ?? 0) + 1;
            return '#' . str_pad((string)$numero, 4, '0', STR_PAD_LEFT);
        } catch (PDOException $e) {
            logger('Error al generar folio: ' . $e->getMessage());
            return '#0001';
        }
    }
}
