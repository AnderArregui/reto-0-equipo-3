<div class="general">
    <div class="container">
        <div class="temasTemas">
            <?php 
            $contador = 0; 
            $temas = $dataToView["data"]['temas'];
            
            if (!empty($temas)):
                foreach ($temas as $tema): 
                    // Saltar la impresión si la característica es "Tema Eliminado"
                    if ($tema['nombre'] === 'Tema Eliminado') {
                        continue;
                    }
                    
                    $imagenTema = $contador < 4 && !empty($tema['imagen']) ? htmlspecialchars($tema['imagen']) : ''; 
                    $colorTema = !empty($tema['caracteristica']) ? htmlspecialchars($tema['caracteristica']) : '';
                    $claseTema = empty($imagenTema) ? 'tema-sin-imagen-color' : '';
            ?>
            <div class="tema-container">
                <a href="index.php?controller=Tema&action=view&id_tema=<?php echo htmlspecialchars($tema['id_tema']); ?>" class="tema-link">
                    <div class="tema <?php echo $claseTema; ?>" <?php if (!empty($colorTema)): ?>data-color="<?php echo $colorTema; ?>"<?php endif; ?>>
                        <?php if (!empty($imagenTema)): ?>
                            <img src="<?php echo $imagenTema; ?>" alt="Imagen de <?php echo htmlspecialchars($tema['nombre']); ?>" class="tema-img">
                        <?php endif; ?>
                        <div class="degradado"></div>
                        <h3><?php echo htmlspecialchars($tema['nombre']); ?></h3>
                    </div>
                </a>
                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] === 'admin'): ?>
                    <div class="accion">
                    <button class="eliminar-tema-btn" data-id="<?php echo htmlspecialchars($tema['id_tema']); ?>">Eliminar</button>
                    <a href="index.php?controller=Tema&action=modificarTema&id_tema=<?php echo htmlspecialchars($tema['id_tema']); ?>" class="modificar-tema-btn">Modificar</a>
                    </div>
                    <?php endif; ?>
            </div>
            <?php
                    $contador++;
                endforeach;
            else: ?>
                <p>No hay temas disponibles.</p>
            <?php endif; ?>
        </div>

        <!-- Modal para opciones de eliminación -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h3>¿Qué acción deseas realizar?</h3>
                <button id="deleteAllBtn">Borrar tema y contenido</button>
                <button id="deleteOnlyBtn">Borrar solo el tema</button>
                <button id="cancelBtn">Cancelar</button>
            </div>
        </div>

        <script src="/reto-1-equipo-3/php/assets/js/degradado.js"></script>
        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] === 'admin'): ?>
        <script>
            document.querySelectorAll('.eliminar-tema-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id_tema = this.getAttribute('data-id');
                    const modal = document.getElementById('deleteModal');
                    modal.style.display = 'block';

                    document.getElementById('deleteAllBtn').onclick = function() {
                        eliminarTema(id_tema, 'si');
                    };

                    document.getElementById('deleteOnlyBtn').onclick = function() {
                        eliminarTema(id_tema, 'no');
                    };

                    document.getElementById('cancelBtn').onclick = function() {
                        modal.style.display = 'none';
                    };
                });
            });

            function eliminarTema(id_tema, borrarContenido) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?controller=Tema&action=eliminarTema';
                
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'id_tema';
                idInput.value = id_tema;
                form.appendChild(idInput);
                
                const borrarInput = document.createElement('input');
                borrarInput.type = 'hidden';
                borrarInput.name = 'borrar_contenido';
                borrarInput.value = borrarContenido;
                form.appendChild(borrarInput);

                document.body.appendChild(form);
                form.submit();
            }

            // Cerrar el modal al hacer clic fuera de él
            window.onclick = function(event) {
                const modal = document.getElementById('deleteModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };
        </script>
        <?php endif; ?>
    </div>
</div>