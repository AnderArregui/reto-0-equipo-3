<div class="general">
    <div class="container">
        <div class="titulo"><h2>Temas</h2> </div> 
            <div class="temas">
                <?php 
                    $contador = 0; // Inicializamos el contador
                    $temas = $dataToView["data"]['temas'];
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
            <?php $preguntas = $dataToView["data"]['preguntas']; // Accede a las preguntas
            if (!empty($preguntas)): ?>
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
