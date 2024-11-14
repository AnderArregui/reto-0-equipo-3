<?php

require_once 'models/Guardado.php';

$guardadoModel = new Guardado();

?>

<div class="result-gridBusqueda">
    <?php
    $temas = $dataToView['data']['tema'];
    if (!empty($temas)): ?>
        <?php foreach ($temas as $tema): 
            $imagenTema = !empty($tema['imagen']) ? htmlspecialchars($tema['imagen']) : ''; 
            $claseTema = empty($imagenTema) ? 'tema-sin-imagen-color' : ''; // Asigna la clase de fondo gris si no hay imagen
            ?>
            <a href="index.php?controller=Tema&action=view&id_tema=<?php echo htmlspecialchars($tema['id_tema']); ?>" class="tema-link">
                <div class="tema-item <?php echo $claseTema; ?>">
                    <?php if (!empty($imagenTema)): ?>
                        <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($tema['nombre']); ?>" class="tema-img">
                    <?php endif; ?>
                    <div class="degradado-item"></div>
                    <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        
    <?php endif; ?>
</div>

<div class="result-section">
    <h3>Resultados de la busqueda</h3>
    <?php 
   $posts = $dataToView['data']['post'];
   if (!empty($posts)): ?>
       <?php foreach ($posts as $post): ?>
           <div class="pregunta" style="border: 2px dashed <?php echo htmlspecialchars($post['caracteristica']); ?>">
               <h3>
                   <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo htmlspecialchars($post['id_post']); ?>" class="tema-link">
                       <?php echo htmlspecialchars($post['contenido']); ?>
                   </a>
               </h3>
              
               <div class="postInfo">
                   <p>Tema: <?php echo htmlspecialchars($post['nombre_tema'] ?? 'Tema no especificado'); ?></p>
                   <p>Por: <?php echo htmlspecialchars($post['nombre_usuario'] ?? 'Usuario desconocido'); ?></p>
                   <p>Fecha: <?php echo htmlspecialchars($post['fecha']); ?></p>  
               </div>
               <div class="postInfo">
                   <p>Respuestas: <?php echo htmlspecialchars($post['total_respuestas'] ?? '0'); ?></p>
               </div>
               <div>
                   <p>Últ. mensaje: <?php echo htmlspecialchars($post['autor_ultimo_mensaje'] ?? 'N/D'); ?></p>
                   <p>
                       <?php 
                           $minutos = $post['minutos_transcurridos'] ?? 0;
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
                    $isSaved = $guardadoModel->verificarGuardado($post['id_post'], $_SESSION['usuario']['id_usuario']);
                ?>

                <img src="<?php echo $isSaved ? '/assets/images/save.png' : '/assets/images/nosave.png'; ?>" alt="Guardar" class="save-icon" data-id-post="<?php echo $post['id_post']; ?>" data-id-usuario="<?php echo $_SESSION['usuario']['id_usuario']; ?>" onclick="guardar(this)" />
                <script src="/assets/js/guardar.js"></script>
            </div>
       <?php endforeach; ?>
   <?php else: ?>
       <p class="no-results">No se encontraron posts relacionados con "<?php echo htmlspecialchars($termino); ?>"</p>
   <?php endif; ?>
   
</div>