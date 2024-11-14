<div class="general">
    <div class="container">
        <h1>Editar respuesta</h1>

        <?php 
            $respuesta = $dataToView["data"]["respuesta"]; 
        ?>

        <form class="form" action="index.php?controller=Respuesta&action=update" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($respuesta['id_respuesta']); ?>" />
            <div id="visualizacion">
                <label for="contenido">Contenido</label>
                <input type="text" name="contenido" id="contenido" value="<?php echo htmlspecialchars($respuesta['contenido']); ?>" />

            </div>

            <input class="link-modificar" type="submit" value="Guardar" />
            <a class="btn btn-outline-danger" href="index.php?controller=Usuario&action=perfil">Cancelar</a>
        </form>
    </div>
</div>
