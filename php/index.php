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


// Ejecutar la acción
$dataToView["data"] = array();
if (method_exists($controller, $_GET["action"])) {
    $dataToView["data"] = $controller->{$_GET["action"]}();
}

// Cargar las vistas (header, contenido, footer) basándonos en el layout
if ($controller->showLayout) {
    require_once "view/layout/header.html.php";
}

require_once "view/" . $_GET["controller"] . "/" . $controller->view . ".html.php";

if ($controller->showLayout) {
    require_once "view/layout/footer.html.php";
}
?>
