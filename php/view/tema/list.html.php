<div class="general">
    <div class="container">
        <div class="temasTemas">
        <?php 
        $contador = 0; 
        $temas = $dataToView["data"]['temas'];
        if (!empty($temas)):
            foreach ($temas as $tema): 

                $imagenTema = $contador < 4 && !empty($tema['imagen']) ? htmlspecialchars($tema['imagen']) : ''; 
                $colorTema = $contador < 4 && !empty($tema['caracteristica']) ? htmlspecialchars($tema['caracteristica']) : '';


                $claseTema = empty($imagenTema) && empty($colorTema) ? 'tema-sin-imagen-color' : '';

        ?>
        <a href="index.php?controller=Tema&action=view&id_tema=<?php echo htmlspecialchars($tema['id_tema']); ?>" class="tema-link">
        <div class="tema <?php echo $claseTema; ?>" <?php if (!empty($colorTema)): ?>data-color="<?php echo $colorTema; ?>"<?php endif; ?>>
            <?php if (!empty($imagenTema)): ?>
                <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($tema['nombre']); ?>" class="tema-img">
            <?php endif; ?>
            <div class="degradado"></div>
            
            <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
        </div>
        <?php
                $contador++;
            endforeach;
        else: ?>
            <p>No hay temas disponibles.</p>
        <?php endif; ?>
        </div>
        <script src="/reto-1-equipo-3/php/assets/js/degradado.js"></script>
    </div>
</div>
