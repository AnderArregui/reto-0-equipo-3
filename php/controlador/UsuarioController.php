<?php

require_once "models/Usuario.php";

class UsuarioController {
    public $view;
    public $showLayout = true;

    private $usuario;

    public function __construct() {
        $this->view = "login";
    }

    public function login() {
        $this->showLayout = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->usuario = new Usuario();
            $usuarioModel = $this->usuario->validateLogin($username, $password);

            if ($usuarioModel) {
                $_SESSION['usuario'] = [
                    'id_usuario' => $usuarioModel['id_usuario'],
                    'nombre' => $usuarioModel['nombre'],
                    'foto' => $usuarioModel['foto'],
                    'especialidad' => $usuarioModel['especialidad'],
                    'anios_empresa' => $usuarioModel['anios_empresa'],
                    'email' => $usuarioModel['email'],
                    'tipo' => $usuarioModel['tipo']
                ];

                header("Location: index.php?controller=Inicio&action=inicio");
                exit();
            } else {
                echo "<script>alert('Usuario o contraseña incorrectos');</script>";
            }
        }

        $this->view = "login"; 
    }

    public function inicio() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $this->view = "inicio";
    }

    public function perfil() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit();
        }

        $this->view = "perfil";

        $idUsuario = $_SESSION['usuario']['id_usuario'];
        $this->usuario = new Usuario();
        $usuario = $this->usuario->obtenerPorId($idUsuario);
        
        return [
            'usuario' => $usuario
        ];
    }

    public function mostrarUsuario() {
        $this->usuario = new Usuario();
        $usuarios = $this->usuario->obtenerTodosLosUsuarios();
        $this->view = "mostrarusuario";
        return [
            'usuarios' => $usuarios
        ];
    }
    public function usuarioindividual() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=Usuario&action=mostrarUsuario");
            exit();
        }

        $id_usuario = $_GET['id_usuario'];
        $this->usuario = new Usuario();
        $infoUsuario = $this->usuario->obtenerInfoUsuario($id_usuario);
      
        if (!$infoUsuario) {
            $this->view = "usuarioindividual";
            return ["mensaje" => "Usuario no encontrado"];
        }
        
        $this->view = "usuarioindividual";
        return ['infoUsuario' => $infoUsuario];
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?controller=usuario&action=login");
        exit();
    }
}
?>
