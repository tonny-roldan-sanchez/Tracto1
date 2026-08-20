<?php
// Script SQL para crear la tabla de espacios apartados
$sqlCreateTable = <<<SQL
CREATE TABLE IF NOT EXISTS apartados_espacios (
    id_apartado INT AUTO_INCREMENT PRIMARY KEY,
    folio VARCHAR(20) NOT NULL UNIQUE,
    usuario_id INT NOT NULL,
    estado VARCHAR(50) NOT NULL DEFAULT 'en_espera',
    observaciones TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
SQL;
?>
