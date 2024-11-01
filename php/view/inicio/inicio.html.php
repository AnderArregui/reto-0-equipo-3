<?php 
require_once 'models/Guardado.php';

$guardadoModel = new Guardado();


$temas = $dataToView["data"]['temas'];


$totalPreguntas = $dataToView["data"]['totalPreguntas']; 
$preguntasPorPagina = $dataToView["data"]['preguntasPorPagina']; 
$paginaActual = $dataToView["data"]['paginaActual']; 
$totalPaginas = ceil($totalPreguntas / $preguntasPorPagina);
$preguntas = $dataToView["data"]['preguntas'];

$guardados = $dataToView['data']['guardados'];
$likesUsuario = $dataToView['data']['likesUsuario'];

$orderType = $_GET['tipo'] ?? 'reciente';
?> 


<div class="general">
    <div class="container">
        <h2 class="titulo">Temas</h2>
        <div class="temas">
        <?php 
        $contador = 0; 
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
        else:
        ?>
            <p>No hay temas disponibles.</p>
        <?php endif; ?>
        </div>
        <script src="/reto-1-equipo-3/php/assets/js/degradado.js"></script>
        <div id="mastemas"><a href="index.php?controller=Tema&action=list">Más temas</a></div>
    </div>
</div>

<div class="tresElementos">
<div class="preguntas"> 
    <div class="paginacionDiv">
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
        </div>
        <div class="paginacionDerecha">
    <div class="orden-control">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="index.php?controller=Inicio&action=init&page=<?php echo $i; ?>&tipo=<?php echo $orderType; ?>"
            class="<?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
        </div>
        </div>

    <?php
$contador = 0;
if (!empty($preguntas)): ?>
    <?php while ($contador < $preguntasPorPagina && $contador < count($preguntas)): ?>
        <?php 
        
        $pregunta = $preguntas[$contador];
        ?>
        <div class="pregunta" style="border: 2px dashed <?php echo htmlspecialchars($pregunta['caracteristica']); ?>">
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
                <?php 
                    $isSaved = $guardadoModel->verificarGuardado($pregunta['id_post'], $_SESSION['usuario']['id_usuario']);
                ?>

                <img src="<?php echo $isSaved ? '/reto-1-equipo-3/php/assets/images/save.png' : '/reto-1-equipo-3/php/assets/images/nosave.png'; ?>" alt="Guardar" class="save-icon" data-id-post="<?php echo $pregunta['id_post']; ?>" data-id-usuario="<?php echo $_SESSION['usuario']['id_usuario']; ?>" onclick="guardar(this)" />
                <script src="/reto-1-equipo-3/php/assets/js/guardar.js"></script>
        </div>
        <?php $contador++;?>
    <?php endwhile; ?>
    <?php else: ?>
        <p>No hay preguntas disponibles.</p>
    <?php endif; ?>
    <div class="paginacionDerecha">
    <div class="orden-control">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="index.php?controller=Inicio&action=init&page=<?php echo $i; ?>&tipo=<?php echo $orderType; ?>"
            class="<?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
        </div>
    </div>





</div>

<aside>
<div class="divAside">
    <h2>Mis Guardados</h2>
    <div id="guardados-container">
        <?php if (!empty($guardados)): ?>
            <?php foreach ($guardados as $postGuardado): ?>
                <div class="divUsuario" style="border: 2px dashed <?php echo htmlspecialchars($postGuardado['caracteristica']); ?>">
                    <h3>
                        <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($postGuardado['id_post']); ?>" class="tema-link">
                            <?php 
                                $maxCaracteres = 80;
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
</div>




    <div class="divAside">
        <h2>Mis Likes</h2>
        <div id="guardados-container">
        <?php 
        $likesUsuario = $dataToView["data"]['likesUsuario'] ?? []; 

        if (!empty($likesUsuario)): ?>
            <?php foreach ($likesUsuario as $respuestaLike): ?>
                <div class="divUsuario" style="border: 2px dashed <?php echo htmlspecialchars($respuestaLike['caracteristica']); ?>">
                    <h3>
                        <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($respuestaLike['id_respuesta']); ?>" class="tema-link">
                            <?php 
                                $maxCaracteres = 180;
                                $contenido = htmlspecialchars($respuestaLike['contenido']);
                                echo (mb_strlen($contenido) > $maxCaracteres) 
                                    ? mb_substr($contenido, 0, $maxCaracteres) . "..." 
                                    : $contenido; 
                            ?>
                        </a>
                    </h3>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No has dado like a ninguna respuesta.</p>
        <?php endif; ?>
        </div>
    </div>
</div>
</aside>


<div class="botonMas">
  <a href="/reto-1-equipo-3/php/index.php?controller=Post&action=crearPregunta">
    <img src="/reto-1-equipo-3/php/assets/images/crear.svg" alt="Añadir pregunta">
  </a>
</div>
    </div>
</div>