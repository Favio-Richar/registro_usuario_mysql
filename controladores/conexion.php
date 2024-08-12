<?php
$host_name = 'localhost';
$database = 'registro_usuario';
$user_name = 'root';
$password = '';

// Establece la conexión con la base de datos
$conexion = mysqli_connect($host_name, $user_name, $password, $database);

// Verifica si la conexión ha fallado
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

// Establece el conjunto de caracteres a UTF-8
$acentos = $conexion->query("SET NAMES 'utf8'");
if (!$acentos) {
    die("Error al configurar el conjunto de caracteres UTF-8: " . $conexion->error);
}

// No imprimas nada si la conexión es exitosa
?>
