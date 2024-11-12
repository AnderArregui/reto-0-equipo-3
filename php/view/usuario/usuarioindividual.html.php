<?php
    $infoUsuario = $dataToView['data']['infoUsuario'];
    $respuestas = $dataToView['data']['respuestas'];
    $preguntas = $dataToView['data']['preguntas'];

    
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

<div class="containerContacto">
    <div class="usuario-info">
        <img class="usuario-img" src="<?php echo isset($infoUsuario['foto']) ? htmlspecialchars($infoUsuario['foto']) : 'https://via.placeholder.com/150'; ?>" alt="Imagen de <?php echo isset($infoUsuario['nombre']) ? htmlspecialchars($infoUsuario['nombre']) : 'Usuario desconocido'; ?>">
        
        <h2 class="contactanos"><?php echo isset($infoUsuario['nombre']) ? htmlspecialchars($infoUsuario['nombre']) : 'Nombre no disponible'; ?></h2>
        
        <p class="infoContacto">Email: <?php echo isset($infoUsuario['email']) ? htmlspecialchars($infoUsuario['email']) : 'No disponible'; ?></p>
        <p class="infoContacto">Especialidad: <?php echo isset($infoUsuario['especialidad']) ? htmlspecialchars($infoUsuario['especialidad']) : 'No disponible'; ?></p>
        <p class="infoContacto">Años en la empresa: <?php echo isset($infoUsuario['anios_empresa']) ? htmlspecialchars($infoUsuario['anios_empresa']) : 'No disponible'; ?></p>

        <p class="infoContacto">Tiempo desde la última interacción:
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

        <?php if ($_SESSION['usuario']['tipo'] === 'admin' && $infoUsuario['id_usuario'] != $_SESSION['usuario']['id_usuario']): ?>
            <a class="link-modificar" href="index.php?controller=Usuario&action=modificarUsuario&id_usuario=<?php echo $infoUsuario['id_usuario']; ?>">Modificar Usuario</a>
            <form action="index.php?controller=Usuario&action=eliminarUsuario" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario? Sus preguntas y respuestas se mantendrán en el sistema.');">
                <input type="hidden" name="id_usuario" value="<?php echo $infoUsuario['id_usuario']; ?>">
                <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<div class="preguntasYrespuestas">
<?php if ($_SESSION['usuario']['tipo'] === 'admin'): ?>
    <div class="admin-section">
        <h3 class="titulo">Preguntas de <?php echo htmlspecialchars($infoUsuario['nombre']) ?></h3>
        <?php if (!empty($preguntas)): ?>
            <?php foreach ($preguntas as $pregunta): ?>
                <div class="preguntasUsuario">
                <div class="pregunta" id="preguntaUsuario" style="border: 2px dashed <?php echo htmlspecialchars($pregunta['caracteristica']); ?>">
        <h3>
            <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($pregunta['id_post']); ?>" class="tema-link">
                <?php 
                    $maxCaracteres = 120;
                    $contenido = htmlspecialchars($pregunta['contenido']);
                    echo (mb_strlen($contenido) > $maxCaracteres) 
                        ? mb_substr($contenido, 0, $maxCaracteres) . "..." 
                        : $contenido; 
                ?>
            </a>
        </h3>

    <div class="postInfo">
        <p>Por: <?php echo htmlspecialchars($pregunta['nombre_usuario'] ?? 'Usuario desconocido'); ?></p>
        <p>Fecha: <?php echo htmlspecialchars($pregunta['fecha']); ?></p>  
    </div>

    <div class="postInfo">
        <p>Tema: <?php echo htmlspecialchars($pregunta['nombre_tema'] ?? 'Tema no especificado'); ?></p>
        <p>Respuestas: <?php echo htmlspecialchars($pregunta['total_respuestas'] ?? '0'); ?></p>
    </div>

    <div>
        <p>Últ. mensaje: <?php echo htmlspecialchars($pregunta['autor_ultimo_mensaje'] ?? 'N/D'); ?></p>
        <p>
            <?php 
                $minutos = $pregunta['minutos_transcurridos'] ?? 0;
                if ($minutos < 60) {
                    echo "Hace {$minutos} minutos";
                } elseif ($minutos < 1440) {
                    echo "Hace " . floor($minutos / 60) . " horas";
                } else {
                    echo "Hace " . floor($minutos / 1440) . " días";
                }
            ?>
        </p>
    </div>
    
    <!-- Botón eliminar -->
    <button class="eliminarBtn" onclick="confirmarEliminacion(event)">Eliminar</button>

    <!-- Botones de Confirmar y Cancelar, ocultos inicialmente -->
    <div class="confirmacion" style="display: none;">
        <button class="confirmarBtn" onclick="eliminarPregunta(event)">Confirmar</button>
        <button class="cancelarBtn" onclick="cancelarEliminacion(event)">Cancelar</button>
    </div>

    <!-- Formulario de eliminación de pregunta -->
    <form action="index.php?controller=Usuario&action=eliminarPregunta" method="POST" id="formEliminarPregunta" style="display: none;">
        <input type="hidden" name="id_post" value="<?php echo $pregunta['id_post']; ?>">
    </form>
</div>
</div>
                
                
            <?php endforeach; ?>
        <?php else: ?>
            <p>Este usuario no tiene preguntas.</p>
        <?php endif; ?>
        </div>
    <div class="admin-respuesta">
    <h3 class="titulo">Respuestas de <?php echo htmlspecialchars($infoUsuario['nombre']) ?></h3>
       
        <?php if (!empty($respuestas)): ?>
            <?php foreach ($respuestas as $respuesta): ?>
                <div class="respuestasUsuario">
                <div class="respuesta" style="width:90%">
                    <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo $respuesta['id_post']; ?>">
                        <p class="contenidoRespuesta"><?php echo htmlspecialchars($respuesta['contenido']); ?></p>
                    </a>
                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($respuesta['fecha']); ?></p>
                    <form action="index.php?controller=Usuario&action=eliminarRespuesta" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta respuesta?');">
                        <input type="hidden" name="id_respuesta" value="<?php echo $respuesta['id_respuesta']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Este usuario no tiene respuestas.</p>
        <?php endif; ?>
    </div>
        </div>
<?php endif; ?>
</div>
