<?php
class Guardado {

    private $connection;



    public function __construct()
    {
        $this->getConnection();
    }

    public function getConnection() {
        $db = new Db();
        $this->connection = $db->connection;
    }
    
    public function guardar() {
        $data = json_decode(file_get_contents("php://input"), true);
    
        if (!isset($data['id_post'], $data['id_usuario'], $data['guardar'])) {
            echo json_encode(['success' => false, 'message' => 'Faltan parámetros requeridos.']);
            return;
        }
    
        $id_post = (int)$data['id_post'];
        $id_usuario = (int)$data['id_usuario'];
        $guardar = (bool)$data['guardar'];
    
        try {
            if ($guardar) {
                
                $queryCheck = "SELECT COUNT(*) FROM guardado WHERE id_post = :id_post AND id_usuario = :id_usuario";
                $stmtCheck = $this->connection->prepare($queryCheck);
                $stmtCheck->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
                $exists = $stmtCheck->fetchColumn() > 0;
    
                if ($exists) {
                    echo json_encode(['success' => false, 'message' => 'Ya está guardado.']);
                    return;
                }
    
                
                $queryInsert = "INSERT INTO guardado (id_post, id_usuario) VALUES (:id_post, :id_usuario)";
                $stmtInsert = $this->connection->prepare($queryInsert);
                $success = $stmtInsert->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
    
                if ($success) {
                    
                    $queryPostInfo = "
                        SELECT 
                            p.id_post AS id_post, 
                            p.contenido AS contenido, 
                            t.caracteristica AS caracteristica
                        FROM 
                            posts p
                        JOIN 
                            temas t ON p.id_tema = t.id_tema
                        WHERE 
                            p.id_post = :id_post
                    ";
                    $stmtPostInfo = $this->connection->prepare($queryPostInfo);
                    $stmtPostInfo->execute(['id_post' => $id_post]);
                    $postInfo = $stmtPostInfo->fetch(PDO::FETCH_ASSOC);
    
                    echo json_encode(['success' => true, 'postGuardado' => $postInfo]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al guardar el post.']);
                }
            } else {
                
                $queryDelete = "DELETE FROM guardado WHERE id_post = :id_post AND id_usuario = :id_usuario";
                $stmtDelete = $this->connection->prepare($queryDelete);
                $success = $stmtDelete->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
    
                if ($success) {
                    echo json_encode(['success' => true, 'message' => 'Guardado eliminado correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar el guardado.']);
                }
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

    public function verificarGuardado($id_post, $id_usuario) {
        $query = "SELECT COUNT(*) FROM guardado WHERE id_post = :id_post AND id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id_post' => $id_post, 'id_usuario' => $id_usuario]);
        return $stmt->fetchColumn() > 0;
    }
    
}