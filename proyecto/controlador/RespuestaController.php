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
            header("Location: /index.php");
            exit();
        }
    }

    public function darLike() {

        $data = json_decode(file_get_contents("php://input"), true);
        $id_respuesta = $data['id_respuesta'] ?? null;
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
        $like = $data['like'] ?? null;
    
        if ($id_respuesta && $id_usuario !== null && $like !== null) {

            $liked_by_user = $this->respuestaModel->verificarLike($id_respuesta, $id_usuario);
    
            if ($like == 1) {
                if (!$liked_by_user) {

                    $resultado = $this->respuestaModel->incrementarLikes($id_respuesta, $id_usuario);
                } else {

                    echo json_encode(['success' => false, 'message' => 'Ya has dado like a esta respuesta.']);
                    return;
                }
            }

            elseif ($like == 0) {
                if ($liked_by_user) {
                    $resultado = $this->respuestaModel->quitarLike($id_respuesta, $id_usuario);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No has dado like a esta respuesta.']);
                    return;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Valor de like inválido.']);
                return;
            }
    
            if ($resultado) {
                $nuevoLikes = $this->respuestaModel->obtenerLikesPorRespuesta($id_respuesta);
    
                echo json_encode(['success' => true, 'likes' => $nuevoLikes, 'message' => 'Like procesado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al procesar el like.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en los datos enviados.']);
        }
    }
    public function confirmDelete() {
        $this->view = "confirm";
    }

    
    public function delete() {
        $this->view = "delete";
        return $this->respuestaModel->deleteRespuestaById($_POST["id"]);
    }

    public function edit() {
        $this->view = "edit";
        $respuesta = $this->respuestaModel->obtenerPorId($_GET["id"]);

        return [
            'respuesta' => $respuesta
        ];
    }

    public function update() {
        $this->view = 'update';
        $id = $this->respuestaModel->update($_POST);
    }
}
