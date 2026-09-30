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

    public function registrar(string $nombre, string $email, string $password): int
    {
        $this->asegurarColumnaPassword();

        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            trim($nombre),
            trim($email),
            password_hash($password, PASSWORD_DEFAULT),
        ]);

        return (int) $this->db->lastInsertId();
    }

    private function asegurarColumnaPassword(): void
    {
        $columnas = $this->db->query("SHOW COLUMNS FROM usuarios LIKE 'password'")->fetch();

        if (!$columnas) {
            $this->db->exec("ALTER TABLE usuarios ADD COLUMN password VARCHAR(255) NULL AFTER email");
        }
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

    public function obtenerPorEmail(string $email): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([trim($email)]);
        return $stmt->fetch();
    }

    public function obtenerPorNombre(string $nombre): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $stmt->execute([trim($nombre)]);
        return $stmt->fetch();
    }

    public function actualizarFoto(int $id, string $foto): bool
    {
        $columna = $this->db->query("SHOW COLUMNS FROM usuarios LIKE 'foto'")->fetch();
        if (!$columna) {
            $this->db->exec("ALTER TABLE usuarios ADD COLUMN foto VARCHAR(255) NULL AFTER email");
        }

        $stmt = $this->db->prepare("UPDATE usuarios SET foto = ? WHERE id = ?");
        return $stmt->execute([$foto, $id]);
    }

    public function actualizar(int $id, string $nombre, string $email): bool
    {
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([trim($nombre), trim($email), $id]);
    }
}
