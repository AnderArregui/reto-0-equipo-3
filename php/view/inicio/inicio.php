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

// Incluir el header
include '../../path/to/header.html.php';
?>

<div class="general">
    <div class="container">
        <div class="titulo"><h2>Temas</h2></div>
        <div class="temas">
            <?php 
            $contador = 0;
            if (!empty($temas)): 
                while ($contador < 4 && $contador < count($temas)): 
                    $tema = $temas[$contador]; 
            ?>
            <div class="tema" style="background-color: <?php echo htmlspecialchars($tema['caracteristica']); ?>">
                <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
            </div>
            <?php
                $contador++; 
                endwhile;
            else: ?>
            <p>No hay temas disponibles.</p>
            <?php endif; ?>
            <div id="mastemas"><a href="#">Más temas</a></div>
        </div>

        <div class="preguntas">
            <h2>Preguntas Recientes</h2>
            <?php if (!empty($preguntas)): ?>
                <?php foreach ($preguntas as $pregunta): ?>
                    <div class="pregunta">
                        <h3><?php echo htmlspecialchars($pregunta['contenido']); ?></h3>
                        <p>Por: <?php echo htmlspecialchars($pregunta['nombre_usuario']); ?></p>
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

<?php
// Incluir el footer
include '../../path/to/footer.html.php';
?>