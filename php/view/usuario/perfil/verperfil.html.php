<?php
// Capturar y decodificar el JSON recibido
$data = json_decode(file_get_contents("php://input"), true);

if ($data): ?>
    <form id="formularioUsuario">
        <h2>Perfil de Usuario</h2>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($data['nombre']); ?>" readonly>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" value="<?php echo htmlspecialchars($data['contrasena']); ?>"readonly>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" value="<?php echo htmlspecialchars($data['especialidad']); ?>" readonly>

        <label for="tipo">Tipo de Usuario:</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo $data['tipo'] == 'admin' ? 'Administrador' : 'Usuario'; ?>" readonly>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" readonly>

        <label for="aniosEmpresa">Años en la Empresa:</label>
        <input type="number" id="aniosEmpresa" name="aniosEmpresa" value="<?php echo htmlspecialchars($data['anios_empresa']); ?>" readonly>

    </form>
<?php
else:
    echo "Error: No se recibieron datos del usuario.";
endif;
