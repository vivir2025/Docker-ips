<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONFIGURACIÓN DE BASE DE DATOS PARA DOCKER
| -------------------------------------------------------------------
| Este archivo contiene la configuración de base de datos específica 
| para el entorno Docker. Se copia automáticamente a database.php
| cuando se inicia el contenedor.
*/

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'db', // Nombre del servicio en docker-compose
	'username' => getenv('DB_USER') ?: 'ips_user',
	'password' => getenv('DB_PASSWORD') ?: 'ips_password',
	'database' => getenv('DB_NAME') ?: 'ips',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => TRUE,
	'cachedir' => APPPATH . 'cache/db/',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => FALSE
);
