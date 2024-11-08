<div class="result-grid">
       
        <?php 
        $usuarios = $dataToView['data']['usuarios'];
        if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $usuario): 
                $imagenUsuario = !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : '';
                $claseUsuario = empty($imagenUsuario) ? 'usuario-sin-imagen-color' : ''; 
                ?>
                <a href="index.php?controller=Usuario&action=usuarioindividual&id_usuario=<?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>" class="usuario-link">
                    <div class="usuario-item <?php echo $claseUsuario; ?>">
                        <?php if (!empty($imagenUsuario)): ?>
                            <img src="<?php echo $imagenUsuario; ?>" alt="Imagen de <?php echo htmlspecialchars($usuario['nombre'] ?? 'Usuario desconocido'); ?>" class="usuario-img">
                        <?php endif; ?>
                        <div class="nombre">
                            <h3><?php echo htmlspecialchars($usuario['nombre'] ?? 'Nombre no disponible'); ?></h3>
                        </div>
                        <p>Email: <?php echo htmlspecialchars($usuario['email'] ?? 'Email no disponible'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron usuarios.</p>
        <?php endif; ?>
        <?php if ($_SESSION['usuario']['tipo'] === 'admin' ): ?>
        <div class="crearUsuario">
            <a href="index.php?controller=Usuario&action=crearNuevoUsuario">Crear Usuario</a>
        </div>
        <?php endif; ?>

    </div>
