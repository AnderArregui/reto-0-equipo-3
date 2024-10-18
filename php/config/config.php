<?php
<<<<<<< HEAD
$host = '172.20.227.241';  // Dirección del servidor de la base de datos
$user = 'grupo3_2425'; // Nombre de usuario de la base de datos
$pass = 'dqwW2[h1v1x)G)6/'; // Contraseña de la base de datos
$dbname = 'grupo3_2425'; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa";
}
?>
=======
define('DB_HOST', 'mysql.arriaga.eu');
define('DB_USER', 'grupo3_2425');
define('DB_PASS','dqwW2[h1v1x)G)6/');
define('DB','grupo3_2425');
?>
>>>>>>> b0c7ec8b5a8e2d0cd77f204b3652980e00e40665
