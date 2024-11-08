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
    

        /*eliminar tema*/ 
        public function eliminarTema() {
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
                header("Location: index.php?controller=Usuario&action=login");
                exit();
            }
    
            $id_tema = $_POST['id_tema'] ?? null;
            $borrar_contenido = $_POST['borrar_contenido'] ?? 'no';
    
            if (!$id_tema) {
                $_SESSION['error'] = "ID de tema no proporcionado";
                header("Location: index.php?controller=Tema&action=list");
                exit();
            }
    
            $tema_eliminado_id = 28; // ID del tema "Eliminado"
    
            if ($borrar_contenido === 'si') {
                // Eliminar todas las preguntas, respuestas, likes y guardados asociados al tema
                if ($this->temaModel->eliminarContenidoTema($id_tema) && $this->temaModel->eliminarTema($id_tema)) {
                    $_SESSION['success'] = "Tema y todo su contenido eliminados correctamente";
                    error_log("Theme $id_tema and all its content deleted successfully");
                } else {
                    $_SESSION['error'] = "Error al eliminar el tema y su contenido";
                    error_log("Error deleting theme $id_tema and its content");
                }
            } else {
                // Mover preguntas, respuestas, likes y guardados al tema "Eliminado" (id_tema = 18)
                if ($this->temaModel->moverContenidoATema($id_tema, $tema_eliminado_id) && $this->temaModel->eliminarTema($id_tema)) {
                    $_SESSION['success'] = "Tema eliminado y contenido movido al tema 'Eliminado'";
                    error_log("Theme $id_tema deleted and content moved to theme $tema_eliminado_id");
                } else {
                    $_SESSION['error'] = "Error al mover el contenido y eliminar el tema";
                    error_log("Error moving content from theme $id_tema to theme $tema_eliminado_id and deleting theme $id_tema");
                }
            }
    
            header("Location: index.php?controller=Tema&action=list");
            exit();
        }


        public function modificarTema() {
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
                header("Location: index.php?controller=Usuario&action=login");
                exit();
            }
    
            $id_tema = $_GET['id_tema'] ?? null;
            if (!$id_tema) {
                $_SESSION['error'] = "ID de tema no proporcionado";
                header("Location: index.php?controller=Tema&action=list");
                exit();
            }
    
            $tema = $this->temaModel->obtenerPorId($id_tema);
            if (!$tema) {
                $_SESSION['error'] = "Tema no encontrado";
                header("Location: index.php?controller=Tema&action=list");
                exit();
            }
    
            $this->view = "modificarTema";
            return ['tema' => $tema];
        }
    
        public function actualizarTema() {
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
                header("Location: index.php?controller=Usuario&action=login");
                exit();
            }
    
            $id_tema = $_POST['id_tema'] ?? null;
            $nombre = $_POST['nombre'] ?? '';
            $caracteristica = $_POST['caracteristica'] ?? '';
    
            if (!$id_tema || !$nombre) {
                $_SESSION['error'] = "Datos incompletos";
                header("Location: index.php?controller=Tema&action=modificarTema&id_tema=$id_tema");
                exit();
            }
    
            $imagen = null;
            if (isset($_FILES['nueva_imagen']) && $_FILES['nueva_imagen']['error'] == 0) {
                $targetDir = "/reto-1-equipo-3/php/assets/images/temas/";
                $fileName = uniqid() . "_" . basename($_FILES['nueva_imagen']['name']);
                $targetFilePath = $targetDir . $fileName;
    
                if (move_uploaded_file($_FILES['nueva_imagen']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $targetFilePath)) {
                    $imagen = $targetFilePath;
                } else {
                    $_SESSION['error'] = "Error al subir la nueva imagen";
                    header("Location: index.php?controller=Tema&action=modificarTema&id_tema=$id_tema");
                    exit();
                }
            }
    
            if ($this->temaModel->actualizarTema($id_tema, $nombre, $caracteristica, $imagen)) {
                $_SESSION['success'] = "Tema actualizado correctamente";
            } else {
                $_SESSION['error'] = "Error al actualizar el tema";
            }
    
            header("Location: index.php?controller=Tema&action=list");
            exit();
        }
}