<!-- header.html.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/headerFooter.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/inicio.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/perfil.css">
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
            <input type="text">
            <img src="/reto-1-equipo-3/php/assets/images/search.svg" alt="Lupa" class="search-icon">
        </div>
        <div class="burger">
            <span class="material-symbols-outlined">menu</span>
        </div>

        <div class="profile-icon">
            <a href="index.php?controller=Usuario&action=perfil"><img src="/reto-1-equipo-3/php/assets/images/admin_blanco-05.png" alt="Perfil"></a>
        </div>
    </nav>
