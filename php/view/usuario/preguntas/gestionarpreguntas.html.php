<?php $data = json_decode(file_get_contents("php://input"), true); ?>

<?php if (!empty($data)): ?>
    <div class="preguntas">
        <?php foreach ($data as $post): ?>
                <div class="pregunta" style="border: 2px dashed #007BFF;"> <!-- Cambia el color si lo deseas -->
                    <h3>
                        <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo $post['id_post']; ?>" class="tema-link">
                            <?php 
                                $maxCaracteres = 120;
                                $contenido = htmlspecialchars($post['contenido']);
                                echo (mb_strlen($contenido) > $maxCaracteres) 
                                    ? mb_substr($contenido, 0, $maxCaracteres) . "..." 
                                    : $contenido; 
                            ?>
                        </a>
                    </h3>

                    <div class="postInfo">
                        <p>Fecha: <?php echo htmlspecialchars($post['fecha']); ?></p>
                    </div>

                    <div class="postInfo">
                        <p><a href="index.php?controller=Post&action=edit&id=<?php echo $post['id_post']?>" class="btn-edit">Editar</a></p>
                        <p><a href="index.php?controller=Post&action=confirmDelete&id=<?php echo $post['id_post']?>" class="btn-danger">Borrar</a></p>
                    </div>
                </div>

        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No has publicado ningún post aún.</p>
<?php endif; ?>
