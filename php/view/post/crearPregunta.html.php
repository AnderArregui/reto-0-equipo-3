<?php
$temas = $dataToView["data"]['temas'];
?>  

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/CrearPregunta.css">
    <title>Crear Pregunta</title>
    <script>
        function toggleTemaCreation() {
            var checkbox = document.getElementById('crear');
            var label = document.querySelector('label[for="crear"]');
            var input = document.getElementById('nuevo_tema');
            var button = document.getElementById('crear_tema_btn');
            
            if (checkbox.checked) {
                label.style.display = 'none';
                input.style.display = 'inline-block';
                button.style.display = 'inline-block';
            } else {
                label.style.display = 'inline-block';
                input.style.display = 'none';
                button.style.display = 'none';
            }
        }
    </script>
</head>
<body>
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
                    <select name="tema" id="tema">
                        <option value="">-- Selecciona un tema --</option> <!-- Opción predeterminada -->
                        <?php
                        if (!empty($temas)) {
                            foreach ($temas as $tema) {
                                echo "<option value='" . $tema['id_tema'] . "'>" . htmlspecialchars($tema['nombre']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay temas disponibles</option>";
                        }
                        ?>
                    </select>
                </div>
               
                <div class="crearTema">
                    <label for="crear">Crear Tema</label>
                    <input type="checkbox" name="crear_tema" id="crear" onchange="toggleTemaCreation()">
                    <input type="text" name="nuevo_tema" id="nuevo_tema" placeholder="Nombre del nuevo tema" style="display: none;">
                    <button type="submit" name="action" value="crearTema" id="crear_tema_btn" style="display: none;">Crear Tema</button>
                </div>

                <div class="CrearPregunta">
                    <h1>Formula la pregunta</h1>
                    <textarea name="pregunta" id="pregunta" placeholder="Escribe la pregunta aquí" required></textarea> 
                </div>
                        
                <input type="submit" name="action" value="subirPregunta" class="subir">
            </div>
        </div>
    </form>
</body>
</html>
