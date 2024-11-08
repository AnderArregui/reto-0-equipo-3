<div class="generalPregutar">
        <div class="divDiseno">
            <div class="tituloTema">
                <h1>Modificar Tema</h1>
            </div>

            <?php 
            $tema = $dataToView["data"]['tema'];
            if (isset($tema)): ?>
            <form class="CrearPregunta" action="index.php?controller=Tema&action=actualizarTema" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_tema" value="<?php echo htmlspecialchars($tema['id_tema']); ?>">

                <label for="nombre" class="titulo">Nombre del Tema:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($tema['nombre']); ?>" required>


                <label for="caracteristica" class="color-label">
                    <p id="noImagen">Característica:</p>
                    <div class="color-picker" id="colorDisplay"></div>
                    <input type="color" id="caracteristica" name="caracteristica" onchange="subirColor(this.value)">
                    <script>
                        function updateColorDisplay(color) {
                        document.getElementById('colorDisplay').style.backgroundColor = color;
                    }
                    </script>

                </label>


                <label for="imagen" class="titulo">Imagen</label>
                <?php if (!empty($tema['imagen'])): ?>
                    <img src="<?php echo htmlspecialchars($tema['imagen']); ?>" alt="Imagen actual del tema" style="max-width: 200px;">
                <?php else: ?>
                    <p id="noImagen">No hay imagen actual</p>
                <?php endif; ?>

                <button type="submit" class="subir">Guardar Cambios</button>
            </form>
            <?php else: ?>
            <p>No se encontró el tema especificado.</p>
            <?php endif; ?>
        </div>
    </div>