<?php
    $usuario = $dataToView['data']['usuario'];
    ?><div class="generalPregutar">
    <div class="divDiseno">
        <div class="tituloTema">
            <h1>Modificar Usuario</h1>
        </div>

        <?php 
        $usuario = $dataToView["data"]['usuario'];
        if (isset($usuario)): ?>
        <form class="CrearPregunta" action="index.php?controller=Usuario&action=actualizarUsuario" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>">

            <label for="nombre" class="titulo">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="email" class="titulo">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <label for="rol" class="titulo">Rol:</label>
            <select name="rol" id="rol">
                <option value="admin" <?php echo ($usuario['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                <option value="usuario" <?php echo ($usuario['rol'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
            </select>

            <label for="imagen" class="titulo">Imagen de Perfil:</label>
            <?php if (!empty($usuario['imagen'])): ?>
                <img src="<?php echo htmlspecialchars($usuario['imagen']); ?>" alt="Imagen actual del usuario" style="max-width: 200px;">
            <?php else: ?>
                <p id="noImagen">No hay imagen actual</p>
            <?php endif; ?>

            <button type="submit" class="subir">Guardar Cambios</button>
        </form>
        <?php else: ?>
        <p>No se encontró el usuario especificado.</p>
        <?php endif; ?>
    </div>
</div>
