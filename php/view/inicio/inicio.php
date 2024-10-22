


<?php

require_once '../../controlador/InicioController.php';

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
        <img src="../../assets/images/logo sin fondo.png" alt="logo">
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