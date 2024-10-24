<?php
// Asumiendo que $temas ya está definido y es un array
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/CrearPregunta.css">
    <title>Crear Pregunta</title>
</head>
<body>
    <form action="index.php?controller=Post&action=crearPreguntas" method="POST">
        <div class="generalPregutar">   
            <div class="divDiseno">
                <div class="CrearPregunta">
                    <h1>Formula la pregunta</h1>
                    <textarea name="pregunta" id="pregunta" placeholder="Escribe la pregunta aquí" required></textarea> 
                </div>

                <div class="tituloTema">
                    <h1>Elige el tema al que pertenece</h1>
                </div>

                <div class="temasSelect">
                    <select name="tema" id="tema">
                        <?php
                        // Verifica si hay temas para mostrar
                        if (!empty($temas)) {
                            foreach ($temas as $tema) {
                                echo "<option value='" . $tema['id_tema'] . "'>" . htmlspecialchars($tema['nombre']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay temas disponibles</option>";
                        }
                        ?>
                    </select>
                   
                    <div class="crearTema">
                        <label for="crear">Crear Tema</label>
                        <input type="checkbox" name="crear_tema" id="crear">
                        <input type="text" name="nuevo_tema" placeholder="Nombre del nuevo tema">
                    </div>

                    <input type="submit" value="Subir pregunta" class="subir">
                </div>
            </div>
        </div>
    </form>
</body>
</html>