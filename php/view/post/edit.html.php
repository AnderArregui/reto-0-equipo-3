<div class="general">
    <div class="container">
        <h1 class="titulo-form">Editar post</h1>
        
        <?php 
            $posts = $dataToView["data"]["posts"]; 
            $temas = $dataToView["data"]["temas"];
        ?>

        <form class="form" action="index.php?controller=Post&action=update" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($posts['id_post']); ?>" />

            <div id="visualizacion" class="form-group">
                <label for="contenido" class="form-label">Contenido</label>
                <input type="text" name="contenido" id="contenido" class="form-input" value="<?php echo $posts['contenido']; ?>" />

                <label for="temaSelect" class="form-label">Temas</label>
                <div class="temasSelect">
                    <select name="temaSelect" id="temaSelect">
                        <option value="">-- Selecciona un tema --</option>
                        <?php 
                        if (!empty($temas)) {
                            foreach ($temas as $tema) {
                                $selected = ($tema['id_tema'] == $posts['id_tema']) ? 'selected' : '';
                                echo "<option value='" . $tema['id_tema'] . "' $selected>" . htmlspecialchars($tema['nombre']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay temas disponibles</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <input class="link-modificar" type="submit" value="Guardar" />
                <a class="btn btn-outline-danger" href="index.php?controller=Usuario&action=perfil">Cancelar</a>
            </div>
        </form>
    </div>
</div>
