-- ============================================================
-- TABLA: salidas
-- Módulo de control de salidas de funcionarios
-- ============================================================

CREATE TABLE IF NOT EXISTS `salidas` (
    `id_salida`       INTEGER AUTO_INCREMENT,
    `id_funcionario`  INTEGER NOT NULL,
    `actividad`       TEXT NOT NULL,
    `lugar`           VARCHAR(255) NOT NULL,
    `transporte`      VARCHAR(100),
    `fecha_salida`    DATE NOT NULL,
    `hora_salida`     TIME NOT NULL,
    `hora_llegada`    TIME NOT NULL,
    `estado`          INTEGER DEFAULT 1,
    `fecha_registro`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id_salida`),
    CONSTRAINT `fk_salida_usuario`
        FOREIGN KEY (`id_funcionario`) REFERENCES `usuarios`(`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- PERMISO: salidas (insertar en tabla permisos si no existe)
-- ============================================================
INSERT IGNORE INTO `permisos` (`permiso`) VALUES ('salidas');
