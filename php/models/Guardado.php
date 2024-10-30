<?php
class Guardado {
    private $db;
    
    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $db = new db();
        $this->connection = $db->connection;
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
    
    public function obtenerGuardadosPorUsuario($usuario) {
        $query = "
            SELECT 
                p.id_post AS id_post,
                p.contenido AS contenido,
                t.caracteristica AS caracteristica
            FROM 
                posts p
            JOIN 
                guardado g ON p.id_post = g.id_post 
            JOIN 
                temas t ON p.id_tema = t.id_tema
            WHERE 
                g.id_usuario = ?
        ";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}