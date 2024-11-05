<?php

require_once "models/Usuario.php";
require_once "models/Guardado.php";

class GuardadoController {

    public $view = "guardar";
    public $showLayout = true;


    private $guardadoModel;
    public $usuarioModel;

    public function __construct() {

        $this->guardadoModel = new Guardado();
        $this->usuarioModel = new Usuario();
    }

    public function guardar() {

        $this->guardadoModel->guardar();

    }

    public function init() {

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $usuario = $_SESSION['usuario'];

        return [
            'usuario' => $usuario
        ];
    }
}
?>