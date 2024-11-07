<?php

require_once "models/Respuesta.php";
require_once "models/Usuario.php";

class RespuestaController {
    public $view;
    public $showLayout = true;
    private $respuestaModel;
    private $usuarioModel;

    public function __construct() {
        $this->view = "respuestas";
        $this->respuestaModel = new Respuesta();
        $this->usuarioModel = new Usuario();

        
        $nombre_usuario = $_SESSION['usuario']['nombre'] ?? null;
        if (!$nombre_usuario) {
            $_SESSION['mensaje'] = "Usuario no encontrado en la sesión.";
            header("Location: /reto-1-equipo-3/php/index.php");
            exit();
        }
    }

    public function darLike() {
        // Obtener los datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);
        $id_respuesta = $data['id_respuesta'] ?? null;
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
        $like = $data['like'] ?? null;
    
        // Validar que los datos necesarios estén presentes
        if ($id_respuesta && $id_usuario !== null && $like !== null) {
            // Verificar si el usuario ya ha dado like a esta respuesta
            $liked_by_user = $this->respuestaModel->verificarLike($id_respuesta, $id_usuario);
    
            // Si el like es 1 (agregar like)
            if ($like == 1) {
                if (!$liked_by_user) {
                    // El usuario no ha dado like previamente, agregar like
                    $resultado = $this->respuestaModel->incrementarLikes($id_respuesta, $id_usuario);
                } else {
                    // El usuario ya dio like, no se puede agregar
                    echo json_encode(['success' => false, 'message' => 'Ya has dado like a esta respuesta.']);
                    return;
                }
            }
            // Si el like es 0 (quitar like)
            elseif ($like == 0) {
                if ($liked_by_user) {
                    // El usuario ya había dado like, quitar like
                    $resultado = $this->respuestaModel->quitarLike($id_respuesta, $id_usuario);
                } else {
                    // El usuario no había dado like, no se puede quitar
                    echo json_encode(['success' => false, 'message' => 'No has dado like a esta respuesta.']);
                    return;
                }
            } else {
                // Si el valor de like es inválido
                echo json_encode(['success' => false, 'message' => 'Valor de like inválido.']);
                return;
            }
    
            // Si la operación fue exitosa
            if ($resultado) {
                // Obtener el nuevo número de likes para la respuesta
                $nuevoLikes = $this->respuestaModel->obtenerLikesPorRespuesta($id_respuesta);
    
                // Responder con éxito y el nuevo número de likes
                echo json_encode(['success' => true, 'likes' => $nuevoLikes, 'message' => 'Like procesado correctamente.']);
            } else {
                // Si hubo un error al procesar el like
                echo json_encode(['success' => false, 'message' => 'Error al procesar el like.']);
            }
        } else {
            // Si faltan datos en la solicitud
            echo json_encode(['success' => false, 'message' => 'Error en los datos enviados.']);
        }
    }

}
