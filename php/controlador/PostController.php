<?php

class PostController {
    public $view;
    public $showLayout = true;
    private $temaModel;
    private $postModel;
    private $db;

    public function __construct($db) {
        if (!isset($_SESSION['usuario'] )) {
            header("Location: /reto-1-equipo-3/php/index.php");
            exit();
        }

        $this->temaModel = new Tema($db);
        $this->postModel = new Post($db);
        $this->db = $db;
    }

    public function crearPregunta() {
        $this->view = "crearPregunta";
        $temas = $this->obtenerTemas();
        return $temas;
    }

    public function obtenerTemas() {
        return $this->temaModel->obtenerTemas();
    }

    public function crearPreguntas() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_tema = null;
    
            // Verifica si se está creando un nuevo tema o si se seleccionó uno existente
            if (isset($_POST['crear_tema']) && !empty($_POST['nuevo_tema'])) {
                $nuevo_tema = $_POST['nuevo_tema'];
                $id_tema = $this->temaModel->crear($nuevo_tema, 'default');
            } elseif (!empty($_POST['tema'])) {
                $id_tema = $_POST['tema'];
            }
            echo $id_tema;
            // Asegúrate de que tanto la pregunta como el tema (nuevo o existente) sean válidos
            if (!empty($_POST['pregunta']) && $id_tema) {
                $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null; // Validar existencia de id_usuario
                $pregunta = $_POST['pregunta'];
            
                if (!$id_usuario || !$id_tema) {
                    $_SESSION['mensaje'] = "ID de usuario o tema no válido. ID Usuario: $id_usuario, ID Tema: $id_tema";
                } else {
                    // Llama al método para crear la pregunta
                    if ($this->postModel->crear($id_usuario, $id_tema, $pregunta)) {
                        $_SESSION['mensaje'] = "Pregunta creada correctamente con el tema ID: $id_tema";
                    } else {
                        $_SESSION['mensaje'] = "Error al crear la pregunta.";
                    }
                }
            } else {
                $_SESSION['mensaje'] = "Debe seleccionar un tema o crear uno nuevo. ID tema: $id_tema";
            }
            
    
            header("Location: index.php?controller=Post&action=crearPregunta");
            exit();
        }
    
        $temas = $this->obtenerTemas();
        if (!is_array($temas)) {
            $temas = []; // Asigna un array vacío si no es un array válido
        }
    
        $this->view = "crearPregunta";
     
        return $this->obtenerTemas();
    }
    
   


    public function init($id_tema) { // Agrega $id_tema como parámetro
        // Obtén los temas y las publicaciones
        $temasNombre = $this->obtenerTemas(); // Cambia para obtener todas las preguntas
        
        return [
            'temas' => $temasNombre,
        ]; // Devuelve temas y preguntas
    }

    
    
}