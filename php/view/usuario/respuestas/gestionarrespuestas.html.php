
<?php $respuestas = json_decode(file_get_contents("php://input"), true); ?>

<?php if (!empty($respuestas)): ?>
    <div class="admin-respuesta">
        <?php foreach ($respuestas as $respuesta): ?>
            <div class="respuestasUsuario">
                <div class="respuesta" style="width:90%">
                    <a href="index.php?controller=Post&action=respuestas&id_post=<?php echo $respuesta['id_post']; ?>">
                        <p class="contenidoRespuesta"><?php echo htmlspecialchars($respuesta['contenido']); ?></p>
                    </a>
                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($respuesta['fecha']); ?></p>
                    <a href="index.php?controller=Respuesta&action=edit&id=<?php echo $respuesta['id_respuesta'] ?? ''; ?>" class="link-modificar" >Editar</a>
                    <form action="index.php?controller=Usuario&action=eliminarRespuesta" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta respuesta?');">
                        <input type="hidden" name="id_respuesta" value="<?php echo $respuesta['id_respuesta']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Este usuario no tiene respuestas.</p>
<?php endif; ?>

