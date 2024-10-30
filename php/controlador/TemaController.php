<?php
require_once "models/Tema.php";
require_once "models/Post.php";
require_once "models/Usuario.php";

class TemaController {
    public $showLayout = true;
    public $view = 'list';
    public $usuarioModel;

    private $temaModel;
    public $postModel;

    public function __construct() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../index.php");
            exit();
        }

        // Inicializa los modelos y pasa la conexión a la base de datos
        $this->temaModel = new Tema();
        $this->postModel = new Post();
        $this->usuarioModel = new Usuario();
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

        return [
            "tema" => $temaData,
            "preguntas" => $preguntas
        ];


    }


    public function init($id_tema) {

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $nombre_usuario = $_SESSION['usuario'];
        $usuario = $this->usuarioModel->obtenerPorNombre($nombre_usuario);
        
        $temas = $this->getThemes();
        $preguntas = $this->getAllPosts();
        
        return [
            'temas' => $temas,   
            'preguntas' => $preguntas,
            'usuario' => $usuario
        ]; 
    }
    
}
?>
