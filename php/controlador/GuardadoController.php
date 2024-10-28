<?php
class GuardadoController {
    private $guardadoModel;

    public function __construct() {

        $this->guardadoModel = new Guardado();
    }

    public function guardar() {

        $this->guardadoModel->guardar();
    }
}
?>