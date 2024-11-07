<div class="container">
    <?php 
    $id_post = $_GET['id_post'] ?? null;

    if ($id_post): 
        $post = $dataToView['data']['post']; 
        $respuestas = $dataToView['data']['respuestas'];
        $temas = $dataToView['data']['tema'];
        $usuario = $dataToView['data']['usuario'];
        $guardado = $dataToView['data']['guardado'];
        $usuarioPost = $dataToView['data']['usuarioPost'];

        if ($post): ?>
            <div class="preguntaBlanca" style="border: 2px dashed <?php echo htmlspecialchars($temas['caracteristica']); ?>">
                <h3><?php echo htmlspecialchars($post['contenido']); ?></h3>
                <div class="postInfo">
                <p>Tema: <?php echo htmlspecialchars($temas['nombre_tema'] ?? 'Tema no especificado'); ?></p>
                    <p>Por: <?php echo htmlspecialchars($usuarioPost['nombre_usuario'] ?? 'Usuario desconocido'); ?></p>
                <p>Fecha: <?php echo htmlspecialchars($post['fecha']); ?></p>
                </div>
                <img src="<?php echo $guardado ? '/reto-1-equipo-3/php/assets/images/save.png' : '/reto-1-equipo-3/php/assets/images/nosave.png'; ?>" alt="Guardar" class="save-icon" data-id-post="<?php echo $post['id_post']; ?>" data-id-usuario="<?php echo $_SESSION['usuario']['id_usuario']; ?>" onclick="guardar(this)" />

            </div>
            <form action="/reto-1-equipo-3/php/index.php?controller=Post&action=publicarRespuesta" method="POST" enctype="multipart/form-data" class="respuestaForm">
                <input type="hidden" name="id_post" value="<?php echo htmlspecialchars($id_post); ?>">
                <input type="text" name="contenido" placeholder="Postea tu respuesta" required></input>
                <div class="file-input-container">
                    <input type="file" id="media" name="media" accept="image/*,video/*" class="file-input">
                    <label for="media" class="custom-file-label">
                        <img src="/reto-1-equipo-3/php/assets/images/archivo.png" alt="Adjuntar archivo" class="file-icon">
                    </label>
                </div>
                <button type="submit" class="submit-button">Responder</button>
            </form>

            <?php if (!empty($respuestas)): ?>
    <?php foreach ($respuestas as $respuesta): ?>
        <div class="respuesta">
            
            <div class="respuestaInfo">
                <a href="index.php?controller=Usuario&action=usuarioindividual&id_usuario=<?php echo $respuesta['id_usuario']; ?>">
                <img src="<?php echo htmlspecialchars($respuesta['foto_usuario']) ?>"  alt="Foto de <?php echo htmlspecialchars($respuesta['nombre_usuario']); ?>" class="foto-usuario">
                
                <div class="postInfo">
                    <p><strong><?php echo htmlspecialchars($respuesta['nombre_usuario']); ?></strong></a> <?php echo htmlspecialchars($respuesta['especialidad_usuario']); ?></p>
                    <p id="contenido"><?php echo htmlspecialchars($respuesta['contenido']); ?></p>
                </div>
            </div>  
            <?php if ($respuesta['ruta_media']): ?>
                <p><strong>Adjunto:</strong></p>
                <?php if (strpos($respuesta['ruta_media'], '.mp4') !== false || strpos($respuesta['ruta_media'], '.webm') !== false || strpos($respuesta['ruta_media'], '.ogg') !== false): ?>
                    <video controls style="max-width: 100%; max-height: 200px;">
                        <source src="<?php echo htmlspecialchars($respuesta['ruta_media']); ?>" type="video/mp4">
                        Tu navegador no soporta el video.
                    </video>
                <?php else: ?>
                    <img src="<?php echo htmlspecialchars($respuesta['ruta_media']); ?>" alt="Imagen adjunta" style="max-width: 100%; max-height: 200px; height: auto;">
                <?php endif; ?>
            <?php endif; ?>
            <div class="respuestaDerecha">
            <div class="postInfo">
            <p>Fecha: <?php echo htmlspecialchars($respuesta['fecha']); ?></p>
            <p>Likes: <span class="like-count"><?php echo htmlspecialchars($respuesta['likes']); ?></span></p>
            </div>

            <div class="postInfo">
    <img src="<?php echo $respuesta['liked_by_user'] ? '/reto-1-equipo-3/php/assets/images/like.png' : '/reto-1-equipo-3/php/assets/images/nolike.png'; ?>" alt="Like" 
        class="like-icon" 
        data-id-respuesta="<?php echo $respuesta['id_respuesta']; ?>" 
        data-id-usuario="<?php echo $_SESSION['usuario']['id_usuario']; ?>" 
        data-liked="<?php echo $respuesta['liked_by_user'] ? 'true' : 'false'; ?>" 
        onclick="like(this)" />
</div>

        </div>
                </div>
        <script src="/reto-1-equipo-3/php/assets/js/like.js"></script>
    <?php endforeach; ?>
<?php else: ?>
    <p id="sinRespuestas">No hay respuestas para este post.</p>
<?php endif; ?>

        <?php else: ?>
            <p>Post no encontrado.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>ID de post no especificado.</p>
    <?php endif; ?>
    <script src="/reto-1-equipo-3/php/assets/js/guardar.js"></script>


</div>
