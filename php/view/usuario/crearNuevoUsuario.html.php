<div class="container-general">
    <div class="crear-usuario-form-container">
        <h1 class="crear-usuario-title">Crear Nuevo Usuario</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="crear-usuario-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=Usuario&action=crearNuevoUsuario" method="POST" class="crear-usuario-form" enctype="multipart/form-data">
            <div class="crear-usuario-form-group">
                <label for="nombre" class="crear-usuario-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="crear-usuario-input">
            </div>
            <div class="crear-usuario-form-group">
                <label for="email" class="crear-usuario-label">Email:</label>
                <input type="email" id="email" name="email" required class="crear-usuario-input">
            </div>
            <div class="crear-usuario-form-group">
                <label for="contrasena" class="crear-usuario-label">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required class="crear-usuario-input">
            </div>
            <div class="crear-usuario-form-group">
            <label for="especialidad" class="modificar-usuario-label">Especialidad:</label>
                <select id="especialidad" name="especialidad" class="modificar-usuario-select">
                <option value="Propulsion" >Propulsion</option>
                <option value="Aerodinamica">Aerodinamica</option>
                <option value="Seguridad" >Seguridad</option>
                <option value="Materiales" >Materiales</option>
                <option value="Innovacion">Innovacion</option>
                <option value="Optimizacion" >Optimizacion</option>
                <option value="Eficiencia">Eficiencia</option>
                <option value="Colaboracion" >Colaboracion</option>
                </select>  
        
        </div>
            <div class="crear-usuario-form-group">
                <label for="anios_empresa" class="crear-usuario-label">Años en la empresa:</label>
                <input type="number" id="anios_empresa" name="anios_empresa" min="0" class="crear-usuario-input">
            </div>
            <div class="crear-usuario-form-group">
                <label for="tipo" class="crear-usuario-label">Tipo de usuario:</label>
                <select id="tipo" name="tipo" class="crear-usuario-select">
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <div class="crear-usuario-form-group">
                <label for="foto" class="crear-usuario-label">Foto de perfil:</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="crear-usuario-input">
            </div>
            <div class="crear-usuario-form-group">
                <button type="submit" class="crear-usuario-button">Crear Usuario</button>
            </div>
        </form>
    </div>
</div>