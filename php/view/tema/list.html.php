<div class="general">
    <div class="container">
        <div class="temas">
    <?php 
    $contador = 0; 
    $temas = $dataToView["data"]['temas']; // Asegúrate de que esta clave contenga los temas
    if (!empty($temas)):
        while ($contador < count($temas)): 
            $tema = $temas[$contador]; 
            // Obtener la ruta de la imagen desde la base de datos
            $imagenTema = !empty($tema['imagen']) ? htmlspecialchars($tema['imagen']) : 'default.jpg'; // Asigna una imagen por defecto si no hay imagen
    ?>
    <div class="tema" data-color="<?php echo htmlspecialchars($tema['caracteristica']); ?>">
        <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($tema['nombre']); ?>" class="tema-img">
        <div class="degradado"></div> <!-- Div para el degradado -->
        <h3 id="palabraTema">Tema</h3>
        <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
    </div>
    <?php
            $contador++;
        endwhile;
    else: ?>
        <p>No hay temas disponibles.</p>
    <?php endif; ?>
</div>
<script src="/reto-1-equipo-3/php/assets/js/degradado.js"></script>
        <div id="mastemas"><a href="#">Más temas</a></div>
    </div>
</div>
    </div>
</div>
