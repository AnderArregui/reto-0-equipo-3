<?php
require_once "models/Tema.php";
require_once "models/Post.php";

class TemaController {
    public $showLayout = true;
    public $view = 'list';

    private $temaModel;
    public $postModel;

    public function __construct($db) {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../index.php");
            exit();
        }

        // Inicializa los modelos y pasa la conexión a la base de datos
        $this->temaModel = new Tema($db);
        $this->postModel = new Post($db);
    }

    // Método para obtener temas
    public function getThemes() {
        return $this->temaModel->obtenerTodos();
    }

    // Método para obtener publicaciones
    public function getAllPosts() {
        return $this->postModel->obtenerTodos();
    }

    public function view() {
        $this->view = "view";
        $id_tema = $_GET["id_tema"];
        
        // Obtén el tema por ID
        $temaData = $this->temaModel->obtenerPorId($id_tema);
        
        // Verifica si se encontró el tema
        if (!$temaData) {
            die("Tema no encontrado");
        }

        // Obtén las publicaciones del tema
        $preguntas = $this->postModel->obtenerPorTema($id_tema);

        // Prepara los datos para la vista
        $dataToView = [
            "tema" => $temaData,
            "preguntas" => $preguntas
        ];

        require_once("view/tema/view.html.php");
    }


    public function init($id_tema) {
        
        $temas = $this->getThemes();
        $preguntas = $this->getAllPosts();
        
        return [
            'temas' => $temas,   
            'preguntas' => $preguntas
        ]; 
    }
    
}
?>
