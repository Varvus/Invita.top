<?php 
// Datos de conexión a la base de datos
$host = 'localhost'; // Si está en el mismo servidor, generalmente se usa 'localhost'
$usuario = 'u741379875_admin'; // Usuario de la base de datos
$contrasena = 'pK#43T!5QV!r'; // Contraseña del usuario de la base de datos
$nombreBD = 'u741379875_sus_adr'; // Nombre de la base de datos

// Conexión a la base de datos
$conexion = mysqli_connect($host, $usuario, $contrasena, $nombreBD);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>