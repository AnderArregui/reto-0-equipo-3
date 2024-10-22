<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

require_once '../../config/config.php';


function obtenerPorNombre($nombre, $conn) {
        $query = "SELECT * FROM usuarios WHERE nombre = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $usuario = obtenerPorNombre($_SESSION['usuario'], $conn);
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    $usuario = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <img src="../login/logo sin fondo.png" alt="logo">
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

        <?php if (!empty($usuario)): ?>

            <div class="informacion">
               <h1 id="saludo">Hola, <?php echo htmlspecialchars($usuario['nombre']); ?> !</h1>
               <h5 id="especialidad">Especialidad: <?php echo htmlspecialchars($usuario['especialidad']); ?></h5>
               <h5 id="añosEmpresa">Años en la empresa: <?php echo htmlspecialchars($usuario['anios_empresa']); ?></h5>
                <h5 id="email">Mail: <?php echo htmlspecialchars($usuario['email']); ?></h5>
                <div class="botones">
                   <button>Guardados</button>
                   <button>Editar</button>
                  <button>Cerrar cuenta</button>
                  <button>Cambiar contraseña</button>
             </div>
         </div>
        <?php endif; ?>
        <div class="foto">
            <img src="./usuario.png" alt="">
        </div>

    </div>


    <script src="../inicio/script.js"></script>
    
</body>
</html>