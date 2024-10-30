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

            // Obtener el usuario completo, para guardar la session

            $usuarioModel = $this->usuario->validateLogin($username, $password);

            if ($usuarioModel) {

                $_SESSION['usuario'] = $username;
                $_SESSION['id_usuario'] = $usuarioModel['id_usuario'];
                
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
    header('Content-Type: application/json');
    
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre_usuario = $data['nombre_usuario'];

    if (!$nombre_usuario) {
        echo json_encode(['success' => false, 'message' => 'Nombre de usuario no proporcionado.']);
        exit;
    }

    try {
        $usuarioModel = $this->usuario->obtenerIdPorNombre($nombre_usuario);

        if ($usuarioModel) {
            echo json_encode(['success' => true, 'id_usuario' => $usuarioModel['id_usuario']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
    } catch (Exception $e) {
        error_log('Error en obtenerIdPorNombre: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error interno del servidor.']);
    }
    exit;
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
