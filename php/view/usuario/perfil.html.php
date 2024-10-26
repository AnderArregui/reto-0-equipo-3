<div class="general">
    <div class="perfil">
        <?php $usuario = $dataToView["data"]["usuario"]; ?>
        <img src="<?php echo $usuario['foto']; ?>" alt="Foto de perfil">
        <h2 id="nombreUsuario">Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?>!</h2>
        <h3 id="tipoUsuario"><?php if($usuario["tipo"] == "admin"): ?>Administrador<?php else: ?>Usuario<?php endif;?></h3>
        <div class="menuperfil">
        <ul>
            <li><a href="perfil.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'perfil.php' ? 'active' : ''; ?>">Perfil</a></li>
            <li><a href="guardados.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'guardados.php' ? 'active' : ''; ?>">Guardados</a></li>
            <li><a href="gestionar-preguntas.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-preguntas.php' ? 'active' : ''; ?>">Gestionar Preguntas</a></li>
            <li><a href="gestionar-respuestas.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-respuestas.php' ? 'active' : ''; ?>">Gestionar Respuestas</a></li>
            <li><a href="gestionar-perfil.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-perfil.php' ? 'active' : ''; ?>">Gestionar Perfil</a></li>
        </ul>
        </div>

    </div>
</div>


<!-- <div class="informacion">
               <h1 id="saludo">Hola,  !</h1>
               <h5 id="especialidad">Especialidad: <?php echo htmlspecialchars($usuario['especialidad']); ?></h5>
               <h5 id="añosEmpresa">Años en la empresa: <?php echo htmlspecialchars($usuario['anios_empresa']); ?></h5>
                <h5 id="email">Mail: <?php echo htmlspecialchars($usuario['email']); ?></h5>
                <div class="botones">
                   <button>Guardados</button>
                   <button>Editar</button>
                  <button>Cerrar cuenta</button>
                  <button>Cambiar contraseña</button>

                  
     -->