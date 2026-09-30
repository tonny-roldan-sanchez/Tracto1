-- Base de datos de Tracto Pension.
-- Ejecutar en una instalacion nueva de MySQL.

CREATE DATABASE IF NOT EXISTS tracto_pension
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tracto_pension;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    foto VARCHAR(255) DEFAULT NULL,
    password VARCHAR(255) DEFAULT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS camiones (
    id_camion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    placa VARCHAR(20) NOT NULL UNIQUE,
    marca VARCHAR(100),
    modelo VARCHAR(100),
    color VARCHAR(50),
    anio INT,
    fecha_entrada DATE,
    hora_entrada TIME,
    estado VARCHAR(50) DEFAULT 'en_pension',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS espacios (
    id_espacio INT AUTO_INCREMENT PRIMARY KEY,
    numero_espacio INT NOT NULL UNIQUE,
    terreno VARCHAR(50) NOT NULL,
    estado VARCHAR(50) DEFAULT 'disponible',
    ubicacion VARCHAR(200),
    precio_mensual DECIMAL(10,2),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS apartados (
    id_apartado INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_espacio INT NOT NULL,
    id_camion INT DEFAULT NULL,
    folio VARCHAR(20) UNIQUE,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE DEFAULT NULL,
    estado VARCHAR(50) DEFAULT 'activo',
    motivo VARCHAR(200) DEFAULT NULL,
    precio_total DECIMAL(10,2) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_espacio) REFERENCES espacios(id_espacio)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_camion) REFERENCES camiones(id_camion)
        ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_apartado INT DEFAULT NULL,
    monto DECIMAL(10,2) NOT NULL,
    concepto VARCHAR(100),
    metodo_pago VARCHAR(50),
    estado VARCHAR(50) DEFAULT 'pendiente',
    fecha_pago DATE DEFAULT NULL,
    fecha_vencimiento DATE DEFAULT NULL,
    referencia VARCHAR(100) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_apartado) REFERENCES apartados(id_apartado)
        ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS accesos (
    id_acceso INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_camion INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    observaciones VARCHAR(200) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_camion) REFERENCES camiones(id_camion)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS historial (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    accion VARCHAR(100) NOT NULL,
    detalles TEXT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS apartados_espacios (
    id_apartado INT AUTO_INCREMENT PRIMARY KEY,
    folio VARCHAR(20) NOT NULL UNIQUE,
    usuario_id INT NOT NULL,
    estado VARCHAR(50) NOT NULL DEFAULT 'en_espera',
    observaciones TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;