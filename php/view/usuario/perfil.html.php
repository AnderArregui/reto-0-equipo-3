<div class="general">
    <div class="perfil">
        <!-- Pasamos la informacion del dataToView a la variable usuario, posteriormente ponemos la foto "Si tiene" y desplegamos el menu que nos da el ajax. -->
        <?php $usuario = $dataToView["data"]["usuario"]; ?>
        <img src="<?php echo $usuario['foto']; ?>" alt="Foto de perfil">
        <h2 id="nombreUsuario">Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?>!</h2>
        <h3 id="tipoUsuario"><?php if($usuario["tipo"] == "admin"): ?>Administrador<?php else: ?>Usuario<?php endif;?></h3>
        <div class="menuperfil">
            <ul id="menuPerfil">
                <li><a href="javascript:void(0);" onclick='perfil(<?php echo json_encode($usuario); ?>); setActive(this)' >Perfil</a></li> <!-- Hacemos echo del usuario que tenemos iniciado en este momento en la sesion, el setActive sirve para que salga activo en el menu -->
                <li><a href="guardados.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'guardados.php' ? 'active' : ''; ?>">Guardados</a></li>
                <li><a href="gestionar-preguntas.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-preguntas.php' ? 'active' : ''; ?>">Gestionar Preguntas</a></li>
                <li><a href="gestionar-respuestas.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-respuestas.php' ? 'active' : ''; ?>">Gestionar Respuestas</a></li>
                <li><a href="javascript:void(0);" onclick='gestionarPerfil(); setActive(this)'>Gestionar Perfil</a></li>
            </ul>
        </div>
        <div id="visualizacion">

        </div>
    </div>

</div>
<script src="/reto-1-equipo-3/php/assets/js/visualizacionperfil.js"></script>