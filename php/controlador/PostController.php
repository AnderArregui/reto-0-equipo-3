<?php

class PostController {
    public $view;
    public $showLayout = true;
    private $temaModel;
    private $postModel;
    private $db;

    public function __construct($db) {
        if (!isset($_SESSION['usuario'])) {
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
        return $this->temaModel->obtenerTodos();
    }

    public function crearPreguntas() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_tema = null;
            
            if (isset($_POST['crear_tema']) && !empty($_POST['nuevo_tema'])) {
                $nuevo_tema = $_POST['nuevo_tema'];
                $id_tema = $this->temaModel->crear($nuevo_tema, 'default');
            } else {
                $id_tema = $_POST['tema'];
            }

            if (!empty($_POST['pregunta']) && $id_tema) {
                $id_usuario = $_SESSION['usuario']['id_usuario'];
                $pregunta = $_POST['pregunta'];

                if ($this->postModel->crear($id_usuario, $id_tema, $pregunta)) {
                    $_SESSION['mensaje'] = "Pregunta creada correctamente.";
                } else {
                    $_SESSION['mensaje'] = "Error al crear la pregunta.";
                }
            }

            header("Location: index.php?controller=Post&action=crearPregunta");
            exit();
        }

        $this->view = "crearPregunta";
        return $this->obtenerTemas();
    }
}