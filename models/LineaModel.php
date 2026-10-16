<?php
class LineaModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function listar(string $busqueda = ''): array
    {
        if ($busqueda === '') {
            $stmt = $this->db->query('SELECT id_linea, nom_linea, (SELECT COUNT(*) FROM camiones c WHERE c.id_linea = linea.id_linea) AS total_camiones FROM linea ORDER BY nom_linea');
        } else {
            $stmt = $this->db->prepare('SELECT id_linea, nom_linea, (SELECT COUNT(*) FROM camiones c WHERE c.id_linea = linea.id_linea) AS total_camiones FROM linea WHERE LOWER(TRIM(nom_linea)) = LOWER(TRIM(?)) ORDER BY nom_linea');
            $stmt->execute([$busqueda]);
        }

        return $stmt->fetchAll();
    }

    public function buscarPorNombre(string $nombre, int $idExcluir = 0): ?array
    {
        $sql = 'SELECT id_linea, nom_linea FROM linea WHERE LOWER(TRIM(nom_linea)) = LOWER(TRIM(?))';
        $parametros = [$nombre];

        if ($idExcluir > 0) {
            $sql .= ' AND id_linea <> ?';
            $parametros[] = $idExcluir;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        $linea = $stmt->fetch();

        return $linea ?: null;
    }

    public function crear(string $nombre): bool
    {
        $stmt = $this->db->prepare('INSERT INTO linea (nom_linea) VALUES (?)');
        return $stmt->execute([$nombre]);
    }

    public function actualizar(int $id, string $nombre): bool
    {
        $stmt = $this->db->prepare('UPDATE linea SET nom_linea = ? WHERE id_linea = ?');
        return $stmt->execute([$nombre, $id]);
    }

    public function contarCamiones(int $idLinea): int
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM camiones WHERE id_linea = ?');
        $stmt->execute([$idLinea]);

        return (int) $stmt->fetchColumn();
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM linea WHERE id_linea = ?');
        return $stmt->execute([$id]);
    }

    public function obtener(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT id_linea, nom_linea, (SELECT COUNT(*) FROM camiones c WHERE c.id_linea = linea.id_linea) AS total_camiones FROM linea WHERE id_linea = ?');
        $stmt->execute([$id]);
        $linea = $stmt->fetch();

        return $linea ?: null;
    }

    public function listarCamionesPensionados(int $idLinea): array
    {
        $sql = 'SELECT DISTINCT
                    c.id_camion,
                    c.placa,
                    c.modelo,
                    u.nombre AS pensionado,
                    p.estado_cuenta,
                    p.proximo_pago
                FROM camiones c
                INNER JOIN pensionados p ON p.id_usuario = c.id_usuario
                INNER JOIN usuarios u ON u.id = c.id_usuario
                WHERE c.id_linea = ?
                ORDER BY c.placa';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idLinea]);

        return $stmt->fetchAll();
    }
}