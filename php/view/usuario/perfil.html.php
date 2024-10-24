 <div class="general">

     <?php if (isset($dataToView["data"]["usuario"])): ?>
         <?php $usuario = $dataToView["data"]["usuario"]; ?>

            <div class="informacion">
               <h1 id="saludo">Hola, <?php echo htmlspecialchars($usuario['nombre']); ?> !</h1>
               <h5 id="especialidad">Especialidad: <?php echo htmlspecialchars($usuario['especialidad']); ?></h5>
               <h5 id="añosEmpresa">Años en la empresa: <?php echo htmlspecialchars($usuario['anios_empresa']); ?></h5>
                <h5 id="email">Mail: <?php echo htmlspecialchars($usuario['email']); ?></h5>
                <div class="botones">
                   <button>Guardados</button>
                   <button>Editar</button>
                  <button>Cerrar cuenta</button>
                  <button>Cambiar contraseña</button>
             </div>
         </div>
     <?php else: ?>
         <p>No se encontraron datos del usuario.</p>
     <?php endif; ?>
        <div class="foto">
            <img src="usuario.png" alt="">
        </div>

 </div>