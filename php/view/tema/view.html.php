<?php

$temas = $dataToView['tema'];
$preguntas = $dataToView['preguntas'];
$imagenTema = !empty($temas['imagen']) ? htmlspecialchars($temas['imagen']) : 'default.jpg';
?>
<div class="general">
    <div class="container">
        <div class="tema" data-color="<?php echo htmlspecialchars($temas['caracteristica']); ?>">
            <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($temas['nombre']); ?>" class="tema-img">
            <div class="degradado"></div>
            <h3 id="palabraTema">Tema</h3>
            <h3><?php echo htmlspecialchars($temas['nombre']); ?></h3>
        </div>

        <div class="preguntas"> 
            <h3>Preguntas Recientes</h3>
            <?php if (!empty($preguntas)): ?>
                <?php foreach ($preguntas as $pregunta): ?>
                    <div class="pregunta">
                        <h4><?php echo htmlspecialchars($pregunta['contenido']); ?></h4>
                        <div class="postInfo">
                            <p>Por: <?php echo htmlspecialchars($pregunta['nombre_usuario'] ?? 'Usuario desconocido'); ?></p>
                            <p>Fecha: <?php echo htmlspecialchars($pregunta['fecha']); ?></p>  
                        </div>
                        <div class="postInfo">
                            <p>Respuestas: <?php echo htmlspecialchars($pregunta['likes']); ?></p>
                        </div>
                        <img src="/reto-1-equipo-3/php/assets/images/nosave.png" alt="Guardar" class="save-icon" onclick="guardar(this)" />
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay preguntas disponibles para este tema.</p>
            <?php endif; ?>
        </div>
        <script src="/reto-1-equipo-3/php/assets/js/degradado.js"></script>
        <script src="/reto-1-equipo-3/php/assets/js/guardar.js"></script>
    </div>
</div>
