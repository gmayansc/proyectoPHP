<?php
// Conexión
$server = 'localhost:8889';
$username = 'root';
$password = 'root';
$database = 'producto 2';
//$port = '3307';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'"); // Para que se visualicen correctamente los caracteres especiales

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}