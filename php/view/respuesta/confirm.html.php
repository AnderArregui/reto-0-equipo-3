<div class="general">
    <div class="container">
    <form class="form" action="index.php?controller=Respuesta&action=delete" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
        <div class="alert alert-warning">
            <h2>¿Estas seguro que desas eliminar esta Respuesta?</h2>
            <br>
            <i><?php echo $_GET['id']; ?></i>
        </div>
        <input type="submit" value="Eliminar" class="btn-delete"/>
        <a class="btn-cancel" href="index.php?controller=Usuario&action=perfil">Cancelar</a>
    </form>
    </div>
</div>