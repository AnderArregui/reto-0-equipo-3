<?php 
session_start();


require_once "config/config.php";
require_once "models/Usuario.php";
require_once "models/Post.php";
require_once "models/Tema.php";

if (!isset($_GET["controller"])) {
    $_GET["controller"] = "Usuario";
}
if (!isset($_GET["action"])) {
    $_GET["action"] = "login";
}


$controller_path = "controlador/" . $_GET["controller"] . "Controller.php";

if (!file_exists($controller_path)) {
    $controller_path = "controlador/UsuarioController.php";
}

require_once $controller_path;
$controllerName = $_GET["controller"] . "Controller";

$controller = new $controllerName($db);

if (isset($_SESSION['usuario'])) {
   
    $id_tema = isset($_GET['id_tema']) ? $_GET['id_tema'] : 1;

    if (method_exists($controller, 'init')) {
        $dataToView["data"] = $controller->init($id_tema);
    }
} else {

    $dataToView["data"] = [];
}



if (method_exists($controller, $_GET["action"])) {
    $dataToView["actionData"] = $controller->{$_GET["action"]}();
}

if ($controller->showLayout) {
    require_once "view/layout/header.html.php";
}

require_once "view/" . $_GET["controller"] . "/" . $controller->view . ".html.php";

if ($controller->showLayout) {
    require_once "view/layout/footer.html.php";
}
?>
