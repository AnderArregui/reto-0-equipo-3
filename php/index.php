<?php 
session_start();

// Importar configuraciones y modelos
require_once "config/config.php";
require_once "models/Usuario.php";
require_once "models/Post.php";
require_once "models/Tema.php";

// Si no se especifica controlador y acción, cargamos los predeterminados
if (!isset($_GET["controller"])) $_GET["controller"] = "Usuario";
if (!isset($_GET["action"])) $_GET["action"] = "login";

// Ruta del controlador
$controller_path = "controlador/" . $_GET["controller"] . "Controller.php";

// Verificamos que el controlador exista, si no, se carga uno por defecto
if (!file_exists($controller_path)) {
    $controller_path = "controlador/UsuarioController.php";
}

require_once $controller_path;
$controllerName = $_GET["controller"] . "Controller";

// Crear una instancia del controlador
$controller = new $controllerName($db);

// Verificar si el usuario ha iniciado sesión antes de intentar llamar a init
if (isset($_SESSION['usuario'])) {
    // Obtener el ID del tema, usa 1 como valor por defecto si no está definido
    $id_tema = isset($_GET['id_tema']) ? $_GET['id_tema'] : 1;

    // Solo ejecutar init si el método existe en el controlador
    if (method_exists($controller, 'init')) {
        $dataToView["data"] = $controller->init($id_tema);
    }
} else {
    // Si no hay sesión de usuario, no ejecutamos init y seguimos con el login
    $dataToView["data"] = [];
}

// Ejecutar la acción si existe
if (method_exists($controller, $_GET["action"])) {
    $dataToView["actionData"] = $controller->{$_GET["action"]}(); // Cambia el nombre para no sobrescribir
}

// Cargar las vistas (header, contenido, footer) basándonos en el layout
if ($controller->showLayout) {
    require_once "view/layout/header.html.php";
}

// Aquí se debe cargar la vista correcta. Usa la acción y no el controlador para acceder a la vista.
require_once "view/" . $_GET["controller"] . "/" . $controller->view . ".html.php";

if ($controller->showLayout) {
    require_once "view/layout/footer.html.php";
}

?>