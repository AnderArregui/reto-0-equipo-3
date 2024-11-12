<div class="general">
    <div class="container">
        <form class="form" action="index.php?controller=Post&action=delete" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            
            <!-- Alerta de confirmación -->
            <div class="alert alert-warning">
                <h2 class="alert-title">¿Estás seguro de que deseas eliminar este post?</h2>
                <p>Recuerda que también se eliminarán las respuestas asociadas.</p>
                <p><i>ID del post: <?php echo $_GET['id']; ?></i></p>
            </div>

            <!-- Botones de acción -->
            <div class="form-actions">
                <input type="submit" value="Eliminar" class="btn-delete" />
                <a class="btn-cancel" href="index.php?controller=Usuario&action=perfil">Cancelar</a>
            </div>
        </form>
    </div>
</div>
