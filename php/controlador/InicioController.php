<?php
require_once "models/Tema.php";
require_once "models/Post.php";

class InicioController {
    public $showLayout = true; // Para controlar si se debe mostrar el layout
    public $view = 'inicio'; // Nombre de la vista a cargar

    private $temaModel;
    private $postModel;

    public function __construct($db) {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../index.php");
            exit();
        }

        // Inicializa los modelos
        $this->temaModel = new Tema();
        $this->postModel = new Post();
    }

    // Método para obtener temas
    public function getThemes() {
        return $this->temaModel->obtenerTodos();
    }

    // Método para obtener publicaciones
    public function getPosts() {
        return $this->postModel->obtenerPorTema($id_tema); // Asegúrate de pasar el ID de tema si es necesario
    }

    // Método para inicializar la conexión y obtener datos
    public function init() {
        // Obtén los temas y las publicaciones
        $temas = $this->getThemes();
        $preguntas = $this->postModel->obtenerPorTema($id_tema); // Asume que tienes un ID de tema para obtener las publicaciones
        
        return [$temas, $preguntas]; // Devuelve temas y preguntas
    }
}
?>
