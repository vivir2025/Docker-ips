-- Script de inicialización de base de datos IPS
-- Este script se ejecuta automáticamente al crear el contenedor MySQL por primera vez

-- Asegurar la creación de la base de datos con charset UTF-8
CREATE DATABASE IF NOT EXISTS `ips` 
  DEFAULT CHARACTER SET utf8 
  DEFAULT COLLATE utf8_general_ci;

-- Seleccionar la base de datos
USE `ips`;

-- Mensaje de confirmación (aparecerá en los logs de Docker)
SELECT 'Base de datos IPS creada exitosamente' AS Status;
