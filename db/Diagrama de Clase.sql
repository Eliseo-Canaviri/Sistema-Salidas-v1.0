CREATE TABLE IF NOT EXISTS `usuarios` (
	`id_usuario` INTEGER AUTO_INCREMENT,
	`usuario` VARCHAR(50) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`rol` ENUM('ADMIN', 'SUPERVISOR', 'USUARIO') NOT NULL,
	`estado` TINYINT DEFAULT 1,
	`fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_usuario`)
);


CREATE TABLE IF NOT EXISTS `funcionarios` (
	`id_funcionario` INTEGER AUTO_INCREMENT,
	`ci` VARCHAR(20) NOT NULL UNIQUE,
	`nombres` VARCHAR(100) NOT NULL,
	`apellidos` VARCHAR(100) NOT NULL,
	`celular` INTEGER,
	`id_cargo` INTEGER,
	`id_unidad` INTEGER,
	`clave` VARCHAR(255),
	`estado` TINYINT DEFAULT 1,
	`fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_funcionario`)
);


CREATE TABLE IF NOT EXISTS `salidas` (
	`id_salida` INTEGER AUTO_INCREMENT,
	`id_funcionario` INTEGER NOT NULL,
	`fecha_salida` DATE NOT NULL,
	`hora_salida` TIME NOT NULL,
	`hora_llegada` TIME NOT NULL,
	`lugar` VARCHAR(255) NOT NULL,
	`actividad` TEXT NOT NULL,
	`transporte` VARCHAR(100),
	`observacion` TEXT,
	`estado` ENUM('PENDIENTE', 'EN_CURSO', 'FINALIZADO', 'CANCELADO') DEFAULT 'PENDIENTE',
	`fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_salida`)
);


CREATE TABLE IF NOT EXISTS `reportes` (
	`id_reporte` INTEGER AUTO_INCREMENT,
	`fecha_inicio` DATE NOT NULL,
	`fecha_fin` DATE NOT NULL,
	`tipo` ENUM('PDF', 'EXCEL') NOT NULL,
	`fecha_generado` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_reporte`)
);


CREATE TABLE IF NOT EXISTS `auditoria` (
	`id_auditoria` INTEGER AUTO_INCREMENT,
	`id_usuario` INTEGER,
	`accion` VARCHAR(100) NOT NULL,
	`descripcion` TEXT,
	`fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_auditoria`)
);


CREATE TABLE IF NOT EXISTS `unidades` (
	`id_unidad` INTEGER AUTO_INCREMENT,
	`nombre_unidad` VARCHAR(150) NOT NULL UNIQUE,
	`descripcion` TEXT,
	`ubicacion` VARCHAR(150),
	`estado` TINYINT DEFAULT 1,
	`fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_unidad`)
);


CREATE TABLE IF NOT EXISTS `cargos` (
	`id_cargo` INTEGER AUTO_INCREMENT,
	`nombre_cargo` VARCHAR(100) NOT NULL UNIQUE,
	`descripcion` TEXT,
	`estado` TINYINT DEFAULT 1,
	`fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id_cargo`)
);


ALTER TABLE `auditoria`
ADD FOREIGN KEY(`id_usuario`) REFERENCES `usuarios`(`id_usuario`)
ON UPDATE CASCADE ON DELETE SET NULL;