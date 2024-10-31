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
    private $guardadoModel;

    public function __construct() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /reto-1-equipo-3/php/index.php");
            exit();
        }

        $this->temaModel = new Tema();
        $this->postModel = new Post();
        $this->respuestaModel = new Respuesta();
        $this->guardadoModel = new Guardado();
    }

    public function getThemes() {
        return $this->temaModel->obtenerTodos();
    }

    public function getAllPosts($orderType, $limit, $offset) {
        $orderBy = $this->determineOrderType($orderType);
        return $this->postModel->obtenerTodos($orderBy, $limit, $offset);
    }

    private function determineOrderType($orderType) {
        switch ($orderType) {
            case 'popular':
                return 'total_respuestas DESC'; // Popularidad
            case 'reciente':
                return 'p.fecha DESC'; // Fecha reciente
            case 'tema':
                return 't.nombre ASC'; // Orden por tema
            case 'aleatorio':
                return 'RAND()'; // Orden aleatorio
            default:
                return 'fecha_ultimo_mensaje DESC'; // Orden por último mensaje
        }
    }

    public function contacto() {
        $this->view = "contacto";
    }

    public function init() {
        $usuario = $_SESSION['usuario'];
        $temas = $this->getThemes();
        
        $orderType = $_GET['tipo'] ?? 'reciente';
        
        $postsPorPagina = PAGINATION;
        $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($paginaActual - 1) * $postsPorPagina;
        
        $preguntas = $this->getAllPosts($orderType, $postsPorPagina, $offset);
        
        $idUsuario = $usuario['id_usuario'];
        $guardados = $this->guardadoModel->obtenerGuardadosPorUsuario($idUsuario);
        $likesUsuario = $this->respuestaModel->obtenerLikesPorUsuario($idUsuario);
    
        $totalPreguntas = $this->postModel->contarTodos();
        $totalPaginas = ceil($totalPreguntas / $postsPorPagina);
        
        return [
            'temas' => $temas, 
            'preguntas' => $preguntas,
            'usuario' => $usuario,
            'likesUsuario' => $likesUsuario,
            'paginaActual' => $paginaActual,
            'totalPaginas' => $totalPaginas,
            'preguntasPorPagina' => $postsPorPagina,
            'totalPreguntas' => $totalPreguntas,
            'guardados' => $guardados
        ];
    }
}
?>
