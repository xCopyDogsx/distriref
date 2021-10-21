<?php 
require_once 'vendor/autoload.php';

	const BASE_URL = "http://localhost/distriref/";
	const MEDIA_URL =  "http://localhost/distriref/Assets/";
	//const BASE_URL = "https://www.cotizados.co/";
	//Zona horaria
	date_default_timezone_set('America/Bogota');

	//Datos de conexión a Base de Datos postproduccion
	const DB_HOST = "localhost";
	const DB_NAME = "distriref";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";
	/*
	//Datos de conexión a Base de Datos produccion
	const DB_HOST = "localhost";
	const DB_NAME = "db_tiendavirtual";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";
	*/
	
	

	//Datos para Encriptar / Desencriptar
	const KEY = 'distriref@20213asd';
	const METHODENCRIPT = "AES-128-ECB";
	const KEYAES=KEY.'pass';
	const METHOD = 'AES-256-CBC';
	const IV ="5762436029984733";

 ?>