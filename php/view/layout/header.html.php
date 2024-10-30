<!-- header.html.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/headerFooter.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/inicio.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/temas.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/contacto.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/CrearPregunta.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/resultado.css">
    <title>Página de Inicio</title>
</head>
<body>
    <nav>
        <a href="index.php?controller=Inicio&action=inicio"><img src="/reto-1-equipo-3/php/assets/images/logo.png" alt="logo"></a>
        <ul class="nav-links">
            <li><a href="index.php?controller=Tema&action=list">Temas</a></li>
            <li><a href="#">Historial</a></li>
            <li><a href="index.php?controller=Inicio&action=contacto">Contacto</a></li>
        </ul>
        <div class="search-container">
    <form action="index.php" method="GET">
        <input type="hidden" name="controller" value="Resultado">
        <input type="hidden" name="action" value="buscar">
        <input type="text" name="termino" placeholder="Buscar..." required>
        <button type="submit">
            <img src="/reto-1-equipo-3/php/assets/images/search.svg" alt="Lupa" class="search-icon">
        </button>
    </form>
</div>

        <div class="profile-icon">
            <a href="index.php?controller=Usuario&action=perfil">
                <?php 
                $elUsuario = $dataToView['data']['usuario'];
                $fotoPerfil = isset($elUsuario['foto_perfil']) && !empty($elUsuario['foto_perfil']) 
                    ? htmlspecialchars($elUsuario['foto_perfil']) 
                    : '';
                ?>
                <img src="<?php echo $fotoPerfil; ?>" alt="Perfil">
            </a>
        </div>

    </nav>

        
