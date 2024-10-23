<div class="general">
    <div class="container">
        <div class="titulo"><h2>Temas</h2></div>
        <div class="temas">
        <table>
            <?php
             print_r($dataToView["data"]); 
            if(count($dataToView["data"])>0){
                foreach ($dataToView["data"] as $tema){ ?>
               
                    <tr class="wine-row">
                        <td class="wine-cell"><?php echo "vdfvdfv" ?></td>
                        <td class="wine-cell"><?php echo $tema['caracteristica']; ?></td>
                    </tr>
                    <?php
                }   
                ?>
                </table>

                <?php
            } else {
                ?>
                <p>No hay temas disponibles.</p>
                <?php
            }
            
            ?>
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