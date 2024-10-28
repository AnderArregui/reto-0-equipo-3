<?php
class Guardado {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function guardar() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id_post = $data['id_post'];
        $id_usuario = $data['id_usuario'];
        $guardar = $data['guardar'];

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
    }
    
    public function eliminar($id_post, $id_usuario) {
        $query = "DELETE FROM Guardado WHERE id_post = ? AND id_usuario = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_post, $id_usuario]);
    }
    
    public function obtenerGuardadosPorUsuario($id_usuario) {
        $query = "SELECT p.* FROM Posts p 
                  JOIN Guardado g ON p.id_post = g.id_post 
                  WHERE g.id_usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}