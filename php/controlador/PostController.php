<?php

class PostController {
    public $view;
    public $showLayout = true; 

    public function __construct() {
        $this->view = "Post"; 
    }

    public function crearPregunta() {
      
        $this->view = "crearPregunta";
        return [];
    }
}
