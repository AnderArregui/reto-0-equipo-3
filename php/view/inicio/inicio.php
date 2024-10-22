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


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=manage_search,account_circle,search,menu" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <img src="../../../public/src/logo sin fondo.png" alt="logo">
        <ul class="nav-links">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Temas</a></li>
            <li><a href="#">Historial</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
        <div class="search-container">
            <input type="text">
            <span class="material-symbols-outlined">search</span>
        </div>
        <div class="burger">
            <span class="material-symbols-outlined">menu</span>
        </div>
    </nav>
    
    <div class="general">
        <div class="container">
            <div class="titulo"><h2>Temas</h2> </div> 
                <div class="temas">
                
                    <?php 
                    $contador = 0; // Inicializamos el contador

                        if (!empty($temas)): 
                        while ($contador < 4 && $contador < count($temas)): // Aseguramos que no se pase de 4 iteraciones
                            $tema = $temas[$contador]; // Accedemos a cada tema por índice
                            ?>
                            <div class="tema" style="background-color: <?php echo htmlspecialchars($tema['caracteristica']); ?>">
                                <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
                            </div>
                            <?php
                            $contador++; // Incrementamos el contador
                        endwhile;
                        else: ?>
                    <p>No hay temas disponibles.</p>
                    <?php endif; ?>
                    <div id="mastemas"> <a href="#">Más temas</a></div>
                </div>

        <div class="preguntas">
                <h2>Preguntas Recientes</h2>
                <?php if (!empty($preguntas)): ?>
                    <?php foreach ($preguntas as $pregunta): ?>
                        <div class="pregunta">
                            <h3><?php echo htmlspecialchars($pregunta['contenido']); ?></h3>
                            <p>Por: <?php echo htmlspecialchars($pregunta['nombre_usuario']); ?></p> <!-- Nombre del usuario -->
                            <p>Tema: <?php echo htmlspecialchars($pregunta['nombre_tema']); ?></p> 
                            <p>Fecha: <?php echo htmlspecialchars($pregunta['fecha']); ?></p>
                            <p>Likes: <?php echo htmlspecialchars($pregunta['likes']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay preguntas disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="./js/menu.js"></script>
    <?php
session_start(); // Inicia la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: ../../../public/index.php");
    exit();
}
?>











</body>
</html>