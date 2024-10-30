<?php
class Guardado {

    private $connection;


    
    public function __construct() {
        $this->getConnection();
    }

    public function getConnection() {
        $db = new Db();
        $this->connection = $db->connection;
    }
    
    public function guardar() {
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Validar datos
        if (!isset($data['id_post'], $data['id_usuario'], $data['guardar'])) {
            echo json_encode(['success' => false, 'message' => 'Faltan parámetros requeridos.']);
            return;
        }
    
        $id_post = $data['id_post'];
        $id_usuario = $data['id_usuario'];
        $guardar = $data['guardar'];
    
        try {
            if ($guardar) {
                // Guardar en la tabla
                $queryInsert = "INSERT INTO guardado (id_post, id_usuario) VALUES (:id_post, :id_usuario)";
                $stmtInsert = $this->connection->prepare($queryInsert);
                $success = $stmtInsert->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
                echo json_encode(['success' => $success]);
            } else {
                // Eliminar de la tabla guardado
                $queryDelete = "DELETE FROM guardado WHERE id_post = :id_post AND id_usuario = :id_usuario";
                $stmtDelete = $this->connection->prepare($queryDelete);
                $success = $stmtDelete->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
                echo json_encode(['success' => $success]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al procesar la solicitud: ' . $e->getMessage()]);
        }
        exit();
    }
    
    public function eliminar($id_post, $id_usuario) {
        $query = "DELETE FROM Guardado WHERE id_post = ? AND id_usuario = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$id_post, $id_usuario]);
    }

    public function verificarGuardado($id_post, $id_usuario) {
        $query = "SELECT COUNT(*) FROM guardado WHERE id_post = :id_post AND id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
        return $stmt->fetchColumn() > 0;
    }
}