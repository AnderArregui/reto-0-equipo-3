<div class="container-general">
    <div class="container-sombra">
        <h1 class="tituloTema">Crear Nuevo Usuario</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mensaje"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=Usuario&action=crearNuevoUsuario" method="POST" enctype="multipart/form-data" id="formContacto">
            <div class="nombreContacto">
                <label for="nombre" class="titulo">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="emailContacto">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="asuntoContacto">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <div class="espeSelect">
                <label for="especialidad">Especialidad:</label>
                <select id="espeSelect" name="especialidad">
                    <option value="Propulsion">Propulsion</option>
                    <option value="Aerodinamica">Aerodinamica</option>
                    <option value="Seguridad">Seguridad</option>
                    <option value="Materiales">Materiales</option>
                    <option value="Innovacion">Innovacion</option>
                    <option value="Optimizacion">Optimizacion</option>
                    <option value="Eficiencia">Eficiencia</option>
                    <option value="Colaboracion">Colaboracion</option>
                </select>
            </div>

            <div class="asuntoContacto">
                <label for="anios_empresa">Años en la empresa:</label>
                <input type="number" id="anios_empresa" name="anios_empresa" min="0">
            </div>

            <div class="espeSelect">
                <label for="tipo">Tipo de usuario:</label>
                <select id="espeSelect" name="tipo">
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <div class="asuntoContacto">
                <label for="foto" class="custom-file-label">Subir foto de perfil</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="custom-file-input">
            </div>
            <span id="file-name" class="file-name-display">No se ha seleccionado ningún archivo</span>
            <script>
                document.getElementById("foto").addEventListener("change", function() {
                    const fileName = this.files[0] ? this.files[0].name : "No se ha seleccionado ningún archivo";
                    document.getElementById("file-name").textContent = fileName;
                });
            </script>

            <div class="CrearPregunta">
                <button type="submit" class="subir">Crear Usuario</button>
            </div>
        </form>
    </div>
</div>
