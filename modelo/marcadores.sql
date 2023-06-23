-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para marcadores
CREATE DATABASE IF NOT EXISTS `marcadores` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `marcadores`;

-- Volcando estructura para tabla marcadores.carteles
CREATE TABLE IF NOT EXISTS `carteles` (
  `id_cartel` int(5) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(100) NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `longitud` varchar(20) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `creador` int(8) DEFAULT NULL,
  `estado` int(2) NOT NULL DEFAULT 1,
  `creacion` datetime NOT NULL,
  `modificacion` datetime NOT NULL,
  PRIMARY KEY (`id_cartel`) USING BTREE,
  KEY `fk_creador_cartel` (`creador`),
  KEY `fk_estado_cartel` (`estado`),
  CONSTRAINT `fk_creador_cartel` FOREIGN KEY (`creador`) REFERENCES `usuarios` (`dni`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_estado_cartel` FOREIGN KEY (`estado`) REFERENCES `estado_marcador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla marcadores.carteles: ~0 rows (aproximadamente)

-- Volcando estructura para tabla marcadores.puestos
CREATE TABLE IF NOT EXISTS `puestos` (
  `nro_puesto` int(4) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `longitud` varchar(20) NOT NULL,
  `mesas` int(2) NOT NULL,
  `encargado` int(8) NOT NULL,
  PRIMARY KEY (`nro_puesto`),
  KEY `fk_encargado_puesto` (`encargado`),
  CONSTRAINT `fk_encargado_puesto` FOREIGN KEY (`encargado`) REFERENCES `usuarios` (`dni`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla marcadores.puestos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla marcadores.estado_marcador
CREATE TABLE IF NOT EXISTS `estado_marcador` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla marcadores.estado_marcador: ~3 rows (aproximadamente)
INSERT INTO `estado_marcador` (`id`, `nombre`) VALUES
	(1, 'Activo'),
	(2, 'No activo'),
	(3, 'Eliminado / bajado');

-- Volcando estructura para tabla marcadores.estado_usuario
CREATE TABLE IF NOT EXISTS `estado_usuario` (
  `id_estado_usuario` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_estado_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla marcadores.estado_usuario: ~2 rows (aproximadamente)
INSERT INTO `estado_usuario` (`id_estado_usuario`, `nombre`) VALUES
	(1, 'Autorizado'),
	(2, 'No autorizado');

-- Volcando estructura para tabla marcadores.locales
CREATE TABLE IF NOT EXISTS `locales` (
  `id_local` int(4) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(100) NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `longitud` varchar(20) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `creador` int(8) DEFAULT NULL,
  `estado` int(2) NOT NULL DEFAULT 1,
  `creacion` datetime NOT NULL,
  `modificacion` datetime NOT NULL,
  PRIMARY KEY (`id_local`) USING BTREE,
  KEY `fk_creador_local` (`creador`),
  KEY `fk_estado_local` (`estado`),
  CONSTRAINT `fk_creador_local` FOREIGN KEY (`creador`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_estado_local` FOREIGN KEY (`estado`) REFERENCES `estado_marcador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla marcadores.locales: ~0 rows (aproximadamente)

-- Volcando estructura para tabla marcadores.tipo_usuario
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` int(2) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla marcadores.tipo_usuario: ~2 rows (aproximadamente)
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo`) VALUES
	(1, 'Administrador'),
	(2, 'Usuario');

-- Volcando estructura para tabla marcadores.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `dni` int(8) NOT NULL,
  `nombre` varchar(20) NOT NULL DEFAULT '',
  `apellido` varchar(20) NOT NULL DEFAULT '',
  `mail` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `inicio_sesion` datetime DEFAULT NULL,
  `tipo_usuario` int(2) NOT NULL DEFAULT 2,
  `estado_usuario` int(2) NOT NULL DEFAULT 2,
  `estado_password` varchar(50) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `fk_tipo_usuario` (`tipo_usuario`),
  KEY `fk_estado_usuario` (`estado_usuario`),
  CONSTRAINT `fk_estado_usuario` FOREIGN KEY (`estado_usuario`) REFERENCES `estado_usuario` (`id_estado_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla marcadores.usuarios: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
