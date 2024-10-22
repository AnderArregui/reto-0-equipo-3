<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

// Carga la configuración de la base de datos
require_once '../../config/config.php';

function getThemes($conn) {
    try {
        $stmt = $conn->query("SELECT * FROM grupo3_2425.temas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
    } catch (PDOException $e) {
        error_log("Error fetching themes: " . $e->getMessage());
        return [];
    }
}

function getPosts($conn) {
    try {
        $stmt = $conn->query("
        SELECT p.*, u.nombre AS nombre_usuario, t.nombre AS nombre_tema
        FROM posts p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        JOIN temas t ON p.id_tema = t.id_tema
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching posts: " . $e->getMessage());
        return [];
    }
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $temas = getThemes($conn);
    
     $preguntas = getPosts($conn);
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    $temas = [];
    $preguntas = [];
}

?>