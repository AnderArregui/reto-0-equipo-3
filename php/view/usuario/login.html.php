<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/style.css"> 
    <title>Iniciar Sesión</title>
</head>
<body>
<div class="logo">
        <img src="assets/images/logo.png" alt="logo">
    </div>

    <form id="loginForm" method="post" action="index.php">
    <h1 id="iniSes">Iniciar sesión</h1>
    <div class="formulario">
        <h1 class="apartado">Usuario</h1>
        <input type="text" name="username" id="username" required autocomplete="off">
        <h1  class="apartado">Contraseña</h1>
        <input type="password" name="password" id="password" required autocomplete="off">
        <div class="botones">
    <button class="cssbuttons-io" type="submit">
        <span>Entrar</span>
    </button>
</div>
    
</form>
</body>
</html>
