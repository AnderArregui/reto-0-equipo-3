<?php
    $infoUsuario = $dataToView['data']['infoUsuario'];

    // Función para formatear el tiempo transcurrido
    function formatearTiempo($minutos) {
        if ($minutos < 60) {
            return $minutos . ' minuto' . ($minutos !== 1 ? 's' : '');
        } elseif ($minutos < 1440) { // menos de 24 horas
            $horas = floor($minutos / 60);
            return $horas . ' hora' . ($horas !== 1 ? 's' : '');
        } else { // más de 24 horas
            $dias = floor($minutos / 1440);
            return $dias . ' día' . ($dias !== 1 ? 's' : '');
        }
    }
?>

<div class="usuario-info">
    <img class="imagenUsuario" src="<?php echo isset($infoUsuario['foto']) ? htmlspecialchars($infoUsuario['foto']) : 'https://via.placeholder.com/150'; ?>" alt="Imagen de <?php echo isset($infoUsuario['nombre']) ? htmlspecialchars($infoUsuario['nombre']) : 'Usuario desconocido'; ?>">
    <h2><?php echo isset($infoUsuario['nombre']) ? htmlspecialchars($infoUsuario['nombre']) : 'Nombre no disponible'; ?></h2>
    <p>Email: <?php echo isset($infoUsuario['email']) ? htmlspecialchars($infoUsuario['email']) : 'No disponible'; ?></p>
    <p>Especialidad: <?php echo isset($infoUsuario['especialidad']) ? htmlspecialchars($infoUsuario['especialidad']) : 'No disponible'; ?></p>
    <p>Años en la empresa: <?php echo isset($infoUsuario['anios_empresa']) ? htmlspecialchars($infoUsuario['anios_empresa']) : 'No disponible'; ?></p>
    
    <p>Tiempo desde la última interaccion: 
        <?php 
            $totalRespuestas = isset($infoUsuario['total_respuestas']) ? $infoUsuario['total_respuestas'] : 0;
            if ($totalRespuestas === 0) {
                echo "No ha posteado ninguna respuesta.";
            } else {
                $minutosDesdeUltimaRespuesta = isset($infoUsuario['minutos_desde_ultima_respuesta']) ? $infoUsuario['minutos_desde_ultima_respuesta'] : 0;
                echo formatearTiempo($minutosDesdeUltimaRespuesta);
            }
        ?>
    </p>

    <div class="stats">
        <div class="stat-item">
            <span><?php echo isset($infoUsuario['total_preguntas']) ? htmlspecialchars($infoUsuario['total_preguntas']) : '0'; ?></span>
            <p>Preguntas</p>
        </div>
        <div class="stat-item">
            <span><?php echo isset($infoUsuario['total_respuestas']) ? htmlspecialchars($infoUsuario['total_respuestas']) : '0'; ?></span>
            <p>Respuestas</p>
        </div>
        <div class="stat-item">
            <span><?php echo isset($infoUsuario['total_likes']) ? htmlspecialchars($infoUsuario['total_likes']) : '0'; ?></span>
            <p>Likes</p>
        </div>
    </div>
</div>
