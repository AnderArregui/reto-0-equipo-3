<?php
require_once "models/Tema.php";
require_once "models/Post.php";
require_once "models/Usuario.php";

require_once "models/Guardado.php";


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

        

        // Inicializar el guardado
        $guardadoModel = new Guardado();

        // Preparar el array de guardados para la lista
        $guardados = [];
        foreach ($preguntas as $pregunta) {
            $guardados[$pregunta['id_post']] = $guardadoModel->verificarGuardado($pregunta['id_post'], $_SESSION['usuario']['id_usuario']);
        }

        // Prepara los datos para la vista
        return [

            "tema" => $temaData,
            "preguntas" => $preguntas,
            "guardados" => $guardados
        ];


    }


    public function init($id_tema) {

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $usuario = $_SESSION['usuario'];
        
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
