<?php
require_once "models/Tema.php";
require_once "models/Post.php";
require_once "models/Respuesta.php";

class InicioController {
    public $showLayout = true;
    public $view = 'inicio';

    private $temaModel;
    private $postModel;
    private $respuestaModel;
    private $usuarioModel;

    public function __construct() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /reto-1-equipo-3/php/index.php");
            exit();
        }


        $this->temaModel = new Tema();
        $this->postModel = new Post();
        $this->respuestaModel = new Respuesta();
        $this->usuarioModel = new Usuario();
    }


    public function getThemes() {
        return $this->temaModel->obtenerTodos();
    }

   
    public function getAllPosts() {
        return $this->postModel->obtenerTodos(); 
    }

    public function getUsuario() {

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?controller=usuario&action=login");
        exit();
    }

    $nombre_usuario = $_SESSION['usuario'];

    $this->usuario = new Usuario();
    $usuarioData = $this->usuarioModel->obtenerPorNombre($nombre_usuario);


    $this->view = "perfil";
    
    return $usuarioData;
    }

    public function contacto()
    {
        $this->view = "contacto";
    }


    public function init() {
       
        $usuario = $this->getUsuario();
        $temas = $this->getThemes();
        $preguntas = $this->getAllPosts();
        $this->view = "inicio"; 
        
        return [
            'temas' => $temas, 
            'preguntas' => $preguntas,
            'usuario' => $usuario
        ];
    }
}
?>
