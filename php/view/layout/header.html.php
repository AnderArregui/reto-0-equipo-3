<!-- header.html.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/headerFooter.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/inicio.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/perfil.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/temas.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/contacto.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/CrearPregunta.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/resultado.css">
    <link rel="stylesheet" href="/reto-1-equipo-3/php/assets/css/mostrarUsuario.css">

    <title>Página de Inicio</title>
    <script>
        function toggleTemaCreation() {
            var checkbox = document.getElementById('crear');
            var label = document.querySelector('label[for="crear"]');
            var input = document.getElementById('nuevo_tema');
            var button = document.getElementById('crear_tema_btn');

            if (checkbox.checked) {
                label.style.display = 'none';
                input.style.display = 'inline-block';
                button.style.display = 'inline-block';
            } else {
                label.style.display = 'inline-block';
                input.style.display = 'none';
                button.style.display = 'none';
            }
        }
    </script>
    <script>
        function toggleMenu() {
            var navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }

        function closeMenu() {
            var navLinks = document.querySelector('.nav-links');
            navLinks.classList.remove('active');
        }
    </script>
</head>
<body>
<nav>
    <a href="index.php?controller=Inicio&action=inicio">
        <img src="/reto-1-equipo-3/php/assets/images/logo.png" alt="logo">
    </a>
    
    <ul class="nav-links">
        <div class="orden-control">
            <?php
            $paginaNav = '';
            if (isset($_GET['controller']) && isset($_GET['action'])) {
                if ($_GET['controller'] == 'Tema' && $_GET['action'] == 'list') {
                    $paginaNav = 'temas';
                } elseif ($_GET['controller'] == 'Inicio' && $_GET['action'] == 'contacto') {
                    $paginaNav = 'contacto';
                } elseif ($_GET['controller'] == 'Usuario' && $_GET['action'] == 'mostrarUsuario') {
                    $paginaNav = 'Usuarios';
                } else {
                    $paginaNav = '';
                }
            }
            ?>
            <li><a href="index.php?controller=Tema&action=list" class="<?php echo ($paginaNav == 'temas') ? 'active' : ''; ?>">Temas</a></li>
            <li><a href="index.php?controller=Usuario&action=mostrarUsuario" class="<?php echo ($paginaNav == 'historial') ? 'active' : ''; ?>">Usuarios</a></li>
            <li><a href="index.php?controller=Inicio&action=contacto" class="<?php echo ($paginaNav == 'contacto') ? 'active' : ''; ?>">Contacto</a></li>
        </div>
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
    <span class="modo"></span>
    <div class="profile-icon">
        <a href="index.php?controller=Usuario&action=perfil">
            <?php $fotoPerfil = $_SESSION['usuario']['foto']; ?>
            <img src="<?php echo $fotoPerfil; ?>" alt="Perfil">
        </a>
    </div>

</nav>


        
