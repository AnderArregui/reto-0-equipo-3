<div class="general">
    <div class="perfil">
        <?php $usuario = $dataToView["data"]['usuario']; ?>
        <img src="<?php echo $usuario["foto"]; ?>" alt="Foto de perfil" onclick="document.getElementById('fileInput').click();">
        <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="uploadImage(this)">
        <h2 id="nombreUsuario">Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?>!</h2>
        <h3 id="tipoUsuario"><?php if($usuario["tipo"] == "admin"): ?>Administrador<?php else: ?>Usuario<?php endif;?></h3>
        <div class="menuperfil">
            <ul id="menuPerfil">
                <li><a href="javascript:void(0);" onclick='perfil(<?php echo json_encode($usuario); ?>); setActive(this)' >Perfil</a></li> 
                <li><a href="guardados.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'guardados.php' ? 'active' : ''; ?>">Guardados</a></li>
                <li><a href="gestionar-preguntas.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-preguntas.php' ? 'active' : ''; ?>">Gestionar Preguntas</a></li>
                <li><a href="gestionar-respuestas.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gestionar-respuestas.php' ? 'active' : ''; ?>">Gestionar Respuestas</a></li>
            </ul>
        </div>
        <div id="visualizacion"></div>
    </div>
</div>
<script src="/reto-1-equipo-3/php/assets/js/visualizacionperfil.js"></script>
<script src="/reto-1-equipo-3/php/assets/js/cambiarImagen.js"></script>