<?php
require_once "models/Tema.php";
require_once "models/Post.php";

class InicioController {
    public $showLayout = true;
    public $view = 'inicio';

    private $temaModel;
    private $postModel;

    public function __construct($db) {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../index.php");
            exit();
        }

        $this->temaModel = new Tema($db);
        $this->postModel = new Post($db);
    }

    public function getThemes() {

        return $this->temaModel->obtenerTodos();
    }

    public function getAllPosts() {
        return $this->postModel->obtenerTodos();
    }

    public function init($id_tema) {
       
        $temas = $this->getThemes();
        $preguntas = $this->getAllPosts(); // Cambia para obtener todas las preguntas
        
        return [
            'temas' => $temas,   // Asigna los temas a la clave 'temas'
            'preguntas' => $preguntas // Asigna las preguntas a la clave 'preguntas'
        ]; // Devuelve temas y preguntas
    }
    
}
?>
