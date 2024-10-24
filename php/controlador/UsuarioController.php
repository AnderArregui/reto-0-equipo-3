<?php

require_once "models/Usuario.php";

class UsuarioController {
    public $view;
    public $showLayout = true; // Controla si se debe mostrar header y footer

    private $usuario;
    public $datos;


    public function __construct() {
        $this->view = "login";
        $this->usuario = new Usuario(); // Initialize the Usuario model in the constructor
    }

    public function login() {
        $this->showLayout = false; // No mostrar el header/footer en la página de login

        // Verifica si el formulario fue enviado por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->usuario = new Usuario();
            if ($this->usuario->validateLogin($username, $password)) {
                // Iniciar sesión y redirigir
                $_SESSION['usuario'] = $username;
                header("Location: index.php?controller=Inicio&action=inicio");
                exit();
            } else {
                echo "<script>alert('Usuario o contraseña incorrectos');</script>";
            }
        }

        $this->view = "login"; // Mantiene la vista de login
    }

    public function inicio() {
        // Verifica que el usuario haya iniciado sesión
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $this->view = "inicio"; // Vista de bienvenida
    }

    public function perfil()
    {
        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        // Cargar los datos del usuario desde la sesión
        $nombre_usuario = $_SESSION['usuario'];

        // Obtener los datos completos del usuario desde la base de datos
        $this->usuario = new Usuario();
        $usuarioData = $this->usuario->obtenerPorNombre($nombre_usuario);

        $this->view = "perfil";

        return $usuarioData;

    }

    public function init() {
        // Obtén los temas y las publicaciones
        $usuario = $this->perfil();

        return [
            'usuario' => $usuario // Asigna las preguntas a la clave 'preguntas'
        ];
    }

    public function logout() {
        // Cierra la sesión
        session_destroy();
        header("Location: index.php?controller=usuario&action=login");
        exit();
    }
}
?>
