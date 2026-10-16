
CREATE TABLE avisos (
                id_aviso INT AUTO_INCREMENT NOT NULL,
                mensaje VARCHAR(255) NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id_aviso)
);


CREATE TABLE terrenos (
                id_terreno INT AUTO_INCREMENT NOT NULL,
                nombre VARCHAR(80) NOT NULL,
                descripcion VARCHAR(200),
                PRIMARY KEY (id_terreno)
);


CREATE TABLE espacios (
                id_espacio INT AUTO_INCREMENT NOT NULL,
                terrenos_id_terreno INT NOT NULL,
                id_terreno INT NOT NULL,
                numero INT NOT NULL,
                estado VARCHAR(20) DEFAULT libre NOT NULL,
                PRIMARY KEY (id_espacio, terrenos_id_terreno)
);

ALTER TABLE espacios MODIFY COLUMN estado VARCHAR(20) COMMENT 'libre,ocupado,reservado,mantenimiento';


CREATE TABLE linea (
                id_linea INT AUTO_INCREMENT NOT NULL,
                nom_linea VARCHAR(80) NOT NULL,
                PRIMARY KEY (id_linea)
);


CREATE TABLE roles (
                id_rol INT AUTO_INCREMENT NOT NULL,
                rol VARCHAR(40) NOT NULL,
                PRIMARY KEY (id_rol)
);


CREATE TABLE usuarios (
                id_usuario INT AUTO_INCREMENT NOT NULL,
                roles_id_rol INT NOT NULL,
                nombre VARCHAR(80) NOT NULL,
                ap VARCHAR(80) NOT NULL,
                am VARCHAR(80),
                alias VARCHAR(60),
                usuario VARCHAR(50) NOT NULL,
                contrasena VARCHAR(255) NOT NULL,
                telefono VARCHAR(20),
                correo VARCHAR(120) NOT NULL,
                id_rol INT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id_usuario, roles_id_rol)
);


CREATE TABLE pensionados (
                id_pensionado INT AUTO_INCREMENT NOT NULL,
                usuarios_id_usuario INT NOT NULL,
                roles_id_rol INT NOT NULL,
                espacios_id_espacio INT NOT NULL,
                terrenos_id_terreno INT NOT NULL,
                id_usuario INT NOT NULL,
                id_espacio INT NOT NULL,
                ultimo_pago DATE,
                proximo_pago DATE,
                estado_cuenta VARCHAR(15) DEFAULT al_corriente NOT NULL,
                PRIMARY KEY (id_pensionado, usuarios_id_usuario, roles_id_rol, espacios_id_espacio, terrenos_id_terreno)
);

ALTER TABLE pensionados MODIFY COLUMN estado_cuenta VARCHAR(15) COMMENT 'al_corriente,pendiente,vencido';


CREATE TABLE inventario (
                id_inventario INT AUTO_INCREMENT NOT NULL,
                usuarios_id_usuario INT NOT NULL,
                inventario_roles_id_rol INT NOT NULL,
                nombre_producto VARCHAR(100) NOT NULL,
                descripcion VARCHAR(255),
                cantidad INT DEFAULT 0 NOT NULL,
                id_usuario INT NOT NULL,
                PRIMARY KEY (id_inventario, usuarios_id_usuario, inventario_roles_id_rol)
);


CREATE TABLE camiones (
                id_camiones INT AUTO_INCREMENT NOT NULL,
                usuarios_id_usuario INT NOT NULL,
                roles_id_rol INT NOT NULL,
                linea_id_linea INT NOT NULL,
                placa VARCHAR(20) NOT NULL,
                modelo VARCHAR(60) NOT NULL,
                id_usuario INT NOT NULL,
                id_linea INT NOT NULL,
                PRIMARY KEY (id_camiones, usuarios_id_usuario, roles_id_rol, linea_id_linea)
);


CREATE TABLE accesos (
                id_acceso INT AUTO_INCREMENT NOT NULL,
                camiones_id_camiones INT NOT NULL,
                usuarios_id_usuario INT NOT NULL,
                roles_id_rol INT NOT NULL,
                linea_id_linea INT NOT NULL,
                id_usuario INT NOT NULL,
                id_camiones INT NOT NULL,
                fecha_hora DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
                tipo VARCHAR(10) NOT NULL,
                PRIMARY KEY (id_acceso, camiones_id_camiones, usuarios_id_usuario, roles_id_rol, linea_id_linea)
);

ALTER TABLE accesos MODIFY COLUMN tipo VARCHAR(10) COMMENT 'entrada,salida';


CREATE TABLE reservas (
                id_reserva INT AUTO_INCREMENT NOT NULL,
                espacios_id_espacio INT NOT NULL,
                terrenos_id_terreno INT NOT NULL,
                id_usuario INT NOT NULL,
                id_camiones INT NOT NULL,
                id_espacio INT NOT NULL,
                fecha_inicio DATE NOT NULL,
                fecha_fin DATE,
                estado VARCHAR(20) DEFAULT pendiente NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id_reserva, espacios_id_espacio, terrenos_id_terreno)
);

ALTER TABLE reservas MODIFY COLUMN estado VARCHAR(20) COMMENT 'pendiente,activa,finalizada,cancelada';


CREATE TABLE pagos (
                id_pago VARCHAR AUTO_INCREMENT NOT NULL,
                id_inventario INT NOT NULL,
                usuarios_id_usuario INT NOT NULL,
                inventario_roles_id_rol INT NOT NULL,
                id_reserva INT NOT NULL,
                espacios_id_espacio INT NOT NULL,
                terrenos_id_terreno INT NOT NULL,
                id_usuario VARCHAR NOT NULL,
                horas VARCHAR DEFAULT 24 NOT NULL,
                folio VARCHAR NOT NULL,
                metodo VARCHAR(10),
                estado VARCHAR(10) DEFAULT pendiente NOT NULL,
                fecha_pago VARCHAR DEFAULT CURRENT_TIMESTAMP,
                monto VARCHAR(10) NOT NULL,
                PRIMARY KEY (id_pago, id_inventario, usuarios_id_usuario, inventario_roles_id_rol, id_reserva, espacios_id_espacio, terrenos_id_terreno)
);


ALTER TABLE espacios ADD CONSTRAINT fk_espacios_terrenos
FOREIGN KEY (id_terreno)
REFERENCES terrenos (id_terreno)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE espacios ADD CONSTRAINT terrenos_espacios_fk
FOREIGN KEY (terrenos_id_terreno)
REFERENCES terrenos (id_terreno)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE reservas ADD CONSTRAINT fk_reservas_espacios
FOREIGN KEY (id_espacio)
REFERENCES espacios (id_espacio)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pensionados ADD CONSTRAINT fk_pensionados_espacios
FOREIGN KEY (id_espacio)
REFERENCES espacios (id_espacio)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pensionados ADD CONSTRAINT espacios_pensionados_fk
FOREIGN KEY (espacios_id_espacio, terrenos_id_terreno)
REFERENCES espacios (id_espacio, terrenos_id_terreno)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE reservas ADD CONSTRAINT espacios_reservas_fk
FOREIGN KEY (espacios_id_espacio, terrenos_id_terreno)
REFERENCES espacios (id_espacio, terrenos_id_terreno)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE camiones ADD CONSTRAINT fk_camiones_linea
FOREIGN KEY (id_linea)
REFERENCES linea (id_linea)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE camiones ADD CONSTRAINT linea_camiones_fk
FOREIGN KEY (linea_id_linea)
REFERENCES linea (id_linea)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_roles
FOREIGN KEY (id_rol)
REFERENCES roles (id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE usuarios ADD CONSTRAINT roles_usuarios_fk
FOREIGN KEY (roles_id_rol)
REFERENCES roles (id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE camiones ADD CONSTRAINT fk_camiones_usuarios
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE inventario ADD CONSTRAINT fk_inventario_usuarios
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE reservas ADD CONSTRAINT fk_reservas_usuarios
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE accesos ADD CONSTRAINT fk_accesos_usuarios
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pensionados ADD CONSTRAINT fk_pensionados_usuarios
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE inventario ADD CONSTRAINT usuarios_inventario_fk
FOREIGN KEY (usuarios_id_usuario, inventario_roles_id_rol)
REFERENCES usuarios (id_usuario, roles_id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pensionados ADD CONSTRAINT usuarios_pensionados_fk
FOREIGN KEY (usuarios_id_usuario, roles_id_rol)
REFERENCES usuarios (id_usuario, roles_id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE camiones ADD CONSTRAINT usuarios_camiones_fk
FOREIGN KEY (usuarios_id_usuario, roles_id_rol)
REFERENCES usuarios (id_usuario, roles_id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pagos ADD CONSTRAINT inventario_pagos_fk
FOREIGN KEY (id_inventario, usuarios_id_usuario, inventario_roles_id_rol)
REFERENCES inventario (id_inventario, usuarios_id_usuario, inventario_roles_id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE reservas ADD CONSTRAINT fk_reservas_camiones
FOREIGN KEY (id_camiones)
REFERENCES camiones (id_camiones)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE accesos ADD CONSTRAINT fk_accesos_camiones
FOREIGN KEY (id_camiones)
REFERENCES camiones (id_camiones)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE accesos ADD CONSTRAINT camiones_accesos_fk
FOREIGN KEY (camiones_id_camiones, usuarios_id_usuario, roles_id_rol, linea_id_linea)
REFERENCES camiones (id_camiones, usuarios_id_usuario, roles_id_rol, linea_id_linea)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pagos ADD CONSTRAINT reservas_pagos_fk
FOREIGN KEY (id_reserva, espacios_id_espacio, terrenos_id_terreno)
REFERENCES reservas (id_reserva, espacios_id_espacio, terrenos_id_terreno)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
