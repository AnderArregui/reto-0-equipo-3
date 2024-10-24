<?php

class PostController {
    public $view;
    public $showLayout = true; // Asegurarte de que esta propiedad esté inicializada

    public function __construct() {
        $this->view = "Post"; // Vista por defecto
    }

    public function crearPregunta() {
        // Cambiamos la vista a la de creación de preguntas
        $this->view = "crearPregunta";
        return []; // Devolvemos un array vacío o los datos que necesites para la vista
    }
}
