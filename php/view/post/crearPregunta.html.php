<?php
$temas = isset($dataToView['data']['temas']) ? $dataToView['data']['temas'] : [];
$tema_seleccionado = isset($_SESSION['tema_seleccionado']) ? $_SESSION['tema_seleccionado'] : null;
unset($_SESSION['tema_seleccionado']);
?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="mensaje"><?php echo $_SESSION['mensaje']; ?></div>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>

<form action="index.php?controller=Post&action=crearPreguntas" method="POST">
    <div class="generalPregutar">   
        <div class="divDiseno">
            <div class="tituloTema">
                <h1>Elige el tema al que pertenece</h1>
            </div>
            <div class="temasSelect">
                <select name="temaSelect" id="temaSelect">
                    <option value="">-- Selecciona un tema --</option>
                    <?php
                    if (!empty($temas)) {
                        foreach ($temas as $tema) {
                            $selected = ($tema_seleccionado == $tema['id_tema']) ? 'selected' : '';
                            echo "<option value='" . $tema['id_tema'] . "' " . $selected . ">" . htmlspecialchars($tema['nombre']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay temas disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="crearTema">
                <label for="crear">Crear Tema</label>
                <input type="checkbox" name="crear_tema" id="crear" onchange="cajaTema()">
                <input type="text" name="nuevo_tema" id="nuevo_tema" placeholder="Nombre del nuevo tema" style="display: none;">
            </div>

            <div class="CrearPregunta">
                <h1>Formula la pregunta</h1>
                <textarea name="pregunta" id="pregunta" placeholder="Escribe la pregunta aquí" required></textarea> 
            </div>
        
            <input type="submit" name="action" value="Formular Pregunta" class="subir">
            
        </div>
    </div>
</form>
<script src="/reto-1-equipo-3/php/assets/js/cajaTema.js"></script>