<?php
/*
$host = '172.20.227.241';  // Dirección del servidor de la base de datos
$user = 'grupo3_2425'; // Nombre de usuario de la base de datos
$pass = 'dqwW2[h1v1x)G)6/'; // Contraseña de la base de datos
$dbname = 'grupo3_2425'; // Nombre de la base de datos
*/

$host = '127.0.0.1';  // Dirección del servidor de la base de datos
$user = 'root'; // Nombre de usuario de la base de datos
$pass = ''; // Contraseña de la base de datos
$dbname = 'aeronautica'; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "";
}
?>
