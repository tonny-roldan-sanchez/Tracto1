<?php
require_once __DIR__ . '/../config/database.php';

class HistorialModel
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM historial ORDER BY fecha DESC, id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM historial WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO historial (fecha, usuario, accion, detalles) VALUES (:fecha, :usuario, :accion, :detalles)');
        $stmt->execute([
            ':fecha' => $data['fecha'] ?? null,
            ':usuario' => $data['usuario'] ?? null,
            ':accion' => $data['accion'] ?? null,
            ':detalles' => $data['detalles'] ?? null,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE historial SET fecha = :fecha, usuario = :usuario, accion = :accion, detalles = :detalles WHERE id = :id');
        return $stmt->execute([
            ':fecha' => $data['fecha'] ?? null,
            ':usuario' => $data['usuario'] ?? null,
            ':accion' => $data['accion'] ?? null,
            ':detalles' => $data['detalles'] ?? null,
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM historial WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

?>
