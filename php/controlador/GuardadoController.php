<?php
require_once "models/Guardado.php";
class GuardadoController {

    public $view = "guardar";
    public $showLayout = true;


    private $guardadoModel;

    public function __construct() {

        $this->guardadoModel = new Guardado();
    }

    public function guardar() {

        $this->guardadoModel->guardar();
    }
}
?>