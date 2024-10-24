<?php
require_once "models/Tema.php";
require_once "models/Post.php";

class TemaController {
    public $showLayout = true;
    public $view = 'list';

    private $temaModel;
    private $postModel;

    public function __construct( ) {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../index.php");
            exit();
        }

        // Inicializa los modelos y pasa la conexión a la base de datos
        $this->temaModel = new Tema();
        $this->postModel = new Post();
    }

    // Método para obtener temas
    public function getThemes() {
        return $this->temaModel->obtenerTodos();
    }

    // Método para obtener publicaciones
    public function getAllPosts() {
        return $this->postModel->obtenerTodos(); // Asegúrate de tener este método en tu modelo Post
    }

    public function init($id_tema) { // Agrega $id_tema como parámetro
        // Obtén los temas y las publicaciones
        $temas = $this->getThemes();
        $preguntas = $this->getAllPosts(); // Cambia para obtener todas las preguntas
        
        return [
            'temas' => $temas,   // Asigna los temas a la clave 'temas'
            'preguntas' => $preguntas // Asigna las preguntas a la clave 'preguntas'
        ]; // Devuelve temas y preguntas
    }
    
}
?>
