<?php

require_once "models/Usuario.php";

class UsuarioController {
    public $view;
    public $showLayout = true; // Controla si se debe mostrar header y footer

    public function __construct() {
        $this->view = "login"; // Vista por defecto
    }

    public function login() {
        $this->showLayout = false; // No mostrar el header/footer en la página de login

        // Verifica si el formulario fue enviado por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $usuario = new Usuario();
            if ($usuario->validateLogin($username, $password)) {
                // Iniciar sesión y redirigir
                $_SESSION['usuario'] = $username;
                header("Location: index.php?controller=usuario&action=inicio");
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

    public function logout() {
        // Cierra la sesión
        session_destroy();
        header("Location: index.php?controller=usuario&action=login");
        exit();
    }
}
?>
