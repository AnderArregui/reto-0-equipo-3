<?php
require_once "models/Tema.php";
require_once "models/Post.php";
require_once "models/Respuesta.php";
require_once "models/Usuario.php";
require_once "models/Guardado.php";

class InicioController {
    public $showLayout = true;
    public $view = 'inicio';

    private $temaModel;
    private $postModel;
    private $respuestaModel;
    private $usuarioModel;
    private $guardadoModel;

    public function __construct() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /reto-1-equipo-3/php/index.php");
            exit();
        }

        $this->temaModel = new Tema();
        $this->postModel = new Post();
        $this->respuestaModel = new Respuesta();
        $this->usuarioModel = new Usuario();
        $this->guardadoModel = new Guardado();
    }

    public function getThemes() {
        return $this->temaModel->obtenerTodos();
    }

    public function getAllPosts($order = 'reciente') {
        // Llama al modelo Post con el parámetro de orden
        return $this->postModel->obtenerTodos($order); 
    }

    public function getUsuario() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }
        $nombre_usuario = $_SESSION['usuario'];
        return $this->usuarioModel->obtenerPorNombre($nombre_usuario);
    }



    public function contacto() {
        $this->view = "contacto";
    }

    public function init() {
        $usuario = $this->getUsuario();
        $temas = $this->getThemes();
    
        $orderType = $_GET['tipo'] ?? 'reciente';
        $preguntas = $this->getAllPosts($orderType);

        $idUsuario = $usuario['id_usuario'];

        $guardados = $this->guardadoModel->obtenerGuardadosPorUsuario($idUsuario);
        $likesUsuario = $this->respuestaModel->obtenerLikesPorUsuario($idUsuario);
    
        $this->view = "inicio"; 
    
        return [
            'temas' => $temas, 
            'preguntas' => $preguntas,
            'usuario' => $usuario,
            'guardados' => $guardados,
            'likesUsuario' => $likesUsuario
        ];
    }
    
}
?>
