<div class="general">
    <div class="container">
        <h2 class="titulo">Temas</h2>
        <div class="temas">
        <?php 
        $contador = 0; 
        $temas = $dataToView["data"]['temas'];
        if (!empty($temas)):
            while ($contador < 4 && $contador < count($temas)): 
                $tema = $temas[$contador]; 
                
                $imagenTema = !empty($tema['imagen']) ? htmlspecialchars($tema['imagen']) : 'default.jpg'; // Asigna una imagen por defecto si no hay imagen
        ?>
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

<div class="tresElementos">
<div class="preguntas"> 
    <div class="orden-control">
    <h2>Preguntas Recientes</h2>
    <div>
        <span>Ordenar por:</span>
        <a href="index.php?controller=Inicio&action=ordenar&tipo=popular">Destacado</a>
        <a href="index.php?controller=Inicio&action=ordenar&tipo=reciente">Reciente</a>
        <a href="index.php?controller=Inicio&action=ordenar&tipo=tema">Por tema</a>
        <a href="index.php?controller=Inicio&action=ordenar&tipo=aleatorio">Aleatorio</a>
    </div>
</div>
    <?php $preguntas = $dataToView["data"]['preguntas'];
    if (!empty($preguntas)): ?>
        <?php foreach ($preguntas as $pregunta): ?>
            <div class="pregunta" style="border: 2px dashed <?php echo htmlspecialchars($pregunta['caracteristica']); ?>">
                <h3>
                <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($pregunta['id_post']); ?>" class="tema-link">
                <?php 
                    $maxCaracteres = 180;
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
                <img src="/reto-1-equipo-3/php/assets/images/nosave.png" alt="Guardar" class="save-icon" data-id-post="<?php echo $pregunta['id_post']; ?>" onclick="guardar(this)" />
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay preguntas disponibles.</p>
    <?php endif; ?>
</div>
<?php 
$guardados = $dataToView['data']['guardados'];
$likesUsuario = $dataToView['data']['likesUsuario'];
?>

    <div class="guardados">
        <h2>Mis Guardados</h2>
        <?php if (!empty($guardados)): ?>
            <?php foreach ($guardados as $postGuardado): ?>
                <div class="preguntaGuardada" style="border: 2px dashed <?php echo htmlspecialchars($postGuardado['caracteristica']); ?>">
                    <h3>
                        <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($postGuardado['id_post']); ?>" class="tema-link">
                            <?php 
                                $maxCaracteres = 180;
                                $contenido = htmlspecialchars($postGuardado['contenido']);
                                echo (mb_strlen($contenido) > $maxCaracteres) 
                                    ? mb_substr($contenido, 0, $maxCaracteres) . "..." 
                                    : $contenido; 
                            ?>
                        </a>
                    </h3>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tienes posts guardados.</p>
        <?php endif; ?>
    </div>



    <div class="likes-usuario">
        <h2>Respuestas a las que he dado Like</h2>
        <?php 
        $likesUsuario = $dataToView["data"]['likesUsuario'] ?? []; 
        if (!empty($likesUsuario)): ?>
            <?php foreach ($likesUsuario as $respuestaLike): ?>
                <p><?php echo $respuestaLike['contenido'] ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No has dado like a ninguna respuesta.</p>
        <?php endif; ?>
    </div>
</div>


<script src="/reto-1-equipo-3/php/assets/js/guardar.js"></script>
<div class="botonMas">
  <a href="/reto-1-equipo-3/php/index.php?controller=Post&action=crearPregunta">
    <img src="/reto-1-equipo-3/php/assets/images/crear.svg" alt="Añadir pregunta">
  </a>
</div>
    </div>
</div>
