<?php
define('DB_HOST', '172.20.227.241');
define('DB_USER', 'grupo3_2425');
define('DB_PASS', 'dqwW2[h1v1x)G)6/');
define('DB_NAME', 'grupo3_2425'); // Cambié 'DB' por 'DB_NAME' para mayor claridad

try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

/*

define('DB_HOST', '172.20.227.241');

define('DB_HOST', '150.241.37.58');





define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'aeronautica'); // Cambié 'DB' por 'DB_NAME' para mayor claridad

*/