<?php

$temas = $dataToView['tema'];
$preguntas = $dataToView['preguntas'];
$imagenTema = !empty($temas['imagen']) ? htmlspecialchars($temas['imagen']) : '';
$colorTema = !empty($temas['caracteristica']) ? htmlspecialchars($temas['caracteristica']) : '';
$claseTema = empty($imagenTema) && empty($colorTema) ? 'tema-sin-imagen-color' : '';

?>
<div class="general">
    <div class="container">
    <div class="tema <?php echo $claseTema; ?>" <?php if (!empty($colorTema)): ?>data-color="<?php echo $colorTema; ?>"<?php endif; ?>>   
        <?php if (!empty($imagenTema)): ?>
        <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($temas['nombre']); ?>" class="tema-img">
    <?php endif; ?>
    <div class="degradado"></div>
    <h3 id="palabraTemaOculta">Tema</h3>
    <h3><?php echo htmlspecialchars($temas['nombre']); ?></h3>
</div>



        <div class="preguntas"> 
            <h3>Preguntas Recientes</h3>
            <?php if (!empty($preguntas)): ?>
                <?php foreach ($preguntas as $pregunta): ?>
                    <div class="pregunta" style="border: 2px dashed <?php echo htmlspecialchars($pregunta['caracteristica']); ?>">
                <h3>
                    <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($pregunta['id_post']); ?>" class="tema-link">
                        <?php echo htmlspecialchars($pregunta['contenido']); ?>
                    </a>
                </h3>
               
                <div class="postInfo">
                    <p>Por: <?php echo htmlspecialchars($pregunta['nombre_usuario'] ?? 'Usuario desconocido'); ?></p>
                    <p>Fecha: <?php echo htmlspecialchars($pregunta['fecha']); ?></p>  
                </div>
                <div class="postInfo">
                    <p>Respuestas: <?php echo htmlspecialchars($pregunta['total_respuestas'] ?? '0'); ?></p>
                    <p>Likes: <?php echo htmlspecialchars($pregunta['likes']); ?></p>
                </div>
                <div class="postInfo">
                    <p>Últ. mensaje: juanPerez</p>
                    <p>Hace 24 minutos</p>
                </div>
                <img src="/reto-1-equipo-3/php/assets/images/nolike.png" alt="Like" class="save-icon" onclick="like(this)" />
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
