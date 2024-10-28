<?php

require_once "models/Usuario.php";

class UsuarioController {
    public $view;
    public $showLayout = true; // Controla si se debe mostrar header y footer

    private $usuario;
    public $datos;


    public function __construct() {
        $this->view = "login";
    }

    public function login() {
        $this->showLayout = false;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->usuario = new Usuario();
            if ($this->usuario->validateLogin($username, $password)) {

                $_SESSION['usuario'] = $username;
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

   public function perfil()
{

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?controller=usuario&action=login");
        exit();
    }

    $nombre_usuario = $_SESSION['usuario'];

    $this->usuario = new Usuario();
    $usuarioData = $this->usuario->obtenerPorNombre($nombre_usuario);


    $this->view = "perfil";
    
    return $usuarioData;
}


    public function obtenerIdPorNombre() {
        $data = json_decode(file_get_contents("php://input"), true);
        $nombre_usuario = $data['nombre_usuario'];

        $usuario = $this->usuarioModel->obtenerIdPorNombre($nombre_usuario);

        if ($usuario) {
            echo json_encode(['success' => true, 'id_usuario' => $usuario['id_usuario']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
    }

    public function init() {
        $usuario = $this->perfil();
    
        return [
            'usuario' => $usuario,
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
