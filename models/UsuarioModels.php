<?php
class Usuario
{
    private PDO $db;

    public function __construct(PDO $conexion)
    {
        $this->db = $conexion;
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function guardar(string $nombre, string $email): bool
    {
        $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([trim($nombre), trim($email)]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function actualizar(int $id, string $nombre, string $email): bool
    {
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([trim($nombre), trim($email), $id]);
    }
}
