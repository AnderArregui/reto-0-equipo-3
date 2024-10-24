<div class="general">
    <div class="container">
        <h2 class="titulo">Temas</h2>
        <div class="temas">
        <?php 
        $contador = 0; 
        $temas = $dataToView["data"]['temas']; // Asegúrate de que esta clave contenga los temas
        if (!empty($temas)):
            while ($contador < 4 && $contador < count($temas)): 
                $tema = $temas[$contador]; 
                // Obtener la ruta de la imagen desde la base de datos
                $imagenTema = !empty($tema['imagen']) ? htmlspecialchars($tema['imagen']) : 'default.jpg'; // Asigna una imagen por defecto si no hay imagen
        ?>
        <!-- Hacemos que el contenedor del tema sea un enlace -->
            <a href="index.php?controller=Tema&action=view&id_tema=<?php echo htmlspecialchars($tema['id_tema']); ?>" class="tema-link">
            <div class="tema" data-color="<?php echo htmlspecialchars($tema['caracteristica']); ?>">
                <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($tema['nombre']); ?>" class="tema-img">
                <div class="degradado"></div>
                <h3 id="palabraTema">Tema</h3>
                <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
            </div>
        </a>
        <?php
                $contador++;
            endwhile;
        else: ?>
            <p>No hay temas disponibles.</p>
        <?php endif; ?>
        </div>
        <script src="/reto-1-equipo-3/php/assets/js/degradado.js"></script>
        <div id="mastemas"><a href="index.php?controller=Tema&action=list">Más temas</a></div>
    </div>
</div>


<div class="preguntas"> 
    <h2>Preguntas Recientes</h2>
    <?php $preguntas = $dataToView["data"]['preguntas']; // Accede a las preguntas
    if (!empty($preguntas)): ?>
        <?php foreach ($preguntas as $pregunta): ?>
            <div class="pregunta">
                <h3><?php echo htmlspecialchars($pregunta['contenido']); ?></h3>
                <div class="postInfo">
                    <p>Tema: <?php echo htmlspecialchars($pregunta['nombre_tema'] ?? 'Tema no especificado'); ?></p>
                    <p>Por: <?php echo htmlspecialchars($pregunta['nombre_usuario'] ?? 'Usuario desconocido'); ?></p>
                    <p>Fecha: <?php echo htmlspecialchars($pregunta['fecha']); ?></p>  
                </div>
                <div class="postInfo">
                    <p>Respuestas: 1024</p>
                    <p>Likes: <?php echo htmlspecialchars($pregunta['likes']); ?></p>
                </div>
                <div class="postInfo">
                    <p>Últ. mensaje: juanPerez</p>
                    <p>Hace 24 minutos</p>
                </div>
                <img src="/reto-1-equipo-3/php/assets/images/nosave.png" alt="Guardar" class="save-icon" onclick="guardar(this)" />
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay preguntas disponibles.</p>
    <?php endif; ?>
</div>

<script src="/reto-1-equipo-3/php/assets/js/guardar.js"></script>

    </div>
</div>
