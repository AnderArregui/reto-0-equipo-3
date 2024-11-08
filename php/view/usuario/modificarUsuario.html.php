<?php
    $usuario = $dataToView['data']['usuario'];
    ?>
<div class="container-general">
    <div class="modificar-usuario-form-container">
        <h1 class="modificar-usuario-title">Modificar Usuario</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="modificar-usuario-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=Usuario&action=actualizarUsuario" method="POST" class="modificar-usuario-form" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
            
            <div class="modificar-usuario-form-group">
                <label for="nombre" class="modificar-usuario-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required class="modificar-usuario-input">
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="email" class="modificar-usuario-label">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required class="modificar-usuario-input">
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="especialidad" class="modificar-usuario-label">Especialidad:</label>
                <select id="especialidad" name="especialidad" class="modificar-usuario-select">
                <option value="Propulsion" <?php echo $usuario['especialidad'] === ' propulsion' ? 'selected' : ''; ?>> Propulsion</option>
                <option value="Propulsion" <?php echo $usuario['especialidad'] === 'Propulsion' ? 'selected' : ''; ?>>Propulsion</option>
                <option value="Aerodinamica" <?php echo $usuario['especialidad'] === 'Aerodinamica' ? 'selected' : ''; ?>>Aerodinamica</option>
                <option value="Seguridad" <?php echo $usuario['especialidad'] === 'Seguridad' ? 'selected' : ''; ?>>Seguridad</option>
                <option value="Materiales" <?php echo $usuario['especialidad'] === 'Materiales' ? 'selected' : ''; ?>>Materiales</option>
                <option value="Innovacion" <?php echo $usuario['especialidad'] === 'Innovacion' ? 'selected' : ''; ?>>Innovacion</option>
                <option value="Optimizacion" <?php echo $usuario['especialidad'] === 'Optimizacion' ? 'selected' : ''; ?>>Optimizacion</option>
                <option value="Eficiencia" <?php echo $usuario['especialidad'] === 'Eficiencia' ? 'selected' : ''; ?>>Eficiencia</option>
                <option value="Colaboracion" <?php echo $usuario['especialidad'] === 'Colaboracion' ? 'selected' : ''; ?>>Colaboracion</option>
                </select>
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="anios_empresa" class="modificar-usuario-label">Años en la empresa:</label>
                <input type="number" id="anios_empresa" name="anios_empresa" value="<?php echo htmlspecialchars($usuario['anios_empresa']); ?>" min="0" class="modificar-usuario-input">
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="tipo" class="modificar-usuario-label">Tipo de usuario:</label>
                <select id="tipo" name="tipo" class="modificar-usuario-select">
                    <option value="usuario" <?php echo $usuario['tipo'] === 'usuario' ? 'selected' : ''; ?>>Usuario</option>
                    <option value="admin" <?php echo $usuario['tipo'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                </select>
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="nueva_contrasena" class="modificar-usuario-label">Nueva Contraseña:</label>
                <input type="password" id="nueva_contrasena" name="nueva_contrasena" class="modificar-usuario-input">
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="confirmar_contrasena" class="modificar-usuario-label">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" class="modificar-usuario-input">
            </div>
            
            <div class="modificar-usuario-form-group">
                <label for="foto" class="modificar-usuario-label">Foto de perfil:</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="modificar-usuario-input">
            </div>
            
            <div class="modificar-usuario-form-group">
                <button type="submit" class="modificar-usuario-button">Actualizar Usuario</button>
            </div>
        </form>
    </div>
</div>