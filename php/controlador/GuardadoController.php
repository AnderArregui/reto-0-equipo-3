<?php

require_once "models/Usuario.php";

class GuardadoController {
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

        $nombre_usuario = $_SESSION['usuario'];
        $usuario = $this->usuarioModel->obtenerPorNombre($nombre_usuario);

        return [
            'usuario' => $usuario
        ];
    }
}
?>